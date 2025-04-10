<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	include ("datasource.php");
	include ("function.php");	

	$mAccess1 = fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''SEARCH'' AND SubMenuCode =''Checkdisbursement''"); // SEARCH
	$mAccess2 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''ADD'' AND SubMenuCode =''Checkdisbursement''"); //add
	$mAccess3 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''SAVE'' AND SubMenuCode =''Checkdisbursement''");//save
	$mAccess4 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''EDIT'' AND SubMenuCode =''Checkdisbursement''");;//edit
	$mAccess5 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''DELETE'' AND SubMenuCode =''Checkdisbursement''");//delete
	$mAccess6 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''POST'' AND SubMenuCode =''Checkdisbursement''");//post
	$mAccess7 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''PRINT'' AND SubMenuCode =''Checkdisbursement''");//print
	$mAccess8 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''ADMIN'' AND SubMenuCode =''Checkdisbursement''");//admin
	

	$mControlNo = !empty($_REQUEST["ControlNo"]) ? $_REQUEST["ControlNo"] : "";
	$mPaymasterID = !empty($_REQUEST["PaymasterID"]) ? $_REQUEST["PaymasterID"] : "";  	
	$mReferenceNo = !empty($_REQUEST["ReferenceNo"]) ? $_REQUEST["ReferenceNo"] : ""; 	
	$mDate1 = date("Y-m-d"); 
	$mDate2 = date("Y-m-d"); 
	$mStatus = !empty($_REQUEST["Status"]) ? $_REQUEST["Status"] : "";
	$mStart = !empty($_REQUEST["Start"]) ? $_REQUEST["Start"] : "";
	if($mStart =='2')
	{
		$mDate1 = $_REQUEST["Year1"]."-".$_REQUEST["Month1"]."-".$_REQUEST["Day1"];
		$mDate2 =  $_REQUEST["Year2"]."-".$_REQUEST["Month2"]."-".$_REQUEST["Day2"];
	}
?>
<html>
<head>
	<title>Check Disbursement Masterfile</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >

		
    <script language="javascript" src="Functions.js"></script>
	<script>
	</script>	
</head>
<body background="../images/background.JPG" onLoad="javascript:CheckDisbursement_Search();"> 
<form name="frmJournal" action="checkdisbursement_search.php" method="post">
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
                                                        	<font size="+1">CHECK DISBURSEMENT (LISTING)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                          	<input type="button" name="cmdNew" class="detail1" value="  Create New Record "  <?php if ($mAccess2 == '') { ?>disabled<?php } ?> onClick="javascript:CheckDisbursement_Action(1);">
                                                            <input type="button" name="cmdSearch" class="detail1" value="  Search/List Record(s)  " onClick="javascript:CheckDisbursement_Action(5);" tabindex="16">
														</td>
													</tr>
											  </table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#EBEBEB">
								<td height="5"></td>
							</tr>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="1" bordercolor="#FFFFFF">
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Enter Voucher#&nbsp;</td>
                                            <td width="79%" class="detail1">
                                                &nbsp;<input type="text" name="txtControlNo" maxlength="9" size="15" class="detail1" value="<?php echo $mControlNo ?>">                                              		
                                            </td>
                                        </tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Enter Check#&nbsp;</td>
                                            <td colspan="5" class="detail1">
                                                &nbsp;<input type="text" name="txtReferenceNo" maxlength="15" size="9" value="<?php echo $mReferenceNo ?>" class="detail1" tabindex="3">
                                            </td>
                                        </tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                          	<td colspan="2" class="detail1">&nbsp;Select Payee</td>
                                     		<td colspan="5" class="detail1">
                                                &nbsp;<select name="cboPaymasterID" class="detail1">
                                                <option value="">-Select Name-</option>
<?php
												include ("datasource_.php");
												$mResult = $mysqli->query("Call sp_CheckDisbursementPaymaster_Select()");

												if (mysqli_num_rows($mResult) > 0)
													{
														while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
															{ 
?>
                                                                <option value="<?php echo $ado["PaymasterID_cd"] ?>"><?php echo strtoupper($ado["PaymasterName_tx"]) ?></option>
<?php
															}
													}
												mysqli_close($mysqli);
?>
                                                </select>&nbsp;	 									  	    
                                            </td>
                                        </tr>
			
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Select Voucher Date (From)</td>
 											<td>
												<input type="text" id="Date1" maxlength="25" size="25" readonly="true" value="<?php echo $mDate1 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date1');" style="cursor:pointer"/>
											</td>
											
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td colspan="2" class="detail1">&nbsp;Select Voucher Date (To)</td>
											<td>
												<input type="text" id="Date2" maxlength="25" size="25" readonly="true" value="<?php echo $mDate2 ?>"/>
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
                                                &nbsp;<input type="button" name="cmdSearch" class="detail1" value="Search" <?php if ($mAccess1 == ''){ ?>disabled<?php }?> onClick="javascript:CheckDisbursement_Search();" tabindex="1">
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
<?php
	if ($mStart=='1')
		{
?>
			<script language="JavaScript">
				var mControlNo = document.frmJournal.txtControlNo.value;
				window.close;
				window.open('checkdisbursement_search.php?Start=0&ControlNo='+mControlNo+'&ReferenceNo=&PaymasterID=&Status=' 
							,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
            </script>
<?php
		}
?>
