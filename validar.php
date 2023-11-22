<?php
//require 'conexion.php';
//session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "qr_basedatos";
$con = new mysqli($server,$username,$password,$dbname);

if(isset($_POST['submit'])){
    $user = $_POST['txtuser'];
    $password = md5($_POST['txtpass']);
    $q = "SELECT * from empleado where username = '$user' and contrasena = '$password' and entrada = 'administrad'";
    $consulta = $con->query($q);
    
    if($consulta->num_rows>0){
        header('location:entrada1.php');
    }else{
        echo "No se puede iniciar sesion";
    }
}
?>