<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();

$display="";


$display="
<table class='borderheading'>
<tr>
GL Sub Accounts Transactions
</tr>
</table>";
echo $display;

			
?>
