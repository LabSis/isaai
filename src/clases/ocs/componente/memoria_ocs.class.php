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
        $consulta = "SELECT capacity, description, caption, type,"
                . " numslots, serialnumber FROM memories AS b INNER JOIN hardware AS hardware ON "
                . " b.hardware_id = hardware.id WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $memoria = new Memoria(null, null, null, null, null, null, null, null);
        $memoria->set_id(null);
        $memoria->set_capacidad($resultado[0]['capacity']);
        $memoria->set_descripcion($resultado[0]['description']);
        $memoria->set_nombre($resultado[0]['caption']);
        $memoria->set_numero_ranura($resultado[0]['numslots']);
        $memoria->set_numero_serial($resultado[0]['serialnumber']);
        $memoria->set_tipo($resultado[0]['type']);
        return $memoria;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
