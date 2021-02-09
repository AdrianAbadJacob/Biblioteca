<?php
session_start();
//Si el usuario no esta logeado se redirigira a index.php
if (isset($_SESSION["name"])) {} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>S
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
	
	<?php
    //Esta pagina recibe una id de libro a través de GET y devuelve una tabla con toda la información del libro.
    echo "Bienvenid@ " . $_SESSION['name'];
    echo "<br><a href='Logout.php'>Logout</a>";
    if (isset($_SESSION['admin'])) {
        echo "<br><a href='Admin.php'>Administracion</a>";
    }
    echo "<br><a href='Perfil.php?id=" . $_SESSION['id'] . "'>Perfil</a>";
    echo ("
        <form action='PaginaBusqueda.php' method='post'>
        <input type='text' name='busqueda' id='busqueda'>
        <input type='submit' name='buscador' value='Busca'>
        </form>
        ");

    if (isset($_GET['id'])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "biblioteca";
        $conn = mysqli_connect($servername, $username, $password, $database);

        $busqueda = $_GET["id"];

        if ($busqueda != "" || $busqueda != null) {
            $consulta = "select * from (SELECT libro.id_libro,libro.imgurl, libro.titulo , libro.sinopsis ,libro.editorial,libro.autor , r.final 
                                                    FROM libro left join (SELECT id_reserva,id_usuario,id_libro, MAX(final) as final FROM reserva GROUP BY id_libro) r on libro.id_libro=r.id_libro) t 
                                                    where id_libro= $busqueda;";
           
            $resultado = $conn->query($consulta);
            echo "<table class='center'>";
            echo "<tr>";
            echo "<td>Imagen</td>";
            echo "<td>Titulo</td>";
            echo "<td>Autor</td>";
            echo "<td>Editorial</td>";
            echo "<td>Sinopsis</td>";
            echo "<td>Reserva</td>";
            echo "</tr>";
            while ($fila = $resultado->fetch_array()) {
                echo "<tr>";
                echo "<td><img src='" . $fila['imgurl'] . "' width='200' height='200'></td>";
                echo "<td>" . $fila['titulo'] . "</td>";
                echo "<td>" . $fila['autor'] . "</td>";
                echo "<td>" . $fila['editorial'] . "</td>";
                echo "<td>" . $fila['sinopsis'] . "</td>";
                $hoy = date("Y-m-d");
                $dia = $fila['final'];
                if ($dia > $hoy) {
                    echo "<td>Reservado hasta el " . $dia . "</td>";
                } else {
                    echo "<td><a href='reserva.php?id=" . $fila['id_libro'] . "'>Reservar</a></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    ?>
    <br>
		<button onclick="document.location='PaginaBusqueda.php'">Volver</button>

	</div>
</body>
</html>