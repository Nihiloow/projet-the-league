<?php

class Player_PerformanceManager extends AbstractManager
{
    public function create(Player_Performance $performance) : Player_Performance
    {
        $query = $this->db->prepare("INSERT INTO player_performance(player, game, points, assists) VALUES(:player, :game, :points, :assists);");
        $parameters = [
            "player" => $performance->getPlayer()->getId(),
            "game" => $performance->getGame()->getId(),
            "points" => $performance->getPoints(),
            "assists" => $performance->getAssists(),
        ];

        $query->execute($parameters);
        return $performance;
    }

    public function update(Player_Performance $performance): Player_Performance
    {
        $query = $this->db->prepare("UPDATE player_performance SET player = :player, game = :game, points = :points, assists = :assists WHERE id = :id");
        $parameters = [
            "player" => $performance->getPlayer()->getId(),
            "game" => $performance->getGame()->getId(),
            "points" => $performance->getPoints(),
            "assists" => $performance->getAssists(),
            "id" => $performance->getId()
        ];

        $query->execute($parameters);
        return $performance;
    }

    public function delete(Player_Performance $performance): void
    {
        $query = $this->db->prepare("DELETE FROM player_performance WHERE id = :id");
        $parameters = [
            "id" => $performance->getId(),
        ];

        $query->execute($parameters);
    }

