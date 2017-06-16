SELECT titre as Titre, resum as 'Resume', annee_prod FROM film,genre 
WHERE (genre.id_genre = film.id_genre AND genre.nom LIKE 'erotic')
ORDER BY annee_prod DESC;