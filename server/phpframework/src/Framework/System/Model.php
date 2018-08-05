<?php
namespace Framework\System;
use Framework\DbConnectionInterface;
abstract class Model {

    protected $dbConnection = null;

    /**
     * constructor
     * @param DbConnectionInterface dbConnection
     */
    public function __construct(DbConnectionInterface $dbConnection = null) {

        $this->dbConnection = $dbConnection;
    }
    /**
     * @param DbConnectionInterface Dbconnection
     */
    public function setDbConnection(DbConnectionInterface $dbConnection ) {

        $this->dbConnection = $dbConnection;
    }

    
}