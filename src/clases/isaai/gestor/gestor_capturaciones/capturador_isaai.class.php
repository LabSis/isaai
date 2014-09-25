<?php

/**
 *
 * @author Diego Barrionevo
 * @version 1.0
 */
class CapturadorIsaai implements Capturador {

    public static function obtener_maquina($id_maquina) {
        $maquina = new Maquina();
        $maquina->set_id($id_maquina->get_id_hash());
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $resultados = $conexion->consultar_simple("SELECT * FROM maquinas WHERE {$id_maquina->get_condicion_unicidad_sql()}");
        $maquina->set_nombre($resultados[0]["nombre"]);
        $procesador = array();
        $procesador[] = ProcesadorIsaai::materializar($id_maquina);
        $maquina->set_procesadores($procesador);
        return $maquina;
    }

}
