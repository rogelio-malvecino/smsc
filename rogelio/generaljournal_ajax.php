<?php
	session_start();
	
	include ("Functioneverwing.php");
	include ("function.php");
	Is_Logged_In();
	
	//deleting item
	if ($_POST["Start"]=='1')
		{
			if ($_POST['Rec'] > 0)
				{
					$mData = explode("*", $_REQUEST['Data']);
					$i = 1;
					$mDesc = '';
					
					while ($i <= $_REQUEST['Rec'])
						{ 										
							list($mGJID, $mParticular) = split('!', $mData[$i-1]);
							$mDesc = $mDesc."Journal#: ".$mGJID." - ".$mParticular."\n";
							
							include ("datasource_comp.php");
							$mResult = $mysqli->query("Call sp_GeneralJournal_Delete('".$_SESSION['S_UserID']."','"
																					   .$mGJID."','"
																					   .$mDesc."')");
							mysqli_close($mysqli);
							$i = $i + 1;
						}
				}
		}
		
		
	//searching
	if ($_POST["Start"]=='1' || $_POST["Start"]=='2')
		{
			
			include ("datasource.php");
			//include ("function.php");

			$mAccess1 ='1'; fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''SEARCH'' AND SubMenuCode =''Journal''"); // SEARCH
			$mAccess2 ='1'; fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''ADD'' AND SubMenuCode =''Journal''"); //add
			$mAccess3 ='1'; fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''SAVE'' AND SubMenuCode =''Journal''");//save
			$mAccess4 ='1'; fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''EDIT'' AND SubMenuCode =''Journal''");;//edit
			$mAccess5 ='1'; fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''DELETE'' AND SubMenuCode =''Journal''");//delete
			$mAccess6 ='1'; fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''POST'' AND SubMenuCode =''Journal''");//post
			$mAccess7 ='1'; fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''PRINT'' AND SubMenuCode =''Journal''");//print
			$mAccess8 ='1'; fp_Get_Button_Access_Rights("CmdName","commandaccess", "EmpNumber = ''".$_SESSION['S_UserID']."'' AND CmdName = ''ADMIN'' AND SubMenuCode =''Journal''");//admin

			$mResult = $mysqli->query("Call sp_GeneralJournal_Search('".$_POST['ControlNo']."','"
																       .$_POST['StartDate']."','"
																	   .$_POST['EndDate']."','"
																	   .$_POST['Status']."','0,1000000')");

			$iTotRec = mysqli_num_rows($mResult);

			$display_string = "";
			$display_string .= "<table width=100% border=1 cellspacing=0 cellpadding=1 bordercolor=#FFFFFF>
									<tr bgcolor=#FFFFFF>
									<td colspan='3' align='left'><input type='button' name='cmdDelete' class='detail1' value='Delete Record(s)' onClick='javascript:GeneralJournal_Delete();' ";

										if ($mAccess5=='' || floatval($iTotRec) == 0)
											{
												$display_string .= "disabled";
											}
			
			$display_string .= 		">
									</td>
									<td colspan='3' align=right>											
										<input type='button' name='cmdPrintSummary' class='detail1' value='Print Summary' onClick=javascript:PrintSummary('".$_SESSION['S_UserID']."','"
																																					        .$_POST['ControlNo']."','"
																																					        .$_POST['StartDate']."','"
																																					        .$_POST['EndDate']."','"
																																					        .$_POST['Status']."',''); ";
										if ($mAccess7=='' || floatval($iTotRec) == 0)
											{
												$display_string .= "disabled";
											}

			$display_string .= 		">
									</td>
								</tr>
								</table>";
			$display_string .= "<table width=100% border=1 cellspacing=0 cellpadding=1 bordercolor=#FFFFFF class=display id=example>
								<thead><tr class=title>
			 						<td align=center width=5% class=title1>No.</td>
									<td align=left width=2% class=title1>
										<input type='checkbox' name='chkControl' onClick='javascript:GeneralJournal_chkAll();'>
									</td>
									<td align=center width=10% class=title1>Journal#</td>			
									<td align=center width=10% class=title1>Date</td>
									<td align=center width=15% class=title1>REF#</td>
									<td align=center width=60% class=title1>Particular</td>
									<td align=center width=13% class=title1>Amount</td>
									<td align=center width=10% class=title1>Status</td>
								</tr></thead>";
                                           
			$iStart = 0;
			$iDate = '';
			$i = 1;
			$display_string .= "<tbody>";			
			if (mysqli_num_rows($mResult) > 0)
				{
					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{ 
							if ($iDate <> $ado["GJDate_dt"])
								{
									$iDate = $ado["GJDate_dt"];
								
									if ($iStart == 1)
										{
											/*$display_string .= "<tr bgcolor='#FFFFFF'>
																	<td height=20 colspan=6 align=right valign=middle class=detail1>
																		<a href=#top class=detail1><u>Top</u></a>
																	</td>
																</tr>";
											*/					
										}
									$iStart = 1;
		
									/*$display_string .= "<tr>
															<td colspan=7 class=title1 align=center>"
																.date("F d, Y", mktime(0,0,0,substr($ado["GJDate_dt"],5,2),substr($ado["GJDate_dt"],8,2),substr($ado["GJDate_dt"],0,4))).
															"</td>
														</tr>";
									*/					
								}
		
							$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
													<td width='5%' align=left class=detail1>&nbsp;".$i.".&nbsp;</td>
													<td width='2%' align=left class=detail1>
														<input name=hidStatus".$i." type=hidden value='".$ado["Post_yn"]."'>";

														if ($ado["Post_yn"]=='0')
															{
																$display_string .= "<input id='chkSelect".$i."' type=checkbox name='chkSelect".$i."' value=1 class=detail1>";
															}
														else
															{
																$display_string .= "<input id='chkSelect".$i."' type=checkbox name='chkSelect".$i."' value=1 class=detail1 disabled>";
															}
							
							/*$display_string .= 		"<td width='10%' align=left class=detail1>
														<input name=hidID".$i." type=hidden value='".$ado["GJID_cd"]."'>";
*/

							if ($mAccess7=='')
								{
								$display_string .= 		"<td width='10%' align=left class=detail1>
														<img src='' align='bottom' onClick=javascript:GeneralJournal_PrintVoucher('".$ado["GJID_cd"]."','".$ado["Amount_no"]."','".$ado["GJDate_dt"]."');>
														<input name=hidID".$i." type=hidden value='".$ado["GJID_cd"]."'>";
								}
							else
								{
								$display_string .= 		"<td width='10%' align=left class=detail1>
														<img src='images/printer.jpg' align='bottom' onClick=javascript:GeneralJournal_PrintVoucher('".$ado["GJID_cd"]."','".$ado["Amount_no"]."','".$ado["GJDate_dt"]."');>
														<input name=hidID".$i." type=hidden value='".$ado["GJID_cd"]."'>";
								}	



														if ($ado["Post_yn"]=='0')
															{
																//$display_string .= "<a href=generaljournal_edit.php?Start=1&ID=".$ado["GJID_cd"].">".$ado["GJID_cd"]."</a>";
																$display_string .= "<a href='#' onClick=javascript:GeneralJournal_CallAjaxPage('generaljournal_edit.php','1','".$ado["GJID_cd"]."')>".$ado["GJID_cd"]."</a>";
															}
														else
															{
																$display_string .= $ado["GJID_cd"];
															}
								
							$display_string .= 		"</td>
													<td width='15%' align=left class=detail1>".$ado["GJDate_dt"]."&nbsp;</td>
													<td width='15%' align=left class=detail1>
														<input name=hidReferenceNo".$i." type=hidden value='".$ado["ReferenceID_cd"]."'>"
														.$ado["ReferenceID_cd"]."&nbsp;
													</td>
													<td width='60%' align=left class=detail1>
														<input name=hidParticular".$i." type=hidden value='".$ado["Particular_tx"]."'>"
														.$ado["Particular_tx"]."&nbsp;
													</td>
													<td width='13%' align=right class=detail13>".number_format($ado["Amount_no"],2)."&nbsp;</td>
													<td width='10%' align=center class=detail13>".$ado["PostDesc_tx"]."&nbsp;</td>
												</tr>";
		
							$i = $i + 1;
						}
				}
			else
				{
					$display_string .= "<tr>
											<td class=title2 align=center>---</td>
											<td class=title2 align=center>---</td>
											<td class=title2 align=center>---</td>
											<td class=title2 align=center>---</td>
											<td class=title2 align=center>---</td>
											<td class=title2 align=center>---</td>
											<td class=title2 align=center>---</td>
											<td class=title2 align=center>---</td>
										</tr>";
				}
			mysqli_close($mysqli);
		
			$display_string .= "</tbody>
								<input type='hidden' name='hidRec' id='hidRec' value='".$iTotRec."'>
								</table>";			
		}






	








	//searching account
	if ($_POST["Start"]=='3' || $_POST["Start"]=='4')
		{
			include ("datasource_comp.php");

			$mResult = $mysqli->query("Call sp_Execute_Query(
									  'SELECT a.AccountID_cd,
									  		  a.AccountDesc_tx,
											  a.Debit_yn,		 
											  (SELECT Count(*) FROM tb_mcoadtl WHERE AccountID_cd = a.AccountID_cd) AS TotCount
									  FROM tb_mcoahdr a
									  WHERE a.AccountID_cd =''".$_POST['AccountID']."'' AND GJ_yn = 1 ')");
			
			if (mysqli_num_rows($mResult) > 0)
				{
					$ado = $mResult->fetch_array(MYSQLI_BOTH);
					$display_string = $ado['Debit_yn'].'!'.$ado['TotCount'].'!'.$ado['AccountID_cd'].'!'.$ado['AccountDesc_tx'].'!0!0!*';
				}
			else
				{
					$display_string = "";
				}
			mysqli_close($mysqli);
		}



	//searching subsidiary
	if ($_POST["Start"]=='5')
		{
			include ("datasource_comp.php");

			$mResult = $mysqli->query("Call sp_SubsidiaryRights_Select('".$_POST['AccountID']."')");
			
			$display_string = "";
			$iTotRec = mysqli_num_rows($mResult);
			$i = 1;
			
			if (mysqli_num_rows($mResult) > 0)
				{
					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{
							if ($i==1)
								{
									$iStart = $iTotRec.'!';
								} 
							else
								{
									$iStart = '';
								}
							$display_string .= $iStart.$ado['SubsidiaryID_cd'].'!'.$ado['SubsidiaryDesc_tx'].'!';
							
							$i = $i + 1;
						}
				}
			else
				{
					$display_string = "";
				}
			mysqli_close($mysqli);
		}



	//transactional item
	if ($_POST["Start"]=='6')
		{
			$mRec = $_POST['Rec'];
			$mData = $_POST['Data'];
			$_SESSION['myData']=$mData;
			$display_string = "<table width=100% border=1 cellspacing=0 cellpadding=1 bordercolor=#FFFFFF>
									<tr>
										<td width=4% class=title1 align=center>No</td>
										<td width=2% class=title1 align=left>
											<input type=checkbox name=chkAccount onClick=javascript:eGeneralJournal_chkAll();>
										</td>
										<td width=15% class=title1 align=center>Code</td>
										<td width=55% class=title1 align=center>Account Description</td>
										<td width=12% class=title1 align=center>DR</td>
										<td width=12% class=title1 align=center>CR</td>
									</tr>";                                                   

			$mStart=0;

			if (floatval($mRec) > 0)
				{
					include ("datasource_comp.php");
					include ("function.php");

					$mData = explode("*", $mData);
					$i = 1;
					while ($i <= $mRec)
						{ 										
							list($mAccountID, $mAccountTitle, $mSubsidiaryID, $mDebit, $mCredit) = split('!', $mData[$i-1]);
				
							$mAccountCode = $mAccountID;
							$mAccountDescription = $mAccountTitle;
							
							if (strlen($mSubsidiaryID) > 0)
								{
									$mAccountCode = $mSubsidiaryID;
									$mAccountDescription = $mAccountTitle.' - '.fp_Get_Record("SubsidiaryDesc_tx","tb_mcoadtl","SubsidiaryID_cd = ''".$mSubsidiaryID."''");
								}

							$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
													<td width=4% align=left class=detail1>&nbsp;".$i.".&nbsp;</td>
													<td width=2% align=center class=detail1>
														<input id='chkSelect".$i."' type=checkbox name='chkSelect".$i."' value=1 class=detail1>
													</td>
													<td width=15% align=left class=detail14>
														".$mAccountCode."
													</td>		
													<td width=55% align=left class=detail1>
														".$mAccountDescription."
														<input type=hidden id='hidAccountID".$i."' name='hidAccountID".$i."' value='".$mAccountID."' class=detail1>
														<input type=hidden id='hidAccountTitle".$i."' name='hidAccountTitle".$i."' value='".$mAccountTitle."' class=detail1>
														<input type=hidden id='hidSubsidiaryID".$i."' name='hidSubsidiaryID".$i."' value='".$mSubsidiaryID."' class=detail1>
													</td>
													<td width=12% align=right class=detail13>
														<input type=text id='hidDebit".$i."' name='hidDebit".$i."' maxlength='13' size='10' value=".number_format($mDebit,2)." class=detail13 dir=rtl onKeyUp=javascript:aGeneralJournal_ComputeTotal(".$i."); tabindex=14>
													</td>
													<td width=12% align=right class=detail13>
														<input type=text id='hidCredit".$i."' maxlength='13' size='10' name='hidCredit".$i."' value=".number_format($mCredit,2)." class=detail13 dir=rtl onKeyUp=javascript:aGeneralJournal_ComputeTotal(".$i."); tabindex=15>
													</td>
												</tr>";
							
							$i = $i + 1;
						}
					$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
											<td align=right class=detail1 colspan=4>
												<B>TOTAL</B>&nbsp;
											</td>
											<td align=right class=detail1>
												<input type=text name=txtTotalDebit value=0 class=detail13 size=10 dir=rtl readonly=True tabindex=1000>
											</td>
											<td align=right class=detail1>
												<input type=text name=txtTotalCredit value=0 class=detail13 size=10 dir=rtl readonly=True tabindex=1000>
											</td>
										</tr>";
				}		

			$display_string .= "</table>";
		}

		
	//searching voyage reference
	if ($_POST["Start"]=='9')
		{
			include ("datasource.php");
			$mResult = $mysqli->query("Call sp_voyagereference_lookup('".$_REQUEST['VoyageReference']."')");
			
			$display_string = "";
			if (mysqli_num_rows($mResult) > 0)
				{
					$display_string .= "<div onmouseover='javascript:SuggestOver(this);' onmouseout='javascript:SuggestOut(this);' "; 
					$display_string .= " onclick='javascript:aCashSales_SetSearchVoyageReference(this.innerHTML);' class=suggest_link>";
					$display_string .= $_REQUEST['VoyageReference']."</div>";

					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{ 
							$display_string .= "<div onmouseover='javascript:SuggestOver(this);' onmouseout='javascript:SuggestOut(this);' "; 
							$display_string .= " onclick='javascript:aCashSales_SetSearchVoyageReference(this.innerHTML);' class=suggest_link>";
							$display_string .= $ado['VoyageReference']."</div>";
							
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
