<?php
include_once 'db/conexion.php';
include_once 'vista/header.php';

// Inicializar la variable mensaje
$mensaje = "";

// consultar si existe el id dentro del registro a modificar
if(isset($_GET['id_estudiante'])){
    $id_estudiante=(int) $_GET['id_estudiante'];
    
    //consulta para obtener los datos de la tabla
    $buscar_id=$conn->prepare('SELECT * FROM estudiantes WHERE id_estudiante=:id_estudiante LIMIT 1');

    $buscar_id->execute(array(':id_estudiante'=>$id_estudiante));  
    $estudiante=$buscar_id->fetch();
}
// verificar si existe datos en lso campos
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
    if(!empty($nro_documento) &&!empty($nombres) && !empty($apellidos) && !empty($direccion) && !empty($telefono) 
    && !empty($email)&& !empty($fechanacimiento) && !empty($grado)){

    // consulta para insertar los valores a la base de datos
    $consulta_update=$conn->prepare('UPDATE estudiantes SET
    nro_documento=:nro_documento,
    nombres=:nombres,
    apellidos=:apellidos,
    direccion=:direccion,
    telefono=:telefono,
    email=:email,
    fechanacimiento=:fechanacimiento,
    grado=:grado
    WHERE id_estudiante=:id_estudiante;');

    // ejecuta la consulta
    $consulta_update ->execute(array(
    ":nro_documento"=>$nro_documento,
    ":nombres"=>$nombres,
    ":apellidos"=>$apellidos,
    ":direccion"=>$direccion,
    ":telefono"=>$telefono,
    ":email" =>$email,
    ":fechanacimiento"=>$fechanacimiento,
    ":grado"=>$grado,
    ":id_estudiante"=>$id_estudiante));
         

    if ($consulta_update) {
        // Mensaje de éxito con icono y alerta
        $mensaje = "<div style='background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;'>
                        <i class='fa fa-check-circle' style='color: #28a745; margin-right: 5px;'></i>
                        Estudiante actualizado correctamente
                    </div>";
        
        // Redirección con JavaScript después de mostrar el mensaje
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'listarEstudiante.php';
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
        <h1> Editar Estudiante</h1>
    </div>
    
    <!-- Mostrar el mensaje -->
    <?php echo $mensaje;?>

    <div class="card ">
        <div class="card-header bg-dark text-white">Actualizar Estudiante</div>
        <form method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">    
                            <label for="">Numero de Documento</label>
                            <input type="text" name="nro_documento" class="form-control" required
                            value="<?php echo $estudiante['nro_documento']; ?>">
                        </div>  
                        <div class="form-group"> 
                            <label for="">Nombre</label>
                            <input type="text" name="nombres" class="form-control" required
                            value="<?php echo $estudiante['nombres']; ?>">
                        </div> 
                        <div class="form-group">   
                            <label for="">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" required
                            value="<?php echo $estudiante['apellidos']; ?>">
                        </div>
                        <div class="form-group">    
                            <label for="">Direccion</label>
                            <input type="text" name="direccion" class="form-control" required
                            value="<?php echo $estudiante['direccion']; ?>">
                        </div>    
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="">Teléfono</label>            
                            <input type="text" name="telefono" class="form-control" required
                            value="<?php echo $estudiante['telefono']; ?>">
                        </div>
                        <div class="form-group">    
                            <label for="">Correo</label>
                            <input type="email" name="email" class="form-control" required
                            value="<?php echo $estudiante['email']; ?>">
                        </div>
                        <div class="form-group">    
                            <label for="">Fecha Nacimiento</label>
                            <input type="date" name="fechanacimiento" class="form-control" required
                            value="<?php echo $estudiante['fechanacimiento']; ?>">
                        </div> 
                        <div class="form-group">   
                            <label for="">Grado</label>
                            <select name="grado" class="form-control" required>
                            <option seleted value="" <?php if ($estudiante['grado'] == '') {
                                                    echo 'selected';}?>> Seleccione</option>
                            <option value="6" <?php if ($estudiante['grado'] == '6') {
                                                    echo 'selected';}?>>6</option>
                            <option value="7" <?php if ($estudiante['grado'] == '7') {
                                                    echo 'selected';}?>>7</option>
                            <option value="8" <?php if ($estudiante['grado'] == '8') {
                                                    echo 'selected';}?>>8</option>
                            <option value="9" <?php if ($estudiante['grado'] == '9') {
                                                    echo 'selected';}?>>9</option>
                            <option value="10" <?php if ($estudiante['grado'] == '10') {
                                                    echo 'selected';}?>>10</option>
                            <option value="11" <?php if ($estudiante['grado'] == '11') {
                                                    echo 'selected';}?>>11</option>
                            </select>
                            </div>   
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
