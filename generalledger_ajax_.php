<?php
	session_start();
	include ("Functioneverwing.php");
	Is_Logged_In();
	
	if ($_GET["Start"]=='1')
		{
			include ("datasource.php");
			$mResult = $mysqli->query("Call sp_Execute_Query('SELECT * FROM tb_mcoadtl WHERE AccountID_cd =''".$_GET['AccountID']."'' ORDER BY SubsidiaryDesc_tx')");
			
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
									$display_string .= $iStart.'!-Select Subsidiary Description-!';
								} 
							else
								{
									$iStart = '';
								}
							$display_string .= $ado['SubsidiaryID_cd'].'!'.$ado['SubsidiaryDesc_tx'].'!';
							
							$i = $i + 1;
						}
				}
			else
				{
					$display_string = "";
				}
			mysqli_close($mysqli);
		}


	//searching
	if ($_GET["Start"]=='2')
		{
			
			
			include ("datasource.php");
			include ("function.php");

			$mAccess = '1';//fp_Get_Record("Access_yn","tb_muserrights", "UserID_cd = ''".$_SESSION['UserID']."'' AND FuncID_cd = ''FRSGLPRNT''");

			
			$mStartDate = $_REQUEST['Year1'].'-'.$_REQUEST['Month1'].'-'.$_REQUEST['Day1'];
			$mEndDate = $_REQUEST['Year2'].'-'.$_REQUEST['Month2'].'-'.$_REQUEST['Day2'];
		
			if (((int)$_REQUEST['Month1'])==1)
				{
					$mBegStartDate = "1900-12-31";
					$mBegEndDate = "1900-12-31";
				}
			else
				{											
					$mBegStartDate = $_REQUEST['Year1']."-01-01";
					$mBegEndDate = DateAdd("d", -0, $mStartDate);
				}


			include ("datasource.php");
			$mResult = $mysqli->query("Call sp_GeneralLedger_Select_('".$_REQUEST['ControlNo']."','"
																	  .$_REQUEST['SubsidiaryID']."','"
																	  .$_REQUEST['Journal']."','"
																	  .$mStartDate."','"
																	  .$mEndDate."','"
																	  .$_REQUEST['Status']."')");


			$iMonth = '';
			$iStart = 0;
			$i = 0;
			$j = 0;
			$mTotalDebit = 0;
			$mTotalCredit = 0;			
			
			
			$mStartDate = date("F j",mktime(0,0,0,$_REQUEST['Month1'],$_REQUEST['Day1'],$_REQUEST['Year1']));
			$mEndDate = date("F j Y",mktime(0,0,0,$_REQUEST['Month2'],$_REQUEST['Day2'],$_REQUEST['Year2']));
						


			$mTitle1 = fp_FormatPeriod($_REQUEST['Month1'],
									   $_REQUEST['Month2'],
									   $_REQUEST['Day1'],
									   $_REQUEST['Day2'],
									   $_REQUEST['Year1'],
									   $_REQUEST['Year2']);

			if ($_REQUEST['Journal']=='0') { $mTitle2 = 'ALL ACCOUNTING BOOKS'; }
			if ($_REQUEST['Journal']=='1') { $mTitle2 = 'CASH RECEIPTS'; }
			if ($_REQUEST['Journal']=='2') { $mTitle2 = 'PURCHASES'; }
			if ($_REQUEST['Journal']=='3') { $mTitle2 = 'CASH SALES'; }
			if ($_REQUEST['Journal']=='4') { $mTitle2 = 'CHARGE SALES'; }
			if ($_REQUEST['Journal']=='5') { $mTitle2 = 'CHECK DISBURSEMENT'; }
			if ($_REQUEST['Journal']=='6') { $mTitle2 = 'GENERAL JOURNAL'; }


			if ($_REQUEST['SubsidiaryNo']=='') 
				{ $mTitle3 = fp_Get_Record("AccountDesc_tx","tb_mcoahdr","AccountID_cd=''".$_REQUEST['ControlNo']."''").'<br>ALL SUBSIDIARY'; }
			else 
				{ $mTitle3 = fp_Get_Record("AccountDesc_tx","tb_mcoahdr","AccountID_cd=''".$_REQUEST['ControlNo']."''").' ('.
							 fp_Get_Record("SubsidiaryDesc_tx","tb_mcoadtl","SubsidiaryID_cd=''".$_REQUEST['SubsidiaryID']."''").
							 ')'; 
				}






			$mBalance = 0;
			$mBalanceDesc = '';
																								
			$display_string = "";
			$display_string .= "<table width=100% border=1 cellspacing=0 cellpadding=1 bordercolor=#FFFFFF>
            					<tr>
									<td colspan=8 class=title1 align=center>&nbsp;".$mTitle1."<br>"
																				   .strtoupper($mTitle2)."<br>"
																				   .strtoupper($mTitle3)."
									</td>
								</tr>									
								<tr>
									<td width=8% class=title1 align=center>Date</td>
									<td width=12% class=title1 align=center>TRN No</td>
									<td width=15% class=title1 align=center>Reference No</td>
									<td width=23% class=title1 align=center>Payee</td>
									<td width=20% class=title1 align=center>Particular</td>
									<td width=11% class=title1 align=center>Debit</td>
									<td width=11% class=title1 align=center>Credit</td>
						  		</tr>
				    			</table>";	
			$display_string .= "<table width=100% border=1 cellspacing=0 cellpadding=3 bordercolor=#FFFFFF>";




			$iTotRec = mysqli_num_rows($mResult);

			if (mysqli_num_rows($mResult) > 0)
				{
					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{ 
							if ($iMonth <> substr($ado["DocDate_dt"],5,2))
								{
									$iMonth = substr($ado["DocDate_dt"],5,2);

									if ($iStart == 1)
										{
											$display_string .= "<tr bgcolor=#FFFFFF>
																	<td height=20 colspan=7 align=right valign=middle class=detail1>						
																		<a href=#top class=detail1><u>Top</u></a>
																	</td>
																</tr>";

										}
									$iStart = 1;
								}




							$mTotalDebit = (float)$mTotalDebit + (float)$ado["Debit"];
							$mTotalCredit = (float)($mTotalCredit) + (float)$ado["Credit"];
							$mDebit = number_format($ado["Debit"],2);
							$mCredit = number_format($ado["Credit"],2);


							if ((float)$mDebit <= 0) { $mDebit = ''; }
							if ((float)$mCredit <= 0) { $mCredit = ''; }




                            /*$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
                                                	<td width=8% align=center class=detail1>"
														.substr($ado["DocDate_dt"],5,2).'/'.substr($ado["DocDate_dt"],8,2).'/'.substr($ado["DocDate_dt"],2,2)."
                                                    </td>
													<td width=12% align=left class=detail1>" 
														.$ado["Ref_tx"]."&nbsp;
														<a href=".$ado['ModuleDesc_tx'].">".$ado["DocNo_tx"]."</a>
													</td>
													<td width=15% align=left class=detail1>"
														.$ado["Reference_tx"]."&nbsp;
													</td>";
							*/
							$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
                                                	<td width=8% align=center class=detail1>"
														.substr($ado["DocDate_dt"],5,2).'/'.substr($ado["DocDate_dt"],8,2).'/'.substr($ado["DocDate_dt"],2,2)."
                                                    </td>
													<td width=12% align=left class=detail1>" 
														.$ado["Ref_tx"]."&nbsp;
														<a href='#' onClick=javascript:PerBook_CallAjaxPage('".$ado["Page"]."','2','".$ado["DocNo_tx"]."','".$ado["AccountID_cd"]."','".$ado['SubsidiaryID_cd']."','','".$ado['Journal_Tx']."','".$ado['Month1']."','".$ado['Day1']."','".$ado['Year1']."','".$ado['Month2']."','".$ado['Day2']."','".$ado['Year2']."')>".$ado["DocNo_tx"]."</a>                                                                   	
													</td>
													<td width=15% align=left class=detail1>"
														.$ado["Reference_tx"]."&nbsp;
													</td>";
		


													if ($_REQUEST['SubsidiaryNo']=='' && $ado['SubsidiaryDesc_tx']!='' || $ado['PaymasterName_tx']=='')
														{
															$display_string .= "<td width=23% align=left class=detail1 >".strtoupper($ado["SubsidiaryDesc_tx"])."&nbsp;</td>";
														}
													else
														{
															$display_string .= "<td width=23% align=left class=detail1 >".strtoupper($ado["PaymasterName_tx"])."&nbsp;</td>";
														}

                            $display_string .=     "<td width=20% align=left class=detail1>".$ado["Particular_tx"]."&nbsp;</td>
                                                	<td width=11% align=right class=detail13>".$mDebit."&nbsp;</td>
                                                	<td width=11% align=right class=detail13>".$mCredit."&nbsp;</td>
                                                </tr>";



							$i = $i + 1;
						}
				}
			mysqli_close($mysqli);




			if ((float)$mTotalDebit > (float)$mTotalCredit)
				{
					$mBalance = number_format((float)$mTotalDebit - (float)$mTotalCredit,2);
					$mBalanceDesc = 'Balance Debit ';
				}
			if ((float)$mTotalDebit < (float)$mTotalCredit)
				{
					$mBalance = number_format(abs((float)$mTotalCredit - (float)$mTotalDebit),2);
					$mBalanceDesc = 'Balance Credit ';
				}



			$mStartDate = $_REQUEST['Year1'].'-'.((int)$_REQUEST['Month1']).'-'.$_REQUEST['Day1'];
			$mEndDate = $_REQUEST['Year2'].'-'.((int)$_REQUEST['Month2']).'-'.$_REQUEST['Day2'];


			$display_string .= "<tr bgcolor=#FFFFFF>
									<td height=20 colspan=7 align=center>&nbsp;</td>
								</tr> 
								<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
									<td colspan=5 align=left class=detail1>".$mBalanceDesc."&nbsp;<Font color=#FF0000><B>".$mBalance."</B></Font></td>
                                    <td width=11% align=right class=detail13>".number_format($mTotalDebit,2)."&nbsp;</td>
                                    <td width=11% align=right class=detail13>".number_format($mTotalCredit,2)."&nbsp;</td>
                                </tr>
								<tr bgcolor='#FFFFFF'>
									<td colspan=8 align=center>
										<input type='button' name='cmdPrint' class='detail1' value='Print' onClick=javascript:GeneralLedger2_Print('".$_SESSION['S_UserID']."','"
																																	  .$_REQUEST['ControlNo']."','"
																																	  .$_REQUEST['SubsidiaryNo']."','"
																																	  .$_REQUEST['Journal']."','"
																																	  .$_REQUEST['Month1']."','"
																																	  .$_REQUEST['Day1']."','"
																																	  .$_REQUEST['Year1']."','"
																																	  .$_REQUEST['Month2']."','"
																																	  .$_REQUEST['Day2']."','"
																																	  .$_REQUEST['Year2']."','"
																																	  .$mStartDate."','"
																																	  .$mEndDate."','"
																																	  .$_REQUEST['Status']."'); ";
										if ($mAccess=='0' || $iTotRec==0) 
												{
													$display_string .= " disabled ";
												}

			$display_string .=			">	 																															  
									</td>
								</tr>
								<tr bgcolor='#FFFFFF'>
									<td height=20 colspan=7 align=right valign=middle class=detail1>
										<a href=#top class=detail1><u>Top</u></a>
									</td>
							    </tr>
								</table>";			
		}

	echo $display_string;
?>
