<?php
class GameManager extends AbstractManager
{
    public function create(Game $game) : Game
    {
        $query = $this->db->prepare("INSERT INTO games(name, date, team_1, team_2, winner) VALUES(:name, :date, :team_1, :team_2, :winner);");
        $parameters = [
            "name" => $game->getName(),
            "date" => $game->getDate()->format('Y-m-d H:i:s'),
            "team_1" => $game->getTeam1()->getId(),
            "team_2" => $game->getTeam2()->getId(),
            "winner" => $game->getWinner()->getId(),
        ];

        $query->execute($parameters);
        return $game;
    }

    public function update(Game $game): Game
    {
        $query = $this->db->prepare("UPDATE games SET name = :name, date = :date, team_1 = :team_1, team_2 = :team_2, winner = :winner WHERE id = :id");
        $parameters = [
            "name"=> $game->getName(),
            "date"=> $game->getDate()->format("Y-m-d H:i:s"),
            "team_1"=> $game->getTeam1()->getId(),
            "team_2"=> $game->getTeam2()->getId(),
            "winner"=> $game->getWinner()->getId(),
            "id"=> $game->getId()
        ];

        $query->execute($parameters);
        return $game;
    }

    public function delete(Game $game): void
    {
        $query = $this->db->prepare("DELETE FROM games WHERE id = :id");
        $parameters = [
            "id"=> $game->getId(),
        ];

        $query->execute($parameters);
    }

    public function findOne(int $id): ?Game
    {
        $query = $this->db->prepare("SELECT g.id AS gameId, g.name, g.date, g.team_1, g.team_2, g.winner, t1.name AS team1Name, t1.description AS team1Desc, m1.id AS logo1Id, m1.url AS logo1Url, m1.alt AS logo1Alt, t2.name AS team2Name, t2.description AS team2Desc, m2.id AS logo2Id, m2.url AS logo2Url, m2.alt AS logo2Alt, w.id AS winnerId, w.name AS winnerName, w.description AS winnerDesc, mw.id AS logoWId, mw.url AS logoWUrl, mw.alt AS logoWAlt FROM games AS g JOIN teams AS t1 ON g.team_1 = t1.id JOIN media AS m1 ON t1.logo = m1.id JOIN teams AS t2 ON g.team_2 = t2.id JOIN media AS m2 ON t2.logo = m2.id JOIN teams AS w ON g.winner = w.id JOIN media AS mw ON w.logo = mw.id WHERE g.id = :id;");
        $parameters = [
            "id"=> $id,
        ];

        $query->execute($parameters);
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if (isset($result))
        {
            $logo1 = new Media($result["logo1Url"], $result["logo1Alt"], $result["logo1Id"]);
            $team1 = new Team($result["team1Name"], $result["team1Desc"], $logo1, $result["team_1"]);
            
            $logo2 = new Media($result["logo2Url"], $result["logo2Alt"], $result["logo2Id"]);
            $team2 = new Team($result["team2Name"], $result["team2Desc"], $logo2, $result["team_2"]);
            
            $logoW = new Media($result["logoWUrl"], $result["logoWAlt"], $result["logoWId"]);
            $winner = new Team($result["winnerName"], $result["winnerDesc"], $logoW, $result["winnerId"]);
            
            return new Game($result["name"], new DateTime($result["date"]), $team1, $team2, $winner, $result["gameId"]);
        }

        return null;
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT g.id AS gameId, g.name, g.date, g.team_1, g.team_2, g.winner, t1.name AS team1Name, t1.description AS team1Desc, m1.id AS logo1Id, m1.url AS logo1Url, m1.alt AS logo1Alt, t2.name AS team2Name, t2.description AS team2Desc, m2.id AS logo2Id, m2.url AS logo2Url, m2.alt AS logo2Alt, w.id AS winnerId, w.name AS winnerName, w.description AS winnerDesc, mw.id AS logoWId, mw.url AS logoWUrl, mw.alt AS logoWAlt FROM games AS g JOIN teams AS t1 ON g.team_1 = t1.id JOIN media AS m1 ON t1.logo = m1.id JOIN teams AS t2 ON g.team_2 = t2.id JOIN media AS m2 ON t2.logo = m2.id JOIN teams AS w ON g.winner = w.id JOIN media AS mw ON w.logo = mw.id;");
        $query->execute();
        $results = $query->fetchAll(\PDO::FETCH_ASSOC);
        $tab = [];

        foreach ($results as $result)
        {
            $logo1 = new Media($result["logo1Url"], $result["logo1Alt"], $result["logo1Id"]);
            $team1 = new Team($result["team1Name"], $result["team1Desc"], $logo1, $result["team_1"]);
            
            $logo2 = new Media($result["logo2Url"], $result["logo2Alt"], $result["logo2Id"]);
            $team2 = new Team($result["team2Name"], $result["team2Desc"], $logo2, $result["team_2"]);
            
            $logoW = new Media($result["logoWUrl"], $result["logoWAlt"], $result["logoWId"]);
            $winner = new Team($result["winnerName"], $result["winnerDesc"], $logoW, $result["winnerId"]);
            
            $tab[] = new Game($result["name"], new DateTime($result["date"]), $team1, $team2, $winner, $result["gameId"]);
        }

        return $tab;
    }
}