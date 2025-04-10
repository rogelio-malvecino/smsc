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

					$mPeriod = date("F Y", mktime(0,0,0, $_REQUEST["Month1"], 0, $_REQUEST["Year1"]));
					$mMonth = date("F", mktime(0,0,0, $_REQUEST["Month1"], 0, 0));

					$mTitle1 = 'COMPARATIVE INCOME STATEMENT';
					$mTitle2 = 'for the month of '.$mPeriod;
				
					$this->SetFont('Arial','B',17);
					$this->Cell(0,10,$_SESSION['S_CompanyName'],0,0,'C');
					$this->Ln(2);
					$this->SetFont('Arial','',12);
					$this->Cell(0,20,$mTitle1,0,0,'C');
					$this->Ln(5);
					$this->Cell(0,20,$mTitle2,0,0,'C');
					$this->Ln(15);

					$this->SetFont('Arial','B',8);
					$this->Cell(89);
					$this->Cell(25,10,"Last Year",0,0,'C');
					$this->Cell(2);
					$this->Cell(25,10,"Year to Date",0,0,'C');
					$this->Cell(2);
					$this->Cell(25,10,"This Month",0,0,'C');
					$this->Cell(2);
					$this->Cell(25,10,"Year to Date",0,0,'C');
					$this->Ln(4);
					$this->Cell(89);
					$this->Cell(25,10,$mMonth.' '.((int)$_REQUEST["Year1"]-1),0,0,'C');
					$this->Cell(2);
					$this->Cell(25,10,"Last Month",0,0,'C');
					$this->Cell(2);
					$this->Cell(25,10,$mMonth.' '.$_REQUEST["Year1"],0,0,'C');
					$this->Cell(2);
					$this->Cell(25,10,"This Month",0,0,'C');
					
					$this->Line(99,43,124,43);
					$this->Line(126,43,151,43);
					$this->Line(153,43,178,43);
					$this->Line(180,43,205,43);
					
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


	$mMonth1 = intval(date("m", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-1))));
	$mYear1 = intval(date("Y", mktime(0,0,0, $_REQUEST["Month1"], 0, ((int)$_REQUEST["Year1"]-1))));
	
	$mMonth2 = intval(date("m", mktime(0,0,0, $_REQUEST["Month1"], 0, $_REQUEST["Year1"])));
	$mYear2 = intval(date("Y", mktime(0,0,0, $_REQUEST["Month1"], 0, $_REQUEST["Year1"])));

	$mStatus = $_REQUEST['Status'];


	$mNet1 = 0;
	$mNet2 = 0;
	$mNet3 = 0;
	$mNet4 = 0;




