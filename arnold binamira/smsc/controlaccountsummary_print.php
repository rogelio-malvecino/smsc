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
			function PDF($orientation='P',$unit='mm',$format='Letter')
				{
					$this->FPDF($orientation,$unit,$format);
				}

			function Header()
				{
					$mTitle = 'Control Account';

					$this->SetFont('Arial','B',18);
					$this->Cell(100,10,"xycompany",0,'L');
					$this->Cell(6);
					$this->Ln(2);
					$this->SetFont('Arial','',14);
					$this->Cell(80,20,$mTitle,0,0,'L');
					$this->Cell(100);
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					$this->Cell(20,10,'Page: '.$this->PageNo(),0,'R');
					$this->Ln(20);

					$this->SetFont('Arial','B',9);
					$this->Cell(20,10,'Account No',1,0,'C');
					$this->Cell(100,10,'Account Title',1,0,'C');
					$this->Cell(20,10,'BS',1,0,'C');
					$this->Cell(20,10,'IS',1,0,'C');
					$this->Cell(20,10,'CF',1,0,'C');
					$this->Ln(10);					
				}

			function Footer()
				{
					$this->SetY(-20);
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					$this->Cell(0,10,'malabon city',0,0,'C');
					$this->Ln(4);	
					$this->Cell(0,10,'Tel No',0,0,'C');
				}
		}

	$pdf=new PDF();
	$pdf->AddPage();


	include('datasource.php');
	$mResult = $mysqli->query("Call rp_ControlAccount_Select ('".$_REQUEST['UserID']."','"
															   	.$_REQUEST['AccountID']."','"
															   	.$_REQUEST['AccountDesc']."',0,'"
															   	.$_REQUEST['GroupID']."')");

	$iStart = 0;
	$iTypeID = '';
	$iGroupID = '';
	$iAccountID = '';

	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					if ($iTypeID <> $ado["TypeID_id"])
						{
							if ($iStart==1) { $pdf->Ln(10); }
							$iStart=1;
							
							$iTypeID = $ado["TypeID_id"];
							$pdf->SetFont('Arial','B',9);
							$pdf->Cell(180,10,$ado["TypeDesc_tx"],1,0,'C');
							$pdf->Ln(5);
						}

					if ($iGroupID <> $ado["GroupID_cd"])
						{
							if ($iStart==1) { $pdf->Ln(5); }
							$iStart=1;
							
							$iGroupID = $ado["GroupID_cd"];
							$pdf->SetFont('Arial','BU',9);
							$pdf->Cell(180,5,$ado["GroupName_tx"],1,0,'L');
							$pdf->Ln(5);
						}

					if ($iAccountID <> $ado["AccountID_cd"])
						{
							$iAccountID = $ado["AccountID_cd"];

							$pdf->SetFont('Arial','',8);	
							$pdf->Cell(20,5,$ado["AccountID_cd"],1,0,'C');
							$pdf->Cell(100,5,$ado["AccountDesc_tx"],1,0,'L');
							IF ($ado["BalanceSheet_yn"]==1){ $bs='T';}ELSE{$bs='';}
							$pdf->Cell(20,5,$bs,1,0,'C');
							IF ($ado["IncomeStatement_yn"]==1){ $is='T';}ELSE{$is='';}
							$pdf->Cell(20,5,$is,1,0,'C');
							IF ($ado["CashFlow_yn"]==1){ $cf='T';}ELSE{$cf='';}
							$pdf->Cell(20,5,$cf,1,0,'C');
							$pdf->Ln(5);
						}						
				} 
		}
	mysqli_close($mysqli);
	$pdf->Output();
?>