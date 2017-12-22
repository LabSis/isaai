<?php

/**
 * Clase singleton que representa la sesión actual del usuario activo. Se 
 * encarga de acceder de manera controlada a la variable $_SESSION. 
 * Específicamente recuerda:
 * * El usuario que inició sesión.
 * * Los mensajes cargados para existir entre webs diferentes.
 * * La web de la cual proviene.
 *
 * @author Diego Barrionuevo
 * @version 1.1
 */
class Sesion {

    const TIPO_MENSAJE_INFORMACION = 'info';
    const TIPO_MENSAJE_EXITO = 'exito';
    const TIPO_MENSAJE_ALERTA = 'alerta';
    const TIPO_MENSAJE_ERROR = 'error';

    private static $_instancia;
    private $_usuario;
    private $_mensajes;
    private $_ultima_web;

    private function __construct() {
        $this->_usuario = null;
        $this->_mensajes = array(
            self::TIPO_MENSAJE_INFORMACION => array(),
            self::TIPO_MENSAJE_EXITO => array(),
            self::TIPO_MENSAJE_ALERTA => array(),
            self::TIPO_MENSAJE_ERROR => array()
        );
        $this->_ultima_web = null;
    }

    public static function get_instancia() {
        if (is_null(self::$_instancia)) {
            self::$_instancia = new Sesion();
        }
        return self::$_instancia;
    }

