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

    /**
     * Devuelve una arreglo con las listas de las máquinas tanto del OCS como 
     * del ISAAI que posiblemenete 
     * hayan cambiado. También se encarga de agregar en la base de datos ISAAI 
     * aquellas máquinas nuevas en el OCS.
     * @return Array Arreglo que contiene en el índice cero una lista de 
     * máquinas obtenidas del OCS, y en el índice dos contiene una lsita de 
     * máquinas obtenidas del ISAAI.
     */
    public function obtener_listas() {
        $lista_maquinas = array();
        $lista_maquinas_ocs = array();
        $lista_maquinas_isaai = array();
        $lista_maquinas_nuevas = array();
        $capturador_ocs = new CapturadorOcs();
        $capturador_isaai = new CapturadorIsaai();
        //filtrar las maquinas que posiblemente hayan cambiado, a partir de la fecha de 
        //sincornizacion
        //obtener lista de ids de esas maquinas y materializarlas
        //devolver lista de maquinas tanto del ocs como del isaai al controlador
        $cantidad_agregadas = 0;
        $cantidad_comparaciones = 0;
        $cargador_lista_isaai = new CargadorListaIsaai();
        $lista_resultados_isaai = $cargador_lista_isaai->cargar_lista(null);
        $cargador_lista_ocs = new CargadorListaOcs();
        $lista_resultados_ocs = $cargador_lista_ocs->cargar_lista(null);
        for ($i = 0; $i < count($lista_resultados_ocs); $i++) {
            // Buscar..
            $j = 0;
            while ($j < count($lista_resultados_isaai) && $lista_resultados_ocs[$i]['clave_unica'] !== $lista_resultados_isaai[$j]['clave_unica']) {
                $j++;
            }
            if ($j === count($lista_resultados_isaai)) {
                //agregar nueva maquina
                $id_maquina_ocs = new IdMaquinaOcs($lista_resultados_ocs[$i]['ID']);
                $maquina_nueva = $capturador_ocs->obtener_maquina($id_maquina_ocs);
                $maquina_nueva->set_fecha_cambio(Util::get_fecha_actual_formato_dd_mm_aaaa());
                $maquina_nueva->set_fecha_alta(Util::get_fecha_actual_formato_dd_mm_aaaa());
                if ($maquina_nueva->insertar() == true) {
                    $cantidad_agregadas++;
                    $lista_maquinas_nuevas[] = $maquina_nueva;
                } else {
                    Out::print_array(Conexion::get_instacia(CONEXION_ISAAI)->get_error());
                }
            } else {
                //comparar la fechas
                $cantidad_comparaciones++;
                if ($lista_resultados_ocs[$i]['LASTCOME'] != $lista_resultados_isaai[$j]['fecha_sincronizacion']) {
                    $id_maquina_ocs = new IdMaquinaOcs($lista_resultados_ocs[$i]['ID']);
                    $lista_maquinas_ocs[] = $capturador_ocs->obtener_maquina($id_maquina_ocs);
                    $id_maquina_isaai = new IdMaquinaIsaai($lista_resultados_isaai[$j]['id'], $lista_resultados_isaai[$j]['fecha_cambio']);
                    $lista_maquinas_isaai[] = $capturador_isaai->obtener_maquina($id_maquina_isaai);
                }
            }
        }
        echo "Agregue: $cantidad_agregadas<br/>";
        echo "Compare: $cantidad_comparaciones de las cuales " . count($lista_maquinas_isaai) . " podrían haber cambiado.</br>";
        $lista_maquinas[] = $lista_maquinas_ocs;
        $lista_maquinas[] = $lista_maquinas_isaai;
        $lista_maquinas[] = $lista_maquinas_nuevas;
        return $lista_maquinas;
    }

}
