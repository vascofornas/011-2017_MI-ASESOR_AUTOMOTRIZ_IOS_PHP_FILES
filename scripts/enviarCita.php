<?php


$nombre_usuario = htmlentities($_REQUEST["nombre_usuario"]);
$email_usuario = htmlentities($_REQUEST["email_usuario"]);
$tel_usuario = htmlentities($_REQUEST["tel_usuario"]);
$modelo = htmlentities($_REQUEST["modelo"]);
$ano = htmlentities($_REQUEST["ano"]);
$fecha = htmlentities($_REQUEST["fecha"]);
$hora = htmlentities($_REQUEST["hora"]);
$km = htmlentities($_REQUEST["km"]);
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
VALUES ('Tip izdelka (6)','Tip izdelka (6)','Tip izdelka (6)',
'Tip izdelka (6)','Tip izdelka (6)',
'Tip izdelka (6)','Tip izdelka (6)',
'Tip izdelka (6)','Tip izdelka (6)',
'Tip izdelka (6)','Tip izdelka (6)',
'Tip izdelka (6)')") 
or die(mysqli_error($link));
   



?>
