<?php
session_start();
$_SESSION["dashboard"]=False;
$_SESSION["tables"]=FALSE;
$_SESSION["user"]=FALSE;
$_SESSION["items"]=TRUE;
$_SESSION["searchorder"]=FALSE;
include 'database.php';
$error="";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Admin Panel
  </title>
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
</head>


<body class="">
  <div class="wrapper ">
	<?php
		include("sidebar.php");
	?>
    <div class="main-panel">
    <!-- Navbar -->
    <?php
		include("navbar.php");
	?>
    <!-- End Navbar -->
        <div class="content">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="card-header">
                        <h5>Add a new item</h5>
                    </div>
                    <div class="container form-container">
                        <form action="" method="POST">
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Item Name</label>
                                                    <input type="text" class="form-control" placeholder="Item Name" name="itemname">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input type="text" class="form-control" placeholder="Price" name="price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-label-group">
                                                    <label>Available</label>
                                                        <select id="inputState" class="form-control" name="itemavailable">
                                                            <option selected disabled>Choose Availability</option>
                                                            <option value='1'>Yes</option>
                                                            <option value='0'>No</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="update ml-auto mr-auto">
                                                <button type="submit" class="btn btn-primary btn-round" name="additem">Add Item</button>
                                            </div>
                                        </div>
                            </form>
                        </div>
                            <?php if(isset($_POST['additem'])){
                                        if(isset($_POST['itemname'])&& isset($_POST['price']) && !empty($_POST['itemname']) && !empty($_POST['price']) && isset($_POST['itemavailable'])){
                                            $itemname=$mysqli->escape_string($_POST['itemname']);
                                            $check=checkname($itemname);
                                            if($check){
                                                $price=$mysqli->escape_string($_POST['price']);
                                                $checknumber=numbercheck($price);
                                                if($checknumber){
                                                    $av=$_POST['itemavailable'];
                                                    $sql="INSERT into items(itemname,price,available)"."VALUES('$itemname','$price','$av')";
                                                    if($mysqli->query($sql)){
                                                            $completed=true;
                                                    }
                                                    else{
                                                        $error=$error."<br>Couldnt add the item at this moment. Please try again later";
                                                    }
                                                }else{
                                                    $error=$error."<br>Price not valid";
                                                }
                                            }else{
                                                $price=$mysqli->escape_string($_POST['price']);
                                                $checknumber=numbercheck($price);
                                                if(!$checknumber){
                                                    $error=$error."<br>Price not valid";
                                                }
                                                    $error=$error."<br>Item name not valid";
                                            }
                                
                            }else{
                                    $error=$error. "<br>Please fill the form completely";
                            }
                            if(empty($error)){?>
                                    <div class="container pt-5">
                                        <div class="row">
                                            <div class="col-md-12 text-center"><h5 class="font-weight-light">Item has been added succesfully</h5></div>
                                        </div>
                                    </div>
                            <?php }else{ ?>
                                    <div class="container pt-5">
                                        <div class="row">
                                            <div class="col-md-12 text-center"><h5 class="font-weight-light">Sorry, couldn't add item</h5></div>
                                        </div>
                                        <div class="row pb-5">
                                            <div class="col-md-12 text-center"><?= $error ?></div>
                                        </div>
                                    </div>
                                <?php }
                        } ?>
                </div>
            </div>
        </div>

      </div>
      </div>
    </body>
    <?php
         function checkname($newname){
            return !preg_match('/[^A-za-z ]/', $newname);
          }
        function numbercheck($number){
            if(!is_numeric($number)){
                return false;
            }else{
                return true;
            }
        }
    ?>
    </html>