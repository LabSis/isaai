<?php

/**
 * Description of procesador_isaai
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class ProcesadorIsaai implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT p.tipo, p.velocidad, p.nucleos FROM procesadores AS p "
                . "INNER JOIN maquinas AS maquina ON "
                . "p.id_maquina = maquina.id AND p.fecha_cambio = maquina.fecha_cambio "
                . "WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $procesadores = array();
        if (empty($resultados)) {
            $consulta = "SELECT p.tipo, p.velocidad, p.nucleos FROM procesadores AS p "
                    . "INNER JOIN maquinas AS maquina "
                    . "ON p.id_maquina = maquina.id AND p.fecha_cambio = maquina.fecha_cambio "
                    . "WHERE maquina.id = '{$id_maquina->get_id_hash()}' AND p.fecha_cambio = ( "
                    . "SELECT MAX(p2.fecha_cambio) FROM procesadores AS p2 "
                    . "WHERE p2.id_maquina = maquina.id )";
            $resultados = $conexion->consultar_simple($consulta);
        }
        for ($i = 0; $i < count($resultados); $i++) {
            $procesador = new Procesador();
            $procesador->set_id(null);
            $procesador->set_numero($resultados[$i]["nucleos"]);
            $procesador->set_tipo($resultados[$i]["tipo"]);
            $procesador->set_velocidad($resultados[$i]["velocidad"]);
            $procesadores[] = $procesador;
        }
        return $procesadores;
    }

    public static function desmaterializar($maquina, $procesador) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $datos_insercion = array(
            'id_maquina' => $maquina->get_id(),
            'fecha_cambio' => "now()",
            'tipo' => $procesador->get_tipo(),
            'velocidad' => $procesador->get_velocidad(),
            'nucleos' => $procesador->get_numero()
        );
        echo "___";
        print_r($datos_insercion);
        return $conexion->insertar('procesadores', $datos_insercion);
    }

}
