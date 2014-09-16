<?php

/**
 * Representa la logica de aseguramiento de unicidad de una maquina en la base 
 * de datos.
 * Posee todos los atrbituso necesarios para poder identificar de manera 
 * unívoca a una máquina en un sistema.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
abstract class IdMaquina {

    public abstract function get_condicion_unicidad_sql();

    public abstract function get_id_hash();
}
