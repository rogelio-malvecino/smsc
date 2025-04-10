<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include ("datasource.php");
$fname=$_GET['fname'];
$lname=$_GET['lname'];
$mResult = $mysqli->query("Call spemployeeSearchAjax('$fname','$lname')");
?>

<html>
<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
<body>
<br>
<table width='100%' id='example' class='display' cellpadding='0' cellspacing='0' >
		<thead>
		<tr class='title'>
		<th class='btitle'>EMPLOYEE NUMBER</th>
		<th>FIRSTNAME</th>
		<th>LASTNAME</th>
		<th width='10%'>ACTION</th>
		</tr>
		</thead>



    <?php if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					$id=$ado['EmpNumber'];
					$del='del'.$id;
					?>
                                        <tr class='<?php echo $del ?>'>
							<td><?php echo $ado['EmpNumber'] ?></td>
							<td> <?php echo $ado['EmpFirstName'] ?></td>
							<td> <?php echo  $ado['EmpLastName'] ?></td>

							<td>
							<span style='padding-left:10px'>
			<a href='user_edit.php?id=$id' class='makeFancy' title='EDIT USER'>
				<img src='icons/EDITS.ico' />
			</a>
	</span>
	<span style='padding-left:10px; cursor:pointer;' onclick="javascript:deleteRecord('<?php echo $ado['EmpNumber'] ?>','user_delete.php')">
    	<a href='#' title='DELETE'>
        	<img src='icons/DELETE.ico'/>
        </a></span>
         </td>
						         </tr>


				<?php  } ?>
		<?php } ?>

</table>

</body>
</head>
</html>
