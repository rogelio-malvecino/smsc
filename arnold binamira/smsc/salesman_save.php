<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
$code=$_POST['code'];
$name=$_POST['name'];
$mGroup=$_POST['mGroup'];
$user= $_POST['user'];

$action=$_POST['action'];
$id=$_POST['id'];
$content="";


if($action=="add")
{
	
$check=$mysqli->query("CALL spsalesmanQuery('$code')");
$numrows=$check->num_rows;
$check->close();
$mysqli->next_result();
	
	if($numrows>=1)
			{
				$content.= $_SESSION['S_MenuLocation']." - Salesman Code already exist!"; 
			
			}
	else
			{
				
				$query=$mysqli->query("CALL spsalesmanSaving('$code','$name','$mGroup','$user','')");
	
					if ($query==1)
					{
						
						$content.= $_SESSION['S_MenuLocation']." - Record Save!";
					}
					else
					{
						
						$content.= $_SESSION['S_MenuLocation']." - Error while saving!";
					}
			}
}

//--------------------------------------------------------------------------------------------------------------------------------//




if($action=="update")
{

$query=$mysqli->query("CALL spsalesmanUpdate ('$code','$name','$code','$mGroup','$user','')");
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