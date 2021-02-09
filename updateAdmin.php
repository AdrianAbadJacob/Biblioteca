
<?php
// Comprovacion de que el usuario es administrador, en caso contrario devuelve a PaginaBusqueda.php
session_start();

if (isset($_SESSION["admin"])) {} else {
    header("Location: PaginaBusqueda.php");
}

// este archivo php recibe un nombre de usuario por POST y redirecciona al perfil.php con la id del usuario recibido.
$servername = "localhost";
$username = "root";
$password = "";
$database = "biblioteca";
$conn = mysqli_connect($servername, $username, $password, $database);

$user = $_POST["name"];

$consulta = "SELECT id_usuario FROM usuario where username='" . $user . "'";

$resultado = $conn->query($consulta);

while ($fila = $resultado->fetch_array()) {

    header("Location: perfil.php?id=" . $fila["id_usuario"]);
}

?>