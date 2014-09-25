<?php

/**
 * Esta clase materializará un registro de la tabla "monitors" desde ocsweb en un 
 * objeto bios
 *
 * @author Milagros Zea
 * @version 1.0
 */
class MonitorOcs implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT type, manufacturer, caption, description,"
                . " serial, FROM inputs AS b INNER JOIN hardware AS hardware ON "
                . " b.hardware_id = hardware.id WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        //cargo el objeto bios...
        $monitor = new Monitor(null, null, null, null);
        $monitor->set_id(null);
        $monitor->set_descripcion($resultado[0]['description']);
        $monitor->set_modelo($resultado[0]['manufacturer']);
        $monitor->set_nombre($resultado[0]['caption']);
        $monitor->set_nombre($resultado[0]['type']);

        return $monitor;
    }

    public static function desmaterializar($maquina, $componene) {
        ;
    }

    //put your code here
}
