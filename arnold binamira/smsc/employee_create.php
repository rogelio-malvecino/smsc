<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
$display.="
<div id='fancyWrap'>
<center>
 

<form name='frmEmployee'>

<table cellpadding='0' style='margin-top:20px;' class='tblInfo'>
<tr>
	<td colspan='4' style='border-bottom:2px double #006600; font-weight:bold;'>
		FORM - HUMAN RESOURCES&nbsp;
	</td>
</tr>
<tr>
	<td colspan='4'>
		&nbsp;
	</td>
</tr>
<tr>
	<td>
	</td>
</tr>
<tr>
	<td>
		Employee number:
	</td>
	<td colspan='3'>
		<input type='text' name='EmpNumbername' id='EmpNumberid' />
	</td>
</tr>

<tr>
	<td>
		Employee name:
	</td>
	<td>
		<input type='text' name='EmpFirstNamename' id='EmpFirstNamerid' placeholder='Firstname' onblur='javascript:proper('EmpfirstNamerid')' onkeypress='return Alpha(event)'/>
	</td>
	<td>
		<input type='text' name='EmpMiddleNamename' id='EmpMiddleNamerid' placeholder='Middle Name' onkeypress='return Alpha(event)'/>
	</td>
	<td>
		<input type='text' name='EmpLastNamename' id='EmpLastNamerid'  placeholder='Lastname' onkeypress='return Alpha(event)'/>
	
	</td>
</tr>





<tr>
	<td colspan='4' align='center'>&nbsp;
	</td>
</tr>
<tr>
	<td colspan='4' align='center'>&nbsp;
	</td>
</tr>
<tr class='title'>
	<td colspan='4' style='border-bottom:2px double #006600;font-size:18px; font-weight:bold;'>
		Contact information
	</td>
</tr>

<tr>
	<td colspan='4' align='center'>&nbsp;
	</td>
</tr>

<tr>
	<td>
		Cellphone Number:
	</td>
	<td colspan='3'>
		<input type='text' name='EmpCPNumbername' id='EmpCPNumberid' onkeypress='return isNumberKey(event)'/>
	</td>
</tr>

<tr>
	<td>
		Mobile number
	</td>
	<td colspan='3'>
		<input type='text' name='EmpMobileNumbername' id='EmpMobileNumberid' onkeypress='return isNumberKey(event)'/>
	</td>
</tr>
<tr>
	<td>
		Email Address:
	</td>
	<td colspan='3'>
		<input type='text' name='EmpEmailname' id='EmpEmailid' size='40' onBlur='javascript:Validate()'/>
		<span id='valid' style='color:red;display:none'> 
				Invalid Email Address!
		</span>
	</td>
</tr>
<tr>
	<td colspan='4' align='center'>&nbsp;
	</td>
</tr>
	
<tr>
	<td colspan='4' style='border-bottom:2px double #006600;font-size:15px; font-size:18px; font-weight:bold;'>
		Personal Information
	</td>
</tr>

<tr>
	<td colspan='4' align='center'>&nbsp;
	</td>
</tr>


<tr>
	<td>
		Gender
	</td>
	<td colspan='3'>
		<select name='EmpGendername' id='EmpGenderid' style='width:80px;'>
			<option>
				Male
			</option>
			<option>
				Female
			</option>
		</select>
	</td>
</tr>


<tr>
	<td>
		Status
	</td>
	<td colspan='3'>
	<select name='EmpStatusname' id='EmpStatusid' style='width:80px;'>
		<option>
			Single
		</option>
		<option>
			Married
		</option>
	<option>
		Live in
	</option>
	</select>
	</td>
</tr>


<tr><td>Religion</td><td colspan='3'><input type='text' name='EmpReligionname' id='EmpReligionid'  /></td></tr>


<tr><td>Birthdate</td><td><select class='select' name='EmpMonthname' id='EmpMonthid' style='width:126px;'>
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



</select>
</td>
	<td>

		<input class='bday' type='text' name='EmpDayname' id='EmpDayid'  />&nbsp;
		<input class='bday'  type='text' name='EmpYearname' id='EmpYearid'  />
	</td>
</tr>



<tr>
	<td>
		Height
	</td>
	<td colspan='3'>
		<input type='text' id='EmpHeightid' size='3' onkeypress='return isNumberKey(event)' maxlength='2'/> ft. &nbsp;&nbsp; <input type='text' id='EmpInch' size='3' onkeypress='return isNumberKey(event)' maxlength='2'/> Inches
	</td>
</tr>
<tr>
	<td>
		Weight
	</td>
	<td colspan='3'>
		<input type='text' name='EmpWeightname' id='EmpWeightid' onkeypress='return isNumberKey(event)' size='3' maxlength='3'/> Kilo
	</td>
</tr>


<tr>
	<td>
		Present-Home Address
	</td>
	<td colspan='3'>
		<textarea rows='1' cols='50' name='EmpHomeAddressname' id='EmpHomeAddressid'>
		</textarea>
	</td>
</tr>

<tr>
	<td colspan='4' align='center'>&nbsp;
	</td>
</tr>
<tr>
	<td colspan='4' align='center'>
		&nbsp;
	</td>
</tr>


<tr>
	<td colspan='4' style='border-bottom:2px double #006600;font-size:15px; font-size:18px; font-weight:bold;'>
		Educational background
	</td>
</tr>

<tr>
	<td colspan='4' align='center'>&nbsp;
	</td>
</tr>
<tr>
	<td>
		College
	</td>
	<td colspan='3'>
		<textarea rows='1' cols='50' name='EmpCollegename' id='EmpCollegeid' onkeypress='return Alpha(event)'>
		</textarea>
	</td>
</tr>
<tr>
	<td>
		Year attended
	</td>
	<td colspan='3'>
		<input type='text' name='EmpSYCollegename' id='EmpSYCollegeid'  >
	</td>
</tr>



<tr>
	<td colspan='4' align='center'>&nbsp;
	</td>
</tr>


<tr>
	<td>
		High School:
	</td>
	<td colspan='3'>
		<textarea rows='1' cols='50' name='EmpHighSchoolname' id='EmpHighSchoolid'>
		</textarea>
	</td>
</tr>
<tr>
	<td>
		Year attended:
	</td>
	<td  colspan='3'>
		<input type='text' name='EmpSYHighname' id='EmpSYHighid' />
	</td>
</tr>
<tr>
	<td colspan='4'>
		&nbsp;
	</td>
</tr>
<tr>
  <td>
		Elementary School:
	  </td>
	  <td colspan='3'>
	  <textarea rows='1' cols='50' name='EmpElementaryname' id='EmpElementaryid'>
	  </textarea>
   </td>
 </tr>


<tr>
	<td>
		Year attended:
	</td>
	<td colspan='3'>
		<input type='text' name='EmpSYElemname' id='EmpSYElemid' >
	</td>
</tr>
<tr>
	<td colspan='4' align='center'>&nbsp;
	</td>
</tr>
<tr>
	<td colspan='4' align='center'>&nbsp;
	</td>
</tr>
<tr>
	<td>
			
			<input class='button' type='button' name='cmdsavename' id='buttonCreate' value='SAVE'  onClick='javascript:employee_check()'/>
			<input type='button' value='Check' onClick='javascript:checkVal()'>
	</td>
</tr>
</table>
</form>
</center>
</div>
";
echo $display;


?>


<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
</head>
<body>
</body>


