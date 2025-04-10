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

					if ($_REQUEST['SubsidiaryNo']=='') 
						{ $mTitle3 = "";//fp_Get_Record("AccountDesc_tx","tb_mcoahdr","AccountID_cd=''".$_REQUEST['ControlNo']."''"); 
						}
					else 
						{ $mTitle3 = "";//fp_Get_Record("AccountDesc_tx","tb_mcoahdr","AccountID_cd=''".$_REQUEST['ControlNo']."''").' ('.
								//	 fp_Get_Record("SubsidiaryDesc_tx","tb_mcoadtl","SubsidiaryID_cd=''".$_REQUEST['SubsidiaryNo']."''").
								//	 ')'; 
						}



					$mTitle2 = 'For the Period '.$mTitle2;
					
					$mTitle1 = 'General Ledger';
				
					$this->SetFont('Arial','B',17);
					$this->Cell(100,10,$_SESSION["BranchName"],0,'L');
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
					$this->Ln(5);
					$this->Cell(0,20,$mTitle3,0,'L');

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
					$this->Cell(1,6,"",0,0,'C');
					$this->Cell(5,6,"NO.",1,0,'C');
					$this->Cell(20,6,"Account No.",1,0,'C');
					$this->Cell(80,6,"Account Name",1,0,'C');
					$this->Cell(30,6,"SubAccount No.",1,0,'C');
					$this->Cell(80,6,"SubAccount Name",1,0,'C');
					$this->Cell(30,6,"Debit",1,0,'C');
					$this->Cell(30,6,"Credit",1,0,'C');
					$this->Ln(6);					

				}

			function Footer()
				{
					$this->SetY(-15);
					$this->SetFont('Arial','',8);
					$this->SetTextColor(128);
					$this->Cell(0,10,$_SESSION["BranchAddress"],0,0,'C');
					$this->Ln(4);	
					$this->Cell(0,10,'Tel No '.$_SESSION["BranchTelNo"].'   Fax No '.$_SESSION["BranchFaxNo"].'   Email '.$_SESSION["BranchEmail"],0,0,'C');
				}
		}

	$pdf=new PDF();
	$pdf->AddPage();



	$mStartDate = $_REQUEST['Year1'].'-'.((int)$_REQUEST['Month1']).'-'.$_REQUEST['Day1'];
	$mEndDate = $_REQUEST['Year2'].'-'.((int)$_REQUEST['Month2']).'-'.$_REQUEST['Day2'];

	if (((int)$_REQUEST['Month1']-1)==1)
		{
			$mBegStartDate = "1900-12-31";
			$mBegEndDate = "1900-12-31";
		}
	else
		{											
			$mBegStartDate = $_REQUEST['Year1']."-01-01";
			$mBegEndDate = DateAdd("d", -0, $mStartDate);
		}




	include ("datasource_.php");
	$mResult = $mysqli->query("Call rp_GeneralLedger_Select_('".$_SESSION['S_UserID']."','"															 
															  .$_REQUEST['ControlNo']."','"
															  .$_REQUEST['SubsidiaryNo']."','"
															  .$_REQUEST['Journal']."','"
															  .$mStartDate."','"
															  .$mEndDate."','"
															  .$_REQUEST['Status']."')");

	$iMonth = '';
	$iStart = 0;
	$i = 0;
	$j = 0;
	$mTotalDebit = 0;
	$mTotalCredit = 0;			
	
	
	$mStartDate = date("F j",mktime(0,0,0,$_REQUEST['Month1'],$_REQUEST['Day1'],$_REQUEST['Year1']));
	$mEndDate = date("F j Y",mktime(0,0,0,$_REQUEST['Month2'],$_REQUEST['Day2'],$_REQUEST['Year2']));


	$mBalance = 0;
	$mBalanceDesc = '';

	if (mysqli_num_rows($mResult) > 0)
		{
			$NoSequence =0;
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					$NoSequence = $NoSequence + 1;
					$mTotalDebit = (float)$mTotalDebit + (float)$ado["Debit"];
					$mTotalCredit = (float)($mTotalCredit) + (float)$ado["Credit"];
					$mDebit = number_format($ado["Debit"],2);
					$mCredit = number_format($ado["Credit"],2);


					if ((float)$mDebit <= 0) { $mDebit = ''; }
					if ((float)$mCredit <= 0) { $mCredit = ''; }


					if ($_REQUEST['SubsidiaryNo']=='' && $ado['SubsidiaryDesc_tx']!='' || $ado['PaymasterName_tx']=='')
						{
							$mPayee = strtoupper($ado["SubsidiaryDesc_tx"]);
						}
					else
						{
							$mPayee = strtoupper($ado["PaymasterName_tx"]);
						}


					$pdf->SetFont('Arial','',8);	
					$pdf->Cell(1,6,'',0,0,'C');
					$pdf->Cell(5,6,$NoSequence.'.',1,0,'C');
					$pdf->Cell(20,6,$ado["Ref_tx"].$ado["DocNo_tx"],1,0,'L');
					$pdf->Cell(80,6,substr($ado["Reference_tx"],0,65).'...',1,0,'L');
					$pdf->Cell(30,6,$mPayee,1,0,'L');
					$pdf->Cell(80,6,$ado["Particular_tx"],1,0,'L');
					$pdf->Cell(30,6,$mDebit,1,0,'R');
					$pdf->Cell(30,6,$mCredit,1,0,'R');
					$pdf->Ln(6);


					$i = $i + 1;
				} 
			if ((float)$mTotalDebit > (float)$mTotalCredit)
				{
					$mBalance = number_format((float)$mTotalDebit - (float)$mTotalCredit,2);
					$mBalanceDesc = 'Balance Debit ';
				}
			if ((float)$mTotalDebit < (float)$mTotalCredit)
				{
					$mBalance = number_format(abs((float)$mTotalCredit - (float)$mTotalDebit),2);
					$mBalanceDesc = 'Balance Credit ';
				}


			$pdf->Cell(1,6,'',0,0,'C');
			$pdf->Cell(215,6,$mBalanceDesc.': '.$mBalance,1,0,'L');
			$pdf->Cell(30,6,number_format($mTotalDebit,2),1,0,'R');
			$pdf->Cell(30,6,number_format($mTotalCredit,2),1,0,'R');
			$pdf->Ln(20);	



			$pdf->SetFont('Arial','B',8);
	
			//$mTitle1 = fp_Get_Record("Title1_tx","tb_msignatory", "SignatoryID_cd = ''21''");
			//$mTitle2 = fp_Get_Record("Title2_tx","tb_msignatory", "SignatoryID_cd = ''21''");
			//$mTitle3 = fp_Get_Record("Title3_tx","tb_msignatory", "SignatoryID_cd = ''21''");
		
			/*$mEmployee1 = fp_Get_Record("EmployeeID1_cd","tb_msignatory", "SignatoryID_cd = ''21''");
			$mPosition1 = fp_Get_Record("PositionID_id","tb_mstaffstatus", "EmployeeID_cd = ''".$mEmployee1."''");
			$mEmployee1 = fp_Get_Record("FirstName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee1."''").' '.
						  fp_Get_Record("LastName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee1."''");
			
			$mEmployee2 = fp_Get_Record("EmployeeID2_cd","tb_msignatory", "SignatoryID_cd = ''21''");
			$mPosition2 = fp_Get_Record("PositionID_id","tb_mstaffstatus", "EmployeeID_cd = ''".$mEmployee2."''");
			$mEmployee2 = fp_Get_Record("FirstName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee2."''").' '.
						  fp_Get_Record("LastName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee2."''");
	
			$mEmployee3 = fp_Get_Record("EmployeeID3_cd","tb_msignatory", "SignatoryID_cd = ''21''");
			$mPosition3 = fp_Get_Record("PositionID_id","tb_mstaffstatus", "EmployeeID_cd = ''".$mEmployee3."''");
			$mEmployee3 = fp_Get_Record("FirstName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee3."''").' '.
						  fp_Get_Record("LastName_tx","tb_mstaffinfo", "EmployeeID_cd = ''".$mEmployee3."''");
		
			$mPosition1 = fp_Get_Record("PositionName_tx","tb_mposition", "PositionID_id = ".$mPosition1);
			$mPosition2 = fp_Get_Record("PositionName_tx","tb_mposition", "PositionID_id = ".$mPosition2);
			$mPosition3 = fp_Get_Record("PositionName_tx","tb_mposition", "PositionID_id = ".$mPosition3);
		
		
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
