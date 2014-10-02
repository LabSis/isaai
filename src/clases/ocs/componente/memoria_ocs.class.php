<?php

/**
 * Esta clase materializará un registro de la tabla "memories" desde ocsweb en un 
 * objeto Memoria.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class MemoriaOcs implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT m.capacity, m.description, m.caption, m.type,"
                . " m.numslots, m.serialnumber FROM memories AS m INNER JOIN hardware AS hardware ON "
                . " m.hardware_id = hardware.id WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $memorias = array();
        for ($i = 0; $i < count($resultados); $i++) {
            $memoria = new Memoria();
            $memoria->set_id(null);
            $memoria->set_capacidad($resultados[$i]['capacity']);
            $memoria->set_descripcion($resultados[$i]['description']);
            $memoria->set_nombre($resultados[$i]['caption']);
            $memoria->set_numero_ranura($resultados[$i]['numslots']);
            $memoria->set_numero_serial($resultados[$i]['serialnumber']);
            $memoria->set_tipo($resultados[$i]['type']);
            $memorias[] = $memoria;
        }
        return $memorias;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
