INSERT INTO ft_table 
(
	login,
	groupe,
	date_de_creation
)
SELECT 
	nom,
	'other',
	date_naissance 
FROM fiche_personne

WHERE (nom LIKE '%a%' AND length(nom) < 9)

ORDER BY 1

LIMIT 10;