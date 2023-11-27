<html>
    <head>
    <?php
session_start();
$user = $_SESSION['username'];
?>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="entrada4.php">Entrada 4</a>
            <a class="nav-link" href="reportes.php">Reportes</a>
            <a class="nav-link" href="vehiculos.php">Vehiculos</a>
            <a class="btn btn-danger" href="index.php">Salir</a>

        </div>
        </div>
    </div>
    </nav>
        <div class="conteiner">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>USUARIO</td>
                        <td>NOMBRE</td>
                        <td>HORA ENTRADA</td>
                        <td>HORA SALIDA</td>
                        <td>MEDIO LLEGADA</td>
                        <td>ENTRADA</td>
                        <td>SALIDA</td>
                        <td>PLACA</td>
                        <td>ESTADO</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $server = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "qr_basedatos";
          
                    $con2 = new mysqli($server,$username,$password,$dbname);
                    if($con2->connect_error){
                        die("Connection failed" .$con2->connect_error);
                    }
                    //CAMBIAR
                    $sql2 = "SELECT * from acceso4";
                    $query2 = $con2->query($sql2);
                    while($row= $query2->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['IdIngreso']?></td>
                        <td><?php echo $row['IdUsuario']?></td>
                        <td><?php echo $row['Nombre']?></td>
                        <td><?php echo $row['HoraEntrada']?></td>
                        <td><?php echo $row['HoraSalida']?></td>
                        <td><?php echo $row['FormaLlegada']?></td>
                        <td><?php echo $row['Entrada']?></td>
                        <td><?php echo $row['Salida']?></td>
                        <td><?php echo $row['Placa']?></td>
                        <td><?php echo $row['Estado']?></td>
                        
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        <a style="text-align: center; display: inline-block;" href="reportespdf.php" class="btn btn-primary">Reportes PDF</a>
        </div>
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <video id="preview" width="100%"></video>                    
                </div>
                <div class="col-md-6">
                    <!-- CAMBIAR -->

                    <form action="entrada4.php" method="post" class="form-horizontal">
                        <label>SCAN QR CODE</label>
                        <input type="text" name="text" id="txt1" placeholder="scann qr" class="from-control">
                    </form>
                    <form method="post" action="acceso.php">
        <?php
            $server = "localhost";
            $username = "root";
            $password = "";
            $dbname = "qr_basedatos";

            $con = new mysqli($server,$username,$password,$dbname);
        
            if($con->connect_error){
                die("Connection failed" .$con->connect_error);
            }
            if(isset($_POST['text'])){
                $text = $_POST['text'];
                $name;
                $rol;
                $estado;
                $correo;
                $sql = "SELECT Nombre,IdRol,Estado,Correo FROM usuario WHERE IdUsuario ='$text'";
                $con = $con->query($sql);
                if( $con->num_rows>0){
                    echo "Usuario registrado";
                    while($row = $con->fetch_array()){
                        $name=$row['Nombre'];
                        $rol=$row['IdRol'];
                        $estado=$row['Estado'];
                        $correo=$row['Correo'];
                    }
                }else{
                    echo "Usuario no registrado";
                    $name=null;
                    $rol=4;
                    $estado=1;
                }
            }
            $con->close();
        ?>
        <div class="form-group">
            <label>Id</label>
            <input type="text" name="txtID" value="<?php echo $text?>" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="txtNombre" value="<?php echo $name?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Correo</label>
            <input type="text" name="txtCorreo" value="<?php echo $correo?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Rol</label>
            <input type="text" name="txtRol" value="<?php echo $rol?>" class="form-control">
            <label>1.Administrativo</label>
            <label>2.Estudiante</label>
            <label>3.Docente</label>
            <label>4.Invitado</label>
        </div>
        <div class="form-group">
            <label>Entrada</label>
            <!-- CAMBIAR -->
            <input type="text" name="txtEntrada" value=4 class="form-control">
        </div>
        <div class="form-group">
            <label>Salida</label>
            <!-- CAMBIAR -->
            <input type="text" name="txtSalida" value=4 class="form-control">
        </div>
        <div class="form-group">
            <label>Estado</label>
            <input type="text" name="txtEstado" value="<?php echo $estado?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Llegada</label>
            <select name="opcLlegada" class="form-control">                   
                <option>Camina</option>
                <option>Moto</option>
                <option>Carro</option>
                <option>Bicicleta</option>
                <option>Acompañante</option>
            </select>  
        </div>
        <div class="form-group">
            <label>Placa</label>
            <input type="text" name="txtPlaca"class="form-control" name="txtPlaca">
        </div>
        <br>
        <button name="actualizar" onclick="window.location.reload()" class="btn btn-primary">Actualizar</button>
        <button name="eliminar" class="btn btn-danger">Eliminar</button>

        </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
            
            Instascan.Camera.getCameras().then(function (cameras){
                if(cameras.length>0){
                    scanner.start(cameras[0]);
                }else{
                    console.error('No cameras found.');
                    alert('No cameras found.');
                }
            }).catch(function(e){
                console.error(e);
                alert(e);
            });
            scanner.addListener('scan',function(content){
                document.getElementById('txt1').value=content; 
                //window.location.href=content;
                document.forms[0].submit();

            });
        </script>
        
    </body>
</html>