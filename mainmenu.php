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
    
    <link rel="stylesheet" type="text/css" href="everwinglayout.css" />
    <link rel="stylesheet" type="text/css" href="CSSeverwing.css" /><!--layout-->
    <script language="JavaScript" src="JSeverwing.js"></script><!--all function goes here-->
    <script type="text/javascript" src="DropMenuX.js"></script><!--js for dropdown menu-->
    <link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" /><!-- css for dataTable-->
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.4.custom.css" /><!--css for dataTable -->
    <script type="text/javascript" src="js/jquery-1.6.js"></script><!--my jquery-->
    <script type="text/javascript" src="js/jquery.dataTables.js"></script><!--jquery for datatable-->
    <!--script & style for fancy box-->
    <link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" />
    <script type="text/javascript" src="js/fancybox/jquery.easing-1.3.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <!--end-->
    <link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css"/><!--css for autocompletion-->
    <script type="text/javascript" src="js/jquery.autocomplete.js"></script><!--for textbox autocol-->
    <script type="text/javascript" src="JSSearch.js"></script><!--sir jun script-->

    <!--calendar-->
    <script src="js/jscal2.js"></script>
    <script src="js/en.js"></script>
    <link rel="stylesheet" type="text/css" href="js/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="js/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="js/steel/steel.css" />
    <!--calenda end-->
	
	
		<script language="JavaScript" src="JSeverwing.js"></script>
		<script language="JavaScript" src="JSSearch.js"></script>
		<script language="JavaScript" src="JSEdit.js"></script>
		<script language="JavaScript" src="JSAdd.js"></script>
		<script language="JavaScript" src="Function.js"></script>
		<script type="text/javascript" src="datetimepicker.js"></script>
		
		
</head>
<body>
<center>
<table class="container" cellpadding="0" cellspacing="0">
<tr>

<td class="header">
<div style="
margin-top:20px;
font-size:30px;
text-indent:10px;
text-shadow:1px 1px 1px black;
color:#999999;
font-weight:bold;
font-family:Verdana, Arial, Helvetica, sans-serif;


">
<?php echo $_SESSION['S_CompanyName']?>
</div>
</td>
<td>
<div style="
margin-top:60px;
text-align:right;
margin-right:10px;
font-family:Geneva, Arial, Helvetica, sans-serif;
font-size:11px;">
WELCOME : <a class="themes" onclick="javascript:CallAjaxPage('userprofile.php?name=<?php echo $_SESSION['S_UserID']?>')" href="#"><?php echo $_SESSION['S_EmployeeName']?></a>
<a class="themes" href=login.php>Log out</a>
</div>
</td></tr>
<input type="hidden" id='user' value="<?php echo $_SESSION['S_EmployeeName'] ?>" />

<tr>
<td class="navlink" colspan="2">

<div class="navlink">

 <table id="menu1" class="dmx">
<tr align="left">
<?php 
		$mResult = $mysqli->query("Call spMenuAccess('".$_SESSION['S_UserID']."')");
		if (mysqli_num_rows($mResult) > 0)
		
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
			{
?>
						  <td><a class="item1" href="javascript:void(0)"><?php echo $ado['MenuName']?></a>
						    <?php
		include ("datasource.php");
		$mResult_ = $mysqli->query("Call spSubMenuAccess('".$_SESSION['S_UserID']."','".$ado['MenuCode']."')");
		if (mysqli_num_rows($mResult_) > 0)
		{
?>
						<table class="section"><tr><td>
<?php
			while ($ado_ = $mResult_->fetch_array(MYSQLI_BOTH))
			{
?>

<a class="item2" href="#" onClick="javascript:CallAjaxPage('<?php echo $ado_['Pages']?>'); ('<?php echo $ado_['SubMenu']?>')" href="#" title="<?php echo $ado_['SubMenuName']?>">

<?php echo $ado_['SubMenuName']?></a>

			
<?php
			}
?></td></tr>
			</table>
<?php 
		}	
			}
?>			</td>
<?php
		}
?>
</tr>
    </table>
</div>
</td></tr>
</table>
<br />

<table class="table_container_two" cellpadding="0" cellspacing="0" border="0">

<tr><td colspan="2" id="menulocationcontents"  class="bordermenu"></td></tr>
<tr>
<td class="contentleft" colspan="2">
<br />
<center><div id="contents" style="width:1050px;></div><!--contents--></center>
<br />
<div id="contents_"></div><!--contents-->
</td>
<tr><td class="footer" colspan="2"><div style="font-size:11px;">Copyright � 2012 Enterprises System</div></td><tr>


</table>




</center>
<!--for dropdown menu works-->
    <script type="text/javascript">
    var dmx = new DropMenuX('menu1');
    dmx.delay.show = 0;
    dmx.delay.hide = 100;
    dmx.position.levelX.left = 10;
    dmx.init();
    </script>
</body>
</html>