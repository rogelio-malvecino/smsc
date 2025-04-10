<?php
session_start();
$CheckNumber = $_POST['CSID'];
    include("datasource_.php");
	$DResult = $mysqli->query("Call sp_Execute_Query('SELECT ReferenceID_cd, Particular_tx FROM tb_tcashsaleshdr where CSID_cd =''".$CheckNumber."'' ')");
	while ($row = $DResult->fetch_array(MYSQLI_BOTH))
        {
	$datastring = $row['ReferenceID_cd']."ROGER".$row['Particular_tx'];
	}
	echo $datastring;


?>


