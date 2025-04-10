<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
$sCode=$_POST['sCode'];
$sName=$_POST['sName'];
$action=$_POST['action'];
$sAdd=$_POST['sAdd'];
$sPhone=$_POST['sPhone'];
$sContact=$_POST['sContact'];
$sMobile=$_POST['sMobile'];
$sEmail=$_POST['sEmail'];
$sFax=$_POST['sFax'];
$id=$_POST['id'];
$content="";
$user= $_POST['user'];

if($action=="add")
{
	
$check=$mysqli->query("CALL spsupplierQuery('$sCode')");
$numrows=$check->num_rows;
$check->close();
$mysqli->next_result();
	
	if($numrows>=1)
			{
				$content.= $_SESSION['S_MenuLocation']." - Supplier Code already exist!"; 
			
			}
			
	else

			
					{
						//if no duplicate save record
							$query=$mysqli->query("CALL spsupplierSaving('$sCode','$sName','$sAdd','$sContact','$sPhone','$sMobile','$sEmail','$sFax','$user','')");
							if($query==1)
								
								{
									
									$content.=$_SESSION['S_MenuLocation']." -Record save!"; 
								
								}
							else
							
							{
								$content.= $_SESSION['S_MenuLocation']." - Unable to save record!".mysqli_error().$sCode.$sName;
				
							}	
							
					}
			
						
			

}

//--------------------------------------------------------------------------------------------------------------------------------//




if($action=="update")
{

$query=$mysqli->query("CALL spsupplierUpdate('$sCode','$sName','$sAdd','$sContact','$sPhone','$sMobile','$sEmail','$sFax','$user','')");
	if($query==1)
	
	
	{
		$content.= $_SESSION['S_MenuLocation']." - Record updated!";
		
	}
	else
	
	{
		$content.= $_SESSION['S_MenuLocation']." - Unable to updated record!".mysqli_error();
		
		
	}
								

}
echo $content;
?>