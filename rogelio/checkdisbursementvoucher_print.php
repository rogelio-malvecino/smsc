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
						$this->SetFont('Arial','I',7);
						$this->Write(5,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
						$this->SetFont('Arial','I',7);
						$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
					}
					else
					{
						$this->Write(5,substr($text,0,strpos($text,'[')));
						$intPosIni = strpos($text,'[');
						$intPosFim = strpos($text,']');
						$w=$this->GetStringWidth('a')*($intPosFim-$intPosIni-1);
						$this->Cell($w,$this->FontSize+0.75,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1),1,0,'C');
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
						$this->SetFont('Arial','I',7);
						$this->WriteText(substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
						$this->SetFont('Arial','I',7);
						$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
					}
					elseif (strpos($text,'[')!==false)
					{
						$this->Write(5,substr($text,0,strpos($text,'[')));
						$intPosIni = strpos($text,'[');
						$intPosFim = strpos($text,']');
						$w=$this->GetStringWidth('a')*($intPosFim-$intPosIni-1);
						$this->Cell($w,$this->FontSize+0.75,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1),1,0,'C');
						$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
					}
					else
					{
						$this->Write(5,$text);
					}
			
				}
			}


			function WriteText_($text)
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
						$this->SetFont('Arial','B',8);
						$this->Write(5,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
						$this->SetFont('Arial','B',8);
						$this->WriteText(substr($text,$intPosFim+1,strlen($text)));
					}
					else
					{
						$this->Write(5,substr($text,0,strpos($text,'[')));
						$intPosIni = strpos($text,'[');
						$intPosFim = strpos($text,']');
						$w=$this->GetStringWidth('a')*($intPosFim-$intPosIni-1);
						$this->Cell($w,$this->FontSize+0.75,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1),1,0,'C');
						$this->WriteText_(substr($text,$intPosFim+1,strlen($text)));
					}
				}
				else
				{
					if (strpos($text,'<')!==false)
					{
						$this->Write(5,substr($text,0,strpos($text,'<')));
						$intPosIni = strpos($text,'<');
						$intPosFim = strpos($text,'>');
						$this->SetFont('Arial','B',8);
						$this->WriteText(substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
						$this->SetFont('Arial','B',8);
						$this->WriteText_(substr($text,$intPosFim+1,strlen($text)));
					}
					elseif (strpos($text,'[')!==false)
					{
						$this->Write(5,substr($text,0,strpos($text,'[')));
						$intPosIni = strpos($text,'[');
						$intPosFim = strpos($text,']');
						$w=$this->GetStringWidth('a')*($intPosFim-$intPosIni-1);
						$this->Cell($w,$this->FontSize+0.75,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1),1,0,'C');
						$this->WriteText_(substr($text,$intPosFim+1,strlen($text)));
					}
					else
					{
						$this->Write(5,$text);
					}
			
				}
			}


			function PDF($orientation='P',$unit='mm',$format='checke')
				{
					$this->FPDF($orientation,$unit,$format);
				}

			function Header()
				{
					$mPaymasterID = fp_Get_Record_("PaymasterID_cd","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
					$mPaymasterName = fp_Get_Record("PaymasterID_cd","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
					$mAddress = "";//fp_Get_Record("Address_tx","tb_mpaymaster", "PaymasterID_cd = ''".$mPaymasterID."''");
					$mDate = fp_Get_Record_("CDDATE_dt","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
					$mReferenceNo = fp_Get_Record_("CheckNo_tx","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
					$mParticular = fp_Get_Record_("Particular_tx","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
					$mAmount = fp_Get_Record_("Amount_no","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
					$mDate = date("F j, Y", mktime(0,0,0, substr($mDate,5,2), substr($mDate ,8,2), substr($mDate ,0,4)));
					$this->SetLeftMargin(6.5);

					$this->SetFont('Helvetica','BI',16);
					//$this->Cell(0,10,$_SESSION['S_CompanyName'],0,'L');
					$this->Ln(5);
					$this->SetFont('Arial','',7);
					$this->Cell(3);
					$this->Cell(0,10,"",0,0,'L');//$_SESSION["Address"]
					$this->Ln(3);	
					$this->Cell(3);
					$this->Cell(0,10,"",0,0,'L');
					$this->SetFont('Courier','B',14);	
					$this->Ln(10);
					$this->Cell(60,7,'',0,0,'L');			
					//$this->Cell(198,7,'CHECK VOUCHER',0,0,'L');			
					$this->Ln(4);
					$this->SetFont('Times','B',12);
					$this->Cell(146);
					//$this->Cell(14,7,'No ',0,0,'R');		
					//$this->Cell(5,7,':');						
					$this->SetFont('Times','B',12);
					//$this->Cell(28,7,$_REQUEST['ControlNo'],0,0,'L');	
					$this->Ln(5);					

					$this->SetFont('Times','B',8);
					$this->Cell(1);						
					$this->Cell(50,7,'PAY TO THE ORDER OF:',0,0,'L');						
					$this->Cell(64,7,'');						
					$this->Ln(2);	
					$this->Cell(119,7,'');						
					$this->Cell(35,7,'DATE:');							
					$this->SetFont('Arial','',8);
					$this->Cell(44,7,$mDate,0,0,'C');			
					$this->Ln(3);			

					$this->SetFont('Times','B',8);
					$this->Cell(1);						
					$this->Cell(114,7,$mPaymasterName,0,0,'C');	
					$this->SetFont('Times','B',8);
					$this->Ln(4);	
					$this->Cell(119,7,'');						
					$this->Cell(35,7,'BANK/CHECK NO:');						
					$this->SetFont('Arial','',8);
					$this->Cell(44,7,$mReferenceNo,0,0,'C');	
					$this->Ln(8);			
					

			
					$this->SetFont('Times','B',8);
					$this->Cell(1);
					$this->Cell(20,5,' ACCOUNT',0,0,'C');
					$this->Cell(80,5,'',0,0,'C');
					$this->Cell(50,5,'',0,0,'C');
					$this->Cell(50,5,'GENERAL LEDGER',0,0,'C');
					
					$this->Ln(4);
					$this->SetFont('Times','B',8);
					$this->Cell(1);
					$this->Cell(20,5,' CODE',0,0,'C');
					$this->Ln(-2);
					$this->Cell(1);
					$this->Cell(20,5,'',0,0,'C');
					$this->Cell(78,5,'ACCOUNT NAME',0,0,'C');
					$this->Ln(2);
					$this->SetFont('Times','BI',8);
					$this->Cell(1);
					$this->Cell(99,5,'',0,0,'C');
					$this->Cell(25,5,'',0,0,'C');
					$this->Cell(25,5,'',0,0,'C');
					$this->Cell(25,5,'Debit',0,0,'C');
					$this->Cell(25,5,'Credit',0,0,'C');
					
					$this->SetLineWidth(0.2);
					

					//$this->Line(8, 38, 206, 38); //first horizontal line
					//$this->Line(125, 46, 206, 46); //second horizontal line
					//$this->Line(8, 53, 206, 53); //fouth horizontal line

					//$this->Line(8, 38, 8, 58); //first vertical line
					//$this->Line(125, 38, 125, 53); //second vertical line
					//$this->Line(160, 38, 160, 53); //third vertical line
					//$this->Line(206, 38, 206, 58); //fourth vertical line





					//$this->Line(8, 54, 206, 54); //first horizontalline
					//$this->Line(105, 58, 206, 58);// second horizontal line
					//$this->Line(8, 62, 206, 62); //third horizontal line 
					//$this->Line(8, 153, 206, 153); //sixth horizontal line


					//$this->Line(8, 58, 8, 153); //first vertical line
					//$this->Line(206, 58, 206, 153); //seventh verticals line
				
					$this->Ln(4);
				}
			function Footer()
				{
					$this->SetY(-30);
					$mTitle1 = "Prepared By:";//fp_Get_Record("Title1_tx","tb_msignatory", "SignatoryID_cd = ''18''");
					$mTitle2 = "Checked By:";//fp_Get_Record("Title2_tx","tb_msignatory", "SignatoryID_cd = ''18''");
					$mTitle3 = "Aproved By:";//fp_Get_Record("Title3_tx","tb_msignatory", "SignatoryID_cd = ''18''");
					$mReferenceNo = fp_Get_Record_("CheckNo_tx","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
					

					$this->SetFont('Arial','',8);
					$this->Ln(4);
					//$this->Cell(35,4,"  Supplier's complaint & inquiries regarding payments shall be made in writing & filed within a" ,0,0,'L');
					$this->Ln(4);
					//$this->Cell(35,4,"  period of 30 days of collection otherwise any claims is deemed waived, abandoned & or forfeited.",0,0,'L');
					$this->Ln(1);
					$this->Line(8, 140, 206, 140);
					$this->SetFont('Times','B',9);
					$this->Cell(47,9,' '.$mReferenceNo,0,0,'L');
					$this->Cell(47,9,' '.$mTitle2,0,0,'L');
					$this->Cell(47,9,' '.$mTitle3,0,0,'L');
					$this->Cell(58,9,'Payment Received by:',0,0,'C');	
						
					$this->SetFont('Arial','B',8);
					$this->Ln(6);
					//$this->Cell(35,10,$_SESSION['FullName'],0,0,'C');
					$this->Cell(35,10,"",0,0,'C');
					$this->Cell(47,10,'',0,0,'C');
					$this->Cell(47,10,'',0,0,'C');
					
					$this->Ln(1);
					$this->SetFont('Arial','',6);
					$this->Cell(150,10);
					$this->Cell(47,10,'Signature Over Printed Name',0,0,'L');
					$this->Ln(-3);
					$this->Cell(150,10,'',0,0,'C');
					$this->Cell(47,10,'Date:',0,0,'L');
				
				}
		}

	$pdf=new PDF();
	$pdf->AddPage();


	include('datasource.php');
	$mResult = $mysqli->query("Call rp_CheckDisbursementVoucher_Select ('".$_SESSION['S_UserID']."','"
															   		      .$_REQUEST['ControlNo']."')");
	$mTotal = 0;
	$mAccountID = '';
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
					
						
					$pdf->SetFont('Arial','',8);	
					$pdf->Cell(1);
					$pdf->Cell(20,8,$ado["AccountID"],0,0,'C');
					
					if (floatval($ado["DebitAmount_no"]) > 0)
						{
							$pdf->Cell(8,8,'',0,0,'L');
							$pdf->Cell(72,8,substr($ado["AccountDesc_tx"],0,80),0,0,'L');
						}
					else
						{
							$pdf->Cell(8,8,'',0,0,'L');
							$pdf->Cell(60,8,substr($ado["AccountDesc_tx"],0,80),0,0,'L');
						}
						
					$pdf->Cell(70,8,$mDebit.' ',0,0,'R');
					$pdf->Cell(35,8,$mCredit.' ',0,0,'R');
					
					if ($ado["SubsidiaryDesc_tx"]!='')
						{
							$pdf->Ln(4);
							$pdf->Cell(20,8,'',0,0,'L');
							
							if (floatval($ado["DebitAmount_no"]) > 0)
								{
									$pdf->SetFont('Arial','I',8);	
									$pdf->Cell(11,8,'',0,0,'L');
									$pdf->Cell(70,8,substr($ado["SubsidiaryDesc_tx"],0,80),0,0,'L');
								}
							else
								{
									$pdf->SetFont('Arial','I',8);	
									$pdf->Cell(11,8,'',0,0,'L');
									$pdf->Cell(58,8,substr($ado["SubsidiaryDesc_tx"],0,80),0,0,'L');
								}

							$pdf->SetFont('Arial','',8);	
							$pdf->Cell(25,8,'',0,0,'R');
							$pdf->Cell(25,8,'',0,0,'R');		
							$pdf->Cell(25,8,' ',0,0,'R');
							$pdf->Cell(25,8,' ',0,0,'R');	
							$pdf->Ln(5);				
						}
					else
						{
							$pdf->Ln(5);
						}
												
					
				}
		}



					$mParticular = fp_Get_Record_("Particular_tx","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(100,7,' ',0,0,'L');
					$pdf->Cell(25,7,'',0,0,'R');
					$pdf->Cell(25,7,'',0,0,'R');
					$pdf->Cell(21,7,'',0,0,'R');
					$pdf->Cell(21,7,'',0,0,'R');
					$pdf->Ln(5.5);	
					
					$pdf->SetFont('Times','B',9);
					$pdf->WriteText_(" PARTICULARS: <".$mParticular.">");
					if (strlen($mParticular)>120)
						{
							$pdf->Ln(5);
						}
					else
						{
							$pdf->Ln(5);
						}
					$pdf->SetFont('Arial','BI',9);
					$pdf->Cell(32,7,'',0,0,'C');	
					$pdf->Cell(36,7,'In Words:',0,0,'L');	
					$pdf->Cell(75,7,'',0,0,'C');	
					$pdf->Cell(40,7,'In Figure:',0,0,'L');	

					$pdf->Ln(5);					
					$pdf->SetFont('Times','B',7);
					$pdf->Cell(1,7,'',0,0,'C');	
					$pdf->Cell(29,7,' PAY THIS AMOUNT =>',0,0,'L');	
					$pdf->Cell(1,7,'',0,0,'C');	
					$pdf->SetFont('Arial','',7);
					$pdf->WriteText("<".convert_number_to_words($_REQUEST["Amount"]).">");
					
					$pdf->Ln(2);					
					$pdf->SetFont('Times','B',10);
					$pdf->Cell(148,7,'',0,0,'C');	
					$pdf->Cell(3,7,'PHP',0,0,'L');	
					$pdf->Cell(10,7,'',0,0,'C');	
					$pdf->Cell(30,7,number_format($_REQUEST["Amount"],2),0,0,'R');	
					$pdf->Cell(8,7,'  ',0,0,'C');	


	mysqli_close($mysqli);
	$pdf->Output();
?>
