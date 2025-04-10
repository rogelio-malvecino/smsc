<?php
	session_start();
	include ("Functioneverwing.php");
	Is_Logged_In();
	date_default_timezone_set('Asia/Manila');



	function mround($number,$precision=0)
	{
		$precision = ($precision == 0 ? 1 :$precision);
		$pow = pow(10,$precision);
		$ceil = ceil($number * $pow)/$pow;
		$floor = floor($number *$pow)/$pow;

		$pow = pow(10,$precision+1);

		$diffCeil = $pow*($ceil-$number);
		$diffFloor = $pow*($number-$floor)+($number <0 ? -1 :1);

		if($diffCeil >= $diffFloor) return $floor;
		else return $ceil;

	}

	//searching
	if ($_GET["Start"]=='1')
		{
			
			include ("datasource.php");
			include ("function.php");

			$mAccess = "1";//fp_Get_Record("Access_yn","tb_muserrights", "UserID_cd = ''".$_SESSION['UserID']."'' AND FuncID_cd = ''FRSTBPRNT''");

			$mSubsidiaryID="";
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

			if ($_REQUEST['ControlNo']=='') { $mTitle3 = 'ALL ACCOUNT(S)'; }
			else { $mTitle3 = fp_Get_Record("AccountDesc_tx","tb_mcoahdr","AccountID_cd=''".$_REQUEST['ControlNo']."''"); }





			if (((int)$_REQUEST['Month1'])==1)
				{
					$mBegStartDate = "1900-12-31";
					$mBegEndDate = "1900-12-31";
				}
			else
				{											
					$mBegStartDate = $_REQUEST['Year1']."-01-01";
					$mBegEndDate = DateAdd(-0,((int)$_REQUEST['Month1'])."/".$_REQUEST['Day1']."/".$_REQUEST['Year1']);
					$mBegEndDate = substr($mBegEndDate,6,4)."-".substr($mBegEndDate,3,2)."-".substr($mBegEndDate,0,2);
				}



			$mStartDate = $_REQUEST['Year1'].'-'.$_REQUEST['Month1'].'-'.$_REQUEST['Day1'];
			$mEndDate = $_REQUEST['Year2'].'-'.$_REQUEST['Month2'].'-'.$_REQUEST['Day2'];
			//echo $mStartDate."==".$mEndDate;

			include ("datasource.php");
			$mResult = $mysqli->query("Call sp_TrialBalance_Select('".$_REQUEST['ControlNo']."','"
																	 .$_REQUEST['Journal']."','"
																	 .$mStartDate."','"
																	 .$mEndDate."','"
																	 .$_REQUEST['Status']."')");
			$i = 0;
			$j = 0;
			$mTotalDebit = 0;
			$mTotalCredit = 0;


















			$display_string = "";
			$display_string .= "<table width=100% border=1 cellspacing=0 cellpadding=1 bordercolor=#FFFFFF>";

            $display_string .= "<tr>
									<td colspan=7 class=title1 align=center>&nbsp;".$mTitle1."<br>"
																				   .strtoupper($mTitle2)."<br>"
																				   .strtoupper($mTitle3)."
									</td>
								</tr>									
								<tr> 
									<td class=title1 align=center rowspan=3 width=8%>Code</td>
									<td class=title1 align=center rowspan=2 colspan=2 width=44%>Account Description</td>
						  		</tr>
								<tr>
									<td class=title1 align=center colspan=4 width=24%>General Ledger</td>
                                    
						  		</tr>
								<tr>
									<td </td>
									<td </td>
									<td class=title1 align=center width=12%>Debit</td>
                                    <td class=title1 align=center width=12%>Credit</td>
									
						  		</tr>
							    </table>	
								<table width=100% border=1 cellspacing=0 cellpadding=3 bordercolor=#FFFFFF>";
			
			$iTotRec = mysqli_num_rows($mResult);
																										
			if (mysqli_num_rows($mResult) > 0)
				{
					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
						{ 
							$mBeginning = '';
							$mBegDebit = 0;
							$mBegCredit = 0;
							$mBalance = '';

							$mBegDebit = fp_Beginning_TrialBalance($ado["AccountID_cd"],
																   $_REQUEST['Journal'],
																   $mBegStartDate,
																   $mBegEndDate,
																   "1",
																   $_REQUEST['Status']);

							$mBegCredit = fp_Beginning_TrialBalance($ado["AccountID_cd"],
																	$_REQUEST['Journal'],
																	$mBegStartDate,
																	$mBegEndDate,
																	"2",
																	$_REQUEST['Status']);
																
																										
							if ($ado["Debit_yn"]=="1")
								{
									if ($mBegDebit > $mBegCredit)
										{	
											$mBeginning = number_format($mBegDebit - $mBegCredit,2);
											$mBegDebit = $mBegDebit - $mBegCredit;
											if ($mBegDebit <= 0) { $mBeginning = '-'; }
										}
									if ($mBegDebit < $mBegCredit)
										{
											$mBeginning = "(".number_format(abs($mBegCredit - $mBegDebit),2).")";
											$mBegCredit = $mBegCredit - $mBegDebit;
											if ($mBegCredit <= 0) { $mBeginning = '-'; }
										}
								}
							else
								{
									if ($mBegDebit > $mBegCredit)
										{	
											$mBeginning = "(".number_format(abs($mBegDebit - $mBegCredit),2).")";
											$mBegDebit = $mBegDebit - $mBegCredit;
											if ($mBegDebit <= 0) { $mBeginning = '-'; }
										}
									if ($mBegDebit < $mBegCredit)
										{
											$mBeginning = number_format($mBegCredit - $mBegDebit,2);
											$mBegCredit = $mBegCredit - $mBegDebit;
											if ($mBegCredit <= 0) { $mBeginning = '-'; }
										}
								}
																
																
																
							$mBegDebit = $mBegDebit + $ado["Debit"];
							$mBegCredit = $mBegCredit + $ado["Credit"];


							if ($ado["Debit_yn"]=="1")
								{
									if ($mBegDebit > $mBegCredit)
										{
											$mBalance = number_format($mBegDebit - $mBegCredit,2);
										}
									if ($mBegDebit < $mBegCredit)
										{
											$mBalance = "(".number_format(abs($mBegCredit - $mBegDebit),2).")";
										}
								}
							else
								{
									if ($mBegDebit < $mBegCredit)
										{
											$mBalance =number_format($mBegCredit - $mBegDebit,2);
										}
									if ($mBegDebit > $mBegCredit)
										{
											$mBalance = "(".number_format(abs($mBegDebit - $mBegCredit),2).")";
										}
								}	

							$mTotalDebit = $mTotalDebit + $ado["Debit"];
							$mTotalCredit = $mTotalCredit + $ado["Credit"];
							$mDebit = number_format($ado["Debit"],2);
							$mCredit = number_format($ado["Credit"],2);
																
							if ($mDebit <= 0) { $mDebit = ''; }
							if ($mCredit <= 0) { $mCredit = ''; }


							
							/*$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
													<td width=8% align=center class=detail14>
														<a href=generalledger_search.php?Start=1&ControlNo=".$ado["AccountID_cd"]."&Status=".$_REQUEST['Status']."&SubsidiaryNo=&Journal=".$_REQUEST['Journal']."&Month1=".$_REQUEST['Month1']."&Day1=".$_REQUEST['Day1']."&Year1=".$_REQUEST['Year1']."&Month2=".$_REQUEST['Month2']."&Day2=".$_REQUEST['Day2']."&Year2=".$_REQUEST['Year2'].">".$ado["AccountID_cd"]."</a>                                                                   	
                                                  	</td>
													<td width=44% align=left class=detail1 colspan=2>".$ado["AccountDesc_tx"]."&nbsp;</td>
													<td width=12% align=right class=detail13>".$mDebit."&nbsp;</td>
													<td width=12% align=right class=detail13>".$mCredit."&nbsp;</td>
													<td width=12% align=right class=detail13>&nbsp;</td>
													<td width=12% align=right class=detail13>&nbsp;</td>
												</tr>";
							*/
							$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
													<td width=8% align=center class=detail14>
														<a href='#' onClick=javascript:TrialBalance_CallAjaxPage('generalledger_search.php','1','".$ado["AccountID_cd"]."','".$ado['SubsidiaryID_cd']."','','".$_REQUEST['Journal']."','".$_REQUEST['Month1']."','".$_REQUEST['Day1']."','".$_REQUEST['Year1']."','".$_REQUEST['Month2']."','".$_REQUEST['Day2']."','".$_REQUEST['Year2']."')>".$ado["AccountID_cd"]."</a>                                                                   	
                                                  	</td>
													<td width=44% align=left class=detail1 colspan=4>".$ado["AccountDesc_tx"]."&nbsp;</td>
													<td width=12% align=right class=detail13>".$mDebit."&nbsp;</td>
													<td width=12% align=right class=detail13>".$mCredit."&nbsp;</td>

												</tr>";


							if ($_REQUEST['Subsidiary']=='1')
								{
									$display_string .= fp_SubsidiaryLedger($ado["AccountID_cd"],
																		   $_REQUEST['Journal'],
																		   $_REQUEST['Month1'],
																		   $_REQUEST['Day1'],
																		   $_REQUEST['Year1'],
																		   $_REQUEST['Month2'],
																		   $_REQUEST['Day2'],
																		   $_REQUEST['Year2']);
								}							
							
									


                            $i = $i + 1;
                        }
				}
			mysqli_close($mysqli);
		

			$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
									<td colspan=5 align=left class=detail1>GRAND TOTAL&nbsp;</td>
									<td width=12% align=right class=detail13><B>".number_format($mTotalDebit,2)."</B>&nbsp;</td>
									<td width=12% align=right class=detail13><B>".number_format($mTotalCredit,2)."</B>&nbsp;</td>

								</tr>
								<tr bgcolor='#FFFFFF'>
									<td colspan=8 align=center>
										<input type='button' name='cmdPrint' class='detail1' value='Print' onClick=javascript:TrialBalance_Print('".$_SESSION['S_UserID']."','"
																																	  .$_REQUEST['ControlNo']."','"
																																	  .$_REQUEST['Journal']."','"
																																	  .$_REQUEST['Month1']."','"
																																	  .$_REQUEST['Day1']."','"
																																	  .$_REQUEST['Year1']."','"
																																	  .$_REQUEST['Month2']."','"
																																	  .$_REQUEST['Day2']."','"
																																	  .$_REQUEST['Year2']."','"
																																	  .$_REQUEST['Subsidiary']."'); ";
										if ($mAccess=='0' || $iTotRec==0) 
												{
													$display_string .= " disabled ";
												}

			$display_string .=			">";	 																															  
			$display_string .=		"</td>
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
