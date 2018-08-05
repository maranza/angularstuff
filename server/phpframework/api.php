<?php
use Framework\PostgresConnection;
use Framework\System\Registry;
use Framework\System\Session;
use Framework\System\Request;
require_once './vendor/autoload.php';

if (isset($_SERVER['HTTP_ORIGIN'])) 
{

    header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
}
else 
{
    header("Access-Control-Allow-Origin: *");
}
header('Access-Control-Allow-Methods: POST,GET,OPTIONS,DELETE,PUT');
header('Access-Control-Allow-Headers: Content-Type,withCredentials');
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json");
//register session
$session = new Session();
$controller = null;
$function = null;
$dbConnection = null;
try
{
    if (!isset($_GET['controller'])) 
    {

        throw new \Exception('Invalid Route'); 
    }
    else 
    {

        $controller = $_GET['controller'];
    }
    if (!isset($_GET['action'])) 
    {

        $function = 'indexAction';
    }
    else 
    {

        $function  = $_GET['action'].'Action';
    }
    
    //capitialize the controller 
    $capitalizeController = '\\App\Controllers\\'.ucfirst($controller).'Controller';

    //check if controller exists 
    if( !file_exists(__DIR__.'/src/App/Controllers/'.ucfirst($controller).'Controller.php')) {

        throw new Exception('Route does not exists');
    }

    $request = new Request();
    //establish Db Connection 
    $dbConnection = new PostgresConnection();
    //register services
    
    $registry = new Registry();
    $registry->set('database',$dbConnection);
    $registry->set('session',$session);
    $registry->set('request',$request);
    //initialize controller
    $controller  = new $capitalizeController($registry);
    //check if controller is instance of base Controller

    if(! $controller instanceof \Framework\System\Controller) 
    {

        throw new \Exception('Invalid Route');
    }
    //call middleware before the actual request
    $controller->preRequest();

    //reflect on the controller
    $reflection = new \ReflectionClass($controller);
    $method = $reflection->getMethod($function);
    //call controller method    
    $method->invoke($controller);
    
}

catch(\Exception $e) 
{

    print json_encode(['error' => $e->getMessage() ],true);
}

finally 
{

    if($dbConnection !=null )
    {
        $dbConnection->close();
    }
}
