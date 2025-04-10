<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();


include ("datasource.php");

$GroupNumber = $_POST['GroupNumber'];


$mResult = $mysqli->query("delete from item_group where Group_Number='$GroupNumber'");
if ($mResult == 1)
	{
		echo $_SESSION['S_MenuLocation']." Successfully Delete!";
	}
else
	{
		echo $mysqli->error."  ".$_SESSION['S_MenuLocation']." Error Deleting!";
	}
?>
