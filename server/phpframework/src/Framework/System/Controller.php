<?php
namespace Framework\System;
abstract class Controller 
{
    protected $registry ;
  
    public function __construct(Registry $registry) 
    {

        $this->registry = $registry;
    }
    /**
    * @return void
    */
    public function indexAction() 
    {
       print  json_encode('Welcome to Simple Api');
    }
    /**
    * set registry
    * @param Registry registry
    * @return void
    */
    public function __setRegistry(Registry $registry)
    {
        $this->registry = $registry;
    }
    /**
    * prerequest
    * @return void
    */
    public function preRequest() 
    {

        
    }

}