<?php
include('auth.php');
include('categories.php');
session_start();
$_SESSION['cat_delete'] = "null";
$_SESSION['modif_cat'] = "null";
$_SESSION['modif_cat_price'] = "null";
$_SESSION['modif_cat_failed'] = "null";
$_SESSION['modif_cat_price_failed'] = "null";
if(search_type($_SESSION['loggued_on_user']) != 'admin')
  header("Location: index.php");
$file = "data/articles";
if(isset($_POST['modif_name']))
{
  $_SESSION['modif_cat'] = FALSE;
}
if(isset($_POST['modif_price']))
{
  $_SESSION['modif_cat_price'] = FALSE;
}
if(isset($_POST['modif_ok']) && isset($_POST['modif_cat']))
{
  if($_POST['modif_cat'] == "")
  {
    $_SESSION['modif_cat_failed'] = FALSE;
          goto end;
  }
  $article = unserialize(file_get_contents($file));
  if(!(empty($article)))
  {
  foreach ($article as $key => $value)
    {
      switch ($value['name'])
      {
        case $_POST['modif_cat'];
        {
          $_SESSION['modif_cat_failed'] = FALSE;
          goto end;
        }
        break;
        case $_GET['type'];
          {
            $article[$key] = array('name'=>$_POST['modif_cat'],'categorie'=> $article[$key]['categorie'], 'price' => $article[$key]['price'], 'img' => $article[$key]['img']);
             file_put_contents($file, serialize($article));
           header('Location: admin_manage_articles.php');
           }
          break;
      }
  }
}
}
if(isset($_POST['modif_ok_price']) && isset($_POST['modif_cat_price']))
{
  $article = unserialize(file_get_contents($file));
  if(!(empty($article)))
  {
     if (!is_numeric($_POST['modif_cat_price']))
  {
    $_SESSION['modif_cat_price_failed'] = FALSE;
    goto end;
  }
   foreach ($article as $key => $value)
    {
      switch ($value['name'])
      {
       case $_GET['type'];
          {
            $article[$key] = array('name'=>$article[$key]['name'],'categorie'=> $article[$key]['categorie'], 'price' => $_POST['modif_cat_price'], 'img' => $article[$key]['img']);
             file_put_contents($file, serialize($article));
           header('Location: admin_manage_articles.php');
           }
          break;
      }
  }
}
}
else if(isset($_POST['delete']))
{
  $article = unserialize(file_get_contents($file));
  if(!(empty($article)))
  {
  foreach ($article as $key => $value)
    {
      switch ($value['name'])
      {
        case $_GET['type'];
          {
            unset($article[$key]);
            file_put_contents($file, serialize($article));
            header("Location: admin_manage_articles.php");
           }
          break;
      }
  }
}
}
end:
 include("header.php");
 include("menu_admin.php")
?>
<!DOCTYPE html>
<html>
<p class="text">
  Article "<?php echo $_GET['type'];?>"
</p>
<form method='post' action='admin_modif_articles.php?type=<?php echo $_GET['type'];?>'>
  <center>
  <!-- <input type="submit" name="submit" value="Go"/> -->
 <!-- <br /> -->
 <?php
 if($_SESSION['modif_cat_failed'] == FALSE)
 {
  echo "<p> Name already taken or empty</p>";
 }
 if($_SESSION['modif_cat_price_failed'] == FALSE)
 {
  echo "<p> C'mon.... [0-9]</p>";
 }
 if($_SESSION['modif_cat'] == FALSE)
 {
  echo '<label for="modif_cat">New Name : </label> 
            <input type="text" name="modif_cat" id="modif_cat" />
           <input type="submit" name="modif_ok" value="OK" class="text"/><center>  ';
 }
 else if ($_SESSION['modif_cat_price'] == FALSE)
 {
  echo '<label for="modif_cat">New Price : </label> 
            <input type="text" name="modif_cat_price" id="modif_cat" />
           <input type="submit" name="modif_ok_price" value="OK" class="text"/><center>  ';
 }
 else
 {
 echo '<input type="submit"  name="delete" value="Delete" class="text"/><center>
 <input type="submit" name="modif_name" value="Modif Name" class="text"/><center>
 <input type="submit" name="modif_price" value="Modif Price" class="text"/><center> ';
}
 ?>
</form> 
</article>
</div>
</body>
</html>