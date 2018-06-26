<?php
namespace Framework;

interface SqlResultInterface {


    public function getRecord();
    public function getRecords();
    public function nextRecord();
}