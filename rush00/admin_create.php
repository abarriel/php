<?php
include('auth.php');
session_start();
if(search_type($_SESSION['loggued_on_user']) != 'admin')
	header("Location: index.php");
if(!(isset($_POST['user_type'])))
{
	header('Reload: admin_create.php');
}
else if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] == 'OK')
{
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
      header('Location: admin.php');
      goto end;
      }
    }
    $user[$key + 1] = array('login'=>$_POST['login'],'passwd'=>$passwdhashed,'type'=>$_POST['user_type'],'time' => time());
    file_put_contents($file, serialize($user));
        header('Location: admin.php');
  }
  else
  {
  $user = array(array('login'=>$_POST['login'],'passwd'=>$passwdhashed,'type'=>$_POST['user_type'], 'time' => time()));
  file_put_contents($file, serialize($user),  FILE_APPEND | LOCK_EX);
  header('Location: admin.php');
  }
}
end:
;
include('header.php');
?>
<!DOCTYPE html>
<html>
<article class="text">
<form action="admin_create.php" method="post" class="text">
        <h1>New Account:</h1>
          <p id="center">
            <label for="login" >Login : </label> 
            <input type="text" name="login" id="login" />
          </p>
          <p id="center">
            <label for="passwd">Password : </label> 
            <input type="password" name="passwd" id="passwd" /> 
            <br />
              <?PHP
               if($_SESSION['already'] === TRUE)
              {
                 echo "<p><i>Tips: An Account was already created with the same login</i></p>";
                $_SESSION['already'] = FALSE;
              }
              ?>
       <select name="user_type" id="user_type" required>
		<option selected disabled>Choose here</option>
 		<option value="admin">Admin</option>
 		<option value="customer">Customer</option>
 		</select>
            <input type="submit" name="submit" value="OK" />
          </p>
    </form>
</article>
</div>
</body>
</html>