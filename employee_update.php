<?php

session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();


include ("datasource.php");

$empnumber = $_POST['EmpNumber'];
$empfirstname = $_POST['EmpFirstName'];
$empmiddlename = $_POST['EmpMiddleName'];
$emplastname = $_POST['EmpLastName'];
$empemail = $_POST['EmpEmail'];
$empcpnumber = $_POST['EmpCPNumber'];
$empmbnumber = $_POST['EmpMONumber'];
$empgender = $_POST['EmpGender'];
$empstatus = $_POST['EmpStatus'];
$empreligion = $_POST['EmpReligion'];
$empmonth = $_POST['EmpMonth'];
$empday = $_POST['EmpDay'];
$empyear = $_POST['EmpYear'];
$empheight = $_POST['EmpHeight'];
$empweight = $_POST['EmpWeight'];
$emphomeaddress = $_POST['EmpHomeAddress'];
$empcollege = $_POST['EmpCollege'];
$empyrlvlc = $_POST['EmpYrlvlc'];
$emphigh = $_POST['EmpHighSchool'];
$empyrlvlh = $_POST['EmpYrlvlh'];
$empelementary = $_POST['EmpElementary'];
$empyrlvle = $_POST['EmpYrlvle'];



$mResult = $mysqli->query("update employeeinformation set EmpFirstName='$empfirstname',EmpMiddleName='$empmiddlename',EmpLastName='$emplastname',EmpEmail='$empemail',EmpCElpnumber='$empcpnumber',EmpMobileNumber='$empmbnumber',EmpGender='$empgender',EmpStatus='$empstatus',EmpReligion='$empreligion',EmpMonth='$empmonth',EmpDay='$empday',EmpYear='$empyear',EmpWeight='$empweight',EmpHomeAddress='$emphomeaddress',EmpCollege='$empcollege',EmpCYAttended='$empyrlvlc',EmpHigh='$emphigh',EmpYRHattended='$empyrlvlh',EmpElem='$empelementary',EmpELEYRattended='$empyrlvle' where EmpNumber='$empnumber'");


if ($mResult == 1)
	{

		if(isset($_SESSION['S_MenuLocation']) && !empty($_SESSION['S_MenuLocation'])) {
			echo $_SESSION['S_MenuLocation']."&nbsp;&nbsp;Updating Record Successfully Save!";
		} else{
			echo "Updating Record Successfully Save!";
		}
		

	}
else
	{
		echo $mysqli->error."  ".$_SESSION['S_MenuLocation']." Error Saving!";
	}

			
?>
