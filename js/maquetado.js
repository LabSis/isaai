$(document).ready(function() {
    $("#botonUsuario").click(function() {
        if (parseInt($("#menuSeccionUsuario").css("margin-top")) != 5) {
            $("#menuSeccionUsuario").css("margin-top", "5px");
            $("#menuSeccionUsuario").css("opacity", "1.0");
        } else {
            $("#menuSeccionUsuario").css("margin-top", "20px");
            $("#menuSeccionUsuario").css("opacity", "0.0");
        }
    });
    $("body").click(function() {
        if (parseInt($("#cabeceraMensajes").css("height")) != 0) {
            $("#cabeceraMensajes").css("height", "0px");
        } else {
            $("#cabeceraMensajes").css("height", "30px");
        }
    });
});
