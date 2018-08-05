<?php
namespace App\Models;
use Framework\System\Model;
use Framework\PostgresConnection;
class PatientModel extends Model 
{

    /**
    * Get lists of patient records
    * @return void
    */
    public function getList() 
    {
        $query = 'SELECT * FROM patients_json';
        return $this->dbConnection->executeQuery($query)->getRecords();
    }

    /**
    * get a specific patient record
    * @param string uuid record id
    * @return array
    */

    public function getById($uuid) 
    {
        
        $query = 'SELECT * FROM patients_json WHERE uuid = $1';
        return $this->dbConnection->preparedStatement($query,array($uuid))->getRecord();
    }

    /**
    * Deletes a specific patient
    * @param uuid record id
    * @return bool
    */
    public function delete($uuid) 
    {
        $query = 'DELETE FROM patients WHERE uuid = $1';
        return $this->dbConnection->preparedStatement($query,array($uuid));
    }

    /**
    * Update the patient record
    * @param array $data
    * @return void
    */
    public function update(array $data) 
    {
        
        $query =  'UPDATE patients SET ';
        $params = [];
        if(isset($data['firstName'])) {
                
            $params [] = $data['firstName'];
            $query .= 'first_name = $'.count($params).','; 
        }
        if(isset($data['lastName'])) {
    
            $params [] = $data['lastName'];
            $query .= 'last_name = $'.count($params).','; 
        }
        if(isset($data['IdNumber'])) {

            $params [] = $data['IdNumber'];
            $query .= 'id_number = $'.count($params);
        }
        $params [] = $data['uuid'];
        $query .= ' WHERE uuid = $'.count($params);
        $this->dbConnection->preparedStatement($query,$params);
    }

    /**
    * add patient record
    * @param array of data
    * @throws Exception if failed to update record
    * @return void
    */
    public function add(array $data) 
    {
        $query = 'INSERT INTO patients(first_name,last_name,id_number) VALUES($1,$2,$3)';
        return $this->dbConnection->preparedStatement($query,$data);

    }
}