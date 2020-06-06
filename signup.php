<?php
  require 'db.php';
  session_start();
  $_SESSION['emailerror']=false;
  $_SESSION['repassword']=true;
  $_SESSION['numbererror']=NULL;
  $_SESSION['numbercheck']=NULL;
?><!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="login">
  
  <title>Signup</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['signupbutton']))
      require 'register.php';
  }
?>
<body>
  <section class="menu cid-qTkzRZLJNu" once="menu" id="menu1-3">

    

    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.php">
                         <img src="assets/images/icon-122x122.png" alt="Mobirise" title="" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="index.php">CANTEEN MANAGEMENT SYSTEM</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item">
                    <a class="nav-link link text-white display-4" href="index.php">
                        </a>
                </li>
                </ul>
        </div>
    </nav>
</section>
<section class="engine"><a href="https://mobirise.info/v">html templates</a></section><section class="mbr-section form1 cid-rpZeDDmCA8" id="form1-4">

    

    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">Signup</h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                    Easily sign up today to start enjoying the new way of canteen</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8" >
                <!---Formbuilder Form--->
                <form action="signup.php" method="POST" class="mbr-form form-with-styler"><input type="hidden" name="email" data-form-email="true" value="wTIbKpnzp9f3vhd7ZrWrUA3ln1Omrh001vRPBVkE6/JCSeF/iZLwKJjDzIdBLvpv18V9jWXH8svX3oUPBIv4Ft9W1gWmHEZm/fSmuP7trYtV2dpkAMhZr29kFQvROnbm">
                    <div class="text-center">
                      <?php
                      if(isset($_SESSION['numbercheck'])&&$_SESSION['numbercheck']==false){
                        echo <<<EOT
                        <p style="color:red;">Please enter a valid number</p>
                        EOT;
                      }
                      if($_SESSION['repassword']==false){
                        echo <<<EOT
                        <p style="color:red;">Please make sure password is entered correctly twice</p>
                        EOT;
                      }
                      if($_SESSION['emailerror']==true){
                        echo <<<EOT
                        <p style="color:red;">Sorry, user already exists</p>
                        EOT;
                      }
                       if(isset($_SESSION['numbererror'])&&$_SESSION['numbererror']==true){
                        echo <<<EOT
                        <p style="color:red;">Sorry, phone number already registered</p>
                        EOT;
                      }
                        ?>
                    </div>
                    <div class="dragArea row row-sm-offset">
                        <div class="col-md-4  form-group" data-for="name">
                            <label for="name-form1-4" class="form-control-label mbr-fonts-style display-7">First Name</label>
                            <input type="text" name="first_name" data-form-field="Name" required="required" class="form-control display-7" id="name-form1-4" value="<?php if(isset($_POST['signupbutton'])){echo htmlentities($_POST['first_name']);}?>">
                        </div>
                        <div class="col-md-4  form-group" data-for="name">
                            <label for="name-form1-4" class="form-control-label mbr-fonts-style display-7">Last Name</label>
                            <input type="text" name="last_name" data-form-field="Name" required="required" class="form-control display-7" id="name-form1-4"
                            value="<?php if(isset($_POST['signupbutton'])){echo htmlentities($_POST['last_name']);}?>">
                        </div>
                        <div class="col-md-4  form-group" data-for="email">
                            <label for="email-form1-4" class="form-control-label mbr-fonts-style display-7">Email</label>
                            <input type="email" name="email" data-form-field="Email" required="required" class="form-control display-7" id="email-form1-4">
                        </div>
                        <div data-for="phone" class="col-md-4  form-group">
                            <label for="phone-form1-4" class="form-control-label mbr-fonts-style display-7">Phone</label>
                            <input  name="phone" class="form-control display-7" id="phone-form1-4" value="<?php if(isset($_SESSION['numbercheck'])&&$_SESSION['numbercheck']!=false){
                              if(isset($_SESSION['numbererror'])&&$_SESSION['numbererror']==false){
                                echo htmlentities($_POST['phone']);
                              }
                            }
                            ?>">
                        </div>
                        <div data-for="password" class="col-md-4  form-group">
                            <label for="password-form1-4" class="form-control-label mbr-fonts-style display-7">Password</label>
                            <input type="password" name="password" data-form-field="Password" class="form-control display-7" id="passsword-form1-4">
                        </div>
                        <div data-for="repassword" class="col-md-4  form-group">
                            <label for="password-form1-4" class="form-control-label mbr-fonts-style display-7" >Reenter Password</label>
                            <input type="password" name="repassword" data-form-field="Repassword" class="form-control display-7" id="password-form1-4">
                        </div>
                        <div class="form-group col-md-4 offset-4">
                             <label for="inputState">Faculty Or Student</label>
                              <select id="inputState" class="form-control" name="selecter">
                                   <option value="faculty" selected>Faculty Member</option>
                                   <option value="student">Student</option>
                               </select>
                        </div>
                        <div class="col-md-12 input-group-btn align-center"><button type="submit" class="btn btn-primary btn-form display-4" name="signupbutton">SIGN UP</button></div>
                    </div>
                </form><!---Formbuilder Form--->
            </div>
        </div>
    </div>
</section>

<section class="cid-rpZGO5JW6r" id="footer1-h">

    

    

    <div class="container">
        <div class="media-container-row content text-white">
            <div class="col-12 col-md-3">
                <div class="media-wrap">
                    <a href="#">
                        <img src="assets/images/icon-1-192x192.png" alt="Mobirise" title="">
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Address
                </h5>
                <p class="mbr-text">Kalimati<br>Kathmandu</p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">
                    Contacts
                </h5>
                <p class="mbr-text">Barun Pradhan: &nbsp;9861358109<br>Apurbha Pokharel: 9860466111<br>Abhiskeh R Maskey: 9808330102</p>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <h5 class="pb-3">&nbsp;</h5>
                <p class="mbr-text">&nbsp;</p>
            </div>
        </div>
        
    </div>
</section>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  
  
</body>
</html>