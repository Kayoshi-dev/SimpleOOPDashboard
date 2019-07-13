<?php

class Application {
    public static function process() {
        $controllerName = "User";
        $task = "index";

        if(!empty($_GET['controllers'])) {
            $controllerName = ucfirst($_GET['controllers']);
        }

        if(!empty($_GET['task'])) {
            $task = $_GET['task'];
        }

        $controllerName = "\Controllers\\" . $controllerName;

        $controller = new $controllerName();
        $controller->$task();
    }
}