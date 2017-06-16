<?php
include('auth.php');
include('categories.php');
session_start();
$_SESSION['cat_delete'] = "null";
$_SESSION['modif_cat'] = "null";
$_SESSION['modif_cat_failed'] = "null";
if(search_type($_SESSION['loggued_on_user']) != 'admin')
	header("Location: index.php");
$file = "data/categories.csv";
if(isset($_POST['modif']))
{
	$_SESSION['modif_cat'] = FALSE;
}
if(isset($_POST['modif_ok']) && isset($_POST['modif_cat']))
{
	if($_POST['modif_cat'] == "" || strstr($_POST['modif_cat'], ',') || strstr($_POST['modif_cat'], ':') || strstr($_POST['modif_cat'], '&'))
  {
    $_SESSION['modif_cat_failed'] = FALSE;
          goto end;
  }
 $files = file_get_contents($file);
  strstr($files, $_POST['modif_cat']);
 if(strstr($files, $_POST['modif_cat']))
 {
	$_SESSION['modif_cat_failed'] = FALSE;
	goto end;
 }
 $replaced = str_replace($_GET['type'],$_POST['modif_cat'] , $files);
 file_put_contents($file, $replaced);
$_SESSION['modif_cat'] = "null";
reorganise_cat_article($_GET['type'],$_POST['modif_cat']);
header("Location: admin_manage_categories.php");
}
else if(isset($_POST['delete']))
{
 $files = file_get_contents($file);
 $replaced = str_replace($_GET['type'].",\n", "", $files);
 file_put_contents($file, $replaced);
$_SESSION['cat_delete'] = FALSE;
// reorganise_cat_article($_POST['modif_cat']);
 header("Location: admin_manage_categories.php");
end:
}
 include("header.php");
 include("menu_admin.php")
?>
<!DOCTYPE html>
<html>
<p class="text">
	Category "<?php echo $_GET['type'];?>"
</p>
<form method='post' action='admin_modif_categories.php?type=<?php echo $_GET['type'];?>'>
  <center>
  <!-- <input type="submit" name="submit" value="Go"/> -->
 <!-- <br /> -->
 <?php
 if($_SESSION['modif_cat_failed'] == FALSE)
 {
 	echo "<p> Name already taken or empty</p>";
 }
 if($_SESSION['modif_cat'] == FALSE)
 {
 	echo '<label for="modif_cat">New Name : </label> 
            <input type="text" name="modif_cat" id="modif_cat" />
           <input type="submit" name="modif_ok" value="OK" class="text"/><center>  ';
 }
 else
 {
 echo '<input type="submit"  name="delete" value="Delete" class="text"/><center>
 <input type="submit" name="modif" value="Modif" class="text"/><center> ';
}
 ?>
</form> 
</article>
</div>
</body>
</html>