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

<?php
  if(isset($_GET['p']))
  {
    $db = mysqli_connect('localhost', 'root', '', 'sklep');
    $id=$_GET['p'];
    $query="SELECT * FROM `produkt` WHERE `Id_produktu`='$id'";
    $result = mysqli_query($db, $query);
    $product=mysqli_fetch_row($result);
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

    <img src="imgs/<?=$product[5]?>" style="float:left;width:45%;height:500px; alt="<?=$product[4]?>">
    <div class="info">
        <h1 class="namep"><?=$product[4]?></h1>
        <span>
            &dollar;<?=$product[1]?>
        </span>
        <form action="addtocart.php?id=<?php echo $product[0]; ?>" method="post">
        <input type="number" name="quantity" value="1" min="1" max="<?=$product[7]?>" placeholder="Quantity" required>
        <input type="hidden" name="product_id" value="<?=$product[0]?>">
        <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product[6]?>
        </div>
    </div>
</div>
</body>
