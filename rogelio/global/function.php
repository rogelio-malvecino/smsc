<?php

function Is_Logged_In () 
	{
  		if (!($_SESSION["UserID"]) || $_SESSION["UserID"] =="") 
			{
    			Header("Location: ./baseline.php?Start=1");
    			exit();
				return 0;
			}
  	}

//get specific data
function fp_Get_Record($mField, $mTable, $mCondition)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition."')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);
				$Result = $ado[$mField];
			}				
		mysqli_close($mysqli);			
		return $Result;
	}


//get specific data
function fp_Get_Record_($mField, $mTable, $mCondition)
	{
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition."')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);
				$Result = $ado[$mField];
			}				
		mysqli_close($mysqli);			
		return $Result;
	}
		

//get record count
function fp_Get_Record_Count($mField, $mTable, $mCondition)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition."')");

		$Result = mysqli_num_rows($mResult);
		if ($Result == '') { $Result = '0'; }
		return $Result;
	}



function fp_Get_Record_Count_($mField, $mTable, $mCondition)
	{
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition."')");

		$Result = mysqli_num_rows($mResult);
		if ($Result == '') { $Result = '0'; }
		return $Result;
	}


		
// get total number of records from a table
function fp_Get_Total_Record($mTable, $mCondition)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT COUNT(*) AS TotCount FROM ".$mTable." WHERE ".$mCondition."')");

		$Result = 0;	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);
				$Result = $ado['TotCount'];
			}				
		mysqli_close($mysqli);			

		return $Result;
	}



		
// get total page from a record
function fp_Get_Total_Page($mTotResult)
	{
		$Result = (int)($mTotResult) / $_SESSION['Page'];

		if (($mTotResult / $_SESSION['Page']) > $Result)
			{
				$Result = $mTotPage + 1;
			} 

		return $Result;
	}


function fp_Auto_CSInventoryNumber($mField, $mTable, $mCondition)
	{
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition." ORDER BY ".$mField." DESC LIMIT 1')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				$mNumber = '0';
				switch (strlen((int) ($ado[$mField] + 1))) 
					{
						case 1:
							$mNumber = '000000000';
							break;
						case 2:
							$mNumber = '00000000';
							break;
						case 3:
							$mNumber = '0000000';
							break;
						case 4:
							$mNumber = '000000';
							break;
						case 5:
							$mNumber = '00000';
							break;
						case 6:
							$mNumber = '0000';
							break;
						case 7:
							$mNumber = '000';
							break;
						case 8:
							$mNumber = '00';
							break;
						case 9:
							$mNumber = '0';
							break;
					}
				return $mNumber.((int) ($ado[$mField] + 1));
			}
		else
			{
				return	'0000000001';
			}				
		mysqli_close($mysqli);			
	}



function fp_Auto_DTRNumber($mField, $mTable, $mCondition)
	{
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition." ORDER BY ".$mField." DESC LIMIT 1')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				$mNumber = '0';
				switch (strlen((int) ($ado[$mField] + 1))) 
					{
						case 1:
							$mNumber = '000000000';
							break;
						case 2:
							$mNumber = '00000000';
							break;
						case 3:
							$mNumber = '0000000';
							break;
						case 4:
							$mNumber = '000000';
							break;
						case 5:
							$mNumber = '00000';
							break;
						case 6:
							$mNumber = '0000';
							break;
						case 7:
							$mNumber = '000';
							break;
						case 8:
							$mNumber = '00';
							break;
						case 9:
							$mNumber = '0';
							break;
					}
				return $mNumber.((int) ($ado[$mField] + 1));
			}
		else
			{
				return	'0000000001';
			}				
		mysqli_close($mysqli);			
	}


//get user rights
function fp_Update_Rights($mSP, $mRightsID, $mAccessID)
	{
		include ("datasource.php");
		$Result = $mysqli->query("Call sp_".$mSP."_Insert('".$_SESSION['UserID']."',".$_SESSION['CenterID'].",'".$mRightsID."','".$mAccessID."')");
		mysqli_close($mysqli);			

		return $Result;
	}
	
	
	
	
	
function get_rnd_iv($iv_len)
	{
   		$iv = '';
   		while ($iv_len-- > 0) 
			{
       			$iv .= chr(mt_rand() & 0xff);
   			}
   		return $iv;
	}

