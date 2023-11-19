<html>
    <head>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    </head>
    <body>
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
                    $sql2 = "SELECT IdIngreso, IdUsuario, Nombre, HoraEntrada, HoraSalida, FormaLlegada, Placa, Estado from acceso";
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
                        <td><?php echo $row['Placa']?></td>
                        <td><?php echo $row['Estado']?></td>
                        
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        <a style="text-align: center; display: inline-block;" href="reportes.php" class="btn btn-primary">Reportes PDF</a>
        </div>
        <br>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <video id="preview" width="100%"></video>                    
                </div>
                <div class="col-md-6">
                    <form action="index.php" method="post" class="form-horizontal">
                        <label>SCAN QR CODE</label>
                        <input type="text" name="text" id="txt1" placeholder="scann qr" class="from-control">
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
        <div class="d-flex">
        <div class="card col-sm-6">
        <div class="card-body">
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
                $sql = "SELECT Nombre,IdRol,Estado FROM usuario WHERE IdUsuario ='$text'";
                $con = $con->query($sql);
                if( $con->num_rows>0){
                    echo "Usuario registrado";
                    while($row = $con->fetch_array()){
                        $name=$row['Nombre'];
                        $rol=$row['IdRol'];
                        $estado=$row['Estado'];
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
            <input type="text" name="txtID" value="<?php echo $text?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="txtNombre" value="<?php echo $name?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Rol</label>
            <input type="text" name="txtRol" value="<?php echo $rol?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Estado</label>
            <input type="text" name="txtEstado" value="<?php echo $estado?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select name="opcLlegada" class="form-control">                   
                <option>Camina</option>
                <option>Moto</option>
                <option>Carro</option>
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
    </body>
</html>