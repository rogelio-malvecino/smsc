<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	
	include ("datasource.php");
	include ("function.php");	

	//Is_Logged_In();
	
	$mAccess1 = "1";//fp_Get_Record("Access_yn","tb_muserrights", "UserID_cd = ''".$_SESSION['UserID']."'' AND FuncID_cd = ''COANEW''");
?>
<html>
<head>
	<title>Subsidiary Account Masterfile</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
    <script language="JavaScript" src="../global/Functions.js"></script>
	<script>
	onerror=handleErr;

	function handleErr(msg,url,l)
		{
			return true;
		}
	</script>	
</head>
<body background="../images/background.JPG"> 
<form name="frmFinancial" action="subsidiaryaccount_search.php" method="post">
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
                                                        	<font size="+1">SUBSIDIARY ACCOUNT (LISTING)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                          	<input type="button" name="cmdNew" class="detail1" value="  Create New Record "  <?php if ($mAccess1 == '') { ?>disabled<?php } ?> onClick="javascript:SubsidiaryAccount_Action(1);">
                                                            <input type="button" name="cmdSearch" class="detail1" value="  Search/List Record(s)  " onClick="javascript:SubsidiaryAccount_Action(2);">
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
                                            <td colspan="2" class="detail1">&nbsp;Select Account Title&nbsp;</td>
                                            <td width="75%" class="detail1">
                                                <select name="cboAccountID" class="detail1">
                                                <option value="">-Select Account Title-</option>
<?php
                                                include ("datasource.php");
                                                $mResult = $mysqli->query("Call sp_ControlAccount_Select()");

                                                if (mysqli_num_rows($mResult) > 0)
                                                    {
                                                        while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
                                                            { 
?>
                                                                <option value="<?php echo $ado["AccountID_cd"] ?>"><?php echo strtoupper(substr($ado["AccountDesc_tx"],0,50)) ?></option>
<?php
                                                            }
                                                    }
                                                mysqli_close($mysqli);
?>
                                                </select>											
                                            </td>
                                        </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Enter Subsidiary Code&nbsp;</td>
                                            <td colspan="2" class="detail1">
                                                <input type="text" name="txtSubsidiaryID" maxlength="15" size="20" class="detail1">
                                            </td>
                                        </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Enter Subsidiary Description&nbsp;</td>
                                            <td colspan="2" class="detail1">
                                                <input type="text" name="txtSubsidiaryDesc" maxlength="80" size="80" class="detail1" onKeyUp="SearchSubsidiaryName();" autocomplete="off"><BR>
                                            	<div id="subidiaryname"></div>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <td colspan="4" align="center" bgcolor="#EBEBEB">
                                                <input type="button" name="cmdSearch" class="detail1" value="Search" onClick="javascript:SubsidiaryAccount_Search();">
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
