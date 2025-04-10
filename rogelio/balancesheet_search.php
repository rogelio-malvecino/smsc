<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	date_default_timezone_set('Asia/Manila');
		
	include ("datasource.php");
	include ("function.php");	


	$mAccess = 1;//fp_Get_Record("Access_yn","tb_mUserRights", "UserID_cd = ''".$_SESSION['UserID']."'' AND FuncID_cd = ''ADMPOS''");

	$mMonth1 = date("n") + 1;
	$mYear1 = date("Y");
	$mStatus="";
?>
<html>
<head>
	<title>Balance Sheet</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
	<script>

	</script>	
</head>
<body background="../images/background.JPG"> 
<form name="frmFinancial" action="balancesheet_search.php" method="post">
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
                                                        	<font size="+1">BALANCE SHEET (PRINT)</font>
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
                                          	<td width="10%" class="detail1">&nbsp;Select Month</td>
                               		  		<td width="90%" class="detail1">
                                                &nbsp;<select name="cboMonth1" class="detail1">
<?php
												for ($iMonth1 = 2; $iMonth1 <= 13; $iMonth1++)
													{ 
?>
                                                        <option value="<?php echo $iMonth1 ?>" <?php if ($iMonth1 == $mMonth1) { ?>selected<?php } ?>><?php echo date("F",mktime(0,0,0,$iMonth1,0,0)) ?></option>
<?php
													}
?>
                                                </select>
											</td>
                                      	</tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td width="10%" class="detail1">&nbsp;Select Year</td>
                                            <td width="90%" class="detail1">
                                                &nbsp;<select name="cboYear1" class="detail1">
<?php
												for ($iYear1 = 2000; $iYear1 <= 2020; $iYear1++)
													{ 
?>
                                                        <option value="<?php echo $iYear1 ?>" <?php if ($iYear1 == $mYear1) { ?>selected<?php } ?>><?php echo $iYear1 ?></option>
<?php
													}
?>
                                                </select>
                                        	</td>
                                      	</tr>

										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td  class="detail1">&nbsp;Select Status</td>
                                            <td class="detail1" colspan="5">
                                                &nbsp;<select name="cboStatus" class="detail1">
                                                <option value="" <?php if ($mStatus=="") { ?>selected<?php } ?>>-Select Status-</option>
                                                <option value="0" <?php if ($mStatus=="0") { ?>selected<?php } ?>>Unposted</option>
                                                <option value="1" <?php if ($mStatus=="1") { ?>selected<?php } ?>>Posted</option>
                                                </select>													
                                            </td>
                                        </tr>

                                        <tr bgcolor="#FFFFFF">
                                        	<td colspan="2" align="center">
												<input type="button" name="cmdPrint" class="detail1" value="Print" onClick="javascript:BalanceSheet_Print('<?php echo $_SESSION['S_UserID'] ?>')" <?php if ($mAccess == '') { ?>disabled<?php } ?>>                   
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
