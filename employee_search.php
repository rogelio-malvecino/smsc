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
                                                        	<font size="+1">EMPLOYEE (LISTING)</font>
                                                        </td>
													</tr>
													<tr>
														<td colspan="4" align="center" nowrap class="title1">
                                                                                                                    <a href="employee_create.php" class="makeFancy"><input type="button" name="cmdNew" class="detail1" value="  Create New Record "></a>
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
                                            <td colspan="2" class="detail1">&nbsp;Enter Employee Code&nbsp;</td>
                                            <td width="82%" class="detail1">
                                                <input type="text"  id="employeeCode" maxlength="20" size="15" class="detail1" onfocus="javascript:autoComplete('#employeeCode','employeeAutoSearch.php?id=employeeCode')">
                                            </td>
                                      	</tr>
                                        <tr bgcolor="#EBEBEB" onMouseOver="this.style.backgroundColor='#FFFFFF'" onMouseOut="this.style.backgroundColor=''">
                                            <td colspan="2" class="detail1">&nbsp;Enter Firstname Name&nbsp;</td>
                                            <td class="detail1">
                                                <input type="text" id="employeeFirstName" maxlength="80" size="30" class="detail1" onfocus="javascript:autoComplete('#employeeFirstName','employeeAutoSearch.php?id=employeeFirstName')" autocomplete="off"><BR>
                                            	<div id="controlname"></div>
                                          </td>
                                        </tr>
                                        <tr valign="top">
                                            <td colspan="5" align="center" bgcolor="#EBEBEB">
                                                <input type="button" name="cmdSearch" class="detail1" value="Search" onclick="javascript:searchContent('employee_ajax.php?code='+document.getElementById('employeeCode').value+'&name='+document.getElementById('employeeFirstName').value)">
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
