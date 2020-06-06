<?php
session_start();
if(isset($_SESSION['ladminin']) && $_SESSION['ladminin'] == true){
  header('location: http://'.$_SERVER['HTTP_HOST'].'/minortest/admin/adminpanel/phpfiles/dashboard.php');
}
if(isset($_SESSION['luserin']) && $_SESSION['luserin'] == true){
    header('location: http://'.$_SERVER['HTTP_HOST'].'/minortest/menu.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Site made with Mobirise Website Builder v4.10.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="">
  
  <title>Home</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>
  <section class="cid-qTkA127IK8 mbr-fullscreen mbr-parallax-background" id="header2-1">

    

    

    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    CANTEEN MANAGEMENT SYSTEM</h1>
                
                
                <div class="mbr-section-btn"><a class="btn btn-md btn-secondary display-4" href="login.php">SIGN IN</a>
                    <a class="btn btn-md btn-white-outline display-4" href="chooser.php">REGISTER</a></div>
                    <br> <p><a href="howto.html" style="color:white">How to use the system?<a></p>
                </div>
                
        </div>
    </div>
    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next">
            <i class="mbri-down mbr-iconfont"></i>
        </a>
    </div>
</section>

<section class="engine"><a href="https://mobirise.info/r">bootstrap templates</a></section><section class="cid-qTkAaeaxX5" id="footer1-2">

    

    

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
                    <a href="aboutus.html" style="color:white">About us</a>
                </h5>
               
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
  <script src="assets/parallax/jarallax.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
  
</body>
</html>