<?php

/**
 * Description of placa_sonido_isaai
 *
 * @author Diego
 * @version 1.0
 */
class PlacaSonidoIsaai implements ComponenteMaterializable {

    public static function desmaterializar($maquina, $placa_sonido) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => Util::convertir_fecha_a_mysql($maquina->get_fecha_cambio()),
            'nombre' => $placa_sonido->get_nombre(),
            'fabricante' => $placa_sonido->get_fabricante()
        );
        return $conexion->insertar('placas_sonido', $datos_insercion);
    }

    public static function materializar($id_maquina) {
        
    }

}
