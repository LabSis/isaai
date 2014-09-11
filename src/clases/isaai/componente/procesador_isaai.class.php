<?php

/**
 * Description of procesador_isaai
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class ProcesadorIsaai implements ComponenteMaterializable {

    public static function materializar($_maquina) {
        
    }

    public static function desmaterializar($procesador) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => 'nose',
            'fecha_cambio' => '2014-06-12',
            'tipo' => $procesador->get_tipo(),
            'velocidad' => $procesador->get_velocidad(),
            'numero' => $procesador->get_numero()
        );
        return $conexion->insertar('procesadores', $datos_insercion);
    }

}
