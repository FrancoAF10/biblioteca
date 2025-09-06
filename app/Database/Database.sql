CREATE DATABASE biblioteca;
USE biblioteca;

CREATE TABLE libros(
	id 			INT AUTO_INCREMENT PRIMARY KEY,
	nombre 		VARCHAR(200) 	NOT NULL,
	imagen		VARCHAR(200)	NOT NULL
)ENGINE = INNODB;

INSERT INTO libros (nombre, imagen) VALUES
	('Conociendo el Perú', 'libro1.jpg'),
	('Matemáticas avanzadas', 'libro2.jpg');

-- TAREA 04

CREATE TABLE categorias(
	idcategoria		INT AUTO_INCREMENT PRIMARY KEY,
	categoria		VARCHAR(200)	
)ENGINE=INNODB;

INSERT INTO categorias (categoria) VALUES
					('Matemáticas'),
					('Comunicación'),
					('Computación');

CREATE TABLE subcategorias(
	idsubcategoria		INT AUTO_INCREMENT PRIMARY KEY,
	subcategoria		VARCHAR(200),
	idcategoria			INT,
	CONSTRAINT fk_categoria_sc FOREIGN KEY(idcategoria) REFERENCES categorias(idcategoria)
)ENGINE=INNODB;

INSERT INTO subcategorias (subcategoria,idcategoria) VALUES
					('Razonamiento Lógico Matemático',1),
					('Álgebra',1),
					('Trigonometría',1),
					('Razonamiento verbal',2),
					('composición',2),
					('redacción',2),
					('Base de datos',3),
					('sistemas operativos',3),
					('lenguajes de programación',3);

CREATE TABLE editoriales(
	ideditorial		INT AUTO_INCREMENT PRIMARY KEY,
	editorial		VARCHAR(200),
	nacionalidad	VARCHAR(200)
)ENGINE=INNODB;
INSERT INTO editoriales (editorial,nacionalidad) VALUES
					('Editorial San Marcos','Perú'),
					('Editorial Universitaria','Chile'),
					('Alianza Editorial', 'España');


CREATE TABLE recursos(
	idrecurso			INT AUTO_INCREMENT PRIMARY KEY,
	tipo				ENUM('fisico','digital') NOT NULL,
	titulo				VARCHAR(200) NOT NULL,
	apublicacion		YEAR NOT NULL,
	isbn				CHAR(17) NOT NULL,
	numpaginas			INT NOT NULL,
	rutaportada			VARCHAR(300) NOT NULL,
	rutarecurso			VARCHAR(200) NOT NULL,
	estado				ENUM('bueno','regular','malo') NOT NULL,
	creado				DATE NOT NULL,
	modificado			DATE NULL,
	idsubcategoria		INT,
	ideditorial			INT,

	CONSTRAINT fk_subcategoria_sc FOREIGN KEY(idsubcategoria) REFERENCES subcategorias(idsubcategoria),
	CONSTRAINT fk_editorial_ed FOREIGN KEY(ideditorial) REFERENCES editoriales(ideditorial)
)ENGINE=INNODB;
INSERT INTO recursos 
(tipo, titulo, apublicacion, isbn, numpaginas, rutaportada, rutarecurso, estado, creado, modificado, idsubcategoria, ideditorial) 
VALUES
-- Matemáticas
('fisico', 'Álgebra Elemental', 2018, '978-612-0000011', 320, '/img/portadas/algebra.jpg', '/recursos/algebra.pdf', 'bueno', '2025-09-05', NULL, 2, 1),
('digital', 'Trigonometría Moderna', 2020, '978-612-0000022', 280, '/img/portadas/trigonometria.jpg', '/recursos/trigonometria.pdf', 'bueno', '2025-09-05', NULL, 3, 2),
('fisico', 'Razonamiento Matemático Avanzado', 2017, '978-612-0000033', 410, '/img/portadas/razonamiento.jpg', '/recursos/razonamiento.pdf', 'regular', '2025-09-05', NULL, 1, 3),
-- Comunicación
('digital', 'Redacción Académica', 2021, '978-612-0000044', 150, '/img/portadas/redaccion.jpg', '/recursos/redaccion.pdf', 'bueno', '2025-09-05', NULL, 6, 1),
('fisico', 'Composición Literaria', 2016, '978-612-0000055', 200, '/img/portadas/composicion.jpg', '/recursos/composicion.pdf', 'malo', '2025-09-05', NULL, 5, 2),
('digital', 'Razonamiento Verbal y Crítico', 2019, '978-612-0000066', 250, '/img/portadas/razonamientoverbal.jpg', '/recursos/razverbal.pdf', 'bueno', '2025-09-05', NULL, 4, 3),
-- Computación
('fisico', 'Fundamentos de Bases de Datos', 2015, '978-612-0000077', 500, '/img/portadas/basedatos.jpg', '/recursos/basedatos.pdf', 'regular', '2025-09-05', NULL, 7, 1),
('digital', 'Sistemas Operativos: Principios y Diseño', 2018, '978-612-0000088', 450, '/img/portadas/sistemas.jpg', '/recursos/sistemas.pdf', 'bueno', '2025-09-05', NULL, 8, 2),
('fisico', 'Introducción a los Lenguajes de Programación', 2022, '978-612-0000099', 380, '/img/portadas/programacion.jpg', '/recursos/programacion.pdf', 'bueno', '2025-09-05', NULL, 9, 3);
select * from recursos;

