<?php

function fp_Get_Consignment_Name($ConsignmentID)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('select distinct a.ItemConsignmentID_cd, b.PaymasterName_tx from tb_mitem a left join tb_mpaymaster b on a.ItemConsignmentID_cd = b.ConsignmentID_cd where a.ItemConsignmentID_cd = ".$ConsignmentID."')");
		$Result = 0;	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);
				$Result = $ado['PaymasterName_tx'];
			}				
		mysqli_close($mysqli);			
		return $Result;

	}
function fp_Get_Department_Name($DepartmentID)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('select ItemDepartmentName_tx from tb_mitemdepartment where ItemDepartmentID_cd = ".$DepartmentID."')");
		$Result = 0;	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);
				$Result = $ado['ItemDepartmentName_tx'];
			}				
		mysqli_close($mysqli);			
		return $Result;

	}
/*function Is_Logged_In () 
	{
  		if (!($_SESSION["UserID"]) || $_SESSION["UserID"] =="") 
			{
    			Header("Location: ./baseline.php?Start=1");
    			exit();
				return 0;
			}
  	}
*/	
//get it item must contains serial
function fp_Get_Record_SerialID($mField, $mTable, $mCondition)
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
//get commands button access rights
function fp_Get_Button_Access_Rights($mField, $mTable, $mCondition)
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

//updates the administrative branch selection	
function fp_Update_Branch_Select($mBranchID_cd)
	{
		include ("datasource.php");
		$Result = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_madminreportsetup values(''".$mBranchID_cd."'',1,1)')");
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

function fp_AutomateRR($mTable, $mControlNo, $mRec, $mData, $Paymaster)
{

include("datasource_master.php");
$mResult = $mysqli->query("Call sp_Execute_Query('SELECT DatabaseName_tx from tb_mbranch where BranchID_cd =(SELECT BranchID_cd from tb_mpaymaster where PaymasterID_cd =''".$Paymaster."'')')");
while($row=$mResult->fetch_array(MYSQLI_BOTH))
{
$DatabaseName = "gng_".$row['DatabaseName_tx'];
}

    $mData = explode("*", $mData);
    $i = 1;
    while ($i <= $mRec)
    {
        list($mItemID, $mIMENo, $mItemName, $mQty, $mPurchase, $mCentral, $mSelling, $mDiscount) = split('!', $mData[$i-1]);
        //include("datasource_branch.php");
	$mysqli = new mysqli('localhost',$_SESSION['User'],$_SESSION['Password'],$DatabaseName);
        $mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mPurchase.",".$mCentral.",".$mSelling.")')");

        mysqli_close($mysqli);
        $i = $i + 1;
    }
    return $mResult;

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
		/*elseif ($mTable=='tb_treceivingreportdtl_')
			{
				include ("datasource.php");
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mPurchase) = split('!', $mData[$i-1]);
						
						$mPurchase = fp_Get_Record("Purchase_no","tb_mitem","ItemID_cd=''".$mItemID."''");
						$mCentral = fp_Get_Record("Central_no","tb_mitem","ItemID_cd=''".$mItemID."''");
						$mSelling = fp_Get_Record("Selling_no","tb_mitem","ItemID_cd=''".$mItemID."''");
						
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_treceivingreportdtl VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',1,".$mPurchase.",".$mCentral.",".$mSelling.")')");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
			}
		*/
		elseif ($mTable=='tb_treceivingreportdtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mPurchase, $mCentral, $mSelling) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mPurchase.",".$mCentral.",".$mSelling.")')");
						mysqli_close($mysqli);
						/*if ($_SESSION['BranchID'] == "9901010000101")
							{
							include ("datasource.php");
        	    				        $mResult = $mysqli->query("Call sp_Execute_Query('UPDATE tb_mitem set Central_no = ".$mCentral.", Purchase_no = ".$mPurchase.", Date_change = ''".Date("Ymd")."'' where ItemID_cd = ''".$mItemID."''')");
							mysqli_close($mysqli);
							}
						*/
						$i = $i + 1;
					}	
			}
				
		elseif ($mTable=='tb_tsalesinvoicedtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mPurchase, $mCentral, $mSelling, $mDiscount) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO ".$mTable." VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mPurchase.",".$mCentral.",".$mSelling.",".$mDiscount.")')");
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
		elseif ($mTable=='tb_tstocktransferdtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_ST('".$mControlNo."',".$i.",'".$mItemID."','".$mIMENo."',".$mQty.",".$mSelling.")");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
			}
		elseif ($mTable=='tb_tstocktransferodtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_STo('".$mControlNo."',".$i.",'".$mItemID."','".$mIMENo."',".$mQty.",".$mSelling.")");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Stocktransfero_AutoTransfer('".$mControlNo."')");
						mysqli_close($mysqli);	
						echo $mysqli->error."Auto Transfer";	

			}
               elseif ($mTable=='tb_tphysicalcountdtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_PC('".$mControlNo."',".$i.",'".$mItemID."','".$mIMENo."',".$mQty.",".$mSelling.")");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
			}

		elseif ($mTable=='tb_tadjustmentindtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_AI('".$mControlNo."',".$i.",'".$mItemID."','".$mIMENo."',".$mQty.",".$mSelling.")");
						mysqli_close($mysqli);			
						$i = $i + 1;
					}	
			}
  		elseif ($mTable=='tb_tadjustmentoutdtl')
			{
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling) = split('!', $mData[$i-1]);
		
						include ("datasource_.php");
						$mResult = $mysqli->query("Call sp_Execute_AO('".$mControlNo."',".$i.",'".$mItemID."','".$mIMENo."',".$mQty.",".$mSelling.")");
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

