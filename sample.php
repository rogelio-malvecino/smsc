<?
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();		
require("connection.php");

include ("datasource.php");



$mResult = $mysqli->query("delete from item_group where Group_Number='$_POST[GRoupNumBeR]'");

if ($mResult == 1)
	{
		echo $_SESSION['S_MenuLocation']." Successfully Delete!";
	}
else
	{
		echo $mysqli->error."  ".$_SESSION['S_MenuLocation']." Error Deleting!";
	}




?>