<?php
    session_start();
    if (($_SESSION['luserin'])==true){
    include 'prices.php';  
    include 'assets/phpqrcode/qrlib.php';
    $email=$_SESSION['email'];
    $sql="SELECT userid,balance from users WHERE email='$email'";
    $queryresult=$mysqli->query($sql);
    $result=$queryresult->fetch_assoc();
    $userid=$result['userid'];
    $balance=$result['balance'];
    $completed=0;
    $total=$_SESSION['total'];
    
    $time_id=$_POST['time_selecter'];
    $sqlnew="INSERT INTO orders(userid,date_of_purchase,totalmoney,completed,time_id) VALUES($userid,CURDATE(),$total,$completed,$time_id)";
    if($mysqli->query($sqlnew)){
        $orderid=$mysqli->insert_id;
        foreach($_SESSION["shopping_cart"] as $keys => $values){
            $itemname=$values['item_name'];
            $price=$values["item_price"];
            $quantity=$values["item_quantity"];
            $sqllast="INSERT INTO orderdetails(orderid,item_name,quantity,price)"."VALUES($orderid,'$itemname',$quantity,$price)";
            if($mysqli->query($sqllast)){
                $left=$balance-$total;
                $_SESSION['balance']=$left;
                $sql="UPDATE users 
                SET balance = $left
                WHERE userid = '$userid'";
                 if($mysqli->query($sql)){
                    $sql="UPDATE users 
                    SET balancespent = balancespent + $total
                    WHERE userid = '$userid'";
                    if($mysqli->query($sql)){

                        $_SESSION['count']=1;
                    }else{echo "$mysqli->error();";}
                 }else{
                     echo "$mysqli->error();";
                }
            }else{
                echo "$mysqli->error();";  
            }
    }
    }else{
        echo "$mysqli->error();";
    } 
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
        background-image: url(assets/images/g1.jpg);
        background-position: center;
        background-repeat: no-repeat;
        background-size: initial;
      }
      .contains{
        background-color: white;
        -webkit-box-shadow:0px 9px 40px -12px rgba(0,0,0,0.75);
        -moz-box-shadow:0px 9px 40px -12px rgba(0,0,0,0.75);
        box-shadow:0px 9px 40px -12px rgba(0,0,0,0.75);
      }
      .holder{
          margin-top: 3.5%;
          opacity: 1;
          margin-bottom: 3%;
          postion:absolute;
         
      }
  </style>
</head>
<body>
<div class="container-fluid holder">
        <div class="col-md-6 offset-3 pt-3 rounded contains">
            <div class="row">
                <div class="col-md-4 offset-4 text-center"><img src="assets/images/cart.png" height="90" width="90"></div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-2 pt-2 order">
                    <h2 class="font-weight-normal text-center">Thank you for your order</h1>
                </div>
            </div>
            <br>
            <span>Your order no is: <?= $orderid ?></span>
            <br>
            <span>Date: <?= Date('F,j,Y') ?></span><br>
            <br>
            <span> You can either remember your order id or save this qr code to get your order in your respective canteen. </span>
            <?php 
                QRcode::png($orderid, 'assets/images/qrcode/qr'.$orderid.'.png');
                $location="assets/images/qrcode/qr".$orderid.".png"
            ?>
            <div class="row mb-5">
                <div class="col-md-6 offset-3 text-center"> 
                        <img src="<?= $location ?>">
                </div>
            </div>
            <div class="row text-center pb-5">
                <div class="col-md-12 text-center">
                    <a href="menu.php?action=rollback" class="btn btn-info btn-rounded" role="button">Continue</a>
                </div>
            </div>
        </div>
</div>  
<body>
</html> 
<?php
}else{
  session_destroy();
  header("location:error.php");
}
?>