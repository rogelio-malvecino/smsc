<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

include ("datasource.php");
$mResult = $mysqli->query("Call spEmployeeSelect('".$_GET['id']."')");
$ado = $mResult->fetch_array(MYSQLI_BOTH);





$display="
<div id='fancyWrap'>
<center>
<form name='frmEmployee'>

<table cellpadding='0' class='tblInfo'>



<tr>
	<td colspan='4'>&nbsp;
	</td>
</tr>

<tr>
	<td colspan='4' style='border-bottom:2px double #006600;'>
		FORM - HUMAN RESOURCES&nbsp;
	</td>
</tr>
<tr>
	<td colspan='4'>&nbsp;
	</td>
</tr>
<tr>
	<td>
	</td>
</tr>
<tr>
	<td>
		Name:
	</td>
	<td>
		<input type='text' name='EmpFirstNamename' id='EmpFirstNamerid' value='".$ado['EmpFirstName']."'

 onfocus='if (this.value == '".$ado['EmpFirstName']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpFirstName']."';}' 

 />
 	</td>
	<td>
<input type='text' name='EmpMiddleNamename' id='EmpMiddleNamerid' value='".$ado['EmpMiddleName']."'
 onfocus='if (this.value == '".$ado['EmpMiddleName']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpMiddleName']."';}' 

/></td><td><input type='text' name='EmpLastNamename' id='EmpLastNamerid' value='".$ado['EmpLastName']."' 
 onfocus='if (this.value == '".$ado['EmpLastName']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpLastName']."';}' 
/><input type='hidden' name='EmpNumbername' id='EmpNumberid' value='".$ado['EmpNumber']."'/></td></tr>
<tr><td colspan='4' align='center'>&nbsp;</td></tr>
<tr><td colspan='4' align='center'>&nbsp;</td></tr>
<tr><td colspan='4' style='border-bottom:2px double #006600;font-size:15px;'>Contact information</td></tr>

<tr><td colspan='4' align='center'>&nbsp;</td></tr>

<tr><td>Email Adrress</td><td colspan='3'><input type='text' name='EmpEmailname' id='EmpEmailid' value='".$ado['EmpEmail']."' 
 onfocus='if (this.value == '".$ado['EmpEmail']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpEmail']."';}' 
 /></td></tr>



<tr><td>Cellphone Number</td><td colspan='3'><input type='text' name='EmpCPNumbername' id='EmpCPNumberid' value='Cellphone Number' onFocus='if (this.value == 'Cellphone Number') {this.value = '';} '
onblur='if(this.value == ''){this.value = 'Cellphone Number';}' /></td></tr>

<tr><td>Mobile number</td><td colspan='3'><input type='text' name='EmpMobileNumbername' id='EmpMobileNumberid' value='".$ado['EmpMobileNumber']."'
 onfocus='if (this.value == '".$ado['EmpMobileNumber']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpMobileNumber']."';}' 
 /></td></tr>


<tr><td colspan='4' align='center'>&nbsp;</td></tr>

<tr><td colspan='4' style='border-bottom:2px double #006600;font-size:15px;'>Personal Information</td></tr>

<tr><td colspan='4' align='center'>&nbsp;</td></tr>


<tr><td>Gender</td><td colspan='3'><select name='EmpGendername' id='EmpGenderid'>

<option>".$ado['EmpGender']."</option>
<option>Male</option>
<option>Female</option>
</select></td></tr>


<tr><td>Status</td><td colspan='3'><select name='EmpStatusname' id='EmpStatusid'>

<option>".$ado['EmpStatus']."</option>
<option>Single</option>
<option>Married</option>
<option>Live in</option>
</select></td></tr>


<tr><td>Religion</td><td colspan='3'><input type='text' name='EmpReligionname' id='EmpReligionid' value='".$ado['EmpReligion']."' 
 onfocus='if (this.value == '".$ado['EmpReligion']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpReligion']."';}' 
/></td></tr>


<tr><td>Birthdate</td><td><select class='select' name='EmpMonthname' id='EmpMonthid'>
<option>".$ado['EmpMonth']."</option>
<option>January</option>
<option>February</option>

