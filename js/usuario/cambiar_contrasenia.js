var mensaje;
$(document).ready(function() {
    mensaje = new MensajeFlotante("");
});
function ControladorCambiarContrasenia($scope, $http) {
    $scope.usuario = { claveActual: "", nuevaClave: "", repeticionNuevaClave: ""};
    $scope.cambiarContrasenia = function() {
        var rutaWeb = $("#dataRutaWeb").html().trim();
        $scope.params = {datos: $scope.usuario};
        $http.get(rutaWeb + "/src/ctrl/ajax/usuario/cambiar_contrasenia.ctrl.php", {params: $scope.params}).success(function(respuesta) {
            if (respuesta !== null) {
                if (respuesta.resultado === "true") {
                    mensaje.setContenido("Clave cambiada con éxito");
                    mensaje.setTipo(TipoMensaje.prototype.exito);
                } else {
                    mensaje.setContenido("Error al tratar de cambiar la clave");
                    mensaje.setTipo(TipoMensaje.prototype.error);
                }
                mensaje.mostrar();
            }
        });
    };
}

