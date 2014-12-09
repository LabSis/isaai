<?php

require_once '../../../config.php';
/*
  if (isset($_GET['id']) && isset($_GET['fecha_cambio'])) {
  $id_maquina = $_GET['id'];
  $fecha_cambio = $_GET['fecha_cambio'];
  $id_maquina_isaai = new IdMaquinaIsaai($id_maquina, $fecha_cambio);
  $capturador_isaai = new CapturadorIsaai();
  $maquina = $capturador_isaai->obtener_maquina($id_maquina_isaai);

  $template_componentes = array();
  $bios = $maquina->get_bios();
  $template_componentes['Bios'][] = array(
  "Nombre" => $bios->get_nombre(),
  "Fabricante" => $bios->get_fabricante(),
  "Modelo" => $bios->get_modelo(),
  "Asset tag" => $bios->get_asset_tag(),
  "Versión" => $bios->get_version(),
  "Número serie" => $bios->get_numero_serial()
  );
  $discos = $maquina->get_discos();
  foreach ($discos as $disco) {
  $template_componentes['Disco'][] = array(
  "Nombre" => $disco->get_nombre(),
  "Fabricante" => $disco->get_fabricante(),
  "Modelo" => $disco->get_modelo(),
  "Descripción" => $disco->get_descripcion(),
  "Tipo" => $disco->get_tipo(),
  "Tamaño" => $disco->get_tamanio(),
  "Firmware" => $disco->get_firmware(),
  "Número serie" => $disco->get_numero_serial()
  );
  }
  $memorias = $maquina->get_memorias();
  foreach ($memorias as $componente) {
  $template_componentes['Memoria'][] = array(
  "Nombre" => $componente->get_nombre(),
  "Tipo" => $componente->get_tipo(),
  "Capacidad" => $componente->get_capacidad(),
  "Descripción" => $componente->get_descripcion(),
  "Número serie" => $componente->get_numero_serial(),
  "Velocidad" => $componente->get_velocidad(),
  "Número ranura" => $componente->get_numero_ranura()
  );
  }
  $perifericos = $maquina->get_perifericos();
  foreach ($perifericos as $componente) {
  $template_componentes['Periférico'][] = array(
  "Nombre" => $componente->get_nombre(),
  "Tipo" => $componente->get_tipo(),
  "Fabricante" => $componente->get_fabricante(),
  "Descripción" => $componente->get_descripcion(),
  "Interfaz" => $componente->get_interfaz()
  );
  }
  $placas_red = $maquina->get_placas_red();
  foreach ($placas_red as $componente) {
  $template_componentes['Placa de red'][] = array(
  "Dirección IP" => $componente->get_direccion_ip(),
  "Dirección MAC" => $componente->get_direccion_mac(),
  "Dirección de red" => $componente->get_direccion_red(),
  "Dirección DNS" => $componente->get_direccion_dns(),
  "Mascara" => $componente->get_mascara(),
  "Gateway" => $componente->get_gateway(),
  "Descripción" => $componente->get_descripcion(),
  "Tipo" => $componente->get_tipo(),
  "Velocidad" => $componente->get_velocidad()
  );
  }
  $placas_sonido = $maquina->get_placas_sonido();
  foreach ($placas_sonido as $componente) {
  $template_componentes['Placa de sonido'][] = array(
  "Nombre" => $componente->get_nombre(),
  "Fabricante" => $componente->get_fabricante()
  );
  }
  $placas_video = $maquina->get_placas_video();
  foreach ($placas_video as $componente) {
  $template_componentes['Placa de video'][] = array(
  "Nombre" => $componente->get_nombre(),
  "Memoria" => $componente->get_memoria(),
  "Chipset" => $componente->get_chipset()
  );
  }
  $procesadores = $maquina->get_procesadores();
  foreach ($procesadores as $componente) {
  $template_componentes['Procesador'][] = array(
  "Número" => $componente->get_numero(),
  "Velocidad" => $componente->get_velocidad(),
  "Tipo" => $componente->get_tipo()
  );
  }
  //ultimos cambios
  $tempalte_ultimos_cambios = [];
  $consulta = "";
  } */

$id_maquina = $_GET['id'];
$fecha_cambio = $_GET['fecha_cambio'];

