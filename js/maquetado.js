$(document).ready(function() {
    $("#botonUsuario").click(function() {
        if (parseInt($("#menuSeccionUsuario").css("opacity")) == 0) {
            $("#menuSeccionUsuario").css("top", "55px");
            $("#menuSeccionUsuario").css("opacity", "1.0");
        } else {
            $("#menuSeccionUsuario").css("top", "45px");
            $("#menuSeccionUsuario").css("opacity", "0.0");
        }
    });
    $("html").click(function() {
        if (parseInt($("#menuSeccionUsuario").css("opacity")) > 0) {
            $("#menuSeccionUsuario").css("top", "45px");
            $("#menuSeccionUsuario").css("opacity", "0.0");
        }
        /*
        if (parseInt($("#cabeceraMensajes").css("height")) != 0) {
            $("#cabeceraMensajes").css("height", "0px");
        } else {
            $("#cabeceraMensajes").css("height", "30px");
        }
        */
    });
});
