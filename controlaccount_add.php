<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	
	include ("datasource.php");
	include ("function.php");	

	//Is_Logged_In();
	
	$mAccess1 = "1";//fp_Get_Record("Access_yn","tb_muserrights", "UserID_cd = ''".$_SESSION['UserID']."'' AND FuncID_cd = ''COANEW''");
	
	$mOk = -1;
	$mAccountID = '';
	$mAccountDesc = '';
	$mGroupID = '';
	$mBank = '';
	$mNormal ='';
	$mCR = '';
	$mPB = '';
	$mCS = '';
	$mBS = '';
	$mCD = '';
	$mGJ = '';
	$mBalanceSheet = '';
	$mBalanceSheetType = '';
	$mIncomeStatement = '';
	$mIncomeStatementType = '';
	$mCashFlow = '';
	$mCashFlowType = '';
	$mFinanceStatementPerVoyage = '';
	$mFinanceStatementPerVoyageType = '';
		
	if ($_REQUEST['Start'] == 2)
		{													
			$mAccountID = $_REQUEST["AccountID"];
			$mAccountDesc = $_REQUEST["AccountDesc"];
			$mGroupID = $_REQUEST["GroupID"];
			$mBank = $_REQUEST["Bank"];
			$mNormal = $_REQUEST["Normal"];
			$mCR = $_REQUEST["CR"];
			$mPB = $_REQUEST["PB"];
			$mCS = $_REQUEST["CS"];
			$mBS = $_REQUEST["BS"];
			$mCD = $_REQUEST["CD"];
			$mGJ = $_REQUEST["GJ"];
			$mBalanceSheet = $_REQUEST["BalanceSheet"];
			$mBalanceSheetType = $_REQUEST["BalanceSheetType"];
			$mIncomeStatement = $_REQUEST["IncomeStatement"];
			$mIncomeStatementType = $_REQUEST["IncomeStatementType"];
			$mCashFlow = $_REQUEST["CashFlow"];
			$mCashFlowType = $_REQUEST["CashFlowType"];
			$mFinanceStatementPerVoyage = $_REQUEST["FinanceStatementPerVoyage"];
			$mFinanceStatementPerVoyageType = $_REQUEST["FinanceStatementPerVoyageType"];


			$mKey = $_SESSION['S_UserID'].'!'.
					$_SESSION['S_IPID'].'!'.
					$mAccountID.'!'.
					$mAccountDesc.'!'.
					$mGroupID.'!'.
					$mBank.'!'.
					$mNormal.'!'.
					$mCR.'!'.
					$mPB.'!'.
					$mCS.'!'.
					$mBS.'!'.
					$mCD.'!'.
					$mGJ.'!'.
					$mBalanceSheet.'!'.
					$mBalanceSheetType.'!'.
					$mIncomeStatement.'!'.
					$mIncomeStatementType.'!'.
					$mCashFlow.'!'.
					$mCashFlowTyp.'!'.
					$mFinanceStatementPerVoyage.'!'.
					$mFinanceStatementPerVoyageType;				
									
			$mResult = $mysqli->query("Call sp_ControlAccount_Insert('".$_SESSION['S_UserID']."','"
																	   .$mAccountID."','"
																	   .$mAccountDesc."','"
																	   .$mGroupID."','"
																	   .$mBank."','"
																	   .$mNormal."','"
																	   .$mCR."','"
																	   .$mPB."','"
																	   .$mCS."','"
																	   .$mBS."','"
																	   .$mCD."','"
																	   .$mGJ."','"
																	   .$mBalanceSheet."','"
																	   .$mBalanceSheetType."','"
																	   .$mIncomeStatement."','"
																	   .$mIncomeStatementType."','"
																	   .$mCashFlow."','"
																	   .$mCashFlowType."','"
																	   .$mFinanceStatementPerVoyage."','"
																	   .$mFinanceStatementPerVoyageType."','"
																	   .md5_encrypt($mKey,'mysystem')."')");
//echo $mysqli->error;
			if ($mResult == 1)
				{					
					$mOk = 1;
					//echo "successful";
				}					
			else
				{					
					$mOk = 0;
					//echo $mysqli->error." failure";
				}					
			mysqli_close($mysqli);
		}						
