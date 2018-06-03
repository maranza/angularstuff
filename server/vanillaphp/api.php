<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {

    header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
}
else {
    header("Access-Control-Allow-Origin: *");
}
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type,withCredentials');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Request-Headers: X-PINGOTHER, Content-Type');
header("Content-Type: application/json");
session_start();
function executeQuery($conn,$query,$data = [] ) {
    $res = null;
    if(count($data) == 0) {
    
        $res = pg_query($conn,$query);
    }
    else {

        $res = pg_query_params($conn,$query,$data);
    }
    
    if(!$res) {

        throw new Exception('System Error try again');
    }
   return $res;
}


//login
function login($conn,$raw_json) {

    $username = validate('username',$raw_json->{'username'});
    $password = validate('password',$raw_json->{'password'});
    $res = executeQuery($conn,'SELECT username,password FROM admins WHERE LOWER(username) = LOWER($1)',[$username]);

    $single_row = pg_fetch_array($res);

    if(password_verify($password,$single_row['password'])) {
        
        $_SESSION['username'] = $single_row['username']; 
        print json_encode(['success' => true]);

    }
    else {

        print json_encode(['success' => false]);
    }

}

function loggedIn() {

    if(!isset($_SESSION['username'])) {

       print json_encode(['success' => false]);
    }
    else {

         print json_encode(['success' => true]);

    }

}

function logout() {

    session_destroy();
    print json_encode(['success' => true]);

}
function validate($name,$value) {

    if(empty(trim($value))) {
        throw new Exception($name .' cannot be blank');
    }

    return $value;
}
//addPatient
function addPatient($db_conn,$raw_json)
{
    if ( ! isset($_SESSION['username']) ) {
    
        throw new Exception('Access Denied');
    }
    $name = validate('Name',$raw_json->{'firstName'});
    $last_name = validate('Last Name',$raw_json->{'lastName'});
    $id_number = validate('Id Number',$raw_json->{'IdNumber'});

    executeQuery($db_conn,'START TRANSACTION');
    executeQuery($db_conn,'INSERT INTO patients(first_name,last_name,id_number) VALUES($1,$2,$3);',
    [$name,$last_name,$id_number]);
    executeQuery($db_conn,'COMMIT TRANSACTION;');
    print json_encode(['success' => 'Patient Record Captured']);

}

//getPatients
function getPatients($db_conn) {
    
    if ( ! isset($_SESSION['username']) ) {
    
        throw new Exception('Access Denied');
    }

    $patients = [];

    $res = executeQuery($db_conn,'SELECT * FROM patients');

    while($row = pg_fetch_array($res)) {

        $patients[] = [ 
            'IdNumber' => $row['id_number'],
            'firstName' => $row['first_name'],
            'lastName' => $row['last_name'],
            'uuid' => $row['uuid']
        ];
    }
    print json_encode($patients);
}
//
function updatePatient($db_conn, $raw_json) {
    
    if ( ! isset($_SESSION['username']) ) {
    
        throw new Exception('Access Denied');
    }
    $first_name = validate('Name',$raw_json->{'firstName'});
    $last_name = validate('Last Name',$raw_json->{'lastName'});
    $id_number = validate('Id Number',$raw_json->{'IdNumber'});
    $uuid = validate('uuid',$raw_json->{'uuid'});

    executeQuery($db_conn,'START TRANSACTION;');
    $query = 'UPDATE patients SET first_name=$1, last_name=$2, id_number=$3 WHERE uuid = $4';
    $res = executeQuery($db_conn,$query,[$first_name,$last_name,$id_number, $uuid]);
    executeQuery($db_conn,'COMMIT TRANSACTION;');

    if($res){
        print json_encode(['success' => 'updated Patient']);
    }
    




}


//get patient record
function getPatient($db_conn,$raw_json) {
    
    if ( ! isset($_SESSION['username']) ) {
    
        throw new Exception('Access Denied');
    }

    $patient = [];
    $uuid = validate('uuid',$raw_json->{'uuid'});
    $res = executeQuery($db_conn,'SELECT * FROM patients WHERE uuid = $1',[$uuid]);

    while($row = pg_fetch_array($res)) {

        $patient[] = [ 
            'IdNumber' => $row['id_number'],
            'firstName' => $row['first_name'],
            'lastName' => $row['last_name'],
            'uuid' => $row['uuid']
        ];
    }
    print json_encode($patient);

}

//delete record
function deletePatient($db_conn,$raw_json) {
    
    if ( !isset($_SESSION['username']) ) {
    
        throw new Exception('Access Denied');
    }
    $uuid = validate('uuid',$raw_json->{'uuid'});
    $res = executeQuery($db_conn,'DELETE FROM patients WHERE uuid = $1',[$uuid]);
    
    print json_encode(['success' => 'Deleted Patient']);
    
}


$conn = pg_connect("host=localhost user=postgres port=5432 dbname=medical password=root");
if(!$conn) {
    die(json_encode(['error' => 'System Error Try again later']));
}

if($_SERVER['REQUEST_METHOD'] == 'POST') { 
    try{

        $raw_json = json_decode(file_get_contents("php://input"));
    
        if( isset($_GET['callback'] )) {
            
            $call_back = trim($_GET['callback']);

            $reflection = new ReflectionFunction($call_back);
            $reflection->invoke($conn,$raw_json);

        }
        else {
            throw new Exception("No Method Supplied");
        }
        
    }
    catch(Exception $e) {
 
        print json_encode(['error' => $e->getMessage()]);
        
    }
    finally{
        
        pg_close($conn);
        $conn = null;
    }
    
}
else {
    print json_encode(['error' => 'Only Post Request Allowed']);
}