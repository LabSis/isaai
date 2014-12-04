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
    //btn ocultar mostrar menu
    $("#seccionOcultarMostrarMenu").click(function() {
        if ($("#menuPrincipal").hasClass("oculto")) {
            //mostrar
            $("#menuPrincipal").removeClass("oculto");
            $("#contenido").removeClass("expandido");
            $(this).children(".icono").removeClass("fa-arrow-right");
            $(this).children(".icono").addClass("fa-arrow-left");
        } else {
            //ocultar
            $("#menuPrincipal").addClass("oculto");
            $("#contenido").addClass("expandido");
            $(this).children(".icono").removeClass("fa-arrow-left");
            $(this).children(".icono").addClass("fa-arrow-right");
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
    //recalculo las dimensiones del maquetado
    resize();
});
$(window).resize(function() {
    resize();
});
function resize() {
    $("#contenido").css("height", $(window).height() - (parseInt($("header").css("height")) + parseInt($("footer").css("height"))));
    $("#menuPrincipal").css("height", $(window).height() - (parseInt($("header").css("height")) + parseInt($("footer").css("height"))));
}
