$(document).ready(function() {
    $("table.general thead tr td").hover(
            function() {
                var indice = $(this).index() + 1;
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