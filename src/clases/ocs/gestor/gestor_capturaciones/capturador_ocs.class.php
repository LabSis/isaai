<?php

/**
 * Description of capturador_ocs
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class CapturadorOcs implements Capturador {

    public static function obtener_maquina($id_maquina_ocs) {
        $id_maquina_ocs->cargar_valores_unicidad();
        $id_maquina_ocs->generar_condicion_unicidad_sql();

        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $resultados = $conexion->consultar_simple("SELECT * FROM hardware WHERE ID = {$id_maquina_ocs->get_id_maquina_ocs()}");

        $maquina = new Maquina();
        //este get_id_hash fue generado previamente, en el proceso de cargadorlistaocs, por lo que aqui nunca lo genero...
        //$id_maquina_ocs->generar_id_hash();
        $maquina->set_id($id_maquina_ocs->get_id_hash());
        $maquina->set_nombre($resultados[0]["NAME"]);
        //La fecha de alta del OCS forma parte del atributo DEVIDEID de la tabla hardware
        $devideid = $resultados[0]["DEVICEID"];
        $partes_devide_id = explode("-", $devideid);
        $longitud_partes_devide_id = count($partes_devide_id) - 1;
        //formato dd/mm/aaaa es que esta a continuacion
        //$fecha_alta = $partes_devide_id[$longitud_partes_devide_id - 3] . '/' . $partes_devide_id[$longitud_partes_devide_id - 4] . '/' . $partes_devide_id[$longitud_partes_devide_id - 5];
        $fecha_y_hora_alta = $partes_devide_id[$longitud_partes_devide_id - 5] . '-' . $partes_devide_id[$longitud_partes_devide_id - 4] . '-' . $partes_devide_id[$longitud_partes_devide_id - 3];
        $fecha_y_hora_alta .= ' ' . $partes_devide_id[$longitud_partes_devide_id - 2] . ':' . $partes_devide_id[$longitud_partes_devide_id - 1] . ':' . $partes_devide_id[$longitud_partes_devide_id - 0];
        //el format que esta $fecha_y_hora_alta es aaaa-mm-dd hh:mm:ss
        $maquina->set_fecha_alta($fecha_y_hora_alta);
        $maquina->set_fecha_cambio($resultados[0]["LASTCOME"]); //fecha deberia ser null, porque el insertar deberia tomar la fecha actual
        $maquina->set_fecha_sincronizacion($resultados[0]["LASTCOME"]);

        //el id no deberia ser null...
        //deberia buscar en la base de datos isaai el id del so con ese nombre y version
        $sistema_operativo = new SistemaOperativo(null, $resultados[0]["OSNAME"], $resultados[0]["OSVERSION"]);
        $maquina->set_sistema_operativo($sistema_operativo);

        $bios = BiosOcs::materializar($id_maquina_ocs);
        $maquina->set_bios($bios);

        $discos = DiscoOcs::materializar($id_maquina_ocs);
        $maquina->set_discos($discos);

        $memorias = MemoriaOcs::materializar($id_maquina_ocs);
        $maquina->set_memorias($memorias);

        $monitores = MonitorOcs::materializar($id_maquina_ocs);
        $maquina->set_monitores($monitores);

        $perifericos = PerifericoOcs::materializar($id_maquina_ocs);
        $maquina->set_perifericos($perifericos);

        $placas_red = PlacaRedOcs::materializar($id_maquina_ocs);
        $maquina->set_placas_red($placas_red);

        $placas_sonido = PlacaSonidoOcs::materializar($id_maquina_ocs);
        $maquina->set_placas_sonido($placas_sonido);

        $placas_video = PlacaVideoOcs::materializar($id_maquina_ocs);
        $maquina->set_placas_video($placas_video);

        $procesadores = ProcesadorOcs::materializar($id_maquina_ocs);
        $maquina->set_procesadores($procesadores);

        return $maquina;
    }

}
