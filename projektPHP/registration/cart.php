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
<title>Men</title>
</head>
<body id="try">

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
</div>
<div class="row1">
	  <table class="table">
	  	<tr>
	  		<th></th>
	  		<th>Nazwa</th>
	  		<th>Cena</th>
	  		<th>Ilosć</th>
	  	</tr>
<?php
$db = mysqli_connect('localhost', 'root', '', 'sklep');
if(isset($_SESSION['cart']))
{
    $items = $_SESSION['cart'];
}
else{$items;}
?>
<?php if (empty($items)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
<?php else: ?>
<?php
$cartitems = explode(",", $items);
$total = '0';
$i=1;
 foreach ($cartitems as $key=>$id) {
	$sql = "SELECT * FROM produkt WHERE Id_produktu = $id";
	$res=mysqli_query($db, $sql);
	$r = mysqli_fetch_assoc($res);
?>
<tr>
	  		<td><img src="imgs/<?=$r['img']?>" style="float:left;width:90%;height:100px; alt="<?=$r['nazwa']?>"></td>
	  		<td><a href="delcart.php?remove=<?php echo $key; ?>">Remove</a> <?php echo $r['nazwa']; ?></td>
	  		<td>$<?php echo $r['Cena']; ?></td>
	  	</tr>
		<?php
			$total = $total + $r['Cena'];
			$i++;
			}
		?>
		<tr>
			<td><strong>Suma</strong></td>
			<td><strong>$<?php echo $total; ?></strong></td>
			<td><a href="placeorder.php" class="btn btn-info">Checkout</a></td>
		</tr>
		<?php endif; ?>
</div>
</body>