<?php
#set the timezone
date_default_timezone_set('Europe/Bucharest');

#set Error Reporting
error_reporting(E_ALL); // report all erors

#set APP_PATH
define('APP_PATH', dirname(__FILE__) . '/');
require_once(APP_PATH . 'functions.php');

#AUTO_LOAD classes and controllers
spl_autoload_register('loadClass');
spl_autoload_register('loadControllerClass');
