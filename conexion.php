<?php 
// Datos de conexión
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos ="site-admin";

$conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

if (!$conexion){
    die("Error de conexión: " . mysqli_connect_error());
}

// Establecer el conjunto de caracteres a utf8
mysqli_set_charset($conexion, "utf8");
?>
