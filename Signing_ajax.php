<?php
session_start(); 
include ("datasource.php");
global $G_Login;
global $G_UserName;
global $G_UserPassword;
global $G_CompanyID;

$mResult = $mysqli->query("Call spSigningIn('".$_POST['UserName']."','".$_POST['UserPassword']."')");
if (mysqli_num_rows($mResult) > 0)
	{
		while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
			{
			
			$_SESSION['S_Login']="True";
			$_SESSION['S_UserName']=$ado['EmpUserName'];
			$_SESSION['S_UserPassword']=$ado['EmpPassword'];
			$_SESSION['S_EmployeeName']=$ado['EmployeeName'];
			$_SESSION['S_UserID']=$ado['EmpNumber'];
			$_SESSION['S_CompanyID']=$_POST['CompanID'];
			$_SESSION['S_CompanyName']=$_POST['CompanyName'];
			$_SESSION['S_IPID'] = $_SERVER['REMOTE_ADDR'];
			$G_Login="True";
			$G_UserName=$ado['EmpUserName'];
			$G_UserPassword=$ado['EmpPassword'];
			$G_CompanyID=$_POST['CompanyID'];
			
			}
	}
else
	{
	$_SESSION['S_Login']="Failed";
	echo "Failed";
	}

?>