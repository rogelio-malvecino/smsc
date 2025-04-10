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
			function PDF($orientation='P',$unit='mm',$format='Letter')
				{
					$this->FPDF($orientation,$unit,$format);
				}
			
			function Header()
				{

					$mPeriod = date("F Y", mktime(0,0,0, $_REQUEST["Month1"], 0, $_REQUEST["Year1"]));
					$mMonth = date("F", mktime(0,0,0, $_REQUEST["Month1"], 0, 0));

					$mTitle1 = 'Cash Flow Statement';
					$mTitle2 = 'As of '.$mPeriod;
				
					$this->SetFont('Arial','B',17);
					$this->Cell(0,10,$_SESSION['S_CompanyName'],0,0,'C');
					$this->Ln(2);
					$this->SetFont('Arial','',12);
					$this->Cell(0,20,$mTitle1,0,0,'C');
					$this->Ln(5);
					$this->Cell(0,20,$mTitle2,0,0,'C');
					$this->Ln(10);

					$this->SetFont('Arial','B',11);
					$this->Cell(130);
					$this->Cell(65,10,$mMonth,0,0,'C');
					$this->Ln(5);
					$this->Cell(130);
					//$this->Cell(30,10,((int)$_REQUEST["Year1"]-1),0,0,'C');
					$this->Cell(30,10,"",0,0,'C');
					$this->Cell(5,10,"",0,0,'C');
					$this->Cell(30,10,$_REQUEST["Year1"],0,0,'C');
					
					//$this->Line(139,40,169,40);
					$this->Line(175,40,205,40);
					
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


	//$pdf->Ln(5);	
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(80,10,"Operations Activities",0,0,'L');
	$pdf->Ln(7);

	
	$mMonth2 = intval(date("m", mktime(0,0,0, $_REQUEST["Month1"], 0, $_REQUEST["Year1"])));
	$mYear2 = intval(date("Y", mktime(0,0,0, $_REQUEST["Month1"], 0, $_REQUEST["Year1"])));
	$mMonth1 = intval(date("m", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-1))));
	$mYear1 = intval(date("Y", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-1))));
	$mStatus = $_REQUEST['Status'];

	

//Operations (IN)
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_CashFlow_Select ('1',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount = "";
	$mCurrentAmount = "";
	$mOperationIn = 0;
	$mOperationOut = 0;
	$mOperationIn_ = 0;
	$mOperationOut_ = 0;

	
//get the net income
	$mNetIncomeLastAmount = Get_Income_CurrentYear($mMonth1,$mYear1,$mMonth1,$mYear1,$mStatus); //fp_Get_FSIncome($mMonth3_,$mYear3_,$mStatus)
	$mNetIncomeCurrentAmount = Get_Income_CurrentYear($mMonth1,$mYear1,$mMonth2,$mYear2,$mStatus); //get amount from current year	
		
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(5);
			$pdf->Cell(125,4,"Net Income",0,0,'L');
			//$pdf->Cell(30,4,number_format($mNetIncomeLastAmount,2),0,0,'R');
			$pdf->Cell(30,4,"",0,0,'R');
			$pdf->Cell(5,4,"");
			$pdf->Cell(30,4,number_format($mNetIncomeCurrentAmount,2),0,0,'R');
			$pdf->Ln(4);
			$mOperationIn = $mNetIncomeLastAmount;
			$mOperationIn_ = $mNetIncomeCurrentAmount;
					
	
	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";
	
					$mOperationIn = floatval($mOperationIn) + floatval($ado["LastAmount_no"]); 
					$mOperationIn_ = floatval($mOperationIn_) + floatval($ado["CurrentAmount_no"]); 
										
					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {

					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					//$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(30,4,"",0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,$mCurrentAmount,0,0,'R');
					$pdf->Ln(4);

					}
										
				}
		}
	mysqli_close($mysqli);



//operations (OUT)
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_CashFlow_Select ('2',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount = "";
	$mCurrentAmount = "";


	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";
	
					$mOperationOut = floatval($mOperationOut) + floatval($ado["LastAmount_no"]); 
					$mOperationOut_ = floatval($mOperationOut_) + floatval($ado["CurrentAmount_no"]); 
					
					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					//$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(30,4,"",0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,"(".$mCurrentAmount.")",0,0,'R');
					$pdf->Ln(4);
					}
				}
		}
	mysqli_close($mysqli);

				$netoperations = floatval($mOperationIn) - floatval($mOperationOut);
				$netoperations_ = floatval($mOperationIn_) - floatval($mOperationOut_);

					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(5);
					$pdf->Cell(125,4,"Net Cash Flow from Operations",0,0,'L');
					//$pdf->Cell(30,4,$netoperations,0,0,'R');
					$pdf->Cell(30,4,"",0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,number_format($netoperations_,2),0,0,'R');
					$pdf->Ln(4);


	
	
	
	
	
	
	
	



