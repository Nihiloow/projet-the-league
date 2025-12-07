<?php

require "config/autoload.php";

$gameManager = new GameManager() ;
$mediaManager = new MediaManager() ;
$playerManager = new PlayerManager() ;
$player_perfManager = new Player_PerformanceManager() ;
$teamManager = new TeamManager() ;

$router = new Router();
$router->handleRequest();