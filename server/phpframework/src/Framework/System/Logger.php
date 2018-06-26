<?php
namespace Framework\System;

class Logger{

    private $handler ;

    public function __construct($logFileName = 'debug.log'){
        
        $this->handler = fopen('logs/'.$logFileName);

    }


    public function info() {



    }


    public function warning(){



    }






}