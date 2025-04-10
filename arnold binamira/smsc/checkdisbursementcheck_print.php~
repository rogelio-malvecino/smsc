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
						$this->SetFont('Arial','I',11);
						$this->Write(5,substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
						$this->SetFont('Arial','I',11);
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
						$this->SetFont('Arial','I',11);
						$this->WriteText(substr($text,$intPosIni+1,$intPosFim-$intPosIni-1));
						$this->SetFont('Arial','I',11);
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


			
			
			
			

			function PDF($orientation='P',$unit='mm',$format='Legal')
				{
					$this->FPDF($orientation,$unit,$format);
				}

			function Header()
				{

				include('datasource.php');
				$mResult = $mysqli->query("Call sp_CheckDisbursementVoucher_Verify('".$_SESSION['S_UserID']."','".$_REQUEST['ControlNo']."')");
					
				if (mysqli_num_rows($mResult) > 0)
					{
					while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{
						if (number_format($ado["db"],2) == number_format($ado["cr"],2)) 					
						{

					
							$mPaymasterID = fp_Get_Record_("PaymasterID_cd","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
							$mPaymasterName = fp_Get_Record("PaymasterID_cd","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
							$mDate = fp_Get_Record_("CDDate_dt","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
							$mAmount = fp_Get_Record_("Amount_no","tb_tcheckdisbursementhdr", "CDID_cd = ''".$_REQUEST['ControlNo']."''");
							$mDate = date("F j, Y", mktime(0,0,0, substr($mDate,5,2), substr($mDate ,8,2), substr($mDate ,0,4)));
							
							$this->SetFont('arial','',12);
							$this->Cell(145);
							$this->Cell(25,10,$mDate);
							$this->Ln(8);	
							$this->SetFont('arial','B',12);
							$this->Cell(20);
							$this->Cell(110,10,'**'.$mPaymasterName.'**');
							$this->Cell(20);
							$this->SetFont('arial','B',12);
							$this->Cell(40,10,'* P'.number_format($_REQUEST['Amount'],2).' *');
							$this->Ln(9);	
							$this->SetFont('arial','',12);
							$this->Cell(20);
							$this->Cell(45,9,''.strtoupper(convert_number_to_words($mAmount)).' ONLY');					
							$this->Cell(1);
							$this->Cell(150,9,'');
							
						}
						
						else
						{						
							$this->SetFont('arial','B',12);
							$this->Cell(20);
							$this->Cell(110,10,'**INVALID ENTRY**');
						
							
						}
					}
					}
				else
					{
							

					}					


				}
				
			function Footer()
				{
				}

		}
			
	$pdf=new PDF();
	$pdf->AddPage();	
	$pdf->Output();		
?>
