$(document).ready(function(){
    
    
});
function Maquina($scope,$http){
    var rutaWeb = $("#dataRutaWeb").html().trim();
    $http.get(rutaWeb + "/src/ctrl/ajax/maquina/maquinas.ctrl.php").success(function(respuesta){
        $scope.maquinas = respuesta;
    });   
}
