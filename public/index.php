<?php

namespace Index;

date_default_timezone_set('Europe/Paris');
require_once '../vendor/autoload.php';
require_once '../core/functions.php';



spl_autoload_register(function ($classname) {
    $classname = str_replace('\\', '/', $classname);
    // var_dump($classname);
    $namespace = explode('/', $classname);
    // var_dump($namespace);
    switch ($namespace[0]) {
        case 'App':
            $path = '../src/' . strtolower($namespace[1]) . '/' . $namespace[2] . '.php';
            break;
        case 'Core':
            $path = '../core/' . $namespace[1] . '.php';
            break;
    }
    require_once $path;
});

if (!empty($_GET['controller'])) {
    $controller = ucfirst($_GET['controller']);
} else {
    $controller = 'Home';
}

if (file_exists('../src/controller/' . $controller . 'Controller.php')) {
    require '../src/controller/' . $controller . 'Controller.php';

    if (!empty($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }

    if (method_exists(('App\\Controller\\' . $controller . "Controller"), $action)) {
        ('App\\Controller\\' . $controller . "Controller")::$action();
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "Erreur 404 Not Found";
    }
} else {
    header("HTTP/1.1 404 Not Found");
    echo "Erreur 404 Not Found";
}
