<?php 
		$_SESSION['email']=strtolower($_POST['email']);
		$_SESSION['first_name']=strtolower($_POST['first_name']);
		$_SESSION['last_name']=strtolower($_POST['last_name']);
		$_SESSION['emailerror']=false;
		//FOR SQL INJECTION
		$first_name=$mysqliclientdb->escape_string(strtolower($_POST['first_name']));
		$checkfirstname=checkname($first_name);
		if($checkfirstname){
			$_SESSION['fn_error']=false;
		}else{
			$_SESSION['fn_error']=true;
		}
		$last_name=$mysqliclientdb->escape_string(strtolower($_POST['last_name']));
		$checklastname=checkname($last_name);
		if($checklastname){
			$_SESSION['ln_error'] = false;
		}else{
			$_SESSION['ln_error'] = true;
		}
		$email=$mysqliclientdb->escape_string(strtolower($_POST['email']));
		$checkpassword1=$_POST['password'];
		$checkpassword2=$_POST['repassword'];
		$phone=$mysqliclientdb->escape_string($_POST['phone']);
		$faculty=$mysqliclientdb->escape_string($_POST['canteen_selecter']);
		$loginpassword=$mysqliclientdb->escape_string(password_hash($_POST['password'],PASSWORD_BCRYPT));
		$repassword=$mysqliclientdb->escape_string(password_hash($_POST['repassword'],PASSWORD_BCRYPT));
		$hash=$mysqliclientdb->escape_string(md5(rand(0,1000)));
		//CHECK IF THE USER EXISTS
		$host='localhost';
		$user='root';
		$password='';
		$db=$_POST['selecter'];
		$mysqli=new mysqli($host,$user,$password,$db) or die($mysqli->error);
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
			$sql="INSERT INTO users (first_name,last_name,email,phonenumber,password,faculty,hash,balance,balancespent)"."VALUES('$first_name','$last_name','$email','$phone','$loginpassword','$faculty','$hash',0,0)";
				if($mysqli->query($sql)){
					$_SESSION['datbasesession']=$_POST['selecter'];
					header('location: http://'.$_SERVER['HTTP_HOST'].'/minortest/login.php');
					}
				//verifiaction system to be made
				else{?>
						<script>
							alert($mysqli->error());
						</script>
				<?php
				}
		}
		function checkname($newname){
            return !preg_match('/[^A-za-z]/', $newname);
        }
?>