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
					$mTitle = 'Subsidiary Account';

					$this->SetFont('Arial','B',18);
					$this->Cell(100,10,"Games & Gadgets",0,'L');
					$this->Cell(6);
					$this->Ln(2);
					$this->SetFont('Arial','',14);
					$this->Cell(80,20,$mTitle,0,0,'L');
					$this->Cell(100);
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					$this->Cell(20,10,'Page: '.$this->PageNo(),0,'R');
					$this->Ln(20);

					$this->SetFont('Arial','B',8);
					$this->Cell(20,10,'Account No',1,0,'C');
					$this->Cell(75,10,'Account Title',1,0,'C');
					$this->Cell(20,10,'Subsidiary No',1,0,'C');
					$this->Cell(80,10,'Subsidiary Description',1,0,'C');
					$this->Ln(10);					
				}

			function Footer()
				{
					$this->SetY(-20);
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					$this->Cell(0,10,'#31 Ignacio Santos Diaz Street, Cubao, Quezon City  Philippines',0,0,'C');
					$this->Ln(4);	
					$this->Cell(0,10,'Tel No 727.5260 or 89   Fax No    Email ',0,0,'C');
				}
		}

	$pdf=new PDF();
	$pdf->AddPage();


	include('datasource.php');
	$mResult = $mysqli->query("Call rp_SubsidiaryAccount_Select ('".$_REQUEST['UserID']."',"
															       .$_REQUEST['CenterID'].",'"
															   	   .$_REQUEST['AccountID']."','"
																   .$_REQUEST['SubsidiaryID']."','"
															   	   .$_REQUEST['SubsidiaryDesc']."')");

	$iStart = 0;
	$iGroupID = '';
	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					if ($iGroupID <> $ado["GroupID_cd"])
						{
							if ($iStart==1) { $pdf->Ln(5); }
							$iStart=1;
							
							$iGroupID = $ado["GroupID_cd"];
							$pdf->SetFont('Arial','BU',9);
							$pdf->Cell(195,10,$ado["GroupName_tx"],1,0,'L');
							$pdf->Ln(10);
						}
					
					if ($iAccountID <> $ado["AccountID_cd"])
						{
							$iAccountID = $ado["AccountID_cd"];
							$pdf->SetFont('Arial','B',9);
							$pdf->Cell(20,5,$ado["AccountID_cd"],1,0,'C');
							$pdf->Cell(175,5,$ado["AccountDesc_tx"],1,0,'L');
							$pdf->Ln(5);
						}
						
					$pdf->SetFont('Arial','',9);	
					$pdf->Cell(20,5,'',1,0,'L');
					$pdf->Cell(75,5,'',1,0,'L');
					$pdf->Cell(20,5,$ado["SubsidiaryID_cd"],1,0,'C');
					$pdf->Cell(80,5,$ado["SubsidiaryDesc_tx"],1,0,'L');
					$pdf->Ln(5);
				} 
		}
	mysqli_close($mysqli);
	$pdf->Output();
?>