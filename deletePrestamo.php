<?php 

include_once 'db/conexion.php';

/* creamos la función if para verificar si existe datos en la tupla o fila */
if(isset($_GET['id'])){
    $id =(int) $_GET['id'];

    /* consulta a la base de datos */
    $delete= $conn->prepare('DELETE FROM prestamos WHERE id_prestamo=:id');

    $delete->execute(array(':id' => $id ));
    header('location: listarPrestamo.php');
    }else{
        header('location: index.php');
    }


?>