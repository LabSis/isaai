<?php

/**
 * Esta clase materializará un objeto a partir de un registro desde la tabla 
 * "monitores" de la base de datos del ISAAI.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class MonitorISAAI implements ComponenteMaterializable {

    //se pasa como parametro la maquina a la que pertenece el componente.
    public static function materializar($_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $id_maquina = $_maquina->get_id();
        $resultado = $conexion->consultar('monitores', 'id, fecha_cambio, nombre, modelo, resolucion', 'id=' . $id_maquina);
        //new Monitor($_id, $_nombre, $_modelo, $_resolucion)
        $monitor = new Monitor($resultado['id'], null, null, null);
        $monitor->set_modelo($resultado['modelo']);
        $monitor->set_nombre($resultado['nombre']);
        $monitor->set_resolucion($resultado['resolucion']);
        $monitor->set_fecha_cambio($resultado['fecha_cambio']);
        return $monitor;
    }

}
