<?php
$checker=$_POST['userselecter'];
if($checker=='user'){
			$email=$mysqli->escape_string($_POST['email']);
			$cidholder=$_POST['canteenselecter'];
			$datbasequery=$mysqli->query("SELECT cname,dbase FROM canteen WHERE cid='$cidholder'");
			$datbaseresult=$datbasequery->fetch_assoc();
			$datbase=$datbaseresult['dbase'];
			$canteen=$datbaseresult['cname'];
			//check if there are users with that account inside that canteen
			/*$host='localhost';
			$user='root';
			$password='';*/
			$mysqlinew=new mysqli($host,$user,$password,$datbase) or die($mysqli->error);
			$usercheck=$mysqlinew->query("SELECT * FROM users WHERE email='$email'");
			if($usercheck->num_rows!=0){
			$user = $usercheck->fetch_assoc();
			 //storing query data into user array
			if(password_verify($_POST['password'],$user['password'])){ //password_verify comapres two values..in this case given password and user database password
				$_SESSION['email']=$user['email'];
				$_SESSION['first_name']=$user['first_name'];
				$_SESSION['last_name']=$user['last_name'];
				$_SESSION['datbasesession']=$datbase;
				$_SESSION['canteenname']=$canteen;
				$_SESSION['balance']=$user['balance'];
				$_SESSION['active']=true;
				$_SESSION['luserin']=true;
				$_SESSION['lin']=true;
				header("location:menu.php");
				exit;

			}else{ //password wrong
				$_SESSION['pvalue']="NO";
			}
		}else{
			$_SESSION['pvalue']="ANOTHER";
		}
	}

	elseif($checker='admin'){
		$email=$mysqli->escape_string($_POST['email']);
		$result=$mysqli->query("SELECT * FROM admins WHERE email='$email'"); //querycheck
		if($result->num_rows==0){  //if no of rows is 0, noo user
		$_SESSION['pvalue']="ANOTHER";
		}

		else{
			$cidholder=$_POST['canteenselecter'];
			$datbasequery=$mysqli->query("SELECT cname,dbase FROM canteen WHERE cid='$cidholder'");
			$datbaseresult=$datbasequery->fetch_assoc();
			$datbase=$datbaseresult['dbase'];
			$canteen=$datbaseresult['cname'];
			 $admin=$result->fetch_assoc();
			if(password_verify($_POST['password'],$admin['password'])){ //password_verify comapres two values..in this case given password and user database password
				$_SESSION['email']=$admin['email'];
				$_SESSION['first_name']=$admin['first_name'];
				$_SESSION['last_name']=$admin['last_name'];
				$_SESSION['active']=true;
				$_SESSION['ladminin']=true;
				$_SESSION['lin']=true;
				$_SESSION['datbasesession']=$datbase;
				header("location:admin/adminpanel/phpfiles/dashboard.php");
				exit;

			}else{ //password wrong
				$_SESSION['pvalue']="NO";
			}


			}




	}
?>