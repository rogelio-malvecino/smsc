<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
$code=$_POST['code'];
$name=$_POST['name'];
$user= $_POST['user'];

$action=$_POST['action'];
$id=$_POST['id'];
$content="";


if($action=="add")
{
	
$check=$mysqli->query("CALL spmainmenuQuery('$name')");
$numrows=$check->num_rows;
$check->close();
$mysqli->next_result();
	
	if($numrows>=1)
			{
				$content.= $_SESSION['S_MenuLocation']." - Menu Name already exist!"; 
			
			}
	else
			{
					$check1=$mysqli->query("CALL spmainmenuQuery1('$code')");
					$numrows1=$check1->num_rows;
					$check1->close();
					$mysqli->next_result();
						if($numrows1>=1)
							{
								
								$content.=$_SESSION['S_MenuLocation']." -  Menu code already exist!"; 	
									
								
							}
						else
						{
						//if no duplicate save record
							$query=$mysqli->query("CALL spMainMenuSaving ('$code','$name',1,'$user','')");
							if($query==1)
								{
									$content.=$_SESSION['S_MenuLocation']." -Record save!"; 
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

$query=$mysqli->query("CALL spmainmenuUpdate('$code','$name','$user','')");
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