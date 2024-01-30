<?php 

include_once 'db/conexion.php';

/* creamos la función if para verificar si existe datos en la tupla o fila */
if(isset($_GET['id_libro'])){
    $id_libro =(int) $_GET['id_libro'];

    /* consulta a la base de datos */
    $delete= $conn->prepare('DELETE FROM libros WHERE id_libro=:id_libro');

    $delete->execute(array(':id_libro' => $id_libro ));
    header('location: listarLibro.php');
    }else{
        header('location: index.php');
    }


?>