<?php
namespace App\Controllers;
use Framework\System\Controller;
use App\Models\PatientModel;
use Framework\System\Registry;
class PatientController extends Controller {
    private $patientModel;
    public function __construct(Registry $registry) {
        
        parent::__construct($registry);
        $database = $this->registry->get('database');
        $this->patientModel = new PatientModel($database);
        
    }
    
    public function addAction() {

        $request = $this->registry->get('request');
        $json = $request->getJsonInput();
       
        if(!array_key_exists('firstName',$json) || $json['firstName'] == '') {
              
            throw new \Exception('First Name is required');

        }

        if(!array_key_exists('lastName',$json) || $json['lastName'] == '') {
              
            throw new \Exception('Last Name is required');

        }
           
        if(!array_key_exists('IdNumber',$json) || $json['IdNumber'] == '') {
              
            throw new \Exception('ID Number is required');

        }

        $data = [$json['firstName'],$json['lastName'],$json['IdNumber']];
        $this->patientModel->add($data);
        print json_encode(['success' => 'Patient Record Captured']);
    }

    public function listAction() {
       
       print json_encode($this->patientModel->getList());

    }


    public function getAction() {

        $request = $this->registry->get('request');
        $json = $request->getJsonInput();

        if(!array_key_exists('uuid',$json)) {
              
            throw new \Exception('uuid is required');

        }
        
        $uuid = $json['uuid'];

        print json_encode([$this->patientModel->getById($uuid)]);
    }

    public function updateAction(){

        $data = [];
        $request = $this->registry->get('request');
        $json = $request->getJsonInput();

        if(array_key_exists('firstName',$json)) {

            if($json['firstName'] == '') {

                throw new \Exception('First Name cannot be blank');
            }
            $data['firstName'] = $json['firstName'];
        }

        if(array_key_exists('lastName',$json)) {

            if($json['lastName'] == '') {

                throw new \Exception('Last Name cannot be blank');
            }
            $data['lastName'] = $json['lastName'];
        }

        if(array_key_exists('IdNumber',$json)) {

            if($json['IdNumber'] == '') {

                throw new \Exception('Id Number cannot be blank');
            }
            $data['IdNumber'] = $json['IdNumber'];
        }

        if(!array_key_exists('uuid',$json)) {
              
            throw new \Exception('uuid is required');

        }
        $data['uuid'] = $json['uuid'];

        $this->patientModel->update($data);
        print json_encode(['success' => 'updated Patient']);
        
    }

    public function deleteAction() {

        $request = $this->registry->get('request');
        $json = $request->getJsonInput();

        if(!array_key_exists('uuid',$json)) {
              
            throw new \Exception('uuid is required');

        }
         
        $uuid = $json['uuid'];
        $this->patientModel->delete($uuid);
        print json_encode(['success ' => true]);

    }

    public function preRequest() {

        $session = $this->registry->get('session');

            if(!($session->username)) {

                throw new \Exception('Access Denied');
            }

    }

}