<?php
/*session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
		include ("datasource.php");
		$mResult = $mysqli->query("delete from submenuaccess where EmpNumber = ".stripslashes($_POST['EmpNumber']));
		mysqli_close($mysqli);
		include ("datasource.php");
		$mResult = $mysqli->query("insert into submenuaccess (EmpNumber,MenuCode,SubMenuCode) values ".stripslashes($_POST['Values']));
		mysqli_close($mysqli);
		if ($mResult == 1)
			{
				echo $_SESSION['S_MenuLocation']." Successfully Save!";
			}
		else
			{
				echo  $mysqli->error."   ".$_SESSION['S_MenuLocation']." Error Saving!";
			}
*/

session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
		include ("datasource.php");
		$mResult = $mysqli->query("Call spUserSubMenuSaving('".$_POST['EmpNumber']."','".$_POST['Values']."')");
		if ($mResult == 1)
			{
				echo $_SESSION['S_MenuLocation']." Successfully Save!";
			}
		else
			{
				
				echo  $mysqli->error."   ".$_SESSION['S_MenuLocation']." Error Saving!";
			}



?>