//SALES NET
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Revenue",0,0,'L');
	$pdf->Ln(7);

	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','1',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	//grand amount
	$mTotalGross1 = 0;
	$mTotalGross2 = 0;
	$mTotalGross3 = 0;
	$mTotalGross4 = 0;

	$mTotalSales1 = 0;
	$mTotalSales2 = 0;
	$mTotalSales3 = 0;
	$mTotalSales4 = 0;


	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastYearAmount_no"]) > 0) 
						{ $mLastYearAmount = number_format($ado["LastYearAmount_no"],2); }
					elseif (floatval($ado["LastYearAmount_no"]) < 0) 
						{ $mLastYearAmount = "(".number_format(abs($ado["LastYearAmount_no"]),2).")"; }		
					else $mLastYearAmount = "-";

					if (floatval($ado["LastAmount_no"]) > 0) 
						{ $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) 
						{ $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) 	
						{ $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) 
						{ $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";

					if (floatval($ado["ThisAmount_no"]) > 0) 
						{ $mThisAmount = number_format($ado["ThisAmount_no"],2); }
					elseif (floatval($ado["ThisAmount_no"]) < 0) 
						{ $mThisAmount = "(".number_format(abs($ado["ThisAmount_no"]),2).")"; }		
					else $mThisAmount = "-";



					$mTotalSales1 = floatval($mTotalSales1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalSales2 = floatval($mTotalSales2) + floatval($ado["LastAmount_no"]); 
					$mTotalSales3 = floatval($mTotalSales3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalSales4 = floatval($mTotalSales4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);


	$dTotalSales1 =  $mTotalSales1;
	$dTotalSales2 =  $mTotalSales2;
	$dTotalSales3 =  $mTotalSales3;
	$dTotalSales4 =  $mTotalSales4;


	if (floatval($mTotalSales1) > 0) 
		{ $mTotalSales1_ = number_format($mTotalSales1,2); }
	elseif (floatval($mTotalSales1) < 0) 
		{ $mTotalSales1_ = "(".number_format(abs($mTotalSales1),2).")"; }		
	else $mTotalSales1_ = "-";

	if (floatval($mTotalSales2) > 0) 
		{ $mTotalSales2_ = number_format($mTotalSales2,2); }
	elseif (floatval($mTotalSales2) < 0) 
		{ $mTotalSales2_ = "(".number_format(abs($mTotalSales2),2).")"; }		
	else $mTotalSales2_ = "-";

	if (floatval($mTotalSales3) > 0) 
		{ $mTotalSales3_ = number_format($mTotalSales3,2); }
	elseif (floatval($mTotalSales3) < 0) 
		{ $mTotalSales3_ = "(".number_format(abs($mTotalSales3),2).")"; }		
	else $mTotalSales3_ = "-";

	if (floatval($mTotalSales4) > 0) 
		{ $mTotalSales4_ = number_format($mTotalSales4,2); }
	elseif (floatval($mTotalSales4) < 0) 
		{ $mTotalSales4_ = "(".number_format(abs($mTotalSales4),2).")"; }		
	else $mTotalSales4_ = "-";


	
	if ($mTotalSales1_ == '-'  &&  $mTotalSales2_ =='-' && $mTotalSales3_ =='-' && $mTotalSales4_ =='-'){

	}
	else {
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(5);
		$pdf->Cell(84,4,'GROSS SERVICE INCOME',0,0,'L');
		if ($mMonth1<>1)
		{
		$pdf->Cell(25,4,$mTotalSales1_,0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,$mTotalSales2_,0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,$mTotalSales3_,0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,$mTotalSales4_,0,0,'R');
		$pdf->Ln(4);
		}
		elseif($mMonth1==1)
		{
		$pdf->Cell(25,4,$mTotalSales1_,0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,"-",0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,"-",0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,$mTotalSales4_,0,0,'R');
		$pdf->Ln(4);

		}
		else
		{
		$pdf->Cell(25,4,"-",0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,"-",0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,"-",0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,$mTotalSales4_,0,0,'R');
		$pdf->Ln(4);
		}
	}



	$mTotalGross1 = floatval($dTotalSales1) - floatval($dTotalEnd1); 
	$mTotalGross2 = floatval($dTotalSales2) - floatval($dTotalEnd2); 
	$mTotalGross3 = floatval($dTotalSales3) - floatval($dTotalEnd3); 
	$mTotalGross4 = floatval($dTotalSales4) - floatval($dTotalEnd4); 



	$mNet1 = floatval($mNet1) + floatval($mTotalGross1); 
	$mNet2 = floatval($mNet2) + floatval($mTotalGross2); 
	$mNet3 = floatval($mNet3) + floatval($mTotalGross3); 
	$mNet4 = floatval($mNet4) + floatval($mTotalGross4); 




	if (floatval($mTotalGross1) > 0) { $mTotalGross1 = number_format($mTotalGross1,2); }
	elseif (floatval($mTotalGross1) < 0) { $mTotalGross1 = "(".number_format(abs($mTotalGross1),2).")"; }		
	else $mTotalGross1 = "-";

	if (floatval($mTotalGross2) > 0) { $mTotalGross2 = number_format($mTotalGross2,2); }
	elseif (floatval($mTotalGross2) < 0) { $mTotalGross2 = "(".number_format(abs($mTotalGross2),2).")"; }		
	else $mTotalGross2 = "-";

	if (floatval($mTotalGross3) > 0) { $mTotalGross3 = number_format($mTotalGross3,2); }
	elseif (floatval($mTotalGross3) < 0) { $mTotalGross3 = "(".number_format(abs($mTotalGross3),2).")"; }		
	else $mTotalGross3 = "-";

	if (floatval($mTotalGross4) > 0) { $mTotalGross4 = number_format($mTotalGross4,2); }
	elseif (floatval($mTotalGross4) < 0) { $mTotalGross4 = "(".number_format(abs($mTotalGross4),2).")"; }		
	else $mTotalGross4 = "-";



	if ($mTotalGross1 == '-'  &&  $mTotalGross2 =='-' && $mTotalGross3 =='-' && $mTotalGross4 =='-'){

	}
	else {

		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(89,6,"NET SERVICE INCOME",0,0,'L');
		if ($mMonth1<>1)
		{
		$pdf->Cell(25,4,$mTotalGross1,0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,$mTotalGross2,0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,$mTotalGross3,0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,$mTotalGross4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');

		$pdf->Ln(10);
		}
		elseif($mMonth1==1)
		{
		$pdf->Cell(25,4,$mTotalGross1,0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,"-",0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,"-",0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,$mTotalGross4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');

		$pdf->Ln(10);

		}	
		else
		{
		$pdf->Cell(25,4,"-",0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,"-",0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,"-",0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,$mTotalGross4,0,0,'R');

//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');

		$pdf->Ln(10);
		}
	}

//Credit Memo
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Less: Credit Memo",0,0,'L');
	$pdf->Ln(7);

include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','2',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalOperating1 = 0;
	$mTotalOperating2 = 0;
	$mTotalOperating3 = 0;
	$mTotalOperating4 = 0;

if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastYearAmount_no"]) > 0) { $mLastYearAmount = number_format($ado["LastYearAmount_no"],2); }
					elseif (floatval($ado["LastYearAmount_no"]) < 0) { $mLastYearAmount = "(".number_format(abs($ado["LastYearAmount_no"]),2).")"; }		
					else $mLastYearAmount = "-";

					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";

					if (floatval($ado["ThisAmount_no"]) > 0) { $mThisAmount = number_format($ado["ThisAmount_no"],2); }
					elseif (floatval($ado["ThisAmount_no"]) < 0) { $mThisAmount = "(".number_format(abs($ado["ThisAmount_no"]),2).")"; }		
					else $mThisAmount = "-";



					$mTotalOperating1 = floatval($mTotalOperating1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalOperating2 = floatval($mTotalOperating2) + floatval($ado["LastAmount_no"]); 
					$mTotalOperating3 = floatval($mTotalOperating3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalOperating4 = floatval($mTotalOperating4) + floatval($ado["ThisAmount_no"]); 
					


					if ($mLastYearAmount == '-'  &&  $mLastAmount =='-' && $mCurrentAmount =='-' && $mThisAmount =='-'){

					}
					else {
					
					$pdf->SetFont('Arial','',7);
					$pdf->Cell(5);
					$pdf->Cell(84,4,$ado["AccountDesc_tx"],0,0,'L');
					if ($mMonth1<>1)
					{
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mLastAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mCurrentAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}
					elseif($mMonth1==1)
					{
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}
					else
					{
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}	
					}			
				}
		}
	mysqli_close($mysqli);

		//draw a line
		$pdf->Ln(-4);
		$pdf->Ln(1);
		$pdf->Cell(5);
		$pdf->Cell(84);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Ln(4);




	$mNet1 = floatval($mNet1) + floatval($mTotalOperating1); 
	$mNet2 = floatval($mNet2) + floatval($mTotalOperating2); 
	$mNet3 = floatval($mNet3) + floatval($mTotalOperating3); 
	$mNet4 = floatval($mNet4) + floatval($mTotalOperating4); 



	if (floatval($mTotalOperating1) > 0) { $mTotalOperating1 = number_format($mTotalOperating1,2); }
	elseif (floatval($mTotalOperating1) < 0) { $mTotalOperating1 = "(".number_format(abs($mTotalOperating1),2).")"; }		
	else $mTotalOperating1 = "-";

	if (floatval($mTotalOperating2) > 0) { $mTotalOperating2 = number_format($mTotalOperating2,2); }
	elseif (floatval($mTotalOperating2) < 0) { $mTotalOperating2 = "(".number_format(abs($mTotalOperating2),2).")"; }		
	else $mTotalOperating2 = "-";

	if (floatval($mTotalOperating3) > 0) { $mTotalOperating3 = number_format($mTotalOperating3,2); }
	elseif (floatval($mTotalOperating3) < 0) { $mTotalOperating3 = "(".number_format(abs($mTotalOperating3),2).")"; }		
	else $mTotalOperating3 = "-";

	if (floatval($mTotalOperating4) > 0) { $mTotalOperating4 = number_format($mTotalOperating4,2); }
	elseif (floatval($mTotalOperating4) < 0) { $mTotalOperating4 = "(".number_format(abs($mTotalOperating4),2).")"; }		
	else $mTotalOperating4 = "-";



	if (floatval($mNet1) > 0) { $mOperating1 = number_format($mNet1,2); }
	elseif (floatval($mNet1) < 0) { $mOperating1 = "(".number_format(abs($mNet1),2).")"; }		
	else $mOperating1 = "-";

	if (floatval($mNet2) > 0) { $mOperating2 = number_format($mNet2,2); }
	elseif (floatval($mNet2) < 0) { $mOperating2 = "(".number_format(abs($mNet2),2).")"; }		
	else $mOperating2 = "-";

	if (floatval($mNet3) > 0) { $mOperating3 = number_format($mNet3,2); }
	elseif (floatval($mNet3) < 0) { $mOperating3 = "(".number_format(abs($mNet3),2).")"; }		
	else $mOperating3 = "-";

	if (floatval($mNet4) > 0) { $mOperating4 = number_format($mNet4,2); }
	elseif (floatval($mNet4) < 0) { $mOperating4 = "(".number_format(abs($mNet4),2).")"; }		
	else $mOperating4 = "-";

	$pdf->SetFont('Arial','B',9);
	//$pdf->Cell(89,6,"TOTAL CREDIT MEMO",0,0,'L');
	if ($mMonth1<>1)
	{
	//$pdf->Cell(25,4,$mTotalOperating1,0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,$mTotalOperating2,0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,$mTotalOperating3,0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	//$pdf->Ln(1);
	//$pdf->Cell(5);
	//$pdf->Cell(84);
	//$pdf->Cell(25,4,'____________',0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,'____________',0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,'____________',0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"GROSS SERVICE INCOME",0,0,'L');
	$pdf->Cell(25,4,$mOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);
	}
	elseif($mMonth1==1)
	{
	$pdf->Cell(25,4,$mTotalOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(1);
	$pdf->Cell(5);
	$pdf->Cell(84);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"OPERATING INCOME",0,0,'L');
	$pdf->Cell(25,4,$mOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);

	}
	else
	{
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"OPERATING INCOME",0,0,'L');
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);

	}



//Cost of Service
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Less: Cost of Services",0,0,'L');
	$pdf->Ln(7);

include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','3',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalOperating1 = 0;
	$mTotalOperating2 = 0;
	$mTotalOperating3 = 0;
	$mTotalOperating4 = 0;

//***

if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastYearAmount_no"]) > 0) { $mLastYearAmount = number_format($ado["LastYearAmount_no"],2); }
					elseif (floatval($ado["LastYearAmount_no"]) < 0) { $mLastYearAmount = "(".number_format(abs($ado["LastYearAmount_no"]),2).")"; }		
					else $mLastYearAmount = "-";

					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";

					if (floatval($ado["ThisAmount_no"]) > 0) { $mThisAmount = number_format($ado["ThisAmount_no"],2); }
					elseif (floatval($ado["ThisAmount_no"]) < 0) { $mThisAmount = "(".number_format(abs($ado["ThisAmount_no"]),2).")"; }		
					else $mThisAmount = "-";



					$mTotalOperating1 = floatval($mTotalOperating1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalOperating2 = floatval($mTotalOperating2) + floatval($ado["LastAmount_no"]); 
					$mTotalOperating3 = floatval($mTotalOperating3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalOperating4 = floatval($mTotalOperating4) + floatval($ado["ThisAmount_no"]); 
					


					if ($mLastYearAmount == '-'  &&  $mLastAmount =='-' && $mCurrentAmount =='-' && $mThisAmount =='-'){

					}
					else {
					
					$pdf->SetFont('Arial','',7);
					$pdf->Cell(5);
					$pdf->Cell(84,4,$ado["AccountDesc_tx"],0,0,'L');
					if ($mMonth1<>1)
					{
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mLastAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mCurrentAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}
					elseif($mMonth1==1)
					{
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}
					else
					{
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}	
					}			
				}
		}
	mysqli_close($mysqli);

		//draw a line
		$pdf->Ln(-4);
		$pdf->Ln(1);
		$pdf->Cell(5);
		$pdf->Cell(84);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Ln(4);




	$mNet1 = floatval($mNet1) - floatval($mTotalOperating1); 
	$mNet2 = floatval($mNet2) - floatval($mTotalOperating2); 
	$mNet3 = floatval($mNet3) - floatval($mTotalOperating3); 
	$mNet4 = floatval($mNet4) - floatval($mTotalOperating4); 



	if (floatval($mTotalOperating1) > 0) { $mTotalOperating1 = number_format($mTotalOperating1,2); }
	elseif (floatval($mTotalOperating1) < 0) { $mTotalOperating1 = "(".number_format(abs($mTotalOperating1),2).")"; }		
	else $mTotalOperating1 = "-";

	if (floatval($mTotalOperating2) > 0) { $mTotalOperating2 = number_format($mTotalOperating2,2); }
	elseif (floatval($mTotalOperating2) < 0) { $mTotalOperating2 = "(".number_format(abs($mTotalOperating2),2).")"; }		
	else $mTotalOperating2 = "-";

	if (floatval($mTotalOperating3) > 0) { $mTotalOperating3 = number_format($mTotalOperating3,2); }
	elseif (floatval($mTotalOperating3) < 0) { $mTotalOperating3 = "(".number_format(abs($mTotalOperating3),2).")"; }		
	else $mTotalOperating3 = "-";

	if (floatval($mTotalOperating4) > 0) { $mTotalOperating4 = number_format($mTotalOperating4,2); }
	elseif (floatval($mTotalOperating4) < 0) { $mTotalOperating4 = "(".number_format(abs($mTotalOperating4),2).")"; }		
	else $mTotalOperating4 = "-";





	if (floatval($mNet1) > 0) { $mOperating1 = number_format($mNet1,2); }
	elseif (floatval($mNet1) < 0) { $mOperating1 = "(".number_format(abs($mNet1),2).")"; }		
	else $mOperating1 = "-";

	if (floatval($mNet2) > 0) { $mOperating2 = number_format($mNet2,2); }
	elseif (floatval($mNet2) < 0) { $mOperating2 = "(".number_format(abs($mNet2),2).")"; }		
	else $mOperating2 = "-";

	if (floatval($mNet3) > 0) { $mOperating3 = number_format($mNet3,2); }
	elseif (floatval($mNet3) < 0) { $mOperating3 = "(".number_format(abs($mNet3),2).")"; }		
	else $mOperating3 = "-";

	if (floatval($mNet4) > 0) { $mOperating4 = number_format($mNet4,2); }
	elseif (floatval($mNet4) < 0) { $mOperating4 = "(".number_format(abs($mNet4),2).")"; }		
	else $mOperating4 = "-";

//***



	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,6,"TOTAL COST OF SERVICES",0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(1);
	$pdf->Cell(5);
	$pdf->Cell(84);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"GROSS INCOME",0,0,'L');
	$pdf->Cell(25,4,$mOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);
	}
	elseif($mMonth1==1)
	{
	$pdf->Cell(25,4,$mTotalOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(1);
	$pdf->Cell(5);
	$pdf->Cell(84);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"OPERATING INCOME",0,0,'L');
	$pdf->Cell(25,4,$mOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);

	}
	else
	{
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"OPERATING INCOME",0,0,'L');
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);

	}



