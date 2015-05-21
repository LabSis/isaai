$(document).ready(function() {
    var rutaWeb = $("#dataRutaWeb").html().trim();
    var sincronizando = false;
    $("#btnSincronizar").click(function() {
        var btnSincronizar = $(this);
        if (!sincronizando) {
            btnSincronizar.html("<i class='fa fa-refresh fa-fw icono'></i><span class='spnTextMenu'>Sincronizando...</span></a>");
            $.ajax({
                url: rutaWeb + "/src/ctrl/ajax/sincronizar.ctrl.php",
                type: "POST"
            }).done(function(respuesta) {
                btnSincronizar.html("<i class='fa fa-refresh fa-fw icono'></i><span class='spnTextMenu'>Sincronizar</span></a>");
                sincronizando = false;
                var cantMaquinasCambiadas = parseInt(respuesta);
                console.log(respuesta);
                if (parseInt($("#cabeceraMensajes").css("height")) != 0) {
                    $("#cabeceraMensajes").css("height", "0px");
                } else {
                    $("#cabeceraMensajes").css("height", "30px");
                }
                $("#cabeceraMensajes").css("height", "30px");
                var msj = "";
                if (cantMaquinasCambiadas === 0) {
                    msj = "Ninguna máquina ha cambiado";
                } else {
                    if (isNaN(cantMaquinasCambiadas)) {
                        //console.log(respuesta);
                        msj = "Muchas máquinas han cambiado";
                    } else {
                        msj = cantMaquinasCambiadas + " máquinas han cambiado";
                    }
                }
                $("#mensajesAlerta").html(msj);
                setTimeout(function() {
                    $("#cabeceraMensajes").css("height", "0px");
                }, 5000);
            });
        }
        sincronizando = true;
    });

});