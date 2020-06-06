<?php
//database
$host='localhost';//for now we are working with localhost..later we can use indiviudal user of canteen
$user='root';
$password='';
$db='';
$mysqli=new mysqli($host,$user,$password,$db) or die($mysqli->error);
?>