    public function findOne(int $id): ?Player_Performance
    {
        $query = $this->db->prepare("SELECT pp.id AS performanceId, pp.points, pp.assists, p.id AS playerId, p.nickname, p.bio, t.id AS playerTeamId, t.name AS playerTeamName, ml.id AS teamLogoId, ml.url AS teamLogoUrl, ml.alt AS teamLogoAlt, mp.id AS portraitId, mp.url AS portraitUrl, mp.alt AS portraitAlt, g.id AS gameId, g.name AS gameName, g.date AS gameDate, t1.id AS team1Id, t1.name AS team1Name, m1.id AS logo1Id, m1.url AS logo1Url, t2.id AS team2Id, t2.name AS team2Name, m2.id AS logo2Id, m2.url AS logo2Url, w.id AS winnerId, w.name AS winnerName, mw.id AS logoWId, mw.url AS logoWUrl FROM player_performance AS pp JOIN players AS p ON pp.player = p.id JOIN teams AS t ON p.team = t.id JOIN media AS ml ON t.logo = ml.id JOIN media AS mp ON p.portrait = mp.id JOIN games AS g ON pp.game = g.id JOIN teams AS t1 ON g.team_1 = t1.id JOIN media AS m1 ON t1.logo = m1.id JOIN teams AS t2 ON g.team_2 = t2.id JOIN media AS m2 ON t2.logo = m2.id JOIN teams AS w ON g.winner = w.id JOIN media AS mw ON w.logo = mw.id WHERE pp.id = :id;");
        $parameters = [
            "id"=> $id,
        ];

        $query->execute($parameters);
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if (isset($result))
        {
            $teamLogo = new Media($result["teamLogoUrl"], $result["teamLogoAlt"], $result["teamLogoId"]);
            $team = new Team($result["playerTeamName"], $result["playerTeamDesc"], $teamLogo, $result["playerTeamId"]);
            $portrait = new Media($result["portraitUrl"], $result["portraitAlt"], $result["portraitId"]);
            $player = new Player($result["nickname"], $result["bio"], $portrait, $team, $result["playerId"]);
            
            $logo1 = new Media($result["logo1Url"], "", $result["logo1Id"]);
            $team1 = new Team($result["team1Name"], "", $logo1, $result["team1Id"]);
            $logo2 = new Media($result["logo2Url"], "", $result["logo2Id"]);
            $team2 = new Team($result["team2Name"], "", $logo2, $result["team2Id"]);
            $logoW = new Media($result["logoWUrl"], "", $result["logoWId"]);
            $winner = new Team($result["winnerName"], "", $logoW, $result["winnerId"]);
            $game = new Game($result["gameName"], new DateTime($result["gameDate"]), $team1, $team2, $winner, $result["gameId"]);

            return new Player_Performance($player, $game, $result["points"], $result["assists"], $result["performanceId"]);
        }

        return null;
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT pp.id AS performanceId, pp.points, pp.assists, p.id AS playerId, p.nickname, p.bio, t.id AS playerTeamId, t.name AS playerTeamName, ml.id AS teamLogoId, ml.url AS teamLogoUrl, ml.alt AS teamLogoAlt, mp.id AS portraitId, mp.url AS portraitUrl, mp.alt AS portraitAlt, g.id AS gameId, g.name AS gameName, g.date AS gameDate, t1.id AS team1Id, t1.name AS team1Name, m1.id AS logo1Id, m1.url AS logo1Url, t2.id AS team2Id, t2.name AS team2Name, m2.id AS logo2Id, m2.url AS logo2Url, w.id AS winnerId, w.name AS winnerName, mw.id AS logoWId, mw.url AS logoWUrl FROM player_performance AS pp JOIN players AS p ON pp.player = p.id JOIN teams AS t ON p.team = t.id JOIN media AS ml ON t.logo = ml.id JOIN media AS mp ON p.portrait = mp.id JOIN games AS g ON pp.game = g.id JOIN teams AS t1 ON g.team_1 = t1.id JOIN media AS m1 ON t1.logo = m1.id JOIN teams AS t2 ON g.team_2 = t2.id JOIN media AS m2 ON t2.logo = m2.id JOIN teams AS w ON g.winner = w.id JOIN media AS mw ON w.logo = mw.id;");
        $query->execute();
        $results = $query->fetchAll(\PDO::FETCH_ASSOC);
        $tab = [];

        foreach ($results as $result)
        {
            $teamLogo = new Media($result["teamLogoUrl"], $result["teamLogoAlt"], $result["teamLogoId"]);
            $team = new Team($result["playerTeamName"], $result["playerTeamDesc"], $teamLogo, $result["playerTeamId"]);
            $portrait = new Media($result["portraitUrl"], $result["portraitAlt"], $result["portraitId"]);
            $player = new Player($result["nickname"], $result["bio"], $portrait, $team, $result["playerId"]);
            
            $logo1 = new Media($result["logo1Url"], "", $result["logo1Id"]);
            $team1 = new Team($result["team1Name"], "", $logo1, $result["team1Id"]);
            $logo2 = new Media($result["logo2Url"], "", $result["logo2Id"]);
            $team2 = new Team($result["team2Name"], "", $logo2, $result["team2Id"]);
            $logoW = new Media($result["logoWUrl"], "", $result["logoWId"]);
            $winner = new Team($result["winnerName"], "", $logoW, $result["winnerId"]);
            $game = new Game($result["gameName"], new DateTime($result["gameDate"]), $team1, $team2, $winner, $result["gameId"]);

            $tab[] = new Player_Performance($player, $game, $result["points"], $result["assists"], $result["performanceId"]);
        }

        return $tab;
    }

