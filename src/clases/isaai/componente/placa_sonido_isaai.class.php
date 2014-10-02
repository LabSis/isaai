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
                . "INNER JOIN maquinas AS maquinas ON "
                . "ps.id_maquina = maquinas.id AND ps.fecha_cambio = maquinas.fecha_cambio "
                . "WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        //new Monitor($_id, $_nombre, $_modelo, $_resolucion)
        $placa_sonido = new PlacaSonido();
        $placa_sonido->set_id(null);
        $placa_sonido->set_nombre($resultado[0]['nombre']);
        $placa_sonido->set_fabricante($resultado[0]['fabricante']);
        $placa_sonido->set_fecha_cambio($resultado[0]['fecha_cambio']);
        return $placa_sonido;
    }

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

}
