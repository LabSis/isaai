$(document).ready(function () {
    //ocultar menu usuario
    $("#botonUsuario").click(function () {
        if (parseInt($("#menuSeccionUsuario").css("opacity")) == 0) {
            $("#menuSeccionUsuario").css("top", "55px");
            $("#menuSeccionUsuario").css("opacity", "1.0");
        } else {
            $("#menuSeccionUsuario").css("top", "45px");
            $("#menuSeccionUsuario").css("opacity", "0.0");
        }
    });
    $("html").click(function () {
        if (parseInt($("#menuSeccionUsuario").css("opacity")) > 0) {
            $("#menuSeccionUsuario").css("top", "45px");
            $("#menuSeccionUsuario").css("opacity", "0.0");
        }
    });
    //ocultar mostrar menu lateralmente
    if ($("#menuPrincipal").hasClass("oculto")) {
        $("#contenido").addClass("expandido");
        $("#seccionOcultarMostrarMenu").children(".icono").removeClass("fa-arrow-left");
        $("#seccionOcultarMostrarMenu").children(".icono").addClass("fa-arrow-right");
    } else {
        $("#contenido").removeClass("expandido");
        $("#seccionOcultarMostrarMenu").children(".icono").removeClass("fa-arrow-right");
        $("#seccionOcultarMostrarMenu").children(".icono").addClass("fa-arrow-left");
    }
    $("#seccionOcultarMostrarMenu").click(function () {
        var accion;
        if ($("#menuPrincipal").hasClass("oculto")) {
            //mostrar
            $("#menuPrincipal").removeClass("oculto");
            $("#contenido").removeClass("expandido");
            $(this).children(".icono").removeClass("fa-arrow-right");
            $(this).children(".icono").addClass("fa-arrow-left");
            accion = "mostrar";
        } else {
            //ocultar
            $("#menuPrincipal").addClass("oculto");
            $("#contenido").addClass("expandido");
            $(this).children(".icono").removeClass("fa-arrow-left");
            $(this).children(".icono").addClass("fa-arrow-right");
            accion = "ocultar";
        }
        $.ajax({
            url: $("#dataRutaWeb").html().trim() + "/src/ctrl/ajax/maquetado.ctrl.php",
            data: {
                operacion: "ocultar_menu",
                accion: accion
            },
            type: "POST"
        }).done(function (r) {
            console.log(r);
        });
    });
    //mostrar ocultar submenues
    $("#menuPrincipal ul li").mouseover(
            function () {
                var $this = $(this);
                if (!$this.is(".extendido")) {
                    $this.addClass("extendido");
                    $this.children("ul").slideDown("slow", function () {
                    }).delay("2500").slideUp("slow", function () {
                        $this.removeClass("extendido");
                    });
                }
            }
    );

    //recalculo las dimensiones del maquetado
    resize();
});
$(window).resize(function () {
    resize();
});
function resize() {
    $("#contenido").css("height", $(window).height() - (parseInt($("header").css("height")) + parseInt($("footer").css("height"))));
    $("#menuPrincipal").css("height", $(window).height() - (parseInt($("header").css("height")) + parseInt($("footer").css("height"))));
}
