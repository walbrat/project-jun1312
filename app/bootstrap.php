<?php
include_once 'config'.DIRECTORY_SEPARATOR.'config.php';
spl_autoload_register(function ($class) {
    $path = '../app/' . $class . '.php';
    if (file_exists($path)) {
        // TODO
        include_once $path;
        return true;
    }
    return false;
});
\core\Router::init();


