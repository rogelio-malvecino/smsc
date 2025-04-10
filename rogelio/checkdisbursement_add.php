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
	
	$mOk = -1;
	
	$mControlNo = '';
	$mControlNo_ = '';
	$mDate1 = date("Y-m-d"); 
	$mReferenceNo = '';
	$mPaymasterID = '';
	$mBankID = '';
	$mCheckNo = '';
	$mDate2 = date("Y-m-d"); 
	$mAmount = 0;
	$mParticular = '';
	$mRec = 0;
	$mData = '';
	
	$mCDDate = '';

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
			$mControlNo = fp_Auto_FinancialNumber("CDID_cd","tb_tcheckdisbursementhdr","1=1");
			$mControlNo_ = $mControlNo;
		}
		
	if ($_REQUEST['Start'] == 2)
		{															
			$mControlNo = $_REQUEST['ControlNo'];
			$mControlNo_ = $_REQUEST['ControlNo'];
				$mDate1 = $_REQUEST['Date1'];
			$mReferenceNo = $_REQUEST['ReferenceNo'];
			$mPaymasterID = $_REQUEST['PaymasterID'];
			$mBankID = $_REQUEST['BankID'];
			$mCheckNo = $_REQUEST['CheckNo'];
			$mDate2 = $_REQUEST['Date2'];
			$mAmount = $_REQUEST['Amount'];
			$mParticular = $_REQUEST['Particular'];
			$mRec = $_REQUEST['Rec'];
			$mData = $_SESSION['myData'];//$_REQUEST['Data'];

			$mCDDate = $mDate1;//$mYear1.'-'.((int)$mMonth1-1).'-'.$mDay1;
			$mCheckDate = $mDate2;//$mYear2.'-'.((int)$mMonth2-1).'-'.$mDay2;

//*			
			
			include ("datasource.php");						
			$mResult = $mysqli->query("SELECT Checkno_tx FROM tb_tcheckdisbursementhdr WHERE Checkno_tx='" .$mCheckNo. "'");

			if (mysqli_num_rows($mResult) > 0)

				{
					$_SESSION['SysMsg'] = '!!!WARNING Duplicate RECORD!!! Check Number ('.$mCheckNo.') Already Exist!';
					include ('failed.php');
					mysqli_close($mysqli);
				
				}

//***
			else
	
			{
			

			
			
			
//*			include ("datasource.php");						
			$mResult = $mysqli->query("Call sp_CheckDisbursement_Verify('_','".$_REQUEST['ControlNo']."')");

			if (mysqli_num_rows($mResult) > 0)
				{
					$_SESSION['SysMsg'] = 'Unable to Saved Record, CV No ('.$_REQUEST['ControlNo'].') Already Exist!';
					include ('failed.php');
					mysqli_close($mysqli);
				}
			else
				{				
					mysqli_close($mysqli);
					include ("datasource.php");					

					$mKey = $_SESSION['S_UserID'].'!'.
							$_SESSION['S_IPID'].'!'.
							$mControlNo.'!'.
							$mCDDate.'!'.
							$mReferenceNo.'!'.
							$mPaymasterID.'!'.
							$mBankID.'!'.
							$mCheckNo.'!'.
							$mCheckDate.'!'.
							$mAmount.'!'.
							$mParticular.'!'.
							$mData.'!';

					$mResult = $mysqli->query("Call sp_CheckDisbursementHDR_Insert('".$_SESSION['S_UserID']."','"
																					 .$mControlNo."','"
																					 .$mCDDate."','"
																					 .$mReferenceNo."','"
																					 .$mPaymasterID."','"
																					 .$mBankID."','"
																					 .$mCheckNo."','"
																					 .$mCheckDate."',"
																					 .$mAmount.",'"
																					 .addslashes($mParticular)."','"
																					 .md5_encrypt($mKey,'baseline')."')");
					if ($mResult == 1)
						{							
							$mDetail = fp_Add_FinancialDetail("tb_tcheckdisbursementdtl",$_REQUEST['ControlNo'],$mRec,$mData);
							$mOk = 1;
							//UPDATE THE CHECK AMOUNT
							  include ("datasource.php");
							  $mResult = $mysqli->query("Call sp_Execute_Query('update tb_tcheckdisbursementhdr as hdr set hdr.amount_no =(select CreditAmount_no from tb_tcheckdisbursementdtl as dtl  where hdr.CDID_CD= dtl.CDID_CD and hdr.bankid_cd = dtl.accountid_cd) WHERE hdr.CDID_cd =''".$mControlNo."''')");
							 //UPDATE THE CHECK AMOUNT

						}							
					else
						{
							$mOk = 0;
						}
					mysqli_close($mysqli);
				 }					
			}
		}															
