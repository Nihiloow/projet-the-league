<?php
class GameManager extends AbstractManager{
    public function create(Game $game) : Game
    {
        $query = $this->db->prepare("INSERT INTO games(name, date, team_1, team_2, winner) VALUES(:name, :date, :team_1, :team_2, :winner);");
        $parameters = [
            "name" => $game->getName(),
            "date" => $game->getdate()->format('Y-m-d H:i:s'),
            "team_1" => $game->getTeam1(),
            "team_2" => $game->getTeam2(),
            "winner" => $game->getWinner(),
        ];

        $query->execute($parameters);
        return $game;
    }
}