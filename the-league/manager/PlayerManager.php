<?php

class PlayerManager extends AbstractManager
{
    public function create(Player $player) : Player
    {
        $query = $this->db->prepare("INSERT INTO players(nickname, bio, portrait, team) VALUES(:nickname, :bio, :portrait, :team);");
        $parameters = [
            "nickname" => $player->getNickname(),
            "bio" => $player->getBio(),
            "portrait" => $player->getPortrait()->getId(),
            "team" => $player->getTeam()->getId(),
        ];

        $query->execute($parameters);
        return $player;
    }

    public function update(Player $player): Player
    {
        $query = $this->db->prepare("UPDATE players SET nickname = :nickname, bio = :bio, portrait = :portrait, team = :team WHERE id = :id");
        $parameters = [
            "nickname"=> $player->getNickname(),
            "bio"=> $player->getBio(),
            "portrait"=> $player->getPortrait()->getId(),
            "team"=> $player->getTeam()->getId(),
            "id"=> $player->getId()
        ];

        $query->execute($parameters);
        return $player;
    }

    public function delete(Player $player): void
    {
        $query = $this->db->prepare("DELETE FROM players WHERE id = :id");
        $parameters = [
            "id"=> $player->getId(),
        ];

        $query->execute($parameters);
    }

    public function findOne(int $id): ?Player
    {
        $query = $this->db->prepare("SELECT p.id AS playerId, p.nickname, p.bio, p.team, m.id AS portraitId, m.url AS portraitUrl, m.alt AS portraitAlt, t.id AS teamId, t.name AS teamName, t.description AS teamDesc, t.logo AS teamLogoId, ml.url AS logoUrl, ml.alt AS logoAlt FROM players AS p JOIN media AS m ON p.portrait = m.id JOIN teams AS t ON p.team = t.id JOIN media AS ml ON t.logo = ml.id WHERE p.id = :id;");
        $parameters = [
            "id"=> $id,
        ];

        $query->execute($parameters);
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if (isset($result))
        {            
            $teamLogo = new Media($result["logoUrl"], $result["logoAlt"], $result["teamLogoId"]);
            
            $team = new Team($result["teamName"], $result["teamDesc"], $teamLogo, $result["teamId"]);
            
            $portrait = new Media($result["portraitUrl"], $result["portraitAlt"], $result["portraitId"]);
            
            return new Player($result["nickname"], $result["bio"], $portrait, $team, $result["playerId"]);
        }

        else
        {
            return null;
        }
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT p.id AS playerId, p.nickname, p.bio, p.team, m.id AS portraitId, m.url AS portraitUrl, m.alt AS portraitAlt, t.id AS teamId, t.name AS teamName, t.description AS teamDesc, t.logo AS teamLogoId, ml.url AS logoUrl, ml.alt AS logoAlt FROM players AS p JOIN media AS m ON p.portrait = m.id JOIN teams AS t ON p.team = t.id JOIN media AS ml ON t.logo = ml.id;");
        $query->execute();
        $results = $query->fetchAll(\PDO::FETCH_ASSOC);
        $tab = [];

        foreach ($results as $playerData)
        {            
            $teamLogo = new Media($playerData["logoUrl"], $playerData["logoAlt"], $playerData["teamLogoId"]);
            
            $team = new Team($playerData["teamName"], $playerData["teamDesc"], $teamLogo, $playerData["teamId"]);
            
            $portrait = new Media($playerData["portraitUrl"], $playerData["portraitAlt"], $playerData["portraitId"]);
            
            $tab[] = new Player($playerData["nickname"], $playerData["bio"], $portrait, $team, $playerData["playerId"]);
        }

        return $tab;
    }
}