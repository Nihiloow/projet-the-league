<?php
class Game{
    public function __construct(private string $name, private DateTime $date, private Team $team_1, private Team $team_2, private Team $winner, private int $id) {}

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDate(): DateTime {
        return $this->date;
    }

    public function getTeam1(): Team {
        return $this->team_1;
    }

    public function getTeam2(): Team {
        return $this->team_2;
    }

    public function getWinner(): Team {
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

    public function setTeam1(Team $team_1): void {
        $this->team_1 = $team_1;
    }

    public function setTeam2(Team $team_2): void {
        $this->team_2 = $team_2;
    }

    public function setWinner(Team $winner): void {
        $this->winner = $winner;
    }
}