?>
<html>
<head>
	<title>Add Check Disbursement</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
	<script language="JavaScript" src="../global/Functions.js"></script>
	<script language="JavaScript">
	onerror=handleErr;
	</script>
</head>
<body background="../images/background.JPG" onLoad="document.frmFinancial.txtControlNo.focus(); aCheckDisbursement_LoadAccount();"> 
<form name="frmFinancial" action="checkdisbursement_add.php?Start=2&Action=Save&Routine=1" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td valign="top" align="center" background="../images/bg_left.gif" bordercolor="#FFFFFF">

		</td>
		<td>
			<table width="100%" border="0" bgcolor="#EBEBEB" cellspacing="0" cellpadding="1" align="center">
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
                                                        	<font size="+1">CHECK DISBURSEMENT (NEW)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                          	<input type="button" name="cmdNew" class="detail1" value="  Create New Record "  <?php if ($mAccess2 == '') { ?>disabled<?php } ?> onClick="javascript:aCheckDisbursement_Action(1);">
                                                            <input type='button' name='cmdDelete' class='detail1' value='Delete Account(s)' <?php if ($mAccess5 == '1') { ?>disabled<?php } ?> onClick='javascript:aCheckDisbursement_DeleteAccount();' tabindex="0">
                                                            <input type="button" name="cmdSave" class="detail1" value="  [F8] - Save  "  <?php if ($mAccess3 == '' || $mOk == 1) { ?>disabled<?php } ?> onClick="javascript:aCheckDisbursement_Action(2);">
                                                            <input type="button" name="cmdSearch" class="detail1" value="  Search/List Record(s)  " onClick="javascript:aCheckDisbursement_Action(3);">
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
											<td width="100" class="detail1">&nbsp;Voucher No</td>
											<td colspan="2" class="detail1">
												&nbsp;<input name="txtControlNo" id="txtControlNo" type="text" size="9" maxlength="15" value="<?php echo $mControlNo ?>" class="detail13" tabindex="1" onKeyPress="javascript:EnterKey(1,event);">
												&nbsp;<font color="#FF0000" size="+1">*</font>
                                        	    <input name="hidRec" type="hidden" value="<?php echo $mRec ?>" size="2">
												<input name="hidData" type="hidden" value="<?php echo $mData ?>" size="50">
                                            </td>
								  	  	</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Voucher Date</td>
											<td class="detail1" colspan="2">
												<input type="text" id="Date1" maxlength="25" size="25" readonly="true" value="<?php echo $mDate1 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date1');" style="cursor:pointer"/>
											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Voyage Ref.#&nbsp;</td>
											<td colspan="2" class="detail1">
												&nbsp;<input name="txtReferenceNo" id="txtReferenceNo" type="text" size="9" maxlength="15" value="<?php echo $mReferenceNo ?>" class="detail1" tabindex="4" onKeyUp="aCheckDisbursement_SearchVoyageReference();" autocomplete="off">
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
												<div id="voyagereference"></div>

											</td>
										</tr>										
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Pay to the Order of</td>
											<td colspan="2" class="detail1">
												&nbsp;<input name="txtPaymasterID" id="txtPaymasterID" type="text" size="40" maxlength="45" value="<?php echo $mPaymasterID ?>" class="detail1" tabindex="4" onKeyUp="aCheckDisbursement_SearchPaymasterID();" autocomplete="off">
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
												<div id="PaymasterID"></div>
											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Bank</td>
											<td colspan="2" class="detail1">
											    &nbsp;<select name="cboBankID" class="detail1" tabindex="6" onKeyPress="javascript:EnterKey(6,event);">
