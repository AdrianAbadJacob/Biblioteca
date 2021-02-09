<?php
// Comprovacion de que el usuario es administrador, en caso contrario devuelve a PaginaBusqueda.php
session_start();

if (isset($_SESSION["admin"])) {} else {
    header("Location: PaginaBusqueda.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Registro</title>
<style type="text/css">
.center {
	padding: 20px;
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}
</style>
</head>
<body>

	<div class="center">
		<h1>Administracion</h1>
		<br>
		<button onclick="document.location='addLibro.php'">Add Book</button>
		<br>
		<form action="updateAdmin.php" method="post">
			<input list="name" name="name" id="name">
			<datalist id="name">
        
	<?php
//A continuacion se crean <option> con los nombres de los usuarios.	
$servername = "localhost";
$username = "root";
$password = "";
$database = "biblioteca";
$conn = mysqli_connect($servername, $username, $password, $database);

$consulta = "SELECT * FROM usuario";
$resultado = $conn->query($consulta);

while ($fila = $resultado->fetch_array()) {
    echo "<option value='" . $fila["username"] . "'>";
}
?>
    </datalist>
			<input type="submit" value="Manejar usuario">
		</form>


		<br>
		<button onclick="document.location='PaginaBusqueda.php'">Volver</button>
	</div>
</body>
</html>