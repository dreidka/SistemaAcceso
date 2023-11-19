<?php
ob_start();
?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    </head>
    <body>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>

<?php
$html = ob_get_clean();
require_once 'Librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);

$dompdf->load_html($html);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("ReporteAcceso.pdf",array("Attachment"=>false));
?>