//**
//OPERATING EXPENSES
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Less: Operating Expenses",0,0,'L');
	$pdf->Ln(7);


	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','5',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalOperating1 = 0;
	$mTotalOperating2 = 0;
	$mTotalOperating3 = 0;
	$mTotalOperating4 = 0;

	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastYearAmount_no"]) > 0) { $mLastYearAmount = number_format($ado["LastYearAmount_no"],2); }
					elseif (floatval($ado["LastYearAmount_no"]) < 0) { $mLastYearAmount = "(".number_format(abs($ado["LastYearAmount_no"]),2).")"; }		
					else $mLastYearAmount = "-";

					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";

					if (floatval($ado["ThisAmount_no"]) > 0) { $mThisAmount = number_format($ado["ThisAmount_no"],2); }
					elseif (floatval($ado["ThisAmount_no"]) < 0) { $mThisAmount = "(".number_format(abs($ado["ThisAmount_no"]),2).")"; }		
					else $mThisAmount = "-";



					$mTotalOperating1 = floatval($mTotalOperating1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalOperating2 = floatval($mTotalOperating2) + floatval($ado["LastAmount_no"]); 
					$mTotalOperating3 = floatval($mTotalOperating3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalOperating4 = floatval($mTotalOperating4) + floatval($ado["ThisAmount_no"]); 
					


					if ($mLastYearAmount == '-'  &&  $mLastAmount =='-' && $mCurrentAmount =='-' && $mThisAmount =='-'){

					}
					else {
					
					$pdf->SetFont('Arial','',7);
					$pdf->Cell(5);
					$pdf->Cell(84,4,$ado["AccountDesc_tx"],0,0,'L');
					if ($mMonth1<>1)
					{
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mLastAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mCurrentAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}
					elseif($mMonth1==1)
					{
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}
					else
					{
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}	
					}			
				}
		}
	mysqli_close($mysqli);

		//draw a line
		$pdf->Ln(-4);
		$pdf->Ln(1);
		$pdf->Cell(5);
		$pdf->Cell(84);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Ln(4);




	$mNet1 = floatval($mNet1) - floatval($mTotalOperating1); 
	$mNet2 = floatval($mNet2) - floatval($mTotalOperating2); 
	$mNet3 = floatval($mNet3) - floatval($mTotalOperating3); 
	$mNet4 = floatval($mNet4) - floatval($mTotalOperating4); 



	if (floatval($mTotalOperating1) > 0) { $mTotalOperating1 = number_format($mTotalOperating1,2); }
	elseif (floatval($mTotalOperating1) < 0) { $mTotalOperating1 = "(".number_format(abs($mTotalOperating1),2).")"; }		
	else $mTotalOperating1 = "-";

	if (floatval($mTotalOperating2) > 0) { $mTotalOperating2 = number_format($mTotalOperating2,2); }
	elseif (floatval($mTotalOperating2) < 0) { $mTotalOperating2 = "(".number_format(abs($mTotalOperating2),2).")"; }		
	else $mTotalOperating2 = "-";

	if (floatval($mTotalOperating3) > 0) { $mTotalOperating3 = number_format($mTotalOperating3,2); }
	elseif (floatval($mTotalOperating3) < 0) { $mTotalOperating3 = "(".number_format(abs($mTotalOperating3),2).")"; }		
	else $mTotalOperating3 = "-";

	if (floatval($mTotalOperating4) > 0) { $mTotalOperating4 = number_format($mTotalOperating4,2); }
	elseif (floatval($mTotalOperating4) < 0) { $mTotalOperating4 = "(".number_format(abs($mTotalOperating4),2).")"; }		
	else $mTotalOperating4 = "-";





	if (floatval($mNet1) > 0) { $mOperating1 = number_format($mNet1,2); }
	elseif (floatval($mNet1) < 0) { $mOperating1 = "(".number_format(abs($mNet1),2).")"; }		
	else $mOperating1 = "-";

	if (floatval($mNet2) > 0) { $mOperating2 = number_format($mNet2,2); }
	elseif (floatval($mNet2) < 0) { $mOperating2 = "(".number_format(abs($mNet2),2).")"; }		
	else $mOperating2 = "-";

	if (floatval($mNet3) > 0) { $mOperating3 = number_format($mNet3,2); }
	elseif (floatval($mNet3) < 0) { $mOperating3 = "(".number_format(abs($mNet3),2).")"; }		
	else $mOperating3 = "-";

	if (floatval($mNet4) > 0) { $mOperating4 = number_format($mNet4,2); }
	elseif (floatval($mNet4) < 0) { $mOperating4 = "(".number_format(abs($mNet4),2).")"; }		
	else $mOperating4 = "-";





	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,6,"TOTAL OPERATING EXPENSES",0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(1);
	$pdf->Cell(5);
	$pdf->Cell(84);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"NET INCOME FROM OPERATION",0,0,'L');
	$pdf->Cell(25,4,$mOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);
	}
	elseif($mMonth1==1)
	{
	$pdf->Cell(25,4,$mTotalOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(1);
	$pdf->Cell(5);
	$pdf->Cell(84);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"OPERATING INCOME",0,0,'L');
	$pdf->Cell(25,4,$mOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);

	}
	else
	{
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"OPERATING INCOME",0,0,'L');
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);

	}


