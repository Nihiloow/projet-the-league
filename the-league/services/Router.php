<?php

class Router
{
    public function handleRequest() : void
    {
        $ctrl = new Controller();
        $paths = [
            "show_user" => "show",
            "create_user" => "create",
            "check_create_user" => "checkcreate",
            "update_user" => "update",
            "check_update_user" => "checkUpdate",
            "delete_user" => "delete"
        ];

        if (isset($_GET["route"])){
            if (isset($paths[$_GET["route"]])){
                $ctrl->$paths[$_GET["route"]]();
            }

            else{
                $ctrl->list();
            }
        }

        else{
            $ctrl->list();
        }
    }
}