<?php
session_start(); 
include ("datasource.php");
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Enterpise System</title>
	<link href="CSSeverwing.css" rel="stylesheet" type="text/css" >
	<script language="JavaScript" src="JSeverwing.js"></script>











	<script language="JavaScript">


var ray={
ajax:function(st)
	{

		this.show('load');
	},
show:function(el)
	{
		this.getID(el).style.display='';
	},
getID:function(el)
	{
		return document.getElementById(el);
	}


}
	function Signing()
		{
			var ajaxRequest = getAjaxRequest();
			var mUserName = document.frmSignIn.UserName.value;
			var mUserPassword = document.frmSignIn.UserPassword.value;
			var mCompanyID = document.frmSignIn.CompanyID.options[document.frmSignIn.CompanyID.selectedIndex].value;
			var mCompanyName = document.frmSignIn.CompanyID.options[document.frmSignIn.CompanyID.selectedIndex].text;

			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('LoginTitleId').rows;
							var y=ajaxDisplay[0].cells;
							if (ajaxRequest.responseText=="Failed")
								{
								y[0].innerHTML = "Login " + ajaxRequest.responseText;
								}
							else
								{
									window.open('mainmenu.php','_parent');
								}
						}
				}
			var param= "UserName=" + mUserName + "&UserPassword=" + mUserPassword + "&CompanyID=" +mCompanyID+"&CompanyName="+mCompanyName;
			ajaxRequest.open("POST","Signing_ajax.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
		}
	</script>


</head>
<body>
<div id="load" style="display:none;">Loading... Please wait</div>
<br /><br /><br /><br />




<center>
<div class="container">
<br />
<form name="frmSignIn"  method="post" onsubmit="return ray.ajaxa()">
<table width="100%" name="LoginTitleName" id="LoginTitleId" class="tb">
<tr >
	<td>
	Login
	</td>
</tr>
</table>
<br /><br />

<table name="LoginName" id="LoginId">
<tr><td>Compay :</td><td>	<select class="select" name="Comapanyname" id="CompanyID" size="1">

<? 
error_reporting(E_ALL ^ E_NOTICE);

$mResult = $mysqli->query("select * from company");
					if (mysqli_num_rows($mResult) > 0)
						{
							while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
							{
?>
	<option value=<?php echo $ado["compnayid"]?>><?php echo $ado["companyname"]?></option>
<?
							}
						}			
?>	    
	</select></td></tr>
    
    
<tr><td>User Name :</td><td>	<input class="login" type="text" name="UserName" size="25" maxlength="15" /></td></tr>
<tr><td>User Password :</td><td>	<input align="right" class="login" type="password" name="UserPassword" size="25" maxlength="15" /></td></tr>

<tr><td>	<input class="search" type="button" value="Sign In" onClick="javascript:Signing();"  /></td><td> </td></tr>
</table>

</form>
</div>
</center>



</body>
</html>
<?
?>
