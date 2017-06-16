SELECT  etage_salle as etage,  sum(nbr_siege) as sieges FROM salle
GROUP BY etage_salle
ORDER BY sieges DESC;