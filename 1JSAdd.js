/////////////////////////////////////////////master acccounts ///////////////////////////////////////////

//function for controlaccount
	function aControlAccount_CheckAccountID()
		{
			var mAccountID = document.frmFinancial.txtAccountID.value;
			
			if (mAccountID!='')
				{
					var ajaxRequest = getAjaxRequest();
			
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									if (ajaxRequest.responseText=='1')
										{
											alert("Control Account already exist!!!!!!");
											eval('document.frmFinancial.txtAccountID.focus();');
											eval('document.frmFinancial.txtAccountID.select();');
										}
								}
						}
		
					ajaxRequest.open("GET", "controlaccount_ajax.php?Start=3&AccountID="+mAccountID
									,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes', true);
					
					ajaxRequest.send(null); 
				}
		}
	function aControlAccount_CheckAccountDesc()
		{
			var mAccountDesc = document.frmFinancial.txtAccountDesc.value;
			var mEmpty = '';
			
			if (mAccountDesc!='')
				{
					eval('document.frmFinancial.txtAccountDesc.value=\''+mAccountDesc.toUpperCase()+'\';');
				
					var ajaxRequest = getAjaxRequest();
			
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									if (ajaxRequest.responseText=='1')
										{
											alert("Account Title Already Exist!");
											eval('document.frmFinancial.txtAccountDesc.value=\''+mEmpty+'\';');
											eval('document.frmFinancial.txtAccountDesc.focus();');
										}
								}
						}
		
					ajaxRequest.open("GET", "controlaccount_ajax.asp?Start=4&AccountDesc="+mAccountDesc
									,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes', true);
					
					ajaxRequest.send(null); 
				}
		}
	function aControlAccount_Action(mAction)
		{
			if (mAction == 1)
				{
								var ajaxRequest = getAjaxRequest();
								ajaxRequest.onreadystatechange = function()
								{
									if(ajaxRequest.readyState == 4)
										{

										var ajaxDisplay = document.getElementById('contents');
										ajaxDisplay.innerHTML = ajaxRequest.responseText;
										sortTable()	
										}
								}

								var param= "Start=1";
								ajaxRequest.open("POST","controlaccount_add.php",true);
								ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								ajaxRequest.send(param);
			
								
				}
			else if (mAction == 2)
				{
					var mAccountID = document.frmFinancial.txtAccountID.value;
					var mAccountDesc = document.frmFinancial.txtAccountDesc.value;
					var mGroupID = document.frmFinancial.cboGroupID.value;
					var mBank = document.frmFinancial.chkBank.checked;
					var mNormal = document.frmFinancial.chkNormal.checked;
					var mCR = document.frmFinancial.chkCR.checked;
					var mPB = document.frmFinancial.chkPB.checked;
					var mCS = document.frmFinancial.chkCS.checked;
					var mBS = document.frmFinancial.chkBS.checked;
					var mCD = document.frmFinancial.chkCD.checked;
					var mGJ = document.frmFinancial.chkGJ.checked;
					var mBalanceSheet = document.frmFinancial.chkBalanceSheet.checked;
					var mBalanceSheetType = document.frmFinancial.cboBalanceSheetType.value;
					var mIncomeStatement = document.frmFinancial.chkIncomeStatement.checked;
					var mIncomeStatementType = document.frmFinancial.cboIncomeStatementType.value;
					var mCashFlow = document.frmFinancial.chkCashFlow.checked;
					var mCashFlowType = document.frmFinancial.cboCashFlowType.value;
					var mOk = '0';
					
					mOk = '1';

						
						
						
						
						
					if (mOk == '1')
						{
							if (mBank) { mBank = '1'; } else { mBank = '0'; }
							if (mNormal) { mNormal = '1'; } else { mNormal = '0'; }

							if (mCR) { mCR = '1'; } else { mCR = '0'; }
							if (mPB) { mPB = '1'; } else { mPB = '0'; }
							if (mCS) { mCS = '1'; } else { mCS = '0'; }
							if (mBS) { mBS = '1'; } else { mBS = '0'; }
							if (mCD) { mCD = '1'; } else { mCD = '0'; }
							if (mGJ) { mGJ = '1'; } else { mGJ = '0'; }

							if (mBalanceSheet) { mBalanceSheet = '1'; } else { mBalanceSheet = '0'; }
							if (mIncomeStatement) { mIncomeStatement = '1'; } else { mIncomeStatement = '0'; }
							if (mCashFlow) { mCashFlow = '1'; } else { mCashFlow = '0'; }
							
							
								var ajaxRequest = getAjaxRequest();
								ajaxRequest.onreadystatechange = function()
								{
									if(ajaxRequest.readyState == 4)
										{

										var ajaxDisplay = document.getElementById('contents');
										ajaxDisplay.innerHTML = ajaxRequest.responseText;
										sortTable()	
										}
								}

								var param= "Start=2&AccountID="+mAccountID+"&AccountDesc="+mAccountDesc+"&GroupID="+mGroupID+"&Bank="+mBank+"&Normal="+mNormal+"&CR="+mCR+"&PB="+mPB+"&CS="+mCS+"&BS="+mBS+"&CD="+mCD+"&GJ="+mGJ+"&BalanceSheet="+mBalanceSheet+"&BalanceSheetType="+mBalanceSheetType+"&IncomeStatement="+mIncomeStatement+"&IncomeStatementType="+mIncomeStatementType+"&CashFlow="+mCashFlow+"&CashFlowType="+mCashFlowType;
								ajaxRequest.open("POST","controlaccount_add.php",true);
								ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								ajaxRequest.send(param);
			
						}
				
				}
			else if (mAction == 3)
				{
			
								var ajaxRequest = getAjaxRequest();
								ajaxRequest.onreadystatechange = function()
								{
									if(ajaxRequest.readyState == 4)
										{

										var ajaxDisplay = document.getElementById('contents');
										ajaxDisplay.innerHTML = ajaxRequest.responseText;
										sortTable()	
										}
								}

								var param= "Start=2";
								ajaxRequest.open("POST","controlaccount_search.php",true);
								ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								ajaxRequest.send(param);
				}
		}
	function aControlAccount_EnterKey(i,event)
		{
			if (event.keyCode == 13)
				{
					if (i==1) 
						{ 
							document.frmFinancial.txtAccountDesc.focus(); 
						}
					if (i==2) 
						{ 
							document.frmFinancial.cboGroupID.focus(); 
						}
					if (i==3) 
						{ 
							document.frmFinancial.chkBank.focus(); 
						}
					if (i==4) 
						{ 
							document.frmFinancial.chkNormal.focus(); 
						}
					if (i==5) 
						{ 
							document.frmFinancial.chkCR.focus(); 
						}
					if (i==6) 
						{ 
							document.frmFinancial.chkPB.focus(); 
						}
					if (i==7) 
						{ 
							document.frmFinancial.chkCS.focus(); 
						}
					if (i==8) 
						{ 
							document.frmFinancial.chkBS.focus(); 
						}
					if (i==9) 
						{ 
							document.frmFinancial.chkCD.focus(); 
						}
					if (i==10) 
						{ 
							document.frmFinancial.chkGJ.focus(); 
						}
					if (i==11) 
						{ 
							document.frmFinancial.chkBalanceSheet.focus(); 
						}
					if (i==12) 
						{ 
							document.frmFinancial.chkIncomeStatement.focus(); 
						}
					if (i==13) 
						{ 
							document.frmFinancial.chkCashFlow.focus(); 
						}
					if (i==14) 
						{ 
							document.frmFinancial.txtAccountID.focus(); 
						}
					if (i==15) 
						{ 
							document.frmFinancial.chkGrossProfit.focus(); 
						}

					return false;
				}
			return true;
		}
		
		
//////////////////////////////////////////////sub accounts//////////////////////////////////////////////
		function aSubsidiaryAccount_Action(mAction)
		{
			if (mAction == 1)
				{
					var ajaxRequest = getAjaxRequest();
								ajaxRequest.onreadystatechange = function()
								{
									if(ajaxRequest.readyState == 4)
										{

										var ajaxDisplay = document.getElementById('contents');
										ajaxDisplay.innerHTML = ajaxRequest.responseText;
										sortTable()	
										}
								}

								var param= "Start=1";
								ajaxRequest.open("POST","subsidiaryaccount_add.php",true);
								ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								ajaxRequest.send(param);
								
				}
			else if (mAction == 2)
				{
					var mAccountID = document.frmFinancial.cboAccountID.value;
					var mSubsidiaryDesc = document.frmFinancial.txtSubsidiaryDesc.value;
					var mBranchNo = document.frmFinancial.hidBranchNo.value;
					var mData = '';
					var mRec = 0;
					var mOk = '0';
					
				
							mOk = '1';
				
					if (mOk=='1')
						{
							var ajaxRequest = getAjaxRequest();
								ajaxRequest.onreadystatechange = function()
								{
									if(ajaxRequest.readyState == 4)
										{

										var ajaxDisplay = document.getElementById('contents');
										ajaxDisplay.innerHTML = ajaxRequest.responseText;
										sortTable()	
										}
								}

								var param= "Start=2&AccountID="+mAccountID+"&SubsidiaryDesc="+mSubsidiaryDesc+"&Data="+mData+"&Rec="+mRec;
								ajaxRequest.open("POST","subsidiaryaccount_add.php",true);
								ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								ajaxRequest.send(param);
						}
				}
			else if (mAction == 3)
				{
					var ajaxRequest = getAjaxRequest();
								ajaxRequest.onreadystatechange = function()
								{
									if(ajaxRequest.readyState == 4)
										{

										var ajaxDisplay = document.getElementById('contents');
										ajaxDisplay.innerHTML = ajaxRequest.responseText;
										sortTable()	
										}
								}

								var param= "Start=1";
								ajaxRequest.open("POST","subsidiaryaccount_search.php",true);
								ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
								ajaxRequest.send(param);		
				}
		}
	function aSubsidiaryAccount_EnterKey(i,event)
		{
			if (event.keyCode == 13)
				{
					if (i==1) 
						{ 
							document.frmFinancial.txtSubsidiaryDesc.focus(); 
						}

					return false;
				}
			return true;
		}	
