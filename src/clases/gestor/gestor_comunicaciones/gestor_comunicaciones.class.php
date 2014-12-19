<?php

/**
 *
 * @author Parisi Germán
 * @version 1.0
 */
class GestorComunicaciones {

    /**
     * Genera una alerta. Usa todos los alertadores pasados como parámetro.
     * 
     * @param array de \Cambio $lista_cambios Es una lista de cambios.
     * @param array de \Alertador Es un alertador.
     */
    public function alertar($lista_cambios, $alertadores) {
        $mensajes_x_cambios = array();
        for ($i = 0; $i < count($lista_cambios); $i++) {
            //array tipo de cambios
            $mensaje = new MensajeCambio();
            $tipos_cambios = $this->determinar_tipo_cambio($lista_cambios[$i]);
            //deberia agregar por cada tipo de cambio mas de un rol
            $tipos_cambio_x_rol = array();
            foreach ($tipos_cambios as $tipo_cambio) {
                $roles_x_tipo_cambio = $this->determinar_roles_mensaje($tipo_cambio);
                foreach ($roles_x_tipo_cambio as $rol_actual) {
                    //indice del array por nombre de rol, seria mejor por ID de rol.
                    $tipos_cambio_x_rol[$rol_actual->get_id()][] = $tipo_cambio;
                }
            }
            //$tipos_cambio_x_rol es un array cuyos indices son los id de roles
            //y cuyo valor para cada indice rol e sun array de tipos de cambio 
            //que sucedieron que registro el cambio actual
            $mensaje->set_cambio($lista_cambios[$i]);
            $mensaje->set_rol_x_tipos_cambio($tipos_cambio_x_rol);
            $mensajes_x_cambios[] = $mensaje;
        }

        $mensajes_x_usuarios = array();
        foreach ($mensajes_x_cambios as $mensajes_x_cambio_actual) {
            $tipos_cambio_x_roles = $mensajes_x_cambio_actual->get_rol_x_tipos_cambio();
            foreach ($tipos_cambio_x_roles as $tipos_cambio_x_rol) {
                $id_rol_actual = array_search($tipos_cambio_x_rol, $tipos_cambio_x_roles);
                $usuarios_notificar = $this->determinar_usuarios_a_enviar($id_rol_actual);
                //recorre mensajes_x_cambios y armar el array que contendra a los objetos mensaje_usuario
                foreach ($usuarios_notificar as $usuario_actual) {
                    if (!array_key_exists($usuario_actual->get_nombre_usuario(), $mensajes_x_usuarios)) {
                        $mensajes_x_usuario = new MensajeUsuario();
                        $mensajes_x_usuario->set_usuario($usuario_actual);
                        $mensajes_x_usuario->add_tipos_cambio_x_cambio($tipos_cambio_x_rol, $mensajes_x_cambio_actual->get_cambio());
                        $mensajes_x_usuarios[$usuario_actual->get_nombre_usuario()] = $mensajes_x_usuario;
                    } else {
                        $mensajes_x_usuario = $mensajes_x_usuarios[$usuario_actual->get_nombre_usuario()];
                        $mensajes_x_usuario->add_tipos_cambio_x_cambio($tipos_cambio_x_rol, $mensajes_x_cambio_actual->get_cambio());
                        $mensajes_x_usuarios[$usuario_actual->get_nombre_usuario()] = $mensajes_x_usuario;
                    }
                }
            }            
        }
        echo 'Mensajes por usuario';
        Out::print_array($mensajes_x_usuarios);
        foreach ($alertadores as $alertador) {
            $alertador->alertar($mensajes_x_usuarios);
        }
    }

    /**
     * Retorna un tipo de cambio a partir de un cambio.
     * @param \Cambio $cambio
     * @return \TipoCambio
     */
    public function determinar_tipo_cambio($cambio) {
        //Suponemos que lo que haces es identificar los compoenntes que cambiaron,
        //en base a eso y a consutlar la tabla tipos_cambios, saber que instancia
        //de tipo de cambio devolver?
        return TipoCambio::determinar_tipo_cambio($cambio);
    }

    /**
     * Retorna una lista de roles a partir de un tipo de cambio.
     * @param \TipoCambio $tipo_cambio
     * @return Array de \Rol
     */
    public function determinar_roles_mensaje($tipo_cambio) {
        return Rol::determinar_roles_mensaje($tipo_cambio);
    }

    public function determinar_usuarios_a_enviar($id_rol) {
        return Usuario::determinar_usuarios_a_enviar($id_rol);
    }

}
