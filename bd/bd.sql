DROP DATABASE IF EXISTS isaai;
CREATE DATABASE isaai;
USE isaai;

GRANT ALL ON isaai.* TO 'isaai'@'localhost' IDENTIFIED BY 'isaai_sis_*';

CREATE TABLE IF NOT EXISTS roles(
	id INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(20) NOT NULL,
	descripcion VARCHAR(255) NULL,
	PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS usuarios(
	id INT NOT NULL AUTO_INCREMENT,
	nombre_usuario VARCHAR(20) UNIQUE,
	id_rol INT NOT NULL,
	fecha_alta DATETIME NOT NULL,
	fecha_baja DATETIME NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (id_rol) REFERENCES roles (id)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS sistemas_operativos(
	id INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(255),
	version VARCHAR(50),
	PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS maquinas(
	id VARCHAR(255) NOT NULL,
	fecha_cambio DATETIME NOT NULL,
	id_sistema_operativo INT NOT NULL,
	nombre VARCHAR(255) NULL,
	fecha_alta DATETIME NOT NULL,
	fecha_sincronizacion DATETIME NULL, /* fecha_ultimo_contacto */
	PRIMARY KEY(id,fecha_cambio),
	FOREIGN KEY (id_sistema_operativo) REFERENCES sistemas_operativos (id)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS procesadores(
	id INT NOT NULL AUTO_INCREMENT,
	id_maquina VARCHAR(255) NOT NULL,
	fecha_cambio DATETIME NOT NULL,
	tipo VARCHAR(255) NULL,
	velocidad VARCHAR(255) NULL,
	nucleos VARCHAR(255) NULL,
	PRIMARY KEY(id,id_maquina,fecha_cambio),
	FOREIGN KEY (id_maquina,fecha_cambio) REFERENCES maquinas (id,fecha_cambio)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS memorias(
	id INT NOT NULL AUTO_INCREMENT,
	id_maquina VARCHAR(255) NOT NULL,
	fecha_cambio DATETIME NOT NULL,
	capacidad VARCHAR(255) NULL,
	tipo VARCHAR(255) NULL,
	descripcion VARCHAR(255) NULL,
	numero_serial VARCHAR(255) NULL,
	numero_ranura VARCHAR(255) NULL,
	velocidad VARCHAR(255) NULL,
	nombre VARCHAR(255) NULL,
	PRIMARY KEY(id,id_maquina,fecha_cambio),
	FOREIGN KEY (id_maquina,fecha_cambio) REFERENCES maquinas (id,fecha_cambio)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS discos(
	id INT NOT NULL AUTO_INCREMENT,
	id_maquina VARCHAR(255) NOT NULL,
	fecha_cambio DATETIME NOT NULL,
	nombre VARCHAR(255) NULL,
	fabricante VARCHAR(255) NULL,
	modelo VARCHAR(255) NULL,
	descripcion VARCHAR(255) NULL,
	tipo VARCHAR(255) NULL,
	tamanio VARCHAR(255) NULL,
	numero_serial VARCHAR(255) NULL,
	firmware VARCHAR(255) NULL,
	PRIMARY KEY(id,id_maquina,fecha_cambio),
	FOREIGN KEY (id_maquina,fecha_cambio) REFERENCES maquinas (id,fecha_cambio)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS bios(
	id INT NOT NULL AUTO_INCREMENT,
	id_maquina VARCHAR(255) NOT NULL,
	fecha_cambio DATETIME NOT NULL,
	nombre VARCHAR(255) NULL,
	fabricante VARCHAR(255) NULL,
	modelo VARCHAR(255) NULL,
	asset_tag VARCHAR(255) NULL,
	version VARCHAR(255) NULL,
	numero_serial VARCHAR(255) NULL,
	PRIMARY KEY(id,id_maquina,fecha_cambio),
	FOREIGN KEY (id_maquina,fecha_cambio) REFERENCES maquinas (id,fecha_cambio)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS placas_red(
	id INT NOT NULL AUTO_INCREMENT,
	id_maquina VARCHAR(255) NOT NULL,
	fecha_cambio DATETIME NOT NULL,
	direccion_mac VARCHAR(255) NULL,
	direccion_ip VARCHAR(255) NULL,
	mascara VARCHAR(255) NULL,
	gateway VARCHAR(255) NULL,
	direccion_red VARCHAR(255) NULL,
	descripcion VARCHAR(255) NULL,
	tipo VARCHAR(255) NULL,
	velocidad VARCHAR(255) NULL,
	direccion_dns VARCHAR(255) NULL,
	PRIMARY KEY(id,id_maquina,fecha_cambio),
	FOREIGN KEY (id_maquina,fecha_cambio) REFERENCES maquinas (id,fecha_cambio)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS placas_video(
	id INT NOT NULL AUTO_INCREMENT,
	id_maquina VARCHAR(255) NOT NULL,
	fecha_cambio DATETIME NOT NULL,
	nombre VARCHAR(255) NULL,
	memoria VARCHAR(255) NULL,
	chipset VARCHAR(255) NULL,
	PRIMARY KEY(id,id_maquina,fecha_cambio),
	FOREIGN KEY (id_maquina,fecha_cambio) REFERENCES maquinas (id,fecha_cambio)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS placas_sonido(
	id INT NOT NULL AUTO_INCREMENT,
	id_maquina VARCHAR(255) NOT NULL,
	fecha_cambio DATETIME NOT NULL,
	nombre VARCHAR(255) NULL,
	fabricante VARCHAR(255) NULL,
	PRIMARY KEY(id,id_maquina,fecha_cambio),
	FOREIGN KEY (id_maquina,fecha_cambio) REFERENCES maquinas (id,fecha_cambio)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS monitores(
	id INT NOT NULL AUTO_INCREMENT,
	id_maquina VARCHAR(255) NOT NULL,
	fecha_cambio DATETIME NOT NULL,
	nombre VARCHAR(255) NULL,
	modelo VARCHAR(255) NULL,
	resolucion VARCHAR(255) NULL,
	PRIMARY KEY(id,id_maquina,fecha_cambio),
	FOREIGN KEY (id_maquina,fecha_cambio) REFERENCES maquinas (id,fecha_cambio)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS perifericos(
	id INT NOT NULL AUTO_INCREMENT,
	id_maquina VARCHAR(255) NOT NULL,
	fecha_cambio DATETIME NOT NULL,
	nombre VARCHAR(255) NULL,
	fabricante VARCHAR(255) NULL,
	tipo VARCHAR(255) NULL,
	descripcion VARCHAR(255) NULL,
	interfaz VARCHAR(255) NULL,
	PRIMARY KEY(id,id_maquina,fecha_cambio),
	FOREIGN KEY (id_maquina,fecha_cambio) REFERENCES maquinas (id,fecha_cambio)
		ON DELETE RESTRICT
		ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS tipos_cambio(
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NULL,
    PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS roles_x_tipo_cambio(
    id INT NOT NULL AUTO_INCREMENT,
    id_rol INT NOT NULL,
    id_tipo_cambio INT NOT NULL,
    permiso BOOLEAN NOT NULL DEFAULT TRUE,
    PRIMARY KEY(id),
    FOREIGN KEY (id_rol) REFERENCES roles (id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT,
    FOREIGN KEY (id_tipo_cambio) REFERENCES tipos_cambio (id)
	ON DELETE RESTRICT
	ON UPDATE RESTRICT
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

INSERT INTO roles (id, nombre, descripcion) VALUES (1, "Administrador", NULL);
INSERT INTO roles (id, nombre, descripcion) VALUES (2, "Operador", NULL);
INSERT INTO roles (id, nombre, descripcion) VALUES (3, "Técnico", NULL);

INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Cualquier cambio", "Todos los cambios, sean máquinas nuevas o modificaciones en las máquinas actuales");
INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Nuevas", "Sólo máquinas agregadas al sistema ISAAI");
INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Procesadores", "Cambios de procesadores");
INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Bios", "Cambios de bios");
INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Discos", "Cambios de discos");
INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Memorias", "Cambios de memorias");
INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Monitores", "Cambios de monitores");
INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Perifericos", "Cambios de perifericos");
INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Placas de red", "Cambios de palcas de red");
INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Placas de sonido", "Cambios de palcas de sonido");
INSERT INTO tipos_cambio (nombre, descripcion) VALUES ("Placas de video", "Cambios de palcas video");
   
/* Permisos del Administrador*/
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,1,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,2,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,3,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,4,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,5,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,6,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,7,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,8,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,9,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,10,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (1,11,true);
/* Permisos del Operador*/
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,1,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,2,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,3,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,4,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,5,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,6,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,7,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,8,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,9,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,10,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (2,11,true);
/* Permisos del Técnico */
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,1,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,2,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,3,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,4,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,5,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,6,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,7,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,8,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,9,true);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,10,false);
INSERT INTO roles_x_tipo_cambio (id_rol, id_tipo_cambio, permiso) VALUES (3,11,false);
