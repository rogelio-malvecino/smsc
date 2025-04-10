<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	include ("datasource.php");
	include ("function.php");	

	define('FPDF_FONTPATH','/var/www/html/smsc/font/');
	require("fpdf.php");
	
	class PDF extends FPDF
		{
			function PDF($orientation='L',$unit='mm',$format='A4')
				{
					$this->FPDF($orientation,$unit,$format);
				}

			function Header()
				{
					$mTitle2 = fp_FormatPeriod($_REQUEST['Month1'],
											   $_REQUEST['Month2'],
											   $_REQUEST['Day1'],
											   $_REQUEST['Day2'],
											   $_REQUEST['Year1'],
											   $_REQUEST['Year2']);

					$mTitle2 = 'For the Period '.$mTitle2;
					
					$mTitle1 = 'Trial Balance';
				
					$this->SetFont('Arial','B',17);
					$this->Cell(100,10,$_SESSION['S_CompanyName'],0,'L');
					$this->Cell(162);
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					$this->Cell(20,10,'Page: '.$this->PageNo(),0,'R');
					$this->Ln(2);
					$this->SetTextColor(0);
					$this->SetFont('Arial','',12);
					$this->Cell(80,20,$mTitle1,0,'L');
					$this->Ln(5);
					$this->Cell(0,20,$mTitle2,0,'L');
					$this->SetFont('Arial','B',8);

					if ($_REQUEST['Status']=='')
					{
					$this->Ln(5);
					$this->Cell(0,20,"Status : Posted/Unposted Transactions",0,'L');
					}
					else if($_REQUEST['Status']=='0')
					{
					$this->Ln(5);
					$this->Cell(0,20,"Status : Unposted Transactions",0,'L');
					}
					else
					{
					$this->Ln(5);
					$this->Cell(0,20,"Status : Posted Transactions",0,'L');
					}
					$this->Ln(20);


					$this->SetFont('Arial','B',9);
					$this->Cell(20,5,"Account",0,0,'C');
					$this->Cell(114,5,"Account Description",0,0,'C');
					$this->Cell(70,5,"General Ledger",0,0,'C');
					//$this->Cell(70,5,"Subsidiary Ledger",0,0,'C');
					$this->Ln(5);					
					$this->Cell(20,5,"",0,0,'C');
					$this->Cell(20,5,"",0,0,'C');
					$this->Cell(94,5,"",0,0,'C');
					$this->Cell(35,5,"Debit",0,0,'C');
					$this->Cell(35,5,"Credit",0,0,'C');
					//$this->Cell(35,5,"Debit",0,0,'C');
					//$this->Cell(35,5,"Credit",0,0,'C');
					$this->Ln(5);					

					$this->Line(11, 37, 285, 37);
					$this->Line(11, 47, 285, 47);
					$this->Line(31, 42, 285, 42);

					$this->Line(11, 37, 11, 47);
					$this->Line(31, 37, 31, 47);
					$this->Line(51, 42, 51, 47);
					$this->Line(145, 37, 145, 47);
					$this->Line(180, 42, 180, 47);
					$this->Line(215, 37, 215, 47);
					$this->Line(250, 42, 250, 47);
					$this->Line(285, 37, 285, 47);

				}

			function Footer()
				{
					$this->SetY(-15);
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					//$this->Cell(0,10,$_SESSION["BranchAddress"],0,0,'C');
					$this->Ln(4);	
					//$this->Cell(0,10,'Tel No '.$_SESSION["BranchTelNo"].'   Fax No '.$_SESSION["BranchFaxNo"].'   Email '.$_SESSION["BranchEmail"],0,0,'C');
				}
		}

	$pdf=new PDF();
	$pdf->AddPage();



	$mStartDate = date("F j",mktime(0,0,0,$_REQUEST['Month1'],$_REQUEST['Day1'],$_REQUEST['Year1']));
	$mEndDate = date("F j Y",mktime(0,0,0,$_REQUEST['Month2'],$_REQUEST['Day2'],$_REQUEST['Year2']));

	if (((int)$_REQUEST['Month1'])==1)
		{
			$mBegStartDate = "1900-12-31";
			$mBegEndDate = "1900-12-31";
		}
	else
		{											
			$mBegStartDate = $_REQUEST['Year1']."-01-01";
			$mBegEndDate = DateAdd(-0,((int)$_REQUEST['Month1']-0)."/".$_REQUEST['Day1']."/".$_REQUEST['Year1']);
			$mBegEndDate = substr($mBegEndDate,6,4)."-".substr($mBegEndDate,3,2)."-".substr($mBegEndDate,0,2);
		}



	$mStartDate = $_REQUEST['Year1'].'-'.((int)$_REQUEST['Month1']).'-'.$_REQUEST['Day1'];
	$mEndDate = $_REQUEST['Year2'].'-'.((int)$_REQUEST['Month2']).'-'.$_REQUEST['Day2'];


	$i = 0;
	$j = 0;
	$mTotalDebit = 0;
	$mTotalCredit = 0;



	include ("datasource.php");
	$mResult = $mysqli->query("Call rp_TrialBalance_Select('".$_SESSION['S_UserID']."','"
															 .$_REQUEST['ControlNo']."','"
															 .$_REQUEST['Journal']."','"
															 .$mStartDate."','"
															 .$mEndDate."','"
															 .$_REQUEST['Status']."')");

	echo $mysqli->error;
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
							if ((float)$mBegDebit > (float)$mBegCredit)
								{	
									$mBeginning = number_format((float)$mBegDebit - (float)$mBegCredit,2);
									$mBegDebit = (float)$mBegDebit - (float)$mBegCredit;
									if ((float)$mBegDebit <= 0) { $mBeginning = '-'; }
								}
							if ((float)$mBegDebit < (float)$mBegCredit)
								{
									$mBeginning = "(".number_format(abs((float)$mBegCredit - (float)$mBegDebit),2).")";
									$mBegCredit = (float)$mBegCredit - (float)$mBegDebit;
									if ((float)$mBegCredit <= 0) { $mBeginning = '-'; }
								}
						}
					else
						{
							if ((float)$mBegDebit > (float)$mBegCredit)
								{	
									$mBeginning = "(".number_format(abs((float)$mBegDebit - (float)$mBegCredit),2).")";
									$mBegDebit = (float)$mBegDebit - (float)$mBegCredit;
									if ((float)$mBegDebit <= 0) { $mBeginning = '-'; }
								}
							if ((float)$mBegDebit < (float)$mBegCredit)
								{
									$mBeginning = number_format((float)$mBegCredit - (float)$mBegDebit,2);
									$mBegCredit = (float)$mBegCredit - (float)$mBegDebit;
									if ((float)$mBegCredit <= 0) { $mBeginning = '-'; }
								}
						}
														
														
														
					$mBegDebit = $mBegDebit + $ado["Debit"];
					$mBegCredit = $mBegCredit + $ado["Credit"];


					if ($ado["Debit_yn"]=="1")
						{
							if ((float)$mBegDebit > (float)$mBegCredit)
								{
									$mBalance = number_format((float)$mBegDebit - (float)$mBegCredit,2);
								}
							if ((float)$mBegDebit < (float)$mBegCredit)
								{
									$mBalance = "(".number_format(abs((float)$mBegCredit - (float)$mBegDebit),2).")";
								}
						}
					else
						{
							if ((float)$mBegDebit < (float)$mBegCredit)
								{
									$mBalance =number_format((float)$mBegCredit - (float)$mBegDebit,2);
								}
							if ((float)$mBegDebit > (float)$mBegCredit)
								{
									$mBalance = "(".number_format(abs((float)$mBegDebit - (float)$mBegCredit),2).")";
								}
						}	

					$mTotalDebit = (float)$mTotalDebit + (float)$ado["Debit"];
					$mTotalCredit = (float)($mTotalCredit) + (float)$ado["Credit"];
					$mDebit = number_format($ado["Debit"],2);
					$mCredit = number_format($ado["Credit"],2);
														
					if ((float)$mDebit <= 0) { $mDebit = ''; }
					if ((float)$mCredit <= 0) { $mCredit = ''; }




					$pdf->SetFont('Arial','',9);	
					$pdf->Cell(1,6,'',0,0,'C');
					$pdf->Cell(20,6,$ado["AccountID_cd"],1,0,'C');
					$pdf->Cell(114,6,$ado["AccountDesc_tx"],1,0,'L');
					$pdf->Cell(35,6,$mDebit,1,0,'R');
					$pdf->Cell(35,6,$mCredit,1,0,'R');
					$pdf->Cell(35,6,"",1,0,'R');
					$pdf->Cell(35,6,'',1,0,'R');
					$pdf->Ln(6);






					if ($_REQUEST['Subsidiary']=='1')
						{
							$mysqli_ = new mysqli("localhost", $_SESSION['User'], $_SESSION['Password'], "gng_".$_SESSION['DatabaseName']); 
							$mResult_ = $mysqli_->query("Call sp_SubsidiaryBalance_Select('".$ado["AccountID_cd"]."','"
																						    .$_REQUEST['Journal']."','"
																						    .$mStartDate."','"
																						    .$mEndDate."')");
							$iTotRec_ = mysqli_num_rows($mResult_);
		
							$mTotalDebit_ = 0;
							$mTotalCredit_ = 0;
		

							if (mysqli_num_rows($mResult_) > 0)
								{
									while ($ado_ = $mResult_->fetch_array(MYSQLI_BOTH))
										{ 
											$mTotalDebit_ = (float)$mTotalDebit_ + (float)$ado_["Debit"];
											$mTotalCredit_ = (float)($mTotalCredit_) + (float)$ado_["Credit"];
							
											$mDebit_ = number_format($ado["Debit"],2);
											$mCredit_ = number_format($ado["Credit"],2);
															
											if ((float)$mDebit_ <= 0) { $mDebit_ = ''; }
											if ((float)$mCredit_ <= 0) { $mCredit_ = ''; }


											$pdf->SetFont('Arial','',9);	
											$pdf->Cell(1,6,'',0,0,'C');
											$pdf->Cell(20,6,'',1,0,'C');
											$pdf->Cell(20,6,substr($ado_["SubsidiaryID_cd"],5,4),1,0,'C');
											$pdf->Cell(94,6,$ado_["SubsidiaryDesc_tx"],1,0,'L');
											$pdf->Cell(35,6,"",1,0,'R');
											$pdf->Cell(35,6,'',1,0,'R');
											$pdf->Cell(35,6,$mDebit_,1,0,'R');
											$pdf->Cell(35,6,$mCredit_,1,0,'R');
											$pdf->Ln(6);
										}
								}
							mysqli_close($mysqli_);						
						}							
				} 
			$pdf->Cell(1,6,'',0,0,'C');
			$pdf->Cell(134,6,'TOTAL:',1,0,'L');
			$pdf->Cell(35,6,number_format($mTotalDebit,2),1,0,'R');
			$pdf->Cell(35,6,number_format($mTotalCredit,2),1,0,'R');
			$pdf->Cell(35,6,'',1,0,'R');
			$pdf->Cell(35,6,'',1,0,'R');
			$pdf->Ln(20);	



			$pdf->SetFont('Arial','B',8);
	
			//$mTitle1 = fp_Get_Record("Title1_tx","tb_msignatory", "SignatoryID_cd = ''20''");
			//$mTitle2 = fp_Get_Record("Title2_tx","tb_msignatory", "SignatoryID_cd = ''20''");
			//$mTitle3 = fp_Get_Record("Title3_tx","tb_msignatory", "SignatoryID_cd = ''20''");
		/*
			$mEmployee1 = fp_Get_Record("EmployeeID1_cd","tb_msignatory", "SignatoryID_cd = ''20''");
			$mPosition1 = fp_Get_Record("PositionID_id","tb_mstaffstatus", "EmployeeID_cd = ''".$mEmployee1."''");
			$mEmployee1 = fp_Get_Record("FirstName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee1."''").' '.
						  fp_Get_Record("LastName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee1."''");
			
			$mEmployee2 = fp_Get_Record("EmployeeID2_cd","tb_msignatory", "SignatoryID_cd = ''20''");
			$mPosition2 = fp_Get_Record("PositionID_id","tb_mstaffstatus", "EmployeeID_cd = ''".$mEmployee2."''");
			$mEmployee2 = fp_Get_Record("FirstName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee2."''").' '.
						  fp_Get_Record("LastName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee2."''");
	
			$mEmployee3 = fp_Get_Record("EmployeeID3_cd","tb_msignatory", "SignatoryID_cd = ''20''");
			$mPosition3 = fp_Get_Record("PositionID_id","tb_mstaffstatus", "EmployeeID_cd = ''".$mEmployee3."''");
			$mEmployee3 = fp_Get_Record("FirstName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee3."''").' '.
						  fp_Get_Record("LastName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee3."''");
		
			$mPosition1 = fp_Get_Record("PositionName_tx","tb_mposition", "PositionID_id = ".$mPosition1);
			$mPosition2 = fp_Get_Record("PositionName_tx","tb_mposition", "PositionID_id = ".$mPosition2);
			$mPosition3 = fp_Get_Record("PositionName_tx","tb_mposition", "PositionID_id = ".$mPosition3);
		*/
		

		/*
			$pdf->SetFont('Arial','BU',8);
		
			if ($mTitle1<>'' && $mEmployee1<>'')
				{
					$pdf->Cell(60,10,$mTitle1,0,0,'C');
				}
			if ($mTitle2<>'' && $mEmployee2<>'')
				{
					$pdf->Cell(60,10,$mTitle2,0,0,'C');
				}
			if ($mTitle2<>'' && $mEmployee2<>'')
				{
					$pdf->Cell(60,10,$mTitle3,0,0,'C');
				}
				
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(12);
		
			if ($mTitle1<>'' && $mEmployee1<>'')
				{
					$pdf->Cell(60,10,$mEmployee1,0,0,'C');
				}	
			if ($mTitle2<>'' && $mEmployee2<>'')
				{
					$pdf->Cell(60,10,$mEmployee2,0,0,'C');
				}
			if ($mTitle3<>'')
				{
					$pdf->Cell(60,10,$mEmployee2,0,0,'C');
				}
	
			$pdf->SetFont('Arial','',8);	
			$pdf->Ln(4);

			if ($mTitle1<>'' && $mEmployee1<>'' && $mPosition1<>'')
				{
					$pdf->Cell(60,10,$mPosition1,0,0,'C');
				}	
			if ($mTitle2<>'' && $mEmployee2<>'' && $mPosition2<>'')
				{
					$pdf->Cell(60,10,$mPosition2,0,0,'C');
				}
			if ($mTitle3<>'' && $mEmployee3<>'' && $mPosition3<>'')
				{
					$pdf->Cell(60,10,$mPosition3,0,0,'C');
				}
*/

		}
	mysqli_close($mysqli);
	$pdf->Output();
?>
