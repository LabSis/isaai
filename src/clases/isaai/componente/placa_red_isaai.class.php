<?php

/**
 * Description of placa_red_isaai
 *
 * @author Diego
 * @version 1.0
 */
class PlacaRedIsaai implements ComponenteMaterializable {

    public static function desmaterializar($maquina, $placa_red) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => Util::convertir_fecha_a_mysql($maquina->get_fecha_cambio()),
            'direccion_mac' => $placa_red->get_direccion_mac(),
            'direccion_ip' => $placa_red->get_direccion_ip(),
            'direccion_dns' => $placa_red->get_direccion_dns(),
            'direccion_red' => $placa_red->get_direccion_red(),
            'mascara' => $placa_red->get_mascara(),
            'descripcion' => $placa_red->get_descripcion(),
            'tipo' => $placa_red->get_tipo(),
            'velocidad' => $placa_red->get_velocidad()
        );
        return $conexion->insertar('placas_red', $datos_insercion);
    }

    public static function materializar($id_maquina) {
        
    }

}
