<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
$id=$_POST['myId'];
$newPassword=$_POST['newPassword'];
$newUsername=$_POST['newUsername'];
$query=$mysqli->query("CALL spuserUpdatePassword('$id','$newUsername','$newPassword')");
							if($query==1)
								{
									$content.=$_SESSION['S_MenuLocation']." -Record save!";
								}
							else
							{
								$content.= $_SESSION['S_MenuLocation']." - Unable to save record!".mysqli_error();

							}

echo $content;
 ?>
