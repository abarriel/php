SELECT id_distrib, nom FROM distrib
WHERE (id_distrib REGEXP '42|(6[2-9])|71|88|89|90') AND (nom REGEXP 'Y')
LIMIT 8 OFFSET 3;