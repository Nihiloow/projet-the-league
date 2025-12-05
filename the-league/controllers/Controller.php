<?php 

class Controller extends AbstractController
{
     public function header() : void
    {
        $this->render("templates/partials/_header.phtml", []);       //Il faut changer le tableau la (miam le mafé)
    }

    public function dailyPlayers() : void
    {
        $this->render("templates/partials/_dailyPlayers.phtml", []);
    }

    public function dailyTeam() : void
    {
        $this->render("templates/partials/_dailyTeam.phtml", []);
    }

    public function dailyTeamPlayer() : void
    {
        $this->render("templates/partials/_dailyTeamPlayer.phtml", []);
    }

    public function lastMatch() : void
    {
        $this->render("templates/partials/_lastMatch.phtml", []);
    }

    public function players() : void
    {
        $this->render("templates/partials/_players.phtml", []);
    }

    public function title() : void
    {
        $this->render("templates/partials/_title.phtml", []);
    }
}

?>