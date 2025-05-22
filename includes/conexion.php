<?php
$host="localhost";
$user="root";
$pass="";
$db="tinderempresarial";

$conexion = new mysqli($host, $user, $pass, $db);

if($conexion->connect_error){
    die("Error de conexion: " . $conexion->connect_error);
}
mysqli_set_charset($conexion, "utf8");
?>