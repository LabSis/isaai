# isaai
## Sistema de Inventariado Seguro de Alertas Autom�ticas de Activos Inform�ticos ##

Mantiene un historial de los componentes de hardware de las m�quinas de un entorno inform�tico. Consume la base de datos del proyecto https://github.com/Gochip/HardwareCollector, �ste �ltimo obtiene los datos actuales de las m�quinas.

Desarrollado en PHP Version 5.5.9 y motor MySQL 14.14 Distribution 5.6.16.

### Configuraci�n ###

Primero ejecutar script de creaci�n de base de datos: bd/bd.sql. El mismo crea un usuario "admin" con clave "4dm1n" para el uso del sistema.

En el archivo /config.php est�n:
- Los par�metros de conexi�n con la base de datos del HardwareCollector y con la del sistema.
- La construcci�n de rutas para poder usar el sistema en otra ubicaci�n: por defecto es "http:localhost/isaai/index.php".
- Cambiar la ruta del sistema de archivos, pode defecto considera que el sistema se ubica en "C:\xampp\htdocs\isaai".