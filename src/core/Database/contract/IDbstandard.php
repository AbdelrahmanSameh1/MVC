<?php

namespace itrax\core\Database\contract;


interface IDbstandard
{
    public function select($column);

    public function where($column, $compair, $value);

    public function andWhere($column, $compair, $value);

    public function orWhere($column, $compair, $value);

    public function join($tablename, $first, $second);

    public function getAll();

    public function getRow();

    public function insert($data);

    public function update($data);

    public function delete();

    public function excute();

    public function prepareData($data);

    public function query();

    public function showError();

    public function GetTableName();
}
