
<?php
session_start();
//Si el usuario no esta logeado se redirigira a index.php
if (isset($_SESSION["name"])) {} else {
    header("Location: index.php");
}
?>

    <!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Biblioteca</title>
    <script>
		
			function buscar(){
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() { 
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("resultado").innerHTML  = this.response;
				}
			};
			var busqueda = document.getElementById("buscar").value;
			
			xhttp.open("GET", "buscador.php?buscar="+busqueda, true); 
			xhttp.send();
			}
		</script>
    <style type="text/css">
        .center{
            padding: 20px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
    </style>
</head>
<body >	
	<div class="center">
	<h1>Biblioteca</h1>
	    <?php
    
 
        echo "Bienvenid@ ".$_SESSION['name'];
        echo "<br><a href='Logout.php'>Logout</a>";
        if(isset($_SESSION['admin'])){
            echo "<br><a href='Admin.php'>Administracion</a>";
        }
        echo "<br><a href='Perfil.php?id=".$_SESSION['id']."'>Perfil</a>";
       
        echo "
        	<br><input type='text' id='buscar' name='buscar'> 
    		<input type='button' value='Buscar' onclick='buscar()'>
    		<div id='resultado'></div>";
   
        //incluye una tabla que a partir del id del usuario muestra los libros reservados por el usuario.
        include "librosReservados.php";
    ?>
    </div>
</body>
</html>