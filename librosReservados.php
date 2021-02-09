<?php
//Esta pagina se le llama mediante include y recoje la id del usuario por la $_SESSION para devolver una tabla con todos los libros que el usuario tiene reservados en el momento
$id = $_SESSION['id'];

$consulta = "select * from (SELECT id_reserva,id_usuario,id_libro, MAX(final) as final FROM reserva GROUP BY id_libro having `id_usuario`=" . $id . ")as t ,libro where libro.id_libro = t.id_libro";

$servername = "localhost";
$username = "root";
$password = "";
$database = "biblioteca";
$conn = mysqli_connect($servername, $username, $password, $database);

$resultado = $conn->query($consulta);
$numResultado = mysqli_num_rows($resultado);

echo "<table class='center'>";
if ($numResultado > 0) {
    echo "<tr><td colspan='2'>Libros Reservados:</td></tr>";
}

while ($fila = $resultado->fetch_array()) {
    echo "<tr>";
    $hoy = date("Y-m-d");
    $dia = $fila['final'];
    if ($dia > $hoy) {
        echo "<td>" . $fila['titulo'] . "</td><td>Reservado hasta el " . $dia . "</td>";
    }
    echo "</tr>";
}

echo "</table>";