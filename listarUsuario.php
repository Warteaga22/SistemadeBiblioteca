<?php
include_once 'db/conexion.php';
include_once 'vista/header.php';

$select = $conn->prepare('SELECT usuarios.*, rol FROM  usuarios INNER JOIN roles ON usuarios.id_rol = roles.id_rol ;');
$select->execute();
$resultado = $select->fetchAll();
?>

  <div class="app-title">
    <h1> Listado de Usuarios</h1>
  </div>

  <!-- creación de los campos de la labla a visualizar-->
  <!-- <div class="col-lg-12"> -->
    <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
              <!-- <a href="../informes/informe_excel_usuarios.php" class="btn btn-primary btn-sm" class="btn_update" title=""><i class="fa fa-file-excel-o">Descargar en Excel</a></i>
              <hr> -->
              <table class="table table-light mt-4 table-striped table-bordered" id="tblUsuarios" style="width:100%">
                <thead>
                  <tr class="head">
                      <td>Id</td>
                      <td>Nombre</td>
                      <td>Apellidos</td>
                      <td>Direccion</td>
                      <td>Telefono</td>
                      <td>Correo</td>
                      <td>Ciudad</td>
                      <td>Fecha de nacimiento</td>
                      <td>Rol</td>
                      <td>Acciones</td>
                  </tr>
                </thead>
                  <!--  Resultados de el ingreso de información o de visualización de información 
                  contenida en la base de datos
                  -->
                  <?php foreach($resultado as $fila): ?>
                  <tbody>
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
                      <td>
                      <a href="updateUsuario.php?id_usuario=<?php echo $fila['id_usuario']?>" class="btn btn-primary btn-sm" class="btn_update" title="Editar"><i class="fa fa-edit"></a></i>
                      <a href="deleteUsuario.php?id_usuario=<?php echo $fila['id_usuario']?>" class="btn btn-danger btn-sm" class="btn_delete" title="Eliminar"><i class="fa fa-trash"></a></i>
                      </td>
                  </tr>
                  </tbody>
                  <?php endforeach ?>
              </table>
          </div>
        </div>
    </div>
  <!-- </div> -->



<?php 
include_once 'vista/footer.php';
?>