    public function findPerf(int $id): array
    {
        $query = $this->db->prepare("SELECT pp.id AS performanceId, pp.points, pp.assists, p.id AS playerId, p.nickname, p.bio, t.id AS playerTeamId, t.name AS playerTeamName, ml.id AS teamLogoId, ml.url AS teamLogoUrl, ml.alt AS teamLogoAlt, mp.id AS portraitId, mp.url AS portraitUrl, mp.alt AS portraitAlt, g.id AS gameId, g.name AS gameName, g.date AS gameDate, t1.id AS team1Id, t1.name AS team1Name, m1.id AS logo1Id, m1.url AS logo1Url, t2.id AS team2Id, t2.name AS team2Name, m2.id AS logo2Id, m2.url AS logo2Url, w.id AS winnerId, w.name AS winnerName, mw.id AS logoWId, mw.url AS logoWUrl FROM player_performance AS pp JOIN players AS p ON pp.player = p.id JOIN teams AS t ON p.team = t.id JOIN media AS ml ON t.logo = ml.id JOIN media AS mp ON p.portrait = mp.id JOIN games AS g ON pp.game = g.id JOIN teams AS t1 ON g.team_1 = t1.id JOIN media AS m1 ON t1.logo = m1.id JOIN teams AS t2 ON g.team_2 = t2.id JOIN media AS m2 ON t2.logo = m2.id JOIN teams AS w ON g.winner = w.id JOIN media AS mw ON w.logo = mw.id WHERE pp.game = :id;");
        
        $query->execute(["id" => $id]);
        
        $results = $query->fetchAll(\PDO::FETCH_ASSOC);
        $tab = [];

        foreach ($results as $result)
        {
            $teamLogo = new Media($result["teamLogoUrl"], $result["teamLogoAlt"], $result["teamLogoId"]);
            $team = new Team($result["playerTeamName"], $result["playerTeamDesc"], $teamLogo, $result["playerTeamId"]);
            $portrait = new Media($result["portraitUrl"], $result["portraitAlt"], $result["portraitId"]);
            $player = new Player($result["nickname"], $result["bio"], $portrait, $team, $result["playerId"]);
            
            $logo1 = new Media($result["logo1Url"], "", $result["logo1Id"]);
            $team1 = new Team($result["team1Name"], "", $logo1, $result["team1Id"]);
            $logo2 = new Media($result["logo2Url"], "", $result["logo2Id"]);
            $team2 = new Team($result["team2Name"], "", $logo2, $result["team2Id"]);
            $logoW = new Media($result["logoWUrl"], "", $result["logoWId"]);
            $winner = new Team($result["winnerName"], "", $logoW, $result["winnerId"]);
            $game = new Game($result["gameName"], new DateTime($result["gameDate"]), $team1, $team2, $winner, $result["gameId"]);

            $tab[] = new Player_Performance($player, $game, $result["points"], $result["assists"], $result["performanceId"]);
        }

        return $tab;
    }

    public function findPerfPlayer(int $playerId): array
    {
        $query = $this->db->prepare("
            SELECT pp.points, pp.assists, g.id AS gameId, g.date AS gameDate, g.team_1 AS team1Id, g.team_2 AS team2Id, g.winner AS winnerId, t_player.id AS playerTeamId, t1.name AS team1Name, t2.name AS team2Name
            FROM player_performance AS pp
            JOIN players AS p ON pp.player = p.id
            JOIN teams AS t_player ON p.team = t_player.id
            JOIN games AS g ON pp.game = g.id
            JOIN teams AS t1 ON g.team_1 = t1.id
            JOIN teams AS t2 ON g.team_2 = t2.id
            WHERE pp.player = :playerId
            ORDER BY g.date DESC;
        ");

        $query->execute(["playerId" => $playerId]);
        
        $results = $query->fetchAll(\PDO::FETCH_ASSOC);
        $performances = [];

        foreach ($results as $result) {
            
            $playerTeamId = $result['playerTeamId'];

            if ($result['winnerId'] == $playerTeamId) {
                $victoire = "Oui";
            }

            else {
                $victoire = "Non";
            }

            if ($result['team1Id'] == $playerTeamId) {
                $adverseTeamName = $result['team2Name'];
            } 
            
            else {
                $adverseTeamName = $result['team1Name'];
            }

            $performances[] = [
                "game_id" => $result['gameId'],
                "game_date" => new DateTime($result['gameDate']),
                "team_adverse" => $adverseTeamName,
                "points" => $result['points'],
                "assists" => $result['assists'],
                "victoire" => $victoire,
            ];
        }

        return $performances;
    }
}