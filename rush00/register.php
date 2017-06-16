<?php
session_start();
if($_POST['re_passwd'] != $_POST['passwd'])  
{
  $_SESSION['same'] = FALSE;
  header('Reload: index.php');
}
else
  $_SESSION['same'] = TRUE;

 if ($_POST['login'] && $_POST['passwd'] && $_POST['re_passwd'] && $_POST['submit'] == 'OK' && $_SESSION['same'] == TRUE)
{
  if($_POST['login'] == "" || strstr($_POST['login'], ',') || strstr($_POST['login'], ':') || strstr($_POST['login'], '&' || strstr($_POST['login'], '=')))
  {
      $_SESSION['already'] = TRUE;
      header('Reload: index.php');
      goto end;
    }
  if(strlen($_POST['passwd']) < 8)
  {
  $_SESSION['not_good_len'] = TRUE;
  header('Reload: index.php');
  goto end;
  }
  $file = "private/passwd";
  if(!file_exists("private/"))
    mkdir("private/");
  $passwdhashed = hash('sha224', $_POST['passwd']);
  if (file_exists($file))
  {
    $user = unserialize(file_get_contents($file));
    foreach ($user as $key => $value) {
      if($value['login'] == $_POST['login'])
      {
      $_SESSION['already'] = TRUE;
      header('Reload: index.php');
      goto end;
      }
    }
    $user[$key + 1] = array('login'=>$_POST['login'],'passwd'=>$passwdhashed, 'type' => 'customer','time'=> time());
    file_put_contents($file, serialize($user));
   $_SESSION['succes'] = TRUE;
   $_SESSION['log'] = $_POST['login'];
  $_SESSION['pass'] = $_POST['passwd'];
  header('Location: login.php');
  }
  else
  {
  $user = array(array('login'=>$_POST['login'],'passwd'=>$passwdhashed, 'type' => 'customer','time'=> time()));
  file_put_contents($file, serialize($user),  FILE_APPEND | LOCK_EX);
  $_SESSION['succes'] = TRUE;
  $_SESSION['log'] = $_POST['login'];
  $_SESSION['pass'] = $_POST['passwd'];
  header('Location: login.php');
  }
}
end:
;
include('header.php');
?>
<!DOCTYPE html>
<html>
<article>
<?PHP 
if ($_SESSION['succes'] === TRUE)
{
echo "<p class='text' id='center'>Account Succesfully created !!!
<BR /><BR />
<a class='text' href='login.php' class='menu' >Go to Sign in </a></p>";
$_SESSION['succes'] = FALSE;
exit();
}
?>
<form action="register.php" method="post" class="text">
        <h1>New Account:</h1>
          <p id="center">
            <label for="login" >Login : </label> 
            <input type="text" name="login" id="login" />
          </p>
          <p id="center">
            <label for="passwd">Password : </label> 
            <input type="password" name="passwd" id="passwd" /> 
            <br />
            <label for="re_passwd">Repeat your password: </label> 
            <input type="password" name="re_passwd" id="re_passwd" /> 
            <!-- <br /> -->
              <?PHP
               if($_SESSION['same'] === FALSE)
                 echo "<p><i>Tips: The password aren't the same</i></p>";
              if($_SESSION['not_good_len'] == TRUE)
              {
                 echo "<p><i>Tips: The password need to add 8 or more character</i></p>";
                $_SESSION['not_good_len'] = FALSE;
              }
              if($_SESSION['already'] === TRUE)
              {
                 echo "<p><i>Tips: An Account was already created with the same login</i></p>";
                $_SESSION['already'] = FALSE;
              }
              ?>
            <input type="submit" name="submit" value="OK" />
          </p>
    </form>
</form>
</article>
</div>
</body>
</html>