//investing activities (IN)
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(80,10,"Investing Activities",0,0,'L');
	$pdf->Ln(7);
	
	$mLastAmount = "";
	$mCurrentAmount = "";

	$mInvestingIn = 0;
	$mInvestingOut = 0;
	$mInvestingIn_ = 0;
	$mInvestingOut_ = 0;

	include('datasource.php');
	$mResult = $mysqli->query("Call rp_CashFlow_Select ('3',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount = "";
	$mCurrentAmount = "";

	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";
	
					$mInvestingIn = floatval($mInvestingIn) - floatval($ado["LastAmount_no"]); 
					$mInvestingIn_ = floatval($mInvestingIn_) - floatval($ado["CurrentAmount_no"]); 
										

					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {

					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					//$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(30,4,"",0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,$mCurrentAmount,0,0,'R');
					$pdf->Ln(4);
					}
				}
		}
	mysqli_close($mysqli);




//Investing Activities (OUT)
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_Cashflow_Select ('4',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount = "";
	$mCurrentAmount = "";
	

	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";
	
					$mInvestingOut = floatval($mInvestingOut) + floatval($ado["LastAmount_no"]); 
					$mInvestingOut_ = floatval($mInvestingOut_) + floatval($ado["CurrentAmount_no"]); 
					
					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {
					
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					//$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(30,4,"",0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,"(".$mCurrentAmount.")",0,0,'R');
					$pdf->Ln(4);
					}
				}
		}
	mysqli_close($mysqli);

				$netinvesting = floatval($mInvenstingIn) - floatval($mInvestingOut);
				$netinvesting_ = floatval($mInvestingIn_) - floatval($mInvestingOut_);

					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(5);
					$pdf->Cell(125,4,"Net Cash Flow from Investing",0,0,'L');
					//$pdf->Cell(30,4,$netinvesting,0,0,'R');
					$pdf->Cell(30,4,"",0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,number_format($netinvesting_,2),0,0,'R');
					$pdf->Ln(4);
					
					

//financing activities (IN)
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(80,10,"Financing Activities",0,0,'L');
	$pdf->Ln(7);
	
	$mLastAmount = "";
	$mCurrentAmount = "";

	$mFinancingIn = 0;
	$mFinancingOut = 0;
	$mFinancingIn_ = 0;
	$mFinancingOut_ = 0;

	include('datasource.php');
	$mResult = $mysqli->query("Call rp_CashFlow_Select ('5',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";
	
					$mFinancingIn = floatval($mFinancingIn) + floatval($ado["LastAmount_no"]); 
					$mFinancingIn_ = floatval($mFinancingIn_) + floatval($ado["CurrentAmount_no"]); 
					
					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {
					
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					//$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(30,4,"",0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,$mCurrentAmount,0,0,'R');
					$pdf->Ln(4);
					}
				}
		}
	mysqli_close($mysqli);


//financing activities (OUT)

	include('datasource.php');
	$mResult = $mysqli->query("Call rp_CashFlow_Select ('6',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount = "";
	$mCurrentAmount = "";
	
	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";
	
					$mFinancingOut = floatval($mFinancingOut) + floatval($ado["LastAmount_no"]); 
					$mFinancingOut_ = floatval($mFinancingOut_) + floatval($ado["CurrentAmount_no"]); 
					
					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {
					
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					//$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(30,4,"",0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,"(".$mCurrentAmount.")",0,0,'R');
					$pdf->Ln(4);
					}
				}
		}
	mysqli_close($mysqli);


				$netFinancing = floatval($mFinancingIn) - floatval($mFinacingOut);
				$netFinancing_ = floatval($mFinancingIn_) - floatval($mFinancingOut_);

					$pdf->SetFont('Arial','B',9);
					$pdf->Cell(5);
					$pdf->Cell(125,4,"Net Cash Flow from Financing",0,0,'L');
					$pdf->Cell(30,4,"",0,0,'R');
					//$pdf->Cell(30,4,$netFinancing,0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,number_format($netFinancing_,2),0,0,'R');
					$pdf->Ln(4);
					
	


	$NetCashFlow  = $netOperations + $netInvesting + $netFinancing;
	$NetCashFlow_ = $netOperations_ + $netInvesting_ + $netFinancing_;
	
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(130,4,"NET CASH FLOW",0,0,'L');
	$pdf->Cell(30,4,"",0,0,'R');
	//$pdf->Cell(30,4,$NetCashFlow,0,0,'R');
	$pdf->Cell(5,4,"");
	$pdf->Cell(30,4,number_format($NetCashFlow_,2),0,0,'R');
	$pdf->Ln(4);
						


	$pdf->Output();
?>
