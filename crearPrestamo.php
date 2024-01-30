  <?php

    include_once 'db/conexion.php';
    include_once 'vista/header.php';

    // Inicializar la variable mensaje
    $mensaje = "";

    // Consulta para traer el estudiante
    $sql_estudiante = 'SELECT id_estudiante , CONCAT(nombres, " ",apellidos) AS estudiante FROM estudiantes ORDER BY estudiante';

    try {
      $lista_estudiante = $conn->query($sql_estudiante)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
      die($exception->getMessage());
    }
    
     // Consulta para traer el usuario
    $sql_usuario = 'SELECT id_usuario ,CONCAT(nombre, " ",apellidos) AS elusuario FROM usuarios ORDER BY elusuario';

    try {
      $lista_usuario = $conn->query($sql_usuario)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
      die($exception->getMessage());
    }

    // Consulta para traer el libro
    $sql_libro = 'SELECT id_libro ,titulo FROM libros ORDER BY titulo';

    try {
      $lista_libro = $conn->query($sql_libro)->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
      die($exception->getMessage());
    }

  if(isset($_POST['btnRegistrar'])){
      $fecha_prestamo = $_POST['fecha_prestamo'];
      $fecha_limite=$_POST['fecha_limite'];
      $estado_prestamo = $_POST['estado'];
      $id_usuario = $_POST['id_usuario'];
      $id_estudiante = $_POST['id_estudiante'];

    
      // verificar si existe información en los campos 
      if(!empty($fecha_prestamo) && !empty($fecha_limite)  && !empty($estado_prestamo) && !empty($id_usuario) && !empty($id_estudiante)){
      
      // consulta para insertar los valores a la base de datos
      $consulta_insert=$conn->prepare('INSERT INTO prestamos (fecha_prestamo, fecha_limite, 
      estado, id_usuario, id_estudiante) 
      VALUES (:fecha_prestamo, :fecha_limite, :estado, :id_usuario, :id_estudiante)');
    
      // ejecuta la consualta
      $consulta_insert ->execute(array(
      ":fecha_prestamo"=>$fecha_prestamo,
      ":fecha_limite"=>$fecha_limite,
      ":estado"=>$estado_prestamo,
      ":id_usuario"=>$id_usuario,
      ":id_estudiante"=>$id_estudiante
      ));
      
      if ($consulta_insert) {

        // Mensaje de éxito con icono y alerta
        $mensaje = "<div style='background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                        <i class='fa fa-check-circle' style='color: #28a745; margin-right: 5px;'></i>
                        Prestamo creado correctamente
                    </div>";
        
        // Redirección con JavaScript después de mostrar el mensaje
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'listarPrestamo.php';
                }, 2000); // Redirige después de 2 segundos (ajusta según sea necesario)
                </script>";
        } else {
        // Mensaje de error con icono y alerta
        $errorInfo = $consulta_insert->errorInfo();
        $mensaje = "<div style='background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                        <i class='fa fa-times-circle' style='color: #721c24; margin-right: 5px;'></i>
                        Error al crear el Prestamo: " . $errorInfo[2] . "
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
            <h1> Crear Prestamo</h1>
    </div>
    
    <!-- Mostrar el mensaje -->
    <?php echo $mensaje;?>
    
    <div class="card ">
      <div class="card-header bg-dark text-white">Ingresar Prestamo</div>
        <div class="card-body">
          <form action="" method="post">
              <div class="row">
                  <div class="col-md-6">
                    
                    <div class="form-group">  
                      <label for="inputfecha_prestamo">Fecha Prestamo</label>
                      <input type="date" name="fecha_prestamo"  class="form-control" id="" required>
                    </div>

                    <div class="form-group">  
                      <label for="inputfecha_limite">Fecha Limite</label>
                      <input type="date" name="fecha_limite" class="form-control" required>
                    </div>

                  
                  </div>
                  
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputEstado">Estado</label>   
                        <select name="estado" class="form-control" required>
                          <option selected="selected" value="">Seleccione</option>
                          <option value="Activo">Activo</option>
                          <option value="Inactivo">Inactivo</option>
                        </select>
                      </div>
                  
                      <div class="form-group">
                        <label for="inputUsuario">Usuario</label>
                        <select name="id_usuario" class="form-control" required>
                            <option selected="selected" value="">Seleccione</option>
                            <?php foreach($lista_usuario as $usuario) { ?>
                            <option value="<?= $usuario['id_usuario']; ?>"><?= $usuario['elusuario']; ?></option>
                            <?php  } ?>
                        </select>
                      </div>
                    
                      <div class="form-group">
                        <label for="inputEstudiante">Estudiante</label>
                        <select name="id_estudiante" class="form-control" required>
                            <option selected="selected" value="">Seleccione</option>
                            <?php foreach($lista_estudiante as $estudiante) { ?>
                            <option value="<?= $estudiante['id_estudiante']; ?>"><?= $estudiante['estudiante']; ?></option>
                            <?php  } ?>
                        </select>                              
                      </div>    
                  </div>
              </div>
              <div class="card-footer text-white text-align-center">
                <button type="submit" name="btnRegistrar"   class="btn btn-success">Registrar Prestamo</button>
                <button type="button" onclick="limpiarPrestamo();" class="btn btn-secondary">Limpiar</button>
              </div>
              <!-- /.card-footer-->
          </form>
        </div>
        <!--card-body-->    
    </div>

  <?php include_once 'vista/footer.php';?>


