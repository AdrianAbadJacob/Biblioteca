<?php
session_start();
if(isset($_SESSION['id'])){
    if($_SESSION["id"]==$_POST["id"]||isset($_SESSION["admin"])){
        
    }else{
        header("Location: PaginaBusqueda.php");
    }
    
}else{
    header("Location: PaginaBusqueda.php");
}

if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $user = $_POST["username"];
    $upassword = $_POST["password"];
    $hash = password_hash($upassword, PASSWORD_DEFAULT);
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $adress = $_POST["adress"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    
    $updates = array();
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "biblioteca";
    
    
    if($user!=""){
        array_push($updates,"username='".$user."'");
    }
    if($upassword!=""){
        array_push($updates,"password='".$hash."'");
    }
    if($name!=""){
        array_push($updates,"name='".$name."'");
    }
    if($surname!=""){
        array_push($updates,"surname='".$surname."'");
    }
    if($adress!=""){
        array_push($updates,"adress='".$adress."'");
    }
    if($phone!=""){
        array_push($updates,"phone=".$phone);
    }if($email!=""){
        array_push($updates,"email='".$email."'");
    }
  
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Fallo al conectarse a la base de datos: " . mysqli_connect_error());
    }
    
    foreach($updates as $valor){
        mysqli_query($conn,"Update usuario set $valor where id_usuario=".$id) ;
        
        //echo "Update usuario set $valor where id_usuario=".$id;
    }
    header("Location: perfil.php?id=".$id);
}