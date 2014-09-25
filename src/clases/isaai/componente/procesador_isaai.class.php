<?php

/**
 * Description of procesador_isaai
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class ProcesadorIsaai implements ComponenteMaterializable {

    public static function materializar($_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT tipo, velocidad, nucleos FROM maquinas WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $procesador = new Procesador(null, $resultado[0]["tipo"], $resultado[0]["velocidad"], $resultado[0]["nucleos"]);
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