//////////////////////////////////////////purchases books//////////////////////////////////////////////////////////////
	function aPurchasesBook_SearchVoyageReference()
		{
			var mVoyageReference = document.frmFinancial.txtReferenceNo.value;
			
			if (mVoyageReference!='')
				{
					var ajaxRequest = getAjaxRequest();
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('voyagereference');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									//alert(ajaxRequest.responseText);
								}
						}
					var param="Start=9&VoyageReference="+mVoyageReference;	
					ajaxRequest.open("POST", "purchases_ajax.php", true);					
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param); 
				}	

		}
	function aPurchasesBook_SetSearchVoyageReference(value) 
		{
			document.getElementById('txtReferenceNo').value = value;
			document.getElementById('voyagereference').innerHTML = '';
		}	



	function aPurchasesBook_Action(mAction)
		{
			if (mAction == 1)
				{
					var ajaxRequest = getAjaxRequest();
						ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
								}
							}

							var param= "Start=1";
							ajaxRequest.open("POST","purchases_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);				
				}
			else if (mAction == 2)
				{
					
					var mControlNo = document.frmFinancial.txtControlNo.value;
					var mDate1 = document.frmFinancial.Date1.value;
					var mAmount = document.frmFinancial.txtTotalDebit.value;//document.frmFinancial.txtAmount.value;
					mAmount =parseFloat(eval('document.frmFinancial.txtTotalDebit.value;').replace(/,/g,''));
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';//document.frmFinancial.hidData.value;
					var mRec = document.frmFinancial.hidRec.value;
					var mStatus = 0;
					var mOk = '0';
					if(mReferenceNo !== "" || typeof(mReferenceNo) !== 'undefined')
						{
							mOk = '1';
						}
		
					if (parseFloat(mRec)=='0')
						{
							alert('Unable to Save, No Item Selected!');
							mOk = '0';
						}
					if (document.frmFinancial.txtTotalDebit.value != document.frmFinancial.txtTotalCredit.value) 
						{
							alert ('Total Debit Account must be equal to Total Credit Account!');
							mOk = '0';
						}						
					
					if (mOk=='1')
						{
							if (mAction==3) { mStatus=1; }

								
							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									ePurchasesBook_LoadAccount();		
								}
							}

							var param= "Start=2&ControlNo="+mControlNo+"&Date1="+mDate1+"&ReferenceNo="+escape(mReferenceNo)+"&Amount="+mAmount+"&Particular="+escape(mParticular)+"&Rec="+mRec+"&Data="+mData+"&Status="+mStatus;
							ajaxRequest.open("POST","purchases_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);
							
						}
				}
			else if (mAction == 3)
				{
					var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									ePurchasesBook_LoadAccount();		
								}
							}

							var param= "Start=1&ControlNo=&RefrenceNO=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status=";
							ajaxRequest.open("POST","purchases_search.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);
				}
		}
	function aPurchasesBook_AutoSave()
		{
					/*var mControlNo = document.frmFinancial.txtControlNo.value;
					var mDate1 = document.frmFinancial.Date1.value;
					var mAmount = 0;//document.frmFinancial.txtTotalDebit.value;//document.frmFinancial.txtAmount.value;
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';//document.frmFinancial.hidData.value;
					var mRec = document.frmFinancial.hidRec.value;
					var mStatus = 0;
					var mOk = '1';

					if (mOk=='1')
						{
							window.close;
							window.open('purchases_add.php?Start=2&ControlNo='+mControlNo+
														 '&Date1='+mDate1+
														 '&ReferenceNo='+escape(mReferenceNo)+
														 '&Amount='+mAmount+
														 '&Particular='+escape(mParticular)+
														 '&Rec='+mRec+
														 '&Data='+mData+
														 '&Status='+mStatus
									,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
						}
					*/	

		}


	function aPurchasesBook_EnterKey(i,event)
		{
			if (event.keyCode == 13)
				{
					if (i==1) 
						{ 
							document.frmFinancial.cboDay1.focus(); 
						}
					if (i==2) 
						{ 
							document.frmFinancial.cboYear1.focus(); 
						}
					if (i==3) 
						{ 
							document.frmFinancial.txtReferenceNo.focus(); 
							document.frmFinancial.txtReferenceNo.select(); 
						}
					if (i==4) 
						{ 
							document.frmFinancial.txtAmount.focus(); 
							document.frmFinancial.txtAmount.select(); 
						}
					if (i==5) 
						{ 
							document.frmFinancial.txtAccountID.focus(); 
							document.frmFinancial.txtAccountID.select(); 
						}
					return false;
				}
			return true;
		}
	function aPurchasesBook_EnterAccountID(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					aPurchasesBook_SearchAccount();
					return false;
				}
			return true;
		}
	function aPurchasesBook_EnterAccountID_(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					AccountFocus();
					return false;
				}
			return true;
		}
	function aPurchasesBook_EnterSubsidiaryID(event)
		{
			var mDebit = eval('document.frmFinancial.hidDebit.value;');
			
			if (event.keyCode == 13)
				{
					if (mDebit=='1')
						{
							eval('document.frmFinancial.txtDebit.focus();');
							eval('document.frmFinancial.txtDebit.select();');
						}
					else
						{
							eval('document.frmFinancial.txtCredit.focus();');
							eval('document.frmFinancial.txtCredit.select();');
						}
					return false;
				}
			return true;
		}
	function aPurchasesBook_EnterSave(event)
		{
			if (event.keyCode == 13)
				{
					DebitAmt = eval('document.frmFinancial.txtDebit.value;');
					CreditAmt = eval('document.frmFinancial.txtCredit.value;');
					if(isNaN(DebitAmt))
					{
						alert("Invalid Debit Entry");
						return;
					}
					if(isNaN(CreditAmt))
					{
						alert("Invalid Credit Entry");
						return;
					}
					//alert(DebitAmt+"=="+CreditAmt);
					aPurchasesBook_SaveAccount();
					return false;
				}
			return true;
		}
	function aPurchasesBook_SearchAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mAccountID = document.frmFinancial.txtAccountID.value;
			//alert("searching account"+mAccountID)
			var mEmpty = '';

			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									eval('document.frmFinancial.hidDebit.value=\''+str[0]+'\';');
									eval('document.frmFinancial.hidTotCount.value=\''+str[1]+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+str[2]+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+str[3]+'\';');	
									eval('document.frmFinancial.cboAccountID.value=\''+str[2]+'\';');		
									eval('document.frmFinancial.txtDebit.value=\''+str[4]+'\';');									
									eval('document.frmFinancial.txtCredit.value=\''+str[5]+'\';');									

									if (parseFloat(str[1]) > 0)
										{
											aPurchasesBook_SearchSubsidiary();
										}
									else
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option("-No Subsidiary Code-","");
										
											if (parseFloat(str[0])==1)
												{
													eval('document.frmFinancial.txtDebit.focus();');
													eval('document.frmFinancial.txtDebit.select();');
												}
											else
												{
													eval('document.frmFinancial.txtCredit.focus();');
													eval('document.frmFinancial.txtCredit.select();');
												}
										}
								}
							else
								{
									eval('document.frmFinancial.cboAccountID.value=\''+mEmpty+'\';');	
									eval('document.frmFinancial.txtAccountID.select();');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');	
									alert('Account Code does not exist!');
								}
								
						}	
				}

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aPurchasesBook_SearchAccount_()
		{
			var ajaxRequest = getAjaxRequest();

			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mEmpty = '';

			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");
							
							if (str!='')
								{
									eval('document.frmFinancial.hidDebit.value=\''+str[0]+'\';');
									eval('document.frmFinancial.hidTotCount.value=\''+str[1]+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+str[2]+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+str[3]+'\';');	
									eval('document.frmFinancial.txtDebit.value=\''+str[4]+'\';');									
									eval('document.frmFinancial.txtCredit.value=\''+str[5]+'\';');									

									if (parseFloat(str[1]) > 0)
										{
											aPurchasesBook_SearchSubsidiary_();
										}
									else
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option("-No Subsidiary Code-","");
										}
								}
							else
								{
									eval('document.frmFinancial.txtAccountID.value=\''+mEmpty+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');	
								}
						}	
				}

			var param= "Start=4&AccountID=" + mAccountID;
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aPurchasesBook_SearchSubsidiary()
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty = '';
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			var j = 1;
			var k = 2;
			mSubsidiary.options.length = 0;
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");
							if (str!='')
								{
									for (i = 1; i <= parseFloat(str[0]) ; i++)
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option(str[k],str[j]);
											j = j + 2;
											k = k + 2;
										}
									eval('document.frmFinancial.cboSubsidiaryID.focus();');
								}
						}	
				}

			var param= "Start=5&AccountID=" + mAccountID;
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aPurchasesBook_AccountFocus()
		{
			var ajaxRequest = getAjaxRequest();
			var mAccountID = eval('document.frmFinancial.cboAccountID.value;');
			var mEmpty = '';

			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									if (parseFloat(str[1]) > 0)
										{
											eval('document.frmFinancial.cboSubsidiaryID.focus();');
										}
									else
										{
											if (parseFloat(str[0])==1)
												{
													eval('document.frmFinancial.txtDebit.focus();');
													eval('document.frmFinancial.txtDebit.select();');
												}
											else
												{
													eval('document.frmFinancial.txtCredit.focus();');
													eval('document.frmFinancial.txtCredit.select();');
												}
										}
								}
						}	
				}

			ajaxRequest.open("GET", "purchases_ajax.php?Start=3&AccountID=" + mAccountID, true);
			ajaxRequest.send(null); 
		}
	function aPurchasesBook_SearchSubsidiary_()
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty = '';
			var mAccountID = eval('document.frmFinancial.cboAccountID.value;');
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			var j = 1;
			var k = 2;
			mSubsidiary.options.length = 0;
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									for (i = 1; i <= parseFloat(str[0]) ; i++)
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option(str[k],str[j]);
											j = j + 2;
											k = k + 2;
										}
								}
						}	
				}

			var param= "Start=5&AccountID=" + mAccountID;
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aPurchasesBook_chkAll()
		{
			var mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.chkAccount.checked;'))
						{
							document.getElementById("chkSelect"+i).checked=true;
						}
					else
						{
							document.getElementById("chkSelect"+i).checked=false;
						}
				}
		}
	function aPurchasesBook_DeleteAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mRec = document.frmFinancial.hidRec.value;
			var mData = '';
			var mTotRec = mRec;
		
			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.chkSelect'+i+'.checked;'))
						{ 
							mTotRec = parseFloat(mTotRec) - 1;
						}
					else
						{
							mData = mData + eval('document.frmFinancial.hidAccountID'+i+'.value;') + '!'
										  + eval('document.frmFinancial.hidAccountTitle'+i+'.value;') + '!'
										  + eval('document.frmFinancial.hidSubsidiaryID'+i+'.value;') + '!'
										  + parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value;').replace(/,/g,'')) + '!'
										  + parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value;').replace(/,/g,'')) + '*';	
							}
				}

			eval('document.frmFinancial.hidRec.value=\''+mTotRec+'\';');
			eval('document.frmFinancial.hidData.value=\''+mData+'\';');
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							if (mTotRec > 0) { ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mTotRec;
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function aPurchasesBook_SaveAccount() 
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty ='';
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mRec = document.frmFinancial.hidRec.value;
			var mData =  document.frmFinancial.hidData.value;
					
			if (eval('document.frmFinancial.txtAccountTitle.value;')=='') 
				{
					alert ('Account Does Not Exist!');
					eval('document.frmFinancial.txtAccountID.focus();');
					eval('document.frmFinancial.txtAccountID.select();');
				}
			else
				{
					mRec = parseFloat(mRec) + 1;
					ad =document.frmFinancial.txtAccountID.value;
					at =document.frmFinancial.txtAccountTitle.value;
					si =document.frmFinancial.cboSubsidiaryID.value;
					db=document.frmFinancial.txtDebit.value;
					cr=document.frmFinancial.txtCredit.value;
					
					mData = mData + ad + '!' 
								  + at + '!' 
								  + si + '!'
								  + db + '!'
								  + cr + '!*';	
								  
			
					eval('document.frmFinancial.hidRec.value=\''+mRec+'\';');

					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									
									var mSubsidiary = document.frmFinancial.cboSubsidiaryID;

									mSubsidiary.options.length = 0;
									mSubsidiary.options[mSubsidiary.options.length] = new Option("-Select Subsidiary Description-","");
									
									eval('document.frmFinancial.hidData.value=\''+mData+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtDebit.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtCredit.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtAccountID.focus();');
									eval('document.frmFinancial.txtAccountID.select();');
									aPurchasesBook_ComputeTotal(1);
								}
						}

					var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
					ajaxRequest.open("POST","purchases_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);		
				}
		}
	function aPurchasesBook_LoadAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mRec = document.frmFinancial.hidRec.value;
			var mData = document.frmFinancial.hidData.value;
		
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							if (mRec > 0) { ComputeTotal(1); }
							eval('document.frmFinancial.txtAmount.value=\''+document.frmFinancial.txtTotalDebit.value+'\';');
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function aPurchasesBook_UpdateSession(m_Rec)
		{
		m_Data = eval('document.frmFinancial.hidData.value;');
		var ajaxRequest = getAjaxRequest();
		ajaxRequest.onreadystatechange = function()
			{
				if(ajaxRequest.readyState == 4)
					{
					}
			}		
			var param= "Start=6&Data=" + m_Data + "&Rec=" + m_Rec;
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}	

	function aPurchasesBook_ComputeTotal(RowLocation)
		{

			var mRec = 0;
			var mData = '';
			var i = 0;
			var mDebit = 0;
			var mCredit = 0;
			var mTotalDebit = 0;
			var mTotalCredit = 0;

			mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value')) > 0) 
						{
							if (parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value')) > 0) 
								{
									alert ('Account can either be debit or credit!');
									eval('document.frmFinancial.hidCredit'+i+'.focus();')
									eval('document.frmFinancial.hidCredit'+i+'.select();')
									return false;
								}	
						}
					
					mData = mData + eval('document.frmFinancial.hidAccountID'+i+'.value;') + '!'
								  + eval('document.frmFinancial.hidAccountTitle'+i+'.value;') + '!'
								  + eval('document.frmFinancial.hidSubsidiaryID'+i+'.value;') + '!'
								  + parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value;').replace(/,/g,'')) + '!'
								  + parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value;').replace(/,/g,'')) + '*';	
					
				
					mDebit = parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value').replace(/,/g,''));
					mCredit = parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value').replace(/,/g,''));
					mTotalDebit = mTotalDebit + parseFloat(mDebit);				
					mTotalCredit = mTotalCredit + parseFloat(mCredit);
				}	
				
			//eval('document.frmFinancial.txtTotalDebit.value=\''+gf_FormatCurrency(mTotalDebit)+'\';');
			//eval('document.frmFinancial.txtTotalCredit.value=\''+gf_FormatCurrency(mTotalCredit)+'\';');
			eval('document.frmFinancial.txtTotalDebit.value=\''+mTotalDebit+'\';');
			eval('document.frmFinancial.txtTotalCredit.value=\''+mTotalCredit+'\';');
			
			document.frmFinancial.hidRec.value = mRec;
			document.frmFinancial.hidData.value = mData;
			UpdateSession(mRec);
		}
		
		
