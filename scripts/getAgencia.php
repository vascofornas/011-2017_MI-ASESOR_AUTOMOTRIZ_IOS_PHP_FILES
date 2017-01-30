<?php
require("../db/MySQLDAO.php");
$config = parse_ini_file('../../../SwiftPhp.ini');

$returnValue = array();
if(empty($_REQUEST["nombreAgencia"]))
{
    $returnValue["status"]="400";
    $returnValue["message"]="Missing required information";
    echo json_encode($returnValue);
    return;
}

$nombreAgencia = htmlentities($_REQUEST["nombreAgencia"]);



$dbhost = trim($config["dbhost"]);
$dbuser = trim($config["dbuser"]);
$dbpassword = trim($config["dbpassword"]);
$dbname = trim($config["dbname"]);
 
$dao = new MySQLDAO($dbhost, $dbuser, $dbpassword, $dbname);
$dao->openConnection();
$userDetails =$dao->getNombreAgencia($nombreAgencia);

if(empty($userDetails))
{
    $returnValue["status"]="403";
    $returnValue["message"]="Agencia no encontrada.";
    echo json_encode($returnValue);
    return;   
}



if(!empty($userDetails))
{
    $returnValue["status"]="200";
    $returnValue["nombre_agencia"] = $userDetails["nombre_agencia"];
    $returnValue["codigo_agencia"] = $userDetails["codigo_agencia"];
    $returnValue["direccion_agencia"] = $userDetails["direccion_agencia"];
    $returnValue["id_agencia"] = $userDetails["id_agencia"];
} else {
    $returnValue["status"]="403";
    $returnValue["message"]="Agencia no encontrada";
    echo json_encode($returnValue);
    return;
}

$dao->closeConnection();

echo json_encode($returnValue);

?>