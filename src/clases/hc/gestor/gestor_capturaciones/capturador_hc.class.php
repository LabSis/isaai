<?php

/**
 * Description of capturador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class CapturadorHc implements Capturador {

    public static function obtener_maquina($id_maquina_hc) {
        //$id_maquina_hc->cargar_valores_unicidad();
        //$id_maquina_hc->generar_condicion_unicidad_sql();
        $conexion = Conexion::get_instacia(CONEXION_HC);
        $resultados = $conexion->consultar_simple("SELECT * FROM maquinas WHERE ID = {$id_maquina_hc->get_id_hash()}");
        $maquina = new Maquina();
        //este get_id_hash fue generado previamente, en el proceso de cargadorlistaocs, por lo que aqui nunca lo genero...
        //$id_maquina_ocs->generar_id_hash();
        $maquina->set_id($id_maquina_hc->get_id_hash());
        $resultado = $resultados[0];
        //MEJORA: deberia buscar el nombre.
        $maquina->set_nombre($resultado["nombre_maquina"]);
        $maquina->set_fecha_alta($resultado["fecha_alta"]);
        //$maquina->set_fecha_cambio(null); //fecha deberia ser null, porque el insertar deberia tomar la fecha actual, se relaciona con la linea 60 del gestor_comparaciones
        $maquina->set_fecha_cambio($resultado["fecha_sincronizacion"]);
        $maquina->set_fecha_sincronizacion($resultado["fecha_sincronizacion"]);
        //el id no deberia ser null...
        //MEJORA: deberia buscar en la base de datos isaai el id del so con ese nombre y version
        $sistema_operativo = new SistemaOperativo(
                null, 
                $resultado["nombre_sistema_operativo"], 
                $resultado["version_sistema_operativo"]
                );
        $maquina->set_sistema_operativo($sistema_operativo);
        $discos = DiscoHc::materializar($id_maquina_hc);
        $maquina->set_discos($discos);
//        Out::print_array($discos);
        $memorias = MemoriaHc::materializar($id_maquina_hc);
        $maquina->set_memorias($memorias);
//        Out::print_array($memorias);
        $procesadores = ProcesadorHc::materializar($id_maquina_hc);
        $maquina->set_procesadores($procesadores);
        return $maquina;
    }

}
