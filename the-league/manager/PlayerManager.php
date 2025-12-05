<?php

class PlayerManager extends AbstractManager{
    public function create(Player $player) : Player
    {
        $query = $this->db->prepare("INSERT INTO players(nickname, bio, portrait, team, ) VALUES(:nickname, :bio, :portrait, :team);");
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
        $query = $this->db->prepare("UPDATE players SET nickname = :nickname, bio = :bio, portrait = :portrait, team = :team = : WHERE id = :id");
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
        $query = $this->db->prepare("SELECT * FROM players WHERE id = :id");
        $parameters = [
            "id"=> $id,
        ];

        $query->execute($parameters);
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if (isset($result))
        {
            return new Player($result["nickname"], $result["bio"], $result["portrait"], $result["team"], $result["id"]);
        }

        else
        {
            return null;
        }
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM players");
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $tab = [];

        foreach ($result as $player)
        {
            $tab[] = new Player($player["nickname"], $player["bio"], $player["portrait"], $player["team"], $player["id"]);
        }

        return $tab;
    }
}