

<?php
include_once 'db/conexion.php';
include_once 'vista/header.php';

// Inicializar la variable mensaje
$mensaje = "";

// consultar si existe el id dentro del registro a modificar
if(isset($_GET['id_autores'])){
  $id_autores=(int) $_GET['id_autores'];
  
  //consulta para obtener los datos de la tabla
  $buscar_id=$conn->prepare('SELECT * FROM autores WHERE id_autores=:id_autores LIMIT 1');

  $buscar_id->execute(array(':id_autores'=>$id_autores));  
  $autor=$buscar_id->fetch();
}
  
// verificar si existe datos en los campos
if(isset($_POST['btnRegistrar'])){
  $nombre_autor = $_POST['nombre_autor'];
  $apellidos_autor = $_POST['apellidos_autor'];
  $fechanacimiento = $_POST['fechanacimiento'];
  $descripcion = $_POST['descripcion'];
  $genero = $_POST['genero'];
  $nacionalidad = $_POST['nacionalidad'];
  //$id_autores=(int) $_GET['id_autores'];

  // verificar si existe información en los campos 
  if(!empty($nombre_autor) && !empty($apellidos_autor) && !empty($fechanacimiento) 
  && !empty($descripcion) && !empty($genero) && !empty($nacionalidad)){

  // consulta para insertar los valores a la base de datos
  $consulta_update=$conn->prepare('UPDATE autores SET 
  nombre_autor = :nombre_autor, 
  apellidos_autor =:apellidos_autor, 
  fechanacimiento =:fechanacimiento, 
  descripcion = :descripcion, 
  genero = :genero, 
  nacionalidad = :nacionalidad
  WHERE id_autores = :id_autores;');

  // ejecuta la consualta
  $consulta_update ->execute(array(
  ":nombre_autor"=>$nombre_autor,
  ":apellidos_autor"=>$apellidos_autor ,
  ":fechanacimiento"=>$fechanacimiento,
  ":descripcion"=>$descripcion,
  ":genero"=>$genero,
  ":nacionalidad"=>$nacionalidad,
  ":id_autores"=>$id_autores));
  
  if ($consulta_update) {
    // Mensaje de éxito con icono y alerta
    $mensaje = "<div style='background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                    <i class='fa fa-check-circle' style='color: #28a745; margin-right: 5px;'></i>
                    Autor actualizado correctamente
                </div>";
    
    // Redirección con JavaScript después de mostrar el mensaje
    echo "<script>
            setTimeout(function() {
                window.location.href = 'listarAutor.php';
            }, 2000); // Redirige después de 2 segundos (ajusta según sea necesario)
          </script>";
  } else {
      // Mensaje de error con icono y alerta
      $errorInfo = $consulta_update->errorInfo();
      $mensaje = "<div style='background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                      <i class='fa fa-times-circle' style='color: #721c24; margin-right: 5px;'></i>
                      Error al actualizar el Autor: " . $errorInfo[2] . "
                  </div>";
  }
  } else {
  // Mensaje de campos vacíos con icono y alerta
  $mensaje = "<div style='background-color: #fff3cd; border-color: #ffeeba; color: #856404; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                  <i class='fa fa-exclamation-triangle' style='color: #856404; margin-right: 5px;'></i>
                  Los campos están vacíos
              </div>";
  }
}


?>
    <div class="app-title">
      <h1> Editar Autores</h1>
    </div>

    <!-- Mostrar el mensaje -->
    <?php echo $mensaje;?>

    <div class="card ">
      <div class="card-header bg-dark text-white">Actualizar Autor</div>
      <form method="post">
        <div class="card-body">
          <div class="row">
              <div class="col-md-6">
                  <label for="">Nombre del Autor</label>
                  <input type="text" name="nombre_autor" class="form-control" required
                  value="<?php echo $autor['nombre_autor']; ?>">
                  <label for="">Apellido del Autor</label>
                  <input type="text" name="apellidos_autor" class="form-control" required
                  value="<?php echo $autor['apellidos_autor']; ?>">
                  <label for="">Fecha de Nacimiento</label>
                  <input type="date" name="fechanacimiento" class="form-control" required
                  value="<?php echo $autor['fechanacimiento']; ?>">
              </div>
              <div class="col-md-6">
                  <label for="">Descripcion</label>
                  <input type="text" name="descripcion" class="form-control" required
                  value="<?php echo $autor['descripcion']; ?>">
                  <label for="">Nacionalidad</label>
                  <input type="text" name="nacionalidad" class="form-control" required
                  value="<?php echo $autor['nacionalidad']; ?>">
                  
                  <label for="genero">Genero</label>            
                  <select name="genero" class="form-control" required>
                      <option value="" <?php if ($autor['genero'] == '') {
                                              echo 'selected';}?>>Seleccione</option>
                      <option value="F" <?php if ($autor['genero'] == 'F') {
                                              echo 'selected';}?>>Femenino</option>
                      <option value="M" <?php if ($autor['genero'] == 'M') {
                                              echo 'selected';}?>>Masculino</option>
                  </select>
              </div>
          </div>

        </div>
        <div class="card-footer text-white">
          <button type="submit" class="btn btn-success" name="btnRegistrar">Actualizar</button>
          <button type="reset"  class="btn btn-secondary" name="btnLimpiar">Limpiar</button>
        </div>
      </form>
    </div>

<?php 
include_once 'vista/footer.php';
?>
