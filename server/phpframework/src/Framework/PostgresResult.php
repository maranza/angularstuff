<?php
namespace Framework;
use Framework\SqlResultInterface;
final class PostgresResult implements SqlResultInterface {

    private $pgResult = null;
    /**
     * constructor
     * @param bool pgResult
     */
    public function __construct($pgResult) {

        $this->pgResult = $pgResult;
    }
    /**
     * @inhreit doc
    */
    public function getRecords() {

        if(!$this->pgResult) {

            throw new \Exception('Query Result is not Valid');
        } 
        //PHP <= 7 does not support pg_fetch_all
        if(PHP_VERSION_ID < 70118) {
            $assoc = [];
            while($row = pg_fetch_assoc($this->pgResult)){
                $assoc [] = $row;
            }
            return $assoc;
        }
        return pg_fetch_all($this->pgResult,PGSQL_ASSOC);
    }
      
    /**
     * @inhreit doc
    */
    public function getRecord() {
        if(!$this->pgResult) {

            throw new \Exception('Query Result is not Valid');
        } 
        $row  = pg_fetch_assoc($this->pgResult);
        return $row;           
    }
    /**
    * @inhreit doc
    */
    public function nextRecord() {
        if(!$this->pgResult) {
            throw new \Exception('Query Result is not Valid');
        } 
        return pg_fetch_assoc($this->pgResult);  
    }

}