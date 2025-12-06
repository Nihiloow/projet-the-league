<?php

class TeamManager extends AbstractManager
{
    public function create(Team $team) : Team
    {
        $query = $this->db->prepare("INSERT INTO teams(name, description, logo) VALUES(:name, :description, :logo);");
        $parameters = [
            "name"=> $team->getName(),
            "description"=> $team->getDescription(),
            "logo"=> $team->getLogo()->getId(),
        ];

        $query->execute($parameters);
        return $team;
    }

    public function update(Team $team): Team
    {
        $query = $this->db->prepare("UPDATE teams SET name = :name, description = :description, logo = :logo WHERE id = :id");
        $parameters = [
            "name"=> $team->getName(),
            "description"=> $team->getDescription(),
            "logo"=> $team->getLogo()->getId(),
            "id"=> $team->getId()
        ];

        $query->execute($parameters);
        return $team;
    }

    public function delete(Team $team): void
    {
        $query = $this->db->prepare("DELETE FROM teams WHERE id = :id");
        $parameters = [
            "id"=> $team->getId(),
        ];

        $query->execute($parameters);
    }

    public function findOne(int $id): ?Team
    {
        $query = $this->db->prepare(
            "SELECT teams.id AS teamId, teams.name, teams.description, media.id AS logoId, media.url, media.alt FROM teams JOIN media ON teams.logo = media.id WHERE teams.id = :id");
        $parameters = [
            "id"=> $id,
        ];

        $query->execute($parameters);
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if (isset($result))
        {
            $logo = new Media($result["url"], $result["alt"], $result["logoId"]);
            return new Team($result["name"], $result["description"], $logo, $result["teamId"]);
        }
        else
        {
            return null;
        }
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT teams.id AS teamId, teams.name, teams.description, media.id AS logoId, media.url, media.alt FROM teams JOIN media ON teams.logo = media.id");
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $tab = [];

        foreach ($result as $team)
        {
            $logo = new Media($team["url"], $team["alt"], $team["logoId"]);
            $tab[] = new Team($team["name"], $team["description"], $logo, $team["teamId"]);
        }

        return $tab;
    }
}