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
        $consulta = "SELECT i.type, i.manufacturer, i.caption, i.description,"
                . " i.interface FROM inputs AS i INNER JOIN hardware AS hardware ON "
                . " i.hardware_id = hardware.id WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $perifericos = array();
        for ($i = 0; $i < count($resultados); $i++) {
            $periferico = new Periferico();
            $periferico->set_id(null);
            $periferico->set_descripcion($resultados[$i]['caption']);
            $periferico->set_fabricante($resultados[$i]['manufacturer']);
            $periferico->set_interfaz($resultados[$i]['interface']);
            $periferico->set_tipo($resultados[$i]['type']);
            $periferico->set_nombre($resultados[$i]['description']);
            $perifericos[] = $periferico;
        }
        return $perifericos;
    }

    public static function desmaterializar($maquina, $componene) {
        ;
    }

}
