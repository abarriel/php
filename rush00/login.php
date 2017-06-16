<?php
session_start();
include('auth.php');
$file = "private/passwd";
if(isset($_SESSION['log']) && isset($_SESSION['pass']))
{
$_POST['login'] = $_SESSION['log'];
$_POST['passwd'] = $_SESSION['pass'];
unset($_SESSION['pass']);
unset($_SESSION['log']);
}
if(!file_exists($file) && $_POST['login'] && $_POST['passwd'])
{
  $_SESSION['empty'] = TRUE;
}
else if ($_POST['login'] && $_POST['passwd'] && auth($_POST['login'],$_POST['passwd']))
{
  $_SESSION['loggued_on_user'] = $_POST['login'];
  $_SESSION['user_type'] = search_type($_SESSION['loggued_on_user']);
  header("Location: index.php");
}
else if(!$_SESSION['loggued_on_user'])
  $_SESSION['loggued_on_user'] = "";
include('header.php');
?>
<!DOCTYPE html>
<html>
<article>
<?PHP 
// $_SESSION['loggued_on_user'] = "";

echo $_SESSION['loggued_on_user'];
if ($_SESSION['loggued_on_user'])
{
echo "<p class='text' id='center'>You are already register.".$_SESSION["loggued_on_user"]."
<BR /><BR />
<a class='text' href='index.php' class='menu' >Go to index </a></p>";
exit();
}

if ($_SESSION['empty'] === TRUE)
{
echo "<p class='text' id='center'>No one was ever register on ours server, you are the first!!
<BR /><BR />
<a class='text' href='register.php' class='menu' >Go to Register </a></p>";
$_SESSION['empty'] = FALSE;
exit();
}
?>
<form action="login.php" method="post" class="text">
        <h1>Identifiant</h1>
          <p id="center">
            <label for="login" >Login : </label> 
            <input type="text" name="login" id="login" />
          </p>
          <p id="center">
            <label for="passwd">Password : </label> 
            <input type="password" name="passwd" id="passwd" /> 
             <!-- <br /> -->
              <?PHP
               if($_POST['login']  && $_SESSION['loggued_on_user'] == "")
                 echo "<p><i>Tips: Your account wasn't found on our server please retry!</i></p>";
              ?>
             <input type="submit" name="submit" value="OK" />
          </p>
    </form>
</form>
</article>
</div>
</body>
</html>