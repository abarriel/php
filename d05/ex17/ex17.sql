SELECT count(*) as nb_abo,   FLOOR(sum(prix)/count(prix)) as moy_abo , sum(duree_abo)%42 as ft FROM abonnement;
