<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
include ("datasource.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html>
<head>
    <title>Enterprise System</title>
    <style type="text/css">
    body {
        font: 13px tahoma;
        margin: 1em 2em;
    }
	h1 { font-size: 24px; }
    </style>
   <link rel="stylesheet" type="text/css" href="example1.css" />
 	<script language="JavaScript" src="JSeverwing.js"></script>
      <script type="text/javascript" src="DropMenuX.js"></script>


	
	<link rel="stylesheet" type="text/css" href="sortable.css"/>
	<script type="text/javascript" src="sortable.js"></script>


	<script language="JavaScript">

	function CallAjaxPage(mypage)
		{
		
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "";
			ajaxRequest.open("POST",mypage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 

		}
	function ChangeSubTitle(mSubMenu)
		{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "SubMenu="+mSubMenu;
			ajaxRequest.open("POST","menulocation.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
		}

	
	</script>




</head>
<body  >

<table width="100%">
<tr>
<td>


<table id='maintable' width="100%" frame="box">
<tr>.
<td>
	 <table align="center" width="100%" cellspacing="0" cellpadding="0" id="heading" >	
	<tr>
	<th ROWSPAN=2><div align="Left" class="heading"><?echo $_SESSION['S_CompanyName']?></div></th>
	<td>
	<div align="Right" class="loguser">User Name: <?echo $_SESSION['S_EmployeeName']?>
	</td>
	</tr>

	<tr>
	<td>
	<div align="Right" class="loguser"><a href=Login.php>Log out</a></div>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>

<table id="menubox" width="100%" frame="box">
</tr>
<td>
    <table align="center" width="100%" cellspacing="0" cellpadding="0" id="menu1" class="dmx">
<tr>
<?
		$mResult = $mysqli->query("Call spMenuAccess('".$_SESSION['S_UserID']."')");
		if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
			{
?>
						  <td> <a class="item1" href="javascript:void(0)"><?echo $ado['MenuName']?></a>


<?
		include ("datasource_.php");
		$mResult_ = $mysqlcnnt->query("Call spSubMenuAccess('".$_SESSION['S_UserID']."','".$ado['MenuCode']."')");
		if (mysqli_num_rows($mResult_) > 0)
		{
?>
			<div class="section">
<?
			while ($ado_ = $mResult_->fetch_array(MYSQLI_BOTH))
			{
?>
			<a class="item2" href="#" onClick="javascript:CallAjaxPage('<?echo $ado_['Pages']?>');ChangeSubTitle('<?echo $ado_['SubMenu']?>')"><?echo $ado_['SubMenuName']?></a>
<?
			}
?>
			</div>
<?
		}	
			}
?>
			</td>
<?
		}			
?>
</tr>
    </table>
</td>
</tr>
</table>





<br></br>
 <div id="menulocationcontents"  class="bordermenu">
</div>



 <div id="contents" >

<table width="100%" frame="box">
<tr>
<td>

<table align="center" >
<tr>
<td>
Search Item
</td>
<td>
<input type="text" name="search1"/>
</td>
<td>
Search Item
</td>
<td>
<input type="text" name="Search2"/>
</td>
</tr>

<tr>
<td>
Search Item
</td>
<td>
<input type="text" name="search1"/>
</td>
<td>
Search Item
</td>
<td>
<input type="text" name="Search2"/>
</td>
</tr>


<tr>
<td>
Search Item
</td>
<td>
<input type="text" name="search1"/>
</td>
<td>
Search Item
</td>
<td>
<input type="text" name="Search2"/>
</td>
</tr>

<tr>
<td>
Search Item
</td>
<td>
<input type="text" name="search1"/>
</td>
<td>
Search Item
</td>
<td>
<input type="text" name="Search2"/>
</td>
</tr>
</table>

<table align="center">
<tr>
<td>
<input type="button" name="cmdcreatename" id="cmdcreateid" value="CREATE" onClick="javascript:employee_create()"/>
</td>
<td>
<input type="button" name="cmdsearchname" id="cmdsearchid" value="SEARCH" onClick="javascript:employee_search()"/>
</td>
<tr>
</table>

</td>
</tr>
</table>






<table class="sortable"  id="anyid" cellpadding="0" cellspacing="0" >
		<tr>
		<th >EMPLOYEE NUMBER</th>
		<th >FIRST NAME</th>
		<th >LAST NAME</th>
		</tr>
<?
include ("datasource.php");
$mResult = $mysqli->query("Call spEmployeeSearch()");
	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
?>
							<tr>   
							<td><a href="#" onClick="javascript:employee_edit(<? echo $ado['EmpNumber'] ?>);return false;"><? echo $ado['EmpNumber'] ?></a></td>
							<td><? echo $ado['EmpFirstName'] ?></td>
							<td><? echo $ado['EmpLastName'] ?></td>
						         </tr>
<?

				}
		}
	else
		{


		}

?>
</table>
</div>




</td>
</tr>
</table>


    <script type="text/javascript">
    var dmx = new DropMenuX('menu1');
    dmx.delay.show = 0;
    dmx.delay.hide = 400;
    dmx.position.levelX.left = 2;
    dmx.init();
    </script>



</body>
</html>