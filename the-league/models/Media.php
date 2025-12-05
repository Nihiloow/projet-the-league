<?php
class Media{
    public function __construct(private string $url, private string $alt, private int $id) {}

    public function getId(): int {
        return $this->id;
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function getAlt(): string {
        return $this->alt;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setUrl(string $url): void {
        $this->url = $url;
    }

    public function setAlt(string $alt): void {
        $this->alt = $alt;
    }
}