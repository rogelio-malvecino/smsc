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

					$mTitle1 = 'BALANCE SHEET';
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
					$this->Cell(30,10,((int)$_REQUEST["Year1"]-1),0,0,'C');
					$this->Cell(5,10,"",0,0,'C');
					$this->Cell(30,10,$_REQUEST["Year1"],0,0,'C');
					
					$this->Line(139,40,169,40);
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
	$pdf->Cell(80,10,"ASSETS",0,0,'L');
	$pdf->Ln(7);

	
	$mMonth2 = intval(date("m", mktime(0,0,0, $_REQUEST["Month1"], 0, $_REQUEST["Year1"])));
	$mYear2 = intval(date("Y", mktime(0,0,0, $_REQUEST["Month1"], 0, $_REQUEST["Year1"])));
	$mMonth1 = intval(date("m", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-1))));
	$mYear1 = intval(date("Y", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-1))));
	$mStatus = $_REQUEST['Status'];

//ASSETS
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_BalanceSheet_Select ('1',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount = "";
	$mCurrentAmount = "";
	$mTotalAsset1 = 0;
	$mTotalAsset2 = 0;
	$mTotalAsset1_ = 0;
	$mTotalAsset2_ = 0;

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
	
					$mTotalAsset1 = floatval($mTotalAsset1) + floatval($ado["LastAmount_no"]); 
					$mTotalAsset2 = floatval($mTotalAsset2) + floatval($ado["CurrentAmount_no"]); 
										
					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {

					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,$mCurrentAmount,0,0,'R');
					$pdf->Ln(4);

					}
										
				}
		}
	mysqli_close($mysqli);


	$mTotalAsset1_ = floatval($mTotalAsset1_) + floatval($mTotalAsset1);
	$mTotalAsset2_ = floatval($mTotalAsset2_) +floatval($mTotalAsset2);


	if (floatval($mTotalAsset1) > 0) { $mTotalAsset1 = number_format($mTotalAsset1,2); }
	elseif (floatval($mTotalAsset1) < 0) { $mTotalAsset1 = "(".number_format(abs($mTotalAsset1),2).")"; }		
	else $mTotalAsset1 = "-";

	if (floatval($mTotalAsset2) > 0) { $mTotalAsset2 = number_format($mTotalAsset2,2); }
	elseif (floatval($mTotalAsset2) < 0) { $mTotalAsset2 = "(".number_format(abs($mTotalAsset2),2).")"; }		
	else $mTotalAsset2 = "-";

	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(5);
	$pdf->Cell(125,6,"TOTAL: CURRENT ASSET",0,0,'L');
	//$pdf->SetFont('Arial','BU',10);
	$pdf->Cell(30,6,$mTotalAsset1,0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,6,$mTotalAsset2,0,0,'R');
	$pdf->Ln(1);
	//line
	$pdf->Cell(5);
	$pdf->Cell(125);
	$pdf->Cell(30,4,'______________',0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,4,'______________',0,0,'R');
	$pdf->Ln(10);









	include('datasource.php');
	$mResult = $mysqli->query("Call rp_BalanceSheet_Select ('2',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount = "";
	$mCurrentAmount = "";
	$mTotalFixed1 = 0;
	$mTotalFixed2 = 0;

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
	
					$mTotalFixed1 = floatval($mTotalFixed1) + floatval($ado["LastAmount_no"]); 
					$mTotalFixed2 = floatval($mTotalFixed2) + floatval($ado["CurrentAmount_no"]); 
					
					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,$mCurrentAmount,0,0,'R');
					$pdf->Ln(4);
					}
				}
		}
	mysqli_close($mysqli);








	include('datasource.php');
	$mResult = $mysqli->query("Call rp_BalanceSheet_Select ('3',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

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
	
					$mTotalFixed1 = floatval($mTotalFixed1) - floatval($ado["LastAmount_no"]); 
					$mTotalFixed2 = floatval($mTotalFixed2) - floatval($ado["CurrentAmount_no"]); 
										

					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {

					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,$mCurrentAmount,0,0,'R');
					$pdf->Ln(4);
					}
				}
		}
	mysqli_close($mysqli);
	//Draw a line
	$pdf->Ln(1);
	$pdf->Cell(5);
	$pdf->Cell(125);
	$pdf->Cell(30,4,"_________________",0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,4,"_________________",0,0,'R');
	$pdf->Ln(4);



	$mTotalAsset1_ = floatval($mTotalAsset1_) + floatval($mTotalFixed1);
	$mTotalAsset2_ = floatval($mTotalAsset2_) +floatval($mTotalFixed2);



	if (floatval($mTotalFixed1) > 0) { $mTotalFixed1 = number_format($mTotalFixed1,2); }
	elseif (floatval($mTotalFixed1) < 0) { $mTotalFixed1 = "(".number_format(abs($mTotalFixed1),2).")"; }		
	else $mTotalFixed1 = "-";

	if (floatval($mTotalFixed2) > 0) { $mTotalFixed2 = number_format($mTotalFixed2,2); }
	elseif (floatval($mTotalFixed2) < 0) { $mTotalFixed2 = "(".number_format(abs($mTotalFixed2),2).")"; }		
	else $mTotalFixed2 = "-";

	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(5);
	$pdf->Cell(125,6,"TOTAL: FIXED ASSET",0,0,'L');
	//$pdf->SetFont('Arial','BU',10);
	$pdf->Cell(30,6,$mTotalFixed1,0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,6,$mTotalFixed2,0,0,'R');
	$pdf->Ln(1);
	//draw a line
	$pdf->Cell(5);
	$pdf->Cell(125);
	$pdf->Cell(30,4,'______________',0,0,'R');
	$pdf->Cell(5);	
	$pdf->Cell(30,4,'______________',0,0,'R');
	$pdf->Ln(10);











	include('datasource.php');
	$mResult = $mysqli->query("Call rp_BalanceSheet_Select ('4',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount = "";
	$mCurrentAmount = "";
	$mTotalOther1 = 0;
	$mTotalOther2 = 0;

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
	
					$mTotalOther1 = floatval($mTotalOther1) + floatval($ado["LastAmount_no"]); 
					$mTotalOther2 = floatval($mTotalOther2) + floatval($ado["CurrentAmount_no"]); 
					
					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {
					
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,$mCurrentAmount,0,0,'R');
					$pdf->Ln(4);
					}
				}
		}
	mysqli_close($mysqli);



	$mTotalAsset1_ = floatval($mTotalAsset1_) + floatval($mTotalOther1);
	$mTotalAsset2_ = floatval($mTotalAsset2_) + floatval($mTotalOther2);



	if (floatval($mTotalOther1) > 0) 
		{ $mTotalOther1 = number_format($mTotalOther1,2); }
	elseif (floatval($mTotalOther1) < 0) 
		{ $mTotalOther1 = "(".number_format(abs($mTotalOther1),2).")"; }		
	else $mTotalOther1 = "-";

	if (floatval($mTotalOther2) > 0) 
		{ $mTotalOther2 = number_format($mTotalOther2,2); }
	elseif (floatval($mTotalOther2) < 0) 
		{ $mTotalOther2 = "(".number_format(abs($mTotalOther2),2).")"; }		
	else $mTotalOther2 = "-";





	if (floatval($mTotalAsset1_) > 0) 	
		{ $mTotalAsset1 = number_format($mTotalAsset1_,2); }
	elseif (floatval($mTotalAsset1_) < 0) 
		{ $mTotalAsset1 = "(".number_format(abs($mTotalAsset1_),2).")"; }		
	else $mTotalAsset1 = "-";

	if (floatval($mTotalAsset2_) > 0) 
		{ $mTotalAsset2 = number_format($mTotalAsset2_,2); }
	elseif (floatval($mTotalAsset2_) < 0) 
		{ $mTotalAsset2 = "(".number_format(abs($mTotalAsset2_),2).")"; }		
	else $mTotalAsset2 = "-";

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(5);
	$pdf->Cell(125,6,"TOTAL ASSETS:",0,0,'L');
	$pdf->Cell(30,6,$mTotalAsset1,0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,6,$mTotalAsset2,0,0,'R');
	//Double line
	$pdf->Ln(2);
	$pdf->Cell(5);
	$pdf->Cell(125);
	$pdf->Cell(30,4,"____________",0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,4,"____________",0,0,'R');
	$pdf->Ln(2);
	$pdf->Cell(5);
	$pdf->Cell(125);
	$pdf->Cell(30,4,"____________",0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,4,"____________",0,0,'R');

	$pdf->Ln(10);
	




