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
//        $conexion = Conexion::get_instacia(CONEXION_HC);
//        $condicion = $id_maquina->get_condicion_unicidad_sql();
//        $consulta = "SELECT cxm.id_componente "
//                . "FROM componentes_x_maquinas AS cxm INNER JOIN maquinas AS m ON cxm.id_maquina = m.id "
//                . "WHERE {$condicion} AND cxm.nombre = 'memorias_ram'";
//        $resultados = $conexion->consultar_simple($consulta);
//        $memorias = array();
//        
////                componente: "memorias_ram",
////                datos: [
////                    {
////                        banco: "",
////                        tecnolgia: "EPROM, VRAM",
////                        fabricante: "",
////                        numero_serie: "",
////                        tamanio_bus_datos: "bits",
////                        velocidad: "en MHz",
////                        tamanio: "en B"
////                    }]
////            }
//        for ($i = 0; $i < count($resultados); $i++) {
//            $memoria = new Memoria();
//            $memoria->set_id(null);
//            $memoria->set_capacidad($resultados[$i]['capacity']);
//            $memoria->set_descripcion($resultados[$i]['description']);
//            $memoria->set_nombre($resultados[$i]['caption']);
//            $memoria->set_numero_ranura($resultados[$i]['numslots']);
//            $memoria->set_numero_serial($resultados[$i]['serialnumber']);
//            $memoria->set_tipo($resultados[$i]['type']);
//            $memorias[] = $memoria;
//        }
        $memorias = array();
        return $memorias;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
