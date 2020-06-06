<?php
session_start();
$_SESSION["dashboard"]=TRUE;
$_SESSION["tables"]=FALSE;
$_SESSION["user"]=FALSE;
$_SESSION["items"]=FAlSE;
$_SESSION["searchorder"]=FALSE;
include 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Panel
  </title>
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
</head>


<body class="">
  <div class="wrapper ">
	<?php
		include("sidebar.php");
	?>
    <div class="main-panel">
    <!-- Navbar -->
    <?php
		include("navbar.php");
	?>
    <!-- End Navbar -->
      <div class="content">
        <div class="row">
		<!-- unnecessary box
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
		
                  <div class="col-5 col-md-4 ">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-globe text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Capacity</p>
                      <p class="card-title">150GB
                        <p>
                    </div>
                  </div>
				  
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Update Now
                </div>
              </div>
			
            </div>
          </div>
		  -->
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <?php 
                      $sql = "SELECT * from orders WHERE date_of_purchase=CURDATE()";
                      $result = $mysqli->query($sql); 
                      if($result->num_rows == 0){
                        $empty = true;
                        }else{
                         $empty = false;
                          }
                        $sql="SELECT sum(totalmoney) from orders WHERE date_of_purchase=CURDATE();";
                        $result=$mysqli->query($sql);
                        
                        $resultarray=$result->fetch_assoc();
                        $total_earned_today=$resultarray['sum(totalmoney)'];
                      ?>
                      <p class="card-category">Revenue</p>
                      <p class="card-title">Rs <?php if(isset($total_earned_today)){echo $total_earned_today;}else{ echo "0";} ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i> Last day
                </div>
              </div>
            </div>
          </div>
		  <!-- Unnecessary box
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-vector text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Errors</p>
                      <p class="card-title">23
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i> In the last hour
                </div>
              </div>
            </div>
          </div>
		  -->
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-favourite-28 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <?php 
                          $sql="SELECT count(userid) from users";
                          $result=$mysqli->query($sql);
                          $resultarray=$result->fetch_assoc();
                          $total_registered=$resultarray['count(userid)'];
                      ?>
                      <p class="card-category">Users</p>
                      <p class="card-title"><?= $total_registered?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-user"></i> Registered 
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php if($empty == false){ ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Recent Orders</h5>
                <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="20%" class="font-weight-light">User</th>
                                    <th width="20%" class="font-weight-light">Item Name</th>
                                    <th width="10%" class="font-weight-light">Quantity</th>
                                    <th width="20%" class="font-weight-light">Price</th>
                                    <th width="15%" class="font-weight-light">Total</th>
                                    <th width="15%" class="font-weight-light">Status</th>
                                </tr>
                                <?php
                                    $sql="SELECT * from orders,orderdetails WHERE orders.orderid=orderdetails.orderid AND orders.date_of_purchase=CURDATE() LIMIT 10;";
                                    $result=$mysqli->query($sql);
                                    while($row=$result->fetch_assoc()){
                                      $sqlnew="SELECT first_name,last_name from users,orders where users.userid=orders.userid limit 5";
                                      $resultofname=$mysqli->query($sqlnew);
                                      $resultarrayofname=$resultofname->fetch_assoc();
                                      $fullname=ucfirst($resultarrayofname['first_name'])." ".ucfirst($resultarrayofname['last_name']);
                                      ?>
                                      <tr>
                                        <td><?= $fullname ?></td>
                                        <td><?= $row['item_name']?></td>
                                        <td><?= $row['quantity']?></td>
                                        <td><?= $row['price']?></td>
                                        <td><?= $row['quantity']*$row['price']?></td>
                                        <td><?php if($row['completed'] == 1){echo "Delivered";}else{echo "Not Delivered";}?></td>
                                      </tr>
                                      <?php
                                    }       
                                ?>
                                </table>
                 </div>
              </div>

              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-history"></i> History
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php }else{?>
            <div class="row mb-5">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header text-center">
                  <h5 class="card-title">No Recent Orders</h5>
                </div>
              </div>
            </div>
            </div>
     <?php }
      ?>

		<!-- unnecessary charts
        <div class="row">
          <div class="col-md-4">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Email Statistics</h5>
                <p class="card-category">Last Campaign Performance</p>
              </div>
              <div class="card-body ">
                <canvas id="chartEmail"></canvas>
              </div>
              <div class="card-footer ">
                <div class="legend">
                  <i class="fa fa-circle text-primary"></i> Opened
                  <i class="fa fa-circle text-warning"></i> Read
                  <i class="fa fa-circle text-danger"></i> Deleted
                  <i class="fa fa-circle text-gray"></i> Unopened
                </div>
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar"></i> Number of emails sent
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-title">NASDAQ: AAPL</h5>
                <p class="card-category">Line Chart with Points</p>
              </div>
              <div class="card-body">
                <canvas id="speedChart" width="400" height="100"></canvas>
              </div>
              <div class="card-footer">
                <div class="chart-legend">
                  <i class="fa fa-circle text-info"></i> Tesla Model S
                  <i class="fa fa-circle text-warning"></i> BMW 5 Series
                </div>
                <hr/>
                <div class="card-stats">
                  <i class="fa fa-check"></i> Data information certified
                </div>
              </div>
            </div>
          </div>
        </div>
		-->
      </div> <!-- content class end   -->
    <?php
		include("footer.php");
	?>
    </div> <!-- main pannel class end   -->
  </div> <!-- end wrapper class -->
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
</body>

</html>