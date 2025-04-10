<?php
$link = mysql_connect("localhost", "root", "vertrigo");
mysql_select_db("emasterlist");
$id=$_GET['id'];
$name=$_GET['name'];
$sql = "SELECT image from employeeinformation_detail where EmpNumber='$id' and imageDescription='$name'";
$result = mysql_query("$sql");
header("Content-type: image/jpg");
echo mysql_result($result, 0);
mysql_close($link);
?>
