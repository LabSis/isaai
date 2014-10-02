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
        $consulta = "SELECT m.type, m.manufacturer, m.caption, m.description,"
                . " m.serial FROM monitors AS m INNER JOIN hardware AS hardware ON "
                . " m.hardware_id = hardware.id WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $monitores = array();
        for ($i = 0; $i < count($resultados); $i++) {
            $monitor = new Monitor();
            $monitor->set_id(null);
            //$monitor->set_descripcion($resultado[0]['description']);
            $monitor->set_modelo($resultados[$i]['manufacturer']);
            $monitor->set_nombre($resultados[$i]['caption']);
            //$monitor->set_tipo($resultados[$i]['type']);
            $monitores[] = $monitor;
        }
        return $monitores;
    }

    public static function desmaterializar($maquina, $componene) {
        ;
    }

    //put your code here
}
