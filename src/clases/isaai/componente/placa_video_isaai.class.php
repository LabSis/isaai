<?php

/**
 * Description of placa_video_isaai
 *
 * @author Diego
 * @version 1.0
 */
class PlacaVideoIsaai implements ComponenteMaterializable {

    public static function desmaterializar($maquina, $placa_video) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => Util::convertir_fecha_a_mysql($maquina->get_fecha_cambio()),
            'nombre' => $placa_video->get_nombre(),
            'memoria' => $placa_video->get_memoria(),
            'chipset' => $placa_video->get_chipset()
        );
        return $conexion->insertar('placas_video', $datos_insercion);
    }

    public static function materializar($id_maquina) {
        
    }

}
