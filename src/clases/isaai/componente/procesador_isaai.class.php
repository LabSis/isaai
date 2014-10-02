<?php

/**
 * Description of procesador_isaai
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class ProcesadorIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT p.tipo, p.velocidad, p.nucleos FROM procesadores AS p "
                . "INNER JOIN maquinas AS m ON "
                . "p.id_maquina = m.id AND p.fecha_cambio = m.fecha_cambio "
                . "WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $procesador = new Procesador(null, null, null, null);
        $procesador->set_id(null);
        $procesador->set_numero($resultado[0]["nucleos"]);
        $procesador->set_tipo($resultado[0]["tipo"]);
        $procesador->set_velocidad($resultado[0]["velocidad"]);
        return $procesador;
    }

    public static function desmaterializar($maquina, $procesador) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => Util::convertir_fecha_a_mysql($maquina->get_fecha_cambio()),
            'tipo' => $procesador->get_tipo(),
            'velocidad' => $procesador->get_velocidad(),
            'nucleos' => $procesador->get_numero()
        );
        return $conexion->insertar('procesadores', $datos_insercion);
    }

}
