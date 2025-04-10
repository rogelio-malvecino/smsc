<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();


include ("datasource.php");


$mResult = $mysqli->query("Call spEmpUserUpdate('".$_POST['EmpNumber']."','".$_POST['EmpUserName']."','".$_POST['EmpPassword']."')");
if ($mResult == 1)
	{
		echo $_SESSION['S_MenuLocation']." Successfully Update!";
	}
else
	{
		echo  $mysqli->error."   ".$_SESSION['S_MenuLocation']." Error Saving!";
	}


			
?>
