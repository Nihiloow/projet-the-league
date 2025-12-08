<?php 

class Controller extends AbstractController
{
    public function home() : void
    {
        $this->render("home", []);
    }

    public function match() : void
    {
        $this->render("match", ["id" => (int)$_GET["id"]]);
    }

    public function matchs() : void
    {
        $this->render("matchs", []);
    }

    public function player() : void
    {
        $this->render("player", ["id" => (int)$_GET["id"]]);
    }

    public function players() : void
    {
        $this->render("players", []);
    }

    public function team() : void
    {
        $this->render("team", ["id" => (int)$_GET["id"]]);
    }

    public function teams() : void
    {
        $this->render("teams", []);
    }

    public function missing() : void
    {
        $this->render("404", []);
    }
}

?>