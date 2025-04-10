<?php
	session_start();
	include ("Functioneverwing.php");
	Is_Logged_In();
	
	if ($_GET["Start"]=='1')
		{
			if ($_GET['Rec'] > 0)
				{
					$mData = explode("*", $_REQUEST['Data']);
					$i = 1;
					$mDesc = '';
					
					while ($i <= $_REQUEST['Rec'])
						{ 						
							list($mSubsidiaryID, $mSubsidiaryName) = split('!', $mData[$i-1]);
							
							$mDesc = "Deleted Data: ";
							$mDesc = $mDesc."Subsidiary ID: ".$mSubsidiaryID." - ".$mSubsidiaryName." ";

							include ("datasource.php");
							$mResult = $mysqli->query("Call sp_SubsidiaryAccount_Delete('".$_SESSION['UserID']."',"
																				          .$_SESSION['CenterID'].",'"
																				          .$mSubsidiaryID."','"
																				          .$mDesc."')");
							mysqli_close($mysqli);
							
							$i = $i + 1;
						}
				}
		}
		
		
	//searching
	if ($_GET["Start"]=='1' || $_GET["Start"]=='2')
		{	
			include ("datasource.php");
			include ("function.php");

			$mAccess1 = "1";//fp_Get_Record("Access_yn","tb_muserrights", "UserID_cd = ''".$_SESSION['UserID']."'' AND FuncID_cd = ''COADEL''");
			$mAccess2 = "1";//fp_Get_Record("Access_yn","tb_muserrights", "UserID_cd = ''".$_SESSION['UserID']."'' AND FuncID_cd = ''COAPRNT''");

			//include ("datasource_.php");
			$mResult = $mysqli->query("Call sp_SubsidiaryAccount_Search('".$_GET['AccountID']."','"
																		  .$_GET['SubsidiaryID']."','"
																		  .$_GET['SubsidiaryDesc']."','0,1000000')");
			$iTotRec = mysqli_num_rows($mResult);

			$display_string = "";
			$display_string .= "<table width=100% border=1 cellspacing=0 cellpadding=1 bordercolor=#FFFFFF>
									<tr bgcolor=#FFFFFF>
										<td colspan=4 align=left>
											<input type='button' name='cmdDelete' class='detail1' value='Delete Record(s)' onClick='javascript:Delete();' ";
										
											if ($mAccess1!='1' && floatval($iTotRec) <> 0)
												{
			$display_string .= 						" disabled";
												}
			
			$display_string .= 								 ">
										</td>
										<td align=right>
											<input type='button' name='cmdPrintSummary' class='detail1' value='Print Summary' onClick=javascript:PrintSummary('".$_SESSION['S_UserID']."',"
                                                                                                                                                                .$_SESSION['S_CompanyID'].",'"
                                                                                                                                                                .$_REQUEST['AccountID']."','"
																																								.$_REQUEST['SubsidiaryID']."','"
                                                                                                                                                                .$_REQUEST['SubsidiaryDesc']."'); ";
											if ($mAccess2!='1' && floatval($iTotRec) <> 0)
												{
			$display_string .= 						" disabled";
												}
			
			$display_string .= 								 ">
										</td>
									</tr>
									<tr>
										<td align=center width=2% class=title1>No.</td>
										<td align=center width=2% class=title1>
											<input type='checkbox' name='chkControl' onClick='javascript:SubsidiarAccount_chkAll();'>
										</td>
										<td align=center width=15% class=title1>Code</td>			
										<td align=center width=81% colspan=2 class=title1>Subsidiary Description</td>
									</tr>";
                                           
			$iStart = 0;
			$iAccountID = '';
			$i = 1;
			
			if (mysqli_num_rows($mResult) > 0)
				{
					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{ 
							if ($iAccountID <> $ado["AccountID_cd"])
								{
									$iAccountID = $ado["AccountID_cd"];
									
									if ($iStart == 1)
										{
											$display_string .= "<tr bgcolor='#FFFFFF'>
																	<td height=20 colspan=5 align=right valign=middle class=detail1>
																		<a href=#top class=detail1><u>Top</u></a>
																	</td>
																</tr>";
										}
									$iStart = 1;
		
									$display_string .= "<tr>
															<td colspan=5 class=title1 align=center>".strtoupper($ado["AccountDesc_tx"])."</td>
														</tr>";
								}
		

							$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
													<td width='2%' align=left class=detail1>&nbsp;".$i.".&nbsp;</td>
													<td width='2%' align=center class=detail1>
														<input name=hidTotRec".$i." type=hidden value='".$ado["TotRec_no"]."'>";

														if ($ado["TotRec_no"]=='0')
															{
							$display_string .= 					"<input id='chkSelect".$i."' type=checkbox name='chkSelect".$i."' value=1 class=detail1>";
															}
														else
															{
							//$display_string .= 					"<input id='chkSelect".$i."' type=checkbox name='chkSelect".$i."' value=1 class=detail1 disabled>";
							$display_string .= 					"<input id='chkSelect".$i."' type=checkbox name='chkSelect".$i."' value=1 class=detail1 >";
							
															}
	
							/*$display_string .= 		"</td>
													<td width='15%' align=center class=detail1>
														<a href=subsidiaryaccount_edit.php?Start=1&ID=".$ado["SubsidiaryID_cd"]."><B>".$ado["SubsidiaryID_cd"]."</B></a>
														<input name=hidID".$i." type=hidden value='".$ado["SubsidiaryID_cd"]."'>
														<input name=hidName".$i." type=hidden value='".$ado["SubsidiaryDesc_tx"]."'>
													</td>
													<td width='81%' align=left colspan=2 class=detail1>".$ado["SubsidiaryDesc_tx"]."&nbsp;</td>
												</tr>";
							*/					
							$display_string .= 		"</td>
													<td width='15%' align=center class=detail1>
														<a href='#' onClick=javascript:SubsidiaryAccount_CallAjaxPage('subsidiaryaccount_edit.php','1',".$ado["SubsidiaryID_cd"].")><B>".$ado["SubsidiaryID_cd"]."</B></a>
														<input name=hidID".$i." type=hidden value='".$ado["SubsidiaryID_cd"]."'>
														<input name=hidName".$i." type=hidden value='".$ado["SubsidiaryDesc_tx"]."'>
													</td>
													<td width='81%' align=left colspan=2 class=detail1>".$ado["SubsidiaryDesc_tx"]."&nbsp;</td>
												</tr>";
									
							$i = $i + 1;
						}
				}
			else
				{
					$display_string .= "<tr>
											<td colspan=5 class=title2 align=center>no record</td>
										</tr>";
				}
			mysqli_close($mysqli);
		
			$display_string .= "<tr bgcolor='#FFFFFF'>
									<td height=20 colspan=5 align=right valign=middle class=detail1>
										<a href=#top class=detail1><u>Top</u></a>
									</td>
								</tr>
								<input type='hidden' name='hidRec' id='hidRec' value='".$iTotRec."'>";
			$display_string .= "</table>";			
		}






	//searching item
	if ($_GET["Start"]=='3')
		{
			include ("datasource.php");

			$mResult = $mysqli->query("Call sp_Execute_Query('SELECT * FROM tb_mcoadtl WHERE AccountID_cd =''".$_GET['AccountID']."'' AND SubsidiaryID_cd =''".$_GET['SubsidiaryID']."''')");

			if (mysqli_num_rows($mResult) > 0)
				{
					$display_string = "1";
				}
			else
				{
					$display_string = "0";
				}
			mysqli_close($mysqli);
		}






	if ($_GET["Start"]=='4')
		{
			include ("datasource_.php");
			$mResult = $mysqli->query("Call sp_SubsidiaryAccount_Search('".$_GET['AccountID']."','"
																		  .$_GET['SubsidiaryID']."','"
																		  .$_GET['SubsidiaryDesc']."','0,1000000')");
			$display_string = mysqli_num_rows($mResult);
			if (mysqli_num_rows($mResult) > 0)
				{
					$display_string .= "<div onmouseover='javascript:SuggestOver(this);' onmouseout='javascript:SuggestOut(this);' "; 
					$display_string .= " onclick='javascript:SetSearchSubsidiaryName(this.innerHTML);' class=suggest_link>";
					$display_string .= $_REQUEST['SubsidiaryDesc']."</div>";

					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{ 
							$display_string .= "<div onmouseover='javascript:SuggestOver(this);' onmouseout='javascript:SuggestOut(this);' "; 
							$display_string .= " onclick='javascript:SetSearchSubsidiaryName(this.innerHTML);' class=suggest_link>";
							$display_string .= $ado['SubsidiaryDesc_tx']."</div>";
						}
				}
			else
				{
					$display_string = "";
				}
			mysqli_close($mysqli);
		}



	echo $display_string;
?>