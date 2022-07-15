<?php

// here we convert the last mysqli class to pdo class

namespace itrax\core\Database;

use itrax\core\Database\contract\IDbstandard;
use PDO;
use Exception;


class dbpdo implements IDbstandard
{
    public $query;
    public $sql;
    protected $table;
    // protected $table = "instructor"; 


    protected $connection;
    private $dsn = "mysql:host=localhost;dbname=lms;charset=UTF8";


    public function __construct()
    {
        // $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       // here we set an attribute... this line show some errors if there is an errors
        $this->connection = new PDO($this->dsn, "root", "");        // pdo way
    }





    // first: we will make the select in the database rubber

    public function select($column)
    {
        $this->sql = "SELECT $column FROM `$this->table`";
        return $this;
    }

    public function where($column, $compair, $value)
    {
        $this->sql .= " WHERE $column $compair '$value'";
        // echo $this->sql;die;    
        return $this;
    }
    public function andWhere($column, $compair, $value)
    {
        $this->sql .= " AND `$column` $compair '$value'";
        // echo $this->sql;die;    
        return $this;
    }
    public function orWhere($column, $compair, $value)
    {
        $this->sql .= " OR `$column` $compair '$value'";
        // echo $this->sql;die;    
        return $this;
    }

    public function join($tablename, $first, $second)
    {
        $this->sql .= " INNER JOIN $tablename ON $first = $second";
        return $this;
    }


    public function getAll()
    {
        $this->query();
        // echo $this->sql;die;    
        // while ($row = mysqli_fetch_assoc($this->query)) {    // mysqli way
        //     $data[] = $row;
        // }

        $data = $this->query->fetchAll(pdo::FETCH_ASSOC);       // pdo way
        return $data;
    }

    public function getRow()
    {
        // echo $this->sql;die;    
        $this->query();
        // $row = mysqli_fetch_assoc($this->query);     // mysqli way
        $row = $this->query->fetch(pdo::FETCH_ASSOC);       // pdo way
        return $row;
    }







    // second: we will make the insert in the database rubber

    public function insert($data)
    {
        $row = $this->prepareData($data);

        $this->sql = "INSERT INTO `$this->table` SET $row";
        // echo $this->sql;die;   

        return $this;
    }










    //third: we will make the update in the database rubber

    public function update($data)
    {
        $row = $this->prepareData($data);
        $this->sql = "UPDATE `$this->table` SET $row";
        // echo $this->sql;die;
        return $this;
    }







    //fourth: we will make the update in the database rubber


    public function delete()
    {
        $this->sql = "DELETE FROM `$this->table`";
        return $this;
    }

    public function excute()
    {
        try {
            $this->query();
            // if (mysqli_affected_rows($this->connection) > 0) {   // mysqli way 
            //     return true;
            // }
            if ($this->query->rowCount() > 0) {    // pdo way
                // echo "no error to u";
                return true;
            }
        } catch (Exception $ex) {
            // echo "error to u";       
            // echo $ex->getMessage();
            return $this->showError();
        }
    }


    public function prepareData($data)
    {

        // echo "<pre>";
        // print_r($data);
        // die;
        // echo "</pre>";

        $row = "";
        foreach ($data as $key => $value) {
            $row .= " `$key` = " . ((gettype($value) == 'string') ? "'$value'" : "$value") . ",";
        }
        $row = rtrim($row, ",");
        // echo $row;die;
        return  $row;
    }


    public function query()
    {
        // echo $this->sql;die;
        // $this->query = mysqli_query($this->connection, $this->sql);     // mysqli

        $this->query = $this->connection->query($this->sql);      // pdo

        // $connection->query("$this->sql");    
    }

    public function showError()
    {
        // mysqli_connect_error();       
        // mysqli_connect_errno();       

        // return mysqli_error($this->connection);
        // $errors = mysqli_error_list($this->connection);      // mysqli way

        $errors = $this->connection->errorInfo();           // pdo way

        // echo "<pre>";
        // print_r($errors);die;
        // foreach ($errors as $error) {
        echo "<h2 style='color:red'>The Error is :</h2>" . $errors[2] . "<br> <h3 style='color:red'>The Error Code is : </h3>" . $errors[1];
        // }
    }


    public function GetTableName()
    {
        $classname = explode("\\", static::class);
        echo $classname[2];       // this is class name
        echo "<br>";
        echo $tablename = trim($classname[2], "Model");  // this is table name
        return $this->tabel = $tablename;
    }

    public function __destruct()        // we use the destruct to close the connection at the end of any object usage
    {
        // mysqli_close($this->connection);      // mysqli way
        $this->connection = null;        // pdo way
    }
}
