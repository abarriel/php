SELECT 
	 `titre`, `resum`
     FROM `film` f WHERE (f.resum REGEXP 'vincent')
ORDER BY 'id_film' ;