//add detail for Automation entry of RR from Unit Tagging
function fp_Add_StockDetail_Get_RR($mTable, $mControlNo, $mRec, $mData, $mDate)
	{
		$mData = explode("*", $mData);
		$i = 1;

		if ($mTable=='tb_treceivingreportdtl_')
			{
				include ("datasource_.php");
				while ($i <= $mRec)
					{ 										
						list($mItemID, $mIMENo, $mPurchase) = split('!', $mData[$i-1]);
						
						$mPurchase = fp_Get_Record_Get_RR("Purchase_no","tb_treceivingreportdtl as dtl left join tb_treceivingreporthdr as hdr on hdr.rrid_cd=dtl.rrid_cd where hdr.rrdate_dt <= ''".$mDate."'' and ItemID_cd=''".$mItemID."'' order by hdr.rrdate_dt desc limit 1");
						$mCentral  = fp_Get_Record_Get_RR("Central_no","tb_treceivingreportdtl as dtl left join tb_treceivingreporthdr as hdr on hdr.rrid_cd=dtl.rrid_cd where hdr.rrdate_dt <= ''".$mDate."'' and ItemID_cd=''".$mItemID."'' order by hdr.rrdate_dt desc limit 1");
						$mSelling  = fp_Get_Record("Selling_no","tb_mitem","ItemID_cd=''".$mItemID."''");
												
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
						if ($_SESSION['BranchID'] == "9901010000101")
							{
							$mPurchaseRR = fp_Get_Record_Get_RR("Purchase_no","tb_treceivingreportdtl as dtl left join tb_treceivingreporthdr as hdr on hdr.rrid_cd=dtl.rrid_cd where hdr.rrdate_dt >= ''".$mDate."'' and ItemID_cd=''".$mItemID."'' order by hdr.rrdate_dt desc limit 1");
							$mCentralRR  = fp_Get_Record_Get_RR("Central_no","tb_treceivingreportdtl as dtl left join tb_treceivingreporthdr as hdr on hdr.rrid_cd=dtl.rrid_cd where hdr.rrdate_dt >= ''".$mDate."'' and ItemID_cd=''".$mItemID."'' order by hdr.rrdate_dt desc limit 1");
								if ($mPurchaseRR==0)
								{
								include ("datasource.php");
        	    				        	$mResult = $mysqli->query("Call sp_Execute_Query('UPDATE tb_mitem set Central_no = ".$mCentral.", Purchase_no = ".$mPurchase.", Date_change = ''".Date("Ymd")."'' where ItemID_cd = ''".$mItemID."''')");
								mysqli_close($mysqli);
								}
								else
								{
								include ("datasource.php");
        	    				        	$mResult = $mysqli->query("Call sp_Execute_Query('UPDATE tb_mitem set Central_no = ".$mCentralRR.", Purchase_no = ".$mPurchaseRR.", Date_change = ''".Date("Ymd")."'' where ItemID_cd = ''".$mItemID."''')");
								mysqli_close($mysqli);
								}
							}
						$i = $i + 1;
					}	
			}


	

	}
