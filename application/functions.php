<?php

// print_r between pre tags.
function deg($param){
    echo '<pre>';
    print_r($param);
    echo '</pre>';
}

// check for post
function isPost(){
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}


// AUTOLOAD FUNCTION
function loadClass($className){
    $classPath = APP_PATH . 'classes'. DIRECTORY_SEPARATOR . $className . '.php';

    if (file_exists($classPath)) {
        require_once $classPath;
    }
}

function loadControllerClass($className){
    $classPath = APP_PATH . 'controllers'. DIRECTORY_SEPARATOR . $className . '.php';

    if (file_exists($classPath)) {
        require_once $classPath;
    }
}

function redirect($redirectUrl){
    header('Location: ' . $redirectUrl);
    exit(); // ca nu vrem sa mai faca nimic dupa ce redirectioneaza
}