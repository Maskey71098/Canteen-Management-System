<?php
session_start();
include 'database.php'; //or inclide database.php
$_SESSION["dashboard"]=FALSE;
$_SESSION["tables"]=TRUE;
$_SESSION["user"]=FALSE;
$_SESSION["items"]=FALSE;
$_SESSION["searchorder"]=FALSE;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  Tables
  </title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" > <!-- do not remove this yesle icon deako ho table edit ko lagi!!!-->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <script  src="jquery.tabledit.min.js"></script>
  
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
                <h4 class="card-title"> User Table </h4>
				<h5 class="font-weight-light">Showing a maximum of 30 users.</h5>
              </div>
              <div class="card-body ">
				<div class="table-responsive">
			
			<table id="table" class="table table-bordered table-stripped">
				<thead class="text-primary">
					<tr>
						<th>First name</th>
						<th>last name</th>
						<th>Email</th>
						<th>Phone number</th>
						<th>Faculty</th>
						<th>Balance</th>
						<th>Balance spent</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$query="SELECT first_name,last_name,email,phonenumber,faculty,balance,balancespent FROM users LIMIT 30";
						$result= $mysqli->query($query);
						while($row= $result->fetch_assoc())
						{
							echo'
							<tr>
								<td>'.$row["first_name"].'</td>
								<td>'.$row["last_name"].'</td>
								<td>'.$row["email"].'</td>
								<td>'.$row["phonenumber"].'</td>
								<td>'.$row["faculty"].'</td>
								<td>'.$row["balance"].'</td>
								<td>'.$row["balancespent"].'</td>					
							</tr>
							';
						}
					?>
				</tbody>
			</table>	
			</div>
			</div>
			</div>
		</div>
		
		<div class="col-md-12 ">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" > Food Table</h4>
              </div>
              <div class="card-body ">
				<div class="table-responsive">
			
			<table id="editablefood_table" class="table table-bordered table-stripped">
				<thead class="text-primary">
					<tr>
						<th>Food name</th>
						<th>Price</th>
						<th>Availability</th>

					</tr>
				</thead>
				<tbody>
					<?php
						$query="SELECT * FROM items";
						$result= $mysqli->query($query);
						while($row= $result->fetch_array())
						{
							?>
							<tr>
								<td> <?= ucfirst($row["itemname"]) ?> </td>
								<td><?= ucfirst($row["price"]) ?> </td>
								<td><?php if($row["available"]==1){echo "Yes";}else{echo "No";}?></td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>	
			</div>
			</div>
			</div>
		</div>
		
		
		</div>
		</div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <!--<script src="../assets/js/core/jquery.min.js"></script> //this is causing icons to disapper-->
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

<script>
//document.write("<p>in</p>");
$(document).ready(function()
{
	//document.write("<p>inside block</p>");
	$('#editable_table').Tabledit({
		url:'action.php',
		columns:
		{
			identifier:[0,'user_id'],
			editable:[[1,'username'],[2,'password'],[3,'email'],[4,'phone']]
		},
		restoreButton:false,
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action == 'delete')
			{
				$('#'+data.user_id).remove();
			}
		}
		//document.write("<p>end of  block</p>");
	});
});
</script>

<script>
document.write("<p>in</p>");
$(document).ready(function()
{
	//document.write("<p>inside block</p>");
	$('#editablefood_table').Tabledit({
		url:'actionfood.php',
		columns:
		{
			identifier:[0,'foodid'],
			editable:[[1,'name'],[2,'price']]
		},
		restoreButton:false,
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action == 'delete')
			{
				$('#'+data.user_id).remove();
			}
		}
		//document.write("<p>end of  block</p>");
	});
});
</script>