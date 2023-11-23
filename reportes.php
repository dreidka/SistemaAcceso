
<?php
require 'conexion.php';
session_start();
$user = $_SESSION['username'];
$consulta = "SELECT correo FROM empleado where username='$user'";
$qConsulta = $con->query($consulta);
//while($row = $qConsulta->fetch_array()){
  //  $correo = $row['correo'];
//}
if(isset($_POST['enviar'])){
    if(!empty($_POST['txtAsunto'])&&!empty($_POST['txtTexto'])){
        $user = $_SESSION['username'];
        $texto = $_POST['txtTexto'];
        $asunto = $_POST['txtAsunto'];
        $correo = "Papercut@papercut.com";
        $cabeceras = 'From: Papercut@papercut.com' . "\r\n" .
            'Reply-To: Papercut@user.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $mail = mail($correo, $asunto, $texto, $cabeceras);
        if($mail){
            echo "Reporte enviado";
        }
    }
}
?>

<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>
    <body>
    <form action="reportes.php" method="post">
    <div class="d-flex">
    <div class="card col-sm-6">
    <div class="card-body">
    <div class="mb-3">
  <label for="txtAsunto" class="form-label">Asunto</label>
  <input type="text" class="form-control" name="txtAsunto" placeholder="Asunto">
</div>
<div class="mb-3">
  <label for="txtTexto" class="form-label">Texto</label>
  <textarea class="form-control" name="txtTexto" rows="3"></textarea>
  <input type="submit" value="Enviar" class="form-control" name="enviar">
</div>
    </div>
    </div>
    </div>
    </form>
    </body>
</html>