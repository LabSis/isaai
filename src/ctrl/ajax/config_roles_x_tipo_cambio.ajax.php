<?php

require_once '../../../config.php';

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    if ($accion == 'consultar') {

        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $resultados = $conexion->consultar_simple("SELECT id, nombre, descripcion FROM roles");
        $roles = array();
        if (!empty($resultados)) {
            foreach ($resultados as $fila_resultado) {
                $roles[] = new Rol($fila_resultado['id'], $fila_resultado['nombre'], $fila_resultado['descripcion']);
            }
        }

        $resultados = $conexion->consultar_simple("SELECT id, nombre, descripcion FROM tipos_cambio");
        $tipos_cambio = array();
        if (!empty($resultados)) {
            foreach ($resultados as $fila_resultado) {
                $tipo_cambio = new TipoCambio();
                $tipo_cambio->set_id($fila_resultado['id']);
                $tipo_cambio->set_nombre($fila_resultado['nombre']);
                $tipo_cambio->set_descripcion($fila_resultado['descripcion']);
                $tipos_cambio[$fila_resultado['id']] = $tipo_cambio;
            }
        }

        $resultados = $conexion->consultar_simple("SELECT id_rol, id_tipo_cambio, permiso FROM roles_x_tipo_cambio");

        $salida = "[";

        foreach ($roles as $rol) {
            $salida .= '{' . PHP_EOL;
            $salida .= '"id" : "' . $rol->get_id() . '",' . PHP_EOL;
            $salida .= '"nombre" : "' . $rol->get_nombre() . '",' . PHP_EOL;
            $salida .= '"descripcion" : "' . $rol->get_descripcion() . '",' . PHP_EOL;
            $salida .= '"tipos_cambio" : [';
            foreach ($resultados as $rol_x_tipo_cambio) {
                if ($rol_x_tipo_cambio['id_rol'] == $rol->get_id()) {
                    $tipo_cambio = $tipos_cambio[$rol_x_tipo_cambio['id_tipo_cambio']];
                    $salida .= '{' . PHP_EOL;
                    $salida .= '"id" : "' . $tipo_cambio->get_id() . '",' . PHP_EOL;
                    $salida .= '"nombre" : "' . $tipo_cambio->get_nombre() . '",' . PHP_EOL;
                    $salida .= '"descripcion" : "' . $tipo_cambio->get_descripcion() . '",' . PHP_EOL;
                    $salida .= '"permiso" : "' . $rol_x_tipo_cambio['permiso'] . '"' . PHP_EOL;
                    $salida .= '},';
                }
            }
            $salida = rtrim($salida, ',');
            $salida .= ']' . PHP_EOL;
            $salida .= '},';
        }
        $salida = rtrim($salida, ',');
        $salida .= ']';

        echo $salida;
    } else if ($accion == 'actualizar') {
        if (isset($_POST['datos'])) {
            $datos = $_POST['datos'];
            
            $json = json_decode($datos, true);
            echo Out::print_array($json);

            $conexion = Conexion::get_instacia(CONEXION_ISAAI);
            $conexion->transaccion_comenzar();

            $ok = true;

            foreach ($json as $rol) {
                $id_rol = $rol['id'];
                foreach ($rol['tipos_cambio'] as $tipo_cambio) {
                    $actualizacion = "UPDATE roles_x_tipo_cambio "
                            . "SET permiso = '" . $tipo_cambio['permiso'] . "' "
                            . "WHERE id_rol = {$id_rol} AND id_tipo_cambio = {$tipo_cambio['id']};";
                            echo Out::println($actualizacion);
                    $ok &= $conexion->actualizar_simple($actualizacion);
                }
            }
            echo $conexion->transaccion_terminar($ok);
        }
    }
}