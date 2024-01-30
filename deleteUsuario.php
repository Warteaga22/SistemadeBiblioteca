<?php 

include_once 'db/conexion.php';

/* creamos la función if para verificar si existe datos en la tupla o fila */
if(isset($_GET['id_usuario'])){
    $id_usuario =(int) $_GET['id_usuario'];

    /* consulta a la base de datos */
    $delete= $conn->prepare('DELETE FROM usuarios WHERE id_usuario=:id_usuario');

    $delete->execute(array(':id_usuario' => $id_usuario ));
    header('location: listarUsuario.php');
    }else{
        header('location: index.php');
    }


?>