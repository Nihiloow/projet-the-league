<?php 

class Controller extends AbstractController
{
    public function home() : void
    {
        $this->render("templates/home.phtml", []);
    }

    public function match() : void
    {
        $this->render("templates/match.phtml", []);
    }

    public function matchs() : void
    {
        $this->render("templates/matchs.phtml", []);
    }

    public function player() : void
    {
        $this->render("templates/player.phtml", []);
    }

    public function players() : void
    {
        $this->render("templates/players.phtml", []);
    }

    public function team() : void
    {
        $this->render("templates/team.phtml", []);
    }

    public function teams() : void
    {
        $this->render("templates/teams.phtml", []);
    }

    public function missing() : void
    {
        $this->render("templates/404.phtml", []);
    }
}

?>