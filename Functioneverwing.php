<?php
error_reporting(E_ALL ^ E_NOTICE);
function Is_Logged_In () 
	{
  		if ($_SESSION["S_Login"] != "True") 
			{
    			Header("Location: Login.php");
    			exit();
				return 0;
			}
  	}
?>