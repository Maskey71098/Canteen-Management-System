<?php
session_start();
if (($_SESSION['luserin'])==true){
require 'prices.php';
if(isset($_GET['action']) && $_GET['action'] =="rollback"){
  $_SESSION["shopping_cart"]=array();
}
if(isset($_POST["checkitout"])){
  header("location:checkout.php");

}

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			array_push($_SESSION['shopping_cart'], $item_array);
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				header("location:menu.php");
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Site made with Mobirise Website Builder v4.10.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="Web Site Creator Description">
  
  <title>Menu</title>
  <link rel="stylesheet" href="assets/menustyle.css">
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" href="assets/bootstrap/css/glyicon.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css">
  <script src="assets/web/assets/jquery/jquerynew.min.js"></script>
  <script src="assets/menujs/menucalculator.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script>
  $(document).ready(function(){
	$(".topBtn").click(function(){
    $('html,body').animate({scrollTop: $(document).height()},800);
    return false;
	});

  });
  </script>
</head>
<body>
  <section class="menu cid-rpZBUwIPTt" once="menu" id="menu1-e">

    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.php">
                         <img src="assets/images/icon-122x122.png" alt="Mobirise" title="" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="index.php">CANTEEN MANAGEMENT SYSTEM</a></span>
            </div>
        </div>
        <div class="col-md-2 col-sm-2 text-left p-0">
        <a href="logout.php" class="btn btn-info btn-rounded" role="button">Logout</a>
        </div>
      </section>
    </nav>
  <div class="topper">
  <div class="row">
    <div class="col-md-6">
        <h1 class="font-weight-light"><?php echo("WELCOME, ".strtoupper($_SESSION['first_name'])) ?></h1>
        <h3 class="font-weight-light"> TODAY'S MENU </h3>
       <span class="font-weight-light"> Your balance is : <?= $_SESSION['balance'] ?> </span>
    </div>
    <?php 
    if(isset($_SESSION["shopping_cart"])&& !empty($_SESSION["shopping_cart"])){
    ?>
    <div class="col-md-3 col-sm-3 font-weight-normal p-0" align="right">
      <button type="button" class="btn btn-outline-secondary topBtn">View Order</button>
    </div>
      <div class="col-md-3 col-sm-3 p-0" align="left">
        <form method="POST" action="menu.php">
        <button type="submit" class="btn btn-outline-success" name="checkitout">Checkout</button>
        </form>
      </div>
    </div>
    <?php
    }
    ?>    
  </div>
</div>

<?php
				$query = "SELECT * FROM items";
        $result = $mysqli->query($query);
        $row_cnt = $result->num_rows;
				if($row_cnt>0)
				{
          ?>
          <div class="container cardholder">
          <div class="row mt-5 d-flex justify-content-center">
          <?php
					while($row =$result->fetch_assoc())
					{
        ?>
        <div class="col-md-3 border rounded card m-1">
				<form method="post" action="menu.php?action=add&id=<?php echo $row["item_id"]; ?>">
					<div align="center">
						<h4 class="font-weight-normal"><?php echo ucfirst($row["itemname"]); ?></h4>
						<h4 class="font-weight-light">Rs. <?php echo $row["price"]; ?></h4>
						<input type="text" name="quantity" value="1" class="form-control" />
						<input type="hidden" name="hidden_name" value="<?php echo $row["itemname"]; ?>"/>
						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-outline-primary" value="Add" />

					</div>
				</form>
        </div>
			<?php
					}
				}
			?>
      </div>
    <?php 
      if(!empty($_SESSION["shopping_cart"]))
      {
      ?>
			<br />
      <div class="container">
			<h3 class="font-weight-normal">Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%" class="font-weight-light" >Item Name</th>
						<th width="10%" class="font-weight-light">Quantity</th>
						<th width="20%" class="font-weight-light">Price</th>
						<th width="15%" class="font-weight-light">Total</th>
						<th width="5%" class="font-weight-light">Action</th>
					</tr>
					<?php
            $total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td class="font-weight-light"><?php echo $values["item_name"]; ?></td>
						<td class="font-weight-light"><?php echo $values["item_quantity"]; ?></td>
						<td class="font-weight-light">Rs <?php echo $values["item_price"]; ?></td>
						<td class="font-weight-light">Rs <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td class="font-weight-light"><a href="menu.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span>Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">Rs <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
				</table>
			</div>
    </div>
  
  <?php
					}
  ?>  
</div>
<section>
<div class="container-fluid bg-dark mt-5">
    <div class="media-container-row align-center mbr-white">
        <div class="col-12">
            <p class="mbr-text mb-0 mbr-fonts-style display-7">
                © Copyright 2019 - All Rights Reserved
            </p>
        </div>
    </div>
</div>
</section>
  
</body>
</html>
<?php 
}else{
  session_destroy();
  header("location:error.php");
}
?>