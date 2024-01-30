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
header("Content-Disposition: attachment; filename=Informe_biblioteca_".date('Y:m:d:m:s').".xls");
header("Pragma: no-cache");
header("Expires: 0");


// conexión

include_once '../db/conexion.php';


// consulta
$select = $conn->prepare('SELECT p.id_prestamo, p.fecha_prestamo, p.fecha_limite, p.fecha_entrega, dp.cantidad,
p.estado,CONCAT(e.nombres, " ", e.apellidos) AS estudiante, lb.titulo
FROM prestamos p
INNER JOIN estudiantes e ON p.id_estudiante = e.id_estudiante
LEFT JOIN detalle_prestamo dp ON dp.id_prestamo = p.id_prestamo
LEFT JOIN libros lb ON dp.id_libro = lb.id_libro
WHERE dp.id_prestamo IS NULL OR dp.id_prestamo IS NOT NULL');
$select->execute();
$resultado = $select->fetchAll();
?>
<!-- cabecera de la tabla -->
<table border="1px">
    <tr>
        <td>Id_Prestamo</td>
        <td>Fecha Prestamo</td>
        <td>Fecha Limite</td>
        <td>Fecha Entrega</td>
        <td>Cantidad</td>
        <td>Estado</td>
        <td>Estudiante</td>
        <td>Libro</td>
    </tr>

    <!--  Resultados de el ingreso de información o de visualización de información 
        contenida en la base de datos
    -->
    <?php foreach($resultado as $fila): ?>
    <tr>
        <td><?php echo $fila['id_prestamo'];?></td>
        <td><?php echo $fila['fecha_prestamo'];?></td>
        <td><?php echo $fila['fecha_limite'];?></td>
        <td><?php echo $fila['fecha_entrega'];?></td>
        <td><?php echo $fila['cantidad'];?></td>
        <td><?php echo $fila['estado'];?></td>
        <td><?php echo $fila['estudiante'];?></td>
        <td><?php echo $fila['titulo'];?></td>
    </tr>
    <?php endforeach ?>
    </table>

</body>
</html>