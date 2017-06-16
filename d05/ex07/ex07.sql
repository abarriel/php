SELECT 
	 `titre`, `resum`
     FROM `film` f WHERE (f.resum LIKE '%42%' OR  f.titre LIKE '%42%')
ORDER BY `duree_min`;