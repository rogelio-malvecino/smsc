<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
?>

<html>
<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
<body>
<table width='100%' id='example' class='display' cellpadding='0' cellspacing='0' >
	<thead>
		<tr id='title'>
		<th id='btitle' class='empNumber'>EMPLOYEE NUMBER</th>
		<th >FIRST NAME</th>
		<th >MIDDLE NAME</th>
		<th >LAST NAME</th>
		<th >DATE  BIRTH</th>
		<th width='13%'>ACTION</th>
		</tr>
	</thead>
<?php
include ("datasource.php");
   $employeeCode= !empty($_GET['code']) ? $_GET['code'] : "";
   $employeeName= !empty($_GET['name']) ? $_GET['name'] : "";
   echo $employeeCode;
   echo $employeeName;
   ?>
        <?php
   $mResult=$mysqli->query("Select * from employeeinformation where EmpNumber like '%$employeeCode%' and EmpFirstName like '%$employeeName%' and status='1'");
		while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
				
                                        ?>
					<tr class="del<?php echo $ado['EmpNumber'] ?>">
							<td><?php echo $ado["EmpNumber"] ?></td>
							<td><?php echo $ado['EmpFirstName'] ?></td>
							<td><?php echo $ado['EmpMiddleName'] ?></td>
							<td><?php echo $ado['EmpLastName'] ?></td>
							<td><?php echo $ado['EmpBirthDay'] ?></td>
							<td>
							<span style='padding-left:10px'>
								<a href='employee_edit.php?id=<?php echo $ado["EmpNumber"] ?>' class='makeFancy'>
									<img src='icons/EDITS.ico' />
								</a>
							</span>
							<span style='padding-left:10px'>
								<a href='employee_detailupload.php?id=<?php echo $ado["EmpNumber"] ?>' class='makeFancy' target='a' onclick='javascript:showPic();' title='Upload photo'>
									<img src='icons/photoUpload.ico' width='18' height='18' />
								</a>
							</span>

							<span style='padding-left:10px; cursor:pointer;' class='delEmployee' id=$id><a href='#' title=
							DELETE'><img src='icons/DELETE.ico' onclick='deleteRecord("<?php echo $ado["EmpNumber"] ?>","employee_delete.php");'/></a>
							</td>
					 </tr>


				<?php  } ?>
	
</table>
<table><tr>

</tr></table>

</body>
</head>
</html>