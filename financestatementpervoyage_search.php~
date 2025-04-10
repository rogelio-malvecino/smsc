<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	date_default_timezone_set('Asia/Manila');
		
	include ("datasource.php");
	include ("function.php");	

	$mAccess = 1;//fp_Get_Record("Access_yn","tb_mUserRights", "UserID_cd = ''".$_SESSION['UserID']."'' AND FuncID_cd = ''ADMPOS''");

$mStatus = "";
?>
<html>
<head>
	<title>Finance Statement Per Voyage</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
	<script>

	</script>	
</head>
<body background="../images/background.JPG"> 
<form name="frmFinancial" action="financestatementpervoyage_search.php" method="post">
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
                                                        	<font size="+1">FINANCE STATEMENT PER VOYAGE (PRINT)</font>
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
                                            <td   class="detail1">Select Date (From)</td>
                                            <td class="detail1" >
 												<input type="text" id="Date1" maxlength="25" size="25" readonly="true" value="<?php echo $Date1 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date1');" style="cursor:pointer"/>
											</td>
										</tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td  class="detail1">Select Date (To)</td>
											<td class="detail1" >
												<input type="text" id="Date2" maxlength="25" size="25" readonly="true" value="<?php echo $Date2 ?>"/>
												<img src="images/cal.gif" onClick="javascript:NewCssCal('Date2');" style="cursor:pointer"/>
											</td>
										</tr>
  
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td  width="100" class="detail1">Voyage Ref.#</td>
											<td class="detail1">
												&nbsp;<input name="txtReferenceNo" id="txtReferenceNo" type="text" size="9" maxlength="15" value="<?php echo $mReferenceNo ?>" class="detail1" tabindex="4" onKeyUp="aGeneralJournal_SearchVoyageReference();" autocomplete="off">
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
												<div id="voyagereference"></div>

											</td>
										</tr>

  
  
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td  class="detail1">&nbsp;Select Status</td>
                                            <td class="detail1" >
                                                &nbsp;<select name="cboStatus" class="detail1">
                                                <option value="" <?php if ($mStatus=="") { ?>selected<?php } ?>>-Select Status-</option>
                                                <option value="0" <?php if ($mStatus=="0") { ?>selected<?php } ?>>Unposted</option>
                                                <option value="1" <?php if ($mStatus=="1") { ?>selected<?php } ?>>Posted</option>
                                                </select>													
                                            </td>
                                        </tr>

                                        <tr bgcolor="#FFFFFF">
                                        	<td colspan="3" align="center">
												<input type="button" name="cmdPrint" class="detail1" value="Print" onClick="javascript:FinanceStatementPerVoyage_Print('<?php echo $_SESSION['UserID'] ?>')" <?php if ($mAccess == '') { ?>disabled<?php } ?>>                   
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