////////////////////////////////////////////////cash sales/////////////////////////////////////////////////////////

	function aCashSales_SearchVoyageReference()
		{
			var mVoyageReference = document.frmFinancial.txtReferenceNo.value;
			
			if (mVoyageReference!='')
				{
					var ajaxRequest = getAjaxRequest();
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('voyagereference');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									//alert(ajaxRequest.responseText);
								}
						}
					var param="Start=9&VoyageReference="+mVoyageReference;	
					ajaxRequest.open("POST", "cashsales_ajax.php", true);					
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param); 
				}	

		}
	function aCashSales_SetSearchVoyageReference(value) 
		{
			document.getElementById('txtReferenceNo').value = value;
			document.getElementById('voyagereference').innerHTML = '';
		}	
	function aCashSales_Action(mAction)
		{
			if (mAction == 1)
				{
							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									eCashSales_LoadAccount();		
								}
							}

							var param= "Start=1";
							ajaxRequest.open("POST","cashsales_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);		
				}
			else if (mAction == 2)
				{
					var mControlNo = document.frmFinancial.txtControlNo.value;
					var mDate1 = document.frmFinancial.Date1.value;

					var mAmount = document.frmFinancial.txtTotalDebit.value;//document.frmFinancial.txtAmount.value;
					mAmount =parseFloat(eval('document.frmFinancial.txtTotalDebit.value;').replace(/,/g,''));
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';//document.frmFinancial.hidData.value;
					var mRec = document.frmFinancial.hidRec.value;
					var mStatus = 0;
					var mOk = '1';
					
					if (parseFloat(mRec)=='0')
						{
							alert('Unable to Save, No Item Selected!');
							mOk = '0';
						}
					if (document.frmFinancial.txtTotalDebit.value != document.frmFinancial.txtTotalCredit.value) 
						{
							alert ('Total Debit Account must be equal to Total Credit Account!');
							mOk = '0';
						}						
					
					if (mOk=='1')
						{
							if (mAction==3) { mStatus=1; }

							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									eCashSales_LoadAccount();		
								}
							}

							var param= "Start=2&ControlNo="+mControlNo+"&Date1="+mDate1+"&ReferenceNo="+escape(mReferenceNo)+"&Amount="+mAmount+"&Particular="+escape(mParticular)+"&Rec="+mRec+"&Data="+mData+"&Status="+mStatus;
							ajaxRequest.open("POST","cashsales_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);		
						}
				}
			else if (mAction == 3)
				{
							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									eCashSales_LoadAccount();		
								}
							}

							var param= "Start=1&ControlNo=&Reference=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2&Status=";
							ajaxRequest.open("POST","cashsales_search.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);			
				}
		}
	function aCashSales_AutoSave()
		{
			
					var mControlNo = document.frmFinancial.txtControlNo.value;
					var mDate1 = document.frmFinancial.Date1.value;
					var mAmount = 0;//document.frmFinancial.txtTotalDebit.value;//document.frmFinancial.txtAmount.value;
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';//document.frmFinancial.hidData.value;
					var mRec = document.frmFinancial.hidRec.value;
					var mStatus = 0;
					var mOk = '1';

					if (mOk=='1')
						{
							window.close;
							window.open('cashsales_add.php?Start=2&ControlNo='+mControlNo+
																    '&Date1='+mDate1+
																    '&ReferenceNo='+escape(mReferenceNo)+
																    '&Amount='+mAmount+
																    '&Particular='+escape(mParticular)+
																    '&Rec='+mRec+
																    '&Data='+mData+
																    '&Status='+mStatus
									,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');

						}

		}

	function aCashSales_EnterKey(i,event)
		{
			if (event.keyCode == 13)
				{
					if (i==1) 
						{ 
							document.frmFinancial.cboDay1.focus(); 
						}
					if (i==2) 
						{ 
							document.frmFinancial.cboYear1.focus(); 
						}
					if (i==3) 
						{ 
							document.frmFinancial.txtReferenceNo.focus(); 
							document.frmFinancial.txtReferenceNo.select(); 
						}
					if (i==4) 
						{ 
							document.frmFinancial.txtAmount.focus(); 
							document.frmFinancial.txtAmount.select(); 
						}
					if (i==5) 
						{ 
							document.frmFinancial.txtAccountID.focus(); 
							document.frmFinancial.txtAccountID.select(); 
						}
					return false;
				}
			return true;
		}
	function aCashSales_EnterAccountID(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					aCashSales_SearchAccount();
					return false;
				}
			return true;
		}
	function aCashSales_EnterAccountID_(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					aCashSales_AccountFocus();
					return false;
				}
			return true;
		}
	function aCashSales_EnterSubsidiaryID(event)
		{
			var mDebit = eval('document.frmFinancial.hidDebit.value;');
			
			if (event.keyCode == 13)
				{
					if (mDebit=='1')
						{
							eval('document.frmFinancial.txtDebit.focus();');
							eval('document.frmFinancial.txtDebit.select();');
						}
					else
						{
							eval('document.frmFinancial.txtCredit.focus();');
							eval('document.frmFinancial.txtCredit.select();');
						}
					return false;
				}
			return true;
		}
	function aCashSales_EnterSave(event)
		{
			if (event.keyCode == 13)
				{
					DebitAmt = eval('document.frmFinancial.txtDebit.value;');
					CreditAmt = eval('document.frmFinancial.txtCredit.value;');
					if(isNaN(DebitAmt))
					{
						alert("Invalid Debit Entry");
						return;
					}
					if(isNaN(CreditAmt))
					{
						alert("Invalid Credit Entry");
						return;
					}
					aCashSales_SaveAccount();
					return false;
				}
			return true;
		}
	function aCashSales_SearchAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mEmpty = '';

			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									eval('document.frmFinancial.hidDebit.value=\''+str[0]+'\';');
									eval('document.frmFinancial.hidTotCount.value=\''+str[1]+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+str[2]+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+str[3]+'\';');	
									eval('document.frmFinancial.cboAccountID.value=\''+str[2]+'\';');		
									eval('document.frmFinancial.txtDebit.value=\''+str[4]+'\';');									
									eval('document.frmFinancial.txtCredit.value=\''+str[5]+'\';');									

									if (parseFloat(str[1]) > 0)
										{
											aCashSales_SearchSubsidiary();
										}
									else
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option("-No Subsidiary Code-","");
										
											if (parseFloat(str[0])==1)
												{
													eval('document.frmFinancial.txtDebit.focus();');
													eval('document.frmFinancial.txtDebit.select();');
												}
											else
												{
													eval('document.frmFinancial.txtCredit.focus();');
													eval('document.frmFinancial.txtCredit.select();');
												}
										}
								}
							else
								{
									eval('document.frmFinancial.cboAccountID.value=\''+mEmpty+'\';');	
									eval('document.frmFinancial.txtAccountID.select();');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');	
									alert('Account Code does not exist!');
								}
								
						}	
				}

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCashSales_SearchAccount_()
		{
			var ajaxRequest = getAjaxRequest();

			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mEmpty = '';

			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");
							
							if (str!='')
								{
									eval('document.frmFinancial.hidDebit.value=\''+str[0]+'\';');
									eval('document.frmFinancial.hidTotCount.value=\''+str[1]+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+str[2]+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+str[3]+'\';');	
									eval('document.frmFinancial.txtDebit.value=\''+str[4]+'\';');									
									eval('document.frmFinancial.txtCredit.value=\''+str[5]+'\';');									

									if (parseFloat(str[1]) > 0)
										{
											aCashSales_SearchSubsidiary_();
										}
									else
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option("-No Subsidiary Code-","");
										}
								}
							else
								{
									eval('document.frmFinancial.txtAccountID.value=\''+mEmpty+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');	
								}
						}	
				}

			var param= "Start=4&AccountID=" + mAccountID;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCashSales_SearchSubsidiary()
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty = '';
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			var j = 1;
			var k = 2;
			mSubsidiary.options.length = 0;
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									for (i = 1; i <= parseFloat(str[0]) ; i++)
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option(str[k],str[j]);
											j = j + 2;
											k = k + 2;
										}
									eval('document.frmFinancial.cboSubsidiaryID.focus();');
								}
						}	
				}

			var param= "Start=5&AccountID=" + mAccountID;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCashSales_AccountFocus()
		{
			var ajaxRequest = getAjaxRequest();
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mEmpty = '';

			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									if (parseFloat(str[1]) > 0)
										{
											eval('document.frmFinancial.cboSubsidiaryID.focus();');
										}
									else
										{
											if (parseFloat(str[0])==1)
												{
													eval('document.frmFinancial.txtDebit.focus();');
													eval('document.frmFinancial.txtDebit.select();');
												}
											else
												{
													eval('document.frmFinancial.txtCredit.focus();');
													eval('document.frmFinancial.txtCredit.select();');
												}
										}
								}
						}	
				}

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCashSales_SearchSubsidiary_()
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty = '';
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			var j = 1;
			var k = 2;
			mSubsidiary.options.length = 0;
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									for (i = 1; i <= parseFloat(str[0]) ; i++)
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option(str[k],str[j]);
											j = j + 2;
											k = k + 2;
										}
								}
						}	
				}

			var param= "Start=5&AccountID=" + mAccountID;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCashSales_chkAll()
		{
			var mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.chkAccount.checked;'))
						{
							document.getElementById("chkSelect"+i).checked=true;
						}
					else
						{
							document.getElementById("chkSelect"+i).checked=false;
						}
				}
		}
	function aCashSales_DeleteAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mRec = document.frmFinancial.hidRec.value;
			var mData = '';
			var mTotRec = mRec;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.chkSelect'+i+'.checked;'))
						{ 
							mTotRec = parseFloat(mTotRec) - 1;
						}
					else
						{
							mData = mData + eval('document.frmFinancial.hidAccountID'+i+'.value;') + '!'
										  + eval('document.frmFinancial.hidAccountTitle'+i+'.value;') + '!'
										  + eval('document.frmFinancial.hidSubsidiaryID'+i+'.value;') + '!'
										  + parseFloat(eval('document.frmFinancial.mhidDebit'+i+'.value;').replace(/,/g,'')) + '!'
										  + parseFloat(eval('document.frmFinancial.mhidCredit'+i+'.value;').replace(/,/g,'')) + '!*';	
						}
				}

			eval('document.frmFinancial.hidRec.value=\''+mTotRec+'\';');
			eval('document.frmFinancial.hidData.value=\''+mData+'\';');
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							if (mTotRec > 0) { ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mTotRec ;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param); 		
		}
	function aCashSales_SaveAccount() 
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty ='';
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mRec = document.frmFinancial.hidRec.value;
			var mData =  document.frmFinancial.hidData.value;
					
			if (eval('document.frmFinancial.txtAccountTitle.value;')=='') 
				{
					alert ('Account Does Not Exist!');
					eval('document.frmFinancial.txtAccountID.focus();');
					eval('document.frmFinancial.txtAccountID.select();');
				}
			else
				{
					mRec = parseFloat(mRec) + 1;
					mData = mData + eval('document.frmFinancial.txtAccountID.value;') + '!' 
								  + eval('document.frmFinancial.txtAccountTitle.value;') + '!' 
								  + eval('document.frmFinancial.cboSubsidiaryID.value;') + '!'
								  + parseFloat(eval('document.frmFinancial.txtDebit.value;').replace(/,/g,'')) + '!'
								  + parseFloat(eval('document.frmFinancial.txtCredit.value;').replace(/,/g,'')) + '!*';	
			
					eval('document.frmFinancial.hidRec.value=\''+mRec+'\';');

					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									
									var mSubsidiary = document.frmFinancial.cboSubsidiaryID;

									mSubsidiary.options.length = 0;
									mSubsidiary.options[mSubsidiary.options.length] = new Option("-Select Subsidiary Description-","");
									
									eval('document.frmFinancial.hidData.value=\''+mData+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtDebit.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtCredit.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtAccountID.focus();');
									eval('document.frmFinancial.txtAccountID.select();');
									aCashSales_ComputeTotal(1);
								}
						}

			var param= "Start=6&Data=" + mData + "&Rec=" + mRec ;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
				}
		}
	function aCashSales_LoadAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mRec = document.frmFinancial.hidRec.value;
			var mData = document.frmFinancial.hidData.value;
		
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							if (mRec > 0) { ComputeTotal(1); }
							eval('document.frmFinancial.txtAmount.value=\''+document.frmFinancial.txtTotalDebit.value+'\';');
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function aCashSales_UpdateSession(m_Rec)
		{
		m_Data = eval('document.frmFinancial.hidData.value;');
		var ajaxRequest = getAjaxRequest();
		ajaxRequest.onreadystatechange = function()
			{
				if(ajaxRequest.readyState == 4)
					{
					}
			}		
			var param= "Start=6&Data=" + m_Data + "&Rec=" + m_Rec;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}	

	function aCashSales_ComputeTotal(RowLocation)
		{

			var mRec = 0;
			var mData = '';
			var i = 0;
			var mDebit = 0;
			var mCredit = 0;
			var mTotalDebit = 0;
			var mTotalCredit = 0;

			mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value')) > 0) 
						{
							if (parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value')) > 0) 
								{
									alert ('Account can either be debit or credit!');
									eval('document.frmFinancial.hidCredit'+i+'.focus();')
									eval('document.frmFinancial.hidCredit'+i+'.select();')
									return false;
								}	
						}
					
					mData = mData + eval('document.frmFinancial.hidAccountID'+i+'.value;') + '!'
								  + eval('document.frmFinancial.hidAccountTitle'+i+'.value;') + '!'
								  + eval('document.frmFinancial.hidSubsidiaryID'+i+'.value;') + '!'
								  + parseFloat(eval('document.frmFinancial.mhidDebit'+i+'.value;').replace(/,/g,'')) + '!'
								  + parseFloat(eval('document.frmFinancial.mhidCredit'+i+'.value;').replace(/,/g,'')) + '*';	
					
					mDebit = parseFloat(eval('document.frmFinancial.mhidDebit'+i+'.value').replace(/,/g,''));
					mCredit = parseFloat(eval('document.frmFinancial.mhidCredit'+i+'.value').replace(/,/g,''));
					mTotalDebit = mTotalDebit + parseFloat(mDebit);				
					mTotalCredit = mTotalCredit + parseFloat(mCredit);
				}	
				
			eval('document.frmFinancial.txtTotalDebit.value=\''+mTotalDebit+'\';');
			eval('document.frmFinancial.txtTotalCredit.value=\''+mTotalCredit+'\';');

			document.frmFinancial.hidRec.value = mRec;
			document.frmFinancial.hidData.value = mData;
			aCashSales_UpdateSession(mRec);
		}

	function aCashSales_ComputeTotal_(RowLocation)
		{
				//assign value into hidden Debit and Credit from Debit and Credit users input
                var mDb = parseFloat(eval('document.frmFinancial.hidDebit'+RowLocation+'.value;').replace(/,/g,''));
				var mCr = parseFloat(eval('document.frmFinancial.hidCredit'+RowLocation+'.value;').relace(/,/g,''));
				
				eval('document.frmFinancial.mhidDebit'+RowLocation+'.value=\''+mDb+'\';');
				eval('document.frmFinancial.mhidCredit'+RowLocation+'.value=\''+mCr+'\';');
				aCashSales_ComputeTotal(1);
		}		
		
		
