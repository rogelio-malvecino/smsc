<?php
session_start();
include("datasource.php");
$info=$_POST['delgo'];
$content="";
//$query= $mysqli->query("DELETE FROM marketing_group where MarketingCode='$info'");
$query=$mysqli->query("CALL spsubmenuDelete('$info')");
if($query==1)
{
	$content.= $_SESSION['S_MenuLocation']." -Record deleted";
}
else
{
	$content.= $_SESSION['S_MenuLocation'].mysqli_error().$info;
}
echo ($content);

?>

