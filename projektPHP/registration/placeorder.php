<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	$name=$_SESSION['username'];
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php
$name=$_SESSION['username'];
$db = mysqli_connect('localhost', 'root', '', 'sklep');
$items = $_SESSION['cart'];
$cartitems = explode(",", $items);
$total = '0';
$i=1;
 foreach ($cartitems as $key=>$id) {
            $sql = "SELECT * FROM produkt WHERE Id_produktu ='$id'";
            $res=mysqli_query($db, $sql);
            $r = mysqli_fetch_assoc($res);
            $total = $total + $r['Cena'];
 			$i++;
 }
$sql = "SELECT * FROM klient WHERE username='$name'";
$res=mysqli_query($db, $sql);
$k =mysqli_fetch_row($res);
$w=$k[1];
$p=$k[0];
$date=date("Y/m/d");
$query2 = "INSERT INTO zamówienie (Id_kupującego,Cena,Id_adresu,data_zamówienia) VALUES ('$p','$total','$w','$date')";
$es=mysqli_query($db, $query2);

?>
<!DOCTYPE html>
<html>
<style>
    <?php include "style.css" ?>
</style>
<head>
<title>Men</title>
</head>
<body>

<div class="headermain">
    <a href="index.php">Strona główna</a>
    <a href="women.php">Damskie</a>
    <a href="kid.php">Dziecięce</a>
    <a>Help</a>
    <a href="cart.php">koszyk</a>
    <div>
     <?php  if (isset($_SESSION['username'])) : ?>
        	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
        <?php endif ?></div>
<div class="ord">
    <div>
    <h1>TWOJE ZAMÓWIENIE ZOSTAŁO POTWIERDZONE</h1>
    </div>
</div>
