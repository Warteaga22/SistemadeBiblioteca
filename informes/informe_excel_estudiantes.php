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
header("Content-Disposition: attachment; filename=Informe_estudiantes_".date('Y:m:d:m:s').".xls");
header("Pragma: no-cache");
header("Expires: 0");


// conexión

include_once '../db/conexion.php';


// consulta
$select = $conn->prepare('SELECT * FROM estudiantes ORDER BY id_estudiante ASC');
$select->execute();
$resultado = $select->fetchAll();
?>
<!-- cabecera de la tabla -->
<table border="1px">
        <tr class="head">
        
            <td>Id_Estudiante</td>
            <td>Documento</td>
            <td>Nombre</td>
            <td>Apellidos</td>
            <td>Direccion</td>
            <td>Telefono</td>
            <td>Correo</td>
            <td>Fecha de Nacimiento</td>
            <td>Grado</td>
            
        </tr>
           

    <!--  Resultados de el ingreso de información o de visualización de información 
        contenida en la base de datos
    -->
    <?php foreach($resultado as $fila): ?>
        <tr>
            <td><?php echo $fila['id_estudiante'];?></td>
            <td><?php echo $fila['nro_documento'];?></td>
            <td><?php echo $fila['nombres'];?></td>
            <td><?php echo $fila['apellidos'];?></td>
            <td><?php echo $fila['direccion'];?></td>
            <td><?php echo $fila['telefono'];?></td>
            <td><?php echo $fila['email'];?></td>
            <td><?php echo $fila['fechanacimiento'];?></td>
            <td><?php echo $fila['grado'];?></td>
            
        </tr>
        <?php endforeach ?>
    </table>

</body>
</html>