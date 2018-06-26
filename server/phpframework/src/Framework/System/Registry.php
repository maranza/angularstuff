<?php
namespace Framework\System;

class Registry{

    private $container = [];


    public function set($key,$value) {

        if( array_key_exists($key,$this->container) ){

            throw new Exception('Object already exists');
        } 

        $this->container[$key] = $value;
    }



    public function get($key) {
        
        if( !array_key_exists($key,$this->container)) {

            throw new Exception('Object does not exists');
        }
      
        return $this->container[$key];
    }

}