<?php
												include ("datasource.php");
												$mResult = $mysqli->query("Call sp_ControlAccountBank_Select('1')");

												if (mysqli_num_rows($mResult) > 0)
													{
														while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
															{ 
?>
                                                                <option value="<?php echo $ado["AccountID_cd"] ?>" <?php if ($mBankID == $ado["AccountID_cd"]) { ?>selected<?php } ?>><?php echo $ado["AccountDesc_tx"] ?></option>
<?php
															}
													}
												mysqli_close($mysqli);
?>
                                                </select>
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Check#&nbsp;</td>
											<td colspan="2" class="detail1">
<?php
												include ("datasource.php");
												$mResult = $mysqli->query("Call sp_Execute_Query('Select (CheckNo_tx + 1) as CheckNo from tb_tcheckdisbursementhdr order by CDID_cd desc limit 1')");
												echo $mysqli->error;
												if (mysqli_num_rows($mResult) > 0)
													{
														while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
															{ 
															?>
												&nbsp;<input name="txtCheckNo" type="text" size="9" maxlength="15" value="<?php echo $ado['CheckNo'] ?>" class="detail1" tabindex="7" onKeyPress="javascript:EnterKey(7,event);">

																							
															<?php	
															}
													}
												else
													{
															?>
												&nbsp;<input name="txtCheckNo" type="text" size="9" maxlength="15" value="0000000000" class="detail1" tabindex="7" onKeyPress="javascript:EnterKey(7,event);">

																							
															<?php	
													
													}
												mysqli_close($mysqli);
							
?>


                                                &nbsp;<font color="#FF0000" size="+1">*</font>
											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Check Date</td>
												<td class="detail1" colspan="2">
												<input type="text" id="Date2" maxlength="25" size="25" readonly="true" value="<?php echo $mDate2 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date2');" style="cursor:pointer"/>
											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Check Amount</td>
											<td colspan="2" class="detail1">
												&nbsp;<input type="text" name="txtAmount" value="<?php echo $mAmount; ?>" class="detail1" size="9" maxlength="13" dir="rtl" tabindex="11" onKeyPress="javascript:EnterKey(11,event);">											
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
                                            </td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Particular</td>
										  	<td colspan="2" class="detail1">
												&nbsp;<textarea name="txtParticular" cols="80" rows="3" class="detail1" tabindex="14"><?php echo $mParticular ?></textarea>
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
															<input type="text" name="txtAccountID" id="txtAccountID" size="5" maxlength="5" class="detail13" tabindex="15" onKeyPress="javascript:aCheckDisbursement_EnterAccountID(event);">
														</td>
                                                    </tr>
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Account Title:
                                                        </td>
														<td width="87%" align="left" class="title5">
                                                            <select name="cboAccountID" class="detail1" tabindex="8" onChange="javascript:aCheckDisbursement_SearchAccount_();" onKeyPress="javascript:aCheckDisbursement_EnterAccountID_(event);">
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
                                                            <select name="cboSubsidiaryID" class="detail1" onKeyPress="javascript:aCheckDisbursement_EnterSubsidiaryID(event);" tabindex="9">
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
                                                            <input type="text" Name="txtDebit" id="txtDebit" size="10" value="0.00" class="detail13" dir="rtl" onKeyPress="javascript:aCheckDisbursement_EnterSave(event);" tabindex="16">
														</td>
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Credit:
                                                        </td>
														<td width="87%" align="left" class="title5">
                                                            <input type="text" Name="txtCredit" id="txtCredit" size="10" value="0.00" class="detail13" dir="rtl" onKeyPress="javascript:aCheckDisbursement_EnterSave(event);" tabindex="17">
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