//get specific data from RR
function fp_Get_Record_Get_RR($mField, $mQuery)
	{
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mQuery."')");

		$Result = '';	
		if (mysqli_num_rows($mResult) > 0)
			{
				$ado = $mResult->fetch_array(MYSQLI_BOTH);
				$Result = $ado[$mField];
			}
		else
			{
			$Result = 0;
			}						
		mysqli_close($mysqli);			
		return $Result;
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
				include ("datasource.php");
				list($mAccountID, $mAccountTitle, $mSubsidiaryID, $mDebit, $mCredit) = explode('!', $mData[$i-1]);
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
						case 4:
							$mNumber = '';
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
function fp_Beginning_TrialBalance($mControlNo, $mJournal, $mStartDate, $mEndDate, $mType, $mStatus)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_TrialBalance_Select('".$mControlNo."','"
															     .$mJournal."','"
																 .$mStartDate."','"
																 .$mEndDate."','"
																 .$mStatus."')");
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
	if ($mTable=='tb_tphysicalcounthdr')
	{
		include ("datasource_.php");
    		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition." ORDER BY cast(".$mField." as unsigned) DESC LIMIT 1')");
        	$ado = $mResult->fetch_array(MYSQLI_BOTH);
	
		$mNumber = $ado[$mField] + 1;
		return $mNumber;
   		mysqli_close($mysqli);	
	}
	elseif ($mTable=='tb_tstocktransferohdr')
	{
		include ("datasource_.php");
    		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT ".$mField." FROM ".$mTable." WHERE ".$mCondition." ORDER BY cast(".$mField." as unsigned) DESC LIMIT 1')");
        	$ado = $mResult->fetch_array(MYSQLI_BOTH);
	
		$mNumber = $ado[$mField] + 1;
		return $mNumber;
   		mysqli_close($mysqli);	
	}

        else
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
		include ("datasource.php");
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
							$mEndDate,
							$mBook)
	{
		include ("datasource_.php");
		$mResult = '';
		$mResult = $mysqli->query("Call sp_Books_Repost('".$mUserID."',".$mCenterID.",'".$mPost."','".$mStartDate."','".$mEndDate."','".$mBook."')");
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



function fp_FormatPeriod($mMonth1, $mMonth2, $mDay1, $mDay2, $mYear1, $mYear2)
	{
		if (($mDay1 == $mDay2) && ($mMonth1 == $mMonth2) && ($mYear1 == $mYear2))
			{
				$mPeriod = date("F j, Y", mktime(0,0,0, $mMonth1, $mDay1, $mYear1));
			}

		if (($mDay1 <> $mDay2) && ($mMonth1 == $mMonth2) && ($mYear1 == $mYear2))
			{
				$mPeriod = date("F", mktime(0,0,0, intval($mMonth1)+1, 0, 0)).' '.$mDay1.'-'.$mDay2.', '.$mYear1;
			}

		if (($mDay1 <> $mDay2) && ($mMonth1 <> $mMonth2) && ($mYear1 == $mYear2))
			{
				$mPeriod = date("F", mktime(0,0,0, intval($mMonth1)+1, 0, 0)).' '.$mDay1.' to '.date("F", mktime(0,0,0, intval($mMonth2)+1, 0, 0)).' '.$mDay2.', '.$mYear1;
			}

		if (($mDay1 <> $mDay2) && ($mMonth1 <> $mMonth2) && ($mYear1 <> $mYear2))
			{
				$mPeriod = date("F", mktime(0,0,0, intval($mMonth1)+1, 0, 0)).' '.$mDay1.', '.$mYear1.' to '.date("F", mktime(0,0,0, intval($mMonth2)+1, 0, 0)).' '.$mDay2.', '.$mYear2;
			}

		if (($mDay1 == $mDay2) && ($mMonth1 <> $mMonth2) && ($mYear1 == $mYear2))
			{
				$mPeriod = date("F", mktime(0,0,0, intval($mMonth1)+1, 0, 0)).' '.$mDay1.' to '.date("F", mktime(0,0,0, intval($mMonth2)+1, 0, 0)).' '.$mDay2.', '.$mYear1;
			}

		if (($mDay1 == $mDay2) && ($mMonth1 <> $mMonth2) && ($mYear1 <> $mYear2))
			{
				$mPeriod = date("F", mktime(0,0,0, intval($mMonth1)+1, 0, 0)).' '.$mDay1.', '.$mYear1.' to '.date("F", mktime(0,0,0, intval($mMonth2)+1, 0, 0)).' '.$mDay2.', '.$mYear2;
			}

		if (($mDay1 == $mDay2) && ($mMonth1 == $mMonth2) && ($mYear1 <> $mYear2))
			{
				$mPeriod = date("F", mktime(0,0,0, intval($mMonth1)+1, 0, 0)).' '.$mDay1.', '.$mYear1.' to '.date("F", mktime(0,0,0, intval($mMonth2)+1, 0, 0)).' '.$mDay2.', '.$mYear2;
			}

		if (($mDay1 <> $mDay2) && ($mMonth1 == $mMonth2) && ($mYear1 <> $mYear2))
			{
				$mPeriod = date("F", mktime(0,0,0, intval($mMonth1)+1, 0, 0)).' '.$mDay1.', '.$mYear1.' to '.date("F", mktime(0,0,0, intval($mMonth2)+1, 0, 0)).' '.$mDay2.', '.$mYear2;
			}



		return $mPeriod;
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
function fp_CheckPhysicalCount($mIP, $mUserID, $mPassword, $mDatabaseName, $mControlNo)
	{
		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT * FROM tb_tphysicalcounthdr WHERE PCID_cd = ''".$mControlNo."''')");

		return "0";	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{ 
						return "1";						
					}
			}
		mysqli_close($mysqli);
	}





function fp_InsertPhysicalCountHDR($mIP, $mUserID, $mPassword, $mDatabaseName, $mUserID_, $mCenterID, $mControlNo, $mDate, $mReferenceNo, $mParticular, $mStatus, $mBaseline)
	{
		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_PhysicalCountHDR_Insert('".$mUserID_."'," .$mCenterID.",'".$mControlNo."','".$mDate."','".$mReferenceNo."','".addslashes($mParticular)."','".$mStatus."','".$mBaseline."')");
		mysqli_close($mysqli);

		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_PhysicalCount_RecSelect('".$mControlNo."')");
		
		$mData = "";
		$mRec  = 0;
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{
						$mRec = $mRec + 1; 							
						$mData = $mData.$ado['ItemID_cd'].'!'
									   .$ado['IMEID_cd'].'!'
									   .'!'
									   .$ado['Qty_no'].'!'
									   .$ado['Selling_no'].'!*';
					} 
			}
		mysqli_close($mysqli);



		$mData = explode("*", $mData);
		$i = 1;

		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_tphysicalcountdtl WHERE PCID_cd =''".$mControlNo."'')");
		mysqli_close($mysqli);		

		while ($i <= $mRec)
			{ 										
				list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling) = split('!', $mData[$i-1]);

				$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
				$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_tphysicalcountdtl VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mSelling.")')");
				mysqli_close($mysqli);			
				$i = $i + 1;
			}	

		return $mResult;																			 
	}
	

function fp_UpdatePhysicalCountHDR($mIP, $mUserID, $mPassword, $mDatabaseName, $mUserID_, $mCenterID, $mControlNo, $mDate, $mReferenceNo, $mParticular, $mStatus, $mBaseline)
	{
		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_PhysicalCountHDR_Update('".$mUserID_."'," .$mCenterID.",'".$mControlNo."','".$mDate."','".$mReferenceNo."','".addslashes($mParticular)."','".$mStatus."','".$mBaseline."')");
		mysqli_close($mysqli);
																			 
		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_PhysicalCount_RecSelect('".$mControlNo."')");

		$mData = "";
		$mRec = 0;
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{
						$mRec = $mRec + 1; 							
						$mData = $mData.$ado['ItemID_cd'].'!'.$ado['IMEID_cd'].'!!'.$ado['Qty_no'].'!'.$ado['Selling_no'].'!*';
					} 
			}
		mysqli_close($mysqli);

		$mData = explode("*", $mData);
		$i = 1;

		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_tphysicalcountdtl WHERE PCID_cd =''".$mControlNo."'')");
		mysqli_close($mysqli);		

		while ($i <= $mRec)
			{ 										
				list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling) = split('!', $mData[$i-1]);

				$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
				$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_tphysicalcountdtl VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mSelling.")')");
				mysqli_close($mysqli);			
				$i = $i + 1;
			}	

		return $mResult;																			 
	}
	





















function fp_CheckSalesInvoice($mIP, $mUserID, $mPassword, $mDatabaseName, $mControlNo)
	{
		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT * FROM tb_tsalesinvoicehdr WHERE SIID_cd = ''".$mControlNo."''')");

		if (mysqli_num_rows($mResult) > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}





function fp_InsertSalesInvoiceHDR($mIP,
								  $mUserID, 
								  $mPassword, 
								  $mDatabaseName, 
								  $mUserID_, 
								  $mCenterID, 
								  $mControlNo, 
								  $mDate, 
								  $mReferenceNo, 
								  $mPaymasterID,
								  $mEmployeeID,
								  $mPayTypeID,
								  $mBankID,
								  $mHolderName,
								  $mCardNo,
								  $mCardAmount,
								  $mCashAmount,
								  $mParticular,
								  $mRemarks,
								  $mStatus, 
								  $mBaseline)
	{
		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_SalesInvoiceHDR_Insert('".$mUserID_."'," .$mCenterID.",'".$mControlNo."','".$mDate."','".$mReferenceNo."','".$mPaymasterID."','".$mEmployeeID."','".$mPayTypeID."','".$mBankID."','".$mHolderName."','".$mCardNo."',".$mCardAmount.",".$mCashAmount.",'".addslashes($mParticular)."','".$mStatus."','".$mBaseline."')");
		mysqli_close($mysqli);

		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_SalesInvoice_RecSelect('".$mControlNo."')");
		
		$mData = "";
		$mRec  = 0;
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{
						$mRec = $mRec + 1; 							
						$mData = $mData.$ado['ItemID_cd'].'!'
									   .$ado['IMEID_cd'].'!'
									   .'!'
									   .$ado['Qty_no'].'!'
									   .$ado['Selling_no'].'!'
									   .$ado['Discount_no'].'!*';
					} 
			}
		mysqli_close($mysqli);



		$mData = explode("*", $mData);
		$i = 1;

		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_tsalesinvoicedtl WHERE SIID_cd =''".$mControlNo."'')");
		mysqli_close($mysqli);		

		while ($i <= $mRec)
			{ 										
				list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling, $mDiscount) = split('!', $mData[$i-1]);

				$central_mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
				$mResult = $central_mysqli->query("Call sp_Execute_Query('INSERT INTO tb_tsalesinvoicedtl VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mSelling.",".$mDiscount.")')");
				mysqli_close($central_mysqli);	

				$i = $i + 1;
			}	
		
		return $mResult;																			 
	}
	

