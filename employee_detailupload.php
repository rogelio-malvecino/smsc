<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
include ("datasource.php");
$id=$_GET['id'];
	if(isset($_POST['submit']))
	{
	
		$imgtype=$_FILES['upload']['type'];
		$name=$_REQUEST['name'];
		$imgname=$_FILES['upload']['name'];
		$imgsize=$_FILES['upload']['size'];
		$imgName=$_POST['upload'];
		$controlNumber=$_POST['controlNumber'];
		if($imgtype=="image/jpeg" || $imgtype=="image/jpg" || $imgtype=="image/pjpeg" || $imgtype=="image/gif" || $imgtype=="image/x-png" || $imgtype=="image/bmp")
		{
					
			$image=$_FILES['upload']['tmp_name'];
			$fp = fopen($image, 'r');
			$content = fread($fp, filesize($image));
			$content = addslashes($content);
			fclose($fp);
			
			$check=$mysqli->query("select * from employeeinformation_detail where EmpNumber = '$id' and imageDescription = '$imgname'");
			$numrow=$check->num_rows;
			$check->close();
			$mysqli->next_result();
			if($numrow>=1)
			{
				
			
				echo("<p style='color:red;font-size:12px;'>Duplicate Entry,Image Name Already Exist</p>");
			}
		
			else
			{
				$query=$mysqli->query("Call spemployeesavePhoto('$id','$imgname','$content')");
				
				if($query==1)
					{
						echo ("<p style='font-size:12px;'>Photo successfully save!</p>");
						
					}
				else
					{
						echo mysqli_error()." - Upload Photo failed!";
					}
			}
		}
		else
		{
			echo ("The file extension is not valid!");
		}
	}
?>
<html>
<head>


<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="js/jquery-1.6.js"></script>
<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" />
<script type="text/javascript" src="js/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script>

$(document).ready(function(){
		$(".makeFancy").fancybox({
            'opacity'		: true,
			'overlayShow'	: true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic'
         }); 

  });


</script>
</head>
<body>
<div class="uploadWrapper">
		
	<div class="uploadContent">
		<div class='emp'>
        
        	
	<?php
		$query=$mysqli->query("Call spEmployeeSelect('$id')");
		while($row=$query->fetch_array())
		{
			echo $row[1]." ".$row[2]." ".$row[3];
		}
		$query->close();
		$mysqli->next_result();
	?>
        </div>
    
    <div class="uploadForm">    
<form name="form" method="post" ENCTYPE="multipart/form-data" action="employee_detailupload.php?id=<?php echo $id ?>">
	
    
<table style="color:#000; font:Arial, Helvetica, sans-serif; font-size:12px">
	<tr>
		<td >
 
			UPLOAD PHOTO: 
		</td>
        <td>
        	<input type="file" name="upload">
        </td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top:10px;">
        	<center><input name="submit" value="SAVE" type="submit" ></center>
        </td>
	</tr>
</table>
</form>	

	</div>
	<div id="uploadNote">
		Note: Only picture can be uploaded and these are the file extension that are accepted .jpg/.jpeg/.bmp/.gif/.png  .
	</div>
    </div>
    <!--check if there is photo available-->
	<?php 
		$mResult=$mysqli->query("Call spemployeedetailQuery('$id')");
		$numrows=$mResult->num_rows;
		$mResult->close();
		$mysqli->next_result();
		if($numrows>=1)
		{
			$display="";
		}
		else
		{
			$display="none";
		}
	?>
    <div class="myPhoto" style="display:<?php echo $display; ?>">
    <?php
		$image = $mysqli->query("Call spemployeedetailQuery('$id')"); 
		while($row =$image->fetch_array(MYSQLI_BOTH))
		{
		
		//display all the image
        echo '<a href="employee_viewphoto.php?id='.$row["EmpNumber"].'&name='.$row["imageDescription"].'" class="makeFancy"><img src="employee_viewpicture.php?id='.$row["EmpNumber"].'&name='.$row["imageDescription"].'" width="100" height="100" class="myPic"></a>';
		
		}
		?>

    </div>
</div>
</body>
</html>
