<?php

require_once("conexion.php");

// Datos recibidos del formulario JavaScript
$data = json_decode(file_get_contents("php://input"), true);

// Procesar y almacenar datos en la base de datos
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Supongamos que tienes una tabla llamada 'proyectos' con campos 'nombre' y 'descripcion'
    $stmt = $conn->prepare("INSERT INTO proyectos (nombre, descripcion) VALUES (:nombre, :descripcion)");
    $stmt->bindParam(':nombre', $data['nombre']);
    $stmt->bindParam(':descripcion', $data['descripcion']);
    $stmt->execute();

    // Aquí deberías procesar y almacenar los datos de los árboles de problemas y objetivos en tablas correspondientes

    // Si todo está correcto, puedes enviar una respuesta JSON de éxito
    $response = ['message' => 'Datos guardados correctamente'];
    echo json_encode($response);
} catch (PDOException $e) {
    // En caso de error, puedes enviar una respuesta JSON de error
    $response = ['error' => $e->getMessage()];
    echo json_encode($response);
}

// Cerrar la conexión a la base de datos
$conn = null;
?>
