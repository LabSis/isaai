<?php

/**
 * Esta clase materializará un registro de la tabla "sounds" desde ocsweb en un
 * objeto Placa de Sonido.
 *
 * @author Milagros Zea
 */
class PlacaSonidoOcs implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT s.manufacturer, s.name, s.description"
                . " FROM sounds AS s INNER JOIN hardware AS hardware ON "
                . " s.hardware_id = hardware.id WHERE {$condicion}";
        $resultados = $conexion->consultar_simple($consulta);
        $placas_sonido = array();
        for ($i = 0; $i < count($resultados); $i++) {
            $placa_sonido = new PlacaSonido();
            $placa_sonido->set_id(null);
            $placa_sonido->set_nombre($resultados[$i]['name']);
            $placa_sonido->set_fabricante($resultados[$i]['manufacturer']);
            $placas_sonido[] = $placa_sonido;
        }
        return $placas_sonido;
    }

    public static function desmaterializar($maquina, $componene) {
        
    }

}
