<?php
class Team{
    public function __construct(private string $name, private ? string $description, private Media $logo, private ? int $id) {}

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getLogo(): Media {
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

    public function setLogo(Media $logo): void {
        $this->logo = $logo;
    }
}