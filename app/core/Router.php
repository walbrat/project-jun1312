<?php

namespace core;

class Router
{
    const DEFAULT_ACTION = 'index';
    const DEFAULT_CONTROLLER = 'index';

    /**
     * get action GET param and call same method in object of Main
     */
    static public function init()
    {
        $actionInput = filter_input(INPUT_GET, 'action');
        $action = $actionInput ?? self::DEFAULT_ACTION;
        $action = trim($action);
        $action = strtolower($action);

        $controllerInput = filter_input(INPUT_GET, 'controller');
        $controllerName = $controllerInput ?? self::DEFAULT_CONTROLLER;
        $controllerName = trim($controllerName);
        $controllerName = strtolower($controllerName);
        $controllerName = ucfirst($controllerName);
        $controllerName = '\controllers\\'.$controllerName.'Controller';
        if(!class_exists($controllerName)){
            self::notFound();
        }
        $controller = new $controllerName();
        if (!method_exists($controller, $action)) {
            self::notFound();
        }
        $controller->$action();
    }

    /**
     * send status 404
     */
    static public function notFound()
    {
        http_response_code(404);
        exit();
    }

    static public function getUrl(string $controller = self::DEFAULT_CONTROLLER, string $page = self::DEFAULT_ACTION)
    {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/?controller=' . $controller . '&action=' . $page;
    }

    static public function redirect(string $url = null){
        if($url === null){
            $url = $_SERVER['PHP_SELF'];
        }
        header("Location: {$url}");
        exit();
    }

}