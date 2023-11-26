function MostrarPagina(){

        $.get('entrada1.php',function(mensaje,estado){
            document.getElementById('resultado').innerHTML =mensaje;
        })
}