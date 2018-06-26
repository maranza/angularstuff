<?php
namespace Framework\System;
use Framework\DbConnectionInterface;
abstract class Model {

    protected $dbConnection = null;

      
    public function __construct(DbConnectionInterface $dbConnection = null) {

        $this->dbConnection = $dbConnection;
    }

    public function setDbConnection(DbConnectionInterface $dbConnection ) {

        $this->dbConnection = $dbConnection;
    }

    
}