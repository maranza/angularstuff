<?php
namespace App\Controllers;
use Framework\System\Controller;
use Framework\System\Registry;
use App\Models\AdminModel;
class AuthenticateController extends Controller 
{   
    /**
     * login action
     * @throws exception
     * @return void
     */
    public function loginAction() 
    {
        $database = $this->registry->get('database');
        $request = $this->registry->get('request');
        $admin  = new AdminModel($database);
        $postInput = $request->getJsonInput();
        //Validates the user details
        if(!array_key_exists('username',$postInput) || $postInput['username'] == '') 
        {
            throw new \Exception('Username is required');
        }
        
        if(!array_key_exists('password',$postInput) || $postInput['password'] == '') 
        {
            throw new \Exception('password is required');
        }

        $username = $postInput['username'];
        $password = $postInput['password'];
        if( $admin->authenticate($username,$password) ) 
        {
            $session = $this->registry->get('session');
            $session->username = 'admin';
            print json_encode(['success' => true]);
        }
        else 
        {
            throw new \Exception('Invalid Credentials');
        }
    }
 
    /**
    * logout the user
    * @throws exception
    * @return void
    */
    public function logoutAction() 
    {
        $session = $this->registry->get('session');
        $session->destroy();
        print json_encode(['success' => true]);
    }
}