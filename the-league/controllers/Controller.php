<?php 

class Controller extends AbstractController
{
     public function home() : void
    {
        $this->render("templates/partials/home.phtml", []);       //Il faut changer le tableau la (miam le mafé)
    }

    public function match() : void
    {
        $this->render("templates/partials/_dailyPlayers.phtml", []);
    }

    public function matches() : void
    {
        $this->render("templates/partials/match.phtml", []);
    }

    public function player() : void
    {
        $this->render("templates/partials/player.phtml", []);
    }

    public function players() : void
    {
        $this->render("templates/partials/players.phtml", []);
    }

    public function team() : void
    {
        $this->render("templates/partials/team.phtml", []);
    }

    public function teams() : void
    {
        $this->render("templates/partials/teams.phtml", []);
    }
}

?>