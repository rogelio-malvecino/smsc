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
	//$mMonth1 = date("n") + 1;
	//$mDay1 = date("d");
	//$mYear1 = date("Y");
	$mDate1 = date("Y-m-d"); 
	$mReferenceNo = '';
	$mParticular = '';
	$mPaymasterID = '';
	$mBankID = '';
	$mCheckNo = '';
	//$mMonth2 = date("n") + 1;
	//$mDay2 = date("d");
	//$mYear2 = date("Y");
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
			include ("datasource.php");
			$mResult = $mysqli->query("Call sp_CheckDisbursement_RecSelect('".$_REQUEST['ID']."')");

			if (mysqli_num_rows($mResult) > 0)
				{
					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{
							$mControlNo = $ado['CDID_cd'];
							$mControlNo_ = $ado['CDID_cd'];
							//$mMonth1 = (int)substr($ado['CDDate_dt'],5,2)+1;
							//$mDay1 = substr($ado['CDDate_dt'],8,2);
							//$mYear1 = substr($ado['CDDate_dt'],0,4);
							$mDate1 = $ado['CDDate_dt']; 
							$mReferenceNo = $ado['ReferenceID_cd'];
							$mPaymasterID = $ado['PaymasterID_cd'];
							$mBankID = $ado['BankID_cd'];
							$mCheckNo = $ado['CheckNo_tx'];
							//$mMonth2 = (int)substr($ado['CheckDate_dt'],5,2)+1;
							//$mDay2 = substr($ado['CheckDate_dt'],8,2);
							//$mYear2 = substr($ado['CheckDate_dt'],0,4);
							$mDate2 = $ado['CheckDate_dt']; 
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
			$mDate1 =$_REQUEST['Date1'];
			$mReferenceNo = $_REQUEST['ReferenceNo'];
			$mPaymasterID = $_REQUEST['PaymasterID'];
			$mBankID = $_REQUEST['BankID'];
			$mCheckNo = $_REQUEST['CheckNo'];
			//$mMonth2 = $_REQUEST['Month2'];
			//$mDay2 = $_REQUEST['Day2'];
			//$mYear2 = $_REQUEST['Year2'];
			$mDate2 =$_REQUEST['Date2'];
			$mAmount = $_REQUEST['Amount'];
			$mParticular = $_REQUEST['Particular'];
			$mStatus = $_REQUEST['Status'];
			$mRec = $_REQUEST['Rec'];
			$mData = $_SESSION['myData'];//$_REQUEST['Data'];

			$mCDDate = $mDate1; //$mYear1.'-'.((int)$mMonth1-1).'-'.$mDay1;
			$mCheckDate = $mDate2; //$mYear2.'-'.((int)$mMonth2-1).'-'.$mDay2;

			include ("datasource.php");						
			$mResult = $mysqli->query("Call sp_CheckDisbursement_Verify('".$_REQUEST['ControlNo_']."','".$_REQUEST['ControlNo']."')");

			if (mysqli_num_rows($mResult) > 0)
				{
					$_SESSION['SysMsg'] = 'Unable to Saved Record, CV No ('.$_REQUEST['ControlNo'].') Already Exist!';
					include ('../global/failed.php');
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

					$mResult = $mysqli->query("Call sp_CheckDisbursementHDR_Update('".$_SESSION['S_UserID']."','"
																					 .$mControlNo."','"
																					 .$mControlNo_."','"
																				     .$mCDDate."','"
																					 .$mReferenceNo."','"
																					 .$mPaymasterID."','"
																					 .$mBankID."','"
																					 .$mCheckNo."','"
																					 .$mCheckDate."',"
																					 .$mAmount.",'"
																					.$mStatus."','"
																					 .addslashes($mParticular)."','"
																					 .md5_encrypt($mKey,'mysystem')."')");
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
?>
<html>
<head>
	<title>Update Check Disbursement</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
	<script language="JavaScript" src="Functions.js"></script>

</head>
<body background="../images/background.JPG" onLoad="document.frmFinancial.txtAmount.focus(); eCheckDisbursement_LoadAccount();"> 
<form name="frmFinancial" action="checkdisbursement_edit.php" method="post">
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
                                                        	<font size="+1">CHECK DISBURSEMENT (UPDATE)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                          	<input type="button" name="cmdNew" class="detail1" value="  Create New Record "  <?php if ($mAccess1 == '') { ?>disabled<?php } ?> onClick="javascript:eCheckDisbursement_Action(1);">
                                                            <input type='button' name='cmdDelete' class='detail1' value='Delete Account(s)' <?php if ($mOk == '1') { ?>disabled<?php } ?> onClick='javascript:eCheckDisbursement_DeleteAccount();' tabindex="0">
                                                            <input type="button" name="cmdSave" class="detail1" value="  [F8] - Save  "  <?php if ($mAccess1 == '' || $mOk == 1) { ?>disabled<?php } ?> onClick="javascript:eCheckDisbursement_Action(2);">
                                                            <input type="button" name="cmdPost" class="detail1" value="  [F9] - Post "  <?php if ($mAccess5 == '' || $mOk == 1) { ?>disabled<?php } ?> onClick="javascript:eCheckDisbursement_Action(5);" tabindex="14">
                                                            <input type="button" name="cmdSearch" class="detail1" value="  Search/List Record(s)  " onClick="javascript:eCheckDisbursement_Action(3);">
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
											<td width="13%" class="detail1">&nbsp;Voucher#</td>
											<td class="detail1" colspan="2">
												&nbsp;<input name="txtControlNo" id="txtControlNo" type="text" size="9" maxlength="15" value="<?php echo $mControlNo ?>" class="detail13" tabindex="1">
                                        	    &nbsp;<font color="#FF0000" size="+1">*</font>
                                                <input name="hidControlNo" type="hidden" value="<?php echo $mControlNo_ ?>">
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
											    &nbsp;<select name="cboBankID" class="detail1" tabindex="6" onKeyPress="javascript:eCheckDisbursement_EnterKey(6,event);">
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
												&nbsp;<input name="txtCheckNo" type="text" size="9" maxlength="15" value="<?php echo $mCheckNo ?>" class="detail1" tabindex="7" onKeyPress="javascript:eCheckDisbursement_EnterKey(7,event);">
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
												&nbsp;<input type="text" name="txtAmount" value="<?php echo $mAmount; ?>" class="detail1" size="9" maxlength="13" dir="rtl" tabindex="11" onKeyPress="javascript:eCheckDisbursement_EnterKey(11,event);">											
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
															<input type="text" name="txtAccountID" id="txtAccountID" size="5" maxlength="5" class="detail13" tabindex="15" onKeyPress="javascript:eCheckDisbursement_EnterAccountID(event);">
														</td>
                                                    </tr>
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Account Title:
                                                        </td>
														<td width="87%" align="left" class="title5">
                                                            <select name="cboAccountID" class="detail1" tabindex="8" onChange="javascript:eCheckDisbursement_SearchAccount_();" onKeyPress="javascript:eCheckDisbursement_EnterAccountID_(event);">
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
                                                            <select name="cboSubsidiaryID" class="detail1" onKeyPress="javascript:eCheckDisbursement_EnterSubsidiaryID(event);" tabindex="9">
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
                                                            <input type="text" Name="txtDebit" id="txtDebit" size="10" value="0.00" class="detail13" dir="rtl" onKeyPress="javascript:eCheckDisbursement_EnterSave(event);" tabindex="16">
														</td>
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Credit:
                                                        </td>
														<td width="87%" align="left" class="title5">
                                                            <input type="text" Name="txtCredit" id="txtCredit" size="10" value="0.00" class="detail13" dir="rtl" onKeyPress="javascript:eCheckDisbursement_EnterSave(event);" tabindex="17">
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
