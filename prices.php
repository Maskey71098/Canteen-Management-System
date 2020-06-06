<?php
$host='localhost';
$user='root';
$password='';
$db=$_SESSION['datbasesession'];
$mysqli=new mysqli($host,$user,$password,$db) or die($mysqli->error);
?>