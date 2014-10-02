<?php

/**
 * Esta clase materializará un objeto a partir de un registro desde la tabla 
 * "memorias" de la base de datos del ISAAI.
 * 
 * @author Milagros Zea
 * @version 1.0
 */
class MemoriaIsaai implements ComponenteMaterializable {

    public static function materializar($_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $id_maquina = $_maquina->get_id();
        $resultado = $conexion->consultar('memorias', 'id, fecha_cambio, capacidad, tipo, descripcion, numero_serial, numero_renura, velocidad, nombre', 'id=' . $id_maquina);
        // new Memoria($_id, $_capacidad, $_tipo, $_descripcion, $_numero_serial, $_numero_ranura, $_velocidad, $_nombre)
        $memoria = new Memoria($resultado['id'], null, null, null, null, null, null, null);
        $memoria->set_capacidad($resultado['capacidad']);
        $memoria->set_descripcion($resultado['decripcion']);
        $memoria->set_nombre($resultado['nombre']);
        $memoria->set_numero_ranura($resultado['numero_renura']);
        $memoria->set_numero_serial($resultado['numero_serial']);
        $memoria->set_tipo($resultado['tipo']);
        $memoria->set_velocidad($resultado['velocidad']);
        $memoria->set_fecha_cambio($resultado['fecha_cambio']);
        return $memoria;
    }

    public static function desmaterializar($maquina, $memoria) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => Util::convertir_fecha_a_mysql($maquina->get_fecha_cambio()),
            'capacidad' => $memoria->get_capacidad(),
            'tipo' => $memoria->get_tipo(),
            'descripcion' => $memoria->get_descripcion(),
            'numero_serial' => $memoria->get_numero_serial(),
            'numero_ranura' => $memoria->get_numero_ranura(),
            'velocidad' => $memoria->get_velocidad(),
            'nombre' => $memoria->get_nombre()
        );
        return $conexion->insertar('memorias', $datos_insercion);
    }

}
