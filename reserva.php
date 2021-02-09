<?php
session_start();
if (isset($_SESSION["name"])) {} else {
    header("Location: index.php");
}

if (isset($_GET['id'])) {
    //recibe datos de GET y SESSION
    $idUser = $_SESSION['id'];
    $idLibro = $_GET['id'];
    $inicio = date("Y-m-d");

    // la reserva tiene un limite de 2 semanas.
    $fin = mktime(0, 0, 0, date("m"), date("d") + 14, date("Y"));
    //$final es la fecha actual + dos semanas.
    $final = date("Y-m-d", $fin);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "biblioteca";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if (! $conn) {
        die("Fallo al conectarse a la base de datos: " . mysqli_connect_error());
    }
    
    //A continuacion de enseñara una alert con el resultado de la reserva.
    if (mysqli_query($conn, "INSERT INTO `reserva` (`id_usuario`, `id_libro`, `inicio`, `final`) VALUES ('$idUser', '$idLibro', '$inicio',  '$final')")) {
        echo "<script type='text/javascript'>
            alert('Se ha reservado el libro correctamente, tienes hasta el $final para devolverlo');
            window.location.href='reserva.php';
            </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Error al reservar el libro');
            window.location.href='reserva.php';
            </script>";
    }
    header("Location: PaginaBusqueda.php");
}

?>