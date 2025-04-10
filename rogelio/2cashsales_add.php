<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	include ("datasource.php");
	include ("function.php");	

	$mAccess1 = fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''SEARCH'' AND SubMenuCode =''cashsales''"); // SEARCH
	$mAccess2 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''ADD'' AND SubMenuCode =''cashsales''"); //add
	$mAccess3 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''SAVE'' AND SubMenuCode =''cashsales''");//save
	$mAccess4 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''EDIT'' AND SubMenuCode =''cashsales''");;//edit
	$mAccess5 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''DELETE'' AND SubMenuCode =''cashsales''");//delete
	$mAccess6 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''POST'' AND SubMenuCode =''cashsales''");//post
	$mAccess7 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''PRINT'' AND SubMenuCode =''cashsales''");//print
	$mAccess8 =fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''ADMIN'' AND SubMenuCode =''cashsales''");//admin
	
	$mOk = -1;
	
	$mControlNo = '';
	$mControlNo_ = '';
	$mDate1 = date("Y-m-d"); 
	$mReferenceNo = '';
	$mAmount = 0;
	$mParticular = '';
	$mRec = 0;
	$mData = '';

	$mCRDate = '';

	$mAccount = '';
	$mAccountID = '';
	$mSubsidiaryID = '';
	$mAccountDesc = '';
	$mDebit = 0;
	$mCredit = 0;
	$mTotalDebit = 0;
	$mTotalCredit = 0;
	$mCallSave="F";


	if ($_REQUEST['Start'] == 1)
		{					
			$mControlNo = fp_Auto_FinancialNumber("CSID_cd","tb_tcashsaleshdr","1=1");
			$mControlNo_ = $mControlNo;
		}
		
	if ($_REQUEST['Start'] == 2)
		{															
			$mControlNo = $_REQUEST['ControlNo'];
			$mControlNo_ = $_REQUEST['ControlNo'];
			$mDate1 = $_REQUEST['Date1'];
			$mReferenceNo = $_REQUEST['ReferenceNo'];
			$mAmount = $_REQUEST['Amount'];
			$mParticular = $_REQUEST['Particular'];
			$mRec = $_REQUEST['Rec'];
			$mData = $_SESSION['myData'];//$_REQUEST['Data'];

			include ("datasource.php");
			$mResult = $mysqli->query("Call sp_CashSales_Verify('_','".$_REQUEST['ControlNo']."')");
			if (mysqli_num_rows($mResult) > 0)
				{
					mysqli_close($mysqli);
					$mControlNo = fp_Auto_FinancialNumber("CSID_cd","tb_tcashsaleshdr","1=1");
					$mCallSave = "T";					
				}
			else
				{

					mysqli_close($mysqli);
					include ("datasource.php");					

					$mControlNo = fp_Auto_FinancialNumber("CSID_cd","tb_tcashsaleshdr","1=1");
					$mControlNo_ = $mControlNo;

					$mCSDate = $mDate1;//$mYear1.'-'.((int)$mMonth1-1).'-'.$mDay1;

					$mKey = $_SESSION['S_UserID'].'!'.
						$_SESSION['S_IPID'].'!'.
						$mControlNo.'!'.
						$mCSDate.'!'.
						$mReferenceNo.'!'.
						$mAmount.'!'.
						$mParticular.'!'.
						$mData.'!';

					include ("datasource.php");					
					$mResult = $mysqli->query("Call sp_CashSalesHDR_Insert('".$_SESSION['S_UserID']."','"
																	 .$mControlNo."','"
																	 .$mCSDate."','"
																	 .$mReferenceNo."',"
																	 .$mAmount.",'"
																	 .addslashes($mParticular)."','"
																	 .md5_encrypt($mKey,'baseline')."')");
					if ($mResult == 1)
						{							
							$mDetail = fp_Add_FinancialDetail("tb_tcashsalesdtl",$_REQUEST['ControlNo'],$mRec,$mData);
							//update the header amount field 
							$mResult = $mysqli->query("Call sp_CashSalesHDR_Update_('".$_REQUEST['ControlNo']."')");
							$mOk = 1;
		
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
	<title>Add Cash Sales</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
	<script language="JavaScript" src="../global/Functions.js"></script>

</head>
<body background="../images/background.JPG" onLoad="document.frmFinancial.cboMonth1.focus(); aCashSales_LoadAccount();"> 
<form name="frmFinancial" action="cashsales_add.php" method="post">
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
                                                        	<font size="+1">CASH SALES (NEW)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                          	<input type="button" name="cmdNew" class="detail1" value="  Create New Record "  <?php if ($mAccess2 == '') { ?>disabled<?php } ?> onClick="javascript:aCashSales_Action(1);">
                                                            <input type='button' name='cmdDelete' class='detail1' value='Delete Account(s)' <?php if ($mAccess5 == '') { ?>disabled<?php } ?> onClick='javascript:aCashSales_DeleteAccount();' tabindex="0">
                                                            <input type="button" name="cmdSave" class="detail1" value="  [F8] - Save  "  <?php if ($mAccess3 == '' || $mOk == 1) { ?>disabled<?php } ?> onClick="javascript:aCashSales_Action(2);">
                                                            <input type="button" name="cmdSearch" class="detail1" value="  Search/List Record(s)  " onClick="javascript:aCashSales_Action(3);">
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
											<td width="13%" class="detail1">&nbsp;CS#</td>
											<td width="87%" class="detail1">
												&nbsp;<font color="#FF0000" size="+1"><?php echo $mControlNo ?></font>
                                                <input name="txtControlNo" id="txtControlNo" type="hidden" size="9" maxlength="15" value="<?php echo $mControlNo ?>" class="detail13" tabindex="1">
                                        	    <input name="hidRec" type="hidden" value="<?php echo $mRec ?>" size="2">
												<input name="hidData" type="hidden" value="<?php echo $mData ?>" size="50">
                                            </td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td class="detail1">&nbsp;CS Date</td>
											<td class="detail1" colspan="2">
												<input type="text" id="Date1" maxlength="25" size="25" readonly="true" value="<?php echo $mDate1 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date1');" style="cursor:pointer"/>
											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;Voyage Ref.#&nbsp;</td>
											<td colspan="2" class="detail1">
												&nbsp;<input name="txtReferenceNo" id="txtReferenceNo" type="text" size="9" maxlength="15" value="<?php echo $mReferenceNo ?>" class="detail1" tabindex="4" onKeyUp="aCashSales_SearchVoyageReference();" autocomplete="off">
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
												<div id="voyagereference"></div>

											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="100" class="detail1">&nbsp;CS Amount</td>
											<td colspan="2" class="detail1">
												&nbsp;<input type="text" name="txtAmount" value="<?php echo $mAmount; ?>" class="detail1" size="9" maxlength="13" dir="rtl" tabindex="5" onKeyPress="javascript:aCashSales_EnterKey(5,event);">												
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
															<input type="text" name="txtAccountID" id="txtAccountID" size="5" maxlength="5" class="detail13" tabindex="7" onKeyPress="javascript:aCashSales_EnterAccountID(event);">
														</td>
                                                    </tr>
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Account Title:
                                                        </td>
														<td width="87%" align="left" class="title5">
                                                            <select name="cboAccountID" class="detail1" tabindex="8" onChange="javascript:aCashSales_SearchAccount_();" onKeyPress="javascript:aCashSales_EnterAccountID_(event);">
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
                                                            <select name="cboSubsidiaryID" class="detail1" onKeyPress="javascript:aCashSales_EnterSubsidiaryID(event);" tabindex="9">
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
                                                            <input type="text" Name="txtDebit" id="txtDebit" size="10" value="0.00" class="detail13" dir="rtl" onKeyPress="javascript:aCashSales_EnterSave(event);" tabindex="10">
														</td>
                                                    <tr>
														<td width="13%" align="left" class="title5">
															Credit:
                                                        </td>
														<td width="87%" align="left" class="title5">
                                                            <input type="text" Name="txtCredit" id="txtCredit" size="10" value="0.00" class="detail13" dir="rtl" onKeyPress="javascript:aCashSales_EnterSave(event);" tabindex="11">
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
	if ($mCallSave=="T")
		{
?>
		<script>
		aCashSales_AutoSave();
		</script>
<?php
		}
?>
