<?php
class Team{
    public function __construct(private int $id, private string $name, private string $description, private int $logo){
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getLogo(): int {
        return $this->logo;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setLogo(int $logo): void {
        $this->logo = $logo;
    }
}