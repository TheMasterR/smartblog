<?php

require_once 'application/init.php';
# START SESSION
session_start();
# pass all the requests as $params
$params = $_REQUEST;

# degault PAGE is HOME and default ACTION is INDEX
$controllerName = isset($_GET['page']) ? $_GET['page'] : 'home';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';
# make sure the CONTROLLER is null
$controller = null;
# capitalize the first letter from controller name
$controllerClassName = ucfirst($controllerName . 'Controller');
$controllerFilePath = APP_PATH . 'controllers' . DIRECTORY_SEPARATOR . $controllerClassName .'.php';
if (file_exists($controllerFilePath)){
    $controller = new $controllerClassName($params);
}

if ($controller != null && method_exists($controller, $actionName)){
    $controller->{$actionName}(); // valoarea din $actionName va fi apelata
} else {
    $controller = new NotFoundController($params);
}

$TEMPLATE_VARS = array(
    'pageNotFound'  => false,
    'login'         => false,
    'register'      => false,
    'userIsLogged'  => User::isLogged(),
    'loggedUser'    => User::getLogged()
);

$TEMPLATE_VARS = array_merge($TEMPLATE_VARS, $controller->getOutput());

require_once APP_PATH . 'templates/components/main.php';
