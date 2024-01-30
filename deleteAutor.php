<?php 

include_once 'db/conexion.php';

/* creamos la función if para verificar si existe datos en la tupla o fila */
if(isset($_GET['id_autores'])){
    $id_autores =(int) $_GET['id_autores'];

    /* consulta a la base de datos */
    $delete= $conn->prepare('DELETE FROM autores WHERE id_autores=:id_autores');

    $delete->execute(array(':id_autores' => $id_autores ));
    header('location: listarAutor.php');
    }else{
        header('location: index.php');
    }


?>