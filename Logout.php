<?php
//Pagina simple para borrar la session y reevial al indice.
session_start();
session_destroy();
header("Location: index.php");