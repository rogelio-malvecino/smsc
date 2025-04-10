<?php
	session_cache_limiter('private');
	session_start();

	define('FPDF_FONTPATH','/var/www/html/smsc/font/');
	require('../global/fpdf.php');
	
	class PDF extends FPDF
		{
			function PDF($orientation='L',$unit='mm',$format='Letter')
				{
					$this->FPDF($orientation,$unit,$format);
				}

			function Header()
				{
					$mTitle1 = 'Cash Sales Summary';
					$mTitle2 = 'For the period '.$_REQUEST['StartDate']." and ".$_REQUEST['EndDate'];		
					
					$this->SetFont('Arial','B',17);
					$this->Cell(100,10,$_SESSION["CompanyName"],0,'L');
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
					$this->Cell(15,5,'CS#',0,0,'C');
					$this->Cell(10,5);
					$this->Cell(13,5,'Trans Date',0,0,'C');
					$this->Cell(10,5);
					$this->Cell(13,5,'Reference',0,0,'C');
					$this->Cell(13,5);
					$this->Cell(105,5,'Particular',0,0,'C');
					$this->Cell(10,5);
					$this->Cell(20,5,'Amount',0,0,'C');
					$this->Cell(10,5);
					$this->Cell(5,5,'Status',0,0,'C');
					$this->Line(11, 48, 270, 48);
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
					$this->Ln(4);	
					$this->Cell(0,10,'Printed by: '.$_SESSION["FullName"],0,0,'C');

				}
		}

	$pdf=new PDF();
	$pdf->AddPage();


	include('datasource_.php');
	$mResult = $mysqli->query("Call rp_CashSalesSummary_Select_ ('".$_SESSION['UserID']."',"
																		  .$_SESSION['CenterID'].",'"
																		  .$_REQUEST['ControlNo']."','"
																		  .$_REQUEST['ReferenceNo']."','"
																		  .$_REQUEST['StartDate']."','"
																		  .$_REQUEST['EndDate']."','"
																		  .$_REQUEST['Status']."')");
	
	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					$pdf->SetFont('Arial','',7);	
					$pdf->Cell(15,10,$ado["CSID_cd"],0,0,'L');
					$pdf->Cell(13,10);
					$pdf->Cell(13,10,$ado["CSDate_dt"],0,0,'L');
					$pdf->Cell(13,10);
					$pdf->Cell(13,10,$ado["ReferenceID_cd"],0,0,'L');
					$pdf->Cell(13,10);
					$pdf->Cell(95,10,substr($ado["Particular_tx"],0,105),0,0,'L');
					$pdf->Cell(13,10);					
					$pdf->Cell(16,10,number_format($ado["Amount_no"],2),0,0,'R');
					$pdf->Cell(20,10);
					$pdf->Cell(5,10,$ado["Post_yn"],0,0,'C');
					$pdf->Ln(4);
				} 

		}
	mysqli_close($mysqli);
	$pdf->Output();
?>
