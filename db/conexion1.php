<?php 

$host = "localhost";
$usuario =  "root";
$contrasena = "";
$base_de_datos = "biblioteca_infocenter";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if($conn-> connect_error){
    die("Conexión fallida a la base de datos: ". $conn->connect_error);
}

?>