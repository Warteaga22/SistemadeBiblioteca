<?php 

include_once 'db/conexion.php';
include_once 'vista/header.php';


$select = $conn->prepare('SELECT libros.*, CONCAT(nombre_autor, " ", apellidos_autor) AS autor FROM libros INNER JOIN autores ON libros.id_autores = autores.id_autores;');
$select->execute();
$resultado = $select->fetchAll();

 // Método condicional para la búsqueda de datos en la base de datos
if(isset($_POST['btn_buscar'])){
    $buscar_text = $_POST['buscar'];
    $select_buscar = $conn->prepare('SELECT libros.*, CONCAT(nombre_autor, " ", apellidos_autor) AS autor FROM libros INNER JOIN autores ON libros.id_autores = autores.id_autores WHERE titulo 
    LIKE :campo OR genero LIKE :campo;');

$select_buscar->execute(array(
    ':campo' =>"%".$buscar_text."%"));

    $resultado = $select_buscar->fetchAll(); 
}

?>


<div class="app-title">
    <h1> Listado de Libros</h1>
</div>

    <!-- creación de los campos de la labla a visualizar-->
    <div class="col-lg-12">
        <div class="tile">    
            <div class="tile-body">
            <div class="table-responsive">
            <!-- <a href="../informes/informe_excel_libros.php" class="btn btn-primary btn-sm" class="btn_update" title=""><i class="fa fa-file-excel-o">Descargar en Excel</a></i>
            <hr> -->
            <br> 
            <table class="table table-light mt-4 table-striped table-bordered" id="tblLibros" style="width:100%">
                    <thead>
                        <tr>
                            <td>Id_Libro</td>
                            <td>Titulo</td>
                            <td>Genero</td>
                            <td>Numero de Paginas</td>
                            <td>Editorial</td>
                            <td>Fecha Publicacion</td>
                            <td>ISBN</td>
                            <td>Dewey</td>
                            <td>Autor</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <!--  Resultados de el ingreso de información o de visualización de información 
                    contenida en la base de datos
                    -->
                    <?php foreach($resultado as $fila): ?>
                    <tbody>    
                    <tr>
                        <td><?php echo $fila['id_libro'];?></td>
                        <td><?php echo $fila['titulo'];?></td>
                        <td><?php echo $fila['genero'];?></td>
                        <td><?php echo $fila['num_paginas'];?></td>
                        <td><?php echo $fila['editorial'];?></td>
                        <td><?php echo $fila['fecha_publicacion'];?></td>
                        <td><?php echo $fila['ISBN'];?></td>
                        <td><?php echo $fila['Dewey'];?></td>
                        <td><?php echo $fila['autor'];?></td>
                        <td>
                        <a href="updateLibro.php?id_libro=<?php echo $fila['id_libro']?>" class="btn btn-primary btn-sm" class="btn_update" title="Editar"><i class="fa fa-edit"></a></i>
                        <a href="deleteLibro.php?id_libro=<?php echo $fila['id_libro']?>" class="btn btn-danger btn-sm" class="btn_delete"  title="Eliminar"><i class="fa fa-trash"></a></i>
                        </td>

                    </tr>
                    </tbody>
                    <?php endforeach ?> 
                </table>
            </div> 
            </div>
        </div>
    </div>

<?php include_once 'vista/footer.php';?>







