<html>
    <head>

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <video id="preview" width="100%"></video>                    
                </div>
                <div class="col-md-6">
                    <form action="insert.php" method="post" class="form-horizontal">
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
    </body>
</html>