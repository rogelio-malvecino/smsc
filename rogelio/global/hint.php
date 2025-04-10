<?php	

	include ("datasource.php");

	echo $_REQUEST['module'];
	if ($_REQUEST['search'] <> '')
		{
			if ($_REQUEST['module'] == '1002')
				{
					$mTable = 'tb_mStaff';
				}

			if ($_REQUEST['module'] == '6004')
				{
					$mTable = 'tb_mDoctor';
				}

			if ($_REQUEST['module'] == '6202')
				{
					$mTable = 'tb_mPatientInfo';
				}
			
			$mSql = "Call sp_Execute_Query('SELECT DISTINCT ".$_REQUEST['field']." FROM ".$mTable." WHERE ".$_REQUEST['field']." LIKE ''".$_REQUEST['search']."%'' ORDER BY ".$_REQUEST['field']."')";
			
			$mResult = $mysqli->query($mSql);
			
			if (mysqli_num_rows($mResult) > 0)
				{
					echo  $_REQUEST['search']."\n";						
					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{ 
							echo strtoupper($ado[$_REQUEST['field']])."\n";						
						}
				}	
			mysqli_close($mysqli);
	}
?>