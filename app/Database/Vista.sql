use biblioteca;
CREATE VIEW mostrar_ecs AS
SELECT 
r.idrecurso,
    r.tipo,
    r.titulo,
    r.apublicacion,
    r.isbn,
    r.numpaginas,
    r.rutaportada,
    r.rutarecurso,
    r.estado,
    r.creado,
    r.modificado,
    c.idcategoria,
    c.categoria,
    s.idsubcategoria,
    s.subcategoria,
    e.ideditorial,
    e.editorial,
    e.nacionalidad
FROM recursos r
INNER JOIN subcategorias s ON r.idsubcategoria = s.idsubcategoria
INNER JOIN categorias c ON s.idcategoria = c.idcategoria
INNER JOIN editoriales e ON r.ideditorial = e.ideditorial;
