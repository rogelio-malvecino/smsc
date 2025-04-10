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
	

	$mOk = -1;
	
	$mControlNo = '';
	$mControlNo_ = '';
	//$mMonth1 = date("n") + 1;
	//$mDay1 = date("d");
	//$mYear1 = date("Y");
	$mDate1 = date("Y-m-d"); 
	$mReferenceNo = '';
	$mAmount = 0;
	$mParticular = '';
	$mRec = 0;
	$mData = '';

	$mGJDate = '';

	$mAccount = '';
	$mAccountID = '';
	$mSubsidiaryID = '';
	$mAccountDesc = '';
	$mDebit = 0;
	$mCredit = 0;
	$mTotalDebit = 0;
	$mTotalCredit = 0;

	if ($_REQUEST['Start'] == 1)
		{	
			include ("datasource.php");
			$mResult = $mysqli->query("Call sp_GeneralJournal_RecSelect('".$_REQUEST['ID']."')");

			if (mysqli_num_rows($mResult) > 0)
				{
					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{
							$mControlNo = $ado['GJID_cd'];
							$mControlNo_ = $ado['GJID_cd'];
							//$mMonth1 = (int)substr($ado['GJDate_dt'],5,2)+1;
							//$mDay1 = substr($ado['GJDate_dt'],8,2);
							//$mYear1 = substr($ado['GJDate_dt'],0,4);
							$mDate1 =$ado['GJDate_dt'];
							$mReferenceNo = $ado['ReferenceID_cd'];
							$mAmount = $ado['Amount_no'];
							$mParticular = $ado['Particular_tx'];

							$mRec = $mRec + 1; 							
							$mData = $mData.$ado['AccountID_cd'].'!'
										   .fp_Get_Record("AccountDesc_tx","tb_mcoahdr","AccountID_cd = ''".$ado['AccountID_cd']."''").'!'	
										   .$ado['SubsidiaryID_cd'].'!'
										   .$ado['DebitAmount_no'].'!'
										   .$ado['CreditAmount_no'].'!*';
						} 
				$_SESSION['myData']=$mData;
				}
		}
		
	if ($_REQUEST['Start'] == 2)
		{															
			$mControlNo = $_REQUEST['ControlNo'];
			$mControlNo_ = $_REQUEST['ControlNo_'];
			//$mMonth1 = $_REQUEST['Month1'];
			//$mDay1 = $_REQUEST['Day1'];
			//$mYear1 = $_REQUEST['Year1'];
			$mDate1 = $_REQUEST['Date1'];
			$mReferenceNo = $_REQUEST['ReferenceNo'];
			$mAmount = $_REQUEST['Amount'];
			$mParticular = $_REQUEST['Particular'];
			$mStatus = $_REQUEST['Status'];
			$mRec = $_REQUEST['Rec'];
			$mData = $_SESSION['myData'];//$_REQUEST['Data'];

			$mGJDate = $mDate1;//$mYear1.'-'.((int)$mMonth1-1).'-'.$mDay1;

			$mKey = $_SESSION['S_UserID'].'!'.
					$_SESSION['S_IPID'].'!'.
					$mControlNo.'!'.
					$mGJDate.'!'.
					$mReferenceNo.'!'.
					$mAmount.'!'.
					$mParticular.'!'.
					$mData.'!';

			include ("datasource.php");					
			$mResult = $mysqli->query("Call sp_GeneralJournalHDR_Update('".$_SESSION['S_UserID']."','"
																		  .$mControlNo."','"
																		  .$mControlNo_."','"
																		  .$mGJDate."','"
																		  .$mReferenceNo."',"
																		  .$mAmount.",'"
																		  .$mStatus."','"
																		  .addslashes($mParticular)."','"
																		  .md5_encrypt($mKey,'mysystem')."')");
			if ($mResult == 1)
				{							
					$mDetail = fp_Add_FinancialDetail("tb_tgeneraljournaldtl",$_REQUEST['ControlNo'],$mRec,$mData);
					$mOk = 1;
				}							
			else
				{							
					$mOk = 0;
				}							
			mysqli_close($mysqli);
		}															
?>
<html>
<head>
	<title>Update General Journal</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
	<script language="JavaScript" src="Functions.js"></script>
	<script language="JavaScript">
	onerror=handleErr;
	</script>
