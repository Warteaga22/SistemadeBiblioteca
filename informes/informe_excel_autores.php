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
header("Content-Disposition: attachment; filename=Informe_autores_".date('Y:m:d:m:s').".xls");
header("Pragma: no-cache");
header("Expires: 0");


// conexión

include_once '../db/conexion.php';


// consulta
$select = $conn->prepare('SELECT * FROM  autores ORDER BY id_autores;');
$select->execute();
$resultado = $select->fetchAll();
?>
<!-- cabecera de la tabla -->
<table border="1px">
        <tr class="head">
             
            <td>Id_Autor</td>
            <td>Nombre</td>
            <td>Apellidos</td>
            <td>Fecha Nacimiento</td>
            <td>Descripcion</td>
            <td>Genero</td>
            <td>Nacionalidad</td>
                
           </tr>
           

    <!--  Resultados de el ingreso de información o de visualización de información 
        contenida en la base de datos
    -->
    <?php foreach($resultado as $fila): ?>
        <tr>
             
            <td><?php echo $fila['id_autores'];?></td>
            <td><?php echo $fila['nombre_autor'];?></td>
            <td><?php echo $fila['apellidos_autor'];?></td>
            <td><?php echo $fila['fechanacimiento'];?></td>
            <td><?php echo $fila['descripcion'];?></td>
            <td><?php echo $fila['genero'];?></td>
            <td><?php echo $fila['nacionalidad'];?></td>
                               
                            </tr>
        <?php endforeach ?>
    </table>

</body>
</html>