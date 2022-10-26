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
    <a href="index.php">Strona główna</a>
    <a href="men.php">Męskie</a>
    <a href>Dziecięce</a>
    <a>Help</a>
    <a href="cart.php">koszyk</a>
    <div>
     <?php  if (isset($_SESSION['username'])) : ?>
        	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
        <?php endif ?></div>
</div>
<div class="row1">
   <form action="" method="GET" id="form1">
   <div class="list-group">

           <h3>Marka</h3>
           <?php
           $db = mysqli_connect('localhost', 'root', '', 'sklep');
           $query="SELECT DISTINCT(Marka) FROM `produkt` WHERE `Id_kategorii`='1' or `Id_kategorii`='4'";
           $result = mysqli_query($db, $query);
           $brands=mysqli_fetch_all($result,MYSQLI_ASSOC);
           foreach($brands as $row)
           {
           $checked = [];
           if(isset($_GET['brands']))
           {
                $checked = $_GET['brands'];
           }
           ?>
           <div class="list-group-item checkbox">
               <label><input type="checkbox" name="brands[]" value="<?php echo $row['Marka']; ?>">
               <?php echo $row['Marka']; ?></label>
           </div>

           <?php
           }
           ?>
           <h5>
                     <button type="submit" class="btn btn-primary btn-sm float-right">Search</button>
              </h5>

    </form>
   </div>
   <div class="show_products">
   <?php
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        if (isset($_GET['p'])) {
          $p = $_GET['p'];
        } else {
          $p = 0;
        }
        $num_products_on_each_page = 9;
        $offset = ($pageno-1) * $num_products_on_each_page;
        $result=mysqli_query($db,"SELECT COUNT(*) FROM produkt WHERE `Id_kategorii`='2' or `Id_kategorii`='4' ORDER BY Id_produktu");
        $total_rows=mysqli_fetch_array($result)[0];
        $total_pages=ceil($total_rows/$num_products_on_each_page);
        $products =mysqli_fetch_all($result,MYSQLI_ASSOC);
        $total_products = mysqli_query($db,"SELECT * FROM produkt");
        $count=mysqli_num_rows($total_products);
        if(isset($_GET['brands']))
        {
            $branchecked = [];
            $branchecked = $_GET['brands'];
            $help=0;
            $d=0;
            foreach($branchecked as $rowbrand)
            {
                 if($help>=9)
                 {
                    $help=0;
                 }
                 $d=$d+$help;
                 $num=$num_products_on_each_page-$help;
                 $res_data = mysqli_query($db,"SELECT * FROM produkt WHERE Marka='$rowbrand' AND `Id_kategorii`='2' or `Id_kategorii`='4' LIMIT $offset,$num");

                 while($row = mysqli_fetch_array($res_data)){
                  $help=$help+1;
                  ?>
                  <div class="product">
                  <a href="product.php?page=product&p=<?=$row['Id_produktu']+$p?>">
                  <img src="imgs/<?=$row['img']?>" width=70% height=70% alt="<?=$product['nazwa']?>">
                  </a>
                  <div>
                  <p class="name"><?=$row['nazwa']?></p>
                  <span class="price">
                   &dollar;<?=$row['Cena']?>
                  </span>
                  </div>
                  </div>
                  <?php
                  }
              }
              $total_pages=ceil($d/$num_products_on_each_page);


        }
        else
        {
            $sql = "SELECT * FROM produkt WHERE `Id_kategorii`='2' or `Id_kategorii`='4' LIMIT $offset,$num_products_on_each_page";
                    $res_data = mysqli_query($db,$sql);
                    while($row = mysqli_fetch_array($res_data)){
                        ?>
                        <div class="product">
                            <a href="product.php?page=product&p=<?=$row['Id_produktu']+$p?>">
                                <img src="imgs/<?=$row['img']?>" width=70% height=70% alt="<?=$product['nazwa']?>">
                            </a>

                            <div>
                                    <p class="name"><?=$row['nazwa']?></p>
                                    <span class="price">
                                        &dollar;<?=$row['Cena']?>
                                    </span>
                        </div>

                        </div>
                        <?php
                    }
        }
   ?>
   <div class="buttons">
                        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                           <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                   </div>
    </div>
</div>


</body>