<?php


// this file will contain all operations of the insractur to the database

// here I will inherit (db file) which in the core folder to enable me to use its functions

namespace itrax\models;

use itrax\core\Database\dbpdo;


class instructorModel extends dbpdo
{

    // public $table = "category";    // we can write this ($this->table) in db class to avoid writing table name in each time (remember this way)


    // note that the file name should be contain the table name... remember that

    public function GetAllInstructor()
    {
        // echo "add test" . "<br>";


        echo static::class;      // note this line print the class namespace
        echo "<br>";
        // echo $this->GetTableName();
        $this->table =  $this->GetTableName();   // note that here we will get the name of the table
        echo "<br>";

        return $this->select("*")->getAll();
    }
}
