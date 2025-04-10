<?php

function fs_Get_Begining_This_Month($mMonth1,$mYear1,$mMonth2,$mYear2,$mStatus)
{

	$mNet1 = 0;
	$mNet2 = 0;
	$mNet3 = 0;
	$mNet4 = 0;

//SALES NET
/*	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Sales Net",0,0,'L');
	$pdf->Ln(7);
*/
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

/*

	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Sales Net',0,0,'L');
	$pdf->Cell(25,4,$mTotalSales1_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalSales2_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalSales3_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalSales4_,0,0,'R');
	$pdf->Ln(4);
*/




//COST OF SALES
/*	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Cost of Sales",0,0,'L');
	$pdf->Ln(7);
*/
	$mTotalAvailable1 = 0;
	$mTotalAvailable2 = 0;
	$mTotalAvailable3 = 0;
	$mTotalAvailable4 = 0;

	$mTotalCost1 = 0;
	$mTotalCost2 = 0;
	$mTotalCost3 = 0;
	$mTotalCost4 = 0;


//COST OF SALES - inventory Begining
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','2',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalBeginning1 = 0;
	$mTotalBeginning2 = 0;
	$mTotalBeginning3 = 0;
	$mTotalBeginning4 = 0;
	echo $mysqli->error;
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



					$mTotalBeginning1 = floatval($mTotalBeginning1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalBeginning2 = floatval($mTotalBeginning2) + floatval($ado["LastAmount_no"]); 
					$mTotalBeginning3 = floatval($mTotalBeginning3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalBeginning4 = floatval($mTotalBeginning4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);


//revise to get the begining inventory for this month from the ending inventory of last month


	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','4',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");
	$mTotalBeginning3 = 0;
	echo $mysqli->error;
		
	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					if (floatval($ado["LastAmount_no"]) > 0) { $mLastAmount = number_format($ado["LastAmount_no"],2); }
					elseif (floatval($ado["LastAmount_no"]) < 0) { $mLastAmount = "(".number_format(abs($ado["LastAmount_no"]),2).")"; }		
					else $mLastAmount = "-";
					$mTotalBeginning3 = floatval($mTotalBeginning3) + floatval($ado["LastAmount_no"]); 
				}
		}
	mysqli_close($mysqli);



//revise to get the begining inventory for this month from the ending inventory of last month













	$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalBeginning1); 
	$mTotalAvailable2 = floatval($mTotalAvailable2) + floatval($mTotalBeginning2); 
	$mTotalAvailable3 = floatval($mTotalAvailable3) + floatval($mTotalBeginning3); 
	$mTotalAvailable4 = floatval($mTotalAvailable4) + floatval($mTotalBeginning4); 




	if (floatval($mTotalBeginning1) > 0) { $mTotalBeginning1 = number_format($mTotalBeginning1,2); }
	elseif (floatval($mTotalBeginning1) < 0) { $mTotalBeginning1 = "(".number_format(abs($mTotalBeginning1),2).")"; }		
	else $mTotalBeginning1 = "-";

	if (floatval($mTotalBeginning2) > 0) { $mTotalBeginning2 = number_format($mTotalBeginning2,2); }
	elseif (floatval($mTotalBeginning2) < 0) { $mTotalBeginning2 = "(".number_format(abs($mTotalBeginning2),2).")"; }		
	else $mTotalBeginning2 = "-";

	if (floatval($mTotalBeginning3) > 0) { $mTotalBeginning3 = number_format($mTotalBeginning3,2); }
	elseif (floatval($mTotalBeginning3) < 0) { $mTotalBeginning3 = "(".number_format(abs($mTotalBeginning3),2).")"; }		
	else $mTotalBeginning3 = "-";

	if (floatval($mTotalBeginning4) > 0) { $mTotalBeginning4 = number_format($mTotalBeginning4,2); }
	elseif (floatval($mTotalBeginning4) < 0) { $mTotalBeginning4 = "(".number_format(abs($mTotalBeginning4),2).")"; }		
	else $mTotalBeginning4 = "-";


/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Inventory-Beginning',0,0,'L');
	$pdf->Cell(25,4,$mTotalBeginning1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning4,0,0,'R');
	$pdf->Ln(4);


*/









