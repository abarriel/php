SELECT nom,prenom,date(date_naissance) AS 'date de naissance' FROM fiche_personne 
WHERE (YEAR(date_naissance) LIKE 1989) ORDER BY nom;
