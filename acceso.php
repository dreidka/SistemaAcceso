<?php
            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "qr_basedatos";
            $time = date('H:i:s');
            $date = date('Y-m-d');
            $con = new mysqli($server,$username,$password,$dbname);
            function actualizar($con,$txtID,$txtName,$llegada,$placa,$rol,$estado,$salida,$entrada){
                $fecha_actual = date("d-m-Y");
                $sqlUsuario = "SELECT * FROM usuario WHERE IdUsuario ='$txtID'";
                $connUsuario = $con->query($sqlUsuario);
                if($connUsuario->num_rows>0){
                    $sql = "SELECT * FROM acceso WHERE IdUsuario = '$txtID' AND Estado='1' ";
                    $query = $con->query($sql);
                    if($query->num_rows>0){
                        $sql = "UPDATE acceso SET HoraSalida=NOW(), Estado = '0', Salida = '$salida' WHERE IdUsuario = '$txtID'";
                        $query = $con->query($sql);
                        
                    }else{
                        $sql = "INSERT INTO acceso (IdUsuario,HoraEntrada,Nombre,FormaLlegada,Placa,Entrada,Estado) values('$txtID','$fecha_actual','$txtName','$llegada','$placa','$entrada','$estado')";
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
                            $sql = "UPDATE acceso SET HoraSalida=NOW(), Estado = '0', Salida = '$salida' WHERE IdUsuario = '$txtID'";
                            $query = $con->query($sql);
                            
                        }else{
                            $sql = "INSERT INTO acceso (IdUsuario,HoraEntrada,Nombre,FormaLlegada,Placa,Entrada,Estado) values('$txtID',now(),'$txtName','$llegada','$placa','$entrada','$estado')";
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
                
            
        }
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
                $entrada = $_POST['txtEntrada'];
                $salida = $_POST['txtSalida'];
                /*--------------------------------------------------------------------*/
                $sqlUsuario = "SELECT * FROM usuario WHERE IdUsuario ='$txtID'";
                $connUsuario = $con->query($sqlUsuario);
                if($entrada == '1'){
                    actualizar($con,$txtID,$txtName,$llegada,$placa,$rol,$estado,$salida,1);
                    header("location: entrada1.php");
                }elseif($entrada == '2'){
                    actualizar($con,$txtID,$txtName,$llegada,$placa,$rol,$estado,$salida,2);
                    header("location: entrada2.php");
                }
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