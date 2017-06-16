<?php
include('auth.php');
session_start();
if(search_type($_SESSION['loggued_on_user']) != 'admin')
	header("Location: index.php");
if($_SESSION['loggued_on_user'] == $_GET['login'])
	header("Location: admin.php");
$user_login = $_GET['login'];
if (isset($_POST['user_type']))
{
	$pass = search_passwd($_GET['login']);
	$file = "private/passwd";
	$user = unserialize(file_get_contents($file));
 foreach ($user as $key => $value)
 {
      switch ($value['login'])
      {
        case $user_login;
          {
            $user[$key] = array('login'=>$user_login,'passwd'=>$pass,'type'=>$_POST['user_type'],'time'=>time());
            file_put_contents($file, serialize($user));
            header('Reload: admin_user.php?login=$user_login');
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
            header('Location: admin.php');
           }
          break;
      }
  }
}
  include("header.php");
?>
<!DOCTYPE html>
<html>
<article class="text">
<p>
	Account "<?php echo $_GET['login'];?>"
	is a "<?php echo search_type($_GET['login']);?>"
</p>
<form method='post' action='admin_user.php?login=<?php echo $user_login;?>'>
<select name="user_type" id ="user_type">
	<option selected disabled>Choose here</option>
 	<option value="admin">Admin</option>
 	<option value="customer">Customer</option>
 </select>
 <input type="submit" name="submit" value="Go"/>
 <br />
 <input type="submit"  name="delete" value="Delete"/>
</form> 
</article>
</div>
</body>
</html>