<?php
            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "qr_basedatos";
            
            $con = new mysqli($server,$username,$password,$dbname);
            function actualizar($con,$txtID,$txtName,$correo,$llegada,$placa,$rol,$estado,$salida,$entrada){
                
                $time = date('H:i:s');
                $date = date('Y-m-d');
                $sqlUsuario = "SELECT * FROM usuario WHERE IdUsuario ='$txtID'";
                $connUsuario = $con->query($sqlUsuario);
                if($connUsuario->num_rows>0){
                    $sql = "SELECT * FROM acceso WHERE IdUsuario = '$txtID' AND Estado='1' ";
                    $query = $con->query($sql);
                    if($query->num_rows>0){
                        $sql = "UPDATE acceso SET HoraSalida=NOW(), Estado = '0', Salida = '$salida' WHERE IdUsuario = '$txtID' and Estado = '1'";
                        $query = $con->query($sql);

                        //
                        $consultavehiculo = $con->query("SELECT v.IdVehiculo, v.TipoVehiculo, u.IdUsuario,v.Placa , v.Entrada, v.Salida, v.Estado FROM vehiculo v join usuario u on u.IdUsuario = v.IdUsuario join acceso a on a.IdUsuario = u.IdUsuario where v.Estado='1' and v.IdUsuario = '$txtID' and a.Placa = v.Placa");
                        if($consultavehiculo->num_rows>0){
                            $sqlUpdateVehiculo = "UPDATE vehiculo SET Estado = '0', Salida = '$salida' WHERE IdUsuario = '$txtID' and Estado = '1'";
                            $query = $con->query($sqlUpdateVehiculo);
                        }
                        //
                        $texto = "Se le informa al usuario ".$txtName." que Salio por la salida ". $salida. " de la institucion universidad francisco jose de caldas a las ".$time. " del dia ".$date;
                        $asunto = $_POST['txtAsunto'] ;
                        //$correo = "Papercut@papercut.com";
                        $cabeceras = "From:".$correo . "\r\n" .
                            "Reply-To: Papercut@user.com" . "\r\n" .
                            "X-Mailer: PHP/" . phpversion();
                        $from = "Papercut@user.com";
                        $mail = mail($from, $asunto, $texto, $cabeceras);
                    }else{
                        $sql = "INSERT INTO acceso (IdUsuario,HoraEntrada,Nombre,FormaLlegada,Placa,Entrada,Estado) values('$txtID',now(),'$txtName','$llegada','$placa','$entrada','$estado')";
                        if($llegada != 'Camina' and $llegada!='Acompañante'){
                            $sqlInsertVehiculo = $con->query("INSERT INTO vehiculo (TipoVehiculo,IdUsuario,Placa,Entrada,Estado) values('$llegada','$txtID','$placa','$entrada',1)");
                            if($sqlInsertVehiculo==true){
                                echo "Vehiculo Registrado";
                            }
                        }
                        $conn = $con->query($sql);
                        $texto = "Se le informa al usuario ".$txtName." que Ingreso por la entrada ". $entrada. " de la institucion universidad francisco jose de caldas a las ".$time. " del dia ".$date;
                        $asunto = $_POST['txtAsunto'] ;
                        //$correo = "Papercut@papercut.com";
                        $cabeceras = "From:".$correo . "\r\n" .
                            "Reply-To: Papercut@user.com" . "\r\n" .
                            "X-Mailer: PHP/" . phpversion();
                        $from = "Papercut@user.com";
                        $mail = mail($from, $asunto, $texto, $cabeceras);
                        if($conn===TRUE){
                            echo "Usuario registrado";
                            
                        }else{
                            echo "Deseas ingresar usuario nuevo?";
                        }
                    } 
                }else{
                    $insertUsuario = "INSERT INTO `usuario`(`IdUsuario`, `Nombre`, `IdRol`, `Estado`,`Correo`) VALUES ('$txtID','$txtName','$rol','$estado','$correo')";
                    $queryInsert = $con->query($insertUsuario);
                    if($queryInsert === TRUE){
                        $sql = "SELECT * FROM acceso WHERE IdUsuario = '$txtID' AND Estado='1' ";
                    $query = $con->query($sql);
                    if($query->num_rows>0){
                        $sql = "UPDATE acceso SET HoraSalida=NOW(), Estado = '0', Salida = '$salida' WHERE IdUsuario = '$txtID' and Estado = '1'";
                        $query = $con->query($sql);

                        //
                        $consultavehiculo = $con->query("SELECT v.IdVehiculo, v.TipoVehiculo, u.IdUsuario,v.Placa , v.Entrada, v.Salida, v.Estado FROM vehiculo v join usuario u on u.IdUsuario = v.IdUsuario join acceso a on a.IdUsuario = u.IdUsuario where v.Estado='1' and v.IdUsuario = '$txtID' and a.Placa = v.Placa");
                        if($consultavehiculo->num_rows>0){
                            $sqlUpdateVehiculo = "UPDATE vehiculo SET Estado = '0', Salida = '$salida' WHERE IdUsuario = '$txtID' and Estado = '1'";
                            $query = $con->query($sqlUpdateVehiculo);
                        }
                        //
                        $texto = "Se le informa al usuario ".$txtName." que Salio por la salida ". $salida. " de la institucion universidad francisco jose de caldas a las ".$time. " del dia ".$date;
                        $asunto = $_POST['txtAsunto'] ;
                        //$correo = "Papercut@papercut.com";
                        $cabeceras = "From:".$correo . "\r\n" .
                            "Reply-To: Papercut@user.com" . "\r\n" .
                            "X-Mailer: PHP/" . phpversion();
                        $from = "Papercut@user.com";
                        $mail = mail($from, $asunto, $texto, $cabeceras);
                    }else{
                        $sql = "INSERT INTO acceso (IdUsuario,HoraEntrada,Nombre,FormaLlegada,Placa,Entrada,Estado) values('$txtID',now(),'$txtName','$llegada','$placa','$entrada','$estado')";
                        if($llegada != 'Camina' and $llegada!='Acompañante'){
                            $sqlInsertVehiculo = $con->query("INSERT INTO vehiculo (TipoVehiculo,IdUsuario,Placa,Entrada,Estado) values('$llegada','$txtID','$placa','$entrada',1)");
                            if($sqlInsertVehiculo==true){
                                echo "Vehiculo Registrado";
                            }
                        }
                        $conn = $con->query($sql);
                        $texto = "Se le informa al usuario ".$txtName." que Ingreso por la entrada ". $entrada. " de la institucion universidad francisco jose de caldas a las ".$time. " del dia ".$date;
                        $asunto = $_POST['txtAsunto'] ;
                        //$correo = "Papercut@papercut.com";
                        $cabeceras = "From:".$correo . "\r\n" .
                            "Reply-To: Papercut@user.com" . "\r\n" .
                            "X-Mailer: PHP/" . phpversion();
                        $from = "Papercut@user.com";
                        $mail = mail($from, $asunto, $texto, $cabeceras);
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
                $correo = $_POST['txtCorreo'];
                $salida = $_POST['txtSalida'];
                /*--------------------------------------------------------------------*/
                $sqlUsuario = "SELECT * FROM usuario WHERE IdUsuario ='$txtID'";
                $connUsuario = $con->query($sqlUsuario);
                if($entrada == '1'){
                    actualizar($con,$txtID,$txtName,$correo,$llegada,$placa,$rol,$estado,$salida,1);
                    header("location: entrada1.php");
                }elseif($entrada == '2'){
                    actualizar($con,$txtID,$txtName,$correo,$llegada,$placa,$rol,$estado,$salida,2);
                    header("location: entrada2.php");
                }elseif($entrada == '3'){
                    actualizar($con,$txtID,$txtName,$correo,$llegada,$placa,$rol,$estado,$salida,3);
                    header("location: entrada3.php");
                }elseif($entrada == '4'){
                    actualizar($con,$txtID,$txtName,$correo,$llegada,$placa,$rol,$estado,$salida,4);
                    header("location: entrada4.php");
                }elseif($entrada == '5'){
                    actualizar($con,$txtID,$txtName,$correo,$llegada,$placa,$rol,$estado,$salida,5);
                    header("location: entrada5.php");
                }
            }
            if(isset($_POST['eliminar'])){
                $entrada = $_POST['txtEntrada'];
                echo "Estas seguro de eliminar los registros?";?>

                <form action="acceso.php" method="post">
                <button name='Conservar' onclick='window.location.reload()' class='btn btn-primary'>Conservar</button>
                <button name='confirmacion' class='btn btn-danger'>Eliminar</button>
                </form>

        <?php
                if(isset($_POST['confirmacion'])){
                    $sqlEliminar = "DELETE FROM acceso where Entrada = '$entrada'";
                    $queryEliminar = $con->query($sqlEliminar);
                    if($queryEliminar===TRUE){
                        echo "Registros Eliminados";
                    }else{
                        echo "No se pueden eliminar";
                    }
                }elseif(isset($_POST['Conservar'])){
                    header("location: entrada".$entrada.".php");
                }
                
            }
            $con->close();
?>