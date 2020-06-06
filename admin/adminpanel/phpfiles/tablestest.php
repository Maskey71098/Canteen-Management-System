<?php
session_start();
$_SESSION["dashboard"]=FALSE;
$_SESSION["tables"]=TRUE;
$_SESSION["user"]=FALSE;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    testtable
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
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
          <div class="col-md-12 ">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> User Table</h4>
              </div>
              <div class="card-body ">
                <div class="table-responsive">
					<table class="table">
						<thead class="text-primary">
							<th>user id</th>
							<th>username</th>
							<th>password</th>
							<th>email</th>
							<th>phone</th>
						</thead>
						<?php
						
						$mysqli=mysqli_connect("localhost","root","","canteen") or die($mysqli->error());
						
						$sql="SELECT * FROM login";
						$result=$mysqli->query($sql);
						
						if($result->num_rows>0)
						{
							while($row = $result->fetch_assoc())
							{
								echo"<tr><td>".$row["user_id"]."</td><td>".$row["username"]."</td><td>".$row["password"]."</td><td>".$row["email"]."</td><td>".$row["phone"]."</td></tr>";
								
							}
							echo"</table>";
						} else 
						{
							echo "0 result ";
						}
						
						?>
                </div>	
              </div>
            </div>
          </div>
		  
		    <div class="col-md-12 ">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Food Table</h4>
              </div>
              <div class="card-body ">
                <div class="table-responsive">
				<table class="table">
						<thead class="text-primary">
							<th>food id</th>
							<th>foodname</th>
							<th>price</th>
						</thead>
						<?php
						
						$mysqli=mysqli_connect("localhost","root","","canteen") or die($mysqli->error());
						
						$sql="SELECT foodid,name,price FROM food";
						$result=$mysqli->query($sql);
						
						if($result->num_rows>0)
						{
							while($row = $result->fetch_assoc())
							{
								echo"<tr><td>".$row["foodid"]."</td><td>".$row["name"]."</td><td>".$row["price"]."</td></tr>";
								
							}
							echo"</table>";
						} else 
						{
							echo "0 result ";
						}
						
						?>	
                </div>	
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Table on Plain Background</h4>
                <p class="card-category"> Here is a subtitle for this table</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
				<!--
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Name
                      </th>
                      <th>
                        Country
                      </th>
                      <th>
                        City
                      </th>
                      <th class="text-right">
                        Salary
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          Dakota Rice
                        </td>
                        <td>
                          Niger
                        </td>
                        <td>
                          Oud-Turnhout
                        </td>
                        <td class="text-right">
                          $36,738
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Minerva Hooper
                        </td>
                        <td>
                          Curaçao
                        </td>
                        <td>
                          Sinaai-Waas
                        </td>
                        <td class="text-right">
                          $23,789
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Sage Rodriguez
                        </td>
                        <td>
                          Netherlands
                        </td>
                        <td>
                          Baileux
                        </td>
                        <td class="text-right">
                          $56,142
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Philip Chaney
                        </td>
                        <td>
                          Korea, South
                        </td>
                        <td>
                          Overland Park
                        </td>
                        <td class="text-right">
                          $38,735
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Doris Greene
                        </td>
                        <td>
                          Malawi
                        </td>
                        <td>
                          Feldkirchen in Kärnten
                        </td>
                        <td class="text-right">
                          $63,542
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Mason Porter
                        </td>
                        <td>
                          Chile
                        </td>
                        <td>
                          Gloucester
                        </td>
                        <td class="text-right">
                          $78,615
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Jon Porter
                        </td>
                        <td>
                          Portugal
                        </td>
                        <td>
                          Gloucester
                        </td>
                        <td class="text-right">
                          $98,615
                        </td>
                      </tr>
                    </tbody>
                  </table>
				  -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
		include("footer.php");
	?>
    </div>
  </div>
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
</body>

</html>