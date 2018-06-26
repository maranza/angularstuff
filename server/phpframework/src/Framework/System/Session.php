<?php
namespace Framework\System;
 class Session {

    private $session;
    /**
     * startup a session 
     * @throws exception if session not able to start 
     */
    public function __construct() {
        
        $this->session = session_start();
        if(!$this->session) {

            throw new \Exception('Failed to start Session');
        }    
        
    }

    /**
     * set a session key
     * @param key 
     * @param value to be set
     * @return void
     */
    public function __set($key,$value) {


        if(!array_key_exists($key,$_SESSION) ){

            $_SESSION[$key] = $value;
        } 
        
    }
    /**
     * gets a specific session key
     * @param key to get
     * @return void
     */
    public function __get($key) {

        if(array_key_exists($key,$_SESSION)) {

            return $_SESSION[$key];

        }
    }
    /**
     * @remove certain key from session
     * @param key key to be removed
     * @return void
     */
    public function remove($key) {

        if(array_key_exists($key,$_SESSION)){

            unset($_SESSION[$key]);
        }
    }
    /**
     * Generates new session key before destroying
     * @return void
     */
    public function destroy() {
        
        session_regenerate_id();
        session_destroy();
       

    }


}