<?php
namespace Framework;
interface SqlResultInterface 
{   
    /**
     * get a single record
     * @throws exception
     * @return array
     */
    public function getRecord();
    /**
     * get list of records
     * @throws exception
     * @return array
     */
    public function getRecords();
    /**
     * next record so it can be used in a loop
     * @throws exception
     * @return  array
     */
    public function nextRecord();
}