</head>
<body background="../images/background.JPG" onLoad="document.frmFinancial.cboMonth1.focus(); eGeneralJournal_LoadAccount();"> 
<form name="frmFinancial" action="generaljournal_edit.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td valign="top" align="center" background="../images/bg_left.gif" bordercolor="#FFFFFF">

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
                                                        	<font size="+1">GENERAL JOURNAL (UPDATE)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                          	<input type="button" name="cmdNew" class="detail1" value="  Create New Record "  <?php if ($mAccess2 == '') { ?>disabled<?php } ?> onClick="javascript:eGeneralJournal_Action(1);">
                                                            <input type='button' name='cmdDelete' class='detail1' value='Delete Account(s)' <?php if ($mAccess5 == '') { ?>disabled<?php } ?> onClick='javascript:eGeneralJournal_DeleteAccount();' tabindex="0">
                                                            <input type="button" name="cmdSave" class="detail1" value="  [F8] - Save  "  <?php if ($mAccess3 == '' || $mOk == 1) { ?>disabled<?php } ?> onClick="javascript:eGeneralJournal_Action(2);">
                                                            <input type="button" name="cmdPost" class="detail1" value="  [F9] - Post "  <?php if ($mAccess6 == '' || $mOk == 1) { ?>disabled<?php } ?> onClick="javascript:eGeneralJournal_Action(4);" tabindex="14">
                                                            <input type="button" name="cmdSearch" class="detail1" value="  Search/List Record(s)  " onClick="javascript:eGeneralJournal_Action(3);">
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
											<td width="13%" class="detail1">&nbsp;Journal#</td>
											<td width="87%" class="detail1">
												&nbsp;<font color="#FF0000" size="+1"><?php echo $mControlNo ?></font>
                                                <input name="hidControlNo" id="hidControlNo" type="hidden" value="<?php echo $mControlNo ?>">
                                                <input name="hidControlNo_" id="hidControlNo_" type="hidden" value="<?php echo $mControlNo_ ?>">
                                        	    <input name="hidRec" type="hidden" value="<?php echo $mRec ?>" size="2">
												<input name="hidData" type="hidden" value="<?php echo $mData ?>" size="150">
                                            </td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td class="detail1">&nbsp;Journal Date</td>
											<td class="detail1" colspan="2">
 												<input type="text" id="Date1" maxlength="25" size="25" readonly="true" value="<?php echo $mDate1 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date1');" style="cursor:pointer"/>
											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Voyage Ref.#&nbsp;</td>
											<td colspan="2" class="detail1">
												&nbsp;<input name="txtReferenceNo" id="txtReferenceNo" type="text" size="9" maxlength="15" value="<?php echo $mReferenceNo ?>" class="detail1" tabindex="4" onKeyUp="aGeneralJournal_SearchVoyageReference();" autocomplete="off">
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
												<div id="voyagereference"></div>

											</td>
										</tr>										
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Journal Amount</td>
											<td colspan="2" class="detail1">
												&nbsp;<input type="text" name="txtAmount" value="<?php echo $mAmount; ?>" class="detail1" size="9" maxlength="13" dir="rtl" tabindex="4" onKeyPress="javascript:EnterKey(4,event);">												
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
                                            </td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Particular</td>
										  	<td colspan="2" class="detail1">
												&nbsp;<textarea name="txtParticular" cols="80" rows="3" class="detail1" tabindex="6"><?php echo $mParticular ?></textarea>
											</td>
										</tr>
									</table>											
									<table bgcolor="#CCCCCC" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
										<tr>
											<td>
                                                <div id='Table'></div>
												<table width="100%" border="0" cellspacing="0" cellpadding="1" class="title5">
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Account Code:
                                                        </td>
														<td width="87%" align="left" class="title5">
															<input type="text" name="txtAccountID" id="txtAccountID" size="5" maxlength="5" class="detail13" tabindex="7" onKeyPress="javascript:eGeneralJournal_EnterAccountID(event);">
														</td>
                                                    </tr>
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Account Title:
                                                        </td>
														<td width="87%" align="left" class="title5">
                                                            <select name="cboAccountID" class="detail1" tabindex="8" onChange="javascript:eGeneralJournal_SearchAccount_();" onKeyPress="javascript:eGeneralJournal_EnterAccountID_(event);">
															<option value="">-Select Account-</option>
<?php
															include ("datasource.php");
															$mResult = $mysqli->query("Call sp_ControlAccount_Select()");

															if (mysqli_num_rows($mResult) > 0)
																{
																	while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
																		{ 
?>
                                                                            <option value="<?php echo $ado["AccountID_cd"] ?>"><?php echo $ado["AccountID_cd"].' - '.strtoupper($ado["AccountDesc_tx"]) ?></option>
<?php
																		}
																}
															mysqli_close($mysqli);
?>
                                                            </select>
                                                        	<input type="hidden" Name="txtAccountTitle" id="txtAccountTitle" size="40" readonly="true" tabindex="1000" class="detail1">
                                                        	<input type="hidden" name="hidDebit">
                                                        	<input type="hidden" name="hidTotCount">
														</td>
                                                    </tr>
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Subsidiary Name:
                                                        </td>
														<td width="87%" align="left" class="title5">
                                                            <select name="cboSubsidiaryID" class="detail1" onKeyPress="javascript:eGeneralJournal_EnterSubsidiaryID(event);" tabindex="9">
															<option value="">-Subsidiary Description-</option>
<?php
															include ("datasource.php");
															$mResult = $mysqli->query("Call sp_SubsidiaryAccount_Select('')");

															if (mysqli_num_rows($mResult) > 0)
																{
																	while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
																		{ 
?>
                                                                            <option value="<?php echo $ado["SubsidiaryID_cd"] ?>"><?php echo substr(strtoupper($ado["SubsidiaryName_tx"]),0,30) ?></option>
<?php
																		}
																}
															mysqli_close($mysqli);
?>
                                                            </select>
														</td>
													</tr>	
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Debit:
                                                        </td>
														<td width="87%" align="left" class="title5">
                                                            <input type="text" Name="txtDebit" id="txtDebit" size="10" value="0.00" class="detail13" dir="rtl" onKeyPress="javascript:eGeneralJournal_EnterSave(event); return gf_ValidCurrency(event.keyCode);" tabindex="10">
														</td>
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Credit:
                                                        </td>
														<td width="87%" align="left" class="title5">
                                                            <input type="text" Name="txtCredit" id="txtCredit" size="10" value="0.00" class="detail13" dir="rtl" onKeyPress="javascript:eGeneralJournal_EnterSave(event); return gf_ValidCurrency(event.keyCode);" tabindex="11">
                                                   		</td>
                                               	  	</tr>
											  	</table>
											</td>
										</tr>
									</table>	
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
		<td valign="top"><img border="0" src="../images/bg_bottom.gif" width="790" height="17"></td>

		<td align="left">

		</td>
	</tr>
</table>
</form>
</body>
</html>
<?php
	if ($mOk=='1')
		{
?>
			<script>
				alert('Successfully Save Record!');
			</script>
<?php
		}


	if ($mOk=='0')
		{
?>
			<script>
				alert('Unable to check Record!');
			</script>
<?php
		}
?>