//***

	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"OTHER INCOME AND (EXPENSES)",0,0,'L');
	$pdf->Ln(7);


	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','6',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalOther1 = 0;
	$mTotalOther2 = 0;
	$mTotalOther3 = 0;
	$mTotalOther4 = 0;

	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastYearAmount_no"]) > 0) { $mLastYearAmount = number_format($ado["LastYearAmount_no"],2); }
					elseif (floatval($ado["LastYearAmount_no"]) < 0) { $mLastYearAmount = "(".number_format(abs($ado["LastYearAmount_no"]),2).")"; }		
					else $mLastYearAmount = "-";

					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";

					if (floatval($ado["ThisAmount_no"]) > 0) { $mThisAmount = number_format($ado["ThisAmount_no"],2); }
					elseif (floatval($ado["ThisAmount_no"]) < 0) { $mThisAmount = "(".number_format(abs($ado["ThisAmount_no"]),2).")"; }		
					else $mThisAmount = "-";



					$mTotalOther1 = floatval($mTotalOther1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalOther2 = floatval($mTotalOther2) + floatval($ado["LastAmount_no"]); 
					$mTotalOther3 = floatval($mTotalOther3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalOther4 = floatval($mTotalOther4) + floatval($ado["ThisAmount_no"]); 
	

					if ($mLastYearAmount == '-'  &&  $mLastAmount =='-' && $mCurrentAmount =='-' && $mThisAmount =='-'){

					}
					else {

									
					$pdf->SetFont('Arial','',7);
					$pdf->Cell(5);
					$pdf->Cell(84,4,$ado["AccountDesc_tx"],0,0,'L');
					if ($mMonth1<>1)
					{
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mLastAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mCurrentAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}
					elseif($mMonth1==1)
					{
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}
					else
					{
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}	
					}
				}
		}
	mysqli_close($mysqli);
		//draw a line
		$pdf->Ln(-4);
		$pdf->Ln(1);
		$pdf->Cell(5);
		$pdf->Cell(84);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Ln(4);



	$mNet1 = floatval($mNet1) + floatval($mTotalOther1); 
	$mNet2 = floatval($mNet2) + floatval($mTotalOther2); 
	$mNet3 = floatval($mNet3) + floatval($mTotalOther3); 
	$mNet4 = floatval($mNet4) + floatval($mTotalOther4); 


	if (floatval($mNet1) > 0) { $mNetTax1 = number_format($mNet1,2); }
	elseif (floatval($mNet1) < 0) { $mNetTax1 = "(".number_format(abs($mNet1),2).")"; }		
	else $mNetTax1 = "-";

	if (floatval($mNet2) > 0) { $mNetTax2 = number_format($mNet2,2); }
	elseif (floatval($mNet2) < 0) { $mNetTax2 = "(".number_format(abs($mNet2),2).")"; }		
	else $mNetTax2 = "-";

	if (floatval($mNet3) > 0) { $mNetTax3 = number_format($mNet3,2); }
	elseif (floatval($mNet3) < 0) { $mNetTax3 = "(".number_format(abs($mNet3),2).")"; }		
	else $mNetTax3 = "-";

	if (floatval($mNet4) > 0) { $mNetTax4 = number_format($mNet4,2); }
	elseif (floatval($mNet4) < 0) { $mNetTax4 = "(".number_format(abs($mNet4),2).")"; }		
	else $mNetTax4 = "-";



	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,6,"NET INCOME BEFORE INCOME TAX",0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mNetTax1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax4,0,0,'R');
	//draw a line
	$pdf->Ln(1);
	$pdf->Cell(5);
	$pdf->Cell(84);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Ln(4);


