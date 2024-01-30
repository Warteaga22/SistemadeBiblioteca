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

  
    // consultar si existe el id dentro del registro a modificar

    if(isset($_GET['id'])){
      $id=(int) $_GET['id'];
      
      //consulta para obtener los datos de la tabla
      $sql= "SELECT p.fecha_prestamo, p.fecha_limite, p.fecha_entrega, 
      p.estado, CONCAT(u.nombre, ' ', u.apellidos) AS usuario,
      CONCAT(e.nombres, ' ', e.apellidos) AS estudiante FROM prestamos p 
      INNER JOIN estudiantes e ON p.id_estudiante = e.id_estudiante 
      INNER JOIN usuarios u ON p.id_usuario = u.id_usuario WHERE id_prestamo=:id LIMIT 1";
      $buscar_id=$conn->prepare($sql);
      $buscar_id->execute(array(':id'=>$id));  
      $prestamo=$buscar_id->fetch();}


      if(isset($_POST['btnEditar'])){
      $fecha_entrega=$_POST['fecha_entrega'];
      $estado_prestamo = $_POST['estado'];

      // verificar si existe información en los campos 
      if(!empty($fecha_entrega) && !empty($estado_prestamo)){
  
       // consulta para insertar los valores a la base de datos
      $consulta_update=$conn->prepare('UPDATE prestamos SET
      fecha_entrega=:fecha_entrega,
      estado=:estado
      WHERE id_prestamo = :id;');
      // consulta de autores

      // Ejecutar la consulta
      $resultado = $consulta_update->execute(array(
      ":fecha_entrega" => $fecha_entrega,
      ":estado" => $estado_prestamo,
      ":id" => $id
      ));

      if ($consulta_update) {
      // Mensaje de éxito con icono y alerta
      $mensaje = "<div style='background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                      <i class='fa fa-check-circle' style='color: #28a745; margin-right: 5px;'></i>
                      Prestamo actualizado correctamente
                  </div>";
      
      // Redirección con JavaScript después de mostrar el mensaje
      echo "<script>
              setTimeout(function() {
                  window.location.href = 'listarPrestamo.php';
              }, 2000); // Redirige después de 2 segundos (ajusta según sea necesario)
            </script>";
      } else {
      // Mensaje de error con icono y alerta
      $errorInfo = $consulta_update->errorInfo();
      $mensaje = "<div style='background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                      <i class='fa fa-times-circle' style='color: #721c24; margin-right: 5px;'></i>
                      Error al actualizar el Prestamo: " . $errorInfo[2] . "
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
            <h1> Editar Prestamo</h1>
    </div>

    <!-- Mostrar el mensaje -->
    <?php echo $mensaje;?>

    <div class="card ">
      <div class="card-header bg-dark text-white">Ingresar Prestamo</div>

        <!-- Formulario para Crear Préstamo -->
        <form action="" method="post">
            <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                    
                    <div class="form-group">  
                      <label for="inputfecha_prestamo">Fecha Prestamo</label>
                      <input type="date" name="fecha_prestamo"  class="form-control" 
                      value="<?php echo $prestamo['fecha_prestamo']; ?>"   readonly required>
                    </div>

                    <div class="form-group">  
                      <label for="inputfecha_limite">Fecha Limite</label>
                      <input type="date" name="fecha_limite" class="form-control"
                        value="<?php echo $prestamo['fecha_limite']; ?>" readonly required>
                    </div>

                    <input type="hidden" name="id_prestamo" value="<?php echo $prestamo['id_prestamo']; ?>">
                    
                    <div class="form-group">  
                      <label for="inputfecha_entrega">Fecha Entrega</label>
                      <input type="date" name="fecha_entrega" class="form-control" 
                      value="<?php echo $prestamo['fecha_entrega']; ?>">
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputEstado">Estado</label>   
                        <select name="estado" class="form-control" required>
                          <option selected="selected" value="" <?php if ($prestamo['estado'] == '') {
                                                  echo 'selected';}?>> Seleccione</option>
                          <option value="Activo" <?php if ($prestamo['estado'] == 'Activo') {
                                                  echo 'selected';}?> >Activo</option>
                          <option value="Inactivo" <?php if ($prestamo['estado'] == 'Inactivo') {
                                                  echo 'selected';}?>>Inactivo</option>
                        </select>
                      </div>
                  
                      <div class="form-group">
                          <label for="inputUsuario">Usuario</label>
                          <select name="id_usuario" class="form-control" class="notItemOne" disabled required>
                              <?php foreach ($lista_usuario as $usuario) { ?>
                                <option value="<?= $usuario['id_usuario']; ?>" <?= (isset($prestamo['id_usuario']) && $prestamo['id_usuario'] == $usuario['id_usuario']) ? 'selected' : ''; ?>>
                                      <?= $prestamo['usuario']; ?>
                                </option>
                              <?php } ?>
                          </select>
                          <input type="hidden" name="id_usuario" value="<?= $prestamo['id_usuario'];?>"/>
                      </div>
                    
                      <div class="form-group">
                        <label for="inputEstudiante">Estudiante</label>


                        <select name="id_estudiante" class="form-control"  class="notItemOne" disabled required>
                              <?php foreach ($lista_estudiante as $estudiante) { ?>
                              <option value="<?= $estudiante['id_estudiante']; ?>" <?= (isset($prestamo['id_estudiante']) && $prestamo['id_estudiante'] == $estudiante['id_estudiante']) ? 'selected' : ''; ?>>
                                  <?= $prestamo['estudiante']; ?>
                              </option>
                              <?php } ?>
                        </select>
                        <input type="hidden" name="id_estudiante" value="<?= $prestamo['id_estudiante'];?>"/>                              
                      </div>    
                  </div>
              </div>
              <div class="card-footer text-white text-align-center">
                <button type="submit" name="btnEditar"   class="btn btn-success">Editar Prestamo</button>
                <button type="button" onclick="limpiarPrestamo();" class="btn btn-secondary">Limpiar</button>
            </div>
              <!-- /.card-footer-->
        </form>
        <hr>  

        <?php
        if (isset($_POST['btnAgregar'])) {
          $id=(int) $_GET['id'];
          $id_libro = $_POST['id_libro'];
          $cantidad  = $_POST['cantidad']; 
          $estado  = $_POST['estado']; 
          $observaciones  = $_POST['observaciones'];

          // verificar si existe información en los campos 
          if(!empty($id_libro) && !empty($cantidad) && !empty($estado)){
          
          // consulta para insertar los valores a la base de datos
          $sql_insert_detalle=$conn->prepare('INSERT INTO detalle_prestamo (id_prestamo, id_libro,cantidad,estado,observaciones)
          VALUES(:id_prestamo, :id_libro, :cantidad, :estado, :observaciones);');
          
            $sql_insert_detalle ->execute(array(
            ":id_prestamo"=>$id,
            ":id_libro"=>$id_libro,
            ":cantidad"=>$cantidad,
            ":estado"=>$estado,
            ":observaciones" =>$observaciones
          ));
          }
        }
        ?>

        <!-- Formulario para agregar detalle al prestamo -->    
        <form action="" method="POST">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                        <label for="inputlibro">Libro</label>
                        <select name="id_libro" class="form-control" required>
                            <option selected="selected" value="">Seleccione</option>
                            <?php foreach($lista_libro as $libro) { ?>
                            <option value="<?= $libro['id_libro']; ?>"><?= $libro['titulo']; ?></option>
                            <?php  } ?>
                        </select>                              
                      </div>
                </div> 
                
                <input type="hidden" name="id_prestamo" value="<?php echo $prestamo['id_prestamo']; ?>">

                <div class="col-md-6">
                  <div class="form-group">
                      <label for= "selEstado">Estado del libro</label>
                      <select  name="estado" id="estado" class="form-control">
                        <option value="" selected="selected">Seleccione</option>
                          <option value="Disponible">Disponible</option>
                          <option value="Ocupado">Ocupado</option>
                          <option value="Inactivo">Inactivo</option>
                      </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                  <label for= "inputObservacones">Observaciones</label>
                    <input type="text" name="observaciones" class="form-control">   
                  </div>
                </div> 
                
                <div class="col-md-3">
                  <div class="form-group">
                      <label for= "inputtxtCantidad">Cant.</label>
                      <input type="number" name="cantidad" value="1" class="form-control" readonly>
                  </div>
                </div> 

        
                <div class="col-md-2">
                  <div class="form-group" >
                      <label for= "" style="color: white;"><?php echo "hh"; ?></label>
                      <!-- <button type="reset" class="btn btn-default float-sm-right" name="">Cancelar</button> -->
                      <button title="Agregar Libro" type="submit" name="btnAgregar" id="btnAgregar" value = "agregar" class="btn btn-primary float-sm-right">
                      <i class="fa fa-plus"></i>
                      </button>
                  </div>
                </div> 
              </div> 
            </div>
            <hr> 
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Detalles (Libros)</h5>
                    </div>
                    <div class="card-body">
                      <div style="overflow:scroll; height: 250px;">
                      
                      
                      <?php 
                      
                      $id=(int) $_GET['id'];
                        
                      $sql_detalle_prestamo = "SELECT dp.id_libro, lb.titulo, CONCAT(a.nombre_autor, ' ', a.apellidos_autor) AS autor, 
                      dp.cantidad, dp.estado, dp.observaciones, dp.id_detalle FROM detalle_prestamo dp INNER JOIN libros lb ON dp.id_libro = lb.id_libro INNER JOIN autores a 
                      ON lb.id_autores = a.id_autores WHERE id_prestamo =$id";
                      
                      $select_detalle = $conn->prepare($sql_detalle_prestamo);
                      $select_detalle->execute();
                      $resultado = $select_detalle->fetchAll();
                    
                      ?>

                          <!-- datatable -->
                          <table  id="" id="detallesLibros" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>Id Libro</th>
                                <th>Titulo</th>
                                <th>Autor</th>
                                <th>Cantidad</th>
                                <th>Estado</th>
                                <th>Observaciones</th>
                                <th>Quitar</th>
                              </tr>
                            </thead>
                            <?php foreach($resultado as $fila): ?>
                            <tbody>
                            <td><?php echo $fila['id_libro'];?></td>
                            <td><?php echo $fila['titulo'];?></td>
                            <td><?php echo $fila['autor'];?></td>
                            <td><?php echo $fila['cantidad'];?></td>
                            <td><?php echo $fila['estado'];?></td>
                            <td><?php echo $fila['observaciones'];?></td>
                            <td>
                            <a href="deleteDetalle.php?id_detalle=<?php echo $fila['id_detalle']?>" class="btn btn-danger btn-sm" class="btn__delete" title="Eliminar">
                            <i class="fa fa-trash"></a></i>
                            </td>
                            </td>
                            </tbody>
                            <?php endforeach ?> 
                            <tfoot>
                            </tfoot>
                          </table>
                        </div>
                    </div>
                </div>
                <!-- /.card -->      
              </div>
            </div>
          </div>
        </form>

              
      </div>
      <!--card-header-->  
    </div>
    <!--card-->  


<?php include_once 'vista/footer.php'; ?>