function md5_encrypt($plain_text, $password, $iv_len = 16)
	{
   		$plain_text .= "\x13";
   		$n = strlen($plain_text);
   		if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));
   		$i = 0;
   		$enc_text = get_rnd_iv($iv_len);
   		$iv = substr($password ^ $enc_text, 0, 512);
   
   		while ($i < $n) 
			{
       			$block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
       			$enc_text .= $block;
       			$iv = substr($block . $iv, 0, 512) ^ $password;
       			$i += 16;
   			}
   		return base64_encode($enc_text);
	}

function md5_decrypt($enc_text, $password, $iv_len = 16)
	{
   		$enc_text = base64_decode($enc_text);
   		$n = strlen($enc_text);
   		$i = $iv_len;
   		$plain_text = '';
   		$iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
   		
		while ($i < $n) 
			{
       			$block = substr($enc_text, $i, 16);
       			$plain_text .= $block ^ pack('H*', md5($iv));
       			$iv = substr($block . $iv, 0, 512) ^ $password;
       			$i += 16;
   			}
   		return preg_replace('/\\x13\\x00*$/', '', $plain_text);
	}	
//display upload of document status
function fp_Upload_Document_Status($result, $filename)
	{
		if ($result == 1) { $_SESSION['SysMsg'] = 'Unable to Saved Record, '.$filename.' Greater than the maximum file size allowed!'; }
		if ($result == 2) { $_SESSION['SysMsg'] = 'Unable to Saved Record, '.$filename.' is Invalid File Type!'; }
		if ($result == 3) { $_SESSION['SysMsg'] = 'Unable to Saved Record, '.$filename.' Already Exists!'; }
		return 0;
	}


//display upload of picture status
function fp_Upload_Picture_Status($result, $filename)
	{
		if ($result == 1) { $_SESSION['SysMsg'] = 'Unable to Saved Record, '.$filename.' Greater than the maximum file size allowed!'; }
		if ($result == 2) { $_SESSION['SysMsg'] = 'Unable to Saved Record, '.$filename.' is Invalid File Type!'; }
		if ($result == 3) { $_SESSION['SysMsg'] = 'Unable to Saved Record, '.$filename.' Already Exists!'; }
		return 0;
	}
	
	
	

//auto number
function fp_Auto_Number($mField, $mTable, $mCondition)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition." ORDER BY ".$mField." DESC LIMIT 1')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				$mNumber = '0';
				switch (strlen((int) (substr($ado[$mField],6,7) + 1))) 
					{
						case 1:
							$mNumber = '000000';
							break;
						case 2:
							$mNumber = '00000';
							break;
						case 3:
							$mNumber = '0000';
							break;
						case 4:
							$mNumber = '000';
							break;
						case 5:
							$mNumber = '00';
							break;
						case 6:
							$mNumber = '0';
							break;
					}
				
				return date("ymd").$mNumber.((int) substr($ado[$mField],7,7) + 1);
			}
		else
			{
				return	date("ymd").'0000001';
			}				
		mysqli_close($mysqli);			
	}












//upload picture
function fp_Upload_Picture($filename, $filetmp, $filesize, $filetype)
	{
		$numoffiles = 1;
		
		$uploaddir = 'C:/Inetpub/wwwroot/gng/pictures/';
		for ($i =0; $i<$numoffiles; $i++)
			{
				$ext = strtoupper(substr(strrchr($filename, "."),1));
				$conf = $uploaddir . $filename;
				$filepath = $uploaddir . $filename;
			
				if ($filename != "")
					{
						if (!file_exists($filepath))
							{
								if ($ext == "JPG" || $ext == "GIF" || $ext == "TIFF" || $ext == "PNG" || $ext == "BMP")
									{
										if ($filesize < "500000")
											{
												$upload = move_uploaded_file($filetmp, $filepath);
												return 0;						
											}
										else
											{
												return 1;
											}
									}
								else
									{
										return 2;
									}	
							}
						else
							{
								return 3;
							}
					}

			}
	}

