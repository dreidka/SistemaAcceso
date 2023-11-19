<?php
            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "qr_basedatos";
            $time = date('H:m:s');
            $date = date('Y-m-d');
            $con = new mysqli($server,$username,$password,$dbname);
            if($con->connect_error){
                echo("Connection failed" .$con->connect_error);
            }
            if(isset($_POST['actualizar'])){
                $txtID = $_POST['txtID'];
                $txtName = $_POST['txtNombre'];
                $llegada = $_POST['opcLlegada'];
                $placa = $_POST['txtPlaca'];
                $rol = $_POST['txtRol'];
                $estado = $_POST['txtEstado'];
                
                /*--------------------------------------------------------------------*/
                $sqlUsuario = "SELECT * FROM usuario WHERE IdUsuario ='$txtID'";
                $connUsuario = $con->query($sqlUsuario);

                
                /*--------------------------------------------------------------------*/

                if($connUsuario->num_rows>0){
                    $sql = "SELECT * FROM acceso WHERE IdUsuario = '$txtID' AND Estado='1' ";
                    $query = $con->query($sql);
                    if($query->num_rows>0){
                        $sql = "UPDATE acceso SET HoraSalida=NOW(), Estado = '0' WHERE IdUsuario = '$txtID'";
                        $query = $con->query($sql);
                        
                    }else{
                        $sql = "INSERT INTO acceso (IdUsuario,HoraEntrada,Nombre,FormaLlegada,Placa,Estado) values('$txtID',NOW(),'$txtName','$llegada','$placa','$estado')";
                        $conn = $con->query($sql);
                        if($conn===TRUE){
                            echo "Usuario registrado";
                            
                        }else{
                            echo "Deseas ingresar usuario nuevo?";
                        }
                    }
                }else{
                    $insertUsuario = "INSERT INTO `usuario`(`IdUsuario`, `Nombre`, `IdRol`, `Estado`) VALUES ('$txtID','$txtName','$rol','$estado')";
                    $queryInsert = $con->query($insertUsuario);
                    if($queryInsert === TRUE){
                        $sql = "SELECT * FROM acceso WHERE IdUsuario = '$txtID' AND Estado='1' ";
                        $query = $con->query($sql);
                        if($query->num_rows>0){
                            $sql = "UPDATE acceso SET HoraSalida=NOW(), Estado = '0' WHERE IdUsuario = '$txtID'";
                            $query = $con->query($sql);
                            
                        }else{
                            $sql = "INSERT INTO acceso (IdUsuario,HoraEntrada,Nombre,FormaLlegada,Placa,Estado) values('$txtID',NOW(),'$txtName','$llegada','$placa','$estado')";
                            $conn = $con->query($sql);
                            if($conn===TRUE){
                                echo "Usuario registrado";
                            }else{
                                echo "Deseas ingresar usuario nuevo?";
                            }
                        }
                    }else{
                        echo "Error";
                    }
                    
                }
                header("location: index.php");
               
            }
            if(isset($_POST['eliminar'])){
                $sqlEliminar = "DELETE FROM acceso";
                $queryEliminar = $con->query($sqlEliminar);
                if($queryEliminar===TRUE){
                    echo "Registros Eliminados";
                }else{
                    echo "No se pueden eliminar";
                }
            }
            $con->close();
?>