SELECT nom, prenom FROM fiche_personne
WHERE(prenom LIKE '_%-%_' OR nom LIKE '_%-%_')
ORDER BY nom,prenom;