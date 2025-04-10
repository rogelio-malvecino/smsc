

<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

$display="";


$display="
<div id='fancyWrap'>
	<div id='buttonPos'>
		<input type='button' name='cmdsavename' id='buttonCreate' value='Save'  onClick='javascript:usercreate_check();'/>
	</div>
<form name='frmUser'>
<center>

<table class='uamone'  cellpadding='0' cellspacing='0'><tr><td>
</td></tr></table>

<br />

<table class='uam' cellpadding='0' cellspacing='0'>

<tr align='left'><th colspan='2' style='background-color:#999'>Users Set up</th></tr>
<tr>
	<td colspan='2'>
		List of Employee who does not have username and password.
	</td>
</tr>
<tr>
<td class='users_'>
Employee Name :
</td>
<td>
<select name='EmpNumbername' id='EmpNumberid'>
";
include ("datasource.php");
$mResult = $mysqli->query("Call spEmpUserFilter()");
if (mysqli_num_rows($mResult) > 0)
{
while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
{
       $display.="<option value=".$ado["EmpNumber"].">".$ado['EmpFirstName']." ".$ado['EmpLastName']."</option>";
}
}
$display.="</select>";
$display .="</td></tr>

<tr>
<td width='25%' class='users_'>
User Name :
</td>
<td>
<input type='text' name='EmpUserNamename' id='EmpUserNamerid' />
</td>


</tr>


<tr>
<td class='users_'>
User Password :
</td>
<td>
<input type='password' name='EmpPasswordname' id='EmpPasswordrid' />
</td>

</tr>


<tr>
<td class='users_'>
Repeat Password :
</td>
<td>
<input type='password' name='EmpPasswordname_' id='EmpPasswordid_' />
</td>

</tr>
</table>

</center>
</form>
</div>
";
echo $display;

			
?>