function fp_UpdateSalesInvoiceHDR($mIP, 
								  $mUserID, 
								  $mPassword, 
								  $mDatabaseName, 
								  $mUserID_, 
								  $mCenterID, 
								  $mControlNo, 
								  $mDate, 
								  $mReferenceNo, 
								  $mPaymasterID,
								  $mEmployeeID,
								  $mPayTypeID,
								  $mBankID,
								  $mHolderName,
								  $mCardNo,
								  $mCardAmount,
								  $mCashAmount,
								  $mParticular,
								  $mStatus, 
								  $mBaseline)
	{
		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_SalesInvoiceHDR_Update('".$mUserID_."'," .$mCenterID.",'".$mControlNo."','".$mDate."','".$mReferenceNo."','".$mPaymasterID."','".$mEmployeeID."','".$mPayTypeID."','".$mBankID."','".$mHolderName."','".$mCardNo."',".$mCardAmount.",".$mCashAmount.",'".addslashes($mParticular)."','".$mStatus."','".$mBaseline."')");
		mysqli_close($mysqli);

		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_SalesInvoice_RecSelect('".$mControlNo."')");
		
		$mData = "";
		$mRec  = 0;
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{
						$mRec = $mRec + 1; 							
						$mData = $mData.$ado['ItemID_cd'].'!'
									   .$ado['IMEID_cd'].'!'
									   .'!'
									   .$ado['Qty_no'].'!'
									   .$ado['Selling_no'].'!'
									   .$ado['Discount_no'].'!*';
					} 
			}
		mysqli_close($mysqli);



		$mData = explode("*", $mData);
		$i = 1;

		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_tsalesinvoicedtl WHERE SIID_cd =''".$mControlNo."'')");
		mysqli_close($mysqli);		
		
		while ($i <= $mRec)
			{ 										
				list($mItemID, $mIMENo, $mItemName, $mQty, $mSelling, $mDiscount) = split('!', $mData[$i-1]);

				$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_".$mDatabaseName); 
				$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_tsalesinvoicedtl VALUES(''".$mControlNo."'',".$i.",''".$mItemID."'',''".$mIMENo."'',".$mQty.",".$mSelling.",".$mDiscount.")')");
				mysqli_close($mysqli);	

				$i = $i + 1;
			}	
		
		return $mResult;						
	}










	
	
	
	
	
	
	

	
	
	











	
	
	
	
	
	
