<?php
session_start();
include 'database.php';
$_SESSION["dashboard"]=FALSE;
$_SESSION["tables"]=FALSE;
$_SESSION["user"]=FALSE;
$_SESSION["items"]=TRUE;
$_SESSION["searchorder"]=FALSE;
if(isset($_GET['action'])){
    if($_GET['action'] == "edit"){
        $_SESSION['edit']=TRUE;
    }else{
        $_SESSION['edit']=FALSE;
    }
}else{
    $_SESSION['edit']=FALSE;
}
if(isset($_GET['deleteall'])){
    $sql="TRUNCATE TABLE items";
    $result=$mysqli->query($sql);
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
    <div class="content " style="height:100%">
        <div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Update the food items for <span class="text-primary"><?= DATE('F,j,Y');?></span></h5>
              </div>
              <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <a href="additem.php" class="btn btn-info btn-round" role="button">Add new items</a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 offset-md-3 text-center d-felx align-items-center justify-content-center">
                    OR
                </div>
              </div>
              <div class="card-body">
              <div class="row">
               
                <?php 
                    $sql="SELECT * FROM items";
                    $result=$mysqli->query($sql);
                    if(($result->num_rows)!=0){
                        $empty = false;
                ?>
                <div class="col-md-6 d-flex align-items-center">
                    <h6 class="font-weight-normal">Update your current inventory:</h6>
                </div>
                <div class="col-md-6 text-right">
                <form action="" method="GET">
                    <button class="btn btn-outline-danger btn-round" name="deleteall">Delete all items</button>
                </form>
                </div>
                    <?php }else{
                            $empty = true;
                        ?>
                        </div>
                        <div class="row pt-5">
                            <div class="col-md-12 text-center">
                                <h5 class="font-weight-light">
                                    No items present. Add a few items.
                                </h5>
                            </div>
                        </div>
                    <?php }?>
              </div>
                    <?php 
                        if($empty == false){
                        $sql="SELECT * FROM items";
                        if($result=$mysqli->query($sql)){
                             ?>
                             <div class="row">
                             <div class="col-md-12 col-sm-12 pt-1">
                               <div class="table-responsive">
                                       <table class="table table-bordered">
                                           <tr>
                                               <th width="20%" class="font-weight-light" >Item name</th>
                                               <th width="20%" class="font-weight-light">Price</th>
                                               <th width="20%" class="font-weight-light">Availability</th>
                                               <th width="20%" class="font-weight-light">Action</th>
                                               <th width="20%" class="font-weight-light">Delete</th>
                                           </tr>
                                        <?php
                                            while($values=$result->fetch_assoc()){
                                        ?>
                                           <tr>
                                           <td class="font-weight-normal"><?php echo $values['itemname'] ?></td>
                                           <td class="font-weight-normal"><?php echo $values['price'] ?></td>
                                           <td class="font-weight-normal"><?php if($values['available']==1){echo "Yes";}else{echo "No";} ?></td>
                                           <td class="font-weight-normal text-center"><a href="items.php?action=edit&name=<?= $values['itemname'];?>&id=<?= $values['item_id'];?>">Edit</td>
                                           <td class="font-weight-normal text-center"><a href="updateitem.php?action=delete&name=<?= $values['itemname'];?>&id=<?= $values['item_id'];?>">Delete</td>
                                           </tr>
                                            <?php } ?>
                                       </table>
                               </div>
                             </div>
                           </div>
                           
                        <?php
                         if(isset($_SESSION['edit']) && $_SESSION['edit']){
                         ?>
                         <div class="row pt-5">
                            <div class=" col-md-6">
                                <h6 class="font-weight-normal text-danger">Edit <?= $_GET['name']?></h6>
                            </div>
                        </div>
                         <form action="updateitem.php" method="POST">
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
                                        <input type="hidden" value="<?php echo $_GET['id']?>" name="itemid">
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
                                            <button type="submit" class="btn btn-primary btn-round" name="update">Update Items</button>
                                        </div>
                                        </div>
                                    </div>
                            </form>
                        <?php
                        }
                        }else{
                            echo "We are having few issues at this moment.Please try again later";
                        }
                    }
                    ?>
              </div>
            </div>
        </div>
    </div>
</body>
</html>