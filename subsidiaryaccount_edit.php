<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();

	include ("datasource.php");
	include ("function.php");	

	
	$mAccess = "1"; //fp_Get_Record("Access_yn","tb_muserrights", "UserID_cd = ''".$_SESSION['UserID']."'' AND FuncID_cd = ''COAEDIT''");

	$mOk = 0;
	$mAccountID = '';
	$mSubsidiaryID = '';
	$mSubsidiaryDesc  = '';

	if ($_REQUEST['Start'] == 1)
		{
			$mResult = $mysqli->query("Call sp_SubsidiaryAccount_RecSelect('".$_REQUEST['ID']."')");

			if (mysqli_num_rows($mResult) > 0)
				{
					$ado = $mResult->fetch_array(MYSQLI_BOTH);
			
					$mAccountID = $ado['AccountID_cd'];
					$mSubsidiaryID = $ado['SubsidiaryID_cd'];
					$mSubsidiaryDesc = $ado['SubsidiaryDesc_tx'];
				}
			mysqli_close($mysqli);			



			/*include ("datasource.php");
			$mResult = $mysqli->query("Call sp_Branch_Select()");
				
			$b = 0;
			if (mysqli_num_rows($mResult) > 0)
				{
					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{ 
							$b = $b + 1;
							$mBranch[$b] = fp_Get_Record("FuncID_cd","tb_mcoadtlrights", "SubsidiaryID_cd = ''".$mSubsidiaryID."'' AND FuncID_cd = ''".substr($ado['BranchID_cd'],6,7)."''");
						}
				}
			mysqli_close($mysqli);	
			*/		
		}
	
	if ($_REQUEST['Start'] == 2)
		{
			if ($_REQUEST['Start']==2)
				{
					$mResult = $mysqli->query("Call sp_SubsidiaryAccount_Verify('".$_POST['hidAccountID']."','".$_POST['hidSubsidiaryID']."','".$_POST['txtSubsidiaryDesc']."')");

					if (mysqli_num_rows($mResult) > 0)
						{
							$_SESSION['SysMsg'] = 'Unable to Saved Record, ('.$_POST['txtSubsidiaryDesc'].') Already Exist!';
							include ('failed.php');
							mysqli_close($mysqli);
						}
					else
						{
							mysqli_close($mysqli);
							include ("datasource.php");
							
							$mResult = $mysqli->query("Call sp_SubsidiaryAccount_Update('".$_SESSION['S_UserID']."','"
																						  .$_POST['hidSubsidiaryID']."','"
																						  .$_POST['txtSubsidiaryDesc']."')");
							if ($mResult == 1)
								{
									//$_SESSION['SysMsg'] = 'Successfully Saved Record ('.$_POST['txtSubsidiaryDesc'].')';
									//include ('success.php');
									echo $_SESSION['S_MenuLocation']." Successfully Save!";
									$mOk=1;
								}
							else
								{
									include ('info.php');
								}
							mysqli_close($mysqli);




						}

					$mAccountID = $_POST['hidAccountID'];
					$mSubsidiaryID = $_POST['hidSubsidiaryID'];
					$mSubsidiaryDesc = $_POST['txtSubsidiaryDesc'];
				}
		}
?>
<html>
<head>
	<title>Update Control Account Group</title>
	<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
<!--	<style type="text/css" media="screen">
		#search_groupaccountno
			{
				position: absolute; 
				background-color: #EBEBEB; 
				color:#FF0000; font:bolder;
				font-size: 20px;
				text-align: left; 
				border: 2px #EBEBEB;		
			}		
	</style>
	<script language="JavaScript" src="../global/Functions.js"></script>
	<script language="JavaScript">

	</script>
-->	
</head>
<body background="../images/background.JPG" onLoad="false; document.frmCOA.txtSubsidiaryDesc.focus();"> 
<form name="frmCOA"  action="subsidiaryaccount_edit.php" method="post">
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
														<td colspan="2" class="title1">&nbsp;Subsidiary Account (UPDATE)</td>
														<td width="572" colspan="2" align="right" nowrap class="title1">
															&nbsp;<select name="cboModule" class="detail1" onChange="javascript:Module();">
															<option value="">Select Menu</option>
															<option value="subsidiaryaccount_add.php?Start=1">New Subsidiary Account</option>
															<option value="subsidiaryaccount_search.php?Start=1&AccountID=&SubsidiaryID=&SubsidiaryDesc=">Search</option>
															</select>											    
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
                                            <td width="107" class="detail1">&nbsp;Subsidiary Code&nbsp;</td>
                                            <td width="651" class="detail13">
                                                &nbsp;<?php echo $mSubsidiaryID ?>
                                            	<input name="hidAccountID" type="hidden" value="<?php echo $mAccountID ?>">
                                            	<input name="hidSubsidiaryID" type="hidden" value="<?php echo $mSubsidiaryID ?>">
                                            </td>
                                        </tr>
										<tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
											<td width="150" class="detail1">&nbsp;Name</td>
											<td class="detail1">
												&nbsp;<input name="txtSubsidiaryDesc" type="text" size="80" maxlength="80" value="<?php echo $mSubsidiaryDesc ?>"  class="detail1">
                                                &nbsp;<font color="#FF0000" size="+1">*</font>
										  	</td>
										</tr>
										<tr valign="top">
											<td colspan="2" align="center" class="title2">
												&nbsp;<input type="button" name="cmdSave" class="detail1" value="Save" <?php if ($mAccess == '' || $mOk == '1') { ?>disabled<?php } ?>  onClick="javascript:eSubsidiaryAccount_Action(2);">
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
