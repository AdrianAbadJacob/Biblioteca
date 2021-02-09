<?php
// Esta es la pagina de inicio
session_start();
// si recibe un POST con los datos del loguin se conectara con la base de datos para intentar hacer login.
if (isset($_POST["submit"])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "biblioteca";
    $conn = mysqli_connect($servername, $username, $password, $database);

    $user = $_POST["name"];
    $upassword = $_POST["password"];

    $consulta = "SELECT id_usuario, username , password,bibliotecario FROM usuario where username='$user' ";
    $resultado = $conn->query($consulta);

    while ($fila = $resultado->fetch_array()) {
        if (password_verify($upassword, $fila['password'])) {
            //En caso de login correcto se introduciran algunos datos importantes en la session como por ejemplo si es bibliotecario con permiso de administración
            $_SESSION['name'] = $_POST["name"];
            $_SESSION['id'] = $fila['id_usuario'];
            if ($fila['bibliotecario'] == true) {
                $_SESSION['admin'] = true;
            }
            header("Location: PaginaBusqueda.php");
        }
    }
}

if (isset($_SESSION['name'])) {
    //Si el login es correcto se redirigira a la paguina principal.
    header("Location: PaginaBusqueda.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Biblioteca</title>
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
		<h1>Biblioteca</h1>

		<form action='index.php' method='post'>
			<input type='text' name='name' id='name'> <input type='password'
				name='password' id='password'> <input type='submit' name='submit'
				value='Log in'>
		</form>
		</br> <a href='register.php'>Registrate</a>
	</div>
</body>
</html>