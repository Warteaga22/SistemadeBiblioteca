<?php 

include_once 'db/conexion.php';
include_once 'vista/header.php';


 $select = $conn->prepare('SELECT * FROM  autores ;');
 $select->execute();
 $resultado = $select->fetchAll();

 // Método condicional para la búsqueda de datos en la base de datos
if(isset($_POST['btn_buscar'])){
    $buscar_text = $_POST['buscar'];
     $select_buscar = $conn->prepare('SELECT * FROM  autores  WHERE nombre_autor
    LIKE :campo OR apellidos_autor LIKE :campo;');

    $select_buscar->execute(array(
    ':campo' =>"%".$buscar_text."%"));

    $resultado = $select_buscar->fetchAll(); 
}

?>

   <div class="app-title">
    <h1> Listado de Autores</h1>
   </div>

        <!-- creación de los campos de la labla a visualizar-->
        <div class="col-lg-12">
         <div class="tile">    
           <div class="tile-body">
            <div class="table-responsive">    
                <!-- <a href="../informes/informe_excel_autores.php" class="btn btn-primary btn-sm" class="btn_update" title=""><i class="fa fa-file-excel-o">Descargar en Excel</a></i> -->
                <!-- <hr> -->
                <br>
                <table class="table table-light mt-4 table-striped table-bordered" id="tblAutores" style="width:100%">
                    <thead>
                        <tr>
                            <td>Id_Autor</td>
                            <td>Nombre</td>
                            <td>Apellidos</td>
                            <td>Fecha Nacimiento</td>
                            <td>Descripcion</td>
                            <td>Genero</td>
                            <td>Nacionalidad</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <!--  Resultados de el ingreso de información o de visualización de información 
                    contenida en la base de datos
                    -->
                    <?php foreach($resultado as $fila): ?>
                    <tbody>    
                        <tr>
                            <td><?php echo $fila['id_autores'];?></td>
                            <td><?php echo $fila['nombre_autor'];?></td>
                            <td><?php echo $fila['apellidos_autor'];?></td>
                            <td><?php echo $fila['fechanacimiento'];?></td>
                            <td><?php echo $fila['descripcion'];?></td>
                            <td><?php echo $fila['genero'];?></td>
                            <td><?php echo $fila['nacionalidad'];?></td>
                            <td>
                            <a href="updateAutor.php?id_autores=<?php echo $fila['id_autores']?>" class="btn btn-primary btn-sm" class="btn_update" title="Editar"><i class="fa fa-edit"></a></i>
                            <a href="deleteAutor.php?id_autores=<?php echo $fila['id_autores']?>" class="btn btn-danger btn-sm" class="btn_delete"  title="Eliminar"><i class="fa fa-trash"></a></i>
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
