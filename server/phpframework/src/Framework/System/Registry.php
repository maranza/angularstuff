<?php
namespace Framework\System;
class Registry{
      
    private $container = [];
    /**
     * set object
     * @param string key
     * @param object value
     * @throws exception
     */
    public function set($key,$value) {

        if( array_key_exists($key,$this->container) ){

            throw new Exception('Object already exists');
        } 

        $this->container[$key] = $value;
    }
    /**
     * get object
     * @param string key
     * @throws exception
     * @return object
     */
    public function get($key) {
        
        if( !array_key_exists($key,$this->container)) {

            throw new Exception('Object does not exists');
        }
      
        return $this->container[$key];
    }

}