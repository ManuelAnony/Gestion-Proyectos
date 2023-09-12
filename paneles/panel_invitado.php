<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si el usuario invitado está autenticado
if (isset($_SESSION['invitado'])) {
    // Destruir la sesión del invitado
    session_destroy();
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: ../login.php");
    exit; // Asegura que el script se detenga después de la redirección
}

// Consulta SQL para obtener los proyectos más recientes
$sqlProyectosRecientes = "SELECT nombre, fecha_creacion FROM proyectos
        ORDER BY fecha_creacion DESC
        LIMIT 6"; // Obtener los últimos 6 proyectos

$resultProyectosRecientes = mysqli_query($conexion, $sqlProyectosRecientes);

// Verificar si la consulta fue exitosa
if (!$resultProyectosRecientes) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Invitado</title>
    <style>
        /* Estilos CSS aquí */
    </style>
</head>
<body>
    <header>
        <h1>Dashboard</h1>
        <!-- No se muestra el nombre para el invitado -->
    </header>

    <div id="contenido">
        <section id="proyectos-recientes">
            <h2>Últimos 6 Proyectos</h2>
            <ul>
                <?php
                // Iterar a través de los resultados de la consulta de proyectos recientes
                while ($row = mysqli_fetch_assoc($resultProyectosRecientes)) {
                    echo "<li>{$row['nombre']} - Fecha: {$row['fecha_creacion']}</li>";
                }
                ?>
            </ul>
        </section>
    </div>

    <footer>
        <a href="../login.php">Iniciar Sesión</a>
        <a href="../registro.php">Crear Usuario</a>
    </footer>
</body>
</html>

