<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<style>
    <?php include "style.css" ?>
</style>
<head>
<title>Registration system PHP and MySQL</title>
</head>
<body>
<div class="headermain">
    <a href="men.php">Męskie</a>
    <a href="women.php">Damskie</a>
    <a href="kid.php">Dziecięce</a>
    <a>Help</a>
     <a href="cart.php?page=cart">Koszyk
     </a>
    <div>
     <?php  if (isset($_SESSION['username'])) : ?>
        	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
        <?php endif ?></div>
</div>
<div class="row">
  <a href="men.php"><div class="column1"></div></a>
  <a href="women.php"><div class="column2"></div></a>
  <a href="kid.php"><div class="column3"></div></a>
</div>
</body>
</html>