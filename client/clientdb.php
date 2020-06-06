<?php
//database
$host='localhost';
$user='root';
$password='';
$db='accounts';
$mysqliclientdb=new mysqli($host,$user,$password,$db) or die($mysqli->error);
?>