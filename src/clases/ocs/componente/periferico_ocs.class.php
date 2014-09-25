<?php

/**
 * Esta clase materializará un registro de la tabla "inputs" desde ocsweb en un 
 * objeto Periferico
 * 
 * @author Milagros Zea
 * @version 1.0
 */
class PerifericoOcs implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT type, manufacturer, caption, description,"
                . " interfaz, FROM inputs AS b INNER JOIN hardware AS hardware ON "
                . " b.hardware_id = hardware.id WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        //cargo el objeto bios...
        $periferico = new Perisferico(null, null, null, null, null, null);
        $periferico->set_id(null);
        $periferico->set_descripcion($resultado[0]['caption']);
        $periferico->set_fabricante($resultado[0]['manufacturer']);
        $periferico->set_interfaz($resultado[0]['interfaz']);
        $periferico->set_tipo($resultado[0]['type']);
        $periferico->set_nombre($resultado[0]['description']);
        return $periferico;
    }

    public static function desmaterializar($maquina, $componene) {
        ;
    }

}