function fp_DeleteCompany()
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_mcompany')");

		if ($mResult > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}


function fp_InsertCompany($mCompanyID,
						  $mCompanyName,
						  $mAddress,
						  $mTelNo,
						  $mBaseline)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_mcompany VALUES(''".$mCompanyID."'',''"
																						    .$mCompanyName."'',''"
																						    .$mAddress."'',''"
																						    .$mTelNo."'',''"
																						    .$mBaseline."'')')");

		mysqli_close($mysqli);
		return "1";						
	}








	
	
	
	
	
	
	
	
	
	
	




function fp_DeleteBranch()
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_mbranch')");

		if ($mResult > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}
	
	
function fp_InsertBranch($mCompanyID,
						 $mBranchID,
						 $mBranchNo,
						 $mBranchName,
						 $mShortName,
						 $mOrder,
						 $mAddress,
						 $mTelNo,
						 $mFaxNo,
						 $mEmailAddress,
						 $mSSS,
						 $mPHIC,
						 $mTIN,
						 $mDatabaseName,
						 $mLogo,
						 $mbaseline)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_mbranch VALUES(''".$mCompanyID."'',''"
																						   .$mBranchID."'',''"
																						   .$mBranchNo."'',''"
																						   .$mBranchName."'',''"
																						   .$mShortName."'',"
																						   .$mOrder.",''"
																						   .$mAddress."'',''"
																						   .$mTelNo."'',''"
																						   .$mFaxNo."'',''"
																						   .$mEmailAddress."'',''"
																						   .$mSSS."'',''"
																						   .$mPHIC."'',''"
																						   .$mTIN."'',''"
																						   .$mDatabaseName."'',''"
																						   .$mLogo."'',''"
																						   .$mbaseline."'')')");

		mysqli_close($mysqli);
		return "1";						
	}
	
	
	
	
	
	
	
	
	
	
	





