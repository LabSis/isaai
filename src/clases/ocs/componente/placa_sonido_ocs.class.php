<?php

/**
 * Esta clase materializará un registro de la tabla "sounds" desde ocsweb en un
 * objeto Placa de Sonido.
 *
 * @author Milagros Zea
 */
class PlacaSonidoOcs implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT manufacturer, name, description"
                . " FROM sounds AS b INNER JOIN hardware AS hardware ON "
                . " b.hardware_id = hardware.id WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $placa_sonido = new PlacaSonido(null, null, null);
        $placa_sonido->set_id(null);
        $placa_sonido->set_nombre($resultado[0]['name']);
        $placa_sonido->set_fabricante($resultado[0]['manufacturer']);
        return $placa_sonido;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
