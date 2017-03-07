# isaai
## Sistema de Inventariado Seguro de Alertas Automáticas de Activos Informáticos ##

Mantiene un historial de los componentes de hardware de las máquinas de un entorno informático. Consume la base de datos del proyecto https://github.com/Gochip/HardwareCollector, éste último obtiene los datos actuales de las máquinas.

Desarrollado en PHP Version 5.5.9 y motor MySQL 14.14 Distribution 5.6.16.

### Configuración ###

Primero ejecutar script de creación de base de datos: bd/bd.sql. El mismo crea un usuario "admin" con clave "4dm1n" para el uso del sistema.

En el archivo /config.php están:
- Los parámetros de conexión con la base de datos del HardwareCollector y con la del sistema.
- La construcción de rutas para poder usar el sistema en otra ubicación: por defecto es "http:localhost/isaai/index.php".
- Cambiar la ruta del sistema de archivos, pode defecto considera que el sistema se ubica en "C:\xampp\htdocs\isaai".