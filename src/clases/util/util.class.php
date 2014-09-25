<?php

/**
 * Librería utilizada para hacer todo más fácil
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
class Util {
    /* Generales */

    public static function ir_inicio() {
        self::ir('http://' . $_SERVER['HTTP_HOST'] . '/isaai/index.php');
    }

    public static function ir($ruta_web) {
        header("Location: {$ruta_web}");
        exit;
    }

    public static function capitalizar_texto($texto) {
        $resultado = '';
        $texto = trim($texto);
        $partes_texto = explode(' ', $texto);
        for ($i = 0; $i < count($partes_texto); $i++) {
            $resultado .= ucfirst(strtolower($partes_texto[$i]));
            if ($i < count($partes_texto) - 1) {
                $resultado.=' ';
            }
        }
        return $resultado;
    }

    /* Manejo de fechas y horas */

    const FORMATO_FECHA_DD_MM_YYYY = 1;

    public static function get_fecha_actual_formato_dd_mm_aaaa() {
        return self::get_fecha_formato_dd_mm_aaaa(time());
    }

    public static function get_fecha_formato_dd_mm_aaaa($instante) {
        return date('d/m/Y', $instante);
    }

    public static function convertir_fecha_a_mysql($fecha, $formato = self::FORMATO_FECHA_DD_MM_YYYY) {
        $dia = "00";
        $mes = "00";
        $anio = "0000";
        switch ($formato) {
            case(self::FORMATO_FECHA_DD_MM_YYYY):
                $partes_fecha = explode('/', $fecha);
                $dia = (int) $partes_fecha[0];
                $mes = (int) $partes_fecha[1];
                $anio = (int) $partes_fecha[2];
                break;
            default :
                break;
        }
        return "{$anio}-{$mes}-{$dia}";
    }

    public static function convertir_fecha_de_mysql($fecha, $formato = self::FORMATO_FECHA_DD_MM_YYYY) {
        $dia = "00";
        $mes = "00";
        $anio = "0000";
        switch ($formato) {
            case(self::FORMATO_FECHA_DD_MM_YYYY):
                $partes_fecha = explode('-', $fecha);
                $dia = (int) $partes_fecha[2];
                $mes = (int) $partes_fecha[1];
                $anio = (int) $partes_fecha[0];
                return "{$dia}/{$mes}/{$anio}";
            default :
                break;
        }
        return "{$dia}/{$mes}/{$anio}";
    }

}