$conexion = Conexion::get_instacia(CONEXION_ISAAI);
$consulta = "SELECT fecha_cambio, id FROM maquinas WHERE id = '{$id_maquina}' "
        . "ORDER BY fecha_cambio DESC";
$resultados = $conexion->consultar_simple($consulta);

$estados = [];
foreach ($resultados as $resultado) {

    $fecha_cambio = $resultado['fecha_cambio'];
    $id_maquina_isaai = new IdMaquinaIsaai($id_maquina, $fecha_cambio);
    $capturador_isaai = new CapturadorIsaai();
    $maquina = $capturador_isaai->obtener_maquina($id_maquina_isaai);

    $template_componentes = array();
    $bios = $maquina->get_bios();
    $template_componentes['Bios'][] = array(
        "Nombre" => $bios->get_nombre(),
        "Fabricante" => $bios->get_fabricante(),
        "Modelo" => $bios->get_modelo(),
        "Asset tag" => $bios->get_asset_tag(),
        "Versión" => $bios->get_version(),
        "Número serie" => $bios->get_numero_serial()
    );
    $discos = $maquina->get_discos();
    foreach ($discos as $disco) {
        $template_componentes['Disco'][] = array(
            "Nombre" => $disco->get_nombre(),
            "Fabricante" => $disco->get_fabricante(),
            "Modelo" => $disco->get_modelo(),
            "Descripción" => $disco->get_descripcion(),
            "Tipo" => $disco->get_tipo(),
            "Tamaño" => $disco->get_tamanio(),
            "Firmware" => $disco->get_firmware(),
            "Número serie" => $disco->get_numero_serial()
        );
    }
    $memorias = $maquina->get_memorias();
    foreach ($memorias as $componente) {
        $template_componentes['Memoria'][] = array(
            "Nombre" => $componente->get_nombre(),
            "Tipo" => $componente->get_tipo(),
            "Capacidad" => $componente->get_capacidad(),
            "Descripción" => $componente->get_descripcion(),
            "Número serie" => $componente->get_numero_serial(),
            "Velocidad" => $componente->get_velocidad(),
            "Número ranura" => $componente->get_numero_ranura()
        );
    }
    $perifericos = $maquina->get_perifericos();
    foreach ($perifericos as $componente) {
        $template_componentes['Periférico'][] = array(
            "Nombre" => $componente->get_nombre(),
            "Tipo" => $componente->get_tipo(),
            "Fabricante" => $componente->get_fabricante(),
            "Descripción" => $componente->get_descripcion(),
            "Interfaz" => $componente->get_interfaz()
        );
    }
    $placas_red = $maquina->get_placas_red();
    foreach ($placas_red as $componente) {
        $template_componentes['Placa de red'][] = array(
            "Dirección IP" => $componente->get_direccion_ip(),
            "Dirección MAC" => $componente->get_direccion_mac(),
            "Dirección de red" => $componente->get_direccion_red(),
            "Dirección DNS" => $componente->get_direccion_dns(),
            "Mascara" => $componente->get_mascara(),
            "Gateway" => $componente->get_gateway(),
            "Descripción" => $componente->get_descripcion(),
            "Tipo" => $componente->get_tipo(),
            "Velocidad" => $componente->get_velocidad()
        );
    }
    $placas_sonido = $maquina->get_placas_sonido();
    foreach ($placas_sonido as $componente) {
        $template_componentes['Placa de sonido'][] = array(
            "Nombre" => $componente->get_nombre(),
            "Fabricante" => $componente->get_fabricante()
        );
    }
    $placas_video = $maquina->get_placas_video();
    foreach ($placas_video as $componente) {
        $template_componentes['Placa de video'][] = array(
            "Nombre" => $componente->get_nombre(),
            "Memoria" => $componente->get_memoria(),
            "Chipset" => $componente->get_chipset()
        );
    }
    $procesadores = $maquina->get_procesadores();
    foreach ($procesadores as $componente) {
        $template_componentes['Procesador'][] = array(
            "Número" => $componente->get_numero(),
            "Velocidad" => $componente->get_velocidad(),
            "Tipo" => $componente->get_tipo()
        );
    }
    $estados[$fecha_cambio] = $template_componentes;
}

require_once $global_ruta_servidor . '/tmpl/maquina/maquina_detalles.tmpl.php';
