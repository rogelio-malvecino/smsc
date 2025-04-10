<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

$display=" ";

$display="
<div id='fancyWrap'>
	<div id='buttonPos'>
		<input  type='button' name='cmdsavename' id='buttonCreate' value='SAVE'  onClick='javascript:usercommand_check()'/>
	</div>

<form name='frmUserCommand' id='frmUserCommand'>
<table class='uamone'  cellpadding='0' cellspacing='0'><tr><td align='left'>

</td>
</tr>
</table>
<br />

<table class='uam' cellpading='0' cellspacing='0'>
<tr>
	<th colspan='2' align='left' style='background-color:#999'>
		Command access set up
	
	</th>
</tr>

</tr>s

<tr>
<td class='userc' align='left' colspan='2'>
User Name :
";


include ("datasource.php");
$mResult = $mysqli->query("Call spUsersSearch_('".$_GET['id']."')");
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


include("datasource.php");

$mResult = $mysqli->query("Call spUserCommandSearch('".$_GET['id']."')");

$limit = 2;
$count = 0;


if (mysqli_num_rows($mResult) > 0)
{
$firstrow =0;
$mMenuCode ="";
$mSubMenuCode ="";
$Commands ="";
/*--loop-----*/

while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
{
 	if ($firstrow == 0)
	{
		$mMenuCode =$ado['MenuCode'];
		$mSubMenuCode =$ado['SubMenuCode'];
		$firstrow = 1;
		$display .= "<tr><td class='menucode' colspan='2'>".$ado["MenuCode"] ."&nbsp;&nbsp; ".$ado["SubMenuCode"]."</td></tr>";

		
		if($count < $limit){


			if($count == 0){

			$display .="<tr>";

			}
			$display .="<td class='submenucode' align='left'>";
		
		
		if ($ado['active']==null)
		{
		$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input>";
		}
		else
		{
		$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input>";
		}


			$display .="</td>";

			}else{
			$count = 0;

			$display .="</tr><tr><td class='submenucode' align='left'>";
		
		
		if ($ado['active']==null)
		{
		$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input>";
		}
		else
		{
		$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input>";
		}

			$display .="</td>";

				}
			$count++;
		
		
		
		
		
		
		
		
		
		

	}
	else
	{
		if($ado['MenuCode']== $mMenuCode)
		{
			if($ado['SubMenuCode']== $mSubMenuCode)
			{
			
			
					if($count < $limit){


						if($count == 0){

						$display .="<tr>";

						}
							$display .="<td class='submenucode' align='left'>";

	if ($ado['active']==null)
				{
				$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input>";
				}
				else
				{
				$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input>";
				}


						$display .="</td>";

						}else{
						$count = 0;

						$display .="</tr><tr><td class='submenucode' align='left'>";

								if ($ado['active']==null)
				{
				$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input>";
				}
				else
				{
				$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input>";
				}
							$display .="</td>";

						}
						$count++;
			
			
			
			
			
			
			
			
			
			
			
			
			
			}
			else
			{
				$mSubMenuCode =$ado['SubMenuCode'];
				$display .= "<tr><td  class='menucode' colspan='2'>".$ado['SubMenuCode']."</td></tr>";
				
				if($count < $limit){


if($count == 0){

$display .="<tr>";

}
$display .="<td class='submenucode' align='left'>";

	if($ado['active']==null)
				{
				$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input>";
				}
				else
				{
				$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input>";
				}

$display .="</td>";

}else{
$count = 0;

$display .="</tr><tr><td class='submenucode' align='left'>";
	if($ado['active']==null)
				{
				$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input>";
				}
				else
				{
				$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input>";
				}
$display .="</td>";

}
$count++;
				
			
			}
		}
		else
		{
			$mMenuCode =$ado['MenuCode'];
			$mSubMenuCode =$ado['SubMenuCode'];
		$display .= "<tr><td  class='menucode' colspan='2'>".$ado["MenuCode"] ."&nbsp;&nbsp; ".$ado["SubMenuCode"]."</td></tr>";
			
			if($count < $limit){


if($count == 0){

$display .="<tr>";

}
$display .="<td align='left' class='submenucode'>";

if($ado['active']==null)
			{
			$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input>";
			}
			else
			{
			$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input>";
			}


$display .="</td>";

}else{
$count = 0;

$display .="</tr><tr><td align='left' class='submenucode'>";
if($ado['active']==null)
			{
			$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName'].">".$ado['CmdName']." </input>";
			}
			else
			{
			$display.="<input type='checkbox' name =".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']."  value=".$ado['MenuCode'].$ado['SubMenuCode'].$ado['CmdName']." checked>".$ado['CmdName']." </input>";
			}
$display .="</td>";

}
$count++;
			
			
			
			
			
		}

	}
	$Command = $Command.$ado["MenuCode"]."|".$ado["SubMenuCode"]."|".$ado["CmdName"]."|";
	$Command_ = $Command_.$ado["MenuCode"]."*".$ado["SubMenuCode"]."*".$ado["CmdName"]."*|";
}
}


$display .="</tr>";

$display .="<tr><td><input type='hidden' name='SubMenuName'  id='CmdName' value=".$Command."></input></td></tr>";
$display .="<tr><td><input type='hidden' name='SubMenuName'  id='CmdName_' value=".$Command_."></input></td></tr>";


$display .="
</table><!--table main-->

</form>
</center>
</div>
";



echo $display ;
		
?>
