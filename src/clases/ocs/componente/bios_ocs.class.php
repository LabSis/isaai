<?php

/**
 * Esta clase materializará un registro de la tabla "bios" desde ocsweb en un 
 * objeto bios
 *
 * @author Milagros Zea
 * @version 1.0
 */
class BiosOcs implements ComponenteMaterializable {

    public static function materializar($id_maquina) {
        $conexion = Conexion::get_instacia(CONEXION_OCS);
        $condicion = $id_maquina->get_condicion_unicidad_sql();
        $consulta = "SELECT smanufacturer, bmanufacturer, smodel, assettag,"
                . " bversion, ssn FROM bios AS b INNER JOIN hardware AS hardware ON "
                . " b.hardware_id = hardware.id WHERE {$condicion}";
        $resultado = $conexion->consultar_simple($consulta);
        Out::println("Consyutla de materialziar OCS bios: ".$consulta);
        //cargo el objeto bios...
        $bios = new Bios();
        $bios->set_id(null);
        $bios->set_nombre($resultado[0]['smanufacturer']);
        $bios->set_fabricante($resultado[0]['bmanufacturer']);
        $bios->set_modelo($resultado[0]['smodel']);
        $bios->set_asset_tag($resultado[0]['assettag']);
        $bios->set_version($resultado[0]['bversion']);
        $bios->set_numero_serial($resultado[0]['ssn']);
        return $bios;
    }

    public static function desmaterializar($maquina, $componene) {
    }

    /**
     * Este consulta buscará a una máquina (que ya existe en la bs de isaai) 
     * según el nombre, el sistema operativo y la version del sistema operativo.
     * @param type $_nombre_maquina
     * @param type $_sistema_operativo
     * @param type $_version_sistema_operativo
     * @return type
     */
//    private static function obtener_consulta($_nombre_maquina, $_sistema_operativo, $_version_sistema_operativo) {
//        $consulta = 'SELECT h.id, smanufacturer, bmanufacturer, smodel, assettag,'
//                . ' bversion, ssn  FROM bios AS b INNER JOIN hardware AS h ON '
//                . ' b.hardware_id = h.id WHERE h.name ="'
//                . $_nombre_maquina . '" AND h.osname= "' . $_sistema_operativo
//                . '" AND h.osversion= "' . $_version_sistema_operativo
//                . '" AND h.lastcome = '
//                . '(SELECT MAX(hardware.lastcome) '
//                . 'FROM hardware WHERE hardware.id = h.id)';
//        echo "<br/>$consulta";
//        return $consulta;
//    }
}
