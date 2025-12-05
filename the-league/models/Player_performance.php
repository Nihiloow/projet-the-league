<?php
class player_performance{
    public function __construct(private int $id, private int $player, private int $game, private int $points, private int $assists){
    }

    public function getId(): int {
        return $this->id;
    }

    public function getPlayer(): int {
        return $this->player;
    }

    public function getGame(): int {
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

    public function setPlayer(int $player): void {
        $this->player = $player;
    }

    public function setGame(int $game): void {
        $this->game = $game;
    }

    public function setPoints(int $points): void {
        $this->points = $points;
    }

    public function setAssists(int $assists): void {
        $this->assists = $assists;
    }
}