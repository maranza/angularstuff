<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Request-Headers: X-PINGOTHER, Content-Type');
header("Content-Type: application/json");
function executeQuery($conn,$query,$data = [] ) {
    $res = null;
    if(count($data) == 0)
    
        $res = pg_query($conn,$query);
    else {

        $res = pg_query_params($conn,$query,$data);
    }
    
    if(!$res) {

        throw new Exception('System Error try again');
    }
   return $res;
}
//addPatient
function addPatient($db_conn,$raw_json)
{
    
    executeQuery($db_conn,'BEGIN;');
    executeQuery($db_conn,'INSERT INTO patients(first_name,last_name,id_number) VALUES($1,$2,$3);',
    [$raw_json->{'firstName'},$raw_json->{'lastName'},$raw_json->{'IdNumber'}
    ]);
    executeQuery($db_conn,'COMMIT;');
    print json_encode(['success' => 'Patient Record Captured']);

}

//getPatients
function getPatients($db_conn) {

    $patients = [];

    $res = executeQuery($db_conn,'SELECT * FROM patients');

    while($row = pg_fetch_array($res)) {

        $patients[] = [ 
            'IdNumber' => $row['id_number'],
            'firstName' => $row['first_name'],
            'lastName' => $row['last_name']
        ];
    }
    print json_encode($patients);

}

//delete record
function deletePatient($db_conn,$raw_json) {
      
    $res = executeQuery($db_conn,'DELETE FROM patients WHERE id_number = $1',[$raw_json->{'IdNumber'}]);
    
    print json_encode(['success' => 'Delete Patient']);
    
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