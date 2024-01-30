<?php 

include_once 'db/conexion1.php';
// verificar si existe información de manera POST
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $ciudad = $_POST['ciudad'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $clave = $_POST['clave'];
    $id_rol = $_POST['id_rol'];
    

    // Consulta a la base de datos

    $sql = " INSERT INTO usuarios(nombre,apellidos,direccion,telefono, email,ciudad,fechanacimiento, clave, id_rol) VALUES (?, ?, ? , ?, ?, ? ,? ,? ,?) ";
    $dato = $conn->prepare($sql);
    $dato ->bind_Param("ssssssssi",$nombre,$apellidos, $direccion,$telefono, $email,$ciudad, $fechanacimiento, $clave, $id_rol);
    
    if ($dato->execute()) {
        header("location: login.php");

    }else{
        echo "Error al registrarse" .$conn->error;
    }

    $dato->close();

}

$conn->close();


?>