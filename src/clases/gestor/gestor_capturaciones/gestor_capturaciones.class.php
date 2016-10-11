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
     * máquinas obtenidas del OCS, en el índice uno contiene una lista de 
     * máquinas obtenidas del ISAAI, y en el índice dos una lista de las 
     * máquinas nuevas.
     */
    public function obtener_listas() {
        $lista_maquinas = array();
//        $lista_maquinas_ocs = array();
        $lista_maquinas_hc = array();
        $lista_maquinas_isaai = array();
        $lista_maquinas_nuevas = array();
//        $capturador_hc = new CapturadorOcs();
        $capturador_hc = new CapturadorHc();
        $capturador_isaai = new CapturadorIsaai();
        $cantidad_agregadas = 0;
        $cantidad_comparaciones = 0;
        $cargador_lista_isaai = new CargadorListaIsaai();
        $lista_resultados_isaai = $cargador_lista_isaai->cargar_lista(null);
//        $cargador_lista_ocs = new CargadorListaOcs();
        $cargador_lista_hc = new CargadorListaHc();
//        $lista_resultados_ocs = $cargador_lista_ocs->cargar_lista(null);
        $lista_resultados_hc = $cargador_lista_hc->cargar_lista(null);
        for ($i = 0; $i < count($lista_resultados_hc); $i++) {
            // Buscar..
            $j = 0;
            while ($j < count($lista_resultados_isaai) && $lista_resultados_hc[$i]['clave_unica'] !== $lista_resultados_isaai[$j]['clave_unica']) {
                $j++;
            }
            if ($j === count($lista_resultados_isaai)) {
                if ($cantidad_agregadas < 8) {
                    //agregar nueva maquina
                    //$id_maquina_ocs = new IdMaquinaOcs($lista_resultados_hc[$i]['ID']);
                    $id_maquina_hc = new IdMaquinaHc($lista_resultados_hc[$i]['id']);
                    $maquina_nueva = $capturador_hc->obtener_maquina($id_maquina_hc);
                    /*
                      //Es lo correcto que se haga con fecha y hora actual
                      //pero por ahora para pruebas sin el ocs funcionando, si no consideramos
                      //estos datos del ocs, siempre va a considerar que la maquina haya cambiado
                      $fecha_y_hora_actual = Util::get_fecha_y_hora_actual_mysql(); //aaaa-mm-dd hh:mm:ss
                      $maquina_nueva->set_fecha_alta($fecha_y_hora_actual);
                      $maquina_nueva->set_fecha_cambio($fecha_y_hora_actual);
                      $maquina_nueva->set_fecha_sincronizacion($fecha_y_hora_actual);
                     */
                    if ($maquina_nueva->insertar() == true) {
                        $cantidad_agregadas++;
                        $lista_maquinas_nuevas[] = $maquina_nueva;
                    } else {
                        //Out::print_array(Conexion::get_instacia(CONEXION_ISAAI)->get_error());
                    }
                }
            } else {
                //comparar la fechas
                $cantidad_comparaciones++;
                //if ($lista_resultados_ocs[$i]['LASTCOME'] != $lista_resultados_isaai[$j]['fecha_sincronizacion']) {
                if ($lista_resultados_hc[$i]['fecha_sincronizacion'] != $lista_resultados_isaai[$j]['fecha_sincronizacion']) {
                    //$id_maquina_ocs = new IdMaquinaOcs($lista_resultados_hc[$i]['ID']);
                    $id_maquina_hc = new IdMaquinaHc($lista_resultados_hc[$i]['id']);
                    $lista_maquinas_hc[] = $capturador_hc->obtener_maquina($id_maquina_hc);
                    $id_maquina_isaai = new IdMaquinaIsaai($lista_resultados_isaai[$j]['id'], $lista_resultados_isaai[$j]['fecha_cambio']);
                    $lista_maquinas_isaai[] = $capturador_isaai->obtener_maquina($id_maquina_isaai);
                }
            }
        }
//        Out::println($cantidad_agregadas);
//        Out::println("Compare: $cantidad_comparaciones de las cuales " . count($lista_maquinas_isaai) . " podrían haber cambiado.");
        $lista_maquinas[] = $lista_maquinas_hc;
        $lista_maquinas[] = $lista_maquinas_isaai;
        $lista_maquinas[] = $lista_maquinas_nuevas;
        /*
          echo 'maquinas isaai';
          Out::print_array($lista_maquinas_isaai);
          echo 'maquinas ocs';
          Out::print_array($lista_maquinas_ocs);
          echo 'maquinas nuevas';
          Out::print_array($lista_maquinas_nuevas);
         * */
        return $lista_maquinas;
    }

}
