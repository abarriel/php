<?php
include('auth.php');
session_start();
if(search_type($_SESSION['loggued_on_user']) != 'admin')
	header("Location: index.php");
$file = "private/passwd";
$user = unserialize(file_get_contents($file));
   include("header.php");
   include("menu_admin.php");
?>
<!DOCTYPE html>
<html>
<table width="100%" class="text" border="1px">
<?php
	 echo "<tr>";
     echo "<td>Login</td>";
     echo "<td>User Type</td>";
     echo "<td>Date of Creation</td>";
    echo "</tr>";
	 foreach ($user as $key => $value) {
	 echo "<tr>";
     echo "<td><a href='admin_user.php?login=".$value['login']."'>".$value['login']."</a></td>";
     echo "<td>".$value['type']."</td>";
     echo "<td>".date("Y-m-d H:i:s", $value['time'])."</td>";
    echo "</tr>";
	}
?>
</table>
</article>
</div>
</body>
</html>