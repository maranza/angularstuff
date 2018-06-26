<?php
namespace Framework;
use Framework\SqlResultInterface;
final class PostgresResult implements SqlResultInterface {

    private $pgResult = null;


    public function __construct($pgResult) {

        $this->pgResult = $pgResult;
       
    }

    
    //fetch records in associate array

    public function getRecords() {
  
        if(!$this->pgResult) {

            throw new \Exception('Query Result is not Valid');
        } 

        return pg_fetch_all($this->pgResult,PGSQL_ASSOC);
                

    }


    //fetch record in associate array

    public function getRecord() {

        if(!$this->pgResult) {

            throw new \Exception('Query Result is not Valid');
        } 

        return pg_fetch_array($this->pgResult,NULL,PGSQL_ASSOC);
                

    }

    //check if query is valid or not

    public function isValid() {

        
        return ($this->pgResult ? true : false);

    }

 
    public function nextRecord() {

        if(!$this->pgResult) {

            throw new \Exception('Query Result is not Valid');
        } 

        return pg_fetch_row($this->pgResult,NULL,PGSQL_ASSOC);
        
    }


}