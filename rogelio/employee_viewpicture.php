<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
include ("datasource.php");
$id=$_GET['id'];
$name=$_GET['name'];
$query = $query=$mysqli->query("SELECT image FROM employeeinformation_detail WHERE EmpNumber = '$id' and imageDescription='$name'");
$row = mysqli_fetch_assoc($query);
header("Content-type: image/jpeg");
echo $row['image'];
?>
