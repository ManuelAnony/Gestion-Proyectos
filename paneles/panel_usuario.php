<?php

require_once("conexion.php");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obtener el nombre de usuarios y el número de proyectos
    $sqlUsuarios = "SELECT nombre, COUNT(*) as numero_proyectos FROM usuarios
            LEFT JOIN proyectos ON usuarios.id = proyectos.usuario_id
            GROUP BY usuarios.id, usuarios.nombre
            ORDER BY numero_proyectos DESC";

    $resultUsuarios = $conn->query($sqlUsuarios);

    // Consulta SQL para obtener los proyectos más recientes
    $sqlProyectosRecientes = "SELECT nombre_proyecto, fecha_creacion FROM proyectos
            ORDER BY fecha_creacion DESC
            LIMIT 6"; // Obtener los últimos 6 proyectos

    $resultProyectosRecientes = $conn->query($sqlProyectosRecientes);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Usuario</title>
    <style>
        /* Estilos CSS aquí */
    </style>
</head>
<body>
    <header>
        <h1>Dashboard</h1>
        <div id="usuario-info">
            <p>Nombre: Nombre del Usuario</p>
            <p>Número de Documentos Subidos: 10</p>
        </div>
    </header>

    <div id="contenido">
        <section id="proyectos-recientes">
            <h2>Últimos 6 Proyectos</h2>
            <ul>
                <?php
                // Iterar a través de los resultados de la consulta de proyectos recientes
                while ($row = $resultProyectosRecientes->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>{$row['nombre_proyecto']} - Fecha: {$row['fecha_creacion']}</li>";
                }
                ?>
            </ul>
        </section>

        <section id="usuarios">
            <h2>Usuarios</h2>
            <ul>
                <?php
                // Iterar a través de los resultados de la consulta de usuarios
                while ($row = $resultUsuarios->fetch(PDO::FETCH_ASSOC)) {
                    echo "<li>{$row['nombre']} - Proyectos: {$row['numero_proyectos']}</li>";
                }
                ?>
            </ul>
        </section>
    </div>

    <footer>
        <a href="crear_arboles.html">Crear o Subir Proyecto</a>
        <a href="logout.php">Cerrar Sesión</a>
    </footer>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos al final del archivo
$conn = null;
?>
