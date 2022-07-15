<?php






namespace itrax\models;

use itrax\core\Database\dbpdo;


class instructorModel extends dbpdo
{

    // public $table = "category";




    public function GetAllInstructor()
    {
        // echo "add test" . "<br>";


        echo static::class;
        echo "<br>";
        // echo $this->GetTableName();
        $this->table =  $this->GetTableName();
        echo "<br>";

        return $this->select("*")->getAll();
    }
}
