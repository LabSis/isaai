<?php

/**
 * Description of procesador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class ProcesadorOcs implements ComponenteMaterializable {

    public static function materializar($id_maquina_ocs) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina_ocs->get_condicion_unicidad_sql();
        $consulta = "SELECT processort, processors, processorn FROM hardware WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $procesador = new Procesador(null, null, null, null);
        $procesador->set_id(null);
        $procesador->set_tipo($resultado[0]['processort']);
        $procesador->set_velocidad($resultado[0]['processors']);
        $procesador->set_numero($resultado[0]['processorn']);
        return $procesador;
    }

    public static function desmaterializar($maquina, $componene) {
        ;
    }

}
