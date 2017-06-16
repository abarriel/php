<?php
 $passwd = "private/passwd";
 $basket = "private/basket";
 $categories = "data/categories.csv";
 $article = "data/articles";
 $ico_install = "install_files/oscar.ico";
 $ico = "data/oscar.ico";
 $ressources_article = "install_files/ressources_article";
 $ressources_categories = "install_files/ressources_categories.csv";
 if(!file_exists("private/"))
    mkdir("private/",0744);
 if(!file_exists("data/"))
    mkdir("data/",0744);
	$passhased = hash('sha224', "admin");
	$user = array(array('login'=>"admin",'passwd'=>$passhased, 'type' => 'admin', 'time' => time()));
	touch($basket);
 	file_put_contents($passwd, serialize($user), LOCK_EX);
 	file_put_contents($article, file_get_contents($ressources_article), LOCK_EX);
 	file_put_contents($ico, file_get_contents($ico_install), LOCK_EX);
 	file_put_contents($categories, file_get_contents($ressources_categories), LOCK_EX);
 header('Location: index.php');
?>