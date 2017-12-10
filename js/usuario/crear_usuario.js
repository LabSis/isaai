var mensaje;
$(document).ready(function() {
    mensaje = new MensajeFlotante("");
});
function ControladorCrearUsuario($scope, $http) {
    $scope.usuario = {};
    $scope.params = {accion: "consultar", datos: $scope.usuario};
    $scope.crear = function() {
        var rutaWeb = $("#dataRutaWeb").html().trim();
        $http.post(rutaWeb + "/src/ctrl/ajax/usuario/crear_usuario.ctrl.php", $scope.params).success(function(respuesta) {
            //console.log(respuesta.datos.nombreUsuario);
            $scope.usuario = respuesta.datos;
            if (respuesta.config.accion === "crear") {
                if (respuesta.config.resultado === "true") {
                    mensaje.setContenido("Éxito al crear un nuevo usuario");
                    mensaje.setTipo(TipoMensaje.prototype.exito);
					//redirigir a usuarios lista
                } else {
                    mensaje.setContenido("Error al intentar crear un usuario");
                    mensaje.setTipo(TipoMensaje.prototype.error);
                }
                mensaje.mostrar();
            }
        });
    };
    //$scope.actualizar();
    $scope.crearUsuario = function() {
        $scope.params.accion = "crear";
        $scope.params.datos = $scope.usuario;
        $scope.crear();
    };
}