//LIABILITIES
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(80,10,"LIABILITIES",0,0,'L');
	$pdf->Ln(7);


	include('datasource.php');
	$mResult = $mysqli->query("Call rp_BalanceSheet_Select ('5',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount = "";
	$mCurrentAmount = "";
	$mTotalLiabilities1 = 0;
	$mTotalLiabilities2 = 0;
	$mTotalEquity1 = 0; 
	$mTotalEquity2 = 0; 

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
	
					$mTotalLiabilities1 = floatval($mTotalLiabilities1) + floatval($ado["LastAmount_no"]); 
					$mTotalLiabilities2 = floatval($mTotalLiabilities2) + floatval($ado["CurrentAmount_no"]); 
					
					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {
					
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,$mCurrentAmount,0,0,'R');
					$pdf->Ln(4);
					}
				}
		}
	mysqli_close($mysqli);
	$pdf->Ln(1);
	//draw a line
	$pdf->Cell(5);
	$pdf->Cell(125);
	$pdf->Cell(30,4,'________________',0,0,'R');
	$pdf->Cell(5);	
	$pdf->Cell(30,4,'________________',0,0,'R');
	$pdf->Ln(4);

	$mTotalEquity1 = floatval($mTotalEquity1) + floatval($mTotalLiabilities1); 
	$mTotalEquity2 = floatval($mTotalEquity2) + floatval($mTotalLiabilities2); 


	if (floatval($mTotalLiabilities1) > 0) { $mTotalLiabilities1 = number_format($mTotalLiabilities1,2); }
	elseif (floatval($mTotalLiabilities1) < 0) { $mTotalLiabilities1 = "(".number_format(abs($mTotalLiabilities1),2).")"; }		
	else $mTotalLiabilities1 = "-";

	if (floatval($mTotalLiabilities2) > 0) { $mTotalLiabilities2 = number_format($mTotalLiabilities2,2); }
	elseif (floatval($mTotalLiabilities2) < 0) { $mTotalLiabilities2 = "(".number_format(abs($mTotalLiabilities2),2).")"; }		
	else $mTotalLiabilities2 = "-";





	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(5);
	$pdf->Cell(125,6,"TOTAL LIABILITIES:",0,0,'L');
	//$pdf->SetFont('Arial','BU',10);
	$pdf->Cell(30,6,$mTotalLiabilities1,0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,6,$mTotalLiabilities2,0,0,'R');
	$pdf->Ln(1);
	//draw a line
	$pdf->Cell(5);
	$pdf->Cell(125);
	$pdf->Cell(30,4,'_____________',0,0,'R');
	$pdf->Cell(5);	
	$pdf->Cell(30,4,'_____________',0,0,'R');

	$pdf->Ln(10);





	$mMonth1_ = intval(date("m", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-2))));
	$mYear1_ = intval(date("Y", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-2))));

	$mMonth2_ = intval(date("m", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-1))));
	$mYear2_ = intval(date("Y", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-1))));

	$mMonth3_ = intval(date("m", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-1))));
	$mYear3_ = intval(date("Y", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-1))));

	$mMonth4_ = intval(date("m", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-0))));
	$mYear4_ = intval(date("Y", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-0))));




