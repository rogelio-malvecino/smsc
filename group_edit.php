<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

include ("datasource.php");



$Group_Number = $_POST['GroupNumber'];
$mResult = $mysqli->query("select * from item_group where Group_Number='$Group_Number'");
$ado = $mResult->fetch_array(MYSQLI_BOTH);
?>

<form name="fRmGroupItem">

<table>
<tr><td>group number</td><td><input type="text" name="group_number_name" id="group_number_id" value="<?echo $ado['Group_Number'];?>"></td><td><input type="button" onclick="javascript:Product_Group_Update()" value="Save"></td></tr>

<tr><td>group name</td><td><input type="text" name="group_name_name" id="group_name_id" value="<?echo $ado['Group_Name'];?>"></td></tr>
</table>

</form>