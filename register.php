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
		<h1>Registro:</h1>
		<form action="register.php" method="post">
			User :<input type="text" name="user" id="user" required><br> Password
			:<input type="text" name="password" id="password" required><br>
			Nombre :<input type="text" name="name" id="name" required><br>
			Apellido :<input type="text" name="surname" id="surname" required><br>
			Direccion :<input type="text" name="adress" id="adress" required><br>
			Telefono:<input type="number" name="phone" id="phone" required><br>
			Email:<input type="text" name="email" id="email" required><br> <input
				type="submit" name="submit" value="Enviar">

		</form>
	
    <?php
    // Esta pagina recibe y enseña el formulario para registrar a los usuarios
    if (isset($_POST["submit"])) {
        $user = $_POST["user"];
        $upassword = $_POST["password"];
        $hash = password_hash($upassword, PASSWORD_DEFAULT);
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $adress = $_POST["adress"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "biblioteca";

        $conn = mysqli_connect($servername, $username, $password, $database);
        if (! $conn) {
            die("Fallo al conectarse a la base de datos: " . mysqli_connect_error());
        }

        if (mysqli_query($conn, "INSERT INTO `usuario` (`username`, `password`, `name`, `surname`, `adress`, `phone` ,`email`) VALUES ('$user', '$hash', '$name',  '$surname', '$adress',$phone,'$email')")) {
            echo "<script type='text/javascript'>
            alert('Gracias por registrarte $name');
            window.location.href='register.php';
            </script>";
        } else {
            echo "Error al registrarse, por favor intente un username distinto.";
        }
    }
    ?>
    <br>
		<button onclick="document.location='PaginaBusqueda.php'">Volver</button>
	</div>
</body>
</html>