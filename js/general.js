var fondo;
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
    fondo = new Fondo();
});
//Funciones generales
function centrarComponente(objectoJquery) {
    var anchoVentana = $(window).width();
    var altoVentana = $(window).height();
    var anchoMensaje = parseInt(objectoJquery.css("width"));
    var altoMensaje = parseInt(objectoJquery.css("height"));
    objectoJquery.css("left", (anchoVentana - anchoMensaje) / 2);
    objectoJquery.css("top", (altoVentana - altoMensaje) / 2);
}
//Clases generales
//Clase Fondo
function Fondo() {
    var instancia = this;
    $("body").prepend("<div id='fondoNegro'></div>");
    instancia.objectoJquery = $("#fondoNegro");
    instancia.listaObjectosFlotantes = [];
    instancia.agregarObjectoFlotante = function(objectoFlotante) {
        var existe = true;
        for (var i = 0; i < instancia.listaObjectosFlotantes.length; i++) {
            existe &= instancia.listaObjectosFlotantes[i].id !== objectoFlotante.id;
        }
        if (existe) {
            instancia.listaObjectosFlotantes.push(objectoFlotante);
        }
    };
    instancia.mostrar = function() {
        instancia.objectoJquery.css("display", "block");
        instancia.objectoJquery.css("height", $(window).height());
    };
    instancia.ocultar = function() {
        for (var i = 0; i < instancia.listaObjectosFlotantes.length; i++) {
            instancia.listaObjectosFlotantes[i].ocultar();
        }
        $("#fondoNegro").css("display", "none");
    };
    instancia.objectoJquery.click(function() {
        instancia.ocultar();
    });
}
//TipoMensaje
TipoMensaje.prototype.info = 0;
TipoMensaje.prototype.exito = 1;
TipoMensaje.prototype.alerta = 2;
TipoMensaje.prototype.error = 3;
function TipoMensaje() {
}
//Clase MensajeFlotante
MensajeFlotante.prototype.id = 0;
function MensajeFlotante(contenido, tipo) {
    var instancia = this;
    instancia.id = "msjFlotante" + MensajeFlotante.prototype.id;
    instancia.contenido = contenido;
    $("body").prepend("<div class='mensaje mensajeFlotante' id='" + instancia.id + "'>" + instancia.contenido + "</div>");
    instancia.objectoJquery = $("#" + instancia.id);
    fondo.agregarObjectoFlotante(instancia);
    instancia.setTipo = function(tipo) {
        instancia.objectoJquery.removeClass("mensajeInfo");
        instancia.objectoJquery.removeClass("mensajeExito");
        instancia.objectoJquery.removeClass("mensajeAlerta");
        instancia.objectoJquery.removeClass("mensajeError");
        switch (tipo) {
            case(TipoMensaje.prototype.info):
                instancia.objectoJquery.addClass("mensajeInfo");
                break;
            case(TipoMensaje.prototype.exito):
                instancia.objectoJquery.addClass("mensajeExito");
                break;
            case(TipoMensaje.prototype.alerta):
                instancia.objectoJquery.addClass("mensajeAlerta");
                break;
            case(TipoMensaje.prototype.error):
                instancia.objectoJquery.addClass("mensajeError");
                break;
        }
        instancia.tipo = tipo;
    };
    instancia.setTipo(tipo);
    instancia.mostrar = function() {
        instancia.objectoJquery.css("display", "block");
        centrarComponente(instancia.objectoJquery);
        fondo.mostrar();
    };
    instancia.ocultar = function() {
        instancia.objectoJquery.css("display", "none");
        //fondo.ocultar();
    };
    instancia.setContenido = function(contenido) {
        instancia.contenido = contenido;
        instancia.objectoJquery.html(contenido);
    };
    MensajeFlotante.prototype.id++;
}