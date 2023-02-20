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
}
//class Route
//{
//    public static function get($uri, $params = [])
//    {
//        self::handle($uri, $params, 'GET');
//    }
//
//    public static function post($uri, $params = [])
//    {
//        self::handle($uri, $params, 'POST');
//    }
//
//    public static function handle($uri, $params, $method)
//    {
//        $requestUri = str_replace('/MVC/index.php/', '', $_SERVER['REQUEST_URI']);
//        $requestUri = rtrim($requestUri, '/');
//        $requestMethod = $_SERVER['REQUEST_METHOD'];
//
//        if ($method != $requestMethod) {
//            return;
//        }
//
//        $uriSegments = explode('/', $uri);
//        $requestSegments = explode('/', $requestUri);
//
//        if (count($uriSegments) != count($requestSegments)) {
//            return;
//        }
//
//        $params = [];
//        $matches = true;
//
//        for ($i = 0; $i < count($uriSegments); $i++) {
//            if ($uriSegments[$i] != $requestSegments[$i]) {
//                if (substr($uriSegments[$i], 0, 1) == '{' && substr($uriSegments[$i], -1) == '}') {
//                    $params[substr($uriSegments[$i], 1, -1)] = $requestSegments[$i];
//                } else {
//                    $matches = false;
//                    break;
//                }
//            }
//        }
//
//        if ($matches) {
//            $nameController = $params[0];
//            $method = $params[1];
//            require_once "./Controller/$nameController.php";
//            $action = new $nameController();
//            $action->$method($params);
//        }
//    }
//}
