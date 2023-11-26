<html>
    <head>

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
            <input type="button" class="nav-link active" href="main.php" value="Vista General">
            <button onclick="MostrarPagina()">Entrada 1</button>
            <a class="nav-link" href="entrada2.php">Entrada 2</a>
            <a class="nav-link" href="entrada3.php">Entrada 3</a>
            <a class="nav-link" href="entrada4.php">Entrada 4</a>
            <a class="nav-link" href="entrada5.php">Entrada 5</a>
        </div>
        </div>
    </div>
    </nav>
    <script>
        function MostrarPagina(){
            fetch("entrada1.php")
                .then(response=>response.text())
                .then(data=>{
                    document.getElementById("resultado").innerHTML = data;
                })
                .catch(error=>console.log("Error"));
        }
    </script>
        <div class="conteiner">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>USUARIO</td>
                        <td>NOMBRE</td>
                        <td>HORA ENTRADA</td>
                        <td>HORA SALIDA</td>
                        <td>ENTRADA</td>
                        <td>SALIDA</td>
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
                    $sql2 = "SELECT IdIngreso, IdUsuario, Nombre, HoraEntrada, Entrada, Salida, HoraSalida, FormaLlegada, Placa, Estado from acceso";
                    $query2 = $con2->query($sql2);
                    while($row= $query2->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row['IdIngreso']?></td>
                        <td><?php echo $row['IdUsuario']?></td>
                        <td><?php echo $row['Nombre']?></td>
                        <td><?php echo $row['HoraEntrada']?></td>
                        <td><?php echo $row['HoraSalida']?></td>
                        <td><?php echo $row['Entrada']?></td>
                        <td><?php echo $row['Salida']?></td>
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
        <div id="resultado">

        </div>
    
        <script type="text/javascript" src="funciones.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    </body>
</html>