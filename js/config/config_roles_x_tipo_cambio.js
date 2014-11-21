$(document).ready(function() {
    //seleccionar todos los tipos de cambio para un rol
    $(".columnaRol .iconoBoton").click(function() {
        var indiceColumna = $(this).parent().index();
        $(".filaTipoCambio").each(function() {
            $(this).find(".celdaCheckbox").each(function() {
                if (($(this).index() - 1) === indiceColumna) {
                    $(this).find("input[type='checkbox']").attr("checked", "true");
                }
            });
        });
    });
    //seleccionar todos los roles para un tipo de cambio
    $(".filaTipoCambio .iconoBoton").click(function() {
        var indiceFila = $(this).parents("tr").index();
        $(this).parent().nextAll().each(function() {
            $(this).find("input[type='checkbox']").attr("checked", "true");
        });
    });
});