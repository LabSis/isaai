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
        $consulta = "SELECT v.name, v.chipset, v.memory "
                . " FROM videos AS v INNER JOIN hardware AS hardware ON "
                . " v.hardware_id = hardware.id WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $placas_video = array();
        for ($i = 0; $i < count($resultados); $i++) {
            $placa_video = new PlacaVideo();
            $placa_video->set_id(null);
            $placa_video->set_chipset($resultados[0]['chipset']);
            $placa_video->set_memoria($resultados[0]['memory']);
            $placa_video->set_nombre($resultados[0]['name']);
            $placas_video[] = $placa_video;
        }
        return $placas_video;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
