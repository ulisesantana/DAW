DROP DATABASE IF EXISTS db_inventario;
CREATE DATABASE db_inventario;
USE db_inventario;

CREATE TABLE t_portatiles (
	id INT AUTO_INCREMENT NOT NULL,
	marca VARCHAR(10) NOT NULL,
	procesador VARCHAR(12) NOT NULL,
	RAM INT UNSIGNED NOT NULL,
	disco INT UNSIGNED NOT NULL,
	PRIMARY KEY (id)
);

INSERT INTO t_portatiles (marca, procesador, RAM, disco) VALUES ('ASUS', 'Intel i5', 16, 1000);
INSERT INTO t_portatiles (marca, procesador, RAM, disco) VALUES ('HP', 'AMD A8', 8, 1000);
INSERT INTO t_portatiles (marca, procesador, RAM, disco) VALUES ('Apple', 'Intel i5', 8, 256);
INSERT INTO t_portatiles (marca, procesador, RAM, disco) VALUES ('ASUS', 'AMD E1', 12, 500);
INSERT INTO t_portatiles (marca, procesador, RAM, disco) VALUES ('LG', 'Intel i7', 16, 1000);
INSERT INTO t_portatiles (marca, procesador, RAM, disco) VALUES ('LG', 'AMD A8', 8, 750);
INSERT INTO t_portatiles (marca, procesador, RAM, disco) VALUES ('acer', 'AMD A4', 4, 500);

SELECT * FROM t_portatiles ORDER BY marca;
