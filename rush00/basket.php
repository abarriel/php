<?php
session_start();
include('auth.php');
include('header.php');
include('archive_basket.php');
if ($_POST['delete_item'])
{
  $items = $_SESSION['basket'];
  // print_r($_SESSION['basket']);
  // echo $_POST['delete_item'];
  foreach ($items as $key => $value) {
    if($value['name'] == $_POST['delete_item'])
    {
        unset($items[$key]);
        break;

    }
  }
  $_SESSION['basket'] = $items;
}
if ($_POST['archive'])
{
 archive_basket(); 
}
?>
<!DOCTYPE html>
<html>
<article>
<div id="basket_itmes">
<form method="POST" action="basket.php"> 
<?php
    $items = $_SESSION['basket'];
    if(!empty($items))
    { 
         // $items = sort_items($items);
         $_SESSION['basket'] = $items;
        foreach ($items as $key => $item) {
        echo "<div class='item'>";
        echo "<span class='item_name'>".$item['name']."&nbsp;&nbspx1&nbsp;&nbsp;&nbsp".$item['price']."$"."</span>";
        echo "<button type='submit' id='delete_item' name='delete_item' value='".$item['name']."'>Delete item/s</button>";
        echo "</div>";
    }
    echo "<p class='item_name'>"."Total Article: ".count($items)." - Total prix: ".count_items_price($items)."$  ";
    if($_SESSION['loggued_on_user'] == '')
    {
        echo "<span class='item_name'>Please register or login for validate your basket </span>";
    }
    else
       echo "<button type='submit' id='archive' name='archive' value='".$item['name']."'> Valide Basket</button>"."</p>";
  }
?>
</form>
</div>
</article>
</div>
</body>
</html>