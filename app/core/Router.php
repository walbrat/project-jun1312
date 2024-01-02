<?php

namespace core;

use helpers\Session;

class Router
{
    const DEFAULT_ACTION = 'index';
    const DEFAULT_CONTROLLER = 'Index';
    const DEFAULT_ADMIN_CONTROLLER = 'Admin';
    const DEFAULT_AUTH_CONTROLLER = 'Auth';

    /**
     * @return void
     */
    static public function init(): void
    {
        $getUri = self::getUri();
        $controllerName = $getUri['controller_name'];
        $action = $getUri['action_name'];

        if (!class_exists($controllerName)) {
            self::notFound();
        }
        $controller = new $controllerName();
        if (!method_exists($controller, $action)) {
            self::notFound();
        }
        $controller->$action();
    }

    /**
     * @return array
     */
    static public function getUri() :array
    {
        $route = $_SERVER['REDIRECT_URL'] ?? $_SERVER['REQUEST_URI'];
        // Разбиваем строку по символу "/"
        $routeArray = explode('/', $route);
        // Фильтруем пустые элементы массива
        $routeArray = array_filter($routeArray);
        // Преобразуем индексы массива в числа (если нужно)
        $routeArray = array_values($routeArray);
        if (isset($routeArray[0]) && self::isAdminDashboard($routeArray[0]))
        {
            if (Session::isAuth()) {
                $controllerName = $routeArray[1] ?? self::DEFAULT_ADMIN_CONTROLLER;
                $return['route_controller'] = $routeArray[0];
                $controllerName = trim($controllerName);
                $controllerName = strtolower($controllerName);
                $controllerName = ucfirst($controllerName);
                $controllerName = '\controllers\admin\\' . $controllerName . 'Controller';
                $action = $routeArray[2] ?? self::DEFAULT_ACTION;
                $action = trim($action);
                $action = strtolower($action);
            } else {
                $controllerName = self::DEFAULT_AUTH_CONTROLLER;
                $return['route_controller'] = $routeArray[0];
                $controllerName = '\controllers\admin\\' . $controllerName . 'Controller';
                $action = $routeArray[2] ?? self::DEFAULT_ACTION;
                $action = trim($action);
                $action = strtolower($action);
            }
        } else {
            $controllerName = $routeArray[0] ?? self::DEFAULT_CONTROLLER;
            $return['route_controller'] = $controllerName;
            $controllerName = trim($controllerName);
            $controllerName = strtolower($controllerName);
            $controllerName = ucfirst($controllerName);
            $controllerName = '\controllers\\' . $controllerName . 'Controller';
            $action = $routeArray[1] ?? self::DEFAULT_ACTION;
            $action = trim($action);
            $action = strtolower($action);
        }
        $return['controller_name'] = $controllerName;
        $return['action_name'] = $action;
        return $return;
    }

    /**
     * send status 404
     */
    static public function notFound(): void
    {
        http_response_code(404);
        exit();
    }

    /**
     * метод автоматично директорію /dashboard/ при виклику із класів адмін панелі
     * параметри передавати у форматі id=2
     * загальний синтаксис
     * $url = getUrl('user', 'show', 'id=1');
     * $this->data['url'] = $url;
     * використовується для створення посилань у Контролерах, та вікористання у View при читанны змынної $url
     * @param string $controller
     * @param string $action
     * @param string|null $params
     * @return string
     */
    static public function getUrl(string $controller, string $action, string $params=null) : string
    {
        if ($params) {
            $params = "?{$params}";
        }
        $getUri = self::getUri();
        $isAdmin = self::isAdminDashboard($getUri['route_controller']);
        if($isAdmin){
            return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/dashboard/' . $controller . '/' . $action . $params;
        }
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $controller . '/' . $action . $params;
    }

    /**
     * @param string|null $url
     * @return void
     */
    static public function redirect(string $url = null): void
    {
        if ($url === null) {
            $url = $_SERVER['PHP_SELF'];
        }
       header("Location: {$url}");
        exit();
    }

    /**
     * @return bool
     */
    static public function isAdminDashboard(string $data) : bool
    {
        if ($data == 'dashboard') {
            return true;
        }
        return false;
    }

}