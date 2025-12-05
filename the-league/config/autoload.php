<?php
require "models/Game.php";
require "models/Media.php";
require "models/Player_performance.php";
require "models/Player.php";
require "models/Team.php";


require "manager/AbstractManager.php";
require "manager/GameManager.php";
require "manager/MediaManager.php";
require "manager/PlayerManager.php";
require "manager/Player_performanceManager.php";
require "manager/TeamManager.php";

require "controllers/AbstractController.php";
require "controllers/Controller.php";

require "services/Router.php";


// ordre :
// model / (Abstract premier) manager / (Abstract premier) controller / service