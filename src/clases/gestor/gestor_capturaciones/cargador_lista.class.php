<?php

/**
 * Interfaz usada para obtener una lista de conjuntos (id, fecha) por cada máquina.
 *
 * @author Diego Barrionuevo
 * @version 1.0
 */
interface CargadorLista {
    
    public function cargar_lista($excluidos);
}
