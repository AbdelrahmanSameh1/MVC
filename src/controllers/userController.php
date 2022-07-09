<?php

namespace itrax\controllers;

use itrax\core\controller;

class userController extends controller
{
    public function index($x, $y, $name)
    {
        // echo "mohamed amr";
        echo $x;
        echo $y;
        echo $name;
        return $this->view("test");
    }
}
