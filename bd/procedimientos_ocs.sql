USE ocsweb;
DELIMITER //
CREATE PROCEDURE listar()
BEGIN

SELECT id, lastcome FROM hardware;

END //