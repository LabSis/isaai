<?php

/**
 * Description of procesador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class ProcesadorOcs implements ComponenteMaterializable {

    public static function materializar($mapa_unicidad) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = " 1=1 ";
        foreach ($mapa_unicidad as $campo_unicidad => $valor_unico) {
            $condicion.= ($campo_unicidad === "VERSION_SO") ? " AND osversion = {$valor_unico}" : "";
            $condicion.= ($campo_unicidad === "NOMBRE_SO") ? " AND osname = {$valor_unico}" : "";
            $condicion.= ($campo_unicidad === "NOMBRE_MAQUINA") ? " AND name = {$valor_unico}" : "";
        }
        $resultado = $conexion->consultar("SELECT processort, processors, processorn FROM hardware WHERE {$condicion}");
        $procesador = new Procesador(null, $resultado[0]['processort'], $resultado[0]['processors'], $resultado[0]['processorn']);
        return $procesador;
    }

}
