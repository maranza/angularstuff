<?php
namespace Framework\System;
use Framework\System\Registry;
abstract class Controller {

    protected $registry ;
  
    public function __construct(Registry $registry) 
    {

        $this->registry = $registry;
    
    }

    public function indexAction() {

       print  json_encode('Welcome to Simple Api');
    }

    public function __setRegistry(Registry $registry){

        $this->registry = $registry;

    }
    public function preRequest() {

        
    }



}