<?php

class TeamManager extends AbstractManager
{
    public function create(Team $team) : Team
    {
        $query = $this->db->prepare("INSERT INTO teams(name, description, logo) VALUES(:name, :description, :logo);");
        $parameters = [
            "name"=> $team->getName(),
            "description"=> $team->getDescription(),
            "logo"=> $team->getLogo(),
        ];

        $query->execute($parameters);
        return $team;
    }

    public function update(Team $team): Team
    {
        $query = $this->db->prepare("UPDATE teams SET name = :name, description = :description, logo = :logo = : WHERE id = :id");
        $parameters = [
            "name"=> $team->getName(),
            "description"=> $team->getDescription(),
            "logo"=> $team->getLogo(),
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
        $query = $this->db->prepare("SELECT * FROM teams WHERE id = :id");
        $parameters = [
            "id"=> $id,
        ];

        $query->execute($parameters);
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if (isset($result))
        {
            return new Team($result["name"], $result["description"], $result["logo"], $result["id"]);
        }

        else
        {
            return null;
        }
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM teams");
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $tab = [];

        foreach ($result as $team)
        {
            $tab[] = new Team($team["name"], $team["description"], $team["logo"], $team["id"]);
        }

        return $tab;
    }
}