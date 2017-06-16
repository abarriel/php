<?php
include('auth.php');
include('categories.php');
session_start();
$_SESSION['modif_categories'] = "null";
$_SESSION['cat_exist'] = "toto";
if(search_type($_SESSION['loggued_on_user']) != 'admin')
	header("Location: index.php");
$file = "data/categories.csv";
if($_POST['submit'] === "New Categories")
	$_SESSION['modif_categories'] = FALSE;
if($_POST['submit'] === "Add Categories")
{
	if($_POST['cat_name'])
	{
	if(strstr($_POST['cat_name'], ',') || strstr($_POST['cat_name'], ':') || strstr($_POST['cat_name'], '&'))
		{
			$_SESSION['cat_exist'] = FALSE;
			goto end;
		}
	}
	else
		{
		$_SESSION['cat_exist'] = FALSE;
		goto end;
		}
	if (!find_categories($_POST['cat_name']))
	{
		$cat_name = $_POST['cat_name'].",\n";
		file_put_contents($file, $cat_name, FILE_APPEND);
	}
	else 
		$_SESSION['cat_exist'] = FALSE;
}
end:
 include("header.php");
 include("menu_admin.php")
?>
<!DOCTYPE html>
<html>
<div id="categories">
			<?PHP
			echo "<span style='color:white; margin-left:2px;'>All Categories:</span>";
			$fd = fopen("data/categories.csv","r");
			while($categories = fgetcsv($fd,0,","))
			{
				echo "<a href=\"admin_modif_categories.php?type=$categories[0]\" class=\"categorie\">$categories[0]</a>";
			}
			fclose($fd);
		?>
</div>

<form method="post" action="admin_manage_categories.php" class="text">
<?php
	if ($_SESSION['cat_exist'] == FALSE)
	{
		echo "<p> Category already exist or incorrect name</p>";
	}
	if ($_SESSION['cat_delete'] == FALSE)
	{
		echo "<p> Categories has been succesfully deleted</p>";
		$_SESSION['cat_delete'] = "tete";
	}
	if ($_SESSION['modif_categories'] == FALSE)
	{
		   echo"<label for='cat_name'>Name: </label> 
            <input type='text' name='cat_name' id='cat_name' /> ";
           echo "<input type='submit' name='submit' value='Add Categories'>";
	}
	else
	{
		echo "<input type='submit' name='submit' value='New Categories'>";
	}
?>


</form>
</article>
</div>
</body>
</html>