//upload document
function fp_Upload_Document($filedir, $filename, $filetmp, $filesize, $filetype)
	{
		$numoffiles = 1;
		
		$uploaddir = 'C:/Inetpub/wwwroot/gng/documents/'.$filedir;
		for ($i =0; $i<$numoffiles; $i++)
			{
				$ext = strtoupper(substr(strrchr($filename, "."),1));
				$conf = $uploaddir . $filename;
				$filepath = $uploaddir . $filename;
			
				if ($filename != "")
					{
						if (!file_exists($filepath))
							{
								if ($ext == "DOC" || $ext == "PDF")
									{
										$upload = move_uploaded_file($filetmp, $filepath);
										return 0;						
									}
								else
									{
										return 2;
									}	
							}
						else
							{
								return 3;
							}
					}

			}
	}







//update timekeeping
function fp_Update_Timekeeping($mID, 
							   $mHoursWork, 
							   $mHoursLate, 
							   $mHoursUnderTime, 
							   $mAbsent, 
							   $mLegalHoliday, 
							   $mLeave, 
							   $mRegular, 
							   $mSpecialHoliday)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_StaffTimekeepingHDR_Update('".$mID."',"
		                                                                .$mHoursWork.","
																		.$mHoursLate.","
																		.$mHoursUnderTime.","
																		.$mAbsent.","
																		.$mLegalHoliday.","
																		.$mLeave.","
																		.$mRegular.","
																		.$mSpecialHoliday.")");
		mysqli_close($mysqli);			
		return $mResult;
	}
	
	
	

function DateAdd($v,$d=null , $f="d/m/Y"){ 
  $d=($d?$d:date("Y-m-d")); 
  return date($f,strtotime($v." days",strtotime($d))); 
}


function fp_Display_PayPeriod($mCutOff, $mMonth, $mYear)
	{
		if ($mCutOff=='0') 
			{ 
				$mMonth1 = date("F",mktime(0,0,0,$mMonth-1,0,0));
				$mDay1 = '26'; 
				$mMonth2 = date("F",mktime(0,0,0,$mMonth,0,0));
				$mDay2 = '10'; 
				$mYear1 = $mYear;

				$mPeriod =  $mMonth1.' '.$mDay1.' to '.$mMonth2.' '.$mDay2.' '.$mYear1;

				if ($mMonth-1==1) 
					{
						$mYear1 = $mYear-1;
						$mYear2 = $mYear;

						$mPeriod =  $mMonth1.' '.$mDay1.' '.$mYear1.' to '.$mMonth2.' '.$mDay2.' '.$mYear2;
					}
			} 
		else 
			{ 
				$mMonth1 = date("F",mktime(0,0,0,$mMonth,0,0));
				$mDay1 = '11'; 
				$mMonth2 = date("F",mktime(0,0,0,$mMonth,0,0));
				$mDay2 = '25'; 
				$mYear1 = $mYear;
				$mYear2 = $mYear;

				$mPeriod =  $mMonth1.' '.$mDay1.' to '.$mDay2.' '.$mYear1;
			}

		return $mPeriod;
	}






//add detail
function fp_Add_StockDetail($mTable, $mControlNo, $mRec, $mData)
	{
		$mData = explode("*", $mData);
		$i = 1;

		if ($mTable=='tb_tunittaggingdtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mCost) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".rtrim(trim($mIMENo))."'',".$mQty.",".$mCost.")')");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
			}
		elseif ($mTable=='tb_treceivingreportdtl_')
			{
				include ("datasource.php");
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mPurchase) = split('!', $mData[$i-1]);
						
						$mCentral = fp_Get_Record("Central_no","tb_mitem","ItemID_cd=''".$mItemID."''");
						$mSelling = fp_Get_Record("Selling_no","tb_mitem","ItemID_cd=''".$mItemID."''");
						
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_treceivingreportdtl VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',1,".$mPurchase.",".$mCentral.",".$mSelling.")')");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
			}
		elseif ($mTable=='tb_treceivingreportdtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mPurchase, $mCentral, $mSelling) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mPurchase.",".$mCentral.",".$mSelling.")')");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
			}
		elseif ($mTable=='tb_tphysicalcountdtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mSelling.")')");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
			}
		elseif ($mTable=='tb_tsalesinvoicedtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling, $mDiscount, $mRetail) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mSelling.",".$mDiscount.")')");
						mysqli_close($mysqli);			

						$i = $i + 1;
					}	
			}
		elseif ($mTable=='tb_titemallocationdtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mSeq, $mBranchID, $mItemID, $mQty) = split('!', $mData[$i-1]);
		
						include ("datasource.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$mSeq.",''".$mBranchID."'',''".$mItemID."'',".$mQty.")')");
						mysqli_close($mysqli);			

						$i = $i + 1;
					}	
			}
		else
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mSelling.")')");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
			}
		return $mResult;
	}









