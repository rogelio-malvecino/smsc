<?php

session_start(); 
include ("datasource.php");
$_SESSION['S_MenuLocation']="";
$mResult = $mysqli->query("Call spSearchMenuLocation('".$_POST['SubMenu']."')");
if (mysqli_num_rows($mResult) > 0)
	{
		while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
			{
			$_SESSION['S_MenuLocation'] = $ado['MenuName']." - ".$ado['SubMenuName'];
			echo $ado['MenuName']." - ".$ado['SubMenuName']. " -Search";

			}
	}
else
	{
	echo "Location not found";
	}

?>