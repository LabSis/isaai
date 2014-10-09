<?php

/**
 * Esta clase materializará un objeto a partir de un registro desde la tabla 
 * "monitores" de la base de datos del ISAAI.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class MonitorIsaai implements ComponenteMaterializable {

    //se pasa como parametro la maquina a la que pertenece el componente.
    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT m.nombre, m.modelo, m.monitor, "
                . "m.version, m.fecha_cambio FROM monitores AS m "
                . "INNER JOIN maquinas AS maquinas ON "
                . "m.id_maquina = maquinas.id AND m.fecha_cambio = maquinas.fecha_cambio "
                . "WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $monitor = new Monitor();
        $monitor->set_id(null);
        $monitor->set_nombre($resultado['nombre']);
        $monitor->set_modelo($resultado['modelo']);
        $monitor->set_resolucion($resultado['resolucion']);
        $monitor->set_fecha_cambio($resultado['fecha_cambio']);
        return $monitor;
    }

    public static function desmaterializar($maquina, $monitor) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => $maquina->get_fecha_cambio(),
            'modelo' => $monitor->get_modelo(),
            'nombre' => $monitor->get_nombre(),
            'resoluion' => $monitor->get_resolucion()
        );
        return $conexion->insertar('monitores', $datos_insercion);
    }

}
