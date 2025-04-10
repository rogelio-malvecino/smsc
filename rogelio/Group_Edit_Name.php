<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

include ("datasource.php");

$group_number = $_POST['groupeditnum'];


$mResult = $mysqli->query("select * from item_group");

$mResults = $mysqli->query("select * from item_group where Group_Number='$group_number'");

$ados = $mResults->fetch_array(MYSQLI_BOTH);


$display="";


$display .="<table class='hr' cellpadding='0' align='center'>

<tr><td align='right' colspan='4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='button' type='button' name='cmdcreatename' id='cmdcreateid' value='Search/Records' onClick='javascript:GoTo_GroupSearch()'/></td></tr>

</table>

<br /><br /><br />
<form name='frmGroupsEdit'>
<table class='hrto' cellpadding='0' align='center'>
<tr><td align='right'>Group Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='hidden' name='group_editid_name' id='group_editid_id' value='".$ados['Group_Number']."'><input class='insert'type='text' name='group_edit_name' id='group_edit_id' value='".$ados['Group_Name']."'>&nbsp;&nbsp;
<input class='buttonto' type='button' value='Update' onClick='javascript:Grouping_Update_check()'/>
</td></tr>

</table>
</form>
<br />
<br />

<table class='sortable' id='anyid' >

<tr><th>GROUP NAME</th><th>DELETE</th></tr>";


	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					$display .="
<tr>

<td>

<a href='#' onClick=javascript:Group_Edit_Number('".$ado['Group_Number']."');>".$ado['Group_Name']."</a>

</td>


<td>
<a href='#' onClick=javascript:Group_Delete_to('".$ado['Group_Number']."');>delete</a>
</td></tr>


";

				}
				
		}
	else
		{


		}
		
$display .="</table>";
		
		
		echo $display;

?>
