<?php
  include_once 'db/conexion.php';

  // Inicializar la variable mensaje
  $mensaje = "";

  // verificar si existe datos en lso campos
  if(isset($_POST['btnRegistrar'])){
    $nombre_autor = $_POST['nombre_autor'];
    $apellidos_autor = $_POST['apellidos_autor'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $descripcion = $_POST['descripcion'];
    $genero = $_POST['genero'];
    $nacionalidad = $_POST['nacionalidad'];

    // verificar si existe información en los campos 
    if(!empty($nombre_autor) && !empty($apellidos_autor) && !empty($fechanacimiento) 
    && !empty($descripcion) && !empty($genero) && !empty($nacionalidad)){
    
    // consulta para insertar los valores a la base de datos
    $consulta_insert=$conn->prepare('INSERT INTO autores (nombre_autor, apellidos_autor, fechanacimiento, descripcion, genero, nacionalidad) 
    VALUES (:nombre_autor,:apellidos_autor,:fechanacimiento,:descripcion,:genero, :nacionalidad)');

    // ejecuta la consualta
    $consulta_insert ->execute(array(
    ":nombre_autor"=>$nombre_autor,
    ":apellidos_autor"=>$apellidos_autor,
    ":fechanacimiento"=>$fechanacimiento,
    ":descripcion"=>$descripcion,
    ":genero"=>$genero,
    ":nacionalidad"=>$nacionalidad));


    if ($consulta_insert) {

      // Mensaje de éxito con icono y alerta
      $mensaje = "<div style='background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                      <i class='fa fa-check-circle' style='color: #28a745; margin-right: 5px;'></i>
                      Autor creado correctamente
                  </div>";
      
      // Redirección con JavaScript después de mostrar el mensaje
      echo "<script>
              setTimeout(function() {
                  window.location.href = 'listarAutor.php';
              }, 2000); // Redirige después de 2 segundos (ajusta según sea necesario)
            </script>";
      } else {
          // Mensaje de error con icono y alerta
          $errorInfo = $consulta_insert->errorInfo();
          $mensaje = "<div style='background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                          <i class='fa fa-times-circle' style='color: #721c24; margin-right: 5px;'></i>
                          Error al crear el libro: " . $errorInfo[2] . "
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

include_once 'vista/header.php';
?>
    
    <div class="app-title">
       <h1> Crear Autores</h1>
    </div>

    <!-- Mostrar el mensaje -->
    <?php echo $mensaje;?> 
       
    <div class="card ">
          <div class="card-header bg-dark text-white">Ingresar Autor</div>
          <form method="post">
          <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Nombre del Autor</label>
                    <input type="text" name="nombre_autor" class="form-control" required>
                    <label for="">Apellido del Autor</label>
                    <input type="text" name="apellidos_autor" class="form-control" required>
                    <label for="">Fecha de Nacimiento</label>
                    <input type="date" name="fechanacimiento" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="">Descripcion</label>
                    <input type="text" name="descripcion" class="form-control" required>
                    <label for="">Nacionalidad</label>
                    <input type="text" name="nacionalidad" class="form-control" required>
                    
                    <label for="genero">Genero</label>            
                    <select name="genero" class="form-control" required>
                        <option selected="selected" value="">Seleccione</option>
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
                        
                    </select>
                </div>
            </div>

          </div>
          <div class="card-footer text-white">
          <button type="submit" class="btn btn-primary" name="btnRegistrar">Registrar</button>
          <button type="reset"  class="btn btn-secondary" name="btnLimpiar">Limpiar</button>
        </div>
          </form>
        </div>
        
   
    
<?php 
include_once 'vista/footer.php';
?>