//Income Tax
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Income Tax Expense",0,0,'L');
	$pdf->Ln(7);

include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','4',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalOperating1 = 0;
	$mTotalOperating2 = 0;
	$mTotalOperating3 = 0;
	$mTotalOperating4 = 0;

//***Income Tax

if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastYearAmount_no"]) > 0) { $mLastYearAmount = number_format($ado["LastYearAmount_no"],2); }
					elseif (floatval($ado["LastYearAmount_no"]) < 0) { $mLastYearAmount = "(".number_format(abs($ado["LastYearAmount_no"]),2).")"; }		
					else $mLastYearAmount = "-";

					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";

					if (floatval($ado["CurrentAmount_no"]) > 0) { $mCurrentAmount = number_format($ado["CurrentAmount_no"],2); }
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format(abs($ado["CurrentAmount_no"]),2).")"; }		
					else $mCurrentAmount = "-";

					if (floatval($ado["ThisAmount_no"]) > 0) { $mThisAmount = number_format($ado["ThisAmount_no"],2); }
					elseif (floatval($ado["ThisAmount_no"]) < 0) { $mThisAmount = "(".number_format(abs($ado["ThisAmount_no"]),2).")"; }		
					else $mThisAmount = "-";



					$mTotalOperating1 = floatval($mTotalOperating1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalOperating2 = floatval($mTotalOperating2) + floatval($ado["LastAmount_no"]); 
					$mTotalOperating3 = floatval($mTotalOperating3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalOperating4 = floatval($mTotalOperating4) + floatval($ado["ThisAmount_no"]); 
					


					if ($mLastYearAmount == '-'  &&  $mLastAmount =='-' && $mCurrentAmount =='-' && $mThisAmount =='-'){

					}
					else {
					
					$pdf->SetFont('Arial','',7);
					$pdf->Cell(5);
					$pdf->Cell(84,4,$ado["AccountDesc_tx"],0,0,'L');
					if ($mMonth1<>1)
					{
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mLastAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mCurrentAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}
					elseif($mMonth1==1)
					{
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}
					else
					{
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,"-",0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');
					$pdf->Ln(4);
					}	
					}			
				}
		}
	mysqli_close($mysqli);

		//draw a line
		$pdf->Ln(-4);
		$pdf->Ln(1);
		$pdf->Cell(5);
		$pdf->Cell(84);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Cell(2);
		$pdf->Cell(25,4,'____________',0,0,'R');
		$pdf->Ln(4);




	$mNet1 = floatval($mNet1) + floatval($mTotalOperating1); 
	$mNet2 = floatval($mNet2) + floatval($mTotalOperating2); 
	$mNet3 = floatval($mNet3) + floatval($mTotalOperating3); 
	$mNet4 = floatval($mNet4) + floatval($mTotalOperating4); 



	if (floatval($mTotalOperating1) > 0) { $mTotalOperating1 = number_format($mTotalOperating1,2); }
	elseif (floatval($mTotalOperating1) < 0) { $mTotalOperating1 = "(".number_format(abs($mTotalOperating1),2).")"; }		
	else $mTotalOperating1 = "-";

	if (floatval($mTotalOperating2) > 0) { $mTotalOperating2 = number_format($mTotalOperating2,2); }
	elseif (floatval($mTotalOperating2) < 0) { $mTotalOperating2 = "(".number_format(abs($mTotalOperating2),2).")"; }		
	else $mTotalOperating2 = "-";

	if (floatval($mTotalOperating3) > 0) { $mTotalOperating3 = number_format($mTotalOperating3,2); }
	elseif (floatval($mTotalOperating3) < 0) { $mTotalOperating3 = "(".number_format(abs($mTotalOperating3),2).")"; }		
	else $mTotalOperating3 = "-";

	if (floatval($mTotalOperating4) > 0) { $mTotalOperating4 = number_format($mTotalOperating4,2); }
	elseif (floatval($mTotalOperating4) < 0) { $mTotalOperating4 = "(".number_format(abs($mTotalOperating4),2).")"; }		
	else $mTotalOperating4 = "-";


	if (floatval($mNet1) > 0) { $mOperating1 = number_format($mNet1,2); }
	elseif (floatval($mNet1) < 0) { $mOperating1 = "(".number_format(abs($mNet1),2).")"; }		
	else $mOperating1 = "-";

	if (floatval($mNet2) > 0) { $mOperating2 = number_format($mNet2,2); }
	elseif (floatval($mNet2) < 0) { $mOperating2 = "(".number_format(abs($mNet2),2).")"; }		
	else $mOperating2 = "-";

	if (floatval($mNet3) > 0) { $mOperating3 = number_format($mNet3,2); }
	elseif (floatval($mNet3) < 0) { $mOperating3 = "(".number_format(abs($mNet3),2).")"; }		
	else $mOperating3 = "-";

	if (floatval($mNet4) > 0) { $mOperating4 = number_format($mNet4,2); }
	elseif (floatval($mNet4) < 0) { $mOperating4 = "(".number_format(abs($mNet4),2).")"; }		
	else $mOperating4 = "-";

