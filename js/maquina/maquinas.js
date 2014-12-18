$(document).ready(function() {


});
function ControladorMaquinas($scope, $http) {
    $scope.ordenTabla = "id";
    $scope.ordenInvertido = false;
    $scope.maquinas = [];
    $scope.criteriosOrdenacion = [
        {clave: "id", valor: "ID"},
        {clave: "nombre", valor: "Nombre"},
        {clave: "fecha_alta", valor: "Fecha de alta"}
    ];
    $scope.paginaActual = 1;
    $scope.cantidadPaginas;
    $scope.cantidadTotalMaquinas;
    $scope.criterioOrdenacionSeleccionado = null;
    //puedo considerar usar datos como atributo del controlador, seria una array assoc
    $scope.actualizar = function(datos) {
        var rutaWeb = $("#dataRutaWeb").html().trim();
        $http.get(rutaWeb + "/src/ctrl/ajax/maquina/maquinas.ctrl.php", {params: datos}).success(function(respuesta) {
            $scope.maquinas = respuesta.datos;
            $scope.cantidadTotalMaquinas = respuesta.config.cantidadResultados;
            $scope.cantidadPaginas = respuesta.config.cantidadPaginas;
            $scope.paginado = [];
            for (var i = 1; i <= $scope.cantidadPaginas; i++) {
                $scope.paginado.push(i);
            }
        });
    };
    $scope.paginar = function(pagina) {
        $scope.paginaActual = pagina;
        $scope.actualizar({pagina: $scope.paginaActual});
    };
    $scope.ordenar = function() {
        $scope.actualizar({criterio_ordenacion: $scope.criterioOrdenacionSeleccionado.clave});
    };
    $scope.ordenarCabecera = function(orden) {
        $scope.ordenTabla = orden;
        $scope.ordenInvertido = !$scope.ordenInvertido;
    };
    $scope.actualizar({});
}
