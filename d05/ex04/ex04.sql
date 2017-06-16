UPDATE ft_table t

SET t.date_de_creation = DATE_ADD(t.date_de_creation, INTERVAL 20 YEAR)

WHERE id > 5
;