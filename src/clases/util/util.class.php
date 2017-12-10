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
    
     public static function get_fecha_y_hora_actual_formato_dd_mm_aaaa() {
        return self::get_fecha_y_hora_formato_dd_mm_aaaa(time());
    }
    
    public static function get_fecha_y_hora_formato_dd_mm_aaaa($instante) {
        return date('d/m/Y H:i:s', $instante);
    }
    
    public static function get_fecha_y_hora_actual_mysql() {
        return date('Y-m-s H:i:s', time());
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
    
    /**
     * Crea un conjunto paginado de elementos, dado el mismo conjunto completo 
     * como parámetro
     * @param array $conjunto Conjunto de elementos a paginar
     * @param int $pagina_actual Página actual
     * @param int $tamanio_pagina Cantidad de elementos a mostrar por página
     * @return array Conjunto de elementos paginado, si no ha es posbile 
     * realizar la paginación, devuelve un conjunto vacío
     */
    public static function paginar($conjunto, $pagina_actual, $tamanio_pagina) {
        $resultado = array();
        for ($i = 0; $i < count($conjunto); $i++) {
            if ($i >= (($pagina_actual - 1) * $tamanio_pagina) && $i < ((($pagina_actual - 1) * $tamanio_pagina) + $tamanio_pagina)) {
                $resultado[] = $conjunto[$i];
            }
        }
        return $resultado;
    }
	
	public static function validar_nombre_usuario($nombre_usuario){
		if(strlen($nombre_usuario) < 5) return FALSE;
		//if(!preg_match("/^[a-zA-Z]+$/", $nombre_usuario)) return FALSE;	//verificar exp regular
		return true; //implementar
	}
	
	public static function validar_contrasenia($nombre_usuario){
		if(strlen($nombre_usuario) < 6) return FALSE;
		//if(!preg_match("/^[a-zA-Z]+$/", $nombre_usuario)) return FALSE;	//verificar exp regular
		return true; //implementar
	}

}
