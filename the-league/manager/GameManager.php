<?php
class GameManager extends AbstractManager{
    public function create(Game $game) : Game
    {
        $query = $this->db->prepare("INSERT INTO games(name, date, team_1, team_2, winner) VALUES(:name, :date, :team_1, :team_2, :winner);");
        $parameters = [
            "name" => $game->getName(),
            "date" => $game->getdate()->format('Y-m-d H:i:s'),
            "team_1" => $game->getTeam1()->getId(),
            "team_2" => $game->getTeam2()->getId(),
            "winner" => $game->getWinner(),
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
        $query = $this->db->prepare("SELECT * FROM games WHERE id = :id");
        $parameters = [
            "id"=> $id,
        ];

        $query->execute($parameters);
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if (isset($result))
        {
            return new Game($result["name"], new DateTime($result["date"]), $result["team_1"], $result["team_2"], $result["winner"]->getId(), $result["id"]);
        }

        else
        {
            return null;
        }
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM games");
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $tab = [];

        foreach ($result as $game)
        {
            $tab[] = new Game($game["name"], new DateTime($game["date"]), $game["team_1"], $game["team_2"], $game["winner"]->getId(), $game["id"]);
        }

        return $tab;
    }
}