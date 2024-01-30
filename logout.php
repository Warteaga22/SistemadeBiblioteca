<?php 
// Destruir sesión cuando se ingrese o se salga de sistema 

session_start();
session_destroy();
header("location: login.php");
?>

