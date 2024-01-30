<?php
  include_once 'db/conexion.php';

  // Inicializar la variable mensaje
  $mensaje = "";

  // verificar si existe datos en los campos

  $sql = 'SELECT id_autores , CONCAT(nombre_autor, " ",apellidos_autor) AS elautor FROM autores ORDER BY elautor';

  try {
    $lista = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $exception) {
    die($exception->getMessage());
  }

  // consultar si existe el id dentro del registro a modificar

  if(isset($_GET['id_libro'])){
    $id_libro=(int) $_GET['id_libro'];
    
    //consulta para obtener los datos de la tabla
    $buscar_id=$conn->prepare('SELECT * FROM libros WHERE id_libro=:id_libro LIMIT 1');

    $buscar_id->execute(array(':id_libro'=>$id_libro));  
    $libro=$buscar_id->fetch();
  }

  if(isset($_POST['btnRegistrar'])){
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $num_paginas = $_POST['num_paginas'];
    $editorial = $_POST['editorial'];
    $ISBN = $_POST['ISBN'];
    $Dewey = $_POST['Dewey'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $cantidad = $_POST['cantidad'];
    $disponible = $_POST['disponible'];
    $id_autores = $_POST['id_autores'];
    

    // verificar si existe información en los campos 
    if(!empty($titulo) &&!empty($genero) && !empty($num_paginas) && !empty($editorial) && !empty($ISBN) 
    && !empty($Dewey)&& !empty($fecha_publicacion) && !empty($cantidad)  && !empty($disponible) && !empty($id_autores)){

    // consulta para insertar los valores a la base de datos
    $consulta_insert=$conn->prepare('UPDATE libros SET
    titulo=:titulo,
    genero=:genero,
    num_paginas=:num_paginas,
    editorial=:editorial,
    ISBN=:ISBN,
    Dewey=:Dewey,
    fecha_publicacion=:fecha_publicacion,
    cantidad=:cantidad,
    disponible= :disponible,
    id_autores= :id_autores
    WHERE id_libro = :id_libro;');
      

    // ejecutar la consulta
    $consulta_insert ->execute(array(
    ":titulo"=>$titulo,
    ":genero"=>$genero,
    ":num_paginas"=>$num_paginas,
    ":editorial"=>$editorial,
    ":ISBN"=>$ISBN,
    ":Dewey" =>$Dewey,
    ":fecha_publicacion"=>$fecha_publicacion,
    ":cantidad"=>$cantidad,
    ":disponible"=>$disponible,
    ":id_autores"=>$id_autores,
    ":id_libro"=>$id_libro));
  
    if ($consulta_insert) {
      // Mensaje de éxito con icono y alerta
      $mensaje = "<div style='background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                      <i class='fa fa-check-circle' style='color: #28a745; margin-right: 5px;'></i>
                      Libro actualizado correctamente
                  </div>";
      
      // Redirección con JavaScript después de mostrar el mensaje
      echo "<script>
              setTimeout(function() {
                  window.location.href = 'listarLibro.php';
              }, 2000); // Redirige después de 2 segundos (ajusta según sea necesario)
            </script>";
    } else {
        // Mensaje de error con icono y alerta
        $errorInfo = $consulta_insert->errorInfo();
        $mensaje = "<div style='background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                        <i class='fa fa-times-circle' style='color: #721c24; margin-right: 5px;'></i>
                        Error al actualizar el libro: " . $errorInfo[2] . "
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
    <h1> Editar libro</h1>
  </div>

  <!-- Mostrar el mensaje -->
  <?php echo $mensaje;?>

  <div class="card ">
    <div class="card-header bg-dark text-white">Actualizar libro</div>
      <form action="" method="post">

        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              
              <div class="form-group"> 
                <label for="">Titulo</label>
                <input type="text" name="titulo" class="form-control" required
                value="<?php echo $libro['titulo']; ?>">
              </div>

              <div class="form-group"> 
                <label for="">Genero</label>
                <input type="text" name="genero" class="form-control" required
                value="<?php echo $libro['genero']; ?>">
              </div> 

              <div class="form-group"> 
                <label for="">N° de Paginas.</label>
                <input type="text" name="num_paginas" class="form-control" required
                value="<?php echo $libro['num_paginas']; ?>">
              </div>
              <div class="form-group"> 
                <label for="">Editorial</label>
                <input type="text" name="editorial" class="form-control" required
                value="<?php echo $libro['editorial']; ?>">
              </div>
              <div class="form-group"> 
                <label for="">ISBN</label>
                <input type="text" name="ISBN" class="form-control" required
                value="<?php echo $libro['ISBN']; ?>">
              </div>    
            </div>

            <div class="col-md-6">

              <div class="form-group"> 
                <label for="">Dewey</label>
                <input type="text" name="Dewey" class="form-control" required
                value="<?php echo $libro['Dewey']; ?>">
              </div>
              <div class="form-group"> 
                <label for="">Fecha de publicación</label>
                <input type="date" name="fecha_publicacion" class="form-control" required
                value="<?php echo $libro['fecha_publicacion']; ?>">
              </div>
              <div class="form-group"> 
                <label for="">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" required
                value="<?php echo $libro['cantidad']; ?>">
              </div>              
              <div class="form-group"> 
                <label for="">Disponible</label>
                <input type="number" name="disponible" class="form-control" required
                value="<?php echo $libro['disponible']; ?>">
              </div>
              
              
              <div class="form-group"> 
                <label for="">Autor</label>
                <select name="id_autores" class="form-control" class="notItemOne" required>
                    <?php foreach ($lista as $autor) { ?>
                      <option value="<?= $autor['id_autores']; ?>" <?= (isset($libro['id_autores']) && $libro['id_autores'] == $autor['id_autores']) ? 'selected' : ''; ?>>
                            <?= $autor['elautor']; ?>
                      </option>
                    <?php } ?>

                </select>
              </div>

            </div>
          </div>

        </div>
        
        <div class="card-footer text-white">
          <button type="submit" class="btn btn-primary" name="btnRegistrar">Actualizar</button>
          <button type="reset"  class="btn btn-secondary" name="btnLimpiar">Limpiar</button>
        </div>
        
      </form>
  </div>


<?php 
include_once 'vista/footer.php';
?>