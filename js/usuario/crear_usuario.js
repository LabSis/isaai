var mensaje;
$(document).ready(function() {
    mensaje = new MensajeFlotante("");
});
function ControladorCrearUsuario($scope, $http) {
    $scope.usuario = {};
	$scope.roles = [];
    
	$scope.params = {accion: "consultar", datos: $scope.usuario};
	
	$scope.consultarRoles = function(){
		var rutaWeb = $("#dataRutaWeb").html().trim();
		$http.get(rutaWeb + "/src/ctrl/ajax/roles.ctrl.php").success(function(respuestaRoles) {
			$scope.roles = respuestaRoles.datos;
			console.log($scope.roles);
		});
	}
	
    $scope.crear = function() {
        var rutaWeb = $("#dataRutaWeb").html().trim();
        $http.post(rutaWeb + "/src/ctrl/ajax/usuario/crear_usuario.ctrl.php", $scope.params)
		.success(function(respuesta) {
            if (respuesta.config.accion === "crear") {
                if (respuesta.resultado === "true") {										
                    mensaje.setContenido("Éxito al crear un nuevo usuario");
                    mensaje.setTipo(TipoMensaje.prototype.exito);
					location.href = location.origin + '/isaai/src/ctrl/usuario/usuarios.ctrl.php';
                } else {
                    mensaje.setContenido("Error al intentar crear un usuario:\
					<br>* No se permiten nombres de usuarios duplicados.\
					<br>* La contraseña debe tener al menos 6 caracteres.\
					<br>* El nombre de usuario debe tener al menos 6 caracteres.");
                    mensaje.setTipo(TipoMensaje.prototype.error);
                }
                mensaje.mostrar();
            }
			console.log($scope.usuario);
        });
    };
    //$scope.actualizar();
	
	$scope.consultarRoles();
    $scope.crearUsuario = function() {
        $scope.params.accion = "crear";
        $scope.params.datos = $scope.usuario;
        $scope.crear();
    };
}