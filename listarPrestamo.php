<?php 

include_once 'db/conexion.php';
include_once 'vista/header.php';


$select = $conn->prepare('
    SELECT p.id_prestamo, p.fecha_prestamo, p.fecha_limite, p.fecha_entrega, dp.cantidad,
    p.estado,CONCAT(e.nombres, " ", e.apellidos) AS estudiante, lb.titulo
    FROM prestamos p
    INNER JOIN estudiantes e ON p.id_estudiante = e.id_estudiante
    LEFT JOIN detalle_prestamo dp ON dp.id_prestamo = p.id_prestamo
    LEFT JOIN libros lb ON dp.id_libro = lb.id_libro
    WHERE dp.id_prestamo IS NULL OR dp.id_prestamo IS NOT NULL
');
 $select->execute();
 $resultado = $select->fetchAll();

 // Método condicional para la búsqueda de datos en la base de datos
//  if(isset($_POST['btn_buscar'])){
//      $buscar_text = $_POST['buscar'];
//      $select_buscar = $conn->prepare('SELECT * FROM  estudiantes  WHERE nombres
//     LIKE :campo OR apellidos LIKE :campo;');

//  $select_buscar->execute(array(
//      ':campo' =>"%".$buscar_text."%"));

//      $resultado = $select_buscar->fetchAll(); 
//  }

?>

   <div class="app-title">
    <h1> Listado de Prestamos</h1>
   </div>

        <!-- creación de los campos de la tabla a visualizar-->
        
        <div class="tile"> 
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-light mt-4 table-striped table-bordered" id="tblPrestamos" style="width:100%">
                        <thead>
                            <tr>
                                <td>Id_Prestamo</td>
                                <td>Fecha Prestamo</td>
                                <td>Fecha Limite</td>
                                <td>Fecha Entrega</td>
                                <td>Cantidad</td>
                                <td>Estado</td>
                                <td>Estudiante</td>
                                <td>Libro</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <!--  Resultados de el ingreso de información o de visualización de información 
                        contenida en la base de datos
                        -->
                        <?php foreach($resultado as $fila): ?>
                        <tbody>    
                        <tr>
                            <td><?php echo $fila['id_prestamo'];?></td>
                            <td><?php echo $fila['fecha_prestamo'];?></td>
                            <td><?php echo $fila['fecha_limite'];?></td>
                            <td><?php echo $fila['fecha_entrega'];?></td>
                            <td><?php echo $fila['cantidad'];?></td>
                            <td><?php echo $fila['estado'];?></td>
                            <td><?php echo $fila['estudiante'];?></td>
                            <td><?php echo $fila['titulo'];?></td>
                            <td>
                            <a href="updatePrestamo.php?id=<?php echo $fila['id_prestamo']?>" class="btn btn-primary btn-sm" class="btn__update" title="Editar"><i class="fa fa-edit"></a></i>
                            <a href="deletePrestamo.php?id=<?php echo $fila['id_prestamo']?>" class="btn btn-danger btn-sm" class="btn__delete" title="Eliminar"><i class="fa fa-trash"></a></i>
                            </td>
                        </tr>
                        </tbody>
                        <?php endforeach ?> 

                    </table>
                </div>
            </div>
        </div>
         

<?php 
include_once 'vista/footer.php';
?>