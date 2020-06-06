<?php 
		$_SESSION['email']=$_POST['email'];
		$_SESSION['first_name']=strtolower($_POST['first_name']);
		$_SESSION['last_name']=strtolower($_POST['last_name']);
		$_SESSION['emailerror']=false;
		//FOR SQL INJECTION
		$first_name=$mysqli->escape_string(strtolower($_POST['first_name']));
		$checkfirstname=checkname($first_name);
		if($checkfirstname){
			$_SESSION['fn_error']=false;
		}else{
			$_SESSION['fn_error']=true;
		}
		$last_name=$mysqli->escape_string(strtolower($_POST['last_name']));
		$checklastname=checkname($last_name);
		if($checklastname){
			$_SESSION['ln_error'] = false;
		}else{
			$_SESSION['ln_error'] = true;
		}
		$email = $mysqli->escape_string(strtolower($_POST['email']));
		$canteen = $mysqli->escape_string(strtolower($_POST['canteen_name']));
		$canteen = str_replace(' ', '_', $canteen);
		$checkcanteen=checkcanteen($canteen);
		if($checkcanteen){
			$_SESSION['cn_error']=false;
		}else{
			$_SESSION['cn_error']=true;
		}
		$checkpassword1=$_POST['password'];
		$checkpassword2=$_POST['repassword'];
		$phone=$mysqli->escape_string($_POST['phone']);
		$location=$mysqli->escape_string(strtolower($_POST['location']));
		$password=$mysqli->escape_string(password_hash($_POST['password'],PASSWORD_BCRYPT));
		$repassword=$mysqli->escape_string(password_hash($_POST['repassword'],PASSWORD_BCRYPT));
		$hash=$mysqli->escape_string(md5(rand(0,1000)));
		//CHECK IF THE USER EXISTS
		$result=$mysqli->query("SELECT * FROM users WHERE email ='$email'");
		$resultnumber=$mysqli->query("SELECT * FROM users WHERE phonenumber ='$phone'");
		//IF num_row=0,no user;
		$checker=true;//variable to check if an error has occured
		$temp=strlen((string)$phone);
		if($resultnumber->num_rows!=0){
			$_SESSION['numbererror']=true;
			$checker=false;
		}else{
			$_SESSION['numbererror']=false;
		}
		if($result->num_rows!=0){
			$_SESSION['emailerror']=true;
			$checker=false;
		}
		if($checkpassword1!=$checkpassword2){
			$_SESSION['repassword']=false;
			$checker=false;
		}
		if(!is_numeric($phone)||$temp!=10){
			$_SESSION['numbercheck']=false;
			$checker=false;
		}else{
			$_SESSION['numbercheck']=true;
		}

		
		if($checker==true){
			$sql="INSERT INTO admins (first_name,last_name,canteen_name,email,phonenumber,password,location,hash)"."VALUES('$first_name','$last_name','$canteen','$email','$phone','$password','$location','$hash')";
				if($mysqli->query($sql)){
					//$sql="SELECT id FROM admins where email = '$email'";
					$id_for_database=$mysqli->insert_id; //gives id of last inserted value
					$databaseholder="$canteen"."$id_for_database";
					$sqlnew="UPDATE admins SET db='$databaseholder' WHERE email='$email'";
					if($mysqli->query($sqlnew)){
						$sqllast="INSERT INTO canteen(cname,location,dbase)"."VALUES('$canteen','$location','$databaseholder')";
						if($mysqli->query($sqllast)){
						require 'admincreater.php';}
						else{
							echo <<<EOT
							<script>
							alert("$mysqli->error();");
							</script>
							EOT;
						}
					}
					else{
						echo <<<EOT
						<script>
							alert("$mysqli->error();");
						</script>
					EOT;
					}
				//verifiaction system to be made
				}else{
					echo <<<EOT
						<script>
							alert("$mysqli->error();");
						</script>
					EOT;
				}
		}
		function checkname($newname){
            return !preg_match('/[^A-za-z]/', $newname);
		}
		function checkcanteen($newname){
            return !preg_match('/[^A-za-z_]/', $newname);
        }
?>