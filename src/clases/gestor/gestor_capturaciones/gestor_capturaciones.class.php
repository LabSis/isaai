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
    
    public function obtener_listas() {
        $lista_maquinas_ocs = array();
        $lista_maquinas_isaai = array();
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
                if ($maquina_nueva->insertar() == true) {
                    $cantidad_agregadas++;
                }else{
                    Out::print_array(Conexion::get_instacia(CONEXION_ISAAI)->get_error());
                }
            } else {
                //comparar la fechas
                if ($lista_resultados_ocs[$i]['LASTCOME'] != $lista_resultados_isaai[$j]['fecha_sincronizacion']) {
                    $cantidad_comparaciones++;
                    $id_maquina_ocs = new IdMaquinaOcs($lista_resultados_ocs[$i]['ID']);
                    $lista_maquinas_ocs[] = $capturador_ocs->obtener_maquina($id_maquina_ocs);
                    $id_maquina_isaai = new IdMaquinaIsaai($lista_resultados_isaai[$i]['id'], $lista_resultados_isaai[$i]['fecha_cambio']);
                    $lista_maquinas_isaai[] = $capturador_isaai->obtener_maquina($id_maquina_isaai);
                }
            }
        }
        echo "Agregue: $cantidad_agregadas<br/>";
        echo "Compare: $cantidad_comparaciones</br>";
    }

}
