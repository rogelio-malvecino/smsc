<?php

session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();


include ("datasource.php");


$mResult = $mysqli->query("Call spEmployeeSave('".$_POST['EmpNumber']."','".$_POST['EmpFirstName']."','".$_POST['EmpMiddleName']."','".$_POST['EmpLastName']."','".$_POST['EmpEmail']."','".$_POST['EmpCPNumber']."','".$_POST['EmpMONumber']."','".$_POST['EmpGender']."','".$_POST['EmpStatus']."','".$_POST['EmpReligion']."','".$_POST['EmpMonth']."','".$_POST['EmpDay']."','".$_POST['EmpYear']."','".$_POST['EmpHeight']."','".$_POST['EmpWeight']."','".$_POST['EmpHomeAddress']."','".$_POST['EmpCollege']."','".$_POST['EmpYrlvlc']."','".$_POST['EmpHighSchool']."','".$_POST['EmpYrlvlh']."','".$_POST['EmpElementary']."','".$_POST['EmpYrlvle']."')");


if ($mResult == 1)
	{
		echo $_SESSION['S_MenuLocation']."Successfully Save!";

	}
else
	{
		echo $mysqli->error."  ".$_SESSION['S_MenuLocation']." Error Saving!";
	}

			
?>

<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
</head>
<body>
</body>