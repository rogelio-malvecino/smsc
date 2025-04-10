<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	include ("datasource.php");
	include ("function.php");	

	$mAccess1 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''SEARCH'' AND SubMenuCode =''Journal''"); // SEARCH
	$mAccess2 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''ADD'' AND SubMenuCode =''Journal''"); //add
	$mAccess3 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''SAVE'' AND SubMenuCode =''Journal''");//save
	$mAccess4 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''EDIT'' AND SubMenuCode =''Journal''");;//edit
	$mAccess5 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''DELETE'' AND SubMenuCode =''Journal''");//delete
	$mAccess6 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''POST'' AND SubMenuCode =''Journal''");//post
	$mAccess7 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''PRINT'' AND SubMenuCode =''Journal''");//print
	$mAccess8 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''ADMIN'' AND SubMenuCode =''Journal''");//admin
	

	$mControlNo = $_REQUEST["ControlNo"];
	$Date1 = date("Y-m-d"); 
	$Date2 = date("Y-m-d");
	$mStatus = $_REQUEST["Status"];
	
	if($_REQUEST["Start"]=='2')
	{
		$Date1 = $_REQUEST["Year1"]."-".$_REQUEST["Month1"]."-".$_REQUEST["Day1"];
		$Date2 =  $_REQUEST["Year2"]."-".$_REQUEST["Month2"]."-".$_REQUEST["Day2"];
	}
	
	
	
?>
<html>
<head>
	<title>General Journal Masterfile</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
    <script language="javascript" src="Functions.js"></script>
	
</head>
<body background="../images/background.JPG" onLoad="javascript:GeneralJournal_Search();"> 
<form name="frmJournal" action="generaljournal_search.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td valign="top" align="center" background="../images/bg_left.gif" bordercolor="#FFFFFF">

		</td>
		<td>
			<table width="100%" border="0" bgcolor="#EBEBEB" cellspacing="0" cellpadding="7" align="center">
				<tr bgcolor="#EBEBEB">
					<td>
						<table bgcolor="#CCCCCC" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td>
									<table bgcolor="#CCCCCC" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td colspan="4">
												<table width="100%" class="title1">
													<tr>
														<td colspan="4" class="title1" align="center">
                                                        	<font size="+1">GENERAL JOURNAL (LISTING)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                          	<input type="button" name="cmdNew" class="detail1" value="  Create New Record "  <?php if ($mAccess2 == '') { ?>disabled<?php } ?> onClick="javascript:GeneralJournal_Action(1);">
                                                            <input type="button" name="cmdSearch" class="detail1" value="  Search/List Record(s)  " onClick="javascript:GeneralJournal_Action(2);">
														</td>
													</tr>											  
											  </table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#EBEBEB">
								<td height="1"></td>
							</tr>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="1" bordercolor="#FFFFFF">
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Enter Journal#&nbsp;</td>
                                            <td width="79%" class="detail1">
                                                &nbsp;<input type="text" name="txtControlNo" maxlength="9" size="15" class="detail1" value="<?php echo $_REQUEST["ControlNo"] ?>">                                              		
                                            </td>
                                        </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Select Journal Date (From)</td>
                                            <td class="detail1" colspan="5">
 												<input type="text" id="Date1" maxlength="25" size="25" readonly="true" value="<?php echo $Date1 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date1');" style="cursor:pointer"/>
											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td colspan="2" class="detail1">&nbsp;Select Journal Date (To)</td>
											<td class="detail1" colspan="5">
												<input type="text" id="Date2" maxlength="25" size="25" readonly="true" value="<?php echo $Date2 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date2');" style="cursor:pointer"/>
											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Select Status</td>
                                            <td class="detail1" colspan="5">
                                                &nbsp;<select name="cboStatus" class="detail1">
                                                <option value="" <?php if ($mStatus=="") { ?>selected<?php } ?>>-Select Status-</option>
                                                <option value="0" <?php if ($mStatus=="0") { ?>selected<?php } ?>>Unposted</option>
                                                <option value="1" <?php if ($mStatus=="1") { ?>selected<?php } ?>>Posted</option>
                                                </select>													
                                            </td>
                                        </tr>
										<tr valign="top" bgcolor="#EBEBEB">
                                            <td colspan="7" align="center" class="detail1">
                                                &nbsp;<input type="button" name="cmdSearch" class="detail1" value="Search" <?php if($mAccess1 == '') {?>disabled<?php } ?> onClick="javascript:GeneralJournal_Search();" tabindex="1">
                                            </td>
                                        </tr>
									</table>											
									<div id='Table'></div>											
							  	</td>
							</tr>	
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td align="left" background="../images/bg_right.gif" valign="top">
		</td>
	</tr>

	<tr height="0">
		<td valign="top">

		</td>
		<td valign="top">	

		</td>
		<td align="left">

		</td>
	</tr>
</table>
</form>
</body>
</html>
