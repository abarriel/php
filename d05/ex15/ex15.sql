SELECT REVERSE(MID(telephone,2,9)) as enohpelet
FROM distrib
WHERE (telephone LIKE '05%');