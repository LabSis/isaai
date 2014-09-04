<?php

/**
 * Description of procesador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class ProcesadorOcs implements ComponenteMaterializable {

    public function materializar() {
        //consultas a la bd de ocs para materializar objeto
        $conexion = Conexion::get_instacia();
        $resultado = $conexion->consultar_simple("SELECT processort,processors,processorn FROM hardware");
        $procesador = new Procesador($resultado[0]['processort'], $resultado[0]['processors'], $resultado[0]['processorn']);
        return $procesador;
    }

}
