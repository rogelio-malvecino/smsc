<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
		include ("datasource.php");
		$mResult = $mysqli->query("Call spUserCommandSaving('".$_POST['EmpNumber']."','".$_POST['Values']."')");
		if ($mResult == 1)
			{
				echo $_SESSION['S_MenuLocation']." Successfully Save!";
			}
		else
			{
				
				echo  $mysqli->error."   ".$_SESSION['S_MenuLocation']." Error Saving!";
			}
?>
