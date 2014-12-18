function ControladorMaquinas($scope, $http) {
    //array de maquinas
    $scope.maquinas = [];
    //criterios de ordenacion para el select
    $scope.criteriosOrdenacion = [
        {clave: "id", valor: "ID"},
        {clave: "nombre", valor: "Nombre"},
        {clave: "fecha_alta", valor: "Fecha de alta"}
    ];
    //elemento seleccionado del select
    $scope.criterioOrdenacionSeleccionado = null;
    //variables para mantener el orden de la tabla por la cabecera
    $scope.ordenTabla = $scope.criteriosOrdenacion[0].clave; //id
    $scope.ordenInvertido = false;
    //variables necesarias para la paginacion
    $scope.cantidadPaginas;
    $scope.cantidadTotalMaquinas;
    //parametros de la consulta al ajax
    $scope.params = {
        pagina: 1,
        tamanioPagina: 8,
        criterioOrdenacion: $scope.criteriosOrdenacion[0].clave //id
    };
    //funcion de actualizar la tabla mediante una consulta ajax
    $scope.actualizar = function() {
        var rutaWeb = $("#dataRutaWeb").html().trim();
        $http.get(rutaWeb + "/src/ctrl/ajax/maquina/maquinas.ctrl.php", {params: $scope.params}).success(function(respuesta) {
            //console.log(respuesta.config.consulta);
            $scope.maquinas = respuesta.datos;
            $scope.cantidadTotalMaquinas = respuesta.config.cantidadResultados;
            $scope.cantidadPaginas = respuesta.config.cantidadPaginas;
            //array de paginado
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
    $scope.actualizar();
}
