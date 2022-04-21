<?php
date_default_timezone_set('Europe/Paris');

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

    if (method_exists(($controller . "Controller"), $action)) {
        ($controller . "Controller")::$action();
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "Erreur 404 Not Found";
    }
} else {
    header("HTTP/1.1 404 Not Found");
    echo "Erreur 404 Not Found";
}
