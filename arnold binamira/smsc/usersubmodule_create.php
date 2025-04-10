
<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
</head>
<body>
</body>

<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

$display="";


$display="
<div id='fancyWrap'>
<center>
<form name='frmUserSubMenu' id='frmUserSubMenu'>


<table class='uamone'  cellpadding='0' cellspacing='0'><tr><td>
<input type='button' class='uamsave' name='cmdsavename' id='cmdsaveid' value='Save'  onClick='javascript:usersubmodule_check()'/>
</td>
</tr>
</table>
<br />


<table class='uam' cellpadding='0' cellspacing='0'>

<tr><th colspan='2' align='lef' style='background-color:#ccc; color:#000;'>sub module set up</th>


</tr>
<tr>
<td class='users' colspan='2' align='left'>
User Name :&nbsp;
";
include("datasource.php");
$mResult = $mysqli->query("Call spUsersSearch_('".$_GET['id']."')");
if (mysqli_num_rows($mResult) > 0)
{
while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
{ 
       $display.="
	   
	   
	   <input type='hidden'  name='EmpNumbername' id='EmpNumberid' value='".$ado['EmpNumber']."'>
	   
	   ".$ado['EmpFirstName']." ".$ado['EmpLastName']."
	   
	   ";
}
}
$display.="</td></tr><tr>";



include ("datasource.php");
$mResult = $mysqli->query("Call spUserSubMenuSearch('".$_GET['id']."','','1')");


$limit = 2;

$count = 0;


if (mysqli_num_rows($mResult) > 0)
{
$mMenuCode="";
$mFirstRow=1;
while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
{
	if ($FirstRow == 1)
	{
	$display.="<tr><td class='menucode' colspan='2'>".$ado['MenuCode']."</th></tr>";
	$FirstRow =2;
	$mMenuCode = $ado['MenuCode'];
	}

	if ($mMenuCode != $ado['MenuCode'])
	{
	$display.="<tr><td class='menucode' colspan='2'>".$ado['MenuCode']."</th></tr>";	
	$FirstRow =2;
	$mMenuCode = $ado['MenuCode'];
	}
	
	
	
	
	
	include ("datasource_.php");
	$mResult_ = $mysqlcnnt->query("Call spUserSubMenuSearch('".$_GET['id']."','".$ado['MenuCode']."','2')");
	if (mysqli_num_rows($mResult_) > 0)
	{
	while ($ado_ = $mResult_->fetch_array(MYSQLI_BOTH))
	{
	
	
	if($count < $limit){


if($count == 0){

$display .="<tr>";

}
$display .="<td class='submenucode' align='left'>";


	if ($ado_['active']==null)
		{
		           $display.="<input type='checkbox' name =".$ado_["SubMenu"]." value=".$ado_["SubMenu"].">".$ado_['SubMenuName']." </input>";
		           $SubMenu = $SubMenu.$ado["MenuCode"]."|".$ado_["SubMenu"]."|";
			
		}
		else
		{
			$display.="<input type='checkbox' name =".$ado_["SubMenu"]." value=".$ado_["SubMenu"]." checked>".$ado_['SubMenuName']." </input>";
			$SubMenu = $SubMenu.$ado["MenuCode"]."|".$ado_["SubMenu"]."|";
		}


$display .="</td>";

}else{
$count = 0;

$display .="</tr><tr><td class='submenucode' align='left'>";

	if ($ado_['active']==null)
		{
		           $display.="<input type='checkbox' name =".$ado_["SubMenu"]." value=".$ado_["SubMenu"].">".$ado_['SubMenuName']." </input>";
		           $SubMenu = $SubMenu.$ado["MenuCode"]."|".$ado_["SubMenu"]."|";
			
		}
		else
		{
			$display.="<input type='checkbox' name =".$ado_["SubMenu"]." value=".$ado_["SubMenu"]." checked>".$ado_['SubMenuName']." </input>";
			$SubMenu = $SubMenu.$ado["MenuCode"]."|".$ado_["SubMenu"]."|";
		}

$display .="</td>";

}
$count++;

	
	
	
	
	}
	}
}
}

$display .="</tr>";
$display .="<tr><td><input type='hidden' name='SubMenuName'  id='SubMenuid' value=".$SubMenu."></input></td></tr>";
$display .="</table>

</form>
</center>
</div>"
;
echo $display;
		
?>