//add detail
function fp_Add_MasterDetail($mTable, $mControlNo, $mRec, $mData)
	{
		$mData = explode("*", $mData);
		$i = 1;

		if ($mTable=='tb_tchangepricedtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mOldSelling, $mNewSelling) = split('!', $mData[$i-1]);
		
						include ("datasource.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',".$mOldSelling.",".$mNewSelling.")')");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
			}
		return $mResult;
	}








//add detail
function fp_Add_PaymasterDetail($mUserID, $mCenterID, $mPaymasterID, $mPaymasterName, $mRec, $mData)
	{
		$iPaymasterID = '';
		$mSubsidiaryDesc = '';
		
		$mData = explode("*", $mData);
		$i = 1;

		while ($i <= $mRec)
			{ 	
				$mSubsidiaryID = '';									
				list($mAccountID) = split('!', $mData[$i-1]);

				include ("datasource.php");
				$mSubsidiaryDesc =  fp_Get_Record("SubsidiaryDesc_tx","tb_mcoadtl", "AccountID_cd = ''".$mAccountID."'' AND SubsidiaryDesc_tx = ''".$mPaymasterName."''");
				mysqli_close($mysqli);
				
				
				if ($mSubsidiaryDesc=='')
					{
						include ("datasource.php");
						$mSubsidiaryID = fp_Subsidiary_Auto_Number($mAccountID);

						$mResult = $mysqli->query("Call sp_PaymasterSubsidiaryAccount_Insert('".$mUserID."',"
																							   .$mCenterID.",'"
																							   .$mAccountID."',"
																							   .(int)substr($mSubsidiaryID,5,4).",'"
																							   .$mSubsidiaryID."','"
																							   .$mPaymasterName."','"
																							   .$mPaymasterID."')");
						mysqli_close($mysqli);
					}
				else
					{
						include ("datasource.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('UPDATE tb_mcoadtl 
																		  SET SubsidiaryDesc_tx = ''".$mPaymasterName."''
																		  WHERE AccountID_cd = ''".$mAccountID."'' AND 
																		  PaymasterID_cd = ''".$mPaymasterID."'')");
						mysqli_close($mysqli);
					}

				include ("datasource.php");
				$mResult = $mysqli->query("Call sp_PaymasterAccount_Insert('".$mPaymasterID."','"
																			 .$mAccountID."','"
																	         .$mSubsidiaryID."')");				
				mysqli_close($mysqli);

				

				$i = $i + 1;
			}	
		return $mResult;
	}





//add detail
function fp_Add_FinancialDetail($mTable, $mControlNo, $mRec, $mData)
	{
		$mData = explode("*", $mData);
		$i = 1;

		while ($i <= $mRec)
			{ 										
				include ("datasource_.php");
				list($mAccountID, $mAccountTitle, $mSubsidiaryID, $mDebit, $mCredit) = split('!', $mData[$i-1]);
				$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$i.",''".$mAccountID."'',''".$mSubsidiaryID."'',".$mDebit.",".$mCredit.")')");
				mysqli_close($mysqli);		
				
				$i = $i + 1;
			}	
		return $mResult;
	}




function fp_Subsidiary_Auto_Number($mValue)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT * FROM tb_mcoadtl WHERE AccountID_cd = ''".$mValue."'' ORDER BY SubsidiaryID_cd DESC LIMIT 1')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				$mNumber = '0';
				switch (strlen((int) (substr($ado['SubsidiaryID_cd'],5,4) + 1))) 
					{
						case 1:
							$mNumber = '000';
							break;
						case 2:
							$mNumber = '00';
							break;
						case 3:
							$mNumber = '0';
							break;
					}
				return $mValue.$mNumber.((int) substr($ado['SubsidiaryID_cd'],5,4) + 1);
			}
		else
			{
				return	$mValue.'0001';
			}				
		mysqli_close($mysqli);			
	}






