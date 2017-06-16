<?php
session_start();
date_default_timezone_set('CET');
 if(!file_exists("data/"))
{
  echo "<img src='https://slack-imgs.com/?c=1&url=https%3A%2F%2Fimgs.xkcd.com%2Fcomics%2Finstalling.png'>";
  echo "<br /><br /><br /><h3>In case you didn't understand, please set everything up using install.php<h3>";
  exit;
}
include('basket_tools.php');
?>
<head>
  <meta charset="utf-8">
  <link rel="icon" href="install_files/oscar.ico" />
  <link rel="stylesheet" type="text/css" href="css/all.css">
  <title>42 Movies</title>
</head>
<body>
<div id="center">
<header>
    <a href="index.php" class="menu">Boutique</a>
<?php
    if($_SESSION['loggued_on_user'])
    {
    echo "<a href='account.php' class='menu'>Account</a>";
    echo "<a href='logout.php' class='menu'>Sign out</a>";
    }
    else
    {
    echo "<a href='login.php' class='menu'>Sign in</a>";
    echo "<a href='register.php' class='menu'>Register</a>";
    }
    echo '<a href="basket.php" class="menu">Basket';
    if(isset($_SESSION['basket']))
      {
        echo "(".count($_SESSION['basket']).")";
      }
    echo "</a>";
    ?>
</header> 
