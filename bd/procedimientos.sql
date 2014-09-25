USE isaai;
DELIMITER //
CREATE PROCEDURE listar()
BEGIN

SELECT id, fecha_sincronizacion FROM maquinas;

END //