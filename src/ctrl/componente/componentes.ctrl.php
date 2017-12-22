<?php

require_once '../../../config.php';

$template_componentes = array();

/*$template_slc_componentes = array(
    "1" => "Bios",
    "2" => "Disco",
    "3" => "Memoria",
    "4" => "Monitor",
    "5" => "Periférico",
    "6" => "Placa de red",
    "7" => "Placa de sonido",
    "8" => "Placa de video",
    "9" => "Procesador"
);*/
$template_slc_componentes = array(
    "2" => "Disco",
    "3" => "Memoria",
    "9" => "Procesador"
);

$tipo_componente = "";
$nombre_tempate_componente = "";
if (isset($_POST['slcTipoComponente'])) {
    $tipo_componente = $_POST['slcTipoComponente'];
    $conexion = Conexion::get_instacia(CONEXION_ISAAI);
    switch ($tipo_componente) {
        case("1"):
            //Bios
            $nombre_tempate_componente = "bios";
            $tamplate_nombres_columnas = array("Máquina", "ID", "Nombre", "Fabricante", "Modelo", "Version", "Número de serie");
            $consulta = "SELECT b.id, m.nombre as nombre_maquina, b.id_maquina, b.nombre, b.fabricante, b.modelo, b.asset_tag, b.version, b.numero_serial "
                    . "FROM bios b "
                    . "INNER JOIN maquinas m "
                    . "ON b.id_maquina = m.id "
                    . "ORDER BY b.id";
            $resultados = $conexion->consultar_simple($consulta);
            foreach ($resultados as $componente) {
                $template_componentes[] = array(
                    $componente['nombre_maquina'],
                    $componente['id'],
                    $componente['nombre'],
                    $componente['fabricante'],
                    $componente['modelo'],
                    $componente['version'],
                    $componente['numero_serial']
                );
            }
            break;
        case("2"):
            //Disco
            $nombre_tempate_componente = "disco";
            $tamplate_nombres_columnas = array("Máquina", "ID", "Nombre", "Fabricante", "Modelo", "Descripción", "Tipo", "Firmware", "Tamaño", "Número de serie");
            $consulta = "SELECT d.id, maquina.nombre AS nombre_maquina, d.nombre, d.fabricante, d.modelo, d.descripcion, "
                    . "d.tipo, d.firmware, d.tamanio, d.numero_serial FROM discos AS d "
                    . "INNER JOIN maquinas AS maquina ON "
                    . "d.id_maquina = maquina.id "
                    . "ORDER BY d.id";
            $resultados = $conexion->consultar_simple($consulta);
            foreach ($resultados as $componente) {
                $template_componentes[] = array(
                    $componente['nombre_maquina'],
                    $componente['id'],
                    $componente['nombre'],
                    $componente['fabricante'],
                    $componente['modelo'],
                    $componente['descripcion'],
                    $componente['tipo'],
                    $componente['firmware'],
                    $componente['tamanio'],
                    $componente['numero_serial']
                );
            }
            break;
        case("3"):
            //Memoria
            $nombre_tempate_componente = "memoria";
            $tamplate_nombres_columnas = array("Máquina", "ID", "Nombre", "Descripción", "Capacidad", "Velocidad", "Número de ranura", "Número de serie");
            $consulta = "SELECT maquina.nombre AS nombre_maquina, m.id, m.capacidad, m.tipo, m.descripcion, m.numero_serial, "
                    . "m.numero_ranura, m.velocidad, m.nombre FROM memorias AS m "
                    . "INNER JOIN maquinas AS maquina ON "
                    . "m.id_maquina = maquina.id "
                    . "ORDER BY m.id";
            $resultados = $conexion->consultar_simple($consulta);
            foreach ($resultados as $componente) {
                $template_componentes[] = array(
                    $componente['nombre_maquina'],
                    $componente['id'],
                    $componente['nombre'],
                    $componente['descripcion'],
                    $componente['capacidad'],
                    $componente['velocidad'],
                    $componente['numero_ranura'],
                    $componente['numero_serial'],
                );
            }
            break;
        case("4"):
            //Monitor
            $nombre_tempate_componente = "monitor";
            $tamplate_nombres_columnas = array("Máquina", "ID", "Nombre", "Modelo", "Resolución");
            $consulta = "SELECT maquina.nombre AS nombre_maquina, m.id, m.nombre, m.modelo, m.resolucion "
                    . "FROM monitores AS m "
                    . "INNER JOIN maquinas AS maquina ON "
                    . "m.id_maquina = maquina.id "
                    . "ORDER BY m.id";
            $resultados = $conexion->consultar_simple($consulta);
            foreach ($resultados as $componente) {
                $template_componentes[] = array(
                    $componente['nombre_maquina'],
                    $componente['id'],
                    $componente['nombre'],
                    $componente['modelo'],
                    $componente['resolucion']
                );
            }
            break;
        case("5"):
            //Periferico
            $nombre_tempate_componente = "periferico";
            $tamplate_nombres_columnas = array("Máquina", "ID", "Nombre", "Fabricante", "Tipo", "Descripción", "Interfaz");
            $consulta = "SELECT maquina.nombre AS nombre_maquina, p.id, p.nombre, p.fabricante, p.tipo, "
                    . "p.descripcion, p.interfaz FROM perifericos AS p "
                    . "INNER JOIN maquinas AS maquina ON "
                    . "p.id_maquina = maquina.id "
                    . "ORDER BY p.id";
            $resultados = $conexion->consultar_simple($consulta);
            foreach ($resultados as $componente) {
                $template_componentes[] = array(
                    $componente['nombre_maquina'],
                    $componente['id'],
                    $componente['nombre'],
                    $componente['fabricante'],
                    $componente['tipo'],
                    $componente['descripcion'],
                    $componente['interfaz']
                );
            }
            break;
        case("6"):
            //Placa de red
            $nombre_tempate_componente = "placa de red";
            $tamplate_nombres_columnas = array("Máquina", "ID", "Dirección IP", "Dirección MAC", "Dirección de red", "Dirección DNS", "Máscara", "Gateway", "Descripción", "Tipo", "Velocidad");
            $consulta = "SELECT maquina.nombre AS nombre_maquina, pr.id, pr.direccion_ip, pr.direccion_mac, pr.direccion_red, pr.direccion_dns, "
                    . "pr.mascara, pr.gateway, pr.descripcion, pr.tipo, pr.velocidad "
                    . "FROM placas_red AS pr "
                    . "INNER JOIN maquinas AS maquina ON "
                    . "pr.id_maquina = maquina.id "
                    . "ORDER BY pr.id";
            $resultados = $conexion->consultar_simple($consulta);
            foreach ($resultados as $componente) {
                $template_componentes[] = array(
                    $componente['nombre_maquina'],
                    $componente['id'],
                    $componente['direccion_ip'],
                    $componente['direccion_mac'],
                    $componente['direccion_red'],
                    $componente['direccion_dns'],
                    $componente['mascara'],
                    $componente['gateway'],
                    $componente['descripcion'],
                    $componente['tipo'],
                    $componente['velocidad']
                );
            }
            break;
        case("7"):
            //Placa de sonido
            $nombre_tempate_componente = "placa de sonido";
            $tamplate_nombres_columnas = array("Máquina", "ID", "Nombre", "Fabricante");
            $consulta = "SELECT maquina.nombre AS nombre_maquina, ps.id, ps.nombre, ps.fabricante "
                    . "FROM placas_sonido AS ps "
                    . "INNER JOIN maquinas AS maquina ON "
                    . "ps.id_maquina = maquina.id "
                    . "ORDER BY ps.id";
            $resultados = $conexion->consultar_simple($consulta);
            foreach ($resultados as $componente) {
                $template_componentes[] = array(
                    $componente['nombre_maquina'],
                    $componente['id'],
                    $componente['nombre'],
                    $componente['fabricante']
                );
            }
            break;
        case("8"):
            //Placa de video
            $nombre_tempate_componente = "placa de video";
            $tamplate_nombres_columnas = array("Máquina", "ID", "Nombre", "Memoria", "Chipset");
            $consulta = "SELECT maquina.nombre AS nombre_maquina, pv.id, pv.nombre, pv.memoria, pv.chipset "
                    . "FROM placas_video AS pv "
                    . "INNER JOIN maquinas AS maquina ON "
                    . "pv.id_maquina = maquina.id "
                    . "ORDER BY pv.id";
            $resultados = $conexion->consultar_simple($consulta);
            foreach ($resultados as $componente) {
                $template_componentes[] = array(
                    $componente['nombre_maquina'],
                    $componente['id'],
                    $componente['nombre'],
                    $componente['memoria'],
                    $componente['chipset']
                );
            }
            break;
        case("9"):
            //Procesador
            $nombre_tempate_componente = "procesador";
            $tamplate_nombres_columnas = array("Máquina", "ID", "Tipo", "Velocidad", "Núcleos");
            $consulta = "SELECT maquina.nombre AS nombre_maquina, p.id, p.tipo, p.velocidad, p.nucleos "
                    . "FROM procesadores AS p "
                    . "INNER JOIN maquinas AS maquina ON "
                    . "p.id_maquina = maquina.id "
                    . "ORDER BY p.id";
            $resultados = $conexion->consultar_simple($consulta);
            foreach ($resultados as $componente) {
                $template_componentes[] = array(
                    $componente['nombre_maquina'],
                    $componente['id'],
                    $componente['tipo'],
                    $componente['velocidad'],
                    $componente['nucleos']
                );
            }
            break;
    }
}



require_once $global_ruta_servidor . '/tmpl/componente/componentes.tmpl.php';
