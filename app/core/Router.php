<?php

namespace core;

class Router
{
    const DEFAULT_ACTION = 'index';
    const DEFAULT_CONTROLLER = 'Index';
    const DEFAULT_ADMIN_CONTROLLER = 'Admin';

    /**
     * get action GET param and call same method in object of Main
     */
    static public function init()
    {
        $route = $_SERVER['REQUEST_URI'];
        // Разбиваем строку по символу "/"
        $routeArray = explode('/', $route);
        // Фильтруем пустые элементы массива
        $routeArray = array_filter($routeArray);
        // Преобразуем индексы массива в числа (если нужно)
        $routeArray = array_values($routeArray);

        if (isset($routeArray[0]) && $routeArray[0] == 'admin') {
            $controllerName = $routeArray[1] ?? self::DEFAULT_ADMIN_CONTROLLER;
            $controllerName = trim($controllerName);
            $controllerName = strtolower($controllerName);
            $controllerName = ucfirst($controllerName);
            $controllerName = '\controllers\admin\\'.$controllerName.'Controller';

            $action = $routeArray[2] ?? self::DEFAULT_ACTION;
            $action = trim($action);
            $action = strtolower($action);
            $id = $routeArray[3] ?? null;

        } else {
            $controllerName = $routeArray[0] ?? self::DEFAULT_CONTROLLER;
            $controllerName = trim($controllerName);
            $controllerName = strtolower($controllerName);
            $controllerName = ucfirst($controllerName);
            $controllerName = '\controllers\\'.$controllerName.'Controller';

            $action = $routeArray[1] ?? self::DEFAULT_ACTION;
            $action = trim($action);
            $action = strtolower($action);
            $id = $routeArray[2] ?? null;
        }

        if(!class_exists($controllerName)){
            self::notFound();
        }
        $controller = new $controllerName();
        if (!method_exists($controller, $action)) {
            self::notFound();
        }
        $controller->$action($id);
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