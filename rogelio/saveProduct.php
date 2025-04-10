<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
$cat=$_POST['category'];
$user= $_POST['user'];
$catUpdate=$_POST['catUpdate'];
$action=$_POST['action'];
$id=$_POST['id'];
$content="";
if($action=="add")

{

$check=$mysqli->query("CALL spproductQuery('$cat')");
$numrows=$check->num_rows;
$check->close();
$mysqli->next_result();
	
	if($numrows>=1)
			{
				$content.= $_SESSION['S_MenuLocation']." - Product name already exist!"; 
			
			}
	else
			{
					$query=$mysqli->query("CALL spproductSaving ('','$cat','$user','')");
					if($query==1)
					{
						$content.=$_SESSION['S_MenuLocation']." -Record save!"; 
					}
					else
					{
						$content.= $_SESSION['S_MenuLocation'];
				
					}
			}

}

if($action=="update")
{
$check=$mysqli->query("CALL spproductQuery('$catUpdate')");

$numrows=$check->num-rows;
$check->close();
$mysqli->next_result();
	if($numrows>=1)
			{
				$content.= $_SESSION['S_MenuLocation']." -Record already exist!"; 
			
			}
	else
	
			{
				$query=$mysqli->query("CALL spproductUpdate ($id , '$catUpdate','$user','' )");		
				if($query==1)
				{
					$content.= $_SESSION['S_MenuLocation']." -Record updated!";
				}
				else
				{
					$content.= $_SESSION['S_MenuLocation']." - Unable to update record!";
				}

			}
}
echo $content
?>