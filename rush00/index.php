<?php
session_start();
include('categories.php');
include('header.php');
?>
<!DOCTYPE html>
<html>
<article>
<div id="categories">
			<?PHP
			echo "<span style='color:white; margin-left:2px;'>Categories:</span>";
			$fd = fopen("data/categories.csv","r");
			while($categories = fgetcsv($fd,0,","))
			{
				echo "<a href=\"index.php?type=$categories[0]\" class=\"categorie\">$categories[0]</a>";
			}
			fclose($fd);
			?>
</div>
<div id="film">
	<?PHP
	$file = "data/articles";
	$article = unserialize(file_get_contents($file));
	echo "<form method='POST' form='frame'>";
	if(!empty($article))
	{
		foreach ($article as $key => $value)
		 {
		 	$cat = explode(":", $value['categorie']);
	 		if (in_array($_GET['type'],$cat))
	 		{
	 			echo "<div class='block'>";
	 			echo "<img class='img_in_block' src='".$value['img']."'>";
	 	    	echo "<p class='text_in_block' style='display:inline-block' >".$value['name']."</p>";
	 	    	echo "<p class='text_in_block' style='display:inline-block' >".$value['price']." $</p>";
	 	    	echo "<button type='submit' class='add_button_block'  name='add_item' value='".$value['name']."'>Add to Basket</button>";
	 	    	echo "</div>";
	 		}
    		if(!isset($_GET['type']) &&  (rand(0,2) % 2 == 0))
    		{
    			echo "<div class='block'>";
	 			echo "<img class='img_in_block' src='".$value['img']."'>";
	 	    	echo "<p class='text_in_block' style='display:inline-block' >".$value['name']."</p>";
	 	    	echo "<p class='text_in_block' style='display:inline-block' >".$value['price']." $</p>";
	 	    	echo "<button type='submit' class='add_button_block' name='add_item' value='".$value['name']."'>Add to Basket</button>";
	 	    	echo "</div>";
    		}
  		}
	echo "</form>";  
	}
	get_items($_POST['add_item']);
	?>
</div>
</article>
</div>
</body>
<iframe name="frame" style="display:none;"></iframe>
</html>