/////////////////////////////////////////////general journal////////////////////////////////////////////////
function aGeneralJournal_SearchVoyageReference()
		{
			//alert("");
			var mVoyageReference = document.frmFinancial.txtReferenceNo.value;
			
			if (mVoyageReference!='')
				{
					var ajaxRequest = getAjaxRequest();
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('voyagereference');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									//alert(ajaxRequest.responseText);
								}
						}
					var param="Start=9&VoyageReference="+mVoyageReference;	
					ajaxRequest.open("POST", "generaljournal_ajax.php", true);					
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param); 
				}	

		}
	function aGeneralJournal_SetSearchVoyageReference(value) 
		{
			document.getElementById('txtReferenceNo').value = value;
			document.getElementById('voyagereference').innerHTML = '';
		}	

	function aGeneralJournal_Action(mAction)
		{
			if (mAction == 1)
				{
							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									//eGeneralJournal_LoadAccount();		
								}
							}

							var param= "Start=1";
							ajaxRequest.open("POST","generaljournal_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);			
				}
			else if (mAction == 2)
				{	
					var mControlNo = document.frmFinancial.txtControlNo.value;
					var mDate1 = document.frmFinancial.Date1.value;
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mAmount = document.frmFinancial.txtTotalDebit.value;//document.frmFinancial.txtAmount.value;
					mAmount =parseFloat(eval('document.frmFinancial.txtTotalDebit.value;').replace(/,/g,''));
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';//document.frmFinancial.hidData.value;
					var mRec = document.frmFinancial.hidRec.value;
					var mStatus = 0;
					var mOk = '1';
		
					if (parseFloat(mRec)=='0')
						{
							alert('Unable to Save, No Item Selected!');
							mOk = '0';
						}
					if (document.frmFinancial.txtTotalDebit.value != document.frmFinancial.txtTotalCredit.value) 
						{
							alert ('Total Debit Account must be equal to Total Credit Account!');
							mOk = '0';
						}						
					
					if (mOk=='1')
						{
							if (mAction==3) { mStatus=1; }

							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									aGeneralJournal_LoadAccount();		
								}
							}

							var param= "Start=2&ControlNo="+mControlNo+"&Date1="+mDate1+"&Amount="+mAmount+"&ReferenceNo="+mReferenceNo+"&Particular="+escape(mParticular)+"&Rec="+mRec+"&Data="+mData+"&Status="+mStatus;
							ajaxRequest.open("POST","generaljournal_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);								
						}
				}
			else if (mAction == 3)
				{
							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									aGeneralJournal_LoadAccount();		
								}
							}

							var param= "Start=1&ControlNo=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status=";
							ajaxRequest.open("POST","generaljournal_search.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);			
				}
		}

	function aGeneralJournal_AutoSave()
		{
			
					var mControlNo = document.frmFinancial.txtControlNo.value;
					var mDate1 = document.frmFinancial.Date1.value;
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mAmount = 0;//document.frmFinancial.txtTotalDebit.value;//document.frmFinancial.txtAmount.value;
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';//document.frmFinancial.hidData.value;
					var mRec = document.frmFinancial.hidRec.value;
					var mStatus = 0;
					var mOk = '1';

					if (mOk=='1')
						{
							window.close;
							window.open('generaljournal_add.php?Start=2&ControlNo='+mControlNo+
																      '&Date1='+mDate1+
																      '&ReferenceNo='+mReferenceNo+
																      '&Amount='+mAmount+
																      '&Particular='+escape(mParticular)+
																      '&Rec='+mRec+
																      '&Data='+mData+
																      '&Status='+mStatus
									,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');

						}

		}

	function aGeneralJournal_EnterKey(i,event)
		{
			if (event.keyCode == 13)
				{
					if (i==1) 
						{ 
							document.frmFinancial.cboDay1.focus(); 
						}
					if (i==2) 
						{ 
							document.frmFinancial.cboYear1.focus(); 
						}
					if (i==3) 
						{ 
							document.frmFinancial.txtAmount.focus(); 
							document.frmFinancial.txtAmount.select(); 
						}
					if (i==4) 
						{ 
							document.frmFinancial.txtAccountID.focus(); 
							document.frmFinancial.txtAccountID.select(); 
						}
					return false;
				}
			return true;
		}
	function aGeneralJournal_EnterAccountID(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					aGeneralJournal_SearchAccount();
					return false;
				}
			return true;
		}
	function aGeneralJournal_EnterAccountID_(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					aGeneralJournal_AccountFocus();
					return false;
				}
			return true;
		}
	function aGeneralJournal_EnterSubsidiaryID(event)
		{
			var mDebit = eval('document.frmFinancial.hidDebit.value;');
			
			if (event.keyCode == 13)
				{
					if (mDebit=='1')
						{
							eval('document.frmFinancial.txtDebit.focus();');
							eval('document.frmFinancial.txtDebit.select();');
						}
					else
						{
							eval('document.frmFinancial.txtCredit.focus();');
							eval('document.frmFinancial.txtCredit.select();');
						}
					return false;
				}
			return true;
		}
	function aGeneralJournal_EnterSave(event)
		{
			
			if (event.keyCode == 13)
				{
					DebitAmt = eval('document.frmFinancial.txtDebit.value;');
					CreditAmt = eval('document.frmFinancial.txtCredit.value;');
					if(isNaN(DebitAmt))
					{
						alert("Invalid Debit Entry");
						return;
					}
					if(isNaN(CreditAmt))
					{
						alert("Invalid Credit Entry");
						return;
					}
					aGeneralJournal_SaveAccount();
					return false;
				}
			return true;
		}
	function aGeneralJournal_SearchAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mEmpty = '';

			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									eval('document.frmFinancial.hidDebit.value=\''+str[0]+'\';');
									eval('document.frmFinancial.hidTotCount.value=\''+str[1]+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+str[2]+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+str[3]+'\';');	
									eval('document.frmFinancial.cboAccountID.value=\''+str[2]+'\';');		
									eval('document.frmFinancial.txtDebit.value=\''+str[4]+'\';');									
									eval('document.frmFinancial.txtCredit.value=\''+str[5]+'\';');									

									if (parseFloat(str[1]) > 0)
										{
											aGeneralJournal_SearchSubsidiary();
										}
									else
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option("-No Subsidiary Code-","");
										
											if (parseFloat(str[0])==1)
												{
													eval('document.frmFinancial.txtDebit.focus();');
													eval('document.frmFinancial.txtDebit.select();');
												}
											else
												{
													eval('document.frmFinancial.txtCredit.focus();');
													eval('document.frmFinancial.txtCredit.select();');
												}
										}
								}
							else
								{
									eval('document.frmFinancial.cboAccountID.value=\''+mEmpty+'\';');	
									eval('document.frmFinancial.txtAccountID.select();');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');	
									alert('Account Code does not exist!');
								}
								
						}	
				}

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aGeneralJournal_SearchAccount_()
		{
			var ajaxRequest = getAjaxRequest();

			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mEmpty = '';

			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");
							
							if (str!='')
								{
									eval('document.frmFinancial.hidDebit.value=\''+str[0]+'\';');
									eval('document.frmFinancial.hidTotCount.value=\''+str[1]+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+str[2]+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+str[3]+'\';');	
									eval('document.frmFinancial.txtDebit.value=\''+str[4]+'\';');									
									eval('document.frmFinancial.txtCredit.value=\''+str[5]+'\';');									

									if (parseFloat(str[1]) > 0)
										{
											aGeneralJournal_SearchSubsidiary_();
										}
									else
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option("-No Subsidiary Code-","");
										}
								}
							else
								{
									eval('document.frmFinancial.txtAccountID.value=\''+mEmpty+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');	
								}
						}	
				}

			var param= "Start=4&AccountID=" + mAccountID;
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aGeneralJournal_SearchSubsidiary()
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty = '';
			var mAccountID = eval('document.frmFinancial.cboAccountID.value;');
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			var j = 1;
			var k = 2;
			mSubsidiary.options.length = 0;
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									for (i = 1; i <= parseFloat(str[0]) ; i++)
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option(str[k],str[j]);
											j = j + 2;
											k = k + 2;
										}
									eval('document.frmFinancial.cboSubsidiaryID.focus();');
								}
						}	
				}

			var param= "Start=5&AccountID=" + mAccountID;
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param); 
		}
	function aGeneralJournal_AccountFocus()
		{
			var ajaxRequest = getAjaxRequest();
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mEmpty = '';

			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									if (parseFloat(str[1]) > 0)
										{
											eval('document.frmFinancial.cboSubsidiaryID.focus();');
										}
									else
										{
											if (parseFloat(str[0])==1)
												{
													eval('document.frmFinancial.txtDebit.focus();');
													eval('document.frmFinancial.txtDebit.select();');
												}
											else
												{
													eval('document.frmFinancial.txtCredit.focus();');
													eval('document.frmFinancial.txtCredit.select();');
												}
										}
								}
						}	
				}

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aGeneralJournal_SearchSubsidiary_()
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty = '';
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			var j = 1;
			var k = 2;
			mSubsidiary.options.length = 0;
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									for (i = 1; i <= parseFloat(str[0]) ; i++)
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option(str[k],str[j]);
											j = j + 2;
											k = k + 2;
										}
								}
						}	
				}

			var param= "Start=5&AccountID=" + mAccountID;
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aGeneralJournal_chkAll()
		{
			var mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.chkAccount.checked;'))
						{
							document.getElementById("chkSelect"+i).checked=true;
						}
					else
						{
							document.getElementById("chkSelect"+i).checked=false;
						}
				}
		}
	function aGeneralJournal_DeleteAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mRec = document.frmFinancial.hidRec.value;
			var mData = '';
			var mTotRec = mRec;
		
			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.chkSelect'+i+'.checked;'))
						{ 
							mTotRec = parseFloat(mTotRec) - 1;
						}
					else
						{
							mData = mData + eval('document.frmFinancial.hidAccountID'+i+'.value;') + '!'
										  + eval('document.frmFinancial.hidAccountTitle'+i+'.value;') + '!'
										  + eval('document.frmFinancial.hidSubsidiaryID'+i+'.value;') + '!'
										  + parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value;').replace(/,/g,'')) + '!'
										  + parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value;').replace(/,/g,'')) + '!*';	
						}
				}

			eval('document.frmFinancial.hidRec.value=\''+mTotRec+'\';');
			eval('document.frmFinancial.hidData.value=\''+mData+'\';');
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							if (mTotRec > 0) { ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mTotRec;
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function aGeneralJournal_SaveAccount() 
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty ='';
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mRec = document.frmFinancial.hidRec.value;
			var mData =  document.frmFinancial.hidData.value;
			//	alert("insert detail record saveaccount");	
			if (eval('document.frmFinancial.txtAccountTitle.value;')=='') 
				{
					alert ('Account Does Not Exist!');
					eval('document.frmFinancial.txtAccountID.focus();');
					eval('document.frmFinancial.txtAccountID.select();');
				}
			else
				{
					mRec = parseFloat(mRec) + 1;
					mData = mData + eval('document.frmFinancial.txtAccountID.value;') + '!' 
								  + eval('document.frmFinancial.txtAccountTitle.value;') + '!' 
								  + eval('document.frmFinancial.cboSubsidiaryID.value;') + '!'
								  + parseFloat(eval('document.frmFinancial.txtDebit.value;').replace(/,/g,'')) + '!'
								  + parseFloat(eval('document.frmFinancial.txtCredit.value;').replace(/,/g,'')) + '!*';	
			
					eval('document.frmFinancial.hidRec.value=\''+mRec+'\';');

					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									
									var mSubsidiary = document.frmFinancial.cboSubsidiaryID;

									mSubsidiary.options.length = 0;
									mSubsidiary.options[mSubsidiary.options.length] = new Option("-Select Subsidiary Description-","");
									
									eval('document.frmFinancial.hidData.value=\''+mData+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtDebit.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtCredit.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtAccountID.focus();');
									eval('document.frmFinancial.txtAccountID.select();');
									aGeneralJournal_ComputeTotal(1);
								}
						}

					var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
					ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);		
				}
		}
	function aGeneralJournal_LoadAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mRec = document.frmFinancial.hidRec.value;
			var mData = document.frmFinancial.hidData.value;
		
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							if (mRec > 0) { ComputeTotal(1); }
							eval('document.frmFinancial.txtAmount.value=\''+document.frmFinancial.txtTotalDebit.value+'\';');
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function aGeneralJournal_UpdateSession(m_Rec)
		{
		m_Data = eval('document.frmFinancial.hidData.value;');
		var ajaxRequest = getAjaxRequest();
		ajaxRequest.onreadystatechange = function()
			{
				if(ajaxRequest.readyState == 4)
					{
					}
			}		
			var param= "Start=6&Data=" + m_Data + "&Rec=" + m_Rec;
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}	

	function aGeneralJournal_ComputeTotal(RowLocation)
		{

	
			var mRec = 0;
			var mData = '';
			var i = 0;
			var mDebit = 0;
			var mCredit = 0;
			var mTotalDebit = 0;
			var mTotalCredit = 0;

			mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value')) > 0) 
						{
							if (parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value')) > 0) 
								{
									alert ('Account can either be debit or credit!');
									eval('document.frmFinancial.hidCredit'+i+'.focus();')
									eval('document.frmFinancial.hidCredit'+i+'.select();')
									return false;
								}	
						}
					
					mData = mData + eval('document.frmFinancial.hidAccountID'+i+'.value;') + '!'
								  + eval('document.frmFinancial.hidAccountTitle'+i+'.value;') + '!'
								  + eval('document.frmFinancial.hidSubsidiaryID'+i+'.value;') + '!'
								  + parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value;').replace(/,/g,'')) + '!'
								  + parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value;').replace(/,/g,'')) + '*';	
					
					mDebit = parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value').replace(/,/g,''));
					mCredit = parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value').replace(/,/g,''));
					mTotalDebit = mTotalDebit + parseFloat(mDebit);				
					mTotalCredit = mTotalCredit + parseFloat(mCredit);
				}	
			//alert("compute total"+mData);	
			eval('document.frmFinancial.txtTotalDebit.value=\''+mTotalDebit+'\';');
			eval('document.frmFinancial.txtTotalCredit.value=\''+mTotalCredit+'\';');

			document.frmFinancial.hidRec.value = mRec;
			document.frmFinancial.hidData.value = mData;
			aGeneralJournal_UpdateSession(mRec);
		}
		
