<?php
	$connect=mysqli_connect("localhost","root","","canteen");

		$_SESSION["dashboard"]=FALSE;
		$_SESSION["tables"]=TRUE;
		$_SESSION["user"]=FALSE;

?>
<html>

	<head>
	
	
			<meta charset="utf-8" />
			<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
			<link rel="icon" type="image/png" href="../assets/img/favicon.png">
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
			
			
		<title>demo</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		
		
			  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
			 <!--     Fonts and icons     -->
			  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
			  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
			<!-- CSS Files -->
			  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
			  <link href="../assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
			  <link href="../assets/demo/demo.css" rel="stylesheet" />
			-
			
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
		<!--
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" ></script>	
		-->
		<script  src="jquery.tabledit.js"></script>
	</head>
	
	<body class="">
	<div class="wrapper">
	 <?php
		include("sidebar.php");
		
	?>
	<div class="main-panel">
	 <?php
		include("navbar.php");
	?>
	<div class="container">
		<br />
		<br />
		<br />

		<div class="table-responsive">
			<h3 align="center">live edit</h3>
			<br />
			<table id="editable_table" class="table table-bordered table-stripped">
				<thead>
					<tr>
						<th>userid</th>
						<th>Username</th>
						<th>Password</th>
						<th>Email</th>
						<th>Phone</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$query="SELECT * FROM login";
						$result= mysqli_query($connect,$query);
						while($row= mysqli_fetch_array($result))
						{
							echo'
							<tr>
								<td>'.$row["user_id"].'</td>
								<td>'.$row["username"].'</td>
								<td>'.$row["password"].'</td>
								<td>'.$row["email"].'</td>
								<td>'.$row["phone"].'</td>
							</tr>
							';
						}
					?>
				</tbody>
			</table>
			
			
		</div>	
		
			<div class="table-responsive">
			<h3 align="center">Food edit</h3>
			<br />
			<table id="editablefood_table" class="table table-bordered table-stripped">
				<thead>
					<tr>
						<th>foodid</th>
						<th>Foodname</th>
						<th>Price</th>

					</tr>
				</thead>
				<tbody>
					<?php
						$query="SELECT * FROM food";
						$result= mysqli_query($connect,$query);
						while($row= mysqli_fetch_array($result))
						{
							echo'
							<tr>
								<td>'.$row["foodid"].'</td>
								<td>'.$row["name"].'</td>
								<td>'.$row["price"].'</td>
							</tr>
							';
						}
					?>
				</tbody>
			</table>
			
			
		</div>	
	</div>
	</div> // div main panel end
 	</div> //end wrapper class  
	
	
  <script src="../assets/js/core/popper.min.js"></script>
 <!-- <script src="../assets/js/core/bootstrap.min.js"></script> //4.1.1 -->
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
	
	</body>
</html>

<script>
document.write("<p>in</p>");
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