function fp_DeleteItemDepartment()
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_mitemdepartment')");

		if ($mResult > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}


function fp_InsertItemDepartment($mItemDepartmentID,
								 $mItemDepartmentIDcd,
								 $mItemDepartmentName,
								 $mbaseline)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_mitemdepartment VALUES(".$mItemDepartmentID.",''"
																								 .$mItemDepartmentIDcd."'',''"
																								 .$mItemDepartmentName."'',''"
																								 .$mbaseline."'')')");
		mysqli_close($mysqli);
		return "1";						
	}
	
	
	
	
	
	
	
	
	
	
	

function fp_DeleteItemCategory()
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_mitemcategory')");

		if ($mResult > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}
	
	
function fp_InsertItemCategory($mItemCategoryID,
							   $mItemCategoryIDcd,
							   $mItemCategoryName,
							   $mbaseline)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_mitemcategory VALUES(".$mItemCategoryID.",''"
																							   .$mItemCategoryIDcd."'',''"
																							   .$mItemCategoryName."'',''"
																							   .$mbaseline."'')')");
		mysqli_close($mysqli);
		return "1";						
	}
	
	









function fp_DeleteItemSubCategory()
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_mitemsubcategory')");

		if ($mResult > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}
	
	
function fp_InsertItemSubCategory($mItemSubCategoryID,
							      $mItemSubCategoryIDcd,
							      $mItemSubCategoryName,
							      $mbaseline)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_mitemsubcategory VALUES(".$mItemSubCategoryID.",''"
																							      .$mItemSubCategoryIDcd."'',''"
																							      .$mItemSubCategoryName."'',''"
																							      .$mbaseline."'')')");
		mysqli_close($mysqli);
		return "1";						
	}
	
	
	
	
	
	
	
	


function fp_DeleteItemClass()
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_mitemclass')");

		if ($mResult > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}
	
	
function fp_InsertItemClass($mItemClassID,
							$mItemClassIDcd,
							$mItemClassName,
							$mbaseline)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_mitemclass VALUES(".$mItemClassID.",''"
																						    .$mItemClassIDcd."'',''"
																						    .$mItemClassName."'',''"
																						    .$mbaseline."'')')");
		mysqli_close($mysqli);
		return "1";						
	}
	





function fp_DeleteItemComponent()
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_mitemcomponent')");

		if ($mResult > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}


function fp_InsertItemComponent($mItemComponentID,
							    $mConsignment,
							    $mItemDepartmentID,
							    $mItemCategoryID,
							    $mItemSubCategoryID,
							    $mItemClassID,
							    $mItemConsignmentID,
							    $mPost,
								$mbaseline)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_mitemcomponent VALUES(".$mItemComponentID.",''"
																								.$mConsignment."'',''"
																								.$mItemDepartmentID."'',''"
																								.$mItemCategoryID."'',''"
																								.$mItemSubCategoryID."'',''"
																								.$mItemClassID."'',''"
																								.$mItemConsignmentID."'',''"
																								.$mPost."'',''"
																								.$mbaseline."'')')");
		mysqli_close($mysqli);
		return "1";						
	}
















function fp_CheckItem($mItemID)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT * FROM tb_mitem WHERE ItemID_cd = ''".$mItemID."''')");

		if (mysqli_num_rows($mResult) > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}
	

function fp_InsertItem($mUserID, 
					   $mCenterID, 
					   $mItemID, 
					   $mItemName, 
					   $mItemGroupID,
					   $mItemDepartmentID, 
					   $mItemCategoryID,
					   $ItemSubCategoryID,
					   $mItemClassID,
					   $mItemConsignmentID,
					   $mPurchase,
					   $mCentral,
					   $mSelling,
					   $mComments,
					   $mItemType, 
					   $mSerialID,
					   $mExpirationDate,
					   $mImage,
					   $mDMS, 
					   $mActive,
					   $mBaseline)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Item_Insert('".$mUserID."'," 
														 .$mCenterID.",'"
														 .$mItemID."','"
														 .$mItemName."',"
														 .$mItemGroupID.",'"
														 .$mItemDepartmentID."','"
														 .$mItemCategoryID."','"
														 .$ItemSubCategoryID."','"
														 .$mItemClassID."','"
														 .$mItemConsignmentID."',"
														 .$mPurchase.","
														 .$mCentral.","
														 .$mSelling.",'"
														 .$mComments."','"
														 .$mItemType."','"
														 .$mSerialID."','"
														 .$mExpirationDate."','"
														 .$mImage."','"
														 .$mDMS."','"
														 .$mActive."','"
														 .$mBaseline."')");
		mysqli_close($mysqli);

		return $mResult;																			 
	}
	














function fp_CheckPaymaster($mPaymasterID)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT * FROM tb_mpaymaster WHERE PaymasterID_cd = ''".$mPaymasterID."''')");

		if (mysqli_num_rows($mResult) > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}
	

