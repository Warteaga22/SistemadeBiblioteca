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
header("Content-Disposition: attachment; filename=Informe_usuarios_".date('Y:m:d:m:s').".xls");
header("Pragma: no-cache");
header("Expires: 0");


// conexión

include_once '../db/conexion.php';


// consulta
$select = $conn->prepare('SELECT usuarios.*, rol FROM usuarios INNER JOIN roles ON usuarios.id_rol = roles.id_rol ORDER BY id_usuario ASC');
$select->execute();
$resultado = $select->fetchAll();
?>
<!-- cabecera de la tabla -->
<table border="1px">
        <tr class="head">
             <td>Id Usuario</td>
                      <td>Nombre</td>
                      <td>Apellidos</td>
                      <td>Direccion</td>
                      <td>Telefono</td>
                      <td>Correo</td>  
                      <td>Ciudad</td>
                      <td>Fecha de nacimiento</td>
                      <td>Rol</td>
                               
                            </tr>
           

    <!--  Resultados de el ingreso de información o de visualización de información 
        contenida en la base de datos
    -->
    <?php foreach($resultado as $fila): ?>
        <tr>
             <td><?php echo $fila['id_usuario'];?></td>
                      <td><?php echo $fila['nombre'];?></td>
                      <td><?php echo $fila['apellidos'];?></td>
                      <td><?php echo $fila['direccion'];?></td>
                      <td><?php echo $fila['telefono'];?></td>
                      <td><?php echo $fila['email'];?></td>
                      <td><?php echo $fila['ciudad'];?></td>
                      <td><?php echo $fila['fechanacimiento'];?></td>
                      <td><?php echo $fila['rol'];?></td>
                               
                            </tr>
        <?php endforeach ?>
    </table>

</body>
</html>