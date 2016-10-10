<?php

/**
 * Description of procesador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class ProcesadorHc implements ComponenteMaterializable {

    public static function materializar($id_maquina_hc) {
        $conexion = Conexion::get_instacia(CONEXION_HC);
        $condicion = $id_maquina_hc->get_condicion_unicidad_sql();
        $consulta = "SELECT cxc.nombre AS caracteristica, cxcxm.valor AS valor 
FROM componentes_x_maquinas AS cxm 
INNER JOIN componentes AS c ON c.id = cxm.id_componente 
INNER JOIN caracteristicas_x_componentes AS cxc ON cxc.id_componente = c.id 
INNER JOIN caracteristicas_x_componentes_x_maquinas AS cxcxm ON cxcxm.id_caracteristica = cxc.id_caracteristica 
INNER JOIN maquinas AS maquina ON maquina.id = cxcxm.id_maquina 
WHERE 1=1 AND maquina.id = '1' AND c.nombre = 'procesador' ";
        echo $consulta;
        $resultados = $conexion->consultar_simple($consulta);
        $procesadores = array();
        $procesador = new Procesador();
        $procesador->set_id(null);
        foreach ($resultados as $resultado) {
            $caracteristica = $resultado["caracteristica"];
            $valor = $resultado["valor"];
            if ($caracteristica === "arquitectura") {
                $procesador->set_tipo($valor);
            } else if ($caracteristica === "velocidad") {
                $procesador->set_velocidad($valor);
            } else if ($caracteristica === "cantidad_procesadores") {
                $procesador->set_numero($valor);
            }
        }
        $procesadores[] = $procesador;
        return $procesadores;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
