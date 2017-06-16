<?php
include('auth.php');
session_start();
if(search_type($_SESSION['loggued_on_user']) != 'admin')
	header("Location: index.php");
$file = "data/articles";
include("header.php");
include("menu_admin.php");
?>
<!DOCTYPE html>
<html>
<table width="100%" class="text" border="1px">
<?php
	  $article = unserialize(file_get_contents($file));
	  if(!empty($article))
	  {
	  		echo "<tr>";
    		echo "<td >Titre</td>";
    		echo "<td>Categories</td>";
    		echo "<td>Price</td>";
    		echo "</tr>";
        foreach ($article as $key => $value) {
				echo "<tr>";
    		echo "<td ><a style='text-decoration:none;' href='admin_modif_articles.php?type=".$value['name']."'>".$value['name']."</a></td>";
    		echo "<td>".$value['categorie']."</td>";
    		echo "<td>".$value['price']."</td>";
    		echo "</tr>";
		}
	}
?>
</table>
</article>
</div>
</body>
</html>