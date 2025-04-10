<?php
include('datasource.php');
$id=$_GET['id'];
$query=$mysqli->query("SELECT * FROM item_group where GroupNumber='$id'");
$row=$query->fetch_array(MYSQLI_BOTH);
?>

<div class="createcontainer">
		<table class="rap">
		<thead><td colspan="2" align="center"><b>UPDATE PRODUCT</b></td></thead>
		
		<input type="hidden" value="<?php echo $id ?>" id="result" />
		<tr>
        	<td>
            	Name: 
            </td>
            <td>
            	<input type="text" size="30" id="cat" value="<?php echo $row[1] ?>" onBlur="javascript:upper('cat')" onKeyDown="javascript:upper()"/>
            </td>
       </tr>
		
		<tr><td colspan="2" align="right"> <span id="buttoncreate" onClick="javascript:updateProduct()"><center>UPDATE</center></span>
        </td></tr>
		</table>
</div>



