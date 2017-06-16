<?php
function reorganise_cat_article($previous, $new)
{
	$file = "data/articles";
	$article = unserialize(file_get_contents($file));
  	foreach ($article as $key => $value)
 	{
 		$cats = explode(":", $value['categorie']);
 		foreach ($cats as $id => $cat) {
 			if(!strcmp($cat,$previous))
			{
			 $cats = str_replace($cat, $new, $cats);
 			 $article[$key]['categorie'] = implode(":",$cats);
 			break;
 			}
 		}
  }
 file_put_contents($file, serialize($article));
}
function find_categories($str)
{
	$fd = fopen("data/categories.csv","r");
	while ($categories = fgetcsv($fd,0,","))
		{
			if ($categories[0] == $str)
			{
				fclose($fd);
				return ($str);
			}
		}
		fclose($fd);
		return(NULL);
}
function check_film_name($str)
{	
		if ($str == '')
			return FALSE;
		$fd_film = fopen("data/articles","r");
		while($film = fgetcsv($fd_film,0,","))
		{
			if ($str == $film[1])
			{
				fclose($fd_film);
				return FALSE;
			}
		}
		fclose($fd_film);
		return TRUE;
}

?>