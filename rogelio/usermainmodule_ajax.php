<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
</head>
<body>
</body>

<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include ("datasource.php");
$fname=$_GET['fname'];
$lname=$_GET['lname'];
$mResult = $mysqli->query("Call spemployeeSearchAjax('$fname','$lname')");
$display="";



$display .="
<br /><br />


<table width='100%' id='example' class='display' cellpadding='0' cellspacing='0' >
		<thead>
		<tr class='title'>
		<th class='btitle' width='15%'>EMPLOYEE NUMBER</th>
		<th>FIRST NAME</th>
		<th>LAST NAME</th>
		<th width='10%'>ACTION</th>
		</tr>
		</thead>
		";

	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					$id=$ado['EmpNumber'];
					$display .="<tr>
							<td>".$ado['EmpNumber']."</td>
							<td>". $ado['EmpFirstName']."</td>
							<td>". $ado['EmpLastName']."</td>
							<td>
								 <span style='padding-left:10px'><a href='usermainmodule_create.php?id=$id' class='makeFancy' title='ADD ACCESS'><img src='icons/add.ico' /></a></span> <span style='padding-left:10px'><a href='usermainmodule_create.php?id=$id' class='makeFancy' title='REMOVE ACCESS'><img src='icons/REMOVE1.ico' /></a></span>
							</td>
						    </tr>";


				}
		}
	else
		{


		}

$display .="</table><div class='footerto'>
</div>";



















echo $display;


?>
