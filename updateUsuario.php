<?php
include_once 'db/conexion.php';
include_once 'vista/header.php';

// Inicializar la variable mensaje
$mensaje = "";

//consulta para traer el rol
$sql = 'SELECT id_rol , rol FROM roles ORDER BY rol';

try {
  $lista = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
  die($exception->getMessage());
}

// consultar si existe el id dentro del registro a modificar
if(isset($_GET['id_usuario'])){
  $id_usuario=(int) $_GET['id_usuario'];
  
  //consulta para obtener los datos de la tabla
  $buscar_id=$conn->prepare('SELECT * FROM usuarios WHERE id_usuario=:id_usuario LIMIT 1');

  $buscar_id->execute(array(':id_usuario'=>$id_usuario));  
  $usuario=$buscar_id->fetch();
}
// verificar si existe datos en los campos
if(isset($_POST['btnRegistrar'])){
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $direccion = $_POST['direccion'];
  $telefono = $_POST['telefono'];
  $email = $_POST['email'];
  $ciudad = $_POST['ciudad'];
  $fechanacimiento = $_POST['fechanacimiento'];
  $clave = $_POST['clave'];
  $id_rol = $_POST['id_rol'];


  // verificar si existe información en los campos 
  if(!empty($nombre) && !empty($apellidos) && !empty($direccion) && !empty($telefono) && !empty($email) 
  && !empty($ciudad) && !empty($fechanacimiento) && !empty($clave) && !empty($id_rol)){
      
  // consulta para insertar los valores a la base de datos
  $consulta_update=$conn->prepare('UPDATE usuarios SET 
  nombre=:nombre,
  apellidos=:apellidos,
  direccion=:direccion,
  telefono=:telefono,
  email=:email,
  ciudad=:ciudad,
  fechanacimiento=:fechanacimiento,
  clave=:clave,
  id_rol=:id_rol
  WHERE id_usuario = :id_usuario;');

  // ejecuta la consualta
  $consulta_update->execute(array(
  ":nombre"=>$nombre,
  ":apellidos"=>$apellidos,
  ":direccion"=>$direccion,
  ":telefono"=>$telefono,
  ":email" =>$email,
  ":ciudad"=>$ciudad,
  ":fechanacimiento"=>$fechanacimiento,
  ":clave"=>$clave,
  ":id_rol"=>$id_rol,
  ":id_usuario"=>$id_usuario));
         
  if ($consulta_update) {
    // Mensaje de éxito con icono y alerta
    $mensaje = "<div style='background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                    <i class='fa fa-check-circle' style='color: #28a745; margin-right: 5px;'></i>
                    Usuario actualizado correctamente
                </div>";
    
    // Redirección con JavaScript después de mostrar el mensaje
    echo "<script>
            setTimeout(function() {
                window.location.href = 'listarUsuario.php';
            }, 2000); // Redirige después de 2 segundos (ajusta según sea necesario)
          </script>";
  } else {
      // Mensaje de error con icono y alerta
      $errorInfo = $consulta_update->errorInfo();
      $mensaje = "<div style='background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                      <i class='fa fa-times-circle' style='color: #721c24; margin-right: 5px;'></i>
                      Error al actualizar el Estudiante: " . $errorInfo[2] . "
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
          <h1> Editar Usuario</h1>
  </div>
  
  
  <!-- Mostrar el mensaje -->
  <?php echo $mensaje;?>

  <div class="card ">
    <div class="card-header bg-dark text-white">Actualizar Usuario</div>
      <form action="" method="post">
        <div class="card-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required
                    value="<?php echo $usuario['nombre']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" required
                    value="<?php echo $usuario['apellidos']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Fecha Nacimiento</label>
                    <input type="date" name="fechanacimiento" class="form-control" required
                    value="<?php echo $usuario['fechanacimiento']; ?>">
                </div>
                <div class="form-group">
                  <label for="">Direccion</label>
                  <input type="text" name="direccion" class="form-control" required
                  value="<?php echo $usuario['direccion']; ?>">
                </div>
              </div>
              
              <div class="col-md-6">
              <div class="form-group">
                  <label for="">Telefono</label>
                  <input type="text" name="telefono" class="form-control" required
                  value="<?php echo $usuario['telefono']; ?>">
                </div>
                <div class="form-group">
                  <label for="">Ciudad</label>
                  <input type="text" name="ciudad" class="form-control" required
                  value="<?php echo $usuario['ciudad']; ?>">
                </div>
                <div class="form-group">
                  <label for="">Correo Electronico</label>
                  <input type="text" name="email" class="form-control" required
                  value="<?php echo $usuario['email']; ?>">
                </div>
                <div class="form-group">
                  <label for="">Contraseña</label>
                  <input type="text" name="clave" class="form-control" required
                  value="<?php echo $usuario['clave']; ?>">
                </div>
              </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="">id_Rol</label>
                    <select name="id_rol" class="form-control" class="notItemOne" required>
                    <?php foreach ($lista as $rol) { ?>
                      <option value="<?= $rol['id_rol']; ?>" <?= (isset($usuario['id_rol']) && $usuario['id_rol'] == $rol['id_rol']) ? 'selected' : ''; ?>>
                            <?= $rol['rol']; ?>
                      </option>
                    <?php } ?>
                    </select>
                    
                </div>
                </div>
              </div>  
          </div>
        </div>
        
        <div class="card-footer text-white">
          <div class="form-group" text-align="center">
            <button type="submit" class="btn btn-success" name="btnRegistrar">Actualizar</button>
            <button type="reset"  class="btn btn-secondary" name="btnLimpiar">Limpiar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
        
    
<?php include_once 'vista/footer.php'; ?>

