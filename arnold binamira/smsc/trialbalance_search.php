<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	//date_default_timezone_set('Asia/Manila');

	include ("datasource.php");
	include ("function.php");	

	$mMonth1 = '01';
	$mDay1 ='01';
	$mYear1 = date("Y");
	$mDate1 = $mYear1."-".$mMonth1."-".$mDay1; 
	$mDate2 = date("Y-m-d"); 
	$mStartDate = '';
	$mEndDate = '';
	$mStatus ="";	
?>
<html>
<head>
	<title>Trial Balance</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
	<script language="JavaScript" src="../global/Functions.js"></script>
	<script>
	</script>	
</head>
<body background="../images/background.JPG"> 
<form name="frmLedger" action="trialbalance_search.php" method="post">
<table width="790" border="0" cellspacing="0" cellpadding="0" align="center">
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
                                                        	<font size="+1">TRIAL BALANCE</font>
                                                        </td>
													</tr>
											  </table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr bgcolor="#FFFFFF">
								<td height="1"></td>
							</tr>
							<tr>
								<td>
									<table width="100%" border="0" cellspacing="0" cellpadding="1" bordercolor="#FFFFFF">
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Select Control Account&nbsp;</td>
                                            <td width="82%" colspan="2" class="detail1">
                                                &nbsp;<select name="cboAccountID" class="detail1">
                                                <option value="">-Select Control Account-</option>
<?php
                                                include ("datasource.php");
                                                $mResult = $mysqli->query("Call sp_ControlAccount_Select()");

                                                if (mysqli_num_rows($mResult) > 0)
                                                    {
                                                        while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
                                                            { 
?>
                                                                <option value="<?php echo $ado["AccountID_cd"] ?>"><?php echo strtoupper($ado["AccountDesc_tx"]) ?></option>
<?php
                                                            }
                                                    }
                                                mysqli_close($mysqli);
?>
                                                </select>														
                                            </td>
                                      	</tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Select Accounting Book&nbsp;</td>
                                            <td colspan="2" class="detail1">
                                                 &nbsp;<select name="cboJournal" class="detail1">
                                                <option value="0">-Select Accounting Book-</option>
                                                <option value="1">Cash Receipts</option>
                                                <option value="2">Purchases</option>
                                                <option value="3">Cash Sales</option>
                                                <option value="4">Charge Sales</option>
                                                <option value="5">Check Disbursement</option>
                                                <option value="6">General Journal</option>
                                                </select>			
                                            </td>
                                        </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Select Tansaction Date</td>
                                            <td class="detail1" colspan="2">
												<input type="text" id="Date1" maxlength="25" size="25" readonly="true" value="<?php echo $mDate1 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date1');" style="cursor:pointer"/>
                                            </td>
                                        </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Select Transaction Date</td>
                                            <td class="detail1" colspan="2">
												<input type="text" id="Date2" maxlength="25" size="25" readonly="true" value="<?php echo $mDate2 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date2');" style="cursor:pointer"/>
                                            </td>
                                        </tr>
					<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Select Post Status</td>
                                            <td class="detail1" colspan="5">
                                                &nbsp;<select name="cboStatus" class="detail1">
                                                <option value="" <?php if ($mStatus=="") { ?>selected<?php } ?>>-Select Post Status-</option>
                                                <option value="0" <?php if ($mStatus=="0") { ?>selected<?php } ?>>Unposted</option>
                                                <option value="1" <?php if ($mStatus=="1") { ?>selected<?php } ?>>Posted</option>
                                                </select>													
                                            </td>
                                        </tr>

<!--
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Show w/ Subsidiary?&nbsp;</td>
                                            <td colspan="2" class="detail1">
                                                <input name="chkSubsidiary" type="checkbox" value="1" checked>			
                                            </td>
                                        </tr>
-->
                                        <tr valign="top" bgcolor="#EBEBEB">
                                            <td colspan="4" align="center">
                                                <input type="button" name="cmdSearch" class="detail1" value="Search" onClick="javascript:TrialBalance_Search();" tabindex="1">
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
