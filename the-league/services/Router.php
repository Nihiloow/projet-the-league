<?php

class Router
{
    public function handleRequest() : void
    {
        $ctrl = new Controller();
        $paths = [
            "match" => "match",
            "matchs" => "matchs",
            "player" => "player",
            "players" => "players",
            "team" => "team",
            "teams" => "teams"
        ];

        if (isset($_GET["route"])){
            if (isset($paths[$_GET["route"]])){
                $method = $paths[$_GET["route"]];
                $ctrl->$method();
            }

            else{
                $ctrl->missing();
            }
        }

        else{
            $ctrl->home();
        }
    }
}