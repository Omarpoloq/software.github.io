<?php
$conexion=new mysqli("localhost","root","","adeind"); 


if($conexion->connect_error){
    die("Error al conectar a la base de datos" . $conexion->error);
}
?>