?>
<html>
<head>
	<title>Add Control Account</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
	<script language="JavaScript" src="Functions.js"></script>
</head>
<body background="../images/background.JPG" onLoad="false; document.frmFinancial.txtAccountID.focus();"> 
<form name="frmFinancial" action="controlaccount_add.php" method="post">
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
                                                        	<font size="+1">CONTROL ACCOUNT (NEW)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                          	<input type="button" name="cmdNew" class="detail1" value="  Create New Record "  <?php if ($mAccess1 == '') { ?>disabled<?php } ?> onClick="javascript:aControlAccount_Action(1);">
                                                            <input type="button" name="cmdSave" class="detail1" value="  [F8] - Save  "  <?php if ($mAccess1 == '' || $mOk == 1) { ?>disabled<?php } ?> onClick="javascript:aControlAccount_Action(2);" tabindex="13">
                                                            <input type="button" name="cmdSearch" class="detail1" value="  Search/List Record(s)  " onClick="javascript:aControlAccount_Action(3);">
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
											<td width="135" class="detail1">&nbsp;Account Code</td>
											<td colspan="6" class="detail1">
												&nbsp;<input name="txtAccountID" type="text" size="3" maxlength="5" value="<?php echo $mAccountID ?>" class="detail13" tabindex="1" onKeyPress="javascript:EnterKey(1,event);" onKeyUp="javascript:return gf_Save(event);" onBlur="javascript:CheckAccountID();">
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
                                        	</td>
											<td></td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="135" class="detail1">&nbsp;Account Title</td>
											<td colspan="6" class="detail1">
												&nbsp;<input name="txtAccountDesc" type="text" size="80" maxlength="80" value="<?php echo $mAccountDesc ?>" class="detail1" tabindex="2" onKeyPress="javascript:EnterKey(2,event);" onKeyUp="javascript:return gf_Save(event);">
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
											</td>
											<td></td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="135" class="detail1">&nbsp;Account Group</td>
											<td colspan="6" class="detail1">
											    &nbsp;<select name="cboGroupID" class="detail1" tabindex="3" onKeyPress="javascript:EnterKey(3,event);" onKeyUp="javascript:return gf_Save(event);">
<?php
												include ("datasource.php");
												$mResult = $mysqli->query("Call sp_ControlAccountGroup_Select()");

												if (mysqli_num_rows($mResult) > 0)
													{
														while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
															{ 
?>
                                                                <option value="<?php echo $ado["GroupID_cd"] ?>" <?php if ($mGroupID == $ado["GroupID_cd"]) { ?>selected<?php } ?>><?php echo $ado["GroupName_tx"] ?></option>
<?php
															}
													}
												mysqli_close($mysqli);
