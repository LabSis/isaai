$(document).ready(function() {
    //seleccionar todos los tipos de cambio para un rol
    $(".columnaRol .checkbox").click(function() {
        var estadoCheckbox;
        if (typeof $(this).attr("checked") !== typeof undefined && $(this).attr("checked") !== false) {
            estadoCheckbox = false;
            $(this).removeAttr("checked");
        } else {
            //es igual a undefined
            estadoCheckbox = true;
            $(this).attr("checked", "true");
        }
        var indiceColumna = $(this).parent().index();
        $(".filaTipoCambio").each(function() {
            $(this).find(".celdaCheckbox").each(function() {
                if (($(this).index() - 1) === indiceColumna) {
                    if (estadoCheckbox === true) {
                        $(this).find("input[type='checkbox']").attr("checked", "checked");
                    } else {
                        $(this).find("input[type='checkbox']").removeAttr("checked");
                    }
                }
            });
        });
    });
    //seleccionar todos los roles para un tipo de cambio
    $(".filaTipoCambio .checkbox").click(function() {
        var estadoCheckbox;
        if (typeof $(this).attr("checked") !== typeof undefined && $(this).attr("checked") !== false) {
            estadoCheckbox = false;
            $(this).removeAttr("checked");
        } else {
            estadoCheckbox = true;
            $(this).attr("checked", "true");
        }
        //var indiceFila = $(this).parents("tr").index();
        $(this).parent().nextAll().each(function() {
            if (estadoCheckbox === true) {
                $(this).find("input[type='checkbox']").attr("checked", "checked");
            } else {
                $(this).find("input[type='checkbox']").removeAttr("checked");
            }
        });
    });
});