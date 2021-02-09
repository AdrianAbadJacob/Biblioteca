
<?php
session_start();

if(isset($_SESSION["id"])||isset($_SESSION["admin"])){
    if($_SESSION["id"]=$_GET['id']){
        
    }else{
        header("Location: PaginaBusqueda.php");
    }
    
}else{
    header("Location: index.php");
}
?>

    <!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Perfil</title>
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
	
    <?php
    //La pagina recibe la id de un usuario y devuelve un formulario con los datos del usuario que redirige a updateUser.php .
    $id=$_GET['id'];
    echo "Bienvenid@ ".$_SESSION['name'];
    echo "<br><a href='Logout.php'>Logout</a>";
    if(isset($_SESSION['admin'])){
        echo "<br><a href='Admin.php'>Administracion</a>";
    }
    echo "<br><a href='PaginaBusqueda.php'>Pagina Principal</a><br>";
    

   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "biblioteca";
    $conn = mysqli_connect($servername, $username, $password, $database);

    $consulta = "select * from usuario where id_usuario='$id'";
    
    $resultado = $conn->query($consulta);
   
        
    while($fila = $resultado->fetch_array()) {
        echo "<form action='updateUser.php?' method='post' >
                <input type='hidden' name='id' id='".$id."' value='".$id."'>
                User  :".$fila['username']."<input type='text' name='username' id='username' ><br>
        		Password   :<input type='text' name='password' id='password' ><br>
        		Nombre     :".$fila['name']."<input type='text' name='name' id='name' ><br>
        		Apellido      :".$fila['surname']."<input type='text' name='surname' id='surname' ><br>
        		Direccion :".$fila['adress']."<input type='text' name='adress' id='adress'><br>
        		Telefono:".$fila['phone']."<input type='number' name='phone' id='phone' ><br>
        		Email:".$fila['email']."<input type='text' name='email' id='email' ><br>
        		<input type='submit' name='submit' value='Enviar'>
        	</form>";
     
    }
    ?>
    
    
    </div>
</body>
</html>
