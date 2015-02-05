var mensaje;
$(document).ready(function() {
    mensaje = new MensajeFlotante("");
});
function ControladorEditarDatos($scope, $http) {
    $scope.usuario = {};
    $scope.params = {accion: "consultar", datos: $scope.usuario};
    $scope.actualizar = function() {
        var rutaWeb = $("#dataRutaWeb").html().trim();
        $http.get(rutaWeb + "/src/ctrl/ajax/usuario/editar_datos.ctrl.php", {params: $scope.params}).success(function(respuesta) {
            //console.log(respuesta.datos.nombreUsuario);
            $scope.usuario = respuesta.datos;
            if (respuesta.config.accion === "editar") {
                if (respuesta.config.resultado === "true") {
                    mensaje.setContenido("Éxito al editar los datos");
                    mensaje.setTipo(TipoMensaje.prototype.exito);
                } else {
                    mensaje.setContenido("Error al intentar editar los datos");
                    mensaje.setTipo(TipoMensaje.prototype.error);
                }
                mensaje.mostrar();
            }
        });
    };
    $scope.actualizar();
    $scope.editarDatos = function() {
        $scope.params.accion = "editar";
        $scope.params.datos = $scope.usuario;
        $scope.actualizar();
    };
}