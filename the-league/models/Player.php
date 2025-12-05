<?php
class Player{
    public function __construct(private string $nickname, private string $bio, private Media $portrait, private Team $team, private int $id) {
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNickname(): string {
        return $this->nickname;
    }

    public function getBio(): string {
        return $this->bio;
    }

    public function getPortrait(): Media {
        return $this->portrait;
    }

    public function getTeam(): Team {
        return $this->team;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNickname(string $nickname): void {
        $this->nickname = $nickname;
    }

    public function setBio(string $bio): void {
        $this->bio = $bio;
    }

    public function setPortrait(Media $portrait): void {
        $this->portrait = $portrait;
    }

    public function setTeam(team $team): void {
        $this->team = $team;
    }
}