function fp_InsertPaymaster($mPaymasterID,
						    $mPaymasterName,
						    $mTIN,
						    $mTerms,
						    $mAddress, 
						    $mTelNo,
						    $mFaxNo,
						    $mURL,
						    $mEmail,
						    $mContactPerson, 
						    $mPositionID,
						    $mType,
							$mBranchID,
						    $mConsignmentID,
						    $mbaseline)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_mpaymaster VALUES(''".$mPaymasterID."'',''"
																							  .$mPaymasterName."'',''"
																							  .$mTIN."'',"
																							  .$mTerms.",''"
																							  .$mAddress."'',''"
																							  .$mTelNo."'',''"
																							  .$mFaxNo."'',''"
																							  .$mURL."'',''"
																							  .$mEmail."'',''"
																							  .$mContactPerson."'',"
																							  .$mPositionID.",''"
																							  .$mType."'',''"
																							  .$mBranchID."'',''"
																							  .$mConsignmentID."'',''"
																							  .$mbaseline."'')')");
		mysqli_close($mysqli);

		return $mResult;																			 
	}












function fp_DeleteMemo()
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_tmemo')");

		if ($mResult > 0)
			{
				return "1";						
			}
		else
			{
				return "0";
			}
		mysqli_close($mysqli);
	}


function fp_InsertMemo($mMemoID,
					   $mMemoDate,
					   $mReferenceID,
					   $mMemo,
					   $mbaseline)
	{
		include ("datasource.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_tmemo VALUES(".$mMemoID.",''"
																					   .$mMemoDate."'',''"
																					   .$mReferenceID."'',''"
																					   .$mMemo."'',''"
																					   .$mbaseline."'')')");
		mysqli_close($mysqli);
		return "1";						
	}
































function fp_CheckReceivingReport($mControlNo)
	{
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('SELECT * FROM tb_treceivingreporthdr WHERE ReferenceID_cd = ''".$mControlNo."''')");

		return "0";	
		if (mysqli_num_rows($mResult) > 0)
			{
				return "1";						
			}
		mysqli_close($mysqli);
	}





function fp_InsertReceivingReportHDR($mIP, 
									 $mUserID, 
									 $mPassword,
									 $mControlNo,
									 $mDate, 
									 $mReferenceNo, 
									 $mPaymasterID, 
									 $mParticular, 
									 $mBaseline)
	{
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_treceivingreporthdr VALUES(''".$mControlNo."'',''"
																					   			       .$mDate."'',''"
																					   				   .$mReferenceNo."'',''"
																									   .$mPaymasterID."'',"
																					   				   ."0,''"
																									   .$mParticular."'',''"
																					   				   ."'',''"
																									   ."1'',''"
																					   				   .$mBaseline."'')')");
		mysqli_close($mysqli);



		$mysqli = new mysqli($mIP, $mUserID, $mPassword, "gng_warehouse"); 
		$mResult = $mysqli->query("Call sp_SalesInvoice_RecSelect('".$mReferenceNo."')");

		$mData = "";
		$mRec  = 0;
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{
						$mRec = $mRec + 1; 							
						$mData = $mData.$ado['ItemID_cd'].'!'
									   .$ado['IMEID_cd'].'!'
									   .$ado['Qty_no'].'!'
									   .$ado['Selling_no'].'!'
									   .$ado['Selling_no'].'!'
									   .$ado['Retail_no'].'!*';
					} 
			}
		mysqli_close($mysqli);



		$mData = explode("*", $mData);
		$i = 1;
		
		
		
		include ("datasource_.php");
		$mResult = $mysqli->query("Call sp_Execute_Query('DELETE FROM tb_treceivingreportdtl WHERE RRID_cd =''".$mControlNo."'')");
		mysqli_close($mysqli);	
		
			

		while ($i <= $mRec)
			{ 										
				list($mItemID, $mIMENo, $mQty, $mPurchase, $mCentral, $mSelling) = split('!', $mData[$i-1]);

				include ("datasource_.php");
				$mResult = $mysqli->query("Call sp_Execute_Query('INSERT INTO tb_treceivingreportdtl VALUES(''".$mControlNo."'',"
																											   .$i.",''"
																											   .$mItemID."'',''"
																											   .$mIMENo."'',"
																											   .$mQty.","
																											   .$mPurchase.","
																											   .$mCentral.","
																											   .$mSelling.")')");
				mysqli_close($mysqli);	

				$i = $i + 1;
			}	
		
		return "1";																			 
	}






function fp_SubsidiaryLedger_($mAccountID,
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
					}
			}
		mysqli_close($mysqli);						
		return $display_string;
	}

