//get beginning inventory
function fp_Get_Stock_BegBalance($mType, $mPeriod, $mPaymasterID, $mItemID)
	{

		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_StockBegBalance_Search('".$mType."','".$mPeriod."','".$mPaymasterID."','".$mItemID."')");

		$Result = 0;	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);
				if (floatval($ado['TotPC']) > 0)
					{
						$mBeg = $ado['TotPC'];
					}
				else
					{
						$mBeg = $ado['Beg'];
					}
				$Result = $mBeg;
			}				
		mysqli_close($mysqli);			
		return $Result;
	}


//get beginning trial balance
function fp_Beginning_TrialBalance($mControlNo, $mJournal, $mStartDate, $mEndDate, $mType)
	{
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_TrialBalance_Select('".$mControlNo."','"
															     .$mJournal."','"
																 .$mStartDate."','"
																 .$mEndDate."')");
		$mBeginning = 0;
		$mBegDebit = 0;
		$mBegCredit = 0;

		$Result = 0;	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				$mBegDebit = $ado["Debit"];
				$mBegCredit = $ado["Credit"];
			}				
		mysqli_close($mysqli);			

		if ($mType=="1") { return $mBegDebit; }
		if ($mType=="2") { return $mBegCredit; }
	}



function fp_Auto_InventoryNumber($mField, $mTable, $mCondition)
	{
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition." ORDER BY ".$mField." DESC LIMIT 1')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				$mNumber = '0';
				switch (strlen((int) ($ado[$mField] + 1))) 
					{
						case 1:
							$mNumber = '0000';
							break;
						case 2:
							$mNumber = '000';
							break;
						case 3:
							$mNumber = '00';
							break;
						case 4:
							$mNumber = '0';
							break;
					}
				return $mNumber.((int) ($ado[$mField] + 1));
			}
		else
			{
				return	'00001';
			}				
		mysqli_close($mysqli);			
	}


function fp_Auto_MasterNumber($mField, $mTable, $mCondition)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition." ORDER BY ".$mField." DESC LIMIT 1')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				$mNumber = '0';
				switch (strlen((int) ($ado[$mField] + 1))) 
					{
						case 1:
							$mNumber = '0000';
							break;
						case 2:
							$mNumber = '000';
							break;
						case 3:
							$mNumber = '00';
							break;
						case 4:
							$mNumber = '0';
							break;
					}
				return $mNumber.((int) ($ado[$mField] + 1));
			}
		else
			{
				return	'00001';
			}				
		mysqli_close($mysqli);			
	}



function fp_Auto_AdminMasterNumber($mModule, $mField, $mTable, $mCondition)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition." ORDER BY ".$mField." DESC LIMIT 1')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				switch (strlen((int) (substr($ado[$mField],3,8) + 1))) 
					{
						case 1:
							$mNumber = '0000000';
							break;
						case 2:
							$mNumber = '000000';
							break;
						case 3:
							$mNumber = '00000';
							break;
						case 4:
							$mNumber = '0000';
							break;
						case 5:
							$mNumber = '000';
							break;
						case 6:
							$mNumber = '00';
							break;
						case 7:
							$mNumber = '0';
							break;
						case 8:
							$mNumber = '';
							break;
					}
				return $mModule.$mNumber.((int) (substr($ado[$mField],2,8) + 1));
			}
		else
			{
				return	$mModule.'00000001';
			}				
		mysqli_close($mysqli);			
	}







//auto number
function fp_Auto_FinancialNumber($mField, $mTable, $mCondition)
	{
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition." ORDER BY ".$mField." DESC LIMIT 1')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				$mNumber = '0';
				switch (strlen((int)$ado[$mField] + 1)) 
					{
						case 1:
							$mNumber = '0000';
							break;
						case 2:
							$mNumber = '000';
							break;
						case 3:
							$mNumber = '00';
							break;
						case 4:
							$mNumber = '0';
							break;
					}
				
				return $mNumber.((int) $ado[$mField] + 1);
			}
		else
			{
				return	'00001';
			}				
		mysqli_close($mysqli);			
	}
	

//auto number
function fp_Auto_CompanyNumber()
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT  * FROM tb_mcompany ORDER BY CompanyID_cd DESC LIMIT 1')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				$mNumber = '0';
				switch (strlen((int)substr($ado['CompanyID_cd'],6,5)+ 1)) 
					{
						case 1:
							$mNumber = '0000';
							break;
						case 2:
							$mNumber = '000';
							break;
						case 3:
							$mNumber = '00';
							break;
						case 4:
							$mNumber = '0';
							break;
					}
				
				return $mNumber.((int) substr($ado['CompanyID_cd'],6,5) + 1);
			}
		else
			{
				return	'00001';
			}				
		mysqli_close($mysqli);			
	}