//get the  income previous year from the journal entry
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_BalanceSheet_Select ('6',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount1 = "";
	$mCurrentAmount1 = "";

	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					$mLastAmount1 = floatval($mLastAmount1) + floatval($ado["LastAmount_no"]); 
					$mCurrentAmount1 = floatval($mCurrentAmount1) + floatval($ado["CurrentAmount_no"]); 
				}
		}
	mysqli_close($mysqli);



	$mLastAmount2 = Get_Income_CurrentYear($mMonth1_,$mYear1_,$mMonth2_,$mYear2_,$mStatus); //fp_Get_FSIncome($mMonth3_,$mYear3_,$mStatus);
	$mCurrentAmount2 = Get_Income_CurrentYear($mMonth1,$mYear1,$mMonth2,$mYear2,$mStatus); //get amount from current year	

	$mTotalEquity1 = floatval($mTotalEquity1) + floatval($mLastAmount1); 
	$mTotalEquity2 = floatval($mTotalEquity2) + floatval($mCurrentAmount1); 


	$mTotalEquity1 = floatval($mTotalEquity1) + floatval($mLastAmount2); 
	$mTotalEquity2 = floatval($mTotalEquity2) + floatval($mCurrentAmount2); 

	if (floatval($mLastAmount1) > 0) 
		{ $mLastAmount1 = number_format($mLastAmount1,2); }
	elseif (floatval($mLastAmount1) < 0) 
		{ $mLastAmount1 = "(".number_format(abs($mLastAmount1),2).")"; }		
	else $mLastAmount1 = "-";

	if (floatval($mCurrentAmount1) > 0) 
		{ $mCurrentAmount1 = number_format($mCurrentAmount1,2); }
	elseif (floatval($mCurrentAmount1) < 0) 
		{ $mCurrentAmount1 = "(".number_format(abs($mCurrentAmount1),2).")"; }		
	else $mCurrentAmount1 = "-";




	if (floatval($mLastAmount2) > 0) 
		{ $mLastAmount2 = number_format($mLastAmount2,2); }
	elseif (floatval($mLastAmount2) < 0) 
		{ $mLastAmount2 = "(".number_format(abs($mLastAmount2),2).")"; }		
	else $mLastAmount2 = "-";

	if (floatval($mCurrentAmount2) > 0) 
		{ $mCurrentAmount2 = number_format($mCurrentAmount2,2); }
	elseif (floatval($mCurrentAmount2) < 0) 
		{ $mCurrentAmount2 = "(".number_format(abs($mCurrentAmount2),2).")"; }		
	else $mCurrentAmount2 = "-";





	$pdf->SetFont('Arial','B',10);

	$pdf->Cell(80,10,"STOCKHOLDERS EQUITY",0,0,'L');
	$pdf->Ln(7);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(5);
	$pdf->Cell(125,4,"Capital - Beginning",0,0,'L');
	$pdf->Cell(30,4,$mLastAmount1,0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,4,$mCurrentAmount1,0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(5);
	$pdf->Cell(125,4,"Retained Earnings",0,0,'L');
	$pdf->Cell(30,4,$mLastAmount2,0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,4,$mCurrentAmount2,0,0,'R');
	$pdf->Ln(1);
	//draw a line
	$pdf->Cell(5);
	$pdf->Cell(125);
	$pdf->Cell(30,4,'________________',0,0,'R');
	$pdf->Cell(5);	
	$pdf->Cell(30,4,'________________',0,0,'R');

	$pdf->Ln(8);








	$pdf->Cell(125,4,'Less-Withdawals',0,0,'L');
	$pdf->Ln(4);


	include('datasource.php');
	$mResult = $mysqli->query("Call rp_BalanceSheet_Select ('7',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastAmount = "";
	$mCurrentAmount = "";
	$mTotalWithdrawal1_ = 0;
	$mTotalWithdrawal2_ = 0;

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
	
					$mTotalWithdrawal1_ = floatval($mTotalWithdrawal1_) + floatval($ado["LastAmount_no"]); 
					$mTotalWithdrawal2_ = floatval($mTotalWithdrawal2_) + floatval($ado["CurrentAmount_no"]); 
					
					if ($mLastAmount == '-'  &&  $mCurrentAmount =='-'){

					}
					else {
					
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(5);
					$pdf->Cell(125,4,$ado["AccountDesc_tx"],0,0,'L');
					$pdf->Cell(30,4,$mLastAmount,0,0,'R');
					$pdf->Cell(5,4,"");
					$pdf->Cell(30,4,$mCurrentAmount,0,0,'R');
					$pdf->Ln(4);
					}
				}
		}
	mysqli_close($mysqli);

	$mTotalEquity1 = floatval($mTotalEquity1) - floatval($mTotalWithdrawal1_); 
	$mTotalEquity2 = floatval($mTotalEquity2) - floatval($mTotalWithdrawal2_); 




	if (floatval($mTotalEquity1) > 0) { $mTotalEquity1 = number_format($mTotalEquity1,2); }
	elseif (floatval($mTotalEquity1) < 0) { $mTotalEquity1 = "(".number_format(abs($mTotalEquity1),2).")"; }		
	else $mTotalEquity1 = "-";

	if (floatval($mTotalEquity2) > 0) { $mTotalEquity2 = number_format($mTotalEquity2,2); }
	elseif (floatval($mTotalEquity2) < 0) { $mTotalEquity2 = "(".number_format(abs($mTotalEquity2),2).")"; }		
	else $mTotalEquity2 = "-";


	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(5);
	$pdf->Cell(125,4,"TOTAL LIABILITIES & STOCKHOLDERS' EQUITY",0,0,'L');
	$pdf->Cell(30,4,$mTotalEquity1,0,0,'R');
	$pdf->Cell(5,4,"");
	$pdf->Cell(30,4,$mTotalEquity2,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(5);
	$pdf->Cell(125);
	$pdf->Cell(30,4,"____________",0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,4,"____________",0,0,'R');
	$pdf->Ln(2);
	$pdf->Cell(5);
	$pdf->Cell(125);
	$pdf->Cell(30,4,"____________",0,0,'R');
	$pdf->Cell(5);
	$pdf->Cell(30,4,"____________",0,0,'R');

	$pdf->Ln(5);


	$pdf->Output();
?>
