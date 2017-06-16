<?php
session_start();
if (!$_GET['change'] == 'OK')
{
if ($_SESSION['user_type'] == 'admin')
  header("Location: admin.php");
}
$user_login = $_SESSION['loggued_on_user'];
if ($_POST['newpw'] != $_POST['re_newpw'])
{
  $_SESSION['not_same_new_passwd'] = TRUE;
   header('Reload: account.php');
}
else if($_POST['newpw'] && $_POST['oldpw'] && $_POST['submit'] == 'OK')
{
  $file = "private/passwd";
  $passwdhashed = hash('sha224', $_POST['oldpw']);
  $user = unserialize(file_get_contents($file));
    foreach ($user as $key => $value) {
      switch ($value['login']) {
        case $_SESSION['loggued_on_user'];
          {
            if ($passwdhashed != $value['passwd'])
            {
                $_SESSION['not_same_old_passwd'] = TRUE;
                header('Reload: account.php');
               break ;
            }
            $passwdhashed = hash('sha224', $_POST['newpw']);
            $user[$key] = array('login'=>$_SESSION['loggued_on_user'],'passwd'=>$passwdhashed,'type'=>$value['type'],'time'=>$value['time']);
            file_put_contents($file, serialize($user));
             $_SESSION['changed_passwd_succes'] = TRUE;
              header('Reload: account.php');
           }
          break;
      }
    }
}
if(isset($_POST['delete']))
{
  $file = "private/passwd";
  $user = unserialize(file_get_contents($file));
 foreach ($user as $key => $value)
 {
      switch ($value['login'])
      {
        case $user_login;
          {
            unset($user[$key]);
            file_put_contents($file, serialize($user));
            header('Location: logout.php');
           }
          break;
      }
  }
}
include("header.php");
?>
<!DOCTYPE html>
<html>
<article>
<form action="account.php" method="post" class="text">
          <h1>Hello <?php echo $_SESSION['loggued_on_user']." - ".$_SESSION['user_type']?> !</h1>
                 <p id="center">
               <h3>Change your password</h3>
            <label for="oldpw">Your password:</label> 
            <input type="password" name="oldpw" id="oldpw" placeholder="Old Password" /> 
              <br />
              <label for="newpw">New password:</label> 
            <input type="password" name="newpw" id="newpw" placeholder="New Password"  /> 
            <br />
              <label for="re_newpw">Repeat the new password:</label> 
            <input type="password"  name="re_newpw" id="re_newpw" placeholder="Repeat New Password" /> 
               <?php
                if ($_SESSION['not_same_new_passwd'] == TRUE)
                {
                echo "<p><i>Tips: The password aren't the same</i></p>";
                $_SESSION['not_same_new_passwd'] = FALSE;
                }
               /*echo "<p><i>Tips: The password aren't the same</i></p>";*/
               if ($_SESSION['not_same_old_passwd'] == TRUE)
               {
               echo "<p><i>Tips: Your password actually didn't match with your account</i></p>";
               $_SESSION['not_same_old_passwd'] = FALSE;
                }
                if ($_SESSION['changed_passwd_succes'] == TRUE)
               { 
                echo "<p><i>Your password has been succesfully changed!! Go shop now!!</i></p>";
                $_SESSION['changed_passwd_succes'] = FALSE;
                }
              
              ?>
              <input type="submit" name="submit" value="OK" />
          </p>
          <input type="submit"  name="delete" value="Delete"/>
    </form>
</article>
</div>
</body>
</html>