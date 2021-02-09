<?php
// Este metodo es llamado mediante ajax y recibe un string mediante GET, este string lo introduce en una query y nos devuelve una tabla con todos los resultados.
$busqueda = $_GET["buscar"];

$servername = "localhost";
$username = "root";
$password = "";
$database = "biblioteca";
$conn = mysqli_connect($servername, $username, $password, $database);
if ($busqueda != "") {
    $consulta = "select * from (SELECT libro.id_libro,libro.imgurl, libro.titulo , libro.sinopsis ,libro.autor , r.final
                                                        FROM libro left join (SELECT id_reserva,id_usuario,id_libro, MAX(final) as final FROM reserva GROUP BY id_libro) r on libro.id_libro=r.id_libro) t
                                                        where titulo like '%$busqueda%' or autor like '%$busqueda%';";

    $resultado = $conn->query($consulta);
    echo "<table class='center'>";
    echo "<tr>";
    echo "<td>Imagen</td>";
    echo "<td>Titulo</td>";
    echo "<td>Autor</td>";
    echo "<td>Sinopsis</td>";
    echo "<td>Reserva</td>";
    echo "</tr>";

    while ($fila = $resultado->fetch_array()) {
        echo "<tr>";
        echo "<td><img src='" . $fila['imgurl'] . "' width='200' height='200'></td>";
        echo "<td><a href='libro.php?id=" . $fila['id_libro'] . "'>" . $fila['titulo'] . "</a></td>";
        echo "<td>" . $fila['autor'] . "</td>";
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