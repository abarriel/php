<?php
session_start();
// setcookie($_GET['name'], '', time() - 3600);
$_SESSION['loggued_on_user'] = "";
session_destroy();
header("Location: index.php");
?>
