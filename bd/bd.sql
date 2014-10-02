DROP DATABASE IF EXISTS isaai;
CREATE DATABASE isaai;
USE isaai;
CREATE TABLE IF NOT EXISTS roles(
	id INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(20) NOT NULL,
	descripcion VARCHAR(255) NULL,
	PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS usuarios(
	id INT NOT NULL AUTO_INCREMENT,
	nombre_usuario VARCHAR(20),
	clave_usuario VARCHAR(255),
	id_rol INT NOT NULL,
	nombre VARCHAR(50) NOT NULL,
	apellido VARCHAR(50) NOT NULL,
	email VARCHAR(50) NULL,
	telefono VARCHAR(11) NULL,
	direccion VARCHAR(100) NULL,
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