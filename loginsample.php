<?php

	session_start(); 

	$_SESSION['IPID'] = $_SERVER['REMOTE_ADDR'];
	
	$mUsername = '';

	if ($_REQUEST['Start'] == 3)
		{
?>
									<script language="JavaScript">
											window.open('mainmenu.php','_parent')
									</script>
<?					
								
		}
			
	if ($_REQUEST['Start'] == 2)
		{
			if ($_GET['Action']=='Sign-In')
				{
					$mUsername = $_POST['txtUsername'];
					$mPassword = $_POST['txtPassword'];
					
					$_SESSION['User'] = $_POST['txtUsername'];
					$_SESSION['Password'] =	$_POST['txtPassword_'];
					
					include ("datasource.php");
					include ("global/function.php");

					$mResult = $mysqli->query("Call sp_UserProfile_Select('".$mUsername."')");

					if (mysqli_num_rows($mResult) > 0)
						{
?>
							<script>
							document.frmSignIn.cmdSignIn.disabled = true;
							</script>
<?
							$ado = $mResult->fetch_array(MYSQLI_BOTH);
							if (md5_decrypt($ado['Password_tx'],'baseline') == $mPassword)
								{
									$_SESSION['CompanyName'] = "SELECT BRANCH";
									$_SESSION['BranchID'] = "9901010000101";
									$_SESSION['BranchNo'] = "";
									$_SESSION['BranchName'] = "";
									$_SESSION['UserID'] = $ado['UserID_cd'];
									$_SESSION['HRID'] = $ado['HRID_cd'];
									$_SESSION['UserName'] = $ado['UserName_tx'];
									$_SESSION['FullName'] = $ado['FullName_tx'];
									$_SESSION['PositionName'] = $ado['PositionName_tx'];
									$_SESSION['CenterID'] = -1;
									$_SESSION['CenterID_'] = $ado['CenterID_id'];
									$_SESSION['CenterName'] = $ado['CenterName_tx'];
									$_SESSION['Status'] = $ado['Status_tx'];
									
									include ("datasource.php");
									$mResult = $mysqli->query("Call sp_AuditTrail_Insert('".$_SESSION['UserID']."',"
																						   .$_SESSION['CenterID'].",'1000','0','','','','User Login','".$_SESSION['IPID']."')");
									mysqli_close($mysqli);
									
									include ("datasource.php");
									$mResult = $mysqli->query("Call sp_UserLogin_Update('".$_SESSION['UserID']."','".$_SESSION['IPID']."','1')");
									mysqli_close($mysqli);
?>
									<script language="JavaScript">
											window.open('startup.php','_parent')
									</script>
<?									
								}
							else
								{
									$_SESSION['SysMsg'] = 'Unable to Sign-In, Invalid Password!';
									include ('global/passwordfailed.php');
								}
						}
					else
						{
							$_SESSION['SysMsg'] = 'Unable to Sign-In, Check Username!';
							include ('global/usernamefailed.php');
						}
					mysqli_close($mysqli);
				}
		}		
?>
<html>
<head>
	<title>Enterpise System</title>
	<link href="global/mystyle.css" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="images//favicon.ico" type="image/x-icon" />
	<script language="JavaScript" src="global/Functions.js"></script>
    <script language="JavaScript1.2" src="global/baseline.js"></script>
	<script language="JavaScript">
	function Validate()
		{
			if (gf_isCharEmpty("txtUsername","Username")&&
			    gf_isCharEmpty("txtPassword","Password"))
				{
					return true;
				}
					return false;	
		}
	</script>
</head>
<body topmargin="120" background="images/background.JPG" onLoad="false; document.frmSignIn.txtUsername.focus();" ondragstart="return false" onselectstart="return false";> 
<NOSCRIPT><IFRAME SRC=*.html></IFRAME></NOSCRIPT>  
<form name="frmSignIn" action="login.php?Start=3&Action=Sign-In" method="post" OnSubmit="return Validate();">
<table width="450" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td valign="top" align="center" background="images/bg_left.gif" bordercolor="#FFFFFF">
			<img border="0" src="images/bg_top_left.gif" width="11" height="17">
		</td>
		<td>
			<table width="450" border="0" bgcolor="#FFFFFF" cellspacing="0" cellpadding="3" align="center">
				<tr bgcolor="#EBEBEB">
					<td>
						<table bgcolor="#EBEBEB" width="450" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                                <td colspan="4" class="banner1" align="center" valign="top" height="26">Enterprise system&nbsp;&copy;</td>
                            </tr>
						   <tr>
								<td>
									<table width="450" border="0" cellspacing="0" cellpadding="3" bordercolor="#EBEBEB" background="images/shadowbox.jpg">
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" height="25">
											<td colspan="4" class="detail1" valign="bottom">
                                            	&nbsp;&nbsp;Username:                                            
                                            </td>
                                        </tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" height="25">
											<td colspan="4" class="detail1" valign="top" align="center">
												<input name="txtUsername" type="text" size="49" maxlength="15" value="<? echo $mUsername ?>" autocomplete="off" / class="detail6">									  	  	
                                           	</td>
                                        </tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" height="25">
											<td colspan="4" class="detail1" height="20" valign="top">
                                               	&nbsp;&nbsp;User Password:                                            
                                            </td>
                                        </tr>
                                        <tr bgcolor="EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" height="25">
											<td colspan="4" class="detail1" valign="top" align="center">	
                                                <input name="txtPassword_" type="password" size="49" dir="rtl" maxlength="15" class="security1"><BR>                                            
                                            </td>
                                        </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" height="25">
											<td colspan="4" class="detail1" height="20" valign="top">
                                               	&nbsp;&nbsp;System Password:                                            
                                            </td>
                                        </tr>
                                        <tr bgcolor="EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" height="25">
											<td colspan="4" class="detail1" valign="top" align="center">	
                                                <input name="txtPassword" type="password" size="49" dir="rtl" maxlength="15" class="security1"><BR>                                            
                                            </td>
                                        </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" height="25">
											<td colspan="4" class="detail1" height="60" valign="middle">	
                                                &nbsp;&nbsp;<input  type="submit" name="cmdSignIn" value="Sign-In" class="detail6"><BR>
                                                &nbsp;&nbsp;<font color="#999999">Sign-out properly to prevent user account locked</font>                                         	
                                            </td>
									  	</tr>
									</table>											
						  	  	</td>
							</tr>	
                            <tr>
                                <td colspan="4" class="banner2" align="center" valign="top" height="26">
                                	Profem / Everwing&reg;<BR>
                                    #31 Ignacio Santos Diaz Street, Cubao, Quezon City  Philippines
                                </td>
                            </tr>
						</table>
					</td>
				</tr>

			</table>
		</td>
		<td align="left" background="images/bg_right.gif" valign="top">
			<img border="0" src="images/bg_top_right.gif" width="11" height="17">
		</td>
	</tr>

	<tr height="0">
		<td valign="top">
			<img border="0" src="images/bg_bottom_left.gif" width="11" height="17">
		</td>
		<td valign="top">	
			<img border="0" src="images/bg_bottom.gif" width="457" height="17">
		</td>
		<td align="left">
			<img border="0" src="images/bg_bottom_right.gif" width="11" height="17">
		</td>
	</tr>
</table>
</form>
</body>
</html>
