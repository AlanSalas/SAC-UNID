<?php 
    // Using Medoo namespace
require $_SERVER["DOCUMENT_ROOT"].'vendor/autoload.php';

use Medoo\Medoo;
 
// Initialize
try {
    $db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'proyecto-desarrollo',
    'server' => 'smoothoperators.com.mx',
    'username' => 'remote',
    'password' => 'D7AC3D58A7318',
    ]);
}catch (Exception $e){
    $db = null;
    echo 'ERROR: ',  $e->getMessage();

    }
        $user = "remote"; 
        $password = "D7AC3D58A7318"; 
        $server = "smoothoperators.com.mx"; 
        $database = "proyecto-desarrollo";

    $conn = new mysqli($server, $user, $password, $database);
    if ($conn->connect_errno) {
        echo "Falló la conexión a MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    $conn->set_charset("utf8")
    
?>