//***



	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,6,"TOTAL TAX EXPENSE",0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(1);
	$pdf->Cell(5);
	$pdf->Cell(84);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Ln(4);
	//$pdf->Cell(89,6,"NET INCOME AFTER TAX111",0,0,'L');
	//$pdf->Cell(25,4,$mOperating1,0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,$mOperating2,0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,$mOperating3,0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,$mOperating4,0,0,'R');


//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	//$pdf->Cell(25,4,"____________",0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,"____________",0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,"____________",0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,"____________",0,0,'R');
	//$pdf->Ln(10);
	}
	elseif($mMonth1==1)
	{
	$pdf->Cell(25,4,$mTotalOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(1);
	$pdf->Cell(5);
	$pdf->Cell(84);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"OPERATING INCOME",0,0,'L');
	$pdf->Cell(25,4,$mOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);

	}
	else
	{
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"OPERATING INCOME",0,0,'L');
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);

	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(10);

	}



//***Income tax - DITO MAG MINUS

	
	//$pdf->SetFont('Arial','B',9);
	//$pdf->Cell(89,6,"NET INCOME AFTER TAX",0,0,'L');
	//$pdf->Cell(25,4,$mNetTax1,0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,$mNetTax2,0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,$mNetTax3,0,0,'R');
	//$pdf->Cell(2);
	//$pdf->Cell(25,4,$mNetTax4,0,0,'R');

	
	$pdf->Ln(4);
	$pdf->Cell(89,6,"NET INCOME AFTER TAX",0,0,'L');
	$pdf->Cell(25,4,$mOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');

	
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(4);
	}
	elseif($mMonth1==1)
	{
	$pdf->Cell(25,4,$mNetTax1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax4,0,0,'R');
	//draw a line
	$pdf->Ln(1);
	$pdf->Cell(5);
	$pdf->Cell(84);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,'____________',0,0,'R');
	$pdf->Ln(4);

	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,6,"NET INCOME AFTER TAX",0,0,'L');
	$pdf->Cell(25,4,$mNetTax1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax4,0,0,'R');


