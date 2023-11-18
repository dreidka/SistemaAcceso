<?php
            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "qr_basedatos";
            $time = date('H:m:s');
            $date = date('Y-m-d');
            $con = new mysqli($server,$username,$password,$dbname);
            if($con->connect_error){
                die("Connection failed" .$con->connect_error);
            }
            if(isset($_POST['submit'])){
                $txtID = $_POST['txtID'];
                $txtName = $_POST['txtNombre'];
                $llegada = $_POST['opcLlegada'];
                $placa = $_POST['txtPlaca'];
                $estado = $_POST['txtEstado'];
                $sql = "SELECT * FROM acceso WHERE IdUsuario = '$txtID' AND Estado='1' ";
                $query = $con->query($sql);
                if($query->num_rows>0){
                    $sql = "UPDATE acceso SET HoraSalida=NOW(), Estado = '0' WHERE IdUsuario = '$txtID'";
                    $query = $con->query($sql);
                    header("location: index.php");
                }else{
                    $sql = "INSERT INTO acceso (IdUsuario,HoraEntrada,Nombre,FormaLlegada,Placa,Estado) values('$txtID',NOW(),'$txtName','$llegada','$placa','$estado')";
                    $conn = $con->query($sql);
                    if($conn===TRUE){
                        echo "Usuario registrado";
                        header("location: index.php");
                    }else{
                        echo "Deseas ingresar usuario nuevo?";
                    }
                }
               
            }
            $con->close();
?>