<option>March</option>
<option>April</option>
<option>May</option>
<option>June</option>
<option>July</option>
<option>August</option>
<option>September</option>
<option>October</option>
<option>November</option>
<option>December</option>



</select></td><td colspan='2'><input class='bday' type='text' name='EmpDayname' id='EmpDayid' value='".$ado['EmpDay']."' 
 onfocus='if (this.value == '".$ado['EmpDay']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpDay']."';}' 
>&nbsp;<input class='bday'  type='text' name='EmpYearname' id='EmpYearid' value='".$ado['EmpYear']."'  
 onfocus='if (this.value == '".$ado['EmpYear']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpYear']."';}' 
/></td></tr>


<tr>
<td>
		Height
	</td>
	<td colspan='3'>
		<input type='text' id='EmpHeightid' size='3' onkeypress='return isNumberKey(event)' maxlength='2' value='".$ado['EmpWeight']."'/> ft. &nbsp;&nbsp;
	</td>
</tr>


<tr><td>Weight</td><td colspan='3'><input type='text' name='EmpWeightname' id='EmpWeightid' value='".$ado['EmpWeight']."'  onfocus='if (this.value == '".$ado['EmpWeight']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpWeight']."';}'
/></td></tr>


<tr><td>Present-Home Address</td><td colspan='3'><textarea rows='1' cols='50' name='EmpHomeAddressname' id='EmpHomeAddressid'>".$ado['EmpHomeAddress']."</textarea></td></tr>

<tr><td colspan='4' align='center'>&nbsp;</td></tr>
<tr><td colspan='4' align='center'>&nbsp;</td></tr>


<tr><td colspan='4' style='border-bottom:2px double #CCC;font-size:15px;'>Educational background</td></tr>

<tr><td colspan='4' align='center'>&nbsp;</td></tr>
<tr><td>College</td><td colspan='3'><textarea rows='1' cols='50' name='EmpCollegename' id='EmpCollegeid'>".$ado['EmpCollege']."</textarea></td></tr>
<tr><td>Year attended</td><td colspan='3'><input type='text' name='EmpSYCollegename' id='EmpSYCollegeid' value='".$ado['EmpCYAttended']."'    onfocus='if (this.value == '".$ado['EmpCYAttended']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpCYAttended']."';}'/></td></tr>



<tr><td colspan='4' align='center'>&nbsp;</td></tr>


<tr><td>High School</td><td colspan='3'><textarea rows='1' cols='50' name='EmpHighSchoolname' id='EmpHighSchoolid'>".$ado['EmpHigh']."</textarea></td></tr>
<tr><td>Year attended</td><td  colspan='3'><input type='text' name='EmpSYHighname' id='EmpSYHighid' value='".$ado['EmpYRHattended']."'   onfocus='if (this.value == '".$ado['EmpYRHattended']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpYRHattended']."';}'></td></tr>



<tr><td colspan='4'>&nbsp;</td></tr>


<tr>
  <td>Elementary School</td><td colspan='3'><textarea rows='1' cols='50' name='EmpElementaryname' id='EmpElementaryid'>".$ado['EmpElem']."</textarea></td></tr>


<tr><td>Year attended</td><td colspan='3'><input type='text' name='EmpSYElemname' id='EmpSYElemid' value='".$ado['EmpELEYRattended']."' onfocus='if (this.value == '".$ado['EmpELEYRattended']."') {this.value = '';
 this.style.color='black';} '

onblur='if(this.value == ''){this.value = '".$ado['EmpELEYRattended']."';}'></td></tr>
<tr><td colspan='4' align='center'>&nbsp;</td></tr>
<tr><td colspan='4' align='center'>&nbsp;</td></tr>
<tr>
<td align='right' colspan='4'><input class='button' type='button' name='cmdsavename' id='buttonCreate' value='UPDATE'  onClick='javascript:employee_update()'/>&nbsp;&nbsp;</td></tr>

</table>
</form>

</center>

</div>";
echo $display;
?>
<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
</head>
<body>
</body>











