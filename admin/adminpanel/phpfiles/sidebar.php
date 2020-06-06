<?php
  if($_SESSION['ladminin'] != true){
    header('location: http://'.$_SERVER['HTTP_HOST'].'/minortest/error.php');
  }
?>
  <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
        </a>
        <a href="" class="simple-text logo-normal">
         <?php $fullname=$_SESSION['first_name'].' '.$_SESSION['last_name']; 
                echo $fullname;
          ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
		
		<?php if($_SESSION["dashboard"]==TRUE) : ?>
			<li class="active">
		<?php else : ?>
			<li class="">
		<?php endif; ?>
          
            <a href="./dashboard.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
		  <!-- not used buttons in sidebar
          <li>
            <a href="./icons.html">
              <i class="nc-icon nc-diamond"></i>
              <p>Icons</p>
            </a>
          </li>
          <li>
            <a href="./map.html">
              <i class="nc-icon nc-pin-3"></i>
              <p>Maps</p>
            </a>
          </li>
          <li>
            <a href="./notifications.html">
              <i class="nc-icon nc-bell-55"></i>
              <p>Notifications</p>
            </a>
          </li>
		  -->
        <?php if($_SESSION["user"]==TRUE) : ?>
			<li class="active">
		<?php else : ?>
			<li class="">
		<?php endif; ?>
            <a href="./user.php">
              <i class="nc-icon nc-single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          <?php if($_SESSION["searchorder"]==TRUE) : ?>
			<li class="active">
		<?php else : ?>
			<li class="">
		<?php endif; ?>
            <a href="./searchorder.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Search Order</p>
            </a>
          </li>
          <?php if($_SESSION["items"]==TRUE) : ?>
			<li class="active">
		<?php else : ?>
			<li class="">
		<?php endif; ?>
            <a href="./items.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Items</p>
            </a>
          </li>
        <?php if($_SESSION["tables"]==TRUE) : ?>
			<li class="active">
		<?php else : ?>
			<li class="">
		<?php endif; ?>
            <a href="./tables.php">
              <i class="nc-icon nc-tile-56"></i>
              <p>Table List</p>
            </a>
		  </li>
		   <!-- not used button in sidebar
          <li>
            <a href="./typography.html">
              <i class="nc-icon nc-caps-small"></i>
              <p>Typography</p>
            </a>
          </li>
		  -->
        </ul>
      </div>
    </div>