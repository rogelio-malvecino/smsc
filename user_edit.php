<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

$display="";


$display="
<form name='frmUser'>
<div id='fancyWrap'>
	<div id='buttonPos'>
		<input type='button' name='cmdsavename' id='buttonCreate' value='Update'  onClick='javascript:user_check();'/>
	</div>
<br>

<table class='uam' cellpadding='0' cellspacing='0'>

<tr align='left'><th colspan='2' style='background-color:#999'>Users Setup</th></tr>
 
<tr>
<td class='users_'>
Employee Name :
</td>
<td class='users_'>





";
include ("datasource.php");
$mResult = $mysqli->query("Call spEmpUsersSelect('".$_GET['id']."')");
if (mysqli_num_rows($mResult) > 0)
{
while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
{ 
       $display.="
	   <input type='hidden' name='EmpNumbername' id='EmpNumberid' value='".$ado['EmpNumber']."'>  ".$ado['EmpFirstName']." ".$ado['EmpLastName']."
	   ";
}
}

$display .="</td>

</tr>

<tr>

<td width='25%' class='users_'>
New User Name :
</td>
<td>
<input type='text' name='EmpUserNamename' id='EmpUserNamerid' />
</td>


</tr>
<tr>
<td class='users_'>
New User Password :
</td>
<td>
<input type='password' name='EmpPasswordname' id='EmpPasswordrid' />
</td>

</tr>


<tr>
<td class='users_'>
Repeat New Password :
</td>
<td>
<input type='password' name='EmpPasswordname_' id='EmpPasswordid_' onkeydown='javascript:verify()'/>
</td>


</tr>
</table>


</form>


</center>

</div>
<div id='notMatch' style='display:none;'>
Password Verification: Didn't Match
</div>
<div id='Match' style='display:none'>
Password Verification: Match
</div>
"
;
echo $display;

			
?>
