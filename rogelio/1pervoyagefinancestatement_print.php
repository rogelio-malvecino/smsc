<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	include ("datasource.php");
	include ("function.php");	
	include ("function_.php");	
	define('FPDF_FONTPATH','/var/www/html/smsc/font/');
	require("fpdf.php");
	
	
	class PDF extends FPDF
		{
			function PDF($orientation='P',$unit='mm',$format='Legal')
				{
					$this->FPDF($orientation,$unit,$format);
				}
			
			function Header()
				{

					$mPeriod = $_REQUEST["mDateFrom"]." - ".$_REQUEST["mDateTo"];
					
					$mTitle1 = 'PER VOYAGE FINANCE STATEMENT';
					$mTitle2 = 'for the Period of '.$mPeriod;
					$mTitle3 = 'Voyage Reference : '.$_REQUEST["mReference"];
					
					$this->SetFont('Arial','B',17);
					$this->Cell(0,10,$_SESSION['S_CompanyName'],0,0,'C');
					$this->Ln(2);
					$this->SetFont('Arial','',12);
					$this->Cell(0,20,$mTitle1,0,0,'C');
					$this->Ln(5);
					$this->Cell(0,20,$mTitle2,0,0,'C');
					$this->Ln(5);
					$this->Cell(0,20,$mTitle3,0,0,'C');
					$this->Ln(15);

					$this->SetFont('Arial','B',8);
					$this->Cell(25);
					$this->Cell(100,10,"ACCOUNT",0,0,'C');
					$this->Cell(2);
					//$this->Cell(25,10,"CONTROL#",0,0,'C');
					//$this->Cell(2);
					//$this->Cell(25,10,"DATE",0,0,'C');
					//$this->Cell(2);
					//$this->Cell(125,10,"PARTICULARS",0,0,'C');
					//$this->Cell(2);
					$this->Cell(25,10,"AMOUNT",0,0,'C');
					$this->Ln(4);
					
					//$this->Line(99,43,124,43);
					//$this->Line(126,43,151,43);
					//$this->Line(253,43,178,43);
					//$this->Line(180,43,205,43);
					
					$this->Ln(5);

				}

			function Footer()
				{
					$this->SetY(-15);
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					//$this->Cell(0,10,$_SESSION['S_CompanyName'],0,0,'C');
					$this->Cell(0,10,'',0,0,'C');
					$this->Ln(4);	
				}
		}

	$pdf=new PDF();
	$pdf->AddPage();


	$mStartDate = $_REQUEST["mDateFrom"];
	$mEndDate = $_REQUEST["mDateTo"];
	$mVoyage = $_REQUEST["mReference"];
	$mStatus = $_REQUEST['Status'];


//INCOME
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,10,"INCOME",0,0,'L');
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',9);
	
	$mTotalIncome =0;
	include('datasource.php');
		$mResult = $mysqli->query("CALL sp_pervoyagefinancestatementincome('".$mStartDate."','".$mEndDate."','".$mVoyage."','".$mStatus."')");

	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					$mTotalIncome = $mTotalIncome + $ado['amount'];
					$pdf->Cell(100,4,$ado['AccountDesc_tx'],0,0,'L');
					$pdf->Cell(25);
					//$pdf->Cell(25,4,$ado['control'],0,0,'L');
					//$pdf->Cell(2);
					//$pdf->Cell(25,4,$ado['mDate'],0,0,'L');
					//$pdf->Cell(2);
					//$pdf->Cell(25,4,$ado['Particular_tx'],0,0,'L');
					//$pdf->Cell(2);
					$pdf->Cell(25,4,number_format($ado['amount'],2),0,0,'R');
					$pdf->Ln(4);	
				}
		}
	mysqli_close($mysqli);


///DRAW TOTAL AMOUNT HERE
		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(125,4,"TOTAL INCOME",0,0,'L');
		$pdf->Cell(25,4,number_format($mTotalIncome,2),0,0,'R');
		$pdf->Cell(1,4,'____________',0,0,'R');
		$pdf->Ln(30);
		
		
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(89,6,"LESS EXPENSES",0,0,'L');
		$pdf->SetFont('Arial','',9);	
		$pdf->Ln(8);	
		
		
	$mTotalExpense=0;
	include('datasource.php');
	$mResult = $mysqli->query("CALL sp_pervoyagefinancestatementexpense('".$mStartDate."','".$mEndDate."','".$mVoyage."','".$mStatus."')");
	
	
	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					$mTotalExpense = $mTotalExpense + $ado['amount'];
					$pdf->Cell(100,4,$ado['AccountDesc_tx'],0,0,'L');
					$pdf->Cell(25);
					//$pdf->Cell(25,4,$ado['control'],0,0,'L');
					//$pdf->Cell(10);
					//$pdf->Cell(25,4,$ado['mDate'],0,0,'L');
					//$pdf->Cell(10);
					//$pdf->MultiCell(50,4,$ado['Particular_tx'],0,0,'C');
					//$pdf->Cell(10);
					$pdf->Cell(25,4,number_format($ado['amount'],2),0,0,'R');
					$pdf->Ln(4);	
				}
		}
	mysqli_close($mysqli);
	
	
	$pdf->Ln(15);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(125,4,"TOTAL EXPENSES",0,0,'L');
	$pdf->Cell(25,4,number_format($mTotalExpense,2),0,0,'R');
	$pdf->Cell(1,4,'____________',0,0,'R');
				

	$pdf->Ln(15);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(125,4,"NET INCOME/ LOSS",0,0,'L');
	$pdf->Cell(25,4,number_format($mTotalIncome-$mTotalExpense,2),0,0,'R');
	$pdf->Cell(1,4,'____________',0,0,'R');
	$pdf->Ln(2);
	$pdf->Cell(150);
	$pdf->Cell(1,4,'____________',0,0,'R');	
	$pdf->Ln(30);




	$pdf->Output();
?>
