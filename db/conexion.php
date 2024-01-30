
<?php 
// conexión PDO
$db = "biblioteca_infocenter";
$usuario   = "root";
$clave = "";

try{
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $clave);

}catch (PDOException $e){
    echo 'Error: '. $e->getMessage();
}



?>