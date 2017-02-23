<?php

/**
 * Esta clase materializará un registro de la tabla "memories" desde ocsweb en un 
 * objeto Memoria.
 *
 * @author Milagros Zea
 * @version 1.0
 */
class MemoriaHc implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $memorias = array();
        $conexion = Conexion::get_instacia(CONEXION_HC);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT cxm.id AS id, cxm.id_maquina AS id_maquina, 
            cxm.id_componente AS id_componente, cxm.posicion AS posicion 
            FROM componentes_x_maquinas AS cxm
INNER JOIN componentes AS c ON cxm.id_componente = c.id 
INNER JOIN maquinas AS maquina ON maquina.id = cxm.id_maquina 
WHERE {$condicion} AND c.nombre = 'memorias_ram' ";
        $resultados = $conexion->consultar_simple($consulta);
        foreach ($resultados as $resultado) {
//            $id = $resultado["id"];
            $id_maquina = $resultado["id_maquina"];
            $id_componente = $resultado["id_componente"];
            $posicion = $resultado["posicion"];
            $consulta = "SELECT cxc.nombre AS caracteristica, cxcxm.valor AS valor  
FROM caracteristicas_x_componentes_x_maquinas AS cxcxm 
INNER JOIN caracteristicas_x_componentes AS cxc ON cxc.id = cxcxm.id_caracteristica 
INNER JOIN maquinas AS maquina ON maquina.id = cxcxm.id_maquina 
WHERE {$condicion} AND cxcxm.id_maquina = {$id_maquina} AND cxcxm.id_componente = {$id_componente} AND cxcxm.posicion = {$posicion}";
            $subresultados = $conexion->consultar_simple($consulta);
            $memoria = new Memoria();
            $memoria->set_id(null);
            foreach ($subresultados as $subresultado) {
                $caracteristica = $subresultado["caracteristica"];
                $valor = $subresultado["valor"];
                if ($caracteristica === "banco") {
                    $memoria->set_nombre($valor);
                } else if ($caracteristica === "tecnolgia") {
                    $memoria->set_tipo($valor);
                } else if ($caracteristica === "fabricante") {
                    $memoria->set_descripcion($valor);
                } else if ($caracteristica === "numero_serie") {
                    $memoria->set_numero_serial($valor);
                } else if ($caracteristica === "tamanio_bus_datos") {
                    $memoria->set_numero_ranura($valor);
                } else if ($caracteristica === "velocidad") {
                    $memoria->set_velocidad($valor);
                } else if ($caracteristica === "tamanio") {
                    $memoria->set_capacidad($valor);
                }
            }
            $memorias[] = $memoria;
        }
        return $memorias;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
