function ControladorEditarDatos($scope, $http) {
    $scope.params = {accion: "consultar"};
    $scope.actualizar = function() {
        var rutaWeb = $("#dataRutaWeb").html().trim();
        $http.get(rutaWeb + "/src/ctrl/ajax/usuario/editar_datos.ctrl.php").success(function(respuesta) {
            $scope.usuario = respuesta.datos;
        });
    };
    $scope.actualizar();
    $scope.editarDatos = function(){
        $scope.params = {accion: "editar"};
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