    /**
     * Inicia la sesión del usuario, para esto necesita que le pasen como 
     * parámetros el nombre de usuario y su clave, entonces buscar si exsite 
     * algún usuario con ese nombre de usuario y clave en la base de datos y 
     * lsi lo encuentra lo inicializa con todos sus datos y lo setea como parte 
     * de la sesión. Si no encuentra ningún usuario, devuelve false y no setea 
     * el usuario en la sesión.
     * 
     * NOTA:
     * 
     * El nombre de usuario puede ser tanto el nombre de usuario propiamente 
     * dicho, como la dirección del correo.
     * 
     * @param string $nombre_usuario Nombre de usuario o email del mismo.
     * @param string $clave_usuario Clave del usuario. Sin encriptar por ahora.
     * @return boolean True, si encontró y pudo setear los datos del usuario. 
     * False, en case contrario.
     */
    public function iniciar_sesion($nombre_usuario, $clave_usuario) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT id, nombre_usuario, clave_usuario, id_rol, nombre, apellido, email, telefono, direccion, fecha_alta, fecha_baja "
                . "FROM usuarios "
                . "WHERE ( nombre_usuario = '{$nombre_usuario}' OR email = '{$nombre_usuario}' ) "
                . "AND clave_usuario = MD5('{$clave_usuario}')";
        $resultado = $conexion->consultar_simple($consulta);
        if (!empty($resultado)) {
            $usuario = new Usuario();
            $usuario->set_id($resultado[0]['id']);
            $usuario->set_nombre_usuario($resultado[0]['nombre_usuario']);
            $usuario->set_clave_usuario($resultado[0]['clave_usuario']);
            $usuario->set_rol(Rol::materializar($resultado[0]['id_rol']));
            $usuario->set_nombre($resultado[0]['nombre']);
            $usuario->set_apellido($resultado[0]['apellido']);
            $usuario->set_email($resultado[0]['email']);
            $usuario->set_telefono($resultado[0]['telefono']);
            $usuario->set_direccion($resultado[0]['direccion']);
            $usuario->set_fecha_alta($resultado[0]['fecha_alta']);
            $usuario->set_fecha_baja($resultado[0]['fecha_baja']);
            $this->set_usuario($usuario);
            return true;
        }
        return false;
    }

    /**
     * Actualiza el usuario en la sesión, es decir vuelve a buscar los datos 
     * del usuario actualmente ingresado, y resetea todos sus datos, así la 
     * sesión tiene los datos fieles y reales del usuario al instante. Esto 
     * puede ser útil si el usuario agrega o modifica sus datos.
     * @return boolean True, si tuvo éxito al actualizar los datos del usuario. 
     * False en caso contrario.
     */
    public function actualizar() {
        if ($this->activo()) {
            $usuario_actualizado = Usuario::materializar($this->_usuario->get_id());
            if (!is_null($usuario_actualizado)) {
                $this->set_usuario($usuario_actualizado);
                return true;
            }
        }
        return false;
    }

    /**
     * Verifica que el usuario en la sesión actual de verdad exista, es decir 
     * verifica si hay un usuario ingresado o si caducó la sesión. Setea como 
     * parte de sus atributos el usuario actual (algo similar a lo que sucede 
     * al iniciar la sesión del usuario). Es muy útil para verificar en cada 
     * página si es usuario ha ingresado como tal o no.
     * @return boolean True, si el usuario sí ha ingresado y su sesión aún no 
     * caducó. False, en caso contrario.
     */
    public function activo() {
        if (isset($_SESSION['usuario'])) {
            $this->_usuario = $_SESSION['usuario'];
            return true;
        }
        return false;
    }

    /**
     * Setea como miembro de sí, la instancia del usuario pasada como parámtro. 
     * A su vez, guarda en la sesión ésta instancia.
     * @param Usuario $usuario Instancia de usuario.
     */
    private function set_usuario($usuario) {
        if (!is_null($usuario)) {
            $_SESSION['usuario'] = $usuario;
            $this->_usuario = $usuario;
        }
    }

    /**
     * Devuelve el usuario de la sesión actual
     * 
     * NOTA: No hace ningún control, por lo que puede devolver null.
     * 
     * @return Usuario El usuario de la sesión actual.
     */
    public function get_usuario() {
        return $this->_usuario;
    }

    /**
     * Cierra la sesión actual del usuario.
     * 
     * NOTA: Elimina las variables de sesión, pero no las cookies de navegación.
     */
    public function cerrar_sesion() {
        session_destroy();
        $_SESSION = array();
    }

    /**
     * Cierra de manera seguro y absoluta la sesión actual del usuario.
     * 
     * NOTA: Eliminar todas las cookies producto de la sesión.
     */
    public function cerrar_sesion_completamente() {
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        $this->cerrar_sesion();
    }

    /**
     * Carga un mensaje en la sesión para que esté disponible entre distintas 
     * webs.
     * @param type $mensaje
     * @param type $tipo_mensaje
     */
    public function cargar_mensaje($mensaje, $tipo_mensaje) {
        if (is_array($mensaje)) {
            $this->_mensajes[$tipo_mensaje] = array_merge($this->_mensajes[$tipo_mensaje], $mensaje);
        } else {
            $this->_mensajes[$tipo_mensaje][] = $mensaje;
        }
        $_SESSION['mensajes'] = $this->_mensajes;
    }

    public function hay_mensajes() {
        if (isset($_SESSION['mensajes'])) {
            $this->_mensajes = $_SESSION['mensajes'];
            return true;
        }
        return false;
    }

    public function mostrar_mensaje($tipo_mensaje) {
        if (isset($_SESSION['mensajes'])) {
            $this->_mensajes = $_SESSION['mensajes'];
            return $this->_mensajes[$tipo_mensaje];
        }
        return null;
    }

    public function get_mensajes() {
        return $this->_mensajes;
    }

    public function limpiar_mensajes($tipo_mensaje = 'todos') {
        if ($tipo_mensaje === 'todos') {
            unset($_SESSION['mensajes']);
            $this->_mensajes = array();
        } else {
            $this->_mensajes[$tipo_mensaje] = array();
            $_SESSION['mensajes'] = $this->_mensajes;
        }
    }

    public function recordar_ultima_web($web = '') {
        if (empty($web)) {
            $this->_ultima_web = $_SERVER['REQUEST_URI'];
        } else {
            $this->_ultima_web = $web;
        }
        $_SESSION['ultima_web'] = $this->_ultima_web;
    }

    public function volver_ultima_web() {
        if (isset($_SESSION['ultima_web'])) {
            $this->_ultima_web = $_SESSION['ultima_web'];
            Util::ir($this->_ultima_web);
        } else {
            Util::ir_inicio();
        }
    }

    public function get_ultima_web() {
        return $this->_ultima_web;
    }

    public function set_dato($clave, $valor) {
        $_SESSION[$clave] = $valor;
    }

    public function get_dato($clave) {
        if (isset($_SESSION[$clave])) {
            return $_SESSION[$clave];
        }
        return null;
    }

    public function iniciar_sesion_api_aulas($nombre_usuario, $clave_usuario) {
        $url = RUTA_API_AULAS."/validar_usuario.php/?usuario={$nombre_usuario}&clave={$clave_usuario}";
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPGET, true);
        curl_setopt($process, CURLOPT_HEADER, false);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, true);				
        $raw = curl_exec($process);
        $resultado = json_decode($raw);		
        if (!property_exists($resultado, "estado")) {
            return FALSE;
        }    
        $estado = $resultado->estado;		
        if ($estado !== "ok") {
			return FALSE;
		}
        $usuario_valido = $resultado->datos->exito;
        if(!$usuario_valido){
            return FALSE;
        }						
        $usuario = $this->obtener_usuario($nombre_usuario);
        if($usuario === FALSE){
			$usuario = new Usuario();
			$usuario->set_nombre_usuario($nombre_usuario);
			$usuario->set_rol(Usuario::cantidad_administradores() === 0 ? Rol::materializar(1) : Rol::materializar(2));
            if(!Usuario::insertar($usuario)){					
				return FALSE;
			}
        }
		$this->set_usuario($usuario);
		return TRUE;        
    }

    public function obtener_usuario($nombre_usuario) {
        $conexion = Conexion::get_instacia(CONEXION_ISAAI);
        $consulta = "SELECT id, nombre_usuario, id_rol, fecha_alta, fecha_baja "
                . "FROM usuarios "
                . "WHERE ( nombre_usuario = '{$nombre_usuario}')";
        $resultado = $conexion->consultar_simple($consulta);		
        if (!empty($resultado)) {
            $usuario = new Usuario();
            $usuario->set_id($resultado[0]['id']);
            $usuario->set_nombre_usuario($resultado[0]['nombre_usuario']);
            $usuario->set_rol(Rol::materializar($resultado[0]['id_rol']));
            $usuario->set_fecha_alta($resultado[0]['fecha_alta']);
            $usuario->set_fecha_baja($resultado[0]['fecha_baja']);            
            return $usuario;
        }
        return false;
    }
}
