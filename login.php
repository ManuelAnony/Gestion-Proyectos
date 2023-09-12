<?php
session_start();

// Incluye el archivo de conexión a la base de datos
require_once("conexion.php");

// Verificar si el usuario ya ha iniciado sesión. Si es así, redirigirlo al panel correspondiente.
if (isset($_SESSION["usuario"])) {
    if ($_SESSION["usuario"]["role"] === "admin") {
        header("Location: paneles/panel_admin.php");
    } elseif ($_SESSION["usuario"]["role"] === "usuario_normal") {
        header("Location: paneles/panel_usuario.php");
    } else {
        header("Location: paneles/panel_invitado.php");
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Realiza la autenticación aquí. Comprueba las credenciales y el rol en la base de datos.

    // Por ejemplo, si el usuario y la contraseña coinciden:
    if ($username === "admin" && $password === "adminpassword") {
        $_SESSION["usuario"] = [
            "username" => $username,
            "role" => "admin"
        ];
        header("Location: paneles/panel_admin.php");
        exit();
    } elseif ($username === "usuario" && $password === "usuariopassword") {
        $_SESSION["usuario"] = [
            "username" => $username,
            "role" => "usuario_normal"
        ];
        header("Location: paneles/panel_usuario.php");
        exit();
    } elseif ($username === "invitado") {
        // Si el usuario es "invitado", destruir cualquier sesión existente.
        if (isset($_SESSION["usuario"])) {
            session_destroy();
        }

        // Configurar la sesión del usuario como "invitado".
        $_SESSION["usuario"] = [
            "username" => $username,
            "role" => "invitado"
        ];

        // Registrar la visita del invitado en la tabla "visitas" (ya se encuentra en conexion.php)
        $query = "INSERT INTO visitas (usuario) VALUES ('$username')";
        mysqli_query($conexion, $query);

        header("Location: paneles/panel_invitado.php");
        exit();
    } else {
        // Las credenciales no son válidas, muestra un mensaje de error.
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="login.php">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
    <form method="POST" action="login.php">
        <input type="hidden" name="username" value="invitado">
        <input type="submit" value="Ingresar como Invitado">
    </form>
</body>
</html>

