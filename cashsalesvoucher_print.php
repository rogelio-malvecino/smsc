<?php
	session_cache_limiter('private');
	session_start();

	define('FPDF_FONTPATH','/var/www/html/smsc/font/');
	require('../global/fpdf.php');
	include ("../global/function.php");

	class PDF extends FPDF
		{
			function WriteText($text)
			{
				$intPosIni = 0;
				$intPosFim = 0;
				if (strpos($text,'<')!==false and strpos($text,'[')!==false)
				{
					if (strpos($text,'<')<strpos($text,'['))
					{
						$this->Write(5,substr($text,0,strpos($text,'<')));
						$intPosIni = strpos($text,'<');
						$intPosFim = strpos($text,'>');
						$this->SetFont('Arial','BUI',9);
						$this->Write(5,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
						$this->SetFont('Arial','',9);
						$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
					}
					else
					{
						$this->Write(5,substr($text,0,strpos($text,'[')));
						$intPosIni = strpos($text,'[');
						$intPosFim = strpos($text,']');
						$w=$this->GetStringWidth('a')*($intPosFim-$intPosIni-1);
						$this->Cell($w,$this->FontSize+0.75,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1),1,0,'');
						$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
					}
				}
				else
				{
					if (strpos($text,'<')!==false)
					{
						$this->Write(5,substr($text,0,strpos($text,'<')));
						$intPosIni = strpos($text,'<');
						$intPosFim = strpos($text,'>');
						$this->SetFont('Arial','BUI',9);
						$this->WriteText(substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
						$this->SetFont('Arial','',9);
						$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
					}
					elseif (strpos($text,'[')!==false)
					{
						$this->Write(5,substr($text,0,strpos($text,'[')));
						$intPosIni = strpos($text,'[');
						$intPosFim = strpos($text,']');
						$w=$this->GetStringWidth('a')*($intPosFim-$intPosIni-1);
						$this->Cell($w,$this->FontSize+0.75,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1),1,0,'');
						$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
					}
					else
					{
						$this->Write(5,$text);
					}
			
				}
			}

			function PDF($orientation='P',$unit='mm',$format='A4')
				{
					$this->FPDF($orientation,$unit,$format);
				}

			function Header()
				{

					$mDate = fp_Get_Record_("CSDate_dt","tb_tcashsaleshdr", "CSID_cd = ''".$_REQUEST['ControlNo']."''");
					$mParticular = fp_Get_Record_("Particular_tx","tb_tcashsaleshdr", "CSID_cd = ''".$_REQUEST['ControlNo']."''");
					$mReference = fp_Get_Record_("ReferenceID_cd","tb_tcashsaleshdr", "CSID_cd = ''".$_REQUEST['ControlNo']."''");

					$this->SetFont('Arial','B',18);
					$this->Cell(100,10,$_SESSION["BranchName"],0,'L');
					$this->Cell(6);
					$this->Ln(2);
					$this->SetFont('Arial','',9);
					$this->SetTextColor(0);
					$this->Cell(100,20,$_SESSION["BranchAddress"],0,'L');
					$this->Ln(4);
					$this->Cell(100,20,'Tel No '.$_SESSION["BranchTelNo"].'   Fax No '.$_SESSION["BranchFaxNo"].'   Email '.$_SESSION["BranchEmail"],0,'L');

					$this->SetFont('Arial','',12);	
					$this->Ln(9);
					$this->Cell(132);
					$this->Cell(24,7,'Cash Sales',0,0,'L');			
					$this->Ln(7);
					$this->Cell(132);
					$this->Cell(24,7,'CS No      ',0,0,'L');		
					$this->Cell(8,7,':     ');						
					$this->SetFont('Arial','B',12);
					$this->Cell(28,7,$_REQUEST['ControlNo'],0,0,'R');	
					//$this->Line(141, 32, 203, 32);						//top line
					//$this->Line(141, 32, 141, 38);						//left line
					//$this->Line(141, 38, 203, 38);						//bottom line
					//$this->Line(203, 32, 203, 38);						//right line
					$this->Ln(14);					

					$this->SetFont('Arial','',10);
					$this->Cell(15,7,'');						//payee caption
					$this->Cell(5);
					$this->SetFont('Arial','B',12);
					$this->Cell(90,7,'',0,0,'L');	//payee data
					$this->SetFont('Arial','',10);							
					$this->Cell(3,7,']');
					$this->Cell(19);
					$this->Cell(24,7,'Date      ');							//date today
					$this->Cell(8,7,':     ');
					$this->SetFont('Arial','',11);
					$this->Cell(15,7,$mDate,0,0,'L');			//date today data
					$this->Line(173, 52, 203, 52);							//date today underline

					$this->Ln(5);					
					$this->SetFont('Arial','',9);
					$this->Cell(15,7,'            ');
					$this->Cell(5);
					$this->SetFont('Arial','',10);
					$this->Cell(90,7,'',0,0,'L');	
					$this->Cell(22);
					$this->SetFont('Arial','',10);
					$this->Cell(24,7,'Reference No');								
					$this->Cell(8,7,':     ');
					$this->SetFont('Arial','',12);
					$this->Cell(20,7,$mReference,0,0,'L');				
					$this->Line(173, 57, 203, 57);	

					$this->Ln(12);					
					$this->SetFont('Arial','',8);
					$this->WriteText("Amount of: <".$_REQUEST['AmountWords'].">");
					$this->Ln(5);					
					$this->WriteText("in: <".$mParticular.">");
									 
					$this->Ln(15);
					$this->SetFont('Arial','B',7);
					$this->Cell(25,5,'Code',0,0,'C');
					$this->Cell(100,5,'Account Description',0,0,'C');
					$this->Cell(35,5,'Debit',0,0,'C');
					$this->Cell(35,5,'Credit',0,0,'C');
					$this->Line(11, 88, 203, 88);
				}

			function Footer()
				{
					$this->SetY(-50);
					$this->SetFont('Arial','',9);
					$this->Line(11, 247, 203, 247);
					$this->Cell(5);
					$this->Cell(22,5,'Prepared By:',0,0,'C');
					$this->Cell(10);
					$this->Cell(22,5,'Issued By:',0,0,'C');
					$this->Cell(10);
					$this->Cell(22,5,'Checked By:',0,0,'C');
					$this->Cell(10);
					$this->Cell(22,5,'Approved By:',0,0,'C');
					$this->Cell(10);
					$this->Cell(22,5,'Received By:',0,0,'C');
					$this->Cell(10);
					$this->Cell(22,5,'Total:',0,0,'C');
					$this->Cell(2);
					$this->Line(11, 260, 203, 260);
					
					$this->Line(11, 247, 11, 260);

					$this->Line(42, 247, 42, 260);
					$this->Line(73, 247, 73, 260);
					$this->Line(105, 247, 105, 260);
					$this->Line(138, 247, 138, 260);
					$this->Line(172, 247, 172, 260);

					$this->Line(203, 247, 203, 260);


					$this->Ln(7);	
					$this->SetFont('Arial','',10);
					$this->Cell(1);
					$this->Cell(28,5,strtoupper($_SESSION['UserName']),0,0,'C');
					$this->Cell(130);
					$this->SetFont('Arial','B',10);
					$this->Cell(35,5,number_format($_REQUEST['Amount'],2),0,0,'C');

					$this->Ln(16);	
					$this->Ln(5);	
					$this->SetFont('Arial','',8);
					$this->Cell(120);
					$this->Cell(60,5,'',0,0,'C');
					$this->Ln(3);	
					$this->Cell(120);
					$this->Cell(60,5,'',0,0,'C');

					$this->Ln(3);	
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					$this->Cell(60,5,'Run Date:     '.date("F j, Y h:i:s A"),0,0,'L');
					$this->Cell(70);
					$this->Ln(3);	
					
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					$this->Cell(0,10,'',0,0,'C');
					$this->Ln(4);	
					$this->Cell(0,10,'',0,0,'C');
				}
		}

	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->Ln(3);	


	include('datasource_.php');
	$mResult = $mysqli->query("Call rp_CashSalesVoucher_Select ('".$_SESSION['UserID']."',"
															      .$_SESSION['CenterID'].",'"
															   	  .$_REQUEST['ControlNo']."')");
	$mTotal = 0;
	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					$mDebit = '';
					$mCredit = '';
					if (number_format($ado["DebitAmount_no"],2) > 0) 
						{
							$mDebit = number_format($ado["DebitAmount_no"],2);							
						}
					if (number_format($ado["CreditAmount_no"],2) > 0) 
						{
							$mCredit = number_format($ado["CreditAmount_no"],2);							
						}
						
					$pdf->SetFont('Arial','',7);	
					$pdf->Cell(25,10,$ado["AccountID"],0,0,'L');
					$pdf->Cell(100,10,substr($ado["AccountDesc"],0,80),0,0,'L');
					$pdf->Cell(35,10,$mDebit,0,0,'R');
					$pdf->Cell(35,10,$mCredit,0,0,'R');
					$pdf->Ln(4);
				}
		}
	mysqli_close($mysqli);
	$pdf->Output();
?>
