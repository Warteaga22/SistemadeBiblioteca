<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe excel</title>
</head>
<body>
<?php
// Creamos dentro delas cabeceras archivos que nos trae el informe en excel

header("Content-type: application/xls");
header("Content-Disposition: attachment; filename=Informe_libros_".date('Y:m:d:m:s').".xls");
header("Pragma: no-cache");
header("Expires: 0");


// conexión

include_once '../db/conexion.php';


// consulta
$select = $conn->prepare('SELECT libros.*, CONCAT(nombre_autor, " ", apellidos_autor) AS autor FROM libros INNER JOIN autores ON libros.id_autores = autores.id_autores;');
$select->execute();
$resultado = $select->fetchAll();
?>
<!-- cabecera de la tabla -->
<table border="1px">
        <tr class="head">
             
            <td>Id_Libro</td>
            <td>Titulo</td>
            <td>Genero</td>
            <td>Numero de Paginas</td>
            <td>Editorial</td>
            <td>Fecha Publicacion</td>
            <td>ISBN</td>
            <td>Dewey</td>
            <td>Autor</td>
                
           </tr>
           

    <!--  Resultados de el ingreso de información o de visualización de información 
        contenida en la base de datos
    -->
    <?php foreach($resultado as $fila): ?>
        <tr>
             
            <td><?php echo $fila['id_libro'];?></td>
            <td><?php echo $fila['titulo'];?></td>
            <td><?php echo $fila['genero'];?></td>
            <td><?php echo $fila['num_paginas'];?></td>
            <td><?php echo $fila['editorial'];?></td>
            <td><?php echo $fila['fecha_publicacion'];?></td>
            <td><?php echo $fila['ISBN'];?></td>
            <td><?php echo $fila['Dewey'];?></td>
            <td><?php echo $fila['autor'];?></td>
                               
                            </tr>
        <?php endforeach ?>
    </table>

</body>
</html>