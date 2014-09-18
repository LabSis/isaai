<?php

/**
 * Esta clase materializará un registro de la tabla "Disco" desde la BD ocsweb 
 * en un objeto bios
 *
 * @author Milagros Zea
 * @version 1.0
 */
class DiscoOCS implements ComponenteMaterializable{    
    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT manufacturer, name ,model, description,"
                . " type, disksize, serialnumber, firmware FROM storages AS s INNER JOIN hardware AS hardware ON "
                . " s.hardware_id = hardware.id WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        //cargo el objeto disco...
        $disco = new Disco(null, $resultado[0]['name'], $resultado[0]['manufacturer'], $resultado[0]['model'],
                $resultado[0]['description'], $resultado[0]['type'], $resultado[0]['disksize'],
                $resultado[0]['serialnumber'], $resultado[0]['firmware']);
        return $disco;
    }
    
}
