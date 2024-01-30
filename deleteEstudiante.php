<?php 

include_once 'db/conexion.php';

/* creamos la función if para verificar si existe datos en la tupla o fila */
if(isset($_GET['id_estudiante'])){
    $id_estudiante =(int) $_GET['id_estudiante'];

    /* consulta a la base de datos */
    $delete= $conn->prepare('DELETE FROM estudiantes WHERE id_estudiante=:id_estudiante');

    $delete->execute(array(':id_estudiante' => $id_estudiante ));
    header('location: listarEstudiante.php');
    }else{
        header('location: index.php');
    }


?>