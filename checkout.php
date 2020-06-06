<?php
session_start();
if (($_SESSION['luserin'])==true){
include 'prices.php';
?>
<!DOCTYPE html>
<html>
<title>Checkout</title>
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/bootstrap/css/glyicon.css">
  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <style>
      body{
          background-image:url(assets/images/g1.jpg);
          background-size:cover;
      }
      .holder{
          margin-top: 3.5%;
          opacity: 1;
          margin-bottom: 3%;
         
      }
      .contains{
        background-color: white;
        -webkit-box-shadow:0px 9px 40px -12px rgba(0,0,0,0.75);
        -moz-box-shadow:0px 9px 40px -12px rgba(0,0,0,0.75);
        box-shadow:0px 9px 40px -12px rgba(0,0,0,0.75);
      }
      .order{
          background-color: black;
          border-radius: 0px     30px      30px           0;
      }
  </style>
</head>
<body>
    
    <?php 
        $email=$_SESSION['email'];
        $sql="SELECT * from users where email='$email'";
        $queryresult=$mysqli->query($sql);
        $result=$queryresult->fetch_assoc();
        $balance=$result['balance'];
        $_SESSION['balance']=$balance;
    ?>
    <div class="container-fluid holder">
        <div class="col-md-6 offset-md-3 pt-3 rounded contains">
            <div class="row">
            <div class="col-md-6 col-sm-3 p-2   order">
                <h1 class="font-weight-light text-white">YOUR ORDER</h1>
            </div>
            </div>
            <br>
                <span>Name: <?=ucfirst($_SESSION['first_name'])." ".ucfirst($_SESSION['last_name'])?></span><br>
                <span>Date: <?= Date('F,j,Y') ?></span><br>
                <span>Canteen: <?= ucfirst($_SESSION['canteenname']);?></span><br>
                <span>Balance: Rs <?= $balance?></span><br>                 
                <form action="finalconfirm.php" method="POST">
                <span> Select a time for your order: </span>
                <select name="time_selecter">
                <option value="10 am" selected disabled>Select time</option>
                    <?php 
                        $sql = "SELECT * FROM times_col";
                        if($mysqli->query($sql)){

                            $result=$mysqli->query($sql);
                        while($row = $result->fetch_assoc()){
                                print_r($row)
                        
                    ?>
                    <option value="<?= $row['time_id'] ?> "><?= $row['time_of_order'] ?></option>
                        <?php }
                    }else{
                        echo "Sorry cannot connect to database at this moment";
                        } 
                        ?>
                
                </select><br>
                <div class="row pt-2">
                    <div class="col-md-6 offset-md-3 d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary" name="confirmBtn" id="confirmBtn">Confirm Order</button>
                    </div>
                 </div>
                </form>
                <?php 
                if(!empty($_SESSION["shopping_cart"]))
                {
                ?>
                        <div class="table-container pt-2">
                        <h4 class="font-weight-light">Order Details</h4>
                        <span class="text-danger" id="notenough"></span>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%" class="font-weight-light" >Item Name</th>
                                    <th width="10%" class="font-weight-light">Quantity</th>
                                    <th width="20%" class="font-weight-light">Price</th>
                                    <th width="15%" class="font-weight-light">Total</th>
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
                                </tr>
                                <?php
                                        $total = $total + ($values["item_quantity"] * $values["item_price"]);
                                        $_SESSION['total']=$total;
                                    }
                                    if($total>$balance){
                                        ?>
                                        <script>
                                            document.getElementById("confirmBtn").disabled=true;
                                            document.getElementById("notenough").textContent='Not enough balance, Please edit your order from below.'; //.innerhtml didnt work
                                        </script>
                                        <?php
                                    }
                                ?>
                                <tr>
                                    <td>Total</td>
                                    <td align="right">Rs <?php echo number_format($total, 2); ?></td>
                                    <td colspan="2" align="center" id="editorder"><a href="menu.php">Edit Order</a></td>
                                </tr>
                            </table>
                        </div>
                <?php
                     }
                ?>  
            </div>
    </div>
</body>
</html>
<?php 
}else{
  session_destroy();
  header("location:error.php");
}
?>