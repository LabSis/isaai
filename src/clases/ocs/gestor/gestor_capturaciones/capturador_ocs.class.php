<?php

/**
 * Description of capturador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class CapturadorOcs implements Capturador {

    public static function obtener_maquina($id_maquina_ocs) {
        $id_maquina_ocs->cargar_valores_unicidad();
        $id_maquina_ocs->generar_condicion_unicidad_sql();
        
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $resultados = $conexion->consultar_simple("SELECT * FROM hardware WHERE ID = {$id_maquina_ocs->get_id_maquina_ocs()}");
        
        $maquina = new Maquina();
        $maquina->set_id($id_maquina_ocs->get_id_hash());
        $maquina->set_nombre($resultados[0]["NAME"]);
        $maquina->set_fecha_sincronizacion($resultados[0]["LASTCOME"]);
        
        $sistema_operativo = new SistemaOperativo(null, $resultados[0]["OSNAME"], $resultados[0]["OSVERSION"]);
        $maquina->set_sistema_operativo($sistema_operativo);
        $procesadores = array();
        $procesadores[] = ProcesadorOcs::materializar($id_maquina_ocs);
        $maquina->set_procesadores($procesadores);
        return $maquina;
    }

}
