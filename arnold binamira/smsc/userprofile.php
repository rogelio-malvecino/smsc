<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
$name=$_GET['name'];
$query=$mysqli->query("CALL spusersQuery('$name')");
$row=$query->fetch_array(MYSQLI_BOTH);

?>

<html>
<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
<body>
<input type="hidden" value="<?php echo $name ?>" id="myId">
<input type="hidden" value="<?php echo $row[2] ?>" id="myPassword">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td valign="top" align="center" background="/images/bg_left.gif" bordercolor="#FFFFFF">

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
                                                        	<font size="+1">USER PROFILE</font>
                                                        </td>
													</tr>
													 <tr valign="top">
                                                                                                            <td colspan="5" align="center" bgcolor="#EBEBEB">
                                                                                                               <input type="button" name="cmdSave" class="cmdChange" value="Change" onClick="javascript:changePassword();">
                                                                                                               <input type="button" name="cmdSave" class="cmdSave" value="Save" onClick="javascript:updatePassword();" style="display: none">

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
                                            <td colspan="2" class="detail1">&nbsp;Username&nbsp;</td>
                                            <td width="82%" class="detail1">
                                                <input type="text" name="txtAccountID" id="myUsername"  class="detail1" value="<?php echo $row[1]; ?>" disabled="1">
                                            </td>
                                      	</tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" class="change_">
                                            <td colspan="2" class="detail1">&nbsp;Password&nbsp;</td>
                                            <td class="detail1">
                                                <input type="password" name="txtAccountDesc" maxlength="80" class="detail1" onKeyUp="SearchControlName();" value="<?php echo $row[2]; ?>" disabled="1"><BR>
                                            	<div id="controlname"></div>
                                          </td>
                                        </tr>

                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" class="change" style="display: none">
                                            <td colspan="2" class="detail1">&nbsp;Enter Old Password:&nbsp;</td>
                                            <td class="detail1">
                                                <input type="password" name="txtAccountDesc" maxlength="80" id="oldPassword"><BR>
                                            	<div id="controlname"></div>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" class="change" style="display: none">
                                            <td colspan="2" class="detail1">&nbsp;Enter New Password:&nbsp;</td>
                                            <td class="detail1">
                                                <input type="password" name="txtAccountDesc" maxlength="80" id="newPassword" onKeyUp="SearchControlName();" ><BR>
                                            	<div id="controlname"></div>
                                          </td>
                                        </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''" class="change" style="display: none">
                                            <td colspan="2" class="detail1">&nbsp;Verify Password:&nbsp;</td>
                                            <td class="detail1">
                                                <input type="password" name="txtAccountDesc" maxlength="80" id="verifyNewPassword" onKeyUp="SearchControlName();" ><BR>
                                            	<div id="controlname"></div>
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
</body>
</head>
</body>