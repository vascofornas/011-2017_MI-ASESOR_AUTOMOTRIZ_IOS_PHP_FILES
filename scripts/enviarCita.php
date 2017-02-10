<?php
require("../db/MySQLDAO.php");
$config = parse_ini_file('../../../SwiftPhp.ini');

$returnValue = array();
if(empty($_REQUEST["nombre_usuario"]))
{
    $returnValue["status"]="400";
    $returnValue["message"]="Missing required information";
    echo json_encode($returnValue);
    return;
}

$nombre_usuario = htmlentities($_REQUEST["nombre_usuario"]);
$email_usuario = htmlentities($_REQUEST["email_usuario"]);
$tel_usuario = htmlentities($_REQUEST["tel_usuario"]);
$modelo = htmlentities($_REQUEST[modelo"]);
$ano = htmlentities($_REQUEST["ano"]);
$fecha = htmlentities($_REQUEST["fecha"]);
$hora = htmlentities($_REQUEST["hora"]);
$km = htmlentities($_REQUEST["km"]);
$tipo = htmlentities($_REQUEST["tipo"]);
$taller = htmlentities($_REQUEST["taller"]);
$comentarios = htmlentities($_REQUEST["comentarios"]);
$emailAsesor = htmlentities($_REQUEST["emailAsesor"]);





$dbhost = trim($config["dbhost"]);
$dbuser = trim($config["dbuser"]);
$dbpassword = trim($config["dbpassword"]);
$dbname = trim($config["dbname"]);
 
$dao = new MySQLDAO($dbhost, $dbuser, $dbpassword, $dbname);
$dao->openConnection();
$userDetails =$dao->sendEmail($nombre_usuario_,$email_usuario,$tel_usuario,$modelo,$ano,$fecha,$hora,$km,$tipo,$taller,$comentarios,$emailAsesor);

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
    $returnValue["financiera"] = $userDetails["financiera"];
     $returnValue["auxilio_vial_mex"] = $userDetails["auxilio_vial_mex"];
     $returnValue["auxilio_vial_usa"] = $userDetails["auxilio_vial_usa"];
     $returnValue["app_store_agencia"] = $userDetails["app_store_agencia"];
       $returnValue["autos_nuevos"] = $userDetails["autos_nuevos"];
       $returnValue["email_taller"] = $userDetails["email_taller"];
    
    

} else {
    $returnValue["status"]="403";
    $returnValue["message"]="Agencia no encontrada";
    echo json_encode($returnValue);
    return;
}

$dao->closeConnection();

echo json_encode($returnValue);

?>