function fp_Get_FSIncome($mMonth1,$mYear1,$mStatus)
	{
		$mNet1 = 0;
	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('1',".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('1',".$mMonth1.",".$mYear1.",'".$mStatus."')");
	
		$mTotalGross1 = 0;
		$mTotalSales1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalSales1 = floatval($mTotalSales1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
	
		$mTotalAvailable1 = 0;
		$mTotalCost1 = 0;
	
	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('2',".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('2',".$mMonth1.",".$mYear1.",'".$mStatus."')");
	
		$mTotalBeginning1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalBeginning1 = floatval($mTotalBeginning1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
		$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalBeginning1); 
	
	
	
	
	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('3',".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('3',".$mMonth1.",".$mYear1.",'".$mStatus."')");
	
		$mTotalPurchases1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalPurchases1 = floatval($mTotalPurchases1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
		$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalPurchases1); 
	
	
	
	
	
	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('4',".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('4',".$mMonth1.",".$mYear1.",'".$mStatus."')");
	
		$mTotalEnd1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalEnd1 = floatval($mTotalEnd1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
		$mTotalCost1 = floatval($mTotalAvailable1) - floatval($mTotalEnd1); 
		$mTotalGross1 = floatval($mTotalSales1) - floatval($mTotalCost1); 
		$mNet1 = floatval($mNet1) + floatval($mTotalGross1); 
	
	
	
	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('5',".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('5',".$mMonth1.",".$mYear1.",'".$mStatus."')");
	
		$mTotalOperating1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalOperating1 = floatval($mTotalOperating1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
	
	
	
		$mNet1 = floatval($mNet1) - floatval($mTotalOperating1); 
	
	
	
	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('6',".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select_ ('6',".$mMonth1.",".$mYear1.",'".$mStatus."')");
	
		$mTotalOther1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalOther1 = floatval($mTotalOther1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
	
		$mNet1 = floatval($mNet1) + floatval($mTotalOther1); 
		return $mNet1; 
	}









function fp_Get_FSIncome_($mYear, $mMonth , $mYear_, $mStatus)
	{
		$mNet1 = 0;
//get sales here	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('1',".$mYear.",".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('1',".$mYear.",".$mMonth.",".$mYear_.",'".$mStatus."')");
	
		$mTotalGross1 = 0;
		$mTotalSales1 = 0;
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalSales1 = floatval($mTotalSales1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
	
		$mTotalAvailable1 = 0;
		$mTotalCost1 = 0;
	
//get inventory beginning	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('2',".$mYear.",".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('2',".$mYear.",".$mMonth.",".$mYear_.",'".$mStatus."')");
	
		$mTotalBeginning1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalBeginning1 = floatval($mTotalBeginning1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
		$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalBeginning1); 
	
	
	
	
//get purchases	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('3',".$mYear.",".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('3',".$mYear.",".$mMonth.",".$mYear_.",'".$mStatus."')");
	
		$mTotalPurchases1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalPurchases1 = floatval($mTotalPurchases1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
		$mTotalAvailable1 = floatval($mTotalAvailable1) + floatval($mTotalPurchases1); 
	
	
	
	
	
	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('4',".$mYear.",".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('4',".$mYear.",".$mMonth.",".$mYear_.",'".$mStatus."')");
	
		$mTotalEnd1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalEnd1 = floatval($mTotalEnd1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
		$mTotalCost1 = floatval($mTotalAvailable1) - floatval($mTotalEnd1); 
		$mTotalGross1 = floatval($mTotalSales1) - floatval($mTotalCost1); 
		$mNet1 = floatval($mNet1) + floatval($mTotalGross1); 
	
	
	
	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('5',".$mYear.",".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('5',".$mYear.",".$mMonth.",".$mYear_.",'".$mStatus."')");
	
		$mTotalOperating1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalOperating1 = floatval($mTotalOperating1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
	
	
	
		$mNet1 = floatval($mNet1) - floatval($mTotalOperating1); 
	
	
	
	
		include('datasource_.php');
//		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('6',".$mYear.",".$mPeriod1.")");
		$mResult = $mysqli->query("Call rp_IncomeStatement_Select__ ('6',".$mYear.",".$mMonth.",".$mYear_.",'".$mStatus."')");
	
		$mTotalOther1 = 0;
	
		if (mysqli_num_rows($mResult) > 0)
			{
				while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
					{	
						$mTotalOther1 = floatval($mTotalOther1) + floatval($ado["Amount_no"]); 
					}
			}
		mysqli_close($mysqli);
	
	
	
		$mNet1 = floatval($mNet1) + floatval($mTotalOther1); 
		return $mNet1; 

	}
	
//convert numbers to words
	function convert_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ' ';
    $negative    = 'negative ';
    #$decimal     = ' point ';
    $decimal     = ' & ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
	$words[] = $dictionary[$number];
	
        }
        $string .= implode(' ', $words). '/100';
    }
    
    return $string;
}
	


?>
