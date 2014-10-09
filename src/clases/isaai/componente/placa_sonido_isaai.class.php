<?php

/**
 * Description of placa_sonido_isaai
 *
 * @author Diego
 * @version 1.0
 */
class PlacaSonidoIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT ps.nombre, ps.fabricante, "
                . "ps.fecha_cambio FROM placas_sonido AS ps "
                . "INNER JOIN maquinas AS maquina ON "
                . "ps.id_maquina = maquina.id AND ps.fecha_cambio = maquina.fecha_cambio "
                . "WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $placas_sonido = array();
        for ($i = 0; $i < count($resultados); $i++) {
            $placa_sonido = new PlacaSonido();
            $placa_sonido->set_id(null);
            $placa_sonido->set_nombre($resultados[$i]['nombre']);
            $placa_sonido->set_fabricante($resultados[$i]['fabricante']);
//            $placa_sonido->set_fecha_cambio($resultados[$i]['fecha_cambio']);
            $placas_sonido[] = $placa_sonido;
        }
        return $placas_sonido;
    }

    public static function desmaterializar($maquina, $placa_sonido) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => $maquina->get_fecha_cambio(),
            'nombre' => $placa_sonido->get_nombre(),
            'fabricante' => $placa_sonido->get_fabricante()
        );
        return $conexion->insertar('placas_sonido', $datos_insercion);
    }

}
