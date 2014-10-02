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
        //OCS siempre devuelve un sólo procesador para cada máquina, pues sólo 
        //es un registro en la tabla hardware.
        $procesadores = array();
        $procesador = new Procesador();
        $procesador->set_id(null);
        $procesador->set_tipo($resultado[0]['processort']);
        $procesador->set_velocidad($resultado[0]['processors']);
        $procesador->set_numero($resultado[0]['processorn']);
        $procesadores[] = $procesador;
        return $procesadores;
    }

    public static function desmaterializar($maquina, $componene) {
        ;
    }

}
