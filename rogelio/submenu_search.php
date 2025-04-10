<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
?>

<html>
<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
<body>
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
                                                        	<font size="+1">SUBMENU (LISTING)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                                                                                    <a href="submenu_create.php" class="makeFancy"><input type="button" name="cmdNew" class="detail1" value="  Create New Record "  <?php if ($mAccess1 == '') { ?>disabled<?php } ?>></a>
                                                                                                                    <input type="button" name="cmdSearch" class="detail1" value="  Search/List Record(s)  " onClick="javascript:ControlAccount_Action(2);">
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
                                            <td class="detail1">
                                             </td>
                                        </tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Enter Submenu Code&nbsp;</td>
                                            <td width="82%" class="detail1">
                                                <input type="text"  id="submenuCode" maxlength="20" size="25" class="detail1" onfocus="javascript:autoComplete('#submenuCode','submenuAutoSearch.php?id=submenuCode')">
                                            </td>
                                      	</tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Enter Submenu Name&nbsp;</td>
                                            <td class="detail1">
                                                <input type="text" id="submenuName" maxlength="80" size="80" class="detail1" onfocus="javascript:autoComplete('#submenuName','submenuAutoSearch.php?id=submenuName')"><BR>
                                            	<div id="controlname"></div>
                                          </td>
                                        </tr>
                                        <tr valign="top">
                                            <td colspan="5" align="center" bgcolor="#EBEBEB">
                                                <input type="button" name="cmdSearch" class="detail1" value="Search" onClick="javascript:searchContent('submenu_ajax.php?code='+document.getElementById('submenuCode').value+'&name='+document.getElementById('submenuName').value)">
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
</html>