?>
                                                </select>
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
											</td>
											<td></td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="135" class="detail1">&nbsp;Account Settings</td>
											<td class="detail1">
												<input name="chkBank" type="checkbox" value="<?php echo $mBank ?>" <?php if ($mBank=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="4" onKeyPress="javascript:EnterKey(4,event);" onKeyUp="javascript:return gf_Save(event);">Cash in Bank
										  </td>
											<td class="detail1" colspan="5">
												<input name="chkNormal" type="checkbox" value="<?php echo $mNormal ?>" <?php if ($mNormal=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="5" onKeyPress="javascript:EnterKey(5,event);" onKeyUp="javascript:return gf_Save(event);">Normal Value (DR)
											</td>
											<td></td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="135" class="detail1">&nbsp;Book Setting</td>
											<td class="detail1" nowrap>
                                            	<input name="chkCR" type="checkbox" value="<?php echo $mCR ?>" <?php if ($mCR=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="6" onKeyPress="javascript:EnterKey(6,event);" onKeyUp="javascript:return gf_Save(event);">Cash Receipts<BR>
                                            </td>
                                            <td class="detail1" nowrap>
                                                <input name="chkPB" type="checkbox" value="<?php echo $mPB ?>" <?php if ($mPB=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="7" onKeyPress="javascript:EnterKey(7,event);" onKeyUp="javascript:return gf_Save(event);">Purchases<BR>
                                            </td>
                                            <td class="detail1" nowrap>
                                                <input name="chkCS" type="checkbox" value="<?php echo $mCS ?>" <?php if ($mCS=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="8" onKeyPress="javascript:EnterKey(8,event);" onKeyUp="javascript:return gf_Save(event);">Cash Sales<BR>
                                            </td>    
                                            <td class="detail1" nowrap>
                                                <input name="chkBS" type="checkbox" value="<?php echo $mBS ?>" <?php if ($mBS=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="9" onKeyPress="javascript:EnterKey(9,event);" onKeyUp="javascript:return gf_Save(event);">Charge Sales<BR>
                                            </td>    
                                            <td class="detail1" nowrap>
                                                <input name="chkCD" type="checkbox" value="<?php echo $mCD ?>" <?php if ($mCD=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="10" onKeyPress="javascript:EnterKey(10,event);" onKeyUp="javascript:return gf_Save(event);">Check Disbursement<BR>
                                            </td>
                                            <td class="detail1" nowrap>
                                                <input name="chkGJ" type="checkbox" value="<?php echo $mGJ ?>" <?php if ($mGJ=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="11" onKeyPress="javascript:EnterKey(11,event);" onKeyUp="javascript:return gf_Save(event);">General Journal
											</td>
											<td></td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="135" class="detail1">&nbsp;Report Setting&nbsp;</td>
											<td colspan="2" class="detail1">
                                            	<input name="chkBalanceSheet" type="checkbox" value="<?php echo $mBalanceSheet ?>" <?php if ($mBalanceSheet=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="12" onKeyPress="javascript:EnterKey(12,event);" onKeyUp="javascript:return gf_Save(event);">
												Balance Sheet<BR>		
												&nbsp;<select name="cboBalanceSheetType" id="cboBalanceSheetType" class="detail1" tabindex="13" onKeyUp="javascript:return gf_Save(event);">
												<option value="0" <?php if ($mBalanceSheetType == "0") { ?>selected<?php } ?>>-Select Group-</option>
												<option value="1" <?php if ($mBalanceSheetType == "1") { ?>selected<?php } ?>>Assets</option>
												<option value="2" <?php if ($mBalanceSheetType == "2") { ?>selected<?php } ?>>Fixed Assets (Add)</option>
												<option value="3" <?php if ($mBalanceSheetType == "3") { ?>selected<?php } ?>>Fixed Assets (Less)</option>
												<option value="4" <?php if ($mBalanceSheetType == "4") { ?>selected<?php } ?>>Other Asset</option>
												<option value="5" <?php if ($mBalanceSheetType == "5") { ?>selected<?php } ?>>Liabilities</option>
												<option value="6" <?php if ($mBalanceSheetType == "6") { ?>selected<?php } ?>>Stock Holder's Equity</option>
												<option value="7" <?php if ($mBalanceSheetType == "7") { ?>selected<?php } ?>>Less: Withdrawals</option>
												</select>
                                            </td>
											<td colspan="2" class="detail1">
                                            	<input name="chkIncomeStatement" type="checkbox" value="<?php echo $mIncomeStatement ?>" <?php if ($mIncomeStatement=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="14" onKeyPress="javascript:EnterKey(14,event);" onKeyUp="javascript:return gf_Save(event);">
												Income Statement<BR>
                                                &nbsp;<select name="cboIncomeStatementType" class="detail1" tabindex="15" onKeyUp="javascript:return gf_Save(event);">
												<option value="0" <?php if ($mIncomeStatementType == "0") { ?>selected<?php } ?>>-Select Group-</option>
												<option value="1" <?php if ($mIncomeStatementType == "1") { ?>selected<?php } ?>>Sales Net</option>
																												   <option value="2" <?php if ($mIncomeStatementType == "2") { ?>selected<?php } ?>>Indirect Cost</option>
												<option value="3" <?php if ($mIncomeStatementType == "3") { ?>selected<?php } ?>>Cost of Services</option>
												<option value="4" <?php if ($mIncomeStatementType == "4") { ?>selected<?php } ?>>Income Tax</option>
												<option value="5" <?php if ($mIncomeStatementType == "5") { ?>selected<?php } ?>>Operating Expenses</option>
												<option value="6" <?php if ($mIncomeStatementType == "6") { ?>selected<?php } ?>>Other Income (Expense)</option>
												</select>													
											</td>
											<td colspan="2" class="detail1">
                                            	<input name="chkCashFlow" type="checkbox" value="<?php echo $mCashFlow ?>" <?php if ($mCashFlow=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="15" onKeyPress="javascript:EnterKey(15,event);" onKeyUp="javascript:return gf_Save(event);">
												Cash Flow Statement<BR>
                                                &nbsp;<select name="cboCashFlowType" class="detail1" tabindex="16" onKeyUp="javascript:return gf_Save(event);">
												<option value="0" <?php if ($mCashFlowType == "0") { ?>selected<?php } ?>>-Select Groups-</option>
												<option value="1" <?php if ($mCashFlowType == "1") { ?>selected<?php } ?>>Operations(IN)</option>
												<option value="2" <?php if ($mCashFlowType == "2") { ?>selected<?php } ?>>Operations(OUT)</option>
												<option value="3" <?php if ($mCashFlowType == "3") { ?>selected<?php } ?>>Investing Activities(IN)</option>
												<option value="4" <?php if ($mCashFlowType == "4") { ?>selected<?php } ?>>Investing Activities(OUT)</option>
												<option value="5" <?php if ($mCashFlowType == "5") { ?>selected<?php } ?>>Financing Activities(IN)</option>
												<option value="6" <?php if ($mCashFlowType == "6") { ?>selected<?php } ?>>Financing Activities(OUT)</option>
												</select>													
											</td>
											<td colspan="2" class="detail1">
                                            	<input name="chkmFinanceStatementPerVoyage" type="checkbox" value="<?php echo $mFinanceStatementPerVoyage ?>" <?php if ($mFinanceStatementPerVoyage=="1") { ?>checked<?php } ?> align="absbottom" class="detail1" tabindex="15" onKeyPress="javascript:EnterKey(15,event);" onKeyUp="javascript:return gf_Save(event);">
												Finance Statement Per Voyage<BR>
                                                &nbsp;<select name="cbomFinanceStatementPerVoyageType" class="detail1" tabindex="16" onKeyUp="javascript:return gf_Save(event);">
												<option value="0" <?php if ($mFinanceStatementPerVoyageType == "0") { ?>selected<?php } ?>>-Select Groups-</option>
												<option value="1" <?php if ($mFinanceStatementPerVoyageType == "1") { ?>selected<?php } ?>>Income</option>
												<option value="2" <?php if ($mFinanceStatementPerVoyageType == "2") { ?>selected<?php } ?>>Expense</option>
												</select>													
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
	if ($mOk == 1) 
		{
?>
			<script>
				alert('Successfully Save Record!');
				eval('document.frmFinancial.cmdNew.focus();');
			</script>
<?php
		}
	if ($mOk == 0) 
		{
?>
			<script>
				alert('Unable to Save Record!');
			</script>
<?php	
		}
?>
