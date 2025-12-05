<?php
class Game{
    public function __construct(private int $id, private string $name, private DateTime $date, private int $team_1, private int $team_2, private int $winner){
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDate(): DateTime {
        return $this->date;
    }

    public function getTeam1(): int {
        return $this->team_1;
    }

    public function getTeam2(): int {
        return $this->team_2;
    }

    public function getWinner(): int {
        return $this->winner;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDate(DateTime $date): void {
        $this->date = $date;
    }

    public function setTeam1(int $team_1): void {
        $this->team_1 = $team_1;
    }

    public function setTeam2(int $team_2): void {
        $this->team_2 = $team_2;
    }

    public function setWinner(int $winner): void {
        $this->winner = $winner;
    }
}