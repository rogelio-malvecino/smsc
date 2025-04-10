<?php
	session_cache_limiter('private');
	session_start();

	define('FPDF_FONTPATH','/var/www/html/smsc/font/');
	require('../global/fpdf.php');
	
	class PDF extends FPDF
		{
			function PDF($orientation='P',$unit='mm',$format='Letter')
				{
					$this->FPDF($orientation,$unit,$format);
				}

			function Header()
				{
					$mTitle1 = 'Cash Sales Summary';
					$mTitle2 = 'For the period '.$_REQUEST['Title'];

					$this->SetFont('Arial','B',17);
					$this->Cell(100,10,$_SESSION["BranchName"],0,'L');
					$this->Cell(80);
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					$this->Cell(20,10,'Page: '.$this->PageNo(),0,'R');
					$this->Ln(2);
					$this->SetTextColor(0);
					$this->SetFont('Arial','',11);
					$this->Cell(80,20,$mTitle1,0,'L');
					$this->Ln(5);
					$this->Cell(80,20,$mTitle2,0,'L');
					$this->Ln(25);

					$this->SetFont('Arial','B',8);
					$this->Cell(12);
					$this->Cell(20,5,'CS No',0,0,'C');
					$this->Cell(107,5,'Transaction',0,0,'C');
					$this->Cell(25,5,'Debit',0,0,'C');
					$this->Cell(5,5,'',0,0,'C');
					$this->Cell(25,5,'Credit',0,0,'C');
					$this->Line(11, 48, 203, 48);
					$this->Ln(5);					
				}

			function Footer()
				{
					$this->SetY(-20);
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					$this->Cell(0,10,$_SESSION["BranchAddress"],0,0,'C');
					$this->Ln(4);	
					$this->Cell(0,10,'Tel No '.$_SESSION["BranchTelNo"].'   Fax No '.$_SESSION["BranchFaxNo"].'   Email '.$_SESSION["BranchEmail"],0,0,'C');
				}
		}

	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->Ln(15);	


	include('datasource_.php');
	$mResult = $mysqli->query("Call rp_CashSalesDetail_Select ('".$_REQUEST['UserID']."',"
															        .$_REQUEST['CenterID'].",'"
															   		.$_REQUEST['ControlNo']."','"
																	.$_REQUEST['ReferenceNo']."','"
																	.$_REQUEST['StartDate']."','"
															 		.$_REQUEST['EndDate']."','"
																	.$_REQUEST['Status']."')");
	$iStart = 0;
	$iStart1 = 0;
	$iDate = '';
	$iControlNo = '';
	$mTotalDebit = 0;
	$mTotalCredit = 0;

	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					if ($iDate <> $ado["CSDate_dt"])
						{	
							if ($iStart==0) { $iStart=1; } else { $pdf->Ln(25); }
							$iStart1=1;
							$iDate = $ado["CSDate_dt"];
							$pdf->SetFont('Arial','BUI',8);
							$pdf->Cell(325,-20,substr($ado["CSDate_dt"],8,2).' - '.date("F", mktime(0,0,0, substr($ado["CSDate_dt"],5,2), substr($ado["CSDate_dt"],8,2), substr($ado["CSDate_dt"],0,4))),0,0,'L');
							$pdf->Ln(-10);
						}

					$pdf->SetFont('Arial','B',7);
					if ($iControlNo <> $ado["CSID_cd"])
						{
							if ($iStart1==0) 
								{ 
									$pdf->Ln(20); 
								} 
							else 
								{ 
									$iStart1=0; 
								}
								
							$iControlNo = $ado["CSID_cd"];
							$pdf->Cell(12,10,'');
							$pdf->Cell(20,10,$ado["CSID_cd"],0,0,'L');
							$pdf->Cell(107,10,$ado["Particular_tx"],0,0,'L');
							$pdf->Ln(3); 
						}

		
					if ((float)$ado["DebitAmount_no"] > 0) { $mDebit = number_format($ado["DebitAmount_no"],2); } else { $mDebit = ''; }
					if ((float)$ado["CreditAmount_no"] > 0) { $mCredit = number_format($ado["CreditAmount_no"],2); } else { $mCredit = ''; }
					
					$pdf->SetFont('Arial','',7);
					$pdf->Ln(3); 
					$pdf->Cell(32,10,'');
					$pdf->Cell(107,10,$ado["AccountDesc_tx"],0,0,'L');
					$pdf->Cell(25,10,$mDebit,0,0,'R');
					$pdf->Cell(5,10,'',0,0,'');
					$pdf->Cell(25,10,$mCredit,0,0,'R');
					
					$mTotalDebit = $mTotalDebit + (float)$ado["DebitAmount_no"];
					$mTotalCredit = $mTotalCredit + (float)$ado["CreditAmount_no"];					
				} 
			$pdf->Ln(15);
			$pdf->SetFont('Arial','B',8);	
			$pdf->Cell(139,5,'Total',0,0,'R');
			$pdf->SetFont('Arial','B',7);	
			$pdf->Cell(25,5,number_format($mTotalDebit,2),1,0,'R');
			$pdf->Cell(5,5,'',0,0,'');
			$pdf->Cell(25,5,number_format($mTotalCredit,2),1,0,'R');
			$pdf->Ln(7);
		}
	mysqli_close($mysqli);
	$pdf->Output();
?>