//COST OF SALES - purchases

	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','3',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalPurchases1 = 0;
	$mTotalPurchases2 = 0;
	$mTotalPurchases3 = 0;
	$mTotalPurchases4 = 0;

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
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format($ado["CurrentAmount_no"],2).")"; }		
					else $mCurrentAmount = "-";

					if (floatval($ado["ThisAmount_no"]) > 0) { $mThisAmount = number_format($ado["ThisAmount_no"],2); }
					elseif (floatval($ado["ThisAmount_no"]) < 0) { $mThisAmount = "(".number_format(abs($ado["ThisAmount_no"]),2).")"; }		
					else $mThisAmount = "-";

					
					$mTotalPurchases1 = floatval($mTotalPurchases1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalPurchases2 = floatval($mTotalPurchases2) + floatval($ado["LastAmount_no"]); 
					$mTotalPurchases3 = floatval($mTotalPurchases3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalPurchases4 = floatval($mTotalPurchases4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);

	$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalPurchases1); 
	$mTotalAvailable2 = floatval($mTotalAvailable2) + floatval($mTotalPurchases2); 
	$mTotalAvailable3 = floatval($mTotalAvailable3) + floatval($mTotalPurchases3); 
	$mTotalAvailable4 = floatval($mTotalAvailable4) + floatval($mTotalPurchases4); 






	if (floatval($mTotalPurchases1) > 0) { $mTotalPurchases1 = number_format($mTotalPurchases1,2); }
	elseif (floatval($mTotalPurchases1) < 0) { $mTotalPurchases1 = "(".number_format(abs($mTotalPurchases1),2).")"; }		
	else $mTotalPurchases1 = "-";

	if (floatval($mTotalPurchases2) > 0) { $mTotalPurchases2 = number_format($mTotalPurchases2,2); }
	elseif (floatval($mTotalPurchases2) < 0) { $mTotalPurchases2 = "(".number_format(abs($mTotalPurchases2),2).")"; }		
	else $mTotalPurchases2 = "-";

	if (floatval($mTotalPurchases3) > 0) { $mTotalPurchases3 = number_format($mTotalPurchases3,2); }
	elseif (floatval($mTotalPurchases3) < 0) { $mTotalPurchases3 = "(".number_format(abs($mTotalPurchases3),2).")"; }		
	else $mTotalPurchases3 = "-";

	if (floatval($mTotalPurchases4) > 0) { $mTotalPurchases4 = number_format($mTotalPurchases4,2); }
	elseif (floatval($mTotalPurchases4) < 0) { $mTotalPurchases4 = "(".number_format(abs($mTotalPurchases4),2).")"; }		
	else $mTotalPurchases4 = "-";

/*

	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Purchases',0,0,'L');
	$pdf->Cell(25,4,$mTotalPurchases1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases4,0,0,'R');
	$pdf->Ln(4);

*/


	if (floatval($mTotalAvailable1) > 0) { $mTotalAvailable1_ = number_format($mTotalAvailable1,2); }
	elseif (floatval($mTotalAvailable1) < 0) { $mTotalAvailable1_ = "(".number_format(abs($mTotalAvailable1),2).")"; }		
	else $mTotalAvailable1_ = "-";

	if (floatval($mTotalAvailable2) > 0) { $mTotalAvailable2_ = number_format($mTotalAvailable2,2); }
	elseif (floatval($mTotalAvailable2) < 0) { $mTotalAvailable2_ = "(".number_format(abs($mTotalAvailable2),2).")"; }		
	else $mTotalAvailable2_ = "-";

	if (floatval($mTotalAvailable3) > 0) { $mTotalAvailable3_ = number_format($mTotalAvailable3,2); }
	elseif (floatval($mTotalAvailable3) < 0) { $mTotalAvailable3_ = "(".number_format(abs($mTotalAvailable3),2).")"; }		
	else $mTotalAvailable3_ = "-";

	if (floatval($mTotalAvailable4) > 0) { $mTotalAvailable4_ = number_format($mTotalAvailable4,2); }
	elseif (floatval($mTotalAvailable4) < 0) { $mTotalAvailable4_ = "(".number_format(abs($mTotalAvailable4),2).")"; }		
	else $mTotalAvailable4_ = "-";





//COST OF SALES - Total Available Goods For Sale
/*	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Total Available Goods for Sale',0,0,'L');
	$pdf->Cell(25,4,$mTotalAvailable1_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable2_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable3_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable4_,0,0,'R');
	$pdf->Ln(4);
*/







//COST OF SALES  - cost of sales
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','4',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalEnd1 = 0;
	$mTotalEnd2 = 0;
	$mTotalEnd3 = 0;
	$mTotalEnd4 = 0;

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



					$mTotalEnd1 = floatval($mTotalEnd1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalEnd2 = floatval($mTotalEnd2) + floatval($ado["LastAmount_no"]); 
					$mTotalEnd3 = floatval($mTotalEnd3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalEnd4 = floatval($mTotalEnd4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);
	
	$dTotalEnd1 = $mTotalEnd1;
	$dTotalEnd2 = $mTotalEnd2;
	$dTotalEnd3 = $mTotalEnd3;
	$dTotalEnd4 = $mTotalEnd4;


	$mTotalCost1 = floatval($mTotalAvailable1) - floatval($mTotalEnd1); 
	$mTotalCost2 = floatval($mTotalAvailable2) - floatval($mTotalEnd2); 
	//$mTotalCost3 = floatval($mTotalAvailable3) - floatval($mTotalEnd3); 
	$mTotalCost3 = floatval($mTotalAvailable3) - floatval($mTotalEnd4); 
	$mTotalCost4 = floatval($mTotalAvailable4) - floatval($mTotalEnd4); 

return $mTotalCost2;

	if (floatval($mTotalEnd1) > 0) { $mTotalEnd1 = number_format($mTotalEnd1,2); }
	elseif (floatval($mTotalEnd1) < 0) { $mTotalEnd1 = "(".number_format(abs($mTotalEnd1),2).")"; }		
	else $mTotalEnd1 = "-";

	if (floatval($mTotalEnd2) > 0) { $mTotalEnd2 = number_format($mTotalEnd2,2); }
	elseif (floatval($mTotalEnd2) < 0) { $mTotalEnd2 = "(".number_format(abs($mTotalEnd2),2).")"; }		
	else $mTotalEnd2 = "-";

	if (floatval($mTotalEnd3) > 0) { $mTotalEnd3 = number_format($mTotalEnd3,2); }
	elseif (floatval($mTotalEnd3) < 0) { $mTotalEnd3 = "(".number_format(abs($mTotalEnd3),2).")"; }		
	else $mTotalEnd3 = "-";

	if (floatval($mTotalEnd4) > 0) { $mTotalEnd4 = number_format($mTotalEnd4,2); }
	elseif (floatval($mTotalEnd4) < 0) { $mTotalEnd4 = "(".number_format(abs($mTotalEnd4),2).")"; }		
	else $mTotalEnd4 = "-";



/*	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Cost of Sales',0,0,'L');
	$pdf->Cell(25,4,$mTotalEnd1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd2,0,0,'R');
	$pdf->Cell(2);
	//$pdf->Cell(25,4,$mTotalEnd3,0,0,'R');
	$pdf->Cell(25,4,$mTotalEnd3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd4,0,0,'R');
	$pdf->Ln(4);
*/








	if (floatval($mTotalCost1) > 0) { $mTotalCost1 = number_format($mTotalCost1,2); }
	elseif (floatval($mTotalCost1) < 0) { $mTotalCost1 = "(".number_format(abs($mTotalCost1),2).")"; }		
	else $mTotalCost1 = "-";

	if (floatval($mTotalCost2) > 0) { $mTotalCost2 = number_format($mTotalCost2,2); }
	elseif (floatval($mTotalCost2) < 0) { $mTotalCost2 = "(".number_format(abs($mTotalCost2),2).")"; }		
	else $mTotalCost2 = "-";

	if (floatval($mTotalCost3) > 0) { $mTotalCost3 = number_format($mTotalCost3,2); }
	elseif (floatval($mTotalCost3) < 0) { $mTotalCost3 = "(".number_format(abs($mTotalCost3),2).")"; }		
	else $mTotalCost3 = "-";

	if (floatval($mTotalCost4) > 0) { $mTotalCost4 = number_format($mTotalCost4,2); }
	elseif (floatval($mTotalCost4) < 0) { $mTotalCost4 = "(".number_format(abs($mTotalCost4),2).")"; }		
	else $mTotalCost4 = "-";



/*	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Ending Inventory',0,0,'L');
	$pdf->Cell(25,4,$mTotalCost1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost4,0,0,'R');
	$pdf->Ln(4);
*/

	



/*
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




	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,6,"GROSS PROFIT",0,0,'L');
	$pdf->Cell(25,4,$mTotalGross1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalGross2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalGross3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalGross4,0,0,'R');
	$pdf->Ln(10);




//OPERATING EXPENSES
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Operating Expenses",0,0,'L');
	$pdf->Ln(7);


	include('datasource_.php');
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
										
					$pdf->SetFont('Arial','',7);
					$pdf->Cell(5);
					$pdf->Cell(84,4,$ado["AccountDesc_tx"],0,0,'L');
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mLastAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mCurrentAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');

					$pdf->Ln(4);
				}
		}
	mysqli_close($mysqli);





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
	$pdf->Cell(25,4,$mTotalOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalOperating4,0,0,'R');
	$pdf->Ln(4);
	$pdf->Cell(89,6,"OPERATING INCOME",0,0,'L');
	$pdf->Cell(25,4,$mOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
	$pdf->Ln(10);





	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Other Income",0,0,'L');
	$pdf->Ln(7);


	include('datasource_.php');
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
										
					$pdf->SetFont('Arial','',7);
					$pdf->Cell(5);
					$pdf->Cell(84,4,$ado["AccountDesc_tx"],0,0,'L');
					$pdf->Cell(25,4,$mLastYearAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mLastAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mCurrentAmount,0,0,'R');
					$pdf->Cell(2);
					$pdf->Cell(25,4,$mThisAmount,0,0,'R');


					$pdf->Ln(4);

				}
		}
	mysqli_close($mysqli);



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
	$pdf->Cell(25,4,$mNetTax1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax4,0,0,'R');
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,6,"NET INCOME AFTER TAX",0,0,'L');
	$pdf->Cell(25,4,$mNetTax1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax4,0,0,'R');
	$pdf->Ln(4);























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


*/
}

//for balance sheet
function fs_Get_Ending_Inventory($mMonth1,$mYear1,$mMonth2,$mYear2,$mStatus)
{

	$mNet1 = 0;
	$mNet2 = 0;
	$mNet3 = 0;
	$mNet4 = 0;
	
//SALES NET
	/*
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Sales Net",0,0,'L');
	$pdf->Ln(7);
	*/
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


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Sales Net',0,0,'L');
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
	*/



//COST OF SALES
/*
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Cost of Sales",0,0,'L');
	$pdf->Ln(7);
*/
	$mTotalAvailable1 = 0;
	$mTotalAvailable2 = 0;
	$mTotalAvailable3 = 0;
	$mTotalAvailable4 = 0;

	$mTotalCost1 = 0;
	$mTotalCost2 = 0;
	$mTotalCost3 = 0;
	$mTotalCost4 = 0;


//COST OF SALES - inventory Begining
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','2',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalBeginning1 = 0;
	$mTotalBeginning2 = 0;
	$mTotalBeginning3 = 0;
	$mTotalBeginning4 = 0;
	echo $mysqli->error;
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



					$mTotalBeginning1 = floatval($mTotalBeginning1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalBeginning2 = floatval($mTotalBeginning2) + floatval($ado["LastAmount_no"]); 
					$mTotalBeginning3 = floatval($mTotalBeginning3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalBeginning4 = floatval($mTotalBeginning4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);



//revise to get the begining inventory for this month from the ending inventory of last month

	$mTotalBeginning3 = 0;//fs_Get_Begining_This_Month($mMonth1,$mYear1,$mMonth2,$mYear2,$mStatus);

//revise to get the begining inventory for this month from the ending inventory of last month













	$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalBeginning1); 
	$mTotalAvailable2 = floatval($mTotalAvailable2) + floatval($mTotalBeginning2); 
	$mTotalAvailable3 = floatval($mTotalAvailable3) + floatval($mTotalBeginning3); 
	$mTotalAvailable4 = floatval($mTotalAvailable4) + floatval($mTotalBeginning4); 




	if (floatval($mTotalBeginning1) > 0) { $mTotalBeginning1 = number_format($mTotalBeginning1,2); }
	elseif (floatval($mTotalBeginning1) < 0) { $mTotalBeginning1 = "(".number_format(abs($mTotalBeginning1),2).")"; }		
	else $mTotalBeginning1 = "-";

	if (floatval($mTotalBeginning2) > 0) { $mTotalBeginning2 = number_format($mTotalBeginning2,2); }
	elseif (floatval($mTotalBeginning2) < 0) { $mTotalBeginning2 = "(".number_format(abs($mTotalBeginning2),2).")"; }		
	else $mTotalBeginning2 = "-";

	if (floatval($mTotalBeginning3) > 0) { $mTotalBeginning3 = number_format($mTotalBeginning3,2); }
	elseif (floatval($mTotalBeginning3) < 0) { $mTotalBeginning3 = "(".number_format(abs($mTotalBeginning3),2).")"; }		
	else $mTotalBeginning3 = "-";

	if (floatval($mTotalBeginning4) > 0) { $mTotalBeginning4 = number_format($mTotalBeginning4,2); }
	elseif (floatval($mTotalBeginning4) < 0) { $mTotalBeginning4 = "(".number_format(abs($mTotalBeginning4),2).")"; }		
	else $mTotalBeginning4 = "-";


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Inventory-Beginning',0,0,'L');
	if ($mMonth1<>1)
	{	
	$pdf->Cell(25,4,$mTotalBeginning1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalBeginning4,0,0,'R');
	$pdf->Ln(4);
	}

	*/








//COST OF SALES - purchases

	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','3',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalPurchases1 = 0;
	$mTotalPurchases2 = 0;
	$mTotalPurchases3 = 0;
	$mTotalPurchases4 = 0;

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
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format($ado["CurrentAmount_no"],2).")"; }		
					else $mCurrentAmount = "-";

					if (floatval($ado["ThisAmount_no"]) > 0) { $mThisAmount = number_format($ado["ThisAmount_no"],2); }
					elseif (floatval($ado["ThisAmount_no"]) < 0) { $mThisAmount = "(".number_format(abs($ado["ThisAmount_no"]),2).")"; }		
					else $mThisAmount = "-";

					
					$mTotalPurchases1 = floatval($mTotalPurchases1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalPurchases2 = floatval($mTotalPurchases2) + floatval($ado["LastAmount_no"]); 
					$mTotalPurchases3 = floatval($mTotalPurchases3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalPurchases4 = floatval($mTotalPurchases4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);

	$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalPurchases1); 
	$mTotalAvailable2 = floatval($mTotalAvailable2) + floatval($mTotalPurchases2); 
	$mTotalAvailable3 = floatval($mTotalAvailable3) + floatval($mTotalPurchases3); 
	$mTotalAvailable4 = floatval($mTotalAvailable4) + floatval($mTotalPurchases4); 






	if (floatval($mTotalPurchases1) > 0) { $mTotalPurchases1 = number_format($mTotalPurchases1,2); }
	elseif (floatval($mTotalPurchases1) < 0) { $mTotalPurchases1 = "(".number_format(abs($mTotalPurchases1),2).")"; }		
	else $mTotalPurchases1 = "-";

	if (floatval($mTotalPurchases2) > 0) { $mTotalPurchases2 = number_format($mTotalPurchases2,2); }
	elseif (floatval($mTotalPurchases2) < 0) { $mTotalPurchases2 = "(".number_format(abs($mTotalPurchases2),2).")"; }		
	else $mTotalPurchases2 = "-";

	if (floatval($mTotalPurchases3) > 0) { $mTotalPurchases3 = number_format($mTotalPurchases3,2); }
	elseif (floatval($mTotalPurchases3) < 0) { $mTotalPurchases3 = "(".number_format(abs($mTotalPurchases3),2).")"; }		
	else $mTotalPurchases3 = "-";

	if (floatval($mTotalPurchases4) > 0) { $mTotalPurchases4 = number_format($mTotalPurchases4,2); }
	elseif (floatval($mTotalPurchases4) < 0) { $mTotalPurchases4 = "(".number_format(abs($mTotalPurchases4),2).")"; }		
	else $mTotalPurchases4 = "-";


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Purchases',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalPurchases1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalPurchases4,0,0,'R');
	$pdf->Ln(4);

	}
	*/


	if (floatval($mTotalAvailable1) > 0) { $mTotalAvailable1_ = number_format($mTotalAvailable1,2); }
	elseif (floatval($mTotalAvailable1) < 0) { $mTotalAvailable1_ = "(".number_format(abs($mTotalAvailable1),2).")"; }		
	else $mTotalAvailable1_ = "-";

	if (floatval($mTotalAvailable2) > 0) { $mTotalAvailable2_ = number_format($mTotalAvailable2,2); }
	elseif (floatval($mTotalAvailable2) < 0) { $mTotalAvailable2_ = "(".number_format(abs($mTotalAvailable2),2).")"; }		
	else $mTotalAvailable2_ = "-";

	if (floatval($mTotalAvailable3) > 0) { $mTotalAvailable3_ = number_format($mTotalAvailable3,2); }
	elseif (floatval($mTotalAvailable3) < 0) { $mTotalAvailable3_ = "(".number_format(abs($mTotalAvailable3),2).")"; }		
	else $mTotalAvailable3_ = "-";

	if (floatval($mTotalAvailable4) > 0) { $mTotalAvailable4_ = number_format($mTotalAvailable4,2); }
	elseif (floatval($mTotalAvailable4) < 0) { $mTotalAvailable4_ = "(".number_format(abs($mTotalAvailable4),2).")"; }		
	else $mTotalAvailable4_ = "-";





//COST OF SALES - Total Available Goods For Sale
	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Total Available Goods for Sale',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalAvailable1_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable2_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable3_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable4_,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalAvailable4_,0,0,'R');
	$pdf->Ln(4);
	}
	*/



//COST OF SALES  - cost of sales
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','4',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalEnd1 = 0;
	$mTotalEnd2 = 0;
	$mTotalEnd3 = 0;
	$mTotalEnd4 = 0;

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



					$mTotalEnd1 = floatval($mTotalEnd1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalEnd2 = floatval($mTotalEnd2) + floatval($ado["LastAmount_no"]); 
					$mTotalEnd3 = floatval($mTotalEnd3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalEnd4 = floatval($mTotalEnd4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);
	
	$dTotalEnd1 = $mTotalEnd1;
	$dTotalEnd2 = $mTotalEnd2;
	$dTotalEnd3 = $mTotalEnd3;
	$dTotalEnd4 = $mTotalEnd4;


	$mTotalCost1 = floatval($mTotalAvailable1) - floatval($mTotalEnd1); 
	$mTotalCost2 = floatval($mTotalAvailable2) - floatval($mTotalEnd2); 
	//$mTotalCost3 = floatval($mTotalAvailable3) - floatval($mTotalEnd3); 
	$mTotalCost3 = floatval($mTotalAvailable3) - floatval($mTotalEnd3); 
	$mTotalCost4 = floatval($mTotalAvailable4) - floatval($mTotalEnd4); 



	if (floatval($mTotalEnd1) > 0) { $mTotalEnd1 = number_format($mTotalEnd1,2); }
	elseif (floatval($mTotalEnd1) < 0) { $mTotalEnd1 = "(".number_format(abs($mTotalEnd1),2).")"; }		
	else $mTotalEnd1 = "-";

	if (floatval($mTotalEnd2) > 0) { $mTotalEnd2 = number_format($mTotalEnd2,2); }
	elseif (floatval($mTotalEnd2) < 0) { $mTotalEnd2 = "(".number_format(abs($mTotalEnd2),2).")"; }		
	else $mTotalEnd2 = "-";

	if (floatval($mTotalEnd3) > 0) { $mTotalEnd3 = number_format($mTotalEnd3,2); }
	elseif (floatval($mTotalEnd3) < 0) { $mTotalEnd3 = "(".number_format(abs($mTotalEnd3),2).")"; }		
	else $mTotalEnd3 = "-";

	if (floatval($mTotalEnd4) > 0) { $mTotalEnd4 = number_format($mTotalEnd4,2); }
	elseif (floatval($mTotalEnd4) < 0) { $mTotalEnd4 = "(".number_format(abs($mTotalEnd4),2).")"; }		
	else $mTotalEnd4 = "-";


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Cost of Sales',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalEnd1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalEnd4,0,0,'R');
	$pdf->Ln(4);
	}

	*/




	return $mTotalCost4;

	if (floatval($mTotalCost1) > 0) { $mTotalCost1 = number_format($mTotalCost1,2); }
	elseif (floatval($mTotalCost1) < 0) { $mTotalCost1 = "(".number_format(abs($mTotalCost1),2).")"; }		
	else $mTotalCost1 = "-";

	if (floatval($mTotalCost2) > 0) { $mTotalCost2 = number_format($mTotalCost2,2); }
	elseif (floatval($mTotalCost2) < 0) { $mTotalCost2 = "(".number_format(abs($mTotalCost2),2).")"; }		
	else $mTotalCost2 = "-";

	if (floatval($mTotalCost3) > 0) { $mTotalCost3 = number_format($mTotalCost3,2); }
	elseif (floatval($mTotalCost3) < 0) { $mTotalCost3 = "(".number_format(abs($mTotalCost3),2).")"; }		
	else $mTotalCost3 = "-";

	if (floatval($mTotalCost4) > 0) { $mTotalCost4 = number_format($mTotalCost4,2); }
	elseif (floatval($mTotalCost4) < 0) { $mTotalCost4 = "(".number_format(abs($mTotalCost4),2).")"; }		
	else $mTotalCost4 = "-";



	/*$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Ending Inventory',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalCost1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalCost4,0,0,'R');
	$pdf->Ln(4);
	}

	*/

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



}


























//for balance sheet GET THE NET income
function Get_Income_CurrentYear($mMonth1,$mYear1,$mMonth2,$mYear2,$mStatus)
{

	$mNet1 = 0;
	$mNet2 = 0;
	$mNet3 = 0;
	$mNet4 = 0;




//SALES NET
	/*
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Sales Net",0,0,'L');
	$pdf->Ln(7);
	*/
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


/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Sales Net',0,0,'L');
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

*/


//COST OF SALES
	/*
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Cost of Sales",0,0,'L');
	$pdf->Ln(7);
	*/
	$mTotalAvailable1 = 0;
	$mTotalAvailable2 = 0;
	$mTotalAvailable3 = 0;
	$mTotalAvailable4 = 0;

	$mTotalCost1 = 0;
	$mTotalCost2 = 0;
	$mTotalCost3 = 0;
	$mTotalCost4 = 0;


//COST OF SALES - inventory Begining
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','2',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalBeginning1 = 0;
	$mTotalBeginning2 = 0;
	$mTotalBeginning3 = 0;
	$mTotalBeginning4 = 0;
	echo $mysqli->error;
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



					$mTotalBeginning1 = floatval($mTotalBeginning1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalBeginning2 = floatval($mTotalBeginning2) + floatval($ado["LastAmount_no"]); 
					$mTotalBeginning3 = floatval($mTotalBeginning3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalBeginning4 = floatval($mTotalBeginning4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);


//revise to get the begining inventory for this month from the ending inventory of last month
	$mTotalBeginning3 = 0;//fs_Get_Begining_This_Month($mMonth1,$mYear1,$mMonth2,$mYear2,$mStatus);
//revise to get the begining inventory for this month from the ending inventory of last month



	$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalBeginning1); 
	$mTotalAvailable2 = floatval($mTotalAvailable2) + floatval($mTotalBeginning2); 
	$mTotalAvailable3 = floatval($mTotalAvailable3) + floatval($mTotalBeginning3); 
	$mTotalAvailable4 = floatval($mTotalAvailable4) + floatval($mTotalBeginning4); 




	if (floatval($mTotalBeginning1) > 0) { $mTotalBeginning1 = number_format($mTotalBeginning1,2); }
	elseif (floatval($mTotalBeginning1) < 0) { $mTotalBeginning1 = "(".number_format(abs($mTotalBeginning1),2).")"; }		
	else $mTotalBeginning1 = "-";

	if (floatval($mTotalBeginning2) > 0) { $mTotalBeginning2 = number_format($mTotalBeginning2,2); }
	elseif (floatval($mTotalBeginning2) < 0) { $mTotalBeginning2 = "(".number_format(abs($mTotalBeginning2),2).")"; }		
	else $mTotalBeginning2 = "-";

	if (floatval($mTotalBeginning3) > 0) { $mTotalBeginning3 = number_format($mTotalBeginning3,2); }
	elseif (floatval($mTotalBeginning3) < 0) { $mTotalBeginning3 = "(".number_format(abs($mTotalBeginning3),2).")"; }		
	else $mTotalBeginning3 = "-";

	if (floatval($mTotalBeginning4) > 0) { $mTotalBeginning4 = number_format($mTotalBeginning4,2); }
	elseif (floatval($mTotalBeginning4) < 0) { $mTotalBeginning4 = "(".number_format(abs($mTotalBeginning4),2).")"; }		
	else $mTotalBeginning4 = "-";


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Inventory-Beginning',0,0,'L');
	if ($mMonth1<>1)
	{	
	$pdf->Cell(25,4,$mTotalBeginning1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalBeginning4,0,0,'R');
	$pdf->Ln(4);
	}


	*/







//COST OF SALES - purchases

	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','3',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalPurchases1 = 0;
	$mTotalPurchases2 = 0;
	$mTotalPurchases3 = 0;
	$mTotalPurchases4 = 0;

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
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format($ado["CurrentAmount_no"],2).")"; }		
					else $mCurrentAmount = "-";

					if (floatval($ado["ThisAmount_no"]) > 0) { $mThisAmount = number_format($ado["ThisAmount_no"],2); }
					elseif (floatval($ado["ThisAmount_no"]) < 0) { $mThisAmount = "(".number_format(abs($ado["ThisAmount_no"]),2).")"; }		
					else $mThisAmount = "-";

					
					$mTotalPurchases1 = floatval($mTotalPurchases1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalPurchases2 = floatval($mTotalPurchases2) + floatval($ado["LastAmount_no"]); 
					$mTotalPurchases3 = floatval($mTotalPurchases3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalPurchases4 = floatval($mTotalPurchases4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);

	$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalPurchases1); 
	$mTotalAvailable2 = floatval($mTotalAvailable2) + floatval($mTotalPurchases2); 
	$mTotalAvailable3 = floatval($mTotalAvailable3) + floatval($mTotalPurchases3); 
	$mTotalAvailable4 = floatval($mTotalAvailable4) + floatval($mTotalPurchases4); 






	if (floatval($mTotalPurchases1) > 0) { $mTotalPurchases1 = number_format($mTotalPurchases1,2); }
	elseif (floatval($mTotalPurchases1) < 0) { $mTotalPurchases1 = "(".number_format(abs($mTotalPurchases1),2).")"; }		
	else $mTotalPurchases1 = "-";

	if (floatval($mTotalPurchases2) > 0) { $mTotalPurchases2 = number_format($mTotalPurchases2,2); }
	elseif (floatval($mTotalPurchases2) < 0) { $mTotalPurchases2 = "(".number_format(abs($mTotalPurchases2),2).")"; }		
	else $mTotalPurchases2 = "-";

	if (floatval($mTotalPurchases3) > 0) { $mTotalPurchases3 = number_format($mTotalPurchases3,2); }
	elseif (floatval($mTotalPurchases3) < 0) { $mTotalPurchases3 = "(".number_format(abs($mTotalPurchases3),2).")"; }		
	else $mTotalPurchases3 = "-";

	if (floatval($mTotalPurchases4) > 0) { $mTotalPurchases4 = number_format($mTotalPurchases4,2); }
	elseif (floatval($mTotalPurchases4) < 0) { $mTotalPurchases4 = "(".number_format(abs($mTotalPurchases4),2).")"; }		
	else $mTotalPurchases4 = "-";


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Purchases',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalPurchases1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalPurchases4,0,0,'R');
	$pdf->Ln(4);

	}

	*/

	if (floatval($mTotalAvailable1) > 0) { $mTotalAvailable1_ = number_format($mTotalAvailable1,2); }
	elseif (floatval($mTotalAvailable1) < 0) { $mTotalAvailable1_ = "(".number_format(abs($mTotalAvailable1),2).")"; }		
	else $mTotalAvailable1_ = "-";

	if (floatval($mTotalAvailable2) > 0) { $mTotalAvailable2_ = number_format($mTotalAvailable2,2); }
	elseif (floatval($mTotalAvailable2) < 0) { $mTotalAvailable2_ = "(".number_format(abs($mTotalAvailable2),2).")"; }		
	else $mTotalAvailable2_ = "-";

	if (floatval($mTotalAvailable3) > 0) { $mTotalAvailable3_ = number_format($mTotalAvailable3,2); }
	elseif (floatval($mTotalAvailable3) < 0) { $mTotalAvailable3_ = "(".number_format(abs($mTotalAvailable3),2).")"; }		
	else $mTotalAvailable3_ = "-";

	if (floatval($mTotalAvailable4) > 0) { $mTotalAvailable4_ = number_format($mTotalAvailable4,2); }
	elseif (floatval($mTotalAvailable4) < 0) { $mTotalAvailable4_ = "(".number_format(abs($mTotalAvailable4),2).")"; }		
	else $mTotalAvailable4_ = "-";





//COST OF SALES - Total Available Goods For Sale
	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Total Available Goods for Sale',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalAvailable1_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable2_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable3_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable4_,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalAvailable4_,0,0,'R');
	$pdf->Ln(4);
	}
	*/






//COST OF SALES  - cost of sales
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','4',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalEnd1 = 0;
	$mTotalEnd2 = 0;
	$mTotalEnd3 = 0;
	$mTotalEnd4 = 0;

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



					$mTotalEnd1 = floatval($mTotalEnd1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalEnd2 = floatval($mTotalEnd2) + floatval($ado["LastAmount_no"]); 
					$mTotalEnd3 = floatval($mTotalEnd3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalEnd4 = floatval($mTotalEnd4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);
	
	$dTotalEnd1 = $mTotalEnd1;
	$dTotalEnd2 = $mTotalEnd2;
	$dTotalEnd3 = $mTotalEnd3;
	$dTotalEnd4 = $mTotalEnd4;


	$mTotalCost1 = floatval($mTotalAvailable1) - floatval($mTotalEnd1); 
	$mTotalCost2 = floatval($mTotalAvailable2) - floatval($mTotalEnd2); 
	//$mTotalCost3 = floatval($mTotalAvailable3) - floatval($mTotalEnd3); 
	$mTotalCost3 = floatval($mTotalAvailable3) - floatval($mTotalEnd3); 
	$mTotalCost4 = floatval($mTotalAvailable4) - floatval($mTotalEnd4); 



	if (floatval($mTotalEnd1) > 0) { $mTotalEnd1 = number_format($mTotalEnd1,2); }
	elseif (floatval($mTotalEnd1) < 0) { $mTotalEnd1 = "(".number_format(abs($mTotalEnd1),2).")"; }		
	else $mTotalEnd1 = "-";

	if (floatval($mTotalEnd2) > 0) { $mTotalEnd2 = number_format($mTotalEnd2,2); }
	elseif (floatval($mTotalEnd2) < 0) { $mTotalEnd2 = "(".number_format(abs($mTotalEnd2),2).")"; }		
	else $mTotalEnd2 = "-";

	if (floatval($mTotalEnd3) > 0) { $mTotalEnd3 = number_format($mTotalEnd3,2); }
	elseif (floatval($mTotalEnd3) < 0) { $mTotalEnd3 = "(".number_format(abs($mTotalEnd3),2).")"; }		
	else $mTotalEnd3 = "-";

	if (floatval($mTotalEnd4) > 0) { $mTotalEnd4 = number_format($mTotalEnd4,2); }
	elseif (floatval($mTotalEnd4) < 0) { $mTotalEnd4 = "(".number_format(abs($mTotalEnd4),2).")"; }		
	else $mTotalEnd4 = "-";


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Cost of Sales',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalEnd1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalEnd4,0,0,'R');
	$pdf->Ln(4);
	}

	*/






	if (floatval($mTotalCost1) > 0) { $mTotalCost1 = number_format($mTotalCost1,2); }
	elseif (floatval($mTotalCost1) < 0) { $mTotalCost1 = "(".number_format(abs($mTotalCost1),2).")"; }		
	else $mTotalCost1 = "-";

	if (floatval($mTotalCost2) > 0) { $mTotalCost2 = number_format($mTotalCost2,2); }
	elseif (floatval($mTotalCost2) < 0) { $mTotalCost2 = "(".number_format(abs($mTotalCost2),2).")"; }		
	else $mTotalCost2 = "-";

	if (floatval($mTotalCost3) > 0) { $mTotalCost3 = number_format($mTotalCost3,2); }
	elseif (floatval($mTotalCost3) < 0) { $mTotalCost3 = "(".number_format(abs($mTotalCost3),2).")"; }		
	else $mTotalCost3 = "-";

	if (floatval($mTotalCost4) > 0) { $mTotalCost4 = number_format($mTotalCost4,2); }
	elseif (floatval($mTotalCost4) < 0) { $mTotalCost4 = "(".number_format(abs($mTotalCost4),2).")"; }		
	else $mTotalCost4 = "-";


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Ending Inventory',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalCost1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalCost4,0,0,'R');
	$pdf->Ln(4);
	}
	*/
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



	/*
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,6,"GROSS PROFIT",0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalGross1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalGross2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalGross3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalGross4,0,0,'R');
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
	$pdf->Ln(10);
	}
	*/


//OPERATING EXPENSES
	/*
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Operating Expenses",0,0,'L');
	$pdf->Ln(7);
	*/

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
					/*					
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
					*/				
				}
		}
	mysqli_close($mysqli);





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

	/*
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
	$pdf->Ln(4);
	$pdf->Cell(89,6,"OPERATING INCOME",0,0,'L');
	$pdf->Cell(25,4,$mOperating1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mOperating4,0,0,'R');
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
	$pdf->Ln(10);

	}

	
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Other Income",0,0,'L');
	$pdf->Ln(7);
	*/

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
/*										
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
*/
				}
		}
	mysqli_close($mysqli);



	$mNet1 = floatval($mNet1) + floatval($mTotalOther1); 
	$mNet2 = floatval($mNet2) + floatval($mTotalOther2); 
	$mNet3 = floatval($mNet3) + floatval($mTotalOther3); 
	$mNet4 = floatval($mNet4) + floatval($mTotalOther4); 
	

	return $mNet4;

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


