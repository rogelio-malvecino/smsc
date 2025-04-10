<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	
	include ("datasource.php");
	include ("function.php");	
	
	//Is_Logged_In();
	
	$mAccess1 = "1";//fp_Get_Record("Access_yn","tb_muserrights", "UserID_cd = ''".$_SESSION['UserID']."'' AND FuncID_cd = ''COANEW''");

	$mOk = -1;
	$mBranchNo = 0;
	$mAccountID = '';
	$mSubsidiaryID = '';
	$mSubsidiaryDesc  = '';



					
	if ($_REQUEST['Start'] == 2)
		{
			$mAccountID = $_REQUEST['AccountID'];
			$mSubsidiaryID = fp_Subsidiary_Auto_Number($_REQUEST['AccountID']);
			$mSubsidiaryDesc = $_REQUEST['SubsidiaryDesc'];
			
			include ("datasource.php");
			$mResult = $mysqli->query("Call sp_SubsidiaryAccount_Insert('".$_SESSION['S_UserID']."','"
																		  .$mAccountID."',"
																		  .(int)substr($mSubsidiaryID,5,4).",'"
																		  .$mSubsidiaryID."','"
																		  .$mSubsidiaryDesc."')");
			if ($mResult == 1)
				{
					//$_SESSION['SysMsg'] = 'Successfully Saved Record ('.$_POST['txtSubsidiaryDesc'].')';
					//include ('success.php');
					$mOk = 1;
				}
			else
				{
					include ('info.php');
					$mOk = 0;
				}
			mysqli_close($mysqli);


							

		}
?>
<html>
<head>
	<title>Add Subsidiary Account</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
	<script language="JavaScript" src="../global/Functions.js"></script>
	<script language="JavaScript">

	</script>
</head>
<body background="../images/background.JPG" onLoad="false; document.frmFinancial.cboAccountID.focus();"> 
<form name="frmFinancial" action="subsidiaryaccount_add.php">
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
                                                        	<font size="+1">SUBSIDIARY ACCOUNT (NEW)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                          	<input type="button" name="cmdNew" class="detail1" value="  Create New Record "  <?php if ($mAccess1 == '') { ?>disabled<?php } ?> onClick="javascript:aSubsidiaryAccount_Action(1);">
                                                            <input type="button" name="cmdSave" class="detail1" value="  [F8] - Save  "  <?php if ($mAccess1 == '' || $mOk == 1) { ?>disabled<?php } ?> onClick="javascript:aSubsidiaryAccount_Action(2);" tabindex="13">
                                                            <input type="button" name="cmdSearch" class="detail1" value="  Search/List Record(s)  " onClick="javascript:aSubsidiaryAccount_Action(3);">
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
                                            <td width="135" class="detail1">&nbsp;Account Title</td>
                                            <td class="detail1">
                                                &nbsp;<select name="cboAccountID" class="detail1" tabindex="1" onKeyPress="javascript:aSubsidiaryAccount_EnterKey(1,event);" onKeyUp="javascript:return gf_Save(event);">
<?php
												include ("datasource.php");
												$mResult = $mysqli->query("Call sp_ControlAccountSubsidiary_Select()");
		
												if (mysqli_num_rows($mResult) > 0)
													{
														while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
															{ 
?>
                                                                <option value="<?php echo $ado["AccountID_cd"] ?>" <?php if ($mAccountID == $ado["AccountID_cd"]) { ?>selected<?php } ?>><?php echo $ado["AccountDesc_tx"] ?></option>
<?php
															}
													}
												mysqli_close($mysqli);
?>
                                                </select>				
                                                <input type="hidden" name="hidBranchNo" value="<?php echo $mBranchNo ?>">							
                                            </td>
                                        </tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="135" class="detail1">&nbsp;Subsidiary Description</td>
									  		<td class="detail1">
												&nbsp;<input name="txtSubsidiaryDesc" type="text" size="80" maxlength="80" value="<?php echo $mSubsidiaryDesc ?>"  class="detail1" tabindex="2" onKeyPress="javascript:EnterKey(2,event);" onKeyUp="javascript:return gf_Save(event);">
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
										  	</td>
                                        </tr>    
 
                                        <tr bgcolor="#FFFFFF">
                                            <td height="20" colspan="2" align="right" valign="middle" class="detail1">						
                                                <a href="#top" class="detail1"><u>Top</u></a>
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
