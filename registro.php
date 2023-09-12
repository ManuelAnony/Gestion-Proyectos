<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$nombre = $_POST["nombre"];
	$apellidos = $_POST["apellidos"];
	$correo = $_POST["correo"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$verificacion_password = $_POST["verificacion_password"];
	
	if ($password === $verificacion_password){
		
		
	} else {
		echo('Error!!');
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registro</title>
</head>

<body>
	<h2>Registro de Usuario</h2>
	<form method="POST" action="registro.php">
		<label for="nombre">Nombre:</label>
		<input type="text" name="nombre" required><br>
		<label for="apellidos">Apellidos:</label>
		<input type="text" name="apellidos" required><br>
		<label for="correo">Correo Electrónico:</label>
		<input type="email" name="correo" required><br>
		<label for="username">Nombre de usuario:</label>
		<input type="text" name="username" required><br>
		<label for="password">Contraseña</label>
		<input type="password" name="password" required><br>
		<label for="verificacion_password">Verificar Contraseña:</label>
		<input type="password" name="verificacion_password" required><br>
		<input type="submit" value="Registrarse" formaction="paneles/panel_usuario.php">
		<input type="button" value="Iniciar sesión" onclick="redirectToLogin()">
	</form>

	<script>
		function redirectToLogin() {
			// Cambiar la acción del formulario al hacer clic en el botón "Iniciar sesión"
			document.querySelector('form').action = 'login.php';
			// Enviar el formulario automáticamente
			document.querySelector('form').submit();
		}
	</script>
</body>
</html>