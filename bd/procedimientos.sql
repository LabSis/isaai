DELIMITER //
CREATE PROCEDURE listar()
BEGIN

SELECT id, fecha_ultimo_contacto FROM maquinas;

END //