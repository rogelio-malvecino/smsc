<?php
session_start();
include("datasource.php");
$info=$_POST['delgo'];
$content="";
$query= $mysqli->query("CALL spproductDelete($info)");
if($query==1)
{
	$content.= $_SESSION['S_MenuLocation']." -Record deleted";
}
else
{
	$content.= $_SESSION['S_MenuLocation'].mysqli_error();
}
echo ($content);

?>


