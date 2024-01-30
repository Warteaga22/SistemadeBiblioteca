<?php 

include_once 'db/conexion.php';
include_once 'vista/header.php';


$select = $conn->prepare('SELECT * FROM  estudiantes ;');
$select->execute();
$resultado = $select->fetchAll();

 // Método condicional para la búsqueda de datos en la base de datos
if(isset($_POST['btn_buscar'])){
    $buscar_text = $_POST['buscar'];
    $select_buscar = $conn->prepare('SELECT * FROM  estudiantes  WHERE nombres
    LIKE :campo OR apellidos LIKE :campo;');

    $select_buscar->execute(array(
    ':campo' =>"%".$buscar_text."%"));

    $resultado = $select_buscar->fetchAll(); 
}

?>

<div class="app-title">
    <h1> Listado de Estudiantes</h1>
</div>

    <!-- creación de los campos de la tabla a visualizar-->
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <!-- <a href="../informes/informe_excel_estudiantes.php" class="btn btn-primary btn-sm" class="btn_update" title=""><i class="fa fa-file-excel-o">Descargar en Excel</a></i>
                    <hr> -->
                    <table class="table table-light table-striped table-bordered" id="tblEst" style="width:100%">
                        <thead>
                            <tr>
                                <td>Id_Estudiante</td>
                                <td>Documento</td>
                                <td>Nombre</td>
                                <td>Apellidos</td>
                                <td>Direccion</td>
                                <td>Telefono</td>
                                <td>Correo</td>
                                <td>Fecha de Nacimiento</td>
                                <td>Grado</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                            <!--  Resultados de el ingreso de información o de visualización de información 
                            contenida en la base de datos
                            -->
                        <?php foreach($resultado as $fila): ?>
                        <tbody>    
                            <tr>
                                <td><?php echo $fila['id_estudiante'];?></td>
                                <td><?php echo $fila['nro_documento'];?></td>
                                <td><?php echo $fila['nombres'];?></td>
                                <td><?php echo $fila['apellidos'];?></td>
                                <td><?php echo $fila['direccion'];?></td>
                                <td><?php echo $fila['telefono'];?></td>
                                <td><?php echo $fila['email'];?></td>
                                <td><?php echo $fila['fechanacimiento'];?></td>
                                <td><?php echo $fila['grado'];?></td>
                                <td>
                                <a href="updateEstudiante.php?id_estudiante=<?php echo $fila['id_estudiante']?>" class="btn btn-primary btn-sm" class="btn_update" title="Editar"><i class="fa fa-edit"></a></i>
                                <a href="deleteEstudiante.php?id_estudiante=<?php echo $fila['id_estudiante']?>" class="btn btn-danger btn-sm" class="btn_delete" title="Eliminar"><i class="fa fa-trash"></a></i>
                                </td>
                            </tr>
                        </tbody>
                        <?php endforeach ?> 
                    </table>
                </div>
            </div>
        </div>
    </div>
        


<?php 
include_once 'vista/footer.php';
?>