/////////////////////////////////////////////check disbursement/////////////////////////////////////////////////////

function aCheckDisbursement_SearchVoyageReference()
		{
			var mVoyageReference = document.frmFinancial.txtReferenceNo.value;
			
			if (mVoyageReference!='')
				{
					var ajaxRequest = getAjaxRequest();
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('voyagereference');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									//alert(ajaxRequest.responseText);
								}
						}
					var param="Start=9&VoyageReference="+mVoyageReference;	
					ajaxRequest.open("POST", "checkdisbursement_ajax.php", true);					
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param); 
				}	

		}
function aCheckDisbursement_SetSearchVoyageReference(value) 
		{
			document.getElementById('txtReferenceNo').value = value;
			document.getElementById('voyagereference').innerHTML = '';
		}

function aCheckDisbursement_SearchPaymasterID()
		{
			var mPaymasterID = document.frmFinancial.txtPaymasterID.value;
			//alert(mPaymasterID);
			if (mPaymasterID !='')
				{
					var ajaxRequest = getAjaxRequest();
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('PaymasterID');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									//alert(ajaxRequest.responseText);
								}
						}
					var param="Start=10&PaymasterID="+mPaymasterID;	
					ajaxRequest.open("POST", "checkdisbursement_ajax.php", true);					
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param); 
				}	

		}
	function aCheckDisbursement_SetSearchPaymasterID(value) 
		{
			document.getElementById('txtPaymasterID').value = value;
			document.getElementById('PaymasterID').innerHTML = '';
		}			
	function aCheckDisbursement_Action(mAction)
		{
			
			if (mAction == 1)
				{
							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
								}
							}

							var param= "Start=1";
							ajaxRequest.open("POST","checkdisbursement_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);	
					
				}
			else if (mAction == 2)
				{
				
					var mControlNo = document.frmFinancial.txtControlNo.value;
					var mDate1 = document.frmFinancial.Date1.value;
					
					var mPaymasterID = document.frmFinancial.txtPaymasterID.value;
					var mBankID = document.frmFinancial.cboBankID.options[document.frmFinancial.cboBankID.selectedIndex].value;
					
					var mCheckNo = document.frmFinancial.txtCheckNo.value;
					alert("first savingssa");
					var mDate2 = document.frmFinancial.Date2.value;
					var mAmount = document.frmFinancial.txtAmount.value; //document.frmFinancial.txtTotalDebit.value;
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					
					mAmount =parseFloat(eval('document.frmFinancial.txtAmount.value;').replace(/,/g,''));
					var mTotalCredit = document.frmFinancial.txtTotalCredit.value;	
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';//document.frmFinancial.hidData.value;
					var mRec = document.frmFinancial.hidRec.value;
					var mOk = '0';
					var mOk_ = '0';
					
					alert("saving checks");
					if(mParticular !== "" || typeof(mParticular) !== 'undefined')
						{
							mOk = '1';
						}
	
					if (parseFloat(mRec)=='0')
						{
							alert('Unable to Save, No Item Selected!');
							mOk = '0';
						}			
					
					if (document.frmFinancial.txtTotalDebit.value != document.frmFinancial.txtTotalCredit.value) 
						{
							alert ('Total Debit Account must be equal to Total Credit Account!');
							mOk = '0';
						}
										for (i = 1; i <= mRec; i++) 
										{
											if (eval('document.frmFinancial.hidAccountID'+i+'.value;')==mBankID)
												{
													mOk_  = '1';
												}
										}
										if  (mOk_ != '1')
										{
											alert('Unable to Save, Check Bank Name Selection!');
											mOk = '0';
										}
		
					if (mOk=='1')
						{

						var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									aCheckDisbursement_LoadAccount();		
								}
							}

							var param= "Start=2&ControlNo="+mControlNo+"&Date1="+mDate1+"&ReferenceNo="+mReferenceNo+"&PaymasterID="+mPaymasterID+"&BankID="+mBankID+"&CheckNo="+escape(mCheckNo)+"&Date2="+mDate2+"&Amount="+mAmount+"&Particular="+escape(mParticular)+"&Rec="+mRec+"&Data="+mData;
							ajaxRequest.open("POST","checkdisbursement_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);							
						}						
				}
			else if (mAction == 3)
				{

						var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();		
								}
							}

							var param= "Start=1&ControlNo=&ControlDate=&ReferenceNo=&PaymasterID=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status=";
							ajaxRequest.open("POST","checkdisbursement_search.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);						
				}
		}
	function aCheckDisbursement_EnterKey(i,event)
		{
			if (event.keyCode == 13)
				{
					if (i==1) 
						{ 
							document.frmFinancial.cboMonth1.focus(); 
							document.frmFinancial.cboMonth1.select(); 						
						}
					if (i==2) 
						{ 
							document.frmFinancial.cboDay1.focus(); 
							document.frmFinancial.cboDay1.select(); 
						}
					if (i==3) 
						{ 
							document.frmFinancial.cboYear1.focus(); 
							document.frmFinancial.cboYear1.select(); 
						}
					if (i==4) 
						{ 
							document.frmFinancial.cboPaymasterID.focus(); 
						}
					if (i==5) 
						{ 
							document.frmFinancial.cboBankID.focus(); 
						}
					if (i==6) 
						{ 
							document.frmFinancial.txtCheckNo.focus(); 
							document.frmFinancial.txtCheckNo.select(); 
						}
					if (i==7) 
						{ 
							document.frmFinancial.cboMonth2.focus(); 
						}
					if (i==8) 
						{ 
							document.frmFinancial.cboDay2.focus(); 
						}
					if (i==9) 
						{ 
							document.frmFinancial.cboYear2.focus(); 
						}
					if (i==10) 
						{ 
							document.frmFinancial.txtAmount.focus(); 
							document.frmFinancial.txtAmount.select(); 
						}
					if (i==11) 
						{ 
							document.frmFinancial.txtAccountID.focus(); 
						}
					return false;
				}
			return true;
		}
	function aCheckDisbursement_EnterAccountID(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					aCheckDisbursement_SearchAccount();
					return false;
				}
			return true;
		}
	function aCheckDisbursement_EnterAccountID_(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					aCheckDisbursement_AccountFocus();
					return false;
				}
			return true;
		}
	function aCheckDisbursement_EnterSubsidiaryID(event)
		{
			var mDebit = eval('document.frmFinancial.hidDebit.value;');
			
			if (event.keyCode == 13)
				{
					if (mDebit=='1')
						{
							eval('document.frmFinancial.txtDebit.focus();');
							eval('document.frmFinancial.txtDebit.select();');
						}
					else
						{
							eval('document.frmFinancial.txtCredit.focus();');
							eval('document.frmFinancial.txtCredit.select();');
						}
					return false;
				}
			return true;
		}
	function aCheckDisbursement_EnterSave(event)
		{
			if (event.keyCode == 13)
				{
					DebitAmt = eval('document.frmFinancial.txtDebit.value;');
					CreditAmt = eval('document.frmFinancial.txtCredit.value;');
					if(isNaN(DebitAmt))
					{
						alert("Invalid Debit Entry");
						return;
					}
					if(isNaN(CreditAmt))
					{
						alert("Invalid Credit Entry");
						return;
					}
					aCheckDisbursement_SaveAccount();
					return false;
				}
			return true;
		}
	function aCheckDisbursement_SearchAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mEmpty = '';

			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									eval('document.frmFinancial.hidDebit.value=\''+str[0]+'\';');
									eval('document.frmFinancial.hidTotCount.value=\''+str[1]+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+str[2]+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+str[3]+'\';');	
									eval('document.frmFinancial.cboAccountID.value=\''+str[2]+'\';');		
									eval('document.frmFinancial.txtDebit.value=\''+str[4]+'\';');									
									eval('document.frmFinancial.txtCredit.value=\''+str[5]+'\';');									

									if (parseFloat(str[1]) > 0)
										{
											aCheckDisbursement_SearchSubsidiary();
										}
									else
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option("-No Subsidiary Code-","");
										
											if (parseFloat(str[0])==1)
												{
													eval('document.frmFinancial.txtDebit.focus();');
													eval('document.frmFinancial.txtDebit.select();');
												}
											else
												{
													eval('document.frmFinancial.txtCredit.focus();');
													eval('document.frmFinancial.txtCredit.select();');
												}
										}
								}
							else
								{
									eval('document.frmFinancial.cboAccountID.value=\''+mEmpty+'\';');	
									eval('document.frmFinancial.txtAccountID.select();');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');	
									alert('Account Code does not exist!');
								}
								
						}	
				}

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCheckDisbursement_SearchAccount_()
		{
			var ajaxRequest = getAjaxRequest();

			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mEmpty = '';

			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");
							
							if (str!='')
								{
									eval('document.frmFinancial.hidDebit.value=\''+str[0]+'\';');
									eval('document.frmFinancial.hidTotCount.value=\''+str[1]+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+str[2]+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+str[3]+'\';');	
									eval('document.frmFinancial.txtDebit.value=\''+str[4]+'\';');									
									eval('document.frmFinancial.txtCredit.value=\''+str[5]+'\';');									

									if (parseFloat(str[1]) > 0)
										{
											aCheckDisbursement_SearchSubsidiary_();
										}
									else
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option("-No Subsidiary Code-","");
										}
								}
							else
								{
									eval('document.frmFinancial.txtAccountID.value=\''+mEmpty+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');	
								}
						}	
				}

			var param= "Start=4&AccountID=" + mAccountID;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param); 
		}
	function aCheckDisbursement_SearchSubsidiary()
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty = '';
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			var j = 1;
			var k = 2;
			mSubsidiary.options.length = 0;
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									for (i = 1; i <= parseFloat(str[0]) ; i++)
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option(str[k],str[j]);
											j = j + 2;
											k = k + 2;
										}
									eval('document.frmFinancial.cboSubsidiaryID.focus();');
								}
						}	
				}

			var param= "Start=5&AccountID=" + mAccountID;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCheckDisbursement_AccountFocus()
		{
			var ajaxRequest = getAjaxRequest();
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mEmpty = '';

			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									if (parseFloat(str[1]) > 0)
										{
											eval('document.frmFinancial.cboSubsidiaryID.focus();');
										}
									else
										{
											if (parseFloat(str[0])==1)
												{
													eval('document.frmFinancial.txtDebit.focus();');
													eval('document.frmFinancial.txtDebit.select();');
												}
											else
												{
													eval('document.frmFinancial.txtCredit.focus();');
													eval('document.frmFinancial.txtCredit.select();');
												}
										}
								}
						}	
				}

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCheckDisbursement_SearchSubsidiary_()
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty = '';
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			var j = 1;
			var k = 2;
			mSubsidiary.options.length = 0;
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									for (i = 1; i <= parseFloat(str[0]) ; i++)
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option(str[k],str[j]);
											j = j + 2;
											k = k + 2;
										}
								}
						}	
				}

			var param= "Start=5&AccountID=" + mAccountID;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCheckDisbursement_chkAll()
		{
			var mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.chkAccount.checked;'))
						{
							document.getElementById("chkSelect"+i).checked=true;
						}
					else
						{
							document.getElementById("chkSelect"+i).checked=false;
						}
				}
		}
	function aCheckDisbursement_DeleteAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mRec = document.frmFinancial.hidRec.value;
			var mData = '';
			var mTotRec = mRec;
		
			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.chkSelect'+i+'.checked;'))
						{ 
							mTotRec = parseFloat(mTotRec) - 1;
						}
					else
						{
							mData = mData + eval('document.frmFinancial.hidAccountID'+i+'.value;') + '!'
										  + eval('document.frmFinancial.hidAccountTitle'+i+'.value;') + '!'
										  + eval('document.frmFinancial.hidSubsidiaryID'+i+'.value;') + '!'
										  + gf_RemoveComma(eval('document.frmFinancial.hidDebit'+i+'.value;')) + '!'
										  + gf_RemoveComma(eval('document.frmFinancial.hidCredit'+i+'.value;')) + '!*';	
						}
				}

			eval('document.frmFinancial.hidRec.value=\''+mTotRec+'\';');
			eval('document.frmFinancial.hidData.value=\''+mData+'\';');
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							if (mTotRec > 0) { ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mTotRec;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function aCheckDisbursement_SaveAccount() 
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty ='';
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mRec = document.frmFinancial.hidRec.value;
			var mData =  document.frmFinancial.hidData.value;
					
			if (eval('document.frmFinancial.txtAccountTitle.value;')=='') 
				{
					alert ('Account Does Not Exist!');
					eval('document.frmFinancial.txtAccountID.focus();');
					eval('document.frmFinancial.txtAccountID.select();');
				}
			else
				{
					mRec = parseFloat(mRec) + 1;
					mData = mData + eval('document.frmFinancial.txtAccountID.value;') + '!' 
								  + eval('document.frmFinancial.txtAccountTitle.value;') + '!' 
								  + eval('document.frmFinancial.cboSubsidiaryID.value;') + '!'
								  + parseFloat(eval('document.frmFinancial.txtDebit.value;').replace(/,/g,'')) + '!'
								  + parseFloat(eval('document.frmFinancial.txtCredit.value;').replace(/,/g,'')) + '!*';
			
					eval('document.frmFinancial.hidRec.value=\''+mRec+'\';');

					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									
									var mSubsidiary = document.frmFinancial.cboSubsidiaryID;

									mSubsidiary.options.length = 0;
									mSubsidiary.options[mSubsidiary.options.length] = new Option("-Select Subsidiary Description-","");
									
									eval('document.frmFinancial.hidData.value=\''+mData+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtDebit.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtCredit.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtAccountID.focus();');
									eval('document.frmFinancial.txtAccountID.select();');
									aCheckDisbursement_ComputeTotal(1);
								}
						}

					var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
					ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);		
				}
		}
	function aCheckDisbursement_LoadAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mRec = document.frmFinancial.hidRec.value;
			var mData = document.frmFinancial.hidData.value;
		
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							if (mRec > 0) { aCheckDisbursement_ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);	
		}

	function aCheckDisbursement_UpdateSession(m_Rec)
		{
		m_Data = eval('document.frmFinancial.hidData.value;');
		var ajaxRequest = getAjaxRequest();
		ajaxRequest.onreadystatechange = function()
			{
				if(ajaxRequest.readyState == 4)
					{
					}
			}		
			var param= "Start=6&Data=" + m_Data + "&Rec=" + m_Rec;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}	

	function aCheckDisbursement_ComputeTotal(RowLocation)
		{


			var mRec = 0;
			var mData = '';
			var i = 0;
			var mDebit = 0;
			var mCredit = 0;
			var mTotalDebit = 0;
			var mTotalCredit = 0;

			mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value')) > 0) 
						{
							if (parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value')) > 0) 
								{
									alert ('Account can either be debit or credit!');
									eval('document.frmFinancial.hidCredit'+i+'.focus();')
									eval('document.frmFinancial.hidCredit'+i+'.select();')
									return false;
								}	
						}
					
					mData = mData + eval('document.frmFinancial.hidAccountID'+i+'.value;') + '!'
								  + eval('document.frmFinancial.hidAccountTitle'+i+'.value;') + '!'
								  + eval('document.frmFinancial.hidSubsidiaryID'+i+'.value;') + '!'
								  + parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value;').replace(/,/g,'')) + '!'
								  + parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value;').replace(/,/g,'')) + '*';	
					
					mDebit = parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value;').replace(/,/g,''));
					mCredit = parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value;').replace(/,/g,''));
					mTotalDebit = mTotalDebit + parseFloat(mDebit);				
					mTotalCredit = mTotalCredit + parseFloat(mCredit);
				}	
			//alert(mData);	
			eval('document.frmFinancial.txtTotalDebit.value=\''+mTotalDebit+'\';');
			eval('document.frmFinancial.txtTotalCredit.value=\''+mTotalCredit+'\';');

			document.frmFinancial.hidRec.value = mRec;
			document.frmFinancial.hidData.value = mData;
			aCheckDisbursement_UpdateSession(mRec);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	////////////////////////////////////////////////cash receipts/////////////////////////////////////////////////////////

	function aCashReceipts_SearchVoyageReference()
		{
			var mVoyageReference = document.frmFinancial.txtReferenceNo.value;
			
			if (mVoyageReference!='')
				{
					var ajaxRequest = getAjaxRequest();
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('voyagereference');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									//alert(ajaxRequest.responseText);
								}
						}
					var param="Start=9&VoyageReference="+mVoyageReference;	
					ajaxRequest.open("POST", "cashreceipts_ajax.php", true);					
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param); 
				}	

		}
	function aCashReceipts_SetSearchVoyageReference(value) 
		{
			document.getElementById('txtReferenceNo').value = value;
			document.getElementById('voyagereference').innerHTML = '';
		}	
	function aCashReceipts_Action(mAction)
		{
			if (mAction == 1)
				{
							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									eCashReceipts_LoadAccount();		
								}
							}

							var param= "Start=1";
							ajaxRequest.open("POST","cashreceipts_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);		
				}
			else if (mAction == 2)
				{
					var mControlNo = document.frmFinancial.txtControlNo.value;
					var mDate1 = document.frmFinancial.Date1.value;

					var mAmount = document.frmFinancial.txtTotalDebit.value;//document.frmFinancial.txtAmount.value;
					mAmount =parseFloat(eval('document.frmFinancial.txtTotalDebit.value;').replace(/,/g,''));
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';//document.frmFinancial.hidData.value;
					var mRec = document.frmFinancial.hidRec.value;
					var mStatus = 0;
					var mOk = '1';
					
					if (parseFloat(mRec)=='0')
						{
							alert('Unable to Save, No Item Selected!');
							mOk = '0';
						}
					if (document.frmFinancial.txtTotalDebit.value != document.frmFinancial.txtTotalCredit.value) 
						{
							alert ('Total Debit Account must be equal to Total Credit Account!');
							mOk = '0';
						}						
					
					if (mOk=='1')
						{
							if (mAction==3) { mStatus=1; }

							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									eCashReceipts_LoadAccount();		
								}
							}

							var param= "Start=2&ControlNo="+mControlNo+"&Date1="+mDate1+"&ReferenceNo="+escape(mReferenceNo)+"&Amount="+mAmount+"&Particular="+escape(mParticular)+"&Rec="+mRec+"&Data="+mData+"&Status="+mStatus;
							ajaxRequest.open("POST","cashreceipts_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);		
						}
				}
			else if (mAction == 3)
				{
							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									eCashReceipts_LoadAccount();		
								}
							}

							var param= "Start=1&ControlNo=&Reference=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2&Status=";
							ajaxRequest.open("POST","cashreceipts_search.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);			
				}
		}
	function aCashReceipts_AutoSave()
		{
			
					var mControlNo = document.frmFinancial.txtControlNo.value;
					var mDate1 = document.frmFinancial.Date1.value;
					var mAmount = 0;//document.frmFinancial.txtTotalDebit.value;//document.frmFinancial.txtAmount.value;
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';//document.frmFinancial.hidData.value;
					var mRec = document.frmFinancial.hidRec.value;
					var mStatus = 0;
					var mOk = '1';

					if (mOk=='1')
						{
							window.close;
							window.open('cashreceipts_add.php?Start=2&ControlNo='+mControlNo+
																    '&Date1='+mDate1+
																    '&ReferenceNo='+escape(mReferenceNo)+
																    '&Amount='+mAmount+
																    '&Particular='+escape(mParticular)+
																    '&Rec='+mRec+
																    '&Data='+mData+
																    '&Status='+mStatus
									,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');

						}

		}

	function aCashReceipts_EnterKey(i,event)
		{
			if (event.keyCode == 13)
				{
					if (i==1) 
						{ 
							document.frmFinancial.cboDay1.focus(); 
						}
					if (i==2) 
						{ 
							document.frmFinancial.cboYear1.focus(); 
						}
					if (i==3) 
						{ 
							document.frmFinancial.txtReferenceNo.focus(); 
							document.frmFinancial.txtReferenceNo.select(); 
						}
					if (i==4) 
						{ 
							document.frmFinancial.txtAmount.focus(); 
							document.frmFinancial.txtAmount.select(); 
						}
					if (i==5) 
						{ 
							document.frmFinancial.txtAccountID.focus(); 
							document.frmFinancial.txtAccountID.select(); 
						}
					return false;
				}
			return true;
		}
	function aCashReceipts_EnterAccountID(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					aCashReceipts_SearchAccount();
					return false;
				}
			return true;
		}
	function aCashReceipts_EnterAccountID_(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					aCashReceipts_AccountFocus();
					return false;
				}
			return true;
		}
	function aCashReceipts_EnterSubsidiaryID(event)
		{
			var mDebit = eval('document.frmFinancial.hidDebit.value;');
			
			if (event.keyCode == 13)
				{
					if (mDebit=='1')
						{
							eval('document.frmFinancial.txtDebit.focus();');
							eval('document.frmFinancial.txtDebit.select();');
						}
					else
						{
							eval('document.frmFinancial.txtCredit.focus();');
							eval('document.frmFinancial.txtCredit.select();');
						}
					return false;
				}
			return true;
		}
	function aCashReceipts_EnterSave(event)
		{
			if (event.keyCode == 13)
				{
					DebitAmt = eval('document.frmFinancial.txtDebit.value;');
					CreditAmt = eval('document.frmFinancial.txtCredit.value;');
					if(isNaN(DebitAmt))
					{
						alert("Invalid Debit Entry");
						return;
					}
					if(isNaN(CreditAmt))
					{
						alert("Invalid Credit Entry");
						return;
					}
					aCashReceipts_SaveAccount();
					return false;
				}
			return true;
		}
	function aCashReceipts_SearchAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mEmpty = '';

			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									eval('document.frmFinancial.hidDebit.value=\''+str[0]+'\';');
									eval('document.frmFinancial.hidTotCount.value=\''+str[1]+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+str[2]+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+str[3]+'\';');	
									eval('document.frmFinancial.cboAccountID.value=\''+str[2]+'\';');		
									eval('document.frmFinancial.txtDebit.value=\''+str[4]+'\';');									
									eval('document.frmFinancial.txtCredit.value=\''+str[5]+'\';');									

									if (parseFloat(str[1]) > 0)
										{
											aCashReceipts_SearchSubsidiary();
										}
									else
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option("-No Subsidiary Code-","");
										
											if (parseFloat(str[0])==1)
												{
													eval('document.frmFinancial.txtDebit.focus();');
													eval('document.frmFinancial.txtDebit.select();');
												}
											else
												{
													eval('document.frmFinancial.txtCredit.focus();');
													eval('document.frmFinancial.txtCredit.select();');
												}
										}
								}
							else
								{
									eval('document.frmFinancial.cboAccountID.value=\''+mEmpty+'\';');	
									eval('document.frmFinancial.txtAccountID.select();');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');	
									alert('Account Code does not exist!');
								}
								
						}	
				}

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCashReceipts_SearchAccount_()
		{
			var ajaxRequest = getAjaxRequest();

			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mEmpty = '';

			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");
							
							if (str!='')
								{
									eval('document.frmFinancial.hidDebit.value=\''+str[0]+'\';');
									eval('document.frmFinancial.hidTotCount.value=\''+str[1]+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+str[2]+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+str[3]+'\';');	
									eval('document.frmFinancial.txtDebit.value=\''+str[4]+'\';');									
									eval('document.frmFinancial.txtCredit.value=\''+str[5]+'\';');									

									if (parseFloat(str[1]) > 0)
										{
											aCashReceipts_SearchSubsidiary_();
										}
									else
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option("-No Subsidiary Code-","");
										}
								}
							else
								{
									eval('document.frmFinancial.txtAccountID.value=\''+mEmpty+'\';');	
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');	
								}
						}	
				}

			var param= "Start=4&AccountID=" + mAccountID;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCashReceipts_SearchSubsidiary()
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty = '';
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			var j = 1;
			var k = 2;
			mSubsidiary.options.length = 0;
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									for (i = 1; i <= parseFloat(str[0]) ; i++)
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option(str[k],str[j]);
											j = j + 2;
											k = k + 2;
										}
									eval('document.frmFinancial.cboSubsidiaryID.focus();');
								}
						}	
				}

			var param= "Start=5&AccountID=" + mAccountID;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCashReceipts_AccountFocus()
		{
			var ajaxRequest = getAjaxRequest();
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mEmpty = '';

			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									if (parseFloat(str[1]) > 0)
										{
											eval('document.frmFinancial.cboSubsidiaryID.focus();');
										}
									else
										{
											if (parseFloat(str[0])==1)
												{
													eval('document.frmFinancial.txtDebit.focus();');
													eval('document.frmFinancial.txtDebit.select();');
												}
											else
												{
													eval('document.frmFinancial.txtCredit.focus();');
													eval('document.frmFinancial.txtCredit.select();');
												}
										}
								}
						}	
				}

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCashReceipts_SearchSubsidiary_()
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty = '';
			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			var j = 1;
			var k = 2;
			mSubsidiary.options.length = 0;
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");

							if (str!='')
								{
									for (i = 1; i <= parseFloat(str[0]) ; i++)
										{
											mSubsidiary.options[mSubsidiary.options.length] = new Option(str[k],str[j]);
											j = j + 2;
											k = k + 2;
										}
								}
						}	
				}

			var param= "Start=5&AccountID=" + mAccountID;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function aCashReceipts_chkAll()
		{
			var mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.chkAccount.checked;'))
						{
							document.getElementById("chkSelect"+i).checked=true;
						}
					else
						{
							document.getElementById("chkSelect"+i).checked=false;
						}
				}
		}
	function aCashReceipts_DeleteAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mRec = document.frmFinancial.hidRec.value;
			var mData = '';
			var mTotRec = mRec;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.chkSelect'+i+'.checked;'))
						{ 
							mTotRec = parseFloat(mTotRec) - 1;
						}
					else
						{
							mData = mData + eval('document.frmFinancial.hidAccountID'+i+'.value;') + '!'
										  + eval('document.frmFinancial.hidAccountTitle'+i+'.value;') + '!'
										  + eval('document.frmFinancial.hidSubsidiaryID'+i+'.value;') + '!'
										  + parseFloat(eval('document.frmFinancial.mhidDebit'+i+'.value;').replace(/,/g,'')) + '!'
										  + parseFloat(eval('document.frmFinancial.mhidCredit'+i+'.value;').replace(/,/g,'')) + '!*';	
						}
				}

			eval('document.frmFinancial.hidRec.value=\''+mTotRec+'\';');
			eval('document.frmFinancial.hidData.value=\''+mData+'\';');
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							if (mTotRec > 0) { ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mTotRec ;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param); 		
		}
	function aCashReceipts_SaveAccount() 
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty ='';
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mRec = document.frmFinancial.hidRec.value;
			var mData =  document.frmFinancial.hidData.value;
					
			if (eval('document.frmFinancial.txtAccountTitle.value;')=='') 
				{
					alert ('Account Does Not Exist!');
					eval('document.frmFinancial.txtAccountID.focus();');
					eval('document.frmFinancial.txtAccountID.select();');
				}
			else
				{
					mRec = parseFloat(mRec) + 1;
					mData = mData + eval('document.frmFinancial.txtAccountID.value;') + '!' 
								  + eval('document.frmFinancial.txtAccountTitle.value;') + '!' 
								  + eval('document.frmFinancial.cboSubsidiaryID.value;') + '!'
								  + parseFloat(eval('document.frmFinancial.txtDebit.value;').replace(/,/g,'')) + '!'
								  + parseFloat(eval('document.frmFinancial.txtCredit.value;').replace(/,/g,'')) + '!*';	
			
					eval('document.frmFinancial.hidRec.value=\''+mRec+'\';');

					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									
									var mSubsidiary = document.frmFinancial.cboSubsidiaryID;

									mSubsidiary.options.length = 0;
									mSubsidiary.options[mSubsidiary.options.length] = new Option("-Select Subsidiary Description-","");
									
									eval('document.frmFinancial.hidData.value=\''+mData+'\';');
									eval('document.frmFinancial.txtAccountID.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtAccountTitle.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtDebit.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtCredit.value=\''+mEmpty+'\';');
									eval('document.frmFinancial.txtAccountID.focus();');
									eval('document.frmFinancial.txtAccountID.select();');
									aCashReceipts_ComputeTotal(1);
								}
						}

			var param= "Start=6&Data=" + mData + "&Rec=" + mRec ;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
				}
		}
	function aCashReceipts_LoadAccount()
		{
			var ajaxRequest = getAjaxRequest();
			var mRec = document.frmFinancial.hidRec.value;
			var mData = document.frmFinancial.hidData.value;
		
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							if (mRec > 0) { ComputeTotal(1); }
							eval('document.frmFinancial.txtAmount.value=\''+document.frmFinancial.txtTotalDebit.value+'\';');
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function aCashReceipts_UpdateSession(m_Rec)
		{
		m_Data = eval('document.frmFinancial.hidData.value;');
		var ajaxRequest = getAjaxRequest();
		ajaxRequest.onreadystatechange = function()
			{
				if(ajaxRequest.readyState == 4)
					{
					}
			}		
			var param= "Start=6&Data=" + m_Data + "&Rec=" + m_Rec;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}	

	function aCashReceipts_ComputeTotal(RowLocation)
		{

			var mRec = 0;
			var mData = '';
			var i = 0;
			var mDebit = 0;
			var mCredit = 0;
			var mTotalDebit = 0;
			var mTotalCredit = 0;

			mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (parseFloat(eval('document.frmFinancial.hidDebit'+i+'.value')) > 0) 
						{
							if (parseFloat(eval('document.frmFinancial.hidCredit'+i+'.value')) > 0) 
								{
									alert ('Account can either be debit or credit!');
									eval('document.frmFinancial.hidCredit'+i+'.focus();')
									eval('document.frmFinancial.hidCredit'+i+'.select();')
									return false;
								}	
						}
					
					mData = mData + eval('document.frmFinancial.hidAccountID'+i+'.value;') + '!'
								  + eval('document.frmFinancial.hidAccountTitle'+i+'.value;') + '!'
								  + eval('document.frmFinancial.hidSubsidiaryID'+i+'.value;') + '!'
								  + parseFloat(eval('document.frmFinancial.mhidDebit'+i+'.value;').replace(/,/g,'')) + '!'
								  + parseFloat(eval('document.frmFinancial.mhidCredit'+i+'.value;').replace(/,/g,'')) + '*';	
					
					mDebit = parseFloat(eval('document.frmFinancial.mhidDebit'+i+'.value').replace(/,/g,''));
					mCredit = parseFloat(eval('document.frmFinancial.mhidCredit'+i+'.value').replace(/,/g,''));
					mTotalDebit = mTotalDebit + parseFloat(mDebit);				
					mTotalCredit = mTotalCredit + parseFloat(mCredit);
				}	
				
			eval('document.frmFinancial.txtTotalDebit.value=\''+mTotalDebit+'\';');
			eval('document.frmFinancial.txtTotalCredit.value=\''+mTotalCredit+'\';');

			document.frmFinancial.hidRec.value = mRec;
			document.frmFinancial.hidData.value = mData;
			aCashReceipts_UpdateSession(mRec);
		}

	function aCashReceipts_ComputeTotal_(RowLocation)
		{
				//assign value into hidden Debit and Credit from Debit and Credit users input
                var mDb = parseFloat(eval('document.frmFinancial.hidDebit'+RowLocation+'.value;').replace(/,/g,''));
				var mCr = parseFloat(eval('document.frmFinancial.hidCredit'+RowLocation+'.value;').relace(/,/g,''));
				eval('document.frmFinancial.mhidDebit'+RowLocation+'.value=\''+mDb+'\';');
				eval('document.frmFinancial.mhidCredit'+RowLocation+'.value=\''+mCr+'\';');
				aCashReceipts_ComputeTotal(1);
		}		
		
	
		
		