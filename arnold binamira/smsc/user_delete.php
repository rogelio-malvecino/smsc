<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();


include ("datasource.php");
$info=$_POST['delgo'];

$mResult = $mysqli->query("CALL spUsersDelete('$info')");
if ($mResult == 1)
	{
		echo $_SESSION['S_MenuLocation']." Successfully Delete!";
	}
else
	{
		echo $mysqli->error."  ".$_SESSION['S_MenuLocation']." Error Deleting!";
	}

			
?>
