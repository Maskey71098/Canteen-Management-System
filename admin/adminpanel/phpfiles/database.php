<?php

$username= "root";
$password= "";
$servername = "localhost";
$db=$_SESSION['datbasesession'];
$mysqli=new mysqli($servername,$username,$password,$db) or die($mysqli->error());

?>