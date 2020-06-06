<?php
session_start();
include 'database.php';
$_SESSION["dashboard"]=FALSE;
$_SESSION["tables"]=FALSE;
$_SESSION["user"]=FALSE;
$_SESSION["items"]=TRUE;
$_SESSION["searchorder"]=FALSE;
$error="";
$completed=false;

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
        <div class="content" style="height:100%">
            <div class="col-md-12"> 
             <div class="card card-user">
    <?php
    if(isset($_GET['action'])&& $_GET['action']=="delete"){
            $itemid=$_GET['id'];
            $sql="DELETE from items where item_id='$itemid' limit 1";
            if($mysqli->query($sql)){?>
                <div class="row">
                            <div class="col-md-12 text-center pt-5 pb-5">     
                            <h5 class="card-title"><?= ucfirst($_GET['name']);?> has been deleted succesfully.</h5>
                        </div>
                </div>
                <div class="row">
                        <div class="col-md-12 text-center pb-5">     
                            <a href="items.php" class="btn btn-info btn-round" role="button">Go back</a>
                        </div>
                </div>
        <?php
            }else{

            }
    }else{
        $itemid=$_POST['itemid'];
        if(isset($_POST['itemavailable'])){
            if(emptycheck($_POST['itemname'],$_POST['price'])){
                if(isset($_POST['itemname'])&& !empty($_POST['itemname'])){
                    $newitemname=$mysqli->escape_string($_POST['itemname']);
                    $check = checkname($newitemname);
                    if($check){
                        $sql = "UPDATE items
                        SET itemname = '$newitemname'
                        WHERE item_id = '$itemid'
                        ";
                        if($mysqli->query($sql)){
                            $completed=true;    
                        }else{
                             $error=$error. "Unknown error";
                        }
                    }else{
                        if(!empty($error)){
                            $error=$error . "<br>Item name name not valid";
                        }
                        else{
                            $error="Last name not valid";
                        }
                    }
                }
                if(isset($_POST['price'])&& !empty($_POST['price'])){
                    $newprice=$mysqli->escape_string($_POST['price']);
                    $check = numbercheck($newprice);
                    if($check){
                        $sql = "UPDATE items
                        SET price = '$newprice'
                        WHERE item_id = '$itemid'
                        ";
                        if($mysqli->query($sql)){
                            $completed=true;    
                        }else{
                             $error=$error. "Unknown error";
                        }
                    }else{
                        if(!empty($error)){
                            $error=$error . "<br>Price name not valid";
                        }
                        else{
                            $error="Price not valid";
                        }
                    }
                }
                $av=$_POST['itemavailable'];
                $sql="UPDATE items
                SET available='$av'
                WHERE item_id='$itemid'
                ";
                if($mysqli->query($sql)){
                    $completed=true;    
                }else{
                     $error=$error. "Unknown error";
                }
                
	?>  

            <?php  
            }else{
                $av=$_POST['itemavailable'];
                $sql="UPDATE items
                SET available='$av'
                WHERE item_id='$itemid'
                ";
                if($mysqli->query($sql)){
                    $completed=true;    
                }else{
                     $error=$error. "Unknown error";
                }

            }
         }else{
                    if(emptycheck($_POST['itemname'],$_POST['price'])){
                            if(isset($_POST['itemname'])&& !empty($_POST['itemname'])){
                                $newitemname=$mysqli->escape_string($_POST['itemname']);
                                $check = checkname($newitemname);
                                if($check){
                                    $sql = "UPDATE items
                                    SET itemname = '$newitemname'
                                    WHERE item_id = '$itemid'
                                    ";
                                    if($mysqli->query($sql)){
                                        $completed=true;    
                                    }else{
                                         $error=$error. "Unknown error";
                                    }
                                }else{
                                    if(!empty($error)){
                                        $error=$error . "<br>Item name name not valid";
                                    }
                                    else{
                                        $error="Item name not valid";
                                    }
                                }
                            }
                            if(isset($_POST['price'])&& !empty($_POST['price'])){
                                $newprice=$mysqli->escape_string($_POST['price']);
                                $check = numbercheck($newprice);
                                if($check){
                                    $sql = "UPDATE items
                                    SET price = '$newprice'
                                    WHERE item_id = '$itemid'
                                    ";
                                    if($mysqli->query($sql)){
                                        $completed=true;    
                                    }else{
                                         $error=$error. "Unknown error";
                                    }
                                }else{
                                    if(!empty($error)){
                                        $error=$error . "<br>Price name not valid";
                                    }
                                    else{
                                        $error="Price not valid";
                                    }
                                }
                            }
                    }
                    else{
                        $error=$error."All fields empty here";      
                    }
        }
        if(empty($error)){?>
                <div class="card-header">
                            <h5 class="card-title">Item has been succesfully updated</h5>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 pl-5 pt-1 pb-2">
                           <span class="font-weight-light">New updated item detail</span>
                    </div>
                </div>
                <div class="row pt-2">
                             <div class="col-md-12 col-sm-12 ">
                               <div class="table-responsive">
                                       <table class="table table-bordered">
                                           <tr>
                                               <th width="20%" class="font-weight-light" >Item name</th>
                                               <th width="20%" class="font-weight-light">Price</th>
                                               <th width="20%" class="font-weight-light">Availability</th>
                                           </tr>
                                        
            <?php
            $sql="SELECT * from items where item_id='$itemid'";
            if($result = $mysqli->query($sql)){
                while($row = $result->fetch_assoc()){?>
                                        <tr>
                                           <td class="font-weight-normal"><?php echo $row['itemname'] ?></td>
                                           <td class="font-weight-normal"><?php echo $row['price'] ?></td>
                                           <td class="font-weight-normal"><?php if($row['available']==1){echo "Yes";}else{echo "No";} ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center pt-3 pb-5">     
                                <a href="items.php" class="btn btn-info btn-round" role="button">Continue</a>
                            </div>
                          </div>
                <?php }
            }else{?>
                    <div class="row">
                            <div class="col-md-12 text-center pb-5">     
                                        Sorry, there seems to be some problem. Please try later.
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12 text-center pb-5">     
                                <a href="items.php" class="btn btn-info btn-round" role="button">Go back</a>
                            </div>
                    </div>

            <?php }

        }else{?>
                <div class="card-header text-center">
                    <h5 class="card-title">Sorry, Coundn't Update</h5>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center pb-5">     
                        <?php echo $error;?>
                    </div>
                </div>
                <div class="row">
                            <div class="col-md-12 text-center pt-3 pb-5">     
                                <a href="items.php" class="btn btn-info btn-round" role="button">Go back</a>
                            </div>
                 </div>
        <?php }}
        ?>          
        
                </div>
            </div>
        </div>
    </div>
</body>
<?php
         function numbercheck($number){
            if(!is_numeric($number)){
                return false;
            }else{
                return true;
            }
        }
        function checkname($newname){
            return !preg_match('/[^A-za-z]/', $newname);
          }
        function emptycheck($a,$b){
            if(empty($a) && empty($b)){
                return 0;
            }else{
                return 1;
            }
        }
      
         
?>
</html>