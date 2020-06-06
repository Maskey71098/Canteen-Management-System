<?php 
		$_SESSION['email']=$_POST['email'];
		$_SESSION['first_name']=$_POST['first_name'];
		$_SESSION['last_name']=$_POST['last_name'];
		$_SESSION['emailerror']=false;
		//FOR SQL INJECTION
		$first_name=$mysqli->escape_string($_POST['first_name']);
		$last_name=$mysqli->escape_string($_POST['last_name']);
		$email=$mysqli->escape_string($_POST['email']);
		$checkpassword1=$_POST['password'];
		$checkpassword2=$_POST['repassword'];
		$phone=$mysqli->escape_string($_POST['phone']);
		$faculty=$mysqli->escape_string($_POST['selecter']);
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
			$sql="INSERT INTO users (first_name,last_name,email,phonenumber,password,faculty,hash)"."VALUES('$first_name','$last_name','$email','$phone','$password','$faculty','$hash')";
				if($mysqli->query($sql)){
					$_SESSION['lin']="YES";
					header("location:menu.php");
				//verifiaction system to be made
				}else{
					echo <<<EOT
						<script>
							alert("Sorry, we are having problems adding to database");
						</script>
					EOT;
				}
		}
?>