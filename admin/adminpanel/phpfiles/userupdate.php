<?php
session_start();
include 'database.php';
$_SESSION["dashboard"]=FALSE;
$_SESSION["tables"]=FALSE;
$_SESSION["user"]=TRUE;
$_SESSION["items"]=FAlSE;
$_SESSION["searchorder"]=FALSE;
$error="";
$emailchange=false;
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
                <div class="content " style="height:100%">
                    <div class="col-md-12">
                        <div class="card card-user">
                            <?php
                            if(isset($_POST['deleteuser'])){
                                $emailuser=$balance=$_SESSION['result']['email'];
                                $sql="DELETE from users where email='$emailuser'";
                                if($mysqli->query($sql)){ ?>
                                    <div class="card-header text-center">
                                            <h5 class="card-title">User has been deleted</h5>
                                    </div>
                                    <div class="row">
                                                    <div class="col-md-12 text-center pt-3 pb-5">     
                                                        <a href="user.php" class="btn btn-info btn-round" role="button">Continue</a>
                                                    </div>
                                    </div>
                                <?php }else{ ?>
                                    <div class="card-header">
                                            <h5 class="card-title">Sorry,user couldnt be deleted.</h5>
                                    </div>
                                    <div class="row">
                                                    <div class="col-md-12 text-center pt-3 pb-5">     
                                                        <a href="user.php" class="btn btn-info btn-round" role="button">Go back</a>
                                                    </div>
                                    </div>
                                <?php }
                            }
                            else{
                            if(emptycheck($_POST['firstname'],$_POST['lastname'],$_POST['updatedphonenumber'],$_POST['addbalance'],$_POST['updatedemailaddress'])){ 
                                $emailuser=$_SESSION['result']['email'];
                                if(isset($_POST['firstname'])&& !empty($_POST['firstname'])){
                                    $new=$mysqli->escape_string($_POST['firstname']);
                                    $check=checkname($new);
                                    if($check==1){
                                        $sql="UPDATE users 
                                        SET first_name='$new'
                                        where email='$emailuser'
                                        ";
                                        $result=$mysqli->query($sql);
                                        $converted=true;
                                    }else{
                                        $error="First name not valid";
                                    }

                                }
                                if(isset($_POST['lastname'])&& !empty($_POST['lastname'])){
                                    $new=$mysqli->escape_string($_POST['lastname']);
                                    $check=checkname($new);
                                    if($check==1){
                                        $sql="UPDATE users 
                                        SET last_name='$new'
                                        where email='$emailuser'
                                        ";
                                        $result=$mysqli->query($sql);
                                        $converted=true;
                                    }else{
                                        if(!empty($error)){
                                            $error=$error . "<br> Last name not valid";
                                        }
                                        else{
                                            $error="Last name not valid";
                                        }
                                    }
                                }
                                if(isset($_POST['updatedphonenumber'])&& !empty($_POST['updatedphonenumber'])){
                                    $new=$mysqli->escape_string($_POST['updatedphonenumber']);
                                    $checknumber=numbercheck($new);
                                    if($checknumber==true){
                                        $sql="UPDATE users 
                                        SET phonenumber='$new'
                                        where email='$emailuser'
                                        ";
                                        $result=$mysqli->query($sql);
                                        $converted=true;
                                    }else{
                                        $error=$error . "<br> Phone number not valid";
                                    }
                                }
                                if(isset($_POST['addbalance'])&& !empty($_POST['addbalance'])){
                                    $balance=$_SESSION['result']['balance'];
                                    $check= checkbalance($mysqli->escape_string($_POST['addbalance']));
                                    if($check==true){
                                        $new=$mysqli->escape_string($_POST['addbalance'])+$balance;
                                        $sql="UPDATE users 
                                        SET balance='$new'
                                        where email='$emailuser'
                                        ";
                                        $result=$mysqli->query($sql);
                                        $converted=true;
                                    }else{
                                        $error=$error . "<br> Balance not valid";
                                    }
                                }
                                if(isset($_POST['updatedemailaddress'])&& !empty($_POST['updatedemailaddress'])){
                                    $emailuser=$balance=$_SESSION['result']['email'];
                                    $newemail=$mysqli->escape_string($_POST['updatedemailaddress']);
                                    $sql="UPDATE users 
                                    SET email='$newemail'
                                    where email='$emailuser'
                                    ";
                                    $result=$mysqli->query($sql);
                                    $emailchange=true;
                                } 
                                if (empty($error)){ 
                                        if(isset($emailchange)&&$emailchange==false){
                                            $emailuser=$_SESSION['result']['email'];
                                            $sql="SELECT first_name,last_name,email,phonenumber,faculty,balance,balancespent from users where email='$emailuser' ";
                                            $result=$mysqli->query($sql);
                                            $fetched=$result->fetch_assoc();
                                        }else{
                                            $sql="SELECT first_name,last_name,email,phonenumber,faculty,balance,balancespent from users where email='$newemail' ";
                                            $result=$mysqli->query($sql);
                                            $fetched=$result->fetch_assoc();
                                        }
                            ?>
                            
                                        <div class="card-header">
                                            <h5 class="card-title">Updated user profile</h5>
                                        </div>
                                        <div class="table-container pt-1">
                                        <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                    <tr>
                                                                        <th width="14.28%" class="font-weight-light" >First name</th>
                                                                        <th width="14.28%" class="font-weight-light">Last Name</th>
                                                                        <th width="14.28%" class="font-weight-light">Email</th>
                                                                        <th width="14.28%" class="font-weight-light">Phone number</th>
                                                                        <th width="14.28%" class="font-weight-light">Faculty</th>
                                                                        <th width="14.28%" class="font-weight-light">Balance</th>
                                                                        <th width="14.28%" class="font-weight-light">Total Spent</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="font-weight-normal"><?php echo $fetched['first_name'] ?></td>
                                                                        <td class="font-weight-normal"><?php echo $fetched['last_name'] ?></td>
                                                                        <td class="font-weight-normal"><?php echo $fetched['email'] ?></td>
                                                                        <td class="font-weight-normal"><?php echo $fetched['phonenumber'] ?></td>
                                                                        <td class="font-weight-normal"><?php echo $fetched['faculty'] ?></td>
                                                                        <td class="font-weight-normal">Rs <?php echo $fetched['balance'] ?></td>
                                                                        <td class="font-weight-normal">Rs <?php echo $fetched['balancespent'] ?></td>
                                                                    </tr>
                                                         </table>
                                                 </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                                    <div class="col-md-12 text-center pt-3 pb-5">     
                                                        <a href="user.php" class="btn btn-info btn-round" role="button">Continue</a>
                                                    </div>
                                        </div>
                                <?php }else{?>
                                        <div class="card-header text-center">
                                            <h5 class="card-title">Sorry, Coundn't Update</h5>
                                        </div>
                                        <div class="row">
                                                    <div class="col-md-12 text-center pt-3 pb-5">     
                                                        <a href="user.php" class="btn btn-info btn-round" role="button">Go back</a>
                                                    </div>
                                        </div>
                                <?php }?>
                            <div class="row">
                                <div class="col-md-12 text-center pb-5">
                                        <?php 
                                        if (isset($error)&& !empty($error)){
                                            echo $error;?>
                                        <div class="row">
                                                    <div class="col-md-12 text-center pt-3 pb-5">     
                                                        <a href="user.php" class="btn btn-info btn-round" role="button">Go back</a>
                                                    </div>
                                        </div>
                                        <?php } ?>
                                </div>
                            </div>
                                    <?php }else{
                                        ?>
                                        <div class="card-header text-center">
                                            <h5 class="card-title">Sorry, Coundn't Update</h5>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-12 text-center pb-5">     
                                                All fields empty
                                             </div>
                                        </div>
                                        <div class="row">
                                                    <div class="col-md-12 text-center pt-3 pb-5">     
                                                        <a href="user.php" class="btn btn-info btn-round" role="button">Go back</a>
                                                    </div>
                                        </div>
                                    <?php }}?>
                        </div>
                    </div>
                </div>
    <?php
    function emptycheck($a,$b,$c,$d,$e){
        if(empty($a)&& empty($b) && empty($c)&& empty($d) && empty($e)){
            return 0;
        }else{
            return 1;
        }

    }
        function checkname($newname){
            return !preg_match('/[^A-za-z]/', $newname);
          }
        function checkbalance($balance){
            if(!is_numeric($balance)){
                return false;
            }else{
                return true;
            }
        }
        function numbercheck($number){
            $temp=strlen((string)$number);
            if(!is_numeric($number)||$temp!=10){
                return false;
            }else{
                return true;
            }
        }
    ?>
</body>

</html>