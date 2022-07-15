<?php

// here we use absolute path


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('src', ROOT . DS . "src");
define('CONTROLLERS', src . DS . "controllers" . DS);
define('MODELS', src . DS . "models" . DS);
define('VIEWS', src . DS . "views" . DS);
define('CORE', src . DS . "core" . DS);
define('VENDOR', ROOT . DS . "vendor" . DS);


// echo VIEWS;
// echo ROOT;
// echo DS;
// echo src;
// echo CORE;



// require CORE . "bootstrap.php";
require_once VENDOR . "autoload.php";





use itrax\core\Database\db;
use itrax\core\Database\dbpdo;
use itrax\core\registry;
use itrax\core\validation;

registry::set("dbpdo", new dbpdo);
registry::set("db", new db);
registry::set("validation", new validation);

$app = new itrax\core\bootstrap;
