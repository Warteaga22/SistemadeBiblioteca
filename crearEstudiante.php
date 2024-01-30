<?php
include_once 'db/conexion.php';
include_once 'vista/header.php';

// Inicializar la variable mensaje
$mensaje = "";

// verificar si existe datos en los campos
if(isset($_POST['btnRegistrar'])){
    $nro_documento = $_POST['nro_documento'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $grado = $_POST['grado'];

  
    // verificar si existe información en los campos 
    if(!empty($nro_documento) &&!empty($nombres) && !empty($apellidos) && !empty($direccion) && !empty($telefono) && !empty($email)&& !empty($fechanacimiento) && !empty($grado)){
       
    // consulta para insertar los valores a la base de datos
    $consulta_insert=$conn->prepare('INSERT INTO estudiantes (nro_documento,nombres, apellidos, direccion, telefono, email,fechanacimiento, grado) 
    VALUES (:nro_documento,:nombres,:apellidos,:direccion,:telefono,:email,:fechanacimiento,:grado)');
  
    // ejecuta la consualta
    $consulta_insert ->execute(array(
    ":nro_documento"=>$nro_documento,
    ":nombres"=>$nombres,
    ":apellidos"=>$apellidos,
    ":direccion"=>$direccion,
    ":telefono"=>$telefono,
    ":email" =>$email,
    ":fechanacimiento"=>$fechanacimiento,
    ":grado"=>$grado));
         

    if ($consulta_insert) {

    // Mensaje de éxito con icono y alerta
    $mensaje = "<div style='background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                    <i class='fa fa-check-circle' style='color: #28a745; margin-right: 5px;'></i>
                    Estudiante creado correctamente
                </div>";
    
    // Redirección con JavaScript después de mostrar el mensaje
    echo "<script>
            setTimeout(function() {
                window.location.href = 'listarEstudiante.php';
            }, 2000); // Redirige después de 2 segundos (ajusta según sea necesario)
            </script>";
    } else {
    // Mensaje de error con icono y alerta
    $errorInfo = $consulta_insert->errorInfo();
    $mensaje = "<div style='background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                    <i class='fa fa-times-circle' style='color: #721c24; margin-right: 5px;'></i>
                    Error al crear el estudiante: " . $errorInfo[2] . "
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
    <h1> Crear Estudiante</h1>
    </div>

    <!-- Mostrar el mensaje -->
    <?php echo $mensaje;?>

    <div class="card ">
        <div class="card-header bg-dark text-white">Ingresar Estudiante</div>
        <form method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">    
                            <label for="">Numero de Documento</label>
                            <input type="text" name="nro_documento" class="form-control" required>
                        </div>  
                        <div class="form-group"> 
                            <label for="">Nombre</label>
                            <input type="text" name="nombres" class="form-control" required>
                        </div> 
                        <div class="form-group">   
                            <label for="">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label for="">Direccion</label>
                            <input type="text" name="direccion" class="form-control" required>
                        </div>    
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="">Teléfono</label>            
                            <input type="text" name="telefono" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label for="">Correo</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">    
                            <label for="">Fecha Nacimiento</label>
                            <input type="date" name="fechanacimiento" class="form-control" required>
                        </div> 
                        <div class="form-group">   
                            <label for="">Grado</label>
                            <select name="grado" class="form-control" required>
                            <option seleted value=""> Seleccione</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            </select>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="card-footer text-white">
            <button type="submit" class="btn btn-primary" name="btnRegistrar">Registrar</button>
            <button type="reset"  class="btn btn-secondary" name="btnLimpiar">Limpiar</button>
            </div>
        </form>
    </div>
                    
  
<?php include_once 'vista/footer.php';?>
