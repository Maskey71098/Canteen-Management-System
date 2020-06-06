<?php
session_start();
require 'database.php';
$_SESSION["dashboard"]=FALSE;
$_SESSION["tables"]=FALSE;
$_SESSION["user"]=FALSE;
$_SESSION["items"]=FAlSE;
$_SESSION["searchorder"]=TRUE;
$error="";
$total=0;
$count=0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" > <!-- do not remove this yesle icon deako ho table edit ko lagi!!!-->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->

</head>

<body class="">
  <div class="wrapper ">
    <?php
		include("sidebar.php");
	?>
    <div class="main-panel" style="height:100%">
      <!-- Navbar -->
    <?php
		include("navbar.php");
	?>
      <!-- End Navbar -->
	  
      <div class="content " style="height:100%">
        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title text-center">Search from today's orders</h5>
                </div>
                <div class="container pt-4">
                <form  action="searchorder.php" method="POST">
                  <div class="row">
                    <div class="col-md-6 offset-md-3">
                      <div class="form-group">
                        <input  class="form-control" placeholder="Order no." name="orderno" value="<?php if(isset($_POST['search']) && isset($_POST['orderno'])){echo htmlentities($_POST['orderno']);}?>">
                      </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-round" name="search">Search</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                <h5 class="font-weight-light"> OR </h5>
                </div>
            </div>
            <div class="card-header">
                    <h5 class="card-title text-center">Search from time</h5>
                </div>
                <div class="container pt-4">
                <form  action="searchorder.php" method="POST">
                  <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                    <form action="" method="POST">
                        <span> Select a time to search orders: </span>
                        <select name="time_selecter">
                        <option selected disabled>Select time</option>
                    <?php
                    $sql = "SELECT * FROM times_col";
                        if($mysqli->query($sql)){
                            $result=$mysqli->query($sql);
                        while($row = $result->fetch_assoc()){
                        
                    ?>
                    <option value="<?= $row['time_id'] ?> "><?= $row['time_of_order'] ?></option>
                    <?php }
                    }else{
                        echo "Sorry cannot connect to database at this moment";
                        } 
                    ?>
                    </select><br>
                    </div>
                 </div>
                 <div class="row pt-4">
                    <div class="col-md-6 offset-md-3 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-round" name="searchbytime">Search</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <?php
                if(isset($_POST['searchbytime'])){
                        if(!empty($_POST['time_selecter'])){
                            $tid=$_POST['time_selecter'];
                            $sql="SELECT * from orders where time_id='$tid'AND date_of_purchase=CURDATE() AND completed=0";
                            $resultbytime=$mysqli->query($sql);
                            if($resultbytime->num_rows == 0){
                                $error=$error."<br> No any orders on that time.";
                            }
                        }else{
                            $error=$error."<br> Time cannot be left empty";
                        }
                }
                if(isset($_POST['search'])){
                    if(!empty($_POST['orderno'])){
                        $oid=$mysqli->escape_string($_POST['orderno']);
                        $check=numbercheck($oid);
                        if($check){
                            $sql="SELECT * from orders WHERE orderid='$oid' AND date_of_purchase=CURDATE() AND completed=0";
                            $result=$mysqli->query($sql);
                            if($result->num_rows != 0){
                                $sql="SELECT * from orderdetails where orderid='$oid'";
                                $resultnew=$mysqli->query($sql);
                            }else{
                                $error=$error."<br>Sorry, No such order with that order number today.";
                            }
                            
                        }else{
                            $error=$error."<br>Input not valid. Must be number.";
                        }
                    }else{
                        $error=$error."<br>Order number cannot be empty";
                    }
                }
                if(isset($_GET['action']) && $_GET['action'] == "confirm"){
                        $oid = $_GET['id'];
                        $sql="UPDATE orders
                         SET completed=1
                         WHERE orderid='$oid';
                        ";
                        if($mysqli->query($sql)){?>
                                <div class="container pt-4 pb-5">
                        <div class="row text-center">
                            <div class="col-md-6 offset-md-3">
                               <h5> Marked as completed </h5>
                            </div>
                        </div>
                    </div>    
                        <?php }else{
                                $error=$error. "Couldnt connect to server."
                            ?>
                        <?php }
                }
                if(empty($error) && isset($_POST['searchbytime'])){?>
                <div class="container">
                <h5 class="font-weight-normal">Pending order with given time: </h5>
                </div>
                <?php
                                
                                while($row=$resultbytime->fetch_assoc()){ $total=0;$count++;$orderid=$row['orderid'];?>
                                  
                    
                    <div class="container">
                        <div class="row">
                        <div class="col-md-12 col-sm-12 pt-1">
                          <div class="table-responsive">
                                
                                Order no: <?= $count ?> with order id: <?= $orderid ?>
                                  <table class="table table-bordered">
                                      <tr>
                                          <th  class="font-weight-light" >Item name</th>
                                          <th  class="font-weight-light">Quantity</th>
                                          <th  class="font-weight-light">Price</th>
                                      </tr>
                                      <?php 
                                      $sqlinside="SELECT * from orderdetails where orderid=$orderid";
                                      $insidequery=$mysqli->query($sqlinside) or die($mysqli->error);
                                      while($insiderow=$insidequery->fetch_assoc()){?>
                                        
                                        <tr>
                                            <td><?= $insiderow['item_name'] ?></td>
                                            <td><?= $insiderow['quantity'] ?></td>
                                            <td><?= $insiderow['price'] ?></td>
                                        </tr>
                                      <?php 
                                        $total = $total + $insiderow['quantity']*$insiderow['price'];
                                        } ?>
                                        <tr>
                                            <td colspan="2" align="right">Total</td>
                                            <td align="left">Rs <?php echo number_format($total, 2); ?></td>
                                        </tr>
                                     </table>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 offset-md-3 text-center">
                                    <a href="searchorder.php?action=confirm&id=<?= $orderid ?>" class="btn btn-danger btn-round" role="button">Mark as complete</a>
                                </div>
                            </div>
                            <?php } ?>
                    </div>
                  <?php  }
                if(empty($error) && isset($_POST['search'])){?>
                <div class="container">
                    <div class="row">
                    <div class="col-md-12 col-sm-12 pt-1">
                      <div class="table-responsive">
                            <h5 class="font-weight-normal">Pending order with order id: <?= $oid ?></h5>
                              <table class="table table-bordered">
                                  <tr>
                                      <th  class="font-weight-light" >Item name</th>
                                      <th  class="font-weight-light">Quantity</th>
                                      <th  class="font-weight-light">Price</th>
                                  </tr>
                                  <?php while($row=$resultnew->fetch_assoc()){?>
                                    <tr>
                                        <td><?= $row['item_name'] ?></td>
                                        <td><?= $row['quantity'] ?></td>
                                        <td><?= $row['price'] ?></td>
                                    </tr>
                                  <?php 
                                    $total = $total + $row['quantity']*$row['price'];
                                    } ?>
                                    <tr>
                                        <td colspan="2" align="right">Total</td>
                                        <td align="left">Rs <?php echo number_format($total, 2); ?></td>
                                    </tr>
                                 </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3 text-center">
                                <a href="searchorder.php?action=confirm&id=<?= $oid ?>" class="btn btn-danger btn-round" role="button">Mark as complete</a>
                            </div>
                        </div>
                </div>
              <?php  }
                else{?>
                    <div class="container pt-4 pb-5">
                        <div class="row text-center">
                            <div class="col-md-6 offset-md-3">
                                <?= $error ?>
                            </div>
                        </div>
                    </div>    
                 <?php  }
            ?>
            </div>   
        </div>
    </div>
</div>
</body>
</html>
<?php
function numbercheck($number){
    if(!is_numeric($number)){
        return false;
    }else{
        return true;
    }
}
?>
               
            
