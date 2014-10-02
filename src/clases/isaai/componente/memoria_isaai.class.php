<?php

/**
 * Esta clase materializará un objeto a partir de un registro desde la tabla 
 * "memorias" de la base de datos del ISAAI.
 * 
 * @author Milagros Zea
 * @version 1.0
 */
class MemoriaIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT m.capacidad, m.tipo, m.descripcion, m.numero_serial, "
                . "m.numero_ranura, m.velocidad, m.nombre, m.fecha_cambio FROM memorias AS m "
                . "INNER JOIN maquinas AS maquinas ON "
                . "m.id_maquina = maquinas.id AND m.fecha_cambio = maquinas.fecha_cambio "
                . "WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $memoria = new Memoria();
        $memoria->set_id(null);
        $memoria->set_capacidad($resultado['capacidad']);
        $memoria->set_tipo($resultado['tipo']);
        $memoria->set_descripcion($resultado['decripcion']);
        $memoria->set_numero_serial($resultado['numero_serial']);
        $memoria->set_numero_ranura($resultado['numero_ranura']);
        $memoria->set_velocidad($resultado['velocidad']);
        $memoria->set_nombre($resultado['nombre']);
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
