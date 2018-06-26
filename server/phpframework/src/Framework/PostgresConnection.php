<?php
namespace Framework;
use Framework\DbConnectionInterface;
use Framework\PostgresResult;

class PostgresConnection  implements DbConnectionInterface {

    private $host = null;
    private $username = null;
    private $password = null;
    private $dbname = null;
    private $port = null;
    private $connection = null;

  /* @params 
   * setup postgres connection
   */
   public function __construct($host = 'localhost',$username = 'postgres',$password = 'root',$dbname = 'medical',$port = 5432) 
   {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->port = $port;

        $this->connect();
       
    }
    /*
    * connect postgres
    */
    private function connect() {
 
        $connectionString  = sprintf('host=%s port=%s dbname=%s user=%s password=%s',$this->host,$this->port,$this->dbname,$this->username,$this->password);
        
        $this->connection = pg_connect($connectionString);
   
        if(!$this->connection) {

            throw new \Exception('Failed to connect to PostgreSQL');

        }


    }

   //execute directly results returned 
   public function executeQuery($query)
   { 
        $result = null;
        $result = pg_query($this->connection,$query);
       
        if(!$result ) {

            throw new \Exception('Failed to Execute Query');
        }


        return new PostgresResult($result);

    
   }
   //executes prepared statement and returns Result
    public function preparedStatement($query,$paramValues = [])
    { 
        $result = null;
        $result =  pg_query_params($this->connection,$query,$paramValues);
        if(!$result ){

            throw new \Exception('Failed to execute Prepared Statement');
        }

        return new PostgresResult($result);
        
    }


    public function close() {


        if($this->connection !== null) {
           
            $success =  pg_close($this->connection);
             
            if(!$success) {

                throw new \Exception('Failed to Close Connection');

            }

        }
    }  

}