<?php

/**
 * Esta clase materializará un registro de la tabla "storages" desde la BD ocsweb 
 * en un objeto bios
 *
 * @author Milagros Zea
 * @version 1.0
 */
class DiscoOcs implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT manufacturer, name ,model, description,"
                . " type, disksize, serialnumber, firmware FROM storages AS s INNER JOIN hardware AS hardware ON "
                . " s.hardware_id = hardware.id WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        //cargo el objeto disco...
        $disco = new Disco(null, null, null, null, null, null, null, null, null);
        $disco->set_id(null);
        $disco->set_nombre($resultado[0]['name']);
        $disco->set_fabricante($resultado[0]['manufacturer']);
        $disco->set_modelo($resultado[0]['model']);
        $disco->set_descripcion($resultado[0]['description']);
        $disco->set_tipo($resultado[0]['type']);
        $disco->set_tamanio($resultado[0]['disksize']);
        $disco->set_numero_serial($resultado[0]['serialnumber']);
        $disco->set_firmware($resultado[0]['firmware']);
        return $disco;
    }

    public static function desmaterializar($maquina, $componene) {
        ;
    }

}
