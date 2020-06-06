<?php 
session_start();
require 'db.php';
if(isset($_SESSION['ladminin']) && $_SESSION['ladminin'] == true){
  header('location: http://'.$_SERVER['HTTP_HOST'].'/minortest/admin/adminpanel/phpfiles/dashboard.php');
}
if(isset($_SESSION['luserin']) && $_SESSION['luserin'] == true){
    header('location: http://'.$_SERVER['HTTP_HOST'].'/minortest/menu.php');
}
?>
<!DOCTYPE html>
<html >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="Web Maker Description">
  
  <title>Login</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" href="assets/loginstyle.css">
  
  
  
</head>
<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['loginbutton']))
      require 'loginautheticator.php';
  }
?>
<body>
    <section class="menu cid-rpZAmsSddo" once="menu" id="menu1-b">
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
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true"><li class="nav-item">
                    <a class="nav-link link text-white display-4" href="index.php">
                        </a>
                </li>
</ul>
            
        </div>
    </nav>
</section>
  <div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container mt-5">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto t-2 ">
              <h3 class="login-heading mb-4">Welcome back!</h3>
              <form action="login.php" method="post">
                <div class="form-label-group">
                  <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
                  <label for="inputEmail">Email address</label>
                </div>

                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                  <label for="inputPassword">Password</label>
                </div>
                <div class="form-label-group">
                <select id="inputState" class="form-control rounded-pill" name="userselecter">
                  <option value='user'>User</option>
                  <option value='admin'>Admin</option>
                </select>
                </div>
                <div class="form-label-group">
                  <select id="inputState" class="form-control rounded-pill" name="canteenselecter">
                              <?php
                              $dropdown=$mysqli->query("SELECT * from canteen");
                              $menu='';
                             while($row = $dropdown->fetch_assoc()){
                                echo "<option value=".$row['cid'].">".str_replace('_',' ',$row['cname']).", ".$row['location']."</option>";
                             }
                              
                              ?>
                    </select>
                </div>
                <div class="text-center">
                <?php if(isset($_SESSION['pvalue']) && $_SESSION['pvalue']=="NO"){?>
                  
                  <p style="color:red;">Wrong email or password!</p>
                  <?php
                  }elseif(isset($_SESSION['pvalue']) && $_SESSION['pvalue']=="ANOTHER"){
                    ?>
                  <p style="color:red;">Sorry, no such user</p>
                  <?php

                  }
                ?>
                </div>
                <button class="btn btn-lg btn-block btn-login text-uppercase font-weight-bold mb-2 bg1" type="submit" name="loginbutton">Sign in</button>
                <div class="text-center">
                  <a class="smalls" href="#">Forgot password?</a></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--
<section class="engine"><a href="https://mobirise.info/r">bootstrap templates</a></section><section class="cid-qTkAaeaxX5" id="footer1-2">
    
    <div class="container">
        <div class="media-container-row content text-white">
            <div class="col-12 col-md-3">
                <div class="media-wrap">
                    <a href="index.html">
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
-->
   <script src="assets/web/assets/jquery/jquery.min.js"></script>
   <script src="assets/web/assets/jquery/jquery.slim.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/parallax/jarallax.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  
  
</body>
</html>