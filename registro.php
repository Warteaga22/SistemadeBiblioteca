<?php
//consulta para seleccionar el id del rol
include_once 'db/conexion.php';
$sql = 'SELECT id_rol , rol FROM roles ORDER BY rol';

try {
$lista = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
  die($exception->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Login-->
    <link rel="stylesheet" href="Assets/css/login.css">
    <!-- CSS Boostrap 4-->
    <link rel="stylesheet" href="Assets/css/main.css">
  
    <title>Registro de usuario</title>
</head>

<body>

    <div class="container-all">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="col-lg-6">
                                <div class="ctn-text">
                                    <!-- <div class="capa">
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-5">
                              <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registro Usuario</h1>
                                <span><a href="login.php">Iniciar Sesión</a></span>
                              </div>
                              <form action="registro_procesar.php" method="POST">
                                <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-6">
                                        <!-- <div class="form-group"> -->
                                            <label for="">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" required>
                                        <!-- </div> -->
                                        <!-- <div class="form-group"> -->
                                            <label for="">Apellidos</label>
                                            <input type="text" name="apellidos" class="form-control" required>
                                        <!-- </div> -->
                                        <!-- <div class="form-group"> -->
                                            <label for="">Fecha Nacimiento</label>
                                            <input type="date" name="fechanacimiento" class="form-control" required>
                                        <!-- </div> -->
                                        <!-- <div class="form-group"> -->
                                          <label for="">Direccion</label>
                                          <input type="text" name="direccion" class="form-control" required>
                                        <!-- </div> -->
                                      </div>
                      
                                      <div class="col-md-6">
                                        <!-- <div class="form-group"> -->
                                            <label for="">Telefono</label>
                                            <input type="text" name="telefono" class="form-control" required>
                                          <!-- </div> -->
                                          <!-- <div class="form-group"> -->
                                            <label for="">Ciudad</label>
                                            <input type="text" name="ciudad" class="form-control" required>
                                          <!-- </div> -->
                                          <!-- <div class="form-group"> -->
                                            <label for="">Correo Electronico</label>
                                            <input type="text" name="email" class="form-control" required>
                                          <!-- </div> -->
                                          <!-- <div class="form-group"> -->
                                            <label for="">Contraseña</label>
                                            <input type="text" name="clave" class="form-control" required>
                                          <!-- </div> -->
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="">id_Rol</label>
                                              <select name="id_rol" class="form-control" required>
                                                  <option selected="selected" value="">Seleccione</option>
                                                  <?php 
                                                  foreach($lista as $rol) { ?>
                                                    <option value="<?= $rol['id_rol']; ?>"><?= $rol['rol']; ?></option>
                                                  
                                                  <?php  } ?>
                                              </select>
                                          </div>
                                        </div>
                                      </div>  
                                      
                                      <br>
                                      <button type="submit" class="btn btn-primary md-6" name="btnRegistrar">Registrar</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                        </div>  
                    </div>
                </div>  
            </div>
    </div> 
   

</body>
 <!--jQuery boostrap 5-->
 <script src="Assets/bootstrap5/js/bootstrap.bundle.min.js"></script> 

</html>