/*
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
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(89,6,"NET INCOME AFTER TAX",0,0,'L');
	$pdf->Cell(25,4,$mNetTax1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mNetTax4,0,0,'R');
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
	$pdf->Ln(4);

	}
	
*/










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





}






//for balance sheet 
function fs_Get_Ending_Inventory_LastYear($mMonth1,$mYear1,$mMonth2,$mYear2,$mStatus)
{

	$mNet1 = 0;
	$mNet2 = 0;
	$mNet3 = 0;
	$mNet4 = 0;
	
//SALES NET
	/*
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Sales Net",0,0,'L');
	$pdf->Ln(7);
	*/
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


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Sales Net',0,0,'L');
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
	*/



//COST OF SALES
/*
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(80,10,"Cost of Sales",0,0,'L');
	$pdf->Ln(7);
*/
	$mTotalAvailable1 = 0;
	$mTotalAvailable2 = 0;
	$mTotalAvailable3 = 0;
	$mTotalAvailable4 = 0;

	$mTotalCost1 = 0;
	$mTotalCost2 = 0;
	$mTotalCost3 = 0;
	$mTotalCost4 = 0;


//COST OF SALES - inventory Begining
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','2',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalBeginning1 = 0;
	$mTotalBeginning2 = 0;
	$mTotalBeginning3 = 0;
	$mTotalBeginning4 = 0;
	echo $mysqli->error;
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



					$mTotalBeginning1 = floatval($mTotalBeginning1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalBeginning2 = floatval($mTotalBeginning2) + floatval($ado["LastAmount_no"]); 
					$mTotalBeginning3 = floatval($mTotalBeginning3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalBeginning4 = floatval($mTotalBeginning4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);






if($mMonth1 ==1){
//revise to get the begining inventory for this month from the ending inventory of last month
	$mTotalBeginning3 = 0;// fs_Get_Begining_This_Month($mMonth1,$mYear1,$mMonth2,$mYear2,$mStatus);
//revise to get the begining inventory for this month from the ending inventory of last month
}
else
{
//revise to get the begining inventory for this month from the ending inventory of last month 
	$mTotalBeginning1 = 0;// fs_Get_Begining_This_Month($mMonth1,$mYear1-1,$mMonth2,$mYear2-1,$mStatus);
//revise to get the begining inventory for this month from the ending inventory of last month
//revise to get the begining inventory for this month from the ending inventory of last month
	$mTotalBeginning3 = 0;//fs_Get_Begining_This_Month($mMonth1,$mYear1,$mMonth2,$mYear2,$mStatus);
//revise to get the begining inventory for this month from the ending inventory of last month
}












	$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalBeginning1); 
	$mTotalAvailable2 = floatval($mTotalAvailable2) + floatval($mTotalBeginning2); 
	$mTotalAvailable3 = floatval($mTotalAvailable3) + floatval($mTotalBeginning3); 
	$mTotalAvailable4 = floatval($mTotalAvailable4) + floatval($mTotalBeginning4); 




	if (floatval($mTotalBeginning1) > 0) { $mTotalBeginning1 = number_format($mTotalBeginning1,2); }
	elseif (floatval($mTotalBeginning1) < 0) { $mTotalBeginning1 = "(".number_format(abs($mTotalBeginning1),2).")"; }		
	else $mTotalBeginning1 = "-";

	if (floatval($mTotalBeginning2) > 0) { $mTotalBeginning2 = number_format($mTotalBeginning2,2); }
	elseif (floatval($mTotalBeginning2) < 0) { $mTotalBeginning2 = "(".number_format(abs($mTotalBeginning2),2).")"; }		
	else $mTotalBeginning2 = "-";

	if (floatval($mTotalBeginning3) > 0) { $mTotalBeginning3 = number_format($mTotalBeginning3,2); }
	elseif (floatval($mTotalBeginning3) < 0) { $mTotalBeginning3 = "(".number_format(abs($mTotalBeginning3),2).")"; }		
	else $mTotalBeginning3 = "-";

	if (floatval($mTotalBeginning4) > 0) { $mTotalBeginning4 = number_format($mTotalBeginning4,2); }
	elseif (floatval($mTotalBeginning4) < 0) { $mTotalBeginning4 = "(".number_format(abs($mTotalBeginning4),2).")"; }		
	else $mTotalBeginning4 = "-";


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Inventory-Beginning',0,0,'L');
	if ($mMonth1<>1)
	{	
	$pdf->Cell(25,4,$mTotalBeginning1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalBeginning4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalBeginning4,0,0,'R');
	$pdf->Ln(4);
	}

	*/








//COST OF SALES - purchases

	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','3',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalPurchases1 = 0;
	$mTotalPurchases2 = 0;
	$mTotalPurchases3 = 0;
	$mTotalPurchases4 = 0;

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
					elseif (floatval($ado["CurrentAmount_no"]) < 0) { $mCurrentAmount = "(".number_format($ado["CurrentAmount_no"],2).")"; }		
					else $mCurrentAmount = "-";

					if (floatval($ado["ThisAmount_no"]) > 0) { $mThisAmount = number_format($ado["ThisAmount_no"],2); }
					elseif (floatval($ado["ThisAmount_no"]) < 0) { $mThisAmount = "(".number_format(abs($ado["ThisAmount_no"]),2).")"; }		
					else $mThisAmount = "-";

					
					$mTotalPurchases1 = floatval($mTotalPurchases1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalPurchases2 = floatval($mTotalPurchases2) + floatval($ado["LastAmount_no"]); 
					$mTotalPurchases3 = floatval($mTotalPurchases3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalPurchases4 = floatval($mTotalPurchases4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);

	$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalPurchases1); 
	$mTotalAvailable2 = floatval($mTotalAvailable2) + floatval($mTotalPurchases2); 
	$mTotalAvailable3 = floatval($mTotalAvailable3) + floatval($mTotalPurchases3); 
	$mTotalAvailable4 = floatval($mTotalAvailable4) + floatval($mTotalPurchases4); 






	if (floatval($mTotalPurchases1) > 0) { $mTotalPurchases1 = number_format($mTotalPurchases1,2); }
	elseif (floatval($mTotalPurchases1) < 0) { $mTotalPurchases1 = "(".number_format(abs($mTotalPurchases1),2).")"; }		
	else $mTotalPurchases1 = "-";

	if (floatval($mTotalPurchases2) > 0) { $mTotalPurchases2 = number_format($mTotalPurchases2,2); }
	elseif (floatval($mTotalPurchases2) < 0) { $mTotalPurchases2 = "(".number_format(abs($mTotalPurchases2),2).")"; }		
	else $mTotalPurchases2 = "-";

	if (floatval($mTotalPurchases3) > 0) { $mTotalPurchases3 = number_format($mTotalPurchases3,2); }
	elseif (floatval($mTotalPurchases3) < 0) { $mTotalPurchases3 = "(".number_format(abs($mTotalPurchases3),2).")"; }		
	else $mTotalPurchases3 = "-";

	if (floatval($mTotalPurchases4) > 0) { $mTotalPurchases4 = number_format($mTotalPurchases4,2); }
	elseif (floatval($mTotalPurchases4) < 0) { $mTotalPurchases4 = "(".number_format(abs($mTotalPurchases4),2).")"; }		
	else $mTotalPurchases4 = "-";


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Purchases',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalPurchases1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalPurchases4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalPurchases4,0,0,'R');
	$pdf->Ln(4);

	}
	*/


	if (floatval($mTotalAvailable1) > 0) { $mTotalAvailable1_ = number_format($mTotalAvailable1,2); }
	elseif (floatval($mTotalAvailable1) < 0) { $mTotalAvailable1_ = "(".number_format(abs($mTotalAvailable1),2).")"; }		
	else $mTotalAvailable1_ = "-";

	if (floatval($mTotalAvailable2) > 0) { $mTotalAvailable2_ = number_format($mTotalAvailable2,2); }
	elseif (floatval($mTotalAvailable2) < 0) { $mTotalAvailable2_ = "(".number_format(abs($mTotalAvailable2),2).")"; }		
	else $mTotalAvailable2_ = "-";

	if (floatval($mTotalAvailable3) > 0) { $mTotalAvailable3_ = number_format($mTotalAvailable3,2); }
	elseif (floatval($mTotalAvailable3) < 0) { $mTotalAvailable3_ = "(".number_format(abs($mTotalAvailable3),2).")"; }		
	else $mTotalAvailable3_ = "-";

	if (floatval($mTotalAvailable4) > 0) { $mTotalAvailable4_ = number_format($mTotalAvailable4,2); }
	elseif (floatval($mTotalAvailable4) < 0) { $mTotalAvailable4_ = "(".number_format(abs($mTotalAvailable4),2).")"; }		
	else $mTotalAvailable4_ = "-";





//COST OF SALES - Total Available Goods For Sale
	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Total Available Goods for Sale',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalAvailable1_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable2_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable3_,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalAvailable4_,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalAvailable4_,0,0,'R');
	$pdf->Ln(4);
	}
	*/



//COST OF SALES  - cost of sales
	include('datasource.php');
	$mResult = $mysqli->query("Call rp_IncomeStatement_Select ('1','4',".$mMonth1.",".$mYear1.",".$mMonth2.",".$mYear2.",'".$mStatus."')");

	$mLastYearAmount = "";
	$mLastAmount = "";
	$mCurrentAmount = "";
	$mThisAmount = "";

	$mTotalEnd1 = 0;
	$mTotalEnd2 = 0;
	$mTotalEnd3 = 0;
	$mTotalEnd4 = 0;

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



					$mTotalEnd1 = floatval($mTotalEnd1) + floatval($ado["LastYearAmount_no"]); 
					$mTotalEnd2 = floatval($mTotalEnd2) + floatval($ado["LastAmount_no"]); 
					$mTotalEnd3 = floatval($mTotalEnd3) + floatval($ado["CurrentAmount_no"]); 
					$mTotalEnd4 = floatval($mTotalEnd4) + floatval($ado["ThisAmount_no"]); 
				}
		}
	mysqli_close($mysqli);
	
	$dTotalEnd1 = $mTotalEnd1;
	$dTotalEnd2 = $mTotalEnd2;
	$dTotalEnd3 = $mTotalEnd3;
	$dTotalEnd4 = $mTotalEnd4;


	$mTotalCost1 = floatval($mTotalAvailable1) - floatval($mTotalEnd1); 
	$mTotalCost2 = floatval($mTotalAvailable2) - floatval($mTotalEnd2); 
	//$mTotalCost3 = floatval($mTotalAvailable3) - floatval($mTotalEnd3); 
	$mTotalCost3 = floatval($mTotalAvailable3) - floatval($mTotalEnd3); 
	$mTotalCost4 = floatval($mTotalAvailable4) - floatval($mTotalEnd4); 



	if (floatval($mTotalEnd1) > 0) { $mTotalEnd1 = number_format($mTotalEnd1,2); }
	elseif (floatval($mTotalEnd1) < 0) { $mTotalEnd1 = "(".number_format(abs($mTotalEnd1),2).")"; }		
	else $mTotalEnd1 = "-";

	if (floatval($mTotalEnd2) > 0) { $mTotalEnd2 = number_format($mTotalEnd2,2); }
	elseif (floatval($mTotalEnd2) < 0) { $mTotalEnd2 = "(".number_format(abs($mTotalEnd2),2).")"; }		
	else $mTotalEnd2 = "-";

	if (floatval($mTotalEnd3) > 0) { $mTotalEnd3 = number_format($mTotalEnd3,2); }
	elseif (floatval($mTotalEnd3) < 0) { $mTotalEnd3 = "(".number_format(abs($mTotalEnd3),2).")"; }		
	else $mTotalEnd3 = "-";

	if (floatval($mTotalEnd4) > 0) { $mTotalEnd4 = number_format($mTotalEnd4,2); }
	elseif (floatval($mTotalEnd4) < 0) { $mTotalEnd4 = "(".number_format(abs($mTotalEnd4),2).")"; }		
	else $mTotalEnd4 = "-";


	/*
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Cost of Sales',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalEnd1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalEnd4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalEnd4,0,0,'R');
	$pdf->Ln(4);
	}

	*/




	return $mTotalCost1;

	if (floatval($mTotalCost1) > 0) { $mTotalCost1 = number_format($mTotalCost1,2); }
	elseif (floatval($mTotalCost1) < 0) { $mTotalCost1 = "(".number_format(abs($mTotalCost1),2).")"; }		
	else $mTotalCost1 = "-";

	if (floatval($mTotalCost2) > 0) { $mTotalCost2 = number_format($mTotalCost2,2); }
	elseif (floatval($mTotalCost2) < 0) { $mTotalCost2 = "(".number_format(abs($mTotalCost2),2).")"; }		
	else $mTotalCost2 = "-";

	if (floatval($mTotalCost3) > 0) { $mTotalCost3 = number_format($mTotalCost3,2); }
	elseif (floatval($mTotalCost3) < 0) { $mTotalCost3 = "(".number_format(abs($mTotalCost3),2).")"; }		
	else $mTotalCost3 = "-";

	if (floatval($mTotalCost4) > 0) { $mTotalCost4 = number_format($mTotalCost4,2); }
	elseif (floatval($mTotalCost4) < 0) { $mTotalCost4 = "(".number_format(abs($mTotalCost4),2).")"; }		
	else $mTotalCost4 = "-";



	/*$pdf->SetFont('Arial','',7);
	$pdf->Cell(5);
	$pdf->Cell(84,4,'Ending Inventory',0,0,'L');
	if ($mMonth1<>1)
	{
	$pdf->Cell(25,4,$mTotalCost1,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost2,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost3,0,0,'R');
	$pdf->Cell(2);
	$pdf->Cell(25,4,$mTotalCost4,0,0,'R');
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
	$pdf->Cell(25,4,$mTotalCost4,0,0,'R');
	$pdf->Ln(4);
	}

	*/

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



}
















?>
