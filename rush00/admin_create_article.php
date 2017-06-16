<?php
include('auth.php');
include('categories.php');
session_start();
if(search_type($_SESSION['loggued_on_user']) != 'admin')
	header("Location: index.php");
$file = "data/articles";
$_SESSION['article_fail'] = "toto";
$_SESSION['price_not_numeric'] = "toto";
if (($_POST['submit'] == "Create Article") && $_POST['categorie'] && $_POST['name'] && $_POST['price'])
{
  if($_POST['img'] == "")
    $_POST['img'] = "https://media.senscritique.com/media/000012241934/120/Orange_mecanique.jpg";
  if ($tab = explode(":",$_POST['categorie']))
  {
    foreach ($tab as $key => $value) {
      if(empty($value))
       {
            $_SESSION['article_fail'] = FALSE;
            goto end;
             }
    }
  }
  $_POST['name'] = trim($_POST['name']);
  if (!is_numeric($_POST['price']) || strstr($_POST['name'], '&'))
  {
    $_SESSION['price_not_numeric'] = TRUE;
    goto end;
  }
  if(!file_exists("data/"))
       mkdir("data/");
  if (file_exists($file))
  {
        $article = unserialize(file_get_contents($file));
        if(!empty($article))
        {
        foreach ($article as $key => $value) {
          if($value['name'] == $_POST['name'])
           {
            $_SESSION['article_fail'] = FALSE;
            goto end;
             }
         }
       }
    $article[$key + 1] = array('name'=>$_POST['name'],'categorie'=> $_POST['categorie'], 'price' => $_POST['price'], 'img' => $_POST['img']);
    file_put_contents($file, serialize($article));
    header('Location: admin_manage_articles.php');
  }
  else
    {
    $article = array(array('name'=>$_POST['name'],'categorie'=> $_POST['categorie'], 'price' => $_POST['price'], 'img' => $_POST['img']));
    file_put_contents($file, serialize($article),  FILE_APPEND | LOCK_EX);
   header('Location: admin_manage_articles.php');
    }
  }
  // else
  //   $_SESSION['article_fail'] = FALSE;
end:
include('header.php');
include('menu_admin.php');
?>
<!DOCTYPE html>
<html>
<article class="text">
<form action="admin_create_article.php" method="post" class="text">
        <h1>New Article:</h1>
          <p id="center">
            <label for="name" >Name : </label> 
            <input type="text" name="name" id="name" placeholder="   Type Name here"  />
            <br />
             <label for="name" >Price: </label> 
            <input type="text" name="price" id="price" placeholder="       XX,XX or XX"  />
            <br />
            <label for="name" >Thumbnail:  </label> 
            <input type="text" name="img" id="img" size="35" style="height:25px;" placeholder="   Insert URL here"  />
            <br />
            <br /> 
            <span id="comments">If you want to add more than 1 category (3 max) use this template : "Category1:Category2:Category3"</span>
            <br />
            <input type="text" name="categorie" id="categorie" placeholder="   Type Category here" /> 
              <?PHP
               if($_SESSION['article_fail'] == FALSE)
                 echo "<p><i>Tips: An article was already created with the same name</i></p>";
              if($_SESSION['price_not_numeric'] === TRUE)
              {
                 echo "<p><i>Tips: Price are not a valid number</i></p>";
                $_SESSION['article_fail'] = FALSE;
              }
              ?>
            <br />
            <input type="submit" name="submit" value="Create Article" />
          </p>
    </form>
</article>
</div>
</body>
</html>