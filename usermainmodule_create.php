<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

$MenuCode ="";
$display="";

$display ="
<center>

<form name='frmUserMainModule' id='frmUserMainModule'>
<table class='uamone'  cellpadding='0' cellspacing='0'><tr><td>
<input class='uamsave' type='button' name='cmdsavename' id='cmdsaveid' value='Save'  onClick='javascript:usermainmodule_check()'/>
</td>
</tr>
</table>
<br />
<table class='uam' cellpadding='0' cellspacing='0'>


<tr align='left'><th colspan='2' style='background-color:#999'>main module set up</th></tr>
<tr><td class='users' colspan='2' style='border-bottom:1px solid #CCCCCC;'>
&nbsp;&nbsp;&nbsp;&nbsp;User Name :&nbsp;


";


include ("datasource.php");
$mResult = $mysqli->query("Call spEmpMenuUsersSelect('".$_GET['id']."')");
if (mysqli_num_rows($mResult) > 0)
{
while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
{
$display.="
<input type='hidden' name='EmpNumbername' id='EmpNumberid' value='".$ado['EmpNumber']."'> 
 ".$ado['EmpFirstName']." ".$ado['EmpLastName']."
";
}
}
$display .="</td>
</tr><tr>";

include ("datasource.php");
   
   
$mResult = $mysqli->query("Call spUserMainModuleSearch('".$_GET['id']."')");

$limit = 2;
$count = 0;



if (mysqli_num_rows($mResult) > 0)
{
while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
{


if($count < $limit){


if($count == 0){

$display .= "<tr>";

}


   $display.="<td class='ummc'>";
    
	if ($ado['active']==null)
	{
	       $display.="<input type='checkbox' name =".$ado["MenuCode"]."  value=".$ado["MenuCode"].">".$ado['MenuName']." </input>";
	       $MenuCode = $MenuCode.$ado["MenuCode"]."|";
	    
	}
	else
	{
	      $display.="<input type='checkbox' name =".$ado["MenuCode"]."  value=".$ado["MenuCode"]." checked>".$ado['MenuName']." </input>";
	       $MenuCode = $MenuCode.$ado["MenuCode"]."|";
	
	}
	      $display .="</td>";

}else{
$count = 0;

   $display.="</tr><tr><td class='ummc'>";
    
	if ($ado['active']==null)
	{
	       $display.="<input type='checkbox' name =".$ado["MenuCode"]."  value=".$ado["MenuCode"].">".$ado['MenuName']." </input>";
	       $MenuCode = $MenuCode.$ado["MenuCode"]."|";
	    
	}
	else
	{
	      $display.="<input type='checkbox' name =".$ado["MenuCode"]."  value=".$ado["MenuCode"]." checked>".$ado['MenuName']." </input>";
	       $MenuCode = $MenuCode.$ado["MenuCode"]."|";
	
	}
	      $display .="</td>";

}
$count++;

}
}


	  
	  
	  
$display .="<input type='hidden' name='MenuCodename'  id='MenuCodeid' value=".$MenuCode."></input>";
$display .="</tr></table>
</form>
</center>

";

echo $display;
?>






