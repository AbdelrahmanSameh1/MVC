<?php


namespace itrax\core\Database;

use itrax\core\Database\contract\IDbstandard;
use Exception;      // note this 



class db implements IDbstandard
{
  public $connection;
  public $query;
  public $sql;
  protected $table;
  // protected $table = "instructor";   // here we was testing the registry class... comment this line

  public function __construct()
  {
    $this->connection = mysqli_connect("localhost", "root", "", "lms");
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
    while ($row = mysqli_fetch_assoc($this->query)) {
      $data[] = $row;
    }
    return $data;
  }

  public function getRow()
  {
    // echo $this->sql;die;    
    $this->query();
    $row = mysqli_fetch_assoc($this->query);
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

      if (mysqli_affected_rows($this->connection) > 0) {
        return true;
      }
    } catch (Exception $ex) {
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
    $this->query = mysqli_query($this->connection, $this->sql);
    // $connection->query("$this->sql");    
  }

  public function showError()
  {
    // return mysqli_error($this->connection);
    $errors = mysqli_error_list($this->connection);
    // print_r($errors);
    foreach ($errors as $error) {
      echo "<h2 style='color:red'>Error :</h2>" . $error['error'] . "<br> <h3 style='color:red'>Error Code : </h3>" . $error['errno'];
    }
  }


  public function GetTableName()
  {
    $classname = explode("\\", static::class);
    echo $classname[2];       // this is class name
    echo "<br>";
    echo $tablename = trim($classname[2], "Model");  // this is table name
    return $this->tabel = $tablename;
  }


  public function __destruct()
  {
    mysqli_close($this->connection);
  }
}
