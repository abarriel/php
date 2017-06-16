<?php
date_default_timezone_set('CET');
include('auth.php');
session_start();
if(search_type($_SESSION['loggued_on_user']) != 'admin')
	header("Location: index.php");
$file = "./private/basket";
$user = unserialize(file_get_contents($file));
   include("header.php");
   include("menu_admin.php");
?>
<!DOCTYPE html>
<html>
<table width="100%" class="text" border="1px">
<?php
 
  echo "<tr>";
     echo "<td>Order ID</a></td>";
     echo "<td>Login</td>";
     echo "<td>Total Price</td>";
     echo "<td>Nb of Article</td>";
     echo "<td>Date of the Order</td>";
    echo "</tr>"; 
    if(!empty($user))
  {
	 foreach ($user as $key => $value) {
	 echo "<tr>";
     echo "<td><a href='admin_view_order.php?id=".$value['id']."'>".$value['id']."</a></td>";
     echo "<td>".$value['login']."</td>";
     echo "<td>".$value['price']." $</td>";
     echo "<td>".$value['nb_article']." Article</td>";
     echo "<td>".date("Y-m-d H:i:s", $value['time'])."</td>";
    echo "</tr>";
	}
  }
?>
</table>
</article>
</div>
</body>
</html>