//auto number
function fp_Auto_BranchNumber($mCompanyID)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT  * FROM tb_mbranch WHERE CompanyID_cd = ''".$mCompanyID."''ORDER BY BranchID_cd DESC LIMIT 1')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);

				$mNumber = '0';
				switch (strlen((int)substr($ado['BranchID_cd'],11,2)+ 1)) 
					{
						case 1:
							$mNumber = '0';
							break;
					}
				
				return $mNumber.((int) substr($ado['BranchID_cd'],11,2) + 1);
			}
		else
			{
				return	'01';
			}				
		mysqli_close($mysqli);			
	}



	
function birthday ($birthday, $today)
  	{
		list($year,$month,$day) = explode("-",$birthday);
		list($year1,$month1,$day1) = explode("-",$today);
		$year_diff  = $year1 - $year;
		$month_diff = $month1 - $month;
		$day_diff   = $day1 - $day;
		if ($month_diff < 0) $year_diff--;
		elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
		return $year_diff;
  	}
	


function fp_AutoPaymaster($mUserID,
						  $mCenterID,	
						  $mPatientName,
						  $mHomeAddress,
						  $mHomeTelNo,
						  $mEmail,
						  $mType)
	{
		include ("datasource.php");
		
		$mPaymasterID = '';	
		$mPaymasterID = fp_Get_Record("PaymasterID_cd","tb_mpaymaster", "PaymasterName_tx = ''".$mPatientName."''");

		if ($mPaymasterID=='')
			{
				$mPaymasterID = fp_Auto_Number("PaymasterID_cd","tb_mpaymaster","1=1");	
				$mResult = $mysqli->query("Call sp_Paymaster_Insert('".$mUserID."',"
																	  .$mCenterID.",'"
																	  .$mPaymasterID."','"
																	  .$mPatientName."','"
																	  ."',"
																	  ."0,'"
																	  .$mHomeAddress."','"
																	  .$mHomeTelNo."','"
																	  ."','"
																	  ."','"
																	  .$mEmail."','"
																	  ."',"
																	  ."0,'"
																	  .$mType."')");
			}
		mysqli_close($mysqli);
		return $mPaymasterID;
	}		




function fp_AutoRepostBooks($mUserID,
						    $mCenterID,	
							$mPost,
							$mStartDate,
							$mEndDate)
	{
		include ("datasource_.php");
		$mResult = '';
		$mResult = $mysqli->query("Call sp_Books_Repost('".$mUserID."',".$mCenterID.",'".$mPost."','".$mStartDate."','".$mEndDate."')");
		mysqli_close($mysqli);
		return $mResult;
	}


function fp_Security_Number()
	{
		return date("ymd").'318';
	}




function fp_UpdatePaymaster($mAction,
							$mBranchID,
							$mUserID,
						    $mCenterID,
							$mIPID,
							$mPaymasterID,
							$mPaymasterName,
							$mTIN,
							$mTerms,
						    $mAddress,
						    $mTelNo,
							$mFaxNo,
							$mURL,
							$mEmail,
							$mContactPerson,
							$PositionID,
							$mType)
	{
		include ("datasource.php");
		$mResult = '';

		$mKey = $mUserID.'!'.
				$mCenterID.'!'.
				$mIPID.'!'.
				$mPaymasterID.'!'.
				$mPaymasterName.'!'.
				$mTIN.'!'.
				$mTerms.'!'.
				$mAddress.'!'.
				$mTelNo.'!'.
				$mFaxNo.'!'.
				$mURL.'!'.
				$mEmail.'!'.
				$mContactPerson.'!'.
				$PositionID.'!'.
				$mType.'!'.
				$mBranchID;
				
		
		if ($mAction=='0')
			{
				$mResult = $mysqli->query("Call sp_PaymasterBranch_Insert('".$mUserID."','"
																			.$mCenterID."','"
																			.$mPaymasterID."','"
																			.$mPaymasterName."','"
																			.$mTIN."',"
																			.$mTerms.",'"
																			.$mAddress."','"
																			.$mTelNo."','"
																			.$mFaxNo."','"
																			.$mURL."','"
																			.$mEmail."','"
																			.$mContactPerson."',"
																			.$PositionID.",'"
																			.$mType."','"
																			.$mBranchID."','"
																			.md5_encrypt($mKey,'baseline')."')");
			}
		else
			{
				$mResult = $mysqli->query("Call sp_Paymaster_Update('".$mUserID."','"
																	  .$mCenterID."','"
																	  .$mPaymasterID."','"
																	  .$mPaymasterName."','"
																	  .$mTIN."',"
																	  .$mTerms.",'"
																	  .$mAddress."','"
																	  .$mTelNo."','"
																	  .$mFaxNo."','"
																	  .$mURL."','"
																	  .$mEmail."','"
																	  .$mContactPerson."',"
																	  .$PositionID.",'"
																	  .$mType."','"
																	  .md5_encrypt($mKey,'baseline')."')");
			}
			
		mysqli_close($mysqli);
		return $mResult;
	}






