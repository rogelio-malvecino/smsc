<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
$code=$_POST['code'];
$name=$_POST['name'];
$user= $_POST['user'];
$mMenu=$_POST['mMenu'];
$page=$_POST['page'];
$action=$_POST['action'];
$id=$_POST['id'];
$content="";


if($action=="add")
{
	
$check=$mysqli->query("CALL spsubmenuQuery('$name')");
$numrows=$check->num_rows;
$check->close();
$mysqli->next_result();
	
	if($numrows>=1)
			{
				$content.= $_SESSION['S_MenuLocation']." - Submenu Name already exist!"; 
			
			}
	else
			{
					$check1=$mysqli->query("CALL spsubmenuQuery1('$code')");
					$numrows1=$check1->num_rows;
					$check1->close();
					$mysqli->next_result();
						if($numrows1>=1)
							{
								
								$content.=$_SESSION['S_MenuLocation']." - Submenu code already exist!".$code.$name.$page; 	
									
								
							}
						else
						{
						//if no duplicate save record
							$query=$mysqli->query("CALL spsubmenuSaving ('$mMenu','$code','$name','$page',1)");
							if($query==1)
								{
									$content.=$_SESSION['S_MenuLocation']." -Record save!".$code.$name.$page; 
								}
							else
							{
								$content.= $_SESSION['S_MenuLocation']." - Unable to save record!".mysqli_error();
				
							}	
			
						}
			}

}

//--------------------------------------------------------------------------------------------------------------------------------//




if($action=="update")
{

$query=$mysqli->query("CALL spmarketingUpdate('$code','$price','$id')");
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