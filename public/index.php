<?php

// we will recieve any request in this file... because we write that in (.htaccessfile)




// preaty url or clean url:
// categoryupdate.php?id=5     not clean
//category/update/5      this clean url





// $url = explode("/", $_GET['q']);

// // print_r($url);

// $classname = $url[0];
// $method = $url[1];
// $par = $url[2];

// echo $classname;





//========================================================


// echo "<pre>";
// print_r($_SERVER);

// $url = explode("/", $_SERVER['QUERY_STRING']);

// $classname = $url[0];
// $method = $url[1];
// $par = $url[2];

// echo $method;




//===============================================================


// note here is explanation of absolute path


// define('Controllers', 'src/controllers/');

// // require "src/controllers/userController.php";
// require Controllers . "userController.php";

// $user = new userController;

// $user->index();




//==============================================================================================

// here we will start the project
// here we use absolute path


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
// define('MVC', 'Session 21 mvc (from full stack diploma)');
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
require_once VENDOR . "autoload.php";     // this is the only require we will use in the project because we have used the composer autoloader



// use itrax\core\bootstrap as bootstrap;   // note this line
// use itrax\core\bootstrap;   // note this line
// echo __DIR__ . "<br>";    // note this



use itrax\core\Database\db;
use itrax\core\Database\dbpdo;
use itrax\core\registry;
use itrax\core\validation;

registry::set("dbpdo", new dbpdo);         // note the use of registry class
registry::set("db", new db);
registry::set("validation", new validation);

$app = new itrax\core\bootstrap;      // we write this because we have used (namespace)
