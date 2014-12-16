$(document).ready(function() {


});
function Maquina($scope, $http) {
    $scope.maquinas = [];
    $scope.criteriosOrdenacion = [
        {clave: "id", valor: "ID"},
        {clave: "nombre", valor: "Nombre"},
        {clave: "fecha_alta", valor: "Fecha de alta"}
    ];
    $scope.paginaActual = 1;
    $scope.cantidadPaginas;
    $scope.criterioOrdenacionSeleccionado = null;
    $scope.actualizar = function(datos) {
        var rutaWeb = $("#dataRutaWeb").html().trim();
        $http.get(rutaWeb + "/src/ctrl/ajax/maquina/maquinas.ctrl.php", {params: datos}).success(function(respuesta) {
            $scope.maquinas = respuesta;
        });
    };
    $scope.paginar = function(pagina) {
        $scope.paginaActual = pagina;
        $scope.actualizar({pagina: $scope.paginaActual});
    };
    $scope.ordenar = function() {
        $scope.actualizar({criterio_ordenacion: $scope.criterioOrdenacionSeleccionado.clave});
    };
    $scope.actualizar({});
}
