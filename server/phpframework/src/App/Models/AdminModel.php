<?php
namespace App\Models;
use Framework\System\Model;
use Framework\PostgresConnection;
class AdminModel extends Model {

    
    public function authenticate($username,$password) {

        $query = 'SELECT password FROM admins WHERE username = $1';
        
        $row = $this->dbConnection->preparedStatement($query,[$username])->getRecord();
        if(count($row) > 0) {

            if(password_verify($password,$row['password'])){

                return true;
            }
            else
               return false;
        }
        return false;

    }
}