<?php
//require 'conexion.php';
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "qr_basedatos";
$con = new mysqli($server,$username,$password,$dbname);

if(isset($_POST['submit'])){
    $user = $_POST['txtuser'];
    $password = md5($_POST['txtpass']);
    $qadmin = "SELECT * from empleado where username = '$user' and contrasena = '$password' and entrada = 'administrad'";
    $consultaAdmin = $con->query($qadmin);
    $q1 = "SELECT * from empleado where username = '$user' and contrasena = '$password' and entrada = '1'";
    $q2 = "SELECT * from empleado where username = '$user' and contrasena = '$password' and entrada = '2'";
    $q3 = "SELECT * from empleado where username = '$user' and contrasena = '$password' and entrada = '3'";
    $q4 = "SELECT * from empleado where username = '$user' and contrasena = '$password' and entrada = '4'";
    $q5 = "SELECT * from empleado where username = '$user' and contrasena = '$password' and entrada = '5'";
    $consulta1 = $con->query($q1);
    $consulta2 = $con->query($q2);
    $consulta3 = $con->query($q3);
    $consulta4 = $con->query($q4);
    $consulta5 = $con->query($q5);
    
    if($consultaAdmin->num_rows>0){
        $_SESSION['username'] = $user;
        header('location:main.php');
    }else if($consulta1->num_rows>0){
        //
        $_SESSION['username'] = $user;
        header('location:entrada1.php');
    }else if($consulta2->num_rows>0){
        //
        $_SESSION['username'] = $user;
        header('location:entrada2.php');   
    }else if($consulta3->num_rows>0){
        //
        $_SESSION['username'] = $user;
        header('location:entrada3.php');
    }else if($consulta4->num_rows>0){
        //
        $_SESSION['username'] = $user;
        header('location:entrada4.php');
    }else if($consulta5->num_rows>0){
        //
        $_SESSION['username'] = $user;
        header('location:entrada5.php');
    }
}
?>