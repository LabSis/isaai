function ControladorEditarDatos($scope, $http) {
    $scope.usuario = {};
    $scope.params = {accion: "consultar", datos: $scope.usuario};
    $scope.actualizar = function() {
        var rutaWeb = $("#dataRutaWeb").html().trim();
        $http.get(rutaWeb + "/src/ctrl/ajax/usuario/editar_datos.ctrl.php", {params: $scope.params}).success(function(respuesta) {
           //console.log(respuesta);
            $scope.usuario = respuesta.datos;
        });
    };
    $scope.actualizar();
    $scope.editarDatos = function(){
        $scope.params.accion = "editar";
        $scope.params.datos = $scope.usuario;
        $scope.actualizar();
    };
}
/*
$(document).ready(function(){
    $.ajax({
        url: $("#dataRutaWeb").html().trim() + "/src/ctrl/ajax/usuario/editar_datos.ctrl.php" 
    }).done(function(data){
       console.log(data);
    });
});
*/