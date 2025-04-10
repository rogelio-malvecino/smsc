<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

include ("datasource.php");

$groupnumber = $_POST['ItemGroupNumber'];
$groupname = $_POST['ItemGroupName'];

$mResult = $mysqli->query("insert into item_group (`Group_Number`,`Group_Name`,`Author`)values('$groupnumber','$groupname','$author')");

if ($mResult == 1)
	{
		echo $_SESSION['S_MenuLocation']."Record Successfully Save!";
	}
else
	{
		echo $mysqli->error."  ".$_SESSION['S_MenuLocation']." Error Saving!";
	}
?>

