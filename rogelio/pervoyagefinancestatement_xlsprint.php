<?php
	session_start(); 
	include ("Functioneverwing.php");
	Is_Logged_In();
	require_once 'xls/phpxls/Writer.php';

	
	$workbook = new Spreadsheet_Excel_Writer();
	//format title
	$formathead =& $workbook->addFormat();
	$formathead->setBold();
	$formathead->setColor('black');
	$formathead->setFontFamily('Arial');
	$formathead->setSize(10);
	$fmt  =& $formathead;
	//format detail
	$formatdtl =& $workbook->addFormat();
	$formatdtl->setColor('black');
	$formatdtl->setFontFamily('Arial');
	$formatdtl->setSize(8);
	$fmtdtl  =& $formatdtl;
	//format number
	$formatnum =& $workbook->addFormat();
	$formatnum->setColor('black');
	$formatnum->setFontFamily('Arial');
	$formatnum->setNumFormat('0.00');
	$formatnum->setSize(8);
	$fmtdtl  =& $formatnum;
	
	$worksheet =& $workbook->addWorksheet("Per Voyage Finance Staement");
	
	$worksheet->protect("Rogelio");
	
	$mPeriod = $_REQUEST["mDateFrom"]." - ".$_REQUEST["mDateTo"];
	
	$worksheet->write(0,0,$_SESSION['S_CompanyName'], $fmt);
	$worksheet->write(1,0,"PER VOYAGE FINANCE STATEMENT", $fmt);
	$worksheet->write(2,0,"for the Period of - ".$mPeriod, $fmt);
	
	$worksheet->write(3,0,"Voyage Reference - ".$_REQUEST["mReference"], $fmt);
	
	$worksheet->setColumn(0,0, 10);//for title
	$worksheet->setColumn(0,1, 60);//for account name
	$worksheet->setColumn(0,2, 15);//for control number
	$worksheet->setColumn(0,3, 15);//for date
	$worksheet->setColumn(0,4, 100);//for particular
	$worksheet->setColumn(0,5, 15);//for amount
	
	$worksheet->write(6,0," ", $fmt);
	$worksheet->write(6,1,"ACCOUNT NAME", $fmt);
	$worksheet->write(6,2,"CONTROL#", $fmt);
	$worksheet->write(6,3,"DATE", $fmt);
	$worksheet->write(6,4,"PARTICULAR", $fmt);
	$worksheet->write(6,5,"AMOUNT", $fmt);
	
	
	$worksheet->write(7,0,"INCOME ", $fmt);
	
	$mRow=9;
	$mStartDate = $_REQUEST["mDateFrom"];
	$mEndDate = $_REQUEST["mDateTo"];
	$mVoyage = $_REQUEST["mReference"];
	$mStatus = $_REQUEST['Status'];
	
	
	$mTotalIncome =0;
	include('datasource.php');
	$mResult = $mysqli->query("CALL sp_pervoyagefinancestatementincome('".$mStartDate."','".$mEndDate."','".$mVoyage."','".$mStatus."')");
	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{	
					$mTotalIncome = $mTotalIncome + $ado['amount'];
					$worksheet->write($mRow,1,$ado['AccountDesc_tx'], $fmtdtl);
					$worksheet->write($mRow,2,$ado['control'], $fmtdtl);
					$worksheet->write($mRow,3,$ado['mDate'], $fmtdtl);
					$worksheet->write($mRow,4,$ado['Particular_tx'], $fmtdtl);
					$worksheet->write($mRow,5,$ado['amount'], $formatnum);
					$mRow++;
				}
		}
	mysqli_close($mysqli);

	$mRow++;
				$worksheet->write($mRow,1,"TOTAL INCOME", $fmt);
				$worksheet->write($mRow,5,$mTotalIncome, $fmt);
	$mRow++;
	$worksheet->write($mRow,0,"EXPENSES", $fmt);
	$mRow++;

	$mTotalExpense=0;
	include('datasource.php');
	$mResult = $mysqli->query("CALL sp_pervoyagefinancestatementexpense('".$mStartDate."','".$mEndDate."','".$mVoyage."','".$mStatus."')");
	if (mysqli_num_rows($mResult) > 0)
		{
			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					$mTotalExpense = $mTotalExpense + $ado['amount'];
					$worksheet->write($mRow,1,$ado['AccountDesc_tx'], $fmtdtl);
					$worksheet->write($mRow,2,$ado['control'], $fmtdtl);
					$worksheet->write($mRow,3,$ado['mDate'], $fmtdtl);
					$worksheet->write($mRow,4,$ado['Particular_tx'], $fmtdtl);
					$worksheet->write($mRow,5,$ado['amount'], $formatnum);
					$mRow++;
				}
		}
	mysqli_close($mysqli);
	$mRow++;
				$worksheet->write($mRow,1,"TOTAL EXPENSE", $fmt);
				$worksheet->write($mRow,5,$mTotalExpense, $fmt);
	
	$mRow++;
	$mNetIncome = $mTotalIncome -$mTotalExpense;
	
				$worksheet->write($mRow,0,"NET INCOME", $fmt);
				$worksheet->write($mRow,5,$mNetIncome, $fmt);
	
	
	$workbook->send('FinanceStatementPerVoyage.xls');
	$workbook->close();
?>
