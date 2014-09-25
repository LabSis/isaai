<?php

/**
 * Esta clase materializará un registro de la tabla "videos" desde ocsweb en un
 * objeto Placa de Video.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class PlacaVideoOcs implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT name, chipset, memory"
                . " FROM videos AS b INNER JOIN hardware AS hardware ON "
                . " b.hardware_id = hardware.id WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        $placa_video = new PlacaVideo(null, null, null, null);
        $placa_video->set_id(null);
        $placa_video->set_chipset($resultado[0]['chipset']);
        $placa_video->set_memoria($resultado[0]['memory']);
        $placa_video->set_nombre($resultado[0]['name']);
        return $placa_video;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
