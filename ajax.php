
<?php

include_once 'db/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    // Obtener el término de búsqueda
    $buscar_text = $_POST['search']['value'];

    // Consulta SQL con término de búsqueda
    $select_buscar = $conn->prepare('SELECT * FROM autores 
                                     WHERE nombre_autor LIKE :campo 
                                        OR apellidos_autor LIKE :campo');
    $select_buscar->execute(array(':campo' => "%" . $buscar_text . "%"));

    // Obtener y devolver resultados
    $resultado = $select_buscar->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array("data" => $resultado));
    exit;
}
?>
