<?php

/**
 * Esta clase materializará un registro de la tabla "discos", en la BD del ISAAI
 * en un objeto Disco.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class DiscoIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT d.nombre, d.fabricante, d.modelo, d.descripcion, "
                . "d.tipo, d.firmware, d.tamanio, d.numero_serial, d.fecha_cambio FROM discos AS d "
                . "INNER JOIN maquinas AS maquinas ON "
                . "d.id_maquina = maquinas.id AND d.fecha_cambio = maquinas.fecha_cambio "
                . "WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        //new Disco($_id, $_nombre, $_fabricante, $_modelo, $_descripcion, $_tipo, $_tamanio, $_numero_serial, $_firmware)
        $disco = new Disco();
        $disco->set_id(null);
        $disco->set_nombre($resultado['nombre']);
        $disco->set_fabricante($resultado['fabricante']);
        $disco->set_modelo($resultado['modelo']);
        $disco->set_descripcion($resultado['descripcion']);
        $disco->set_tipo($resultado['tipo']);
        $disco->set_firmware($resultado['firmware']);
        $disco->set_tamanio($resultado['tamanio']);
        $disco->set_numero_serial($resultado['numero_serial']);
        $disco->set_fecha_cambio($resultado['fecha_cambio']);
        return $disco;
    }

    public static function desmaterializar($maquina, $disco) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => Util::convertir_fecha_a_mysql($maquina->get_fecha_cambio()),
            'nombre' => $disco->get_nombre(),
            'fabricante' => $disco->get_fabricante(),
            'modelo' => $disco->get_modelo(),
            'descripcion' => $disco->get_descripcion(),
            'tipo' => $disco->get_tipo(),
            'tamanio' => $disco->get_tamanio(),
            'numero_serial' => $disco->get_numero_serial(),
            'firmware' => $disco->get_firmware()
        );
        return $conexion->insertar('discos', $datos_insercion);
    }

}
