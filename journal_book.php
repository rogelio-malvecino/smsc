<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

$display="";


$display="
<table class='borderheading'>
<tr>
Journal Book transactions
</tr>
</table>";
echo $display;

			
?>
