<?php
namespace Framework;

interface DbConnectionInterface {


    public function executeQuery($query);
    public function preparedStatement($query,$paramValues = []);
    public function close();
}