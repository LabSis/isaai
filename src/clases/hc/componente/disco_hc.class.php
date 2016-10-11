<?php

/**
 * Esta clase materializará un registro de la tabla "storages" desde la BD ocsweb 
 * en un objeto bios
 *
 * @author Milagros Zea
 * @version 1.0
 */
class DiscoHc implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $discos = array();
        $conexion = Conexion::get_instacia(CONEXION_HC);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT cxm.id AS id 
            FROM componentes_x_maquinas AS cxm
INNER JOIN componentes AS c ON cxm.id_componente = c.id 
INNER JOIN maquinas AS maquina ON maquina.id = cxm.id_maquina 
WHERE {$condicion} AND c.nombre = 'discos_duros' ";
        $resultados = $conexion->consultar_simple($consulta);
        foreach ($resultados as $resultado) {
            $id = $resultado["id"];
            $consulta = "SELECT cxc.nombre AS caracteristica, cxcxm.valor AS valor  
FROM caracteristicas_x_componentes_x_maquinas AS cxcxm 
INNER JOIN caracteristicas_x_componentes AS cxc ON cxc.id = cxcxm.id_caracteristica 
INNER JOIN componentes_x_maquinas AS cxm ON cxm.id = cxcxm.id_componente_x_maquina 
INNER JOIN maquinas AS maquina ON maquina.id = cxm.id_maquina 
WHERE {$condicion} AND cxcxm.id_componente_x_maquina = {$id} ";
            $subresultados = $conexion->consultar_simple($consulta);
            $disco = new Disco();
            $disco->set_id(null);
            foreach ($subresultados as $subresultado) {
                $caracteristica = $subresultado["caracteristica"];
                $valor = $subresultado["valor"];
//                $disco->set_nombre($resultados[$i]['name']);
//                $disco->set_descripcion($resultados[$i]['description']);
                if ($caracteristica === "modelo") {
                    $disco->set_modelo($valor);
                } else if ($caracteristica === "fabricante") {
                    $disco->set_fabricante($valor);
                } else if ($caracteristica === "numero_serie") {
                    $disco->set_numero_serial($valor);
                } else if ($caracteristica === "tipo_interfaz") {
                    $disco->set_tipo($valor);
                } else if ($caracteristica === "firmware") {
                    $disco->set_firmware($valor);
                } else if ($caracteristica === "cantidad_particiones") {
//                    $disco->set_velocidad($valor);
                } else if ($caracteristica === "tamanio") {
                    $disco->set_tamanio($valor);
                }
            }
            $discos[] = $disco;
        }
        return $discos;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
