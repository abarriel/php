<?php
session_start();
date_default_timezone_set('CET');
function archive_basket()
{
	$file = "private/basket";
  if(!file_exists("private/"))
    mkdir("private/");
  if (file_exists($file))
  {
    $basket = unserialize(file_get_contents($file));
     if(!empty($basket))
    foreach ( $basket as $key => $value) {
          }
     $basket[$key + 1] = array('login'=>$_SESSION['loggued_on_user'],'id'=>($key + 1), 'basket' => $_SESSION['basket'], 'price' =>count_items_price($_SESSION['basket']), 'nb_article' => count($_SESSION['basket']), 'time' => time());
    file_put_contents($file, serialize( $basket));
  }
  else
  {
  $basket = array(array('login'=>$_SESSION['loggued_on_user'],'id'=>($key + 1), 'basket' => $_SESSION['basket']));
  file_put_contents($file, serialize($basket),  FILE_APPEND | LOCK_EX);
  }
 unset($_SESSION['basket']);
}
?>