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
                . "INNER JOIN maquinas AS maquina ON "
                . "pr.id_maquina = maquina.id AND pr.fecha_cambio = maquina.fecha_cambio "
                . "WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $placas_red = array();
        if (empty($resultados)) {
            $consulta = "SELECT pr.direccion_ip, pr.direccion_mac, pr.direccion_red, pr.direccion_dns, "
                    . "pr.mascara, pr.gateway, pr.descripcion, pr.tipo, pr.velocidad, "
                    . "pr.fecha_cambio FROM placas_red AS pr "
                    . "INNER JOIN maquinas AS maquina ON "
                    . "pr.id_maquina = maquina.id AND pr.fecha_cambio = maquina.fecha_cambio "
                    . "WHERE pr.fecha_cambio = ("
                    . " SELECT MAX(pr2.fecha_cambio) FROM placas_red AS pr2 "
                    . " WHERE pr2.id_maquina = maquina.id"
                    . ")";
            $resultados = $conexion->consultar_simple($consulta);
        }
        for ($i = 0; $i < count($resultados); $i++) {
            $placa_red = new PlacaRed();
            $placa_red->set_id(null);
            $placa_red->set_direccion_ip($resultados[$i]['direccion_ip']);
            $placa_red->set_direccion_mac($resultados[$i]['direccion_mac']);
            $placa_red->set_direccion_red($resultados[$i]['direccion_red']);
            $placa_red->set_direccion_dns(null);
            $placa_red->set_mascara($resultados[$i]['mascara']);
            $placa_red->set_gateway($resultados[$i]['gateway']);
            $placa_red->set_descripcion($resultados[$i]['descripcion']);
            $placa_red->set_tipo($resultados[$i]['tipo']);
            $placa_red->set_velocidad($resultados[$i]['velocidad']);
//            $placa_red->set_fecha_cambio($resultados[$i]['fecha_cambio']);
            $placas_red[] = $placa_red;
        }
        return $placas_red;
    }

    public static function desmaterializar($maquina, $placa_red) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => $maquina->get_fecha_cambio(),
            'direccion_mac' => $placa_red->get_direccion_mac(),
            'direccion_ip' => $placa_red->get_direccion_ip(),
            'direccion_dns' => $placa_red->get_direccion_dns(),
            'direccion_red' => $placa_red->get_direccion_red(),
            'gateway' => $placa_red->get_gateway(),
            'mascara' => $placa_red->get_mascara(),
            'descripcion' => $placa_red->get_descripcion(),
            'tipo' => $placa_red->get_tipo(),
            'velocidad' => $placa_red->get_velocidad()
        );
        return $conexion->insertar('placas_red', $datos_insercion);
    }

}
