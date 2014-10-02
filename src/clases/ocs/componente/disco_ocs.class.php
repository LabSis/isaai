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
        $consulta = "SELECT s.manufacturer, s.name, s.model, s.description, "
                . " s.type, s.disksize, s.serialnumber, s.firmware FROM storages AS s INNER JOIN hardware AS hardware ON "
                . " s.hardware_id = hardware.id WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $discos = array();
        for ($i = 0; $i < count($resultados); $i++) {
            $disco = new Disco();
            $disco->set_id(null);
            $disco->set_nombre($resultados[$i]['name']);
            $disco->set_fabricante($resultados[$i]['manufacturer']);
            $disco->set_modelo($resultados[$i]['model']);
            $disco->set_descripcion($resultados[$i]['description']);
            $disco->set_tipo($resultados[$i]['type']);
            $disco->set_tamanio($resultados[$i]['disksize']);
            $disco->set_numero_serial($resultados[$i]['serialnumber']);
            $disco->set_firmware($resultados[$i]['firmware']);
            $discos[] = $disco;
        }
        return $discos;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
