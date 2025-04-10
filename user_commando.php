<html>
<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
<body>
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start(); 
include ("Functioneverwing.php");

Is_Logged_In();

$display="";

$display="
<form name='frmUserCommand' id='frmUserCommand'>
<table width='100%' frame='box'>
<tr>
<td>
<table width='100%' class='borderheading'>
<tr align='center'>
<input type='button' name='cmdsavename' id='cmdsaveid' value='SAVE'  onClick='javascript:usercommand_check()'/>
</tr>
</table>

<table width='50%'>
<tr>
<td width='10%' >
Employee Name :
</td>
<td width='10%'>
<select name='EmpNumbername' id='EmpNumberid'>
";







include ("datasource.php");
$mResult = $mysqli->query("Call spUsersSearch_('".$_POST['EmpNumber']."')");
if (mysqli_num_rows($mResult) > 0)
{
while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
{ 
       $display.="<option value=".$ado["EmpNumber"].">".$ado['EmpFirstName']." ".$ado['EmpLastName']."</option>";
}
}
$display.="</select>";
$display .="</td>
</tr></table>";



$display .="<table width='100%' border='2'>";
include ("datasource.php");
$mResult = $mysqli->query("Call spUserCommandSearch('".$_POST['EmpNumber']."')");
if (mysqli_num_rows($mResult) > 0)
{
$display .="<table width='100%' border='2'>";
$firstrow =0;
$mMenuCode ="";
$mSubMenuCode ="";
$Commands ="";
while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
{
 	if ($firstrow == 0)
	{
		$mMenuCode =$ado['MenuCode'];
		$mSubMenuCode =$ado['SubMenuCode'];
		$firstrow = 1;
		$display .= "<tr align='center'>".$ado["MenuCode"]."</tr>";
		$display .= "<tr align='center'>".$ado['SubMenuCode']."<tr>";
		if ($ado['active']==null)
		{
		$display.="<tr><input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input></tr>";
		}
		else
		{
		$display.="<tr><input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input></tr>";
		}
	}
	else
	{
		if($ado['MenuCode']== $mMenuCode)
		{
			if($ado['SubMenuCode']== $mSubMenuCode)
			{
				if ($ado['active']==null)
				{
				$display.="<tr><input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input></tr>";
				}
				else
				{
				$display.="<tr><input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input></tr>";
				}
			}
			else
			{
				$mSubMenuCode =$ado['SubMenuCode'];
				$display .= "<tr align='center'>".$ado['SubMenuCode']."<tr>";
				if($ado['active']==null)
				{
				$display.="<tr><input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input></tr>";
				}
				else
				{
				$display.="<tr><input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input></tr>";
				}
			}
		}
		else
		{
			$mMenuCode =$ado['MenuCode'];
			$mSubMenuCode =$ado['SubMenuCode'];
			$display .= "<tr align='center'>".$ado["MenuCode"]."</tr>";
			$display .= "<tr align='center'>".$ado['SubMenuCode']."<tr>";
			if($ado['active']==null)
			{
			$display.="<tr><input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input></tr>";
			}
			else
			{
			$display.="<tr><input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input></tr>";
			}
		}

	}
	$Command = $Command.$ado["MenuCode"]."|".$ado["SubMenuCode"]."|".$ado["CmdName"]."|";
	$Command_ = $Command_.$ado["MenuCode"]."*".$ado["SubMenuCode"]."*".$ado["CmdName"]."*|";
}
}
$display .="<input type='text' name='SubMenuName'  id='CmdName' value=".$Command."></input>";
$display .="<input type='text' name='SubMenuName'  id='CmdName_' value=".$Command_."></input>";

$display .="</table>";




$display .="</td>
</tr>
</table>
<!--table main-->
</form>";

echo $display;
		
?>

</body>
</head>
</html>