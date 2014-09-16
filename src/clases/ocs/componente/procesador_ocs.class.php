<?php

/**
 * Description of procesador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class ProcesadorOcs implements ComponenteMaterializable {

    public static function materializar($idMaquinaOcs) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $idMaquinaOcs->get_condicion_unicidad_sql();
        $consulta = "SELECT processort, processors, processorn FROM hardware WHERE {$condicion}";
        echo $consulta;
        $resultado = $conexion->consultar_simple($consulta);
        $procesador = new Procesador(null, $resultado[0]['processort'], $resultado[0]['processors'], $resultado[0]['processorn']);
        return $procesador;
    }

}
