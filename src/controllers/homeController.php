<?php

namespace itrax\controllers;

use itrax\core\controller;
use itrax\core\validation;
use itrax\core\registry;
use itrax\models\instructorModel;

class homeController extends controller
{
    public function index()
    {

        // $db = new db;
        // // $db->insert("category", ['name' => 'tarek', 'id' => 100])->excu();
        // // $db->update("category", ['name' => 'done2', 'id' => 8])->where("id", "=", 9)->excu();
        // // $db->delete("category")->where("id", "=", 0)->excu();
        // echo "<pre>";
        // print_r($db->select("category", "id, name")->getAll());



        // the previous lines should be written in models not in controllers


        // I just call here the functions of the database which in the models folder

        $instructorModel = new instructorModel;
        echo "<pre>";
        print_r($instructorModel->GetAllInstructor());






        echo "<br><hr><br>";







        // $validation = new validation;
        // $validation->input("username");
        // print_r($validation->showError());






        echo "<br><hr><br>";




        // here we test registry class..... remember u need to put table name





        // $date = registry::get("db")->select("*")->getAll();    // here we use mysqli
        // $date2 = registry::get("dbpdo")->select("*")->getAll();  // here we use pdo
        // print_r($date);
        // print_r($date2);








        echo "<br><hr><br>";






        echo "home test";
        // return $this->view("home");
        return $this->view("index", ["title" => "mohamed"]);
    }






    public function store()
    {
        // print_r($_POST);die;
        $validation = new validation;

        // $validation->input("username")->integer();
        // $validation->input("username")->required()->max(5)->min(2);


        // $validation->input("username")->required()->email();
        registry::get("validation")->input("username")->required()->email();    // note here we use class validation without creating object... by using registry class

        // print_r($validation->showError());
        print_r(registry::get("validation")->showError());
    }
}
