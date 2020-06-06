<?php
session_start();
require 'database.php';
$_SESSION["dashboard"]=FALSE;
$_SESSION["tables"]=FALSE;
$_SESSION["user"]=TRUE;
$_SESSION["items"]=FAlSE;
$_SESSION["searchorder"]=FALSE;
if(isset($_POST['search'])){
  $_SESSION['new']=TRUE;
}
if(isset($_POST['update'])){
  $_SESSION['new']=TRUE;
}

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
                <h5 class="card-title">Edit User Profile</h5>
              </div>
              <div class="card-body">
              <form  action="" method="POST">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php if(isset($_POST['search'])&& isset($_POST['email'])){echo htmlentities($_POST['email']);}?>">
                      </div>
                     </div>
                     <div class="col-md-2 d-flex align-items-center justify-content-center ">OR</div>
                     <div class="col-md-5">
                      <div class="form-group">
                          <label for="phone number">Phone Number</label>
                          <input class="form-control" placeholder="Phone Number" name="phonenumber" value="<?php if(isset($_POST['search'])&& isset($_POST['phonenumber'])){echo htmlentities($_POST['phonenumber']);}?>">
                        </div>
                     </div>
                    </div>
				            <div class="row">
                      <div class="update ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary btn-round" name="search">Search</button>
                      </div>   
                  </div>
                  </form>
                  <?php if (isset($_SESSION['new']) && $_SESSION['new']){?>
                  <div id="hiddencontainer" >
                  <?php 
                  }else{
                  ?>
                 <div id="hiddencontainer" style="display:none">
                  <?php } ?>
                 <div class="row">
                    <div class="col-md-12 text-center">
                     <?php 
                      if(isset($_POST['email'])&& !empty($_POST['email']) && isset($_POST['phonenumber'])&& !empty($_POST['phonenumber'])){
                            $email=$_POST['email'];
                            $phonenumber=$_POST['phonenumber'];
                            $checkreturn=doboth($email,$phonenumber);
                            if($checkreturn==0){
                              echo "No user found";
                            }
                      }elseif(isset($_POST['email'])&& !empty($_POST['email'])){
                            $email=$_POST['email'];
                            $checkreturn=checkbyemail($email);
                            if($checkreturn==0){
                              echo "No user found";
                            }
                      }elseif(isset($_POST['phonenumber'])&& !empty($_POST['phonenumber'])){
                            $phonenumber=$_POST['phonenumber'];
                            $checkreturn=checkbynumber($phonenumber);
                            if($checkreturn==0){
                              echo "No user found";
                            }
                      }elseif(empty($_POST['phonenumber'])&&empty($_POST['phonenumber'])){
                            echo "Both fields cannot be empty";
                      }
                      if(isset($checkreturn)&& $checkreturn==1){
                            $first_name=$_SESSION['result']['first_name'];
                            $last_name=$_SESSION['result']['last_name'];
                            $emailuser=$_SESSION['result']['email'];
                            $phonenumber=$_SESSION['result']['phonenumber'];
                            $faculty=$_SESSION['result']['faculty'];
                            $balance=$_SESSION['result']['balance'];
                            $totalspent=$_SESSION['result']['balancespent'];

                  ?>
                  </div>
                  </div>
                          <div class="row">
                              <div class="col-md-12 col-sm-12 pt-1">
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
                                            <td class="font-weight-normal"><?php echo $first_name; ?></td>
                                            <td class="font-weight-normal"><?php echo $last_name; ?></td>
                                            <td class="font-weight-normal"><?php echo $emailuser; ?></td>
                                            <td class="font-weight-normal"><?php echo $phonenumber; ?></td>
                                            <td class="font-weight-normal"><?php echo $faculty; ?></td>
                                            <td class="font-weight-normal"><?php echo $balance; ?></td>
                                            <td class="font-weight-normal"><?php echo $totalspent; ?></td>
                                            </tr>
                                        </table>
                                </div>
                              </div>
                            </div>
                            <br>
                            Update the following user detail
                            <form action="userupdate.php" method="POST">
                                              <div class="row pt-2">
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" placeholder="First Name" name="firstname">
                                                  </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label>Last Name</label>
                                                      <input type="text" class="form-control" placeholder="Last Name" name="lastname">
                                                    </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label>Phone number</label>
                                                      <input type="text" class="form-control" placeholder="PhoneNumber" name="updatedphonenumber">
                                                    </div>
                                                  </div>
                                                   <div class="col-md-6">
                                                    <div class="form-group">
                                                      <label>Add Balance</label>
                                                      <input type="text" class="form-control" placeholder="AddBalance" name="addbalance">
                                                    </div>
                                                  </div>	
                                              </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1">Update Email address</label>
                                                    <input type="email" class="form-control" placeholder="Email" name="updatedemailaddress">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-3 offset-md-3 text-center ">
                                                  <button type="submit" class="btn btn-primary btn-round" name="update">Update Profile</button>
                                                  
                                                </div>
                                                </form>
                                                <div class="col-md-3 text-center">
                                                  <form action="userupdate.php" method="POST">
                                                        <button type="submit" class="btn btn-dark btn-round" name="deleteuser">Delete User</button>
                                                  </form>
                                                </div>
                                                
                                              </div>
                                           </div>
                                        </div>
                             
              </div>
            </div>
                            
                  <?php
                  
                  }
                  
                  ?>
                  
                  </div>
        </div>
    </div>
  </div>
  </div>
  <?php      
                    function checkbyemail($email){
                      require 'database.php';
                      $sql="SELECT first_name,last_name,email,phonenumber,faculty,balance,balancespent FROM users where email='$email'";
                      $result=$mysqli->query($sql);
                      if($result->num_rows==0){
                        return 0;
                      }else{
                      $_SESSION['result']=$result->fetch_assoc();
                      return 1;
                      $mysqli->close();
                      }
                      }
                      function checkbynumber($phonenumber){
                        require 'database.php';
                        $sql="SELECT first_name,last_name,email,phonenumber,faculty,balance,balancespent FROM users where phonenumber='$phonenumber'";
                        $result=$mysqli->query($sql);
                        if($result->num_rows==0){
                          return 0;
                        }else{
                          $_SESSION['result']=$result->fetch_assoc();
                          return 1;
                          }
                        }
                      function doboth($email,$phonenumber){
                          $checkreturnemail=checkbyemail($email);
                        if($checkreturnemail==0){
                          $checkreturnnumber=checkbynumber($phonenumber);
                          if($checkreturnnumber==0){
                            return 0;
                          }else{
                            return 1;
                          }
                        }else{
                          return 1;
                        }
                        } 
  ?>
</body>

</html>