function fp_SubsidiaryLedger($mAccountID,
						     $mJournal,
						     $mMonth1,
							 $mDay1,
							 $mYear1,
							 $mMonth2,
							 $mDay2,
							 $mYear2)
	{

		$mStartDate = $_REQUEST['Year1'].'-'.((int)$_REQUEST['Month1']-1).'-'.$_REQUEST['Day1'];
		$mEndDate = $_REQUEST['Year2'].'-'.((int)$_REQUEST['Month2']-1).'-'.$_REQUEST['Day2'];
			
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_SubsidiaryBalance_Select('".$mAccountID."','"
																      .$mJournal."','"
																      .$mStartDate."','"
																      .$mEndDate."')");
		$iTotRec = mysqli_num_rows($mResult);
		
		$mTotalDebit = 0;
		$mTotalCredit = 0;
		
		$display_string = '';																						
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{ 
						$mTotalDebit = (float)$mTotalDebit + (float)$ado["Debit"];
						$mTotalCredit = (float)($mTotalCredit) + (float)$ado["Credit"];
							
						$mDebit = number_format($ado["Debit"],2);
						$mCredit = number_format($ado["Credit"],2);
															
						if ((float)$mDebit <= 0) { $mDebit = ''; }
						if ((float)$mCredit <= 0) { $mCredit = ''; }

						$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
												<td width=8% align=center class=detail14>&nbsp;</td>
												<td width=8% align=center class=detail14>
													<a href=generalledger_search.php?Start=1&ControlNo=".$ado["AccountID_cd"]."&SubsidiaryNo=".$ado["SubsidiaryID_cd"]."&Journal=".$mJournal."&Month1=".$mMonth1."&Day1=".$mDay1."&Year1=".$mYear1."&Month2=".$mMonth2."&Day2=".$mDay2."&Year2=".$mYear2.">".substr($ado["SubsidiaryID_cd"],5,4)."</a>&nbsp;
												</td>
												<td width=36% align=left class=detail1>".$ado["SubsidiaryDesc_tx"]."&nbsp;</td>
												<td width=12% align=right class=detail13>&nbsp;</td>
												<td width=12% align=right class=detail13>&nbsp;</td>
												<td width=12% align=right class=detail14>".$mDebit."&nbsp;</td>
												<td width=12% align=right class=detail14>".$mCredit."&nbsp;</td>
											</tr>";		
					}

				$display_string .= "<tr bgcolor=#EBEBEB onMouseOver=this.style.backgroundColor='#FFFFFF' onMouseOut=this.style.backgroundColor=''>
										<td colspan=5 align=left class=detail13>&nbsp;</td>
										<td width=12% align=right class=detail13><B>".number_format($mTotalDebit,2)."</B>&nbsp;</td>
										<td width=12% align=right class=detail13><B>".number_format($mTotalCredit,2)."</B>&nbsp;</td>
								    </tr>";
								
				$display_string .= "<tr bgcolor=#FFFFFF>
										<td height=20 colspan=8 align=center>&nbsp;</td>
									</tr>"; 
			}
		mysqli_close($mysqli);						
		return $display_string;
	}
	
	
	
	

function fp_Add_AutoSalesInvoice($mControlNo)
	{

		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_ItemAllocation_Post('".$mControlNo."')");

		$Result = 0;	
		if (mysqli_num_rows($mResult) > 0)
			{
				$Result = 1;
			}				
		mysqli_close($mysqli);			
		return $Result;
	}
?>