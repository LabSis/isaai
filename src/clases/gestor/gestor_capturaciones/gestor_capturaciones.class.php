<?php

/**
 * Gestiona la capturación de máquinas.
 * Posee métodos para obtener datos de las bases de datos de OCS y ISAAI. 
 * Devuelve un array de máquinas que posiblemente hayan cambiado. 
 * Cada objeto máquina está compuesto por procesadores, memorias RAM, 
 * bios, etc.

 *
 * @author Diego Barrionuevo, Germán Parisi
 * @version 1.0
 */
class GestorCapturaciones {

    public function capturar() {

        //filtrar las maquinas que posiblemente hayan cambiado, a partir de la fecha de 
        //sincornizacion
        //obtener lista de ids de esas maquinas y materializarlas
        //devolver lista de maquinas tanto del ocs como del isaai al controlador
        $cargador_lista_isaai = new CargadorListaIsaai();
        $lista_resultados_isaai = $cargador_lista_isaai->cargar_lista(null);
        $cargador_lista_ocs = new CargadorListaOcs();
        $lista_resultados_ocs = $cargador_lista_ocs->cargar_lista(null);
        $cantidad = 0;
        for ($i = 0; $i < count($lista_resultados_ocs); $i++) {
            // Buscar..
            $j = 0;
            while ($j < count($lista_resultados_isaai) && $lista_resultados_ocs[$i]['clave_unica'] !== $lista_resultados_isaai[$j]["id"]) {
                $j++;
            }
            if ($j === count($lista_resultados_isaai)) {
                //agregar nueva maquina
                $capturadorOcs = new CapturadorOcs();
                $maquina_nueva = $capturadorOcs->obtenerMaquina($lista_resultados_ocs[$i]["id"]);
                $maquina_nueva->insertar();
                $cantidad++;
            } else {
                //comparo la fechas
            }
        }
        echo $cantidad;
    }

    public static function hash($mapa) {
        $hash = md5(implode('', $mapa));
        return $hash;
    }

}
