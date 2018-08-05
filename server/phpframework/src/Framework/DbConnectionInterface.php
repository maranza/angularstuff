<?php
namespace Framework;

interface DbConnectionInterface {
    /**
     * executes direct queries
     * @param string query
     * @throws exception
     * @return SqlResultInterface
     */
    public function executeQuery($query);
    /**
     * executes prepared statements
     * @param string query
     * @param array values to be inserted 
     * @throws exception
     * @return SqlResultInterface
     */
    public function preparedStatement($query,$paramValues = []);
    /**
     * closes the connection
     * @throws exception
     * @return SqlResultInterface
     */
    public function close();
}