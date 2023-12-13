<?php
spl_autoload_register(function ($class) {
    $path = '../app/' . $class . '.php';
    if(file_exists($path)){
        include_once $path;
        return true;
    }
    return false;
});

include_once 'config.php';