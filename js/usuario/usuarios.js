var mensaje;
$(document).ready(function() {
    mensaje = new MensajeFlotante("");
});
function ControladorUsuarios($scope, $http) {
    //array de usuarios
    $scope.usuarios = [];
	$scope.roles = [];
    //criterios de ordenacion para el select
    $scope.criteriosOrdenacion = [
        {clave: "nombreUsuario", valor: "Usuario"},
    ];
    //elemento seleccionado del select
    $scope.criterioOrdenacionSeleccionado = null;
    //variables para mantener el orden de la tabla por la cabecera
    $scope.ordenTabla = $scope.criteriosOrdenacion[0].clave; //nombreUsuario
    $scope.ordenInvertido = false;
    //variables necesarias para la paginacion
    $scope.cantidadPaginas;
    $scope.cantidadTotalUsuarios;
    //parametros de la consulta al ajax
    $scope.params = {
        paginaActual: 1,
        tamanioPagina: 8,
        criterioOrdenacion: $scope.criteriosOrdenacion[0].clave //nombreUsuario
    };
    //funcion de actualizar la tabla mediante una consulta ajax
    $scope.actualizar = function() {
        var rutaWeb = $("#dataRutaWeb").html().trim();
        $http.get(rutaWeb + "/src/ctrl/ajax/usuario/usuarios.ctrl.php", {params: $scope.params}).success(function(respuesta) {
			$http.get(rutaWeb + "/src/ctrl/ajax/roles.ctrl.php").success(function(respuestaRoles) {
				$scope.roles = respuestaRoles.datos;
			});
            $scope.usuarios = respuesta.datos;
            $scope.cantidadTotalUsuarios = respuesta.config.cantidadResultados;
            $scope.cantidadPaginas = respuesta.config.cantidadPaginas;

            $scope.paginado = [];
            for (var i = 1; i <= $scope.cantidadPaginas; i++) {
                $scope.paginado.push(i);
            }
        });
    };
    //paginar resultados
    $scope.paginar = function(pagina) {
        $scope.params.paginaActual = pagina;
        $scope.actualizar();
    };
    //ordenar tabla haciendo consulta a la base de datos
    $scope.ordenar = function() {
        $scope.params.criterioOrdenacion = $scope.criterioOrdenacionSeleccionado.clave;
        $scope.actualizar();
    };
    //ordenar los datos en la tabla (sin realizar consulta a la base de datos)
    $scope.ordenarCabecera = function(orden) {
        $scope.ordenTabla = orden;
        $scope.ordenInvertido = !$scope.ordenInvertido;
    };
	
	$scope.actualizarRol = function(usuario){
		console.log('nombreUsuario', usuario);
		var rutaWeb = $("#dataRutaWeb").html().trim();
        $http.post(rutaWeb + "/src/ctrl/ajax/usuario/actualizar_rol.ctrl.php", JSON.stringify({datos:usuario})).success(function(respuesta) {
            if (respuesta !== null) {
                if (respuesta.resultado === "true") {
                    mensaje.setContenido("Se actualizó el rol del usuario con éxito");
                    mensaje.setTipo(TipoMensaje.prototype.exito);
                } else {
                    mensaje.setContenido("Error al tratar de actualizar rol");
                    mensaje.setTipo(TipoMensaje.prototype.error);
                }
                mensaje.mostrar();
            }
        });
	}
    $scope.actualizar();
}
