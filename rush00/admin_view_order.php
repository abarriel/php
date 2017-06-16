<?php
date_default_timezone_set('CET');
include('auth.php');
session_start();
if(search_type($_SESSION['loggued_on_user']) != 'admin')
	header("Location: index.php");
$file = "./private/basket";
$basket = unserialize(file_get_contents($file));
   include("header.php");
   include("menu_admin.php");
?>

<!DOCTYPE html>
<html>
<table width="100%" class="text" border="1px">
<?php
	foreach ($basket as $key => $value) {
		if ($value['id'] == $_GET['id'])
		{
			$this_basket = $value;
			break;
		}
	}
	 echo "<tr>";
     echo "<td>Item</td>";
     echo "<td>Price</td>";
    echo "</tr>";
	 foreach ($this_basket['basket'] as $key => $value)
	 {
	 echo "<tr>";
	 echo "<td>".$value['name']."</td>";
     echo "<td>".$value['price']."</td>";
   	 echo "</tr>";
	}
?>
</table>
</article>
</div>
</body>
</html>