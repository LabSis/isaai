var roles;
$(document).ready(function() {
    //Cargo el array de roles
    $.ajax({
        url: $("#dataRutaWeb").html() + "/src/ctrl/ajax/config_roles_x_tipo_cambio.ajax.php",
        type: "POST",
        data: {
            accion: "consultar"
        }
    }).done(function(respuesta) {
        //console.log(respuesta);
        roles = JSON.parse(respuesta);
    });
    //seleccionar todos los tipos de cambio para un rol
    $(".columnaRol .checkbox").click(function() {
        var estadoCheckbox;
        if (!$(this).is(":checked")) {
            estadoCheckbox = false;
        } else {
            estadoCheckbox = true;
        }
        var indiceColumna = $(this).parent().index();
        $(".filaTipoCambio").each(function() {
            $(this).find(".celdaCheckbox").each(function() {
                if (($(this).index() - 1) === indiceColumna) {
                    $(this).find("input[type='checkbox']").prop("checked", estadoCheckbox);
                    $(this).find("input[type='checkbox']").trigger("change");
                }
            });
        });

    });
    //seleccionar todos los roles para un tipo de cambio
    $(".filaTipoCambio .checkbox").click(function() {
        var estadoCheckbox;
        if (!$(this).is(":checked")) {
            estadoCheckbox = false;
        } else {
            estadoCheckbox = true;
        }
        //var indiceFila = $(this).parents("tr").index();
        $(this).parent().nextAll().each(function() {
            $(this).find("input[type='checkbox']").prop("checked", estadoCheckbox);
            $(this).find("input[type='checkbox']").trigger("change");
        });
    });
    //actualiza los objetos roles al checker los checkbox
    $(".celdaCheckbox input[type=checkbox]").change(function() {
        var indiceColumna = $(this).parent().index() - 1;//la primera columna no es un rol
        var indiceFila = $(this).parent().parent().index();
        roles[indiceColumna].tipos_cambio[indiceFila].permiso = ($(this).is(":checked")) ? '1' : '0';
    });
    //Subida del formulario
    $("#frmActualizar").submit(function(evt) {
        //actualizo los cambios
        $.ajax({
            url: $("#dataRutaWeb").html() + "/src/ctrl/ajax/config_roles_x_tipo_cambio.ajax.php",
            type: "POST",
            data: {
                accion: "actualizar",
                datos: JSON.stringify(roles)
            }
        }).done(function(respuesta) {
            console.log(respuesta);
        });
        //evt.preventDefault();
    });
});