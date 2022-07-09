<?php

// this file will handle the url and run the application

namespace itrax\core;

class bootstrap
{

    private $controller;
    private $method;
    private $params = [];

    public function __construct()
    {
        $this->url();
        $this->render();
    }

    private function url()
    {
        // print_r($_SERVER['QUERY_STRING']);die;

        $url = explode("/", $_SERVER['QUERY_STRING']);

        //controller
        $this->controller = !empty($url[0]) ? $url[0] : "home";
        // echo $this->controller;die;       // this line for debugging

        //method
        $this->method = !empty($url[1]) ? $url[1] : "index";
        // echo $this->method;die;

        //params
        unset($url[0], $url[1]);
        $this->params = array_values($url);
        // print_r($url);
    }

    private function render() // this function will bootstraping the project we can call it (bootstrap) if we want
    {
        $controller = "itrax\\controllers\\" . $this->controller . "Controller";    // note that because we used namespace

        // echo $this->controller;
        // echo $this->method;die;

        if (class_exists($controller)) {      // to find the class we need to use the autoloader... but here we will use the autoloader by the composer
            // echo $controller . "<br>";
            $controller = new $controller;
            if (method_exists($controller, $this->method)) {
                call_user_func_array([$controller, $this->method], $this->params);     // remember this function
            }
        }
    }
}
