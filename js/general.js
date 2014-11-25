$(document).ready(function() {
    var anchoVentana = $(window).width();
    var altoVentana = $(window).height();
    $("table.general thead tr td").hover(
            function() {
                var indice = $(this).index() + 1;
                /*
                 var indiceFila = 1;
                 var cantFilas = $(this).parent().parent().parent().find("tbody tr:last-child").index();
                 for (var indiceFila = 0; indiceFila < cantFilas; indiceFila++) {
                 setTimeout(function(){
                 $(this).parent().parent().parent().find("tbody tr:nth-child(" + indiceFila + ") td:nth-child(" + indice + ")").addClass("seleccionado");
                 }, 10);
                 }*/
                $(this).parent().parent().parent().find("tbody tr td:nth-child(" + indice + ")").each(function() {
                    $(this).addClass("seleccionado");
                });
            }
    ,
            function() {
                var indice = $(this).index() + 1;
                $(this).parent().parent().parent().find("tbody tr td:nth-child(" + indice + ")").each(function() {
                    $(this).removeClass("seleccionado");
                });
            }
    );
    //fonde negro
    $("#fondoNegro").css("height", altoVentana);

});
function mensajeFlotante() {
    //mensajes flotante, ubicacion
    $(".mensajeFlotante").each(function() {
        var anchoVentana = $(window).width();
        var altoVentana = $(window).height();
        var anchoMensaje = parseInt($(this).css("width"));
        var altoMensaje = parseInt($(this).css("height"));
        $(this).css("left", (anchoVentana - anchoMensaje) / 2);
        $(this).css("top", (altoVentana - altoMensaje) / 2);
    });
}