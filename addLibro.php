
<?php
// comprovacion de que el usuario es administrador, en caso contrario devuelve a PaginaBusqueda.php
session_start();

if (isset($_SESSION["admin"])) {} else {
    header("Location: PaginaBusqueda.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Administracion</title>
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
		<h1>Insertar libro:</h1>
		<form action="addLibro.php" method="post"
			enctype="multipart/form-data">
			Titulo :<input type="text" name="titulo" id="titulo" required><br>
			Autor :<input type="text" name="autor" id="autor" required><br>
			Editorial :<input type="text" name="editorial" id="editorial"
				required><br> Sinopsis :<input type="text" name="sinopsis"
				id="sinopsis" required><br> Foto:<input type="file" name="file"
				id="file"> <input type="submit" name="submit" value="Enviar">

		</form>
	
    <?php
    // si recibe el POST intentara introduc el libro en la base de datos
    if (isset($_POST["submit"])) {
        $titulo = $_POST["titulo"];

        $autor = $_POST["autor"];
        $editorial = $_POST["editorial"];
        $sinopsis = $_POST["sinopsis"];

        $tname = $_FILES["file"]["tmp_name"];
        $name = "img/" . $_FILES["file"]["name"];

        move_uploaded_file($tname, $name);

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "biblioteca";

        $conn = mysqli_connect($servername, $username, $password, $database);
        if (! $conn) {
            die("Fallo al conectarse a la base de datos: " . mysqli_connect_error());
        }
        // A continuacion saltaran alertas de javascript informando del exito o fracaso del insert.
        if (mysqli_query($conn, "INSERT INTO `libro` (`titulo`, `autor`, `editorial`, `sinopsis`, `imgurl`) VALUES ('$titulo', '$autor', '$editorial',  '$sinopsis', '$name')")) {
            echo "<script type='text/javascript'>
            alert('Se ha insertado el libro correctamente');
            window.location.href='addLibro.php';
            </script>";
        } else {
            echo "<script type='text/javascript'>
            alert('No se ha podido insertar el libro.');
            window.location.href='addLibro.php';
            </script";
        }
    }
    ?>
    <br>
		<button onclick="document.location='PaginaBusqueda.php'">Volver</button>
	</div>
</body>
</html>