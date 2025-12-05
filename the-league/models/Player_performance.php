<?php
class Player_Performance{
    public function __construct(private int $id, private Player $player, private Game $game, private int $points, private int $assists){
    }

    public function getId(): int {
        return $this->id;
    }

    public function getPlayer(): Player {
        return $this->player;
    }

    public function getGame(): Game {
        return $this->game;
    }

    public function getPoints(): int {
        return $this->points;
    }

    public function getAssists(): int {
        return $this->assists;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setPlayer(Player $player): void {
        $this->player = $player;
    }

    public function setGame(Game $game): void {
        $this->game = $game;
    }

    public function setPoints(int $points): void {
        $this->points = $points;
    }

    public function setAssists(int $assists): void {
        $this->assists = $assists;
    }
}