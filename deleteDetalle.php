<?php

include_once 'db/conexion.php';

/* creamos la función if para verificar si existe datos en la tupla o fila */
if(isset($_GET['id_detalle'])){
    $id_detalle =(int) $_GET['id_detalle'];

    /* consulta a la base de datos */
    $delete= $conn->prepare('DELETE FROM detalle_prestamo WHERE id_detalle=:id_detalle');


    $delete->execute(array(':id_detalle' => $id_detalle ));
    header('location: listarPrestamo.php');
    }else{
        header('location: index.php');
    }



?>