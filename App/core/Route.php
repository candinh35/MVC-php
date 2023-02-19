<?php

class Route
{
    public static function get($uri, $params = [])
    {
        $request = str_replace('/MVC/index.php/', '', $_SERVER['REQUEST_URI']);
        $request = explode('/', $request);
        if($uri === $request[0]){
            $id = $request[1] ?? '';
            $nameController = $params[0];
            $method = $params[1];
            require_once "./Controller/$nameController.php";
            $action = new $nameController();
            $action->$method($id);
        }
    }

    public static function post($uri, $params = [])
    {
        $request = str_replace('/MVC/index.php/', '', $_SERVER['REQUEST_URI']);
        if($uri === $request){
            $nameController = $params[0];
            $method = $params[1];
            require_once "./Controller/$nameController.php";
            $action = new $nameController();
            $action->$method();
        }
    }
}