<?php
include('datasource.php');
$id=$_GET['id'];
$query=$mysqli->query("CALL spmainmenuQuery1('$id')");
$row=$query->fetch_array(MYSQLI_BOTH);
?>
<div class="createcontainer">
	<table class="rap">
		<thead><td colspan="2" align="center"><b>UPDATE MENU</b></td></thead>
		
		<tr><td>Code: </td><td><input type="text" size="30" id="menuCode" height="40" maxlength="30" value="<?php echo $row[0] ?>" onBlur="javascript:upper('marketCode')"/></td></tr>
		
		<tr><td>Name: </td><td><input type="text" size="30" id="menuName" height="40" value="<?php echo $row[1] ?>" onBlur="javascript:upper('marketName')"/></td></tr>
		
		<tr><td colspan="2" align="right"> <span id="buttoncreate" onClick="javascript:updateMenu()"><center>UPDATE</center></span>
        </td></tr>
		</table>
</div>