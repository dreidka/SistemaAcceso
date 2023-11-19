
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    </head>
    <body>
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
                    $rol=null;
                    $estado=null;
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
        <input type="submit" value="Enviar" name="submit" class="btn btn-success"> 
        </form>
        </div>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>