<?php

/**
 * Description of placa_red_isaai
 *
 * @author Diego
 * @version 1.0
 */
class PlacaRedIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT pr.direccion_ip, pr.direccion_mac, pr.direccion_red, pr.direccion_dns, "
                . "pr.mascara, pr.gateway, pr.descripcion, pr.tipo, pr.velocidad, "
                . "pr.fecha_cambio FROM placas_red AS pr "
                . "INNER JOIN maquinas AS maquinas ON "
                . "pr.id_maquina = maquinas.id AND pr.fecha_cambio = maquinas.fecha_cambio "
                . "WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $placa_red = new PlacaRed(null, null, null, null, null, null, null, null, null, null);
        $placa_red->set_id(null);
        $placa_red->set_direccion_ip($resultado[0]['direccion_ip']);
        $placa_red->set_direccion_mac($resultado[0]['direccion_mac']);
        $placa_red->set_direccion_red($resultado[0]['direccion_red']);
        $placa_red->set_direccion_dns($resultado[0]['direccion_dns']);
        $placa_red->set_mascara($resultado[0]['mascara']);
        $placa_red->set_gateway($resultado[0]['gateway']);
        $placa_red->set_descripcion($resultado[0]['descripcion']);
        $placa_red->set_tipo($resultado[0]['tipo']);
        $placa_red->set_velocidad($resultado[0]['velocidad']);
        $placa_red->set_fecha_cambio($resultado[0]['fecha_cambio']);
        return $placa_red;
    }

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