//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(4);

	}	
	else
	{
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax4,0,0,'R');
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,6,"NET INCOME AFTER TAX",0,0,'L');
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"-",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax4,0,0,'R');
//Double line
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(2);
	$pdf->Cell(89);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,"____________",0,0,'R');
	$pdf->Ln(4);

	}
	





















	if (floatval($mNet1) > 0) { $mNet1 = number_format($mNet1,2); }
	elseif (floatval($mNet1) < 0) { $mNet1 = "(".number_format(abs($mNet1),2).")"; }		
	else $mNet1 = "-";

	if (floatval($mNet2) > 0) { $mNet2 = number_format($mNet2,2); }
	elseif (floatval($mNet2) < 0) { $mNet2 = "(".number_format(abs($mNet2),2).")"; }		
	else $mNet2 = "-";

	if (floatval($mNet3) > 0) { $mNet3 = number_format($mNet3,2); }
	elseif (floatval($mNet3) < 0) { $mNet3 = "(".number_format(abs($mNet3),2).")"; }		
	else $mNet3 = "-";

	if (floatval($mNet4) > 0) { $mNet4 = number_format($mNet4,2); }
	elseif (floatval($mNet4) < 0) { $mNet4 = "(".number_format(abs($mNet4),2).")"; }		
	else $mNet4 = "-";





	$pdf->Output();
?>
