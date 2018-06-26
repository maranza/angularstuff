<?php
namespace Framework\System;
use Framework\RequestResult;
class Request {

    /**
     * Clean up the array values recursively 
     * @param array 
     */
    private function clean(&$array) 
    {

       
        foreach($array as $key => &$value) {
            
            if(is_array($value)) {

                clean($value);
            }
            else  {
                $array[$key] = trim($value); 
            }
        }

    }
    /**
     * @ get post data 
     * @ return post array
     */

    public function getPostInput() {


        $postInput = $_POST;
        $this->clean($postInput);
        return $postInput;

    }

    /**
     * get incoming json data and convert them to php array
     * @throws exception if failed to decode json
     * @return jsonInput
     */
    public function getJsonInput()
    {

        $jsonInput = json_decode(file_get_contents('php://input'),true);
        if(!$jsonInput) {

            throw new \Exception('Json failed to parse');
        }
        
        //clean up
        $this->clean($jsonInput);
        return $jsonInput;
          
    }


}