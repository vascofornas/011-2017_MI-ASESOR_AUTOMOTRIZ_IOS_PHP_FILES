<?php


$nombre_usuario = $_POST['a'];
$email_usuario = $_POST['b'];
$tel_usuario = $_POST['c'];
$modelo = $_POST['d'];
$ano = $_POST['e'];

$km = $_POST['f'];
$fecha = htmlentities($_REQUEST["fecha"]);
$hora = htmlentities($_REQUEST["hora"]);

$tipo = htmlentities($_REQUEST["tipo"]);
$taller = htmlentities($_REQUEST["taller"]);
$comentarios = htmlentities($_REQUEST["comentarios"]);
$emailAsesor = htmlentities($_REQUEST["emailAsesor"]);


    $host='localhost';
    $user='miasesor_app';
     $db='miasesor_app';
    $password='';

$link = mysqli_connect("localhost","miasesor_app","Papa020432","miasesor_app");

mysqli_query($link,"INSERT INTO tb_citas_servicio (`nombre_cliente`,`email_cliente`,`cel_cliente`,
`modelo`,`ano`,
`kilometros`,`tipo`,
`fecha`,`hora`,
`comentarios`,`codigo`,
`agencia_cita`)
VALUES ('$nombre_usuario','$email_usuario','$tel_usuario',
'$modelo','$ano',
'$km ,'Tip izdelka (6)',
'Tip izdelka (6)','Tip izdelka (6)',
'Tip izdelka (6)','Tip izdelka (6)',
'Tip izdelka (6)')") 
or die(mysqli_error($link));
   
echo 'Successfully addedlo.'.$km;


?>
