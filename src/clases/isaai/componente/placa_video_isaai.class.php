<?php

/**
 * Description of placa_video_isaai
 *
 * @author Diego
 * @version 1.0
 */
class PlacaVideoIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT pv.nombre, pv.memoria, pv.chipset "
                . " pv.fecha_cambio FROM placas_video AS pv "
                . "INNER JOIN maquinas AS maquina ON "
                . "pv.id_maquina = maquina.id AND pv.fecha_cambio = maquina.fecha_cambio "
                . "WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $placas_video = array();
        for ($i = 0; $i < count($resultados); $i++) {
            $placa_video = new PlacaVideo();
            $placa_video->set_id(null);
            $placa_video->set_nombre($resultados[$i]['nombre']);
            $placa_video->set_memoria($resultados[$i]['memoria']);
            $placa_video->set_chipset($resultados[$i]['chipset']);
            $placas_video[] = $placa_video;
        }
        return $placas_video;
    }

    public static function desmaterializar($maquina, $placa_video) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => Util::convertir_fecha_a_mysql($maquina->get_fecha_cambio()),
            'nombre' => $placa_video->get_nombre(),
            'memoria' => $placa_video->get_memoria(),
            'chipset' => $placa_video->get_chipset()
        );
        return $conexion->insertar('placas_video', $datos_insercion);
    }

}
