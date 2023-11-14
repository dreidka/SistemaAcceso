<?php
            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "qr_basedatos";

            $con = new mysqli($server,$username,$password,$dbname);
        
            if($con->connect_error){
                die("Connection failed" .$con->connect_error);
            }
            if(isset($_POST['submit'])){
                $txtID = $_POST['txtID'];
                $llegada = $_POST['opcLlegada'];
                $placa = $_POST['txtPlaca'];
                $sql = "INSERT INTO acceso (IdUsuario,HoraEntrada,FormaLlegada,Placa) values('$txtID',NOW(),'$llegada','$placa')";
                $conn = $con->query($sql);
                if($conn===TRUE){
                    echo "Usuario registrado";
                    header("location: insert1.php");
                }else{
                    echo "Deseas ingresar usuario nuevo?";
                }
            }
            $con->close();
?>