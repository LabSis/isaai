$(document).ready(function() {
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
});