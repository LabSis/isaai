<?php

/**
 *
 * @author Diego Barrionevo
 * @version 1.0
 */
class CapturadorIsaai implements Capturador {

    public static function obtener_maquina($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT * FROM maquinas WHERE {$id_maquina->get_condicion_unicidad_sql()}";
        $resultados = $conexion->consultar_simple($consulta);

        $maquina = new Maquina();
        $maquina->set_id($id_maquina->get_id_hash());
        $maquina->set_nombre($resultados[0]["nombre"]);
        $maquina->set_fecha_alta($resultados[0]["fecha_alta"]);
        $maquina->set_fecha_cambio($resultados[0]["fecha_cambio"]);
        $maquina->set_fecha_sincronizacion($resultados[0]["fecha_sincronizacion"]);
        
        $sistema_operativo = SistemaOperativo::materializar($id_maquina);
        $maquina->set_sistema_operativo($sistema_operativo);

        $procesador = array();
        $procesador[] = ProcesadorIsaai::materializar($id_maquina);
        $maquina->set_procesadores($procesador);
        return $maquina;
    }

}
