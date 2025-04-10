<?php
include('datasource.php');
$id=$_GET['id'];
$query=$mysqli->query("CALL spmarketingQuery1('$id')");
$row=$query->fetch_array(MYSQLI_BOTH);
?>

<div class="createcontainer">
	<table class="rap">
    	<input type="hidden" value="<?php echo $id ?>" id="result" />
		<thead><td colspan="2" align="center"><b>UPDATE MARKETING GROUP</b></td></thead>
		
		<tr><td>Code: </td><td><input type="text" size="30" id="marketCode" value="<?php echo $row[0] ?>" onBlur="javascript:upper('marketCode')"/></td></tr>
		
		<tr><td>Name: </td><td><input type="text" size="30" id="marketName" value="<?php echo $row[1] ?>" onBlur="javascript:upper('marketName')"/></td></tr>
		
		<tr><td colspan="2" align="right"><span id="buttoncreate" onClick="javascript:updateMarketing()"><center>UPDATE</center></span>
        </td></tr>
		</table>
</div>


        
         