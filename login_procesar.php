<?php 

include_once 'db/conexion1.php';
// Verificamos si existe datos en POST
if($_SERVER['REQUEST_METHOD']== "POST"){
    $email = $_POST['email'];
    $clave = $_POST['clave'];

    // Consulta a la base de datos con los campos de ingreso

    $sql = "SELECT id_usuario, nombre, apellidos,clave FROM usuarios WHERE email = ? AND clave = ?";
    $dato = $conn->prepare($sql);
    $dato -> bind_param("ss",$email, $clave);
    $dato -> execute();
    $dato ->store_result();

    // Condicional para saber si existe datos y en caso de que si que muestre la información
    // de 1 regisro en tupla o de manera horizontal

    if($dato->num_rows == 1){
        $dato->bind_result($id,$nombre,$apellidos,$clave);
        $dato->fetch();

        session_start();
        $_SESSION['id_usuario']=$id;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellidos'] = $apellidos;
        $_SESSION['id_rol'] = $id_rol;
        header("location: index.php");
    }else{
        echo "<script>alert('Usuario no registrado')</script>";
    }
    $dato->close();

}

$conn->close();



?>