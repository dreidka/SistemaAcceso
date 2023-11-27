<?php
session_start();
$user = $_SESSION['username'];
if($user == 'user1'){
    $bandera = 1;
}elseif($user == 'user2'){
    $bandera = 2;
}elseif($user == 'user3'){
    $bandera = 3;
}elseif($user == 'user4'){
    $bandera = 4;
}elseif($user == 'user5'){
    $bandera = 5;
}
?>
<html>

    <head>

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
            <?php
            if($bandera==1){
               echo "<a class='nav-link active' aria-current='page' href='entrada1.php'>Entrada</a>";
            }elseif($bandera==2){
                echo "<a class='nav-link active' aria-current='page' href='entrada2.php'>Entrada</a>";
            }elseif($bandera ==3){
                echo "<a class='nav-link active' aria-current='page' href='entrada3.php'>Entrada</a>";
            }elseif($bandera==4){
                echo "<a class='nav-link active' aria-current='page' href='entrada4.php'>Entrada</a>";
            }elseif($bandera==5){
                echo "<a class='nav-link active' aria-current='page' href='entrada5.php'>Entrada</a>";
            }
            ?>
            
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
                        <td>VEHICULO</td>
                        <td>ID USUARIO</td>
                        <td>PLACA</td>
                        <td>ENTRADA</td>
                        <td>SALIDA</td>
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
                    if($bandera==1){
                        $sql2 = "SELECT * from vehiculos1";
                    }elseif($bandera==2){
                        $sql2 = "SELECT * from vehiculos2";
                    }elseif($bandera==3){
                        $sql2 = "SELECT * from vehiculos3";
                    }elseif($bandera==4){
                        $sql2 = "SELECT * from vehiculos4";
                    }elseif($bandera==5){
                        $sql2 = "SELECT * from vehiculos5";
                    }
                    $query2 = $con2->query($sql2);
                    while($row= $query2->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['IdVehiculo']?></td>
                        <td><?php echo $row['TipoVehiculo']?></td>
                        <td><?php echo $row['IdUsuario']?></td>
                        <td><?php echo $row['Placa']?></td>
                        <td><?php echo $row['Entrada']?></td>
                        <td><?php echo $row['Salida']?></td>
                        <td><?php echo $row['Estado']?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
                </body>
                <form action="vehiculos.php" method="post">
                <button name="eliminar" class="btn btn-danger">Eliminar</button>

                </form>
                <?php
                    if(isset($_POST['eliminar'])){
                        $sqlEliminar = "DELETE FROM vehiculo where Entrada = '$bandera'";
                        $queryEliminar = $con2->query($sqlEliminar);
                        if($queryEliminar===TRUE){
                            echo "Registros Eliminados";
                        }else{
                            echo "No se pueden eliminar";
                        }
                    }
                ?>
</html>