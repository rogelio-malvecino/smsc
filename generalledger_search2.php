<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	date_default_timezone_set('Asia/Manila');
	
		
	include ("datasource.php");
	include ("function.php");	

	$mAccountID = $_REQUEST["ControlAccount"];
	$mSubsidiaryID = $_REQUEST["SubsidiaryID"];
	//echo "echoing".$_REQUEST['SubsidiaryID'].$_REQUEST["ControlAccount"];
	$mJournal = $_REQUEST["Journal"];

	if ($_REQUEST["Start"]=='0')
		{
			$mMonth1 = date("n") + 1;
			$mDay1 = "1";
			$mYear1 = date("Y");
			$mMonth2 = date("n") + 1;
			$mDay2 = date("d");
			$mYear2 = date("Y");
			$mStatus = '';
		}
	else
		{
			$mAccountID = $_REQUEST["ControlAccount"];
			$mSubsidiaryID = $_REQUEST["SubsidiaryID"];
			$mJournal = $_REQUEST["Journal"];
			$mMonth1 = $_REQUEST["Month1"];
			$mDay1 = $_REQUEST["Day1"];
			$mYear1 = $_REQUEST["Year1"];
			$mMonth2 = $_REQUEST["Month2"];
			$mDay2 = $_REQUEST["Day2"];
			$mYear2 = $_REQUEST["Year2"];
			$mStatus = $_REQUEST["Status"];
			if (strlen($_REQUEST["Month1"])==1)
			{
			$mMonth1 = "0".$_REQUEST["Month1"];
			}
			else
			{
			$mMonth1 = $_REQUEST["Month1"];
			}
			if (strlen($_REQUEST["Day1"])==1)
			{
			$mDay1 = "0".$_REQUEST["Day1"];
			}
			else
			{
			$mDay1 = $_REQUEST["Day1"];
			}
			
			if (strlen($_REQUEST["Month2"])==1)
			{
			$mMonth2 = "0".$_REQUEST["Month2"];
			}
			else
			{
			$mMonth2 = $_REQUEST["Month2"];
			}
			if (strlen($_REQUEST["Day2"])==1)
			{
			$mDay2 = "0".$_REQUEST["Day2"];
			}
			else
			{
			$mDay2 = $_REQUEST["Day2"];
			}
			$mDate1 = $_REQUEST["Year1"]."-".$mMonth1."-".$mDay1;
			$mDate2 =  $_REQUEST["Year2"]."-".$mMonth2."-".$mDay2;
			
		}
		
	$mStartDate = '';
	$mEndDate = '';
	$mTitle1 = '';
	$mTitle2 = '';

?>
<html>
<head>
	<title>General Ledger</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
	<script language="JavaScript" src="../global/Functions.js"></script>
	
</head>
<body background="../images/background.JPG" > 
<form name="frmLedger" action="generalledger_search2.php" method="post">
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
                                                        	<font size="+1">GENERAL LEDGER</font>
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
                                            <td colspan="2" class="detail1">&nbsp;Select Control Account&nbsp;</td>
                                            <td width="82%" colspan="5" class="detail1">
                                                &nbsp;<select name="cboAccountID" class="detail1" onChange="javascript:GeneralLedger2_LoadSubsidiary();">
                                                <option value="">-Select Control Account-</option>
<?php
                                                include ("datasource.php");
                                                $mResult = $mysqli->query("Call sp_ControlAccount_Select()");

                                                if (mysqli_num_rows($mResult) > 0)
                                                    {
                                                        while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
                                                            { 
?>
                                                                <option value="<?php echo $ado["AccountID_cd"] ?>" <?php if ($_REQUEST['ControlAccount']==$ado["AccountID_cd"]) { ?>selected<?php } ?>><?php echo strtoupper($ado["AccountDesc_tx"]) ?></option>
<?php
                                                            }
                                                    }
                                                mysqli_close($mysqli);
?>
                                                </select>														
                                            </td>
                                      </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Select Subsidiary&nbsp;</td>
                                            <td colspan="5" class="detail1">
                                                &nbsp;<select name="cboSubsidiaryID" class="detail1" tabindex="1000">
                                                <option value="">-Select Subsidiary Description-</option>
<?php
                                                include ("datasource.php");
                                                $mResult = $mysqli->query("Call sp_SubsidiaryAccount_Select('".$_REQUEST["ControlAccount"]."')");

                                                if (mysqli_num_rows($mResult) > 0)
                                                    {
                                                        while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
                                                            { 
?>
                                                                <option value="<?php echo $ado["SubsidiaryID_cd"] ?>" <?php if ($_REQUEST['SubsidiaryID']==$ado["SubsidiaryID_cd"]) { ?>selected<?php } ?>><?php echo strtoupper($ado["SubsidiaryDesc_tx"]) ?></option>
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
                                            <td colspan="5" class="detail1">
                                                &nbsp;<select name="cboJournal" class="detail1">
                                                <option value="0" <?php if ($mJournal=='0') { ?>selected<?php } ?>>-Select Accounting Book-</option>
                                                <option value="1" <?php if ($mJournal=='1') { ?>selected<?php } ?>>Cash Receipts</option>
                                                <option value="2" <?php if ($mJournal=='2') { ?>selected<?php } ?>>Purchases</option>
                                                <option value="3" <?php if ($mJournal=='3') { ?>selected<?php } ?>>Cash Sales</option>
                                                <option value="4" <?php if ($mJournal=='4') { ?>selected<?php } ?>>Charge Sales</option>
                                                <option value="5" <?php if ($mJournal=='5') { ?>selected<?php } ?>>Check Disbursement</option>
                                                <option value="6" <?php if ($mJournal=='6') { ?>selected<?php } ?>>General Journal</option>
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
                                            <td colspan="2" class="detail1">&nbsp;Select Tansaction Date</td>
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

                                        <tr valign="top" bgcolor="#FFFFFF">
                                            <td colspan="7" align="center">
                                                &nbsp;<input type="button" name="cmdSearch" class="detail1" value="Search" onClick="javascript:GeneralLedger2_Search(<?php echo $mAccountID ?>,<?php echo $mSubsidiaryID ?>);" tabindex="1">
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
			