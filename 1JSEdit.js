////////////////////////////////////MASTER ACCOUNTS////////////////////////////////////////////////
//fucniton
function eControlAccount_Action(mAction)
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
					var mAccountID = document.frmFinancial.hidAccountID.value;
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
					if (mOk=='1')
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
								ajaxRequest.open("POST","controlaccount_edit.php",true);
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
				ajaxRequest.open("POST","controlaccount_search.php",true);
				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				ajaxRequest.send(param);
			
			
				}
		}
	function eControlAccount_EnterKey(i,event)
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
					if (i==14) 
						{ 
							document.frmFinancial.chkAttachmenttofs.focus(); 
						}
					if (i==15) 
						{ 
							document.frmFinancial.chkGrossProfit.focus(); 
						}

					return false;
				}
			return true;
		}
/////////////////////////////////////SUB ACCOUNTS/////////////////////////////////////////
	function eSubsidiaryAccount_Validate()
		{
			//alert("subsidiary validate");
	
	
			/*if (gf_isCharEmpty("txtSubsidiaryDesc","Subsidiary Account Description"))
				{
					return true;
				}
					return false;	
			*/		
		}
	function eSubsidiaryAccount_Module()
		{	
			var mModule = document.frmCOA.cboModule.options[document.frmCOA.cboModule.selectedIndex].value;
			
			if (mModule == '')
				{
				}
			else
				{
					window.close;
					window.open(mModule,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
				}
		}
		
	function eSubsidiaryAccount_Action(mAction)
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
					var mAccountID = document.frmCOA.hidAccountID.value;
					var mSubsidiaryID = document.frmCOA.hidSubsidiaryID.value;
					var mSubsidiaryDesc = document.frmCOA.txtSubsidiaryDesc.value;
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

								var param= "Start=2&hidAccountID="+mAccountID+"&hidSubsidiaryID="+mSubsidiaryID+"&txtSubsidiaryDesc="+mSubsidiaryDesc;
								ajaxRequest.open("POST","subsidiaryaccount_edit.php",true);
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


//////////////////////////////////////////purhases book////////////////////////////////////////////////////
	function ePurchasesBook_SearchVoyageReference()
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
								}
						}
					var param="Start=9&VoyageReference="+mVoyageReference;	
					ajaxRequest.open("POST", "purchases_ajax.php", true);					
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param); 
				}	

		}
	function ePurchasesBook_SetSearchVoyageReference(value) 
		{
			document.getElementById('txtReferenceNo').value = value;
			document.getElementById('voyagereference').innerHTML = '';
		}	

	function ePurchasesBook_Action(mAction)
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
			else if (mAction == 2 || mAction == 4)
				{
					
					var mControlNo = document.frmFinancial.hidControlNo.value;
					var mControlNo_ = document.frmFinancial.hidControlNo_.value;
					var mDate1 = document.frmFinancial.Date1.value;
					var mAmount = document.frmFinancial.txtTotalDebit.value;
					mAmount =parseFloat(eval('document.frmFinancial.txtTotalDebit.value;').replace(/,/g,''));
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';
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
							if (mAction==4) { mStatus=1; }

	
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

							var param= "Start=2&ControlNo="+mControlNo+"&ControlNo_="+mControlNo_+"&Date1="+mDate1+"&ReferenceNo="+escape(mReferenceNo)+"&Amount="+mAmount+"&Particular="+escape(mParticular)+"&Rec="+mRec+"&Data="+mData+"&Status="+mStatus;
							ajaxRequest.open("POST","purchases_edit.php",true);
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

					var param= "Start=1&ControlNo=&mReferenceNo=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status=";
					ajaxRequest.open("POST","purchases_search.php",true);
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param);		
				}
		}
	function ePurchasesBook_EnterKey(i,event)
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
	function ePurchasesBook_EnterAccountID(event)
		{
			if (event.keyCode == 13)
				{
					SearchAccount();
					return false;
				}
			return true;
		}
	function ePurchasesBook_EnterAccountID_(event)
		{
			if (event.keyCode == 13)
				{
					AccountFocus();
					return false;
				}
			return true;
		}
	function ePurchasesBook_EnterSubsidiaryID(event)
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
	function ePurchasesBook_EnterSave(event)
		{
			
			if (event.keyCode == 13)
				{
					
					DebitAmt = document.frmFinancial.txtDebit.value;
					CreditAmt = document.frmFinancial.txtCredit.value;
					
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
					
					ePurchasesBook_SaveAccount();
					return false;
				}
			return true;
		}
	function ePurchasesBook_SearchAccount()
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
											ePurchasesBook_SearchSubsidiary();
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
	function ePurchasesBook_SearchAccount_()
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
									//alert(str);
									if (parseFloat(str[1]) > 0)
										{
											ePurchasesBook_SearchSubsidiary_();
											
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
	function ePurchasesBook_SearchSubsidiary()
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
	function ePurchasesBook_AccountFocus()
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

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        	ajaxRequest.send(param);
		}
	function ePurchasesBook_SearchSubsidiary_()
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
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        	ajaxRequest.send(param);
		}
	function ePurchasesBook_chkAll()
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
	function ePurchasesBook_DeleteAccount()
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
							if (mTotRec > 0) { ePurchasesBook_ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mTotRec;
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function ePurchasesBook_SaveAccount() 
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
									ePurchasesBook_ComputeTotal(1);
								}
						}

					var param= "Start=6&Data=" + mData + "&Rec=" +mRec;
					ajaxRequest.open("POST","purchases_ajax.php",true);
       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       				ajaxRequest.send(param);		
				}
		}
	function ePurchasesBook_LoadAccount()
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
							if (mRec > 0) { ePurchasesBook_ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
			ajaxRequest.open("POST","purchases_ajax.php",true);
       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       		ajaxRequest.send(param); 		
		}
	function ePurchasesBook_UpdateSession(m_Rec)
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

	function ePurchasesBook_ComputeTotal(RowLocation)
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
				
			eval('document.frmFinancial.txtTotalDebit.value=\''+mTotalDebit+'\';');
			eval('document.frmFinancial.txtTotalCredit.value=\''+mTotalCredit+'\';');

			document.frmFinancial.hidRec.value = mRec;
			document.frmFinancial.hidData.value = mData;
			ePurchasesBook_UpdateSession(mRec);
		}
	

////////////////////////////////////////////cash sales/////////////////////////////////////////
	function eCashSales_SearchVoyageReference()
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
								}
						}
					var param="Start=9&VoyageReference="+mVoyageReference;	
					ajaxRequest.open("POST", "cashsales_ajax.php", true);					
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param); 
				}	

		}
	function eCashSales_SetSearchVoyageReference(value) 
		{
			document.getElementById('txtReferenceNo').value = value;
			document.getElementById('voyagereference').innerHTML = '';
		}	

	function eCashSales_Action(mAction)
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
									ePurchasesBook_LoadAccount();		
								}
							}

							var param= "Start=1";
							ajaxRequest.open("POST","cashsales_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param)
				}
			else if (mAction == 2 || mAction == 4)
				{
					var mControlNo = document.frmFinancial.hidControlNo.value;
					var mControlNo_ = document.frmFinancial.hidControlNo_.value;
					var mDate1 = document.frmFinancial.Date1.value;
					var mAmount = document.frmFinancial.txtTotalDebit.value;
					mAmount =parseFloat(eval('document.frmFinancial.txtTotalDebit.value;').replace(/,/g,''));
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';
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
							if (mAction==4) { mStatus=1; }

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

							var param= "Start=2&ControlNo="+mControlNo+"&ControlNo_="+mControlNo_+"&Date1="+mDate1+"&ReferenceNo="+escape(mReferenceNo)+"&Amount="+mAmount+"&Particular="+escape(mParticular)+"&Rec="+mRec+"&Data="+mData+"&Status="+mStatus;
							ajaxRequest.open("POST","cashsales_edit.php",true);
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

							var param= "Start=1&ControlNo=&mReferenceNo=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status=";
							ajaxRequest.open("POST","cashsales_search.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);
												
				}
		}
	function eCashSales_EnterKey(i,event)
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
	function eCashSales_EnterAccountID(event)
		{
			if (event.keyCode == 13)
				{
					eCashSales_SearchAccount();
					return false;
				}
			return true;
		}
	function eCashSales_EnterAccountID_(event)
		{
			if (event.keyCode == 13)
				{
					eCashSales_AccountFocus();
					return false;
				}
			return true;
		}
	function eCashSales_EnterSubsidiaryID(event)
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
	function eCashSales_EnterSave(event)
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
					eCashSales_SaveAccount();
					return false;
				}
			return true;
		}
	function eCashSales_SearchAccount()
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
											eCashSales_SearchSubsidiary();
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
	function eCashSales_SearchAccount_()
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
											eCashSales_SearchSubsidiary_();
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
	function eCashSales_SearchSubsidiary()
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
	function eCashSales_AccountFocus()
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
	function eCashSales_SearchSubsidiary_()
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
	function eCashSales_chkAll()
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
	function eCashSales_DeleteAccount()
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
										  + parseFloat(eval('document.frmFinancial.mhidCredit'+i+'.value;').replace(/,/g,'')) + '*';	
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
							if (mTotRec > 0) { eCashSales_ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mTotRec;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function eCashSales_SaveAccount() 
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
									eCashSales_ComputeTotal(1);
								}
						}

					var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
					ajaxRequest.open("POST","cashsales_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);	
				}
		}
	function eCashSales_LoadAccount()
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
							if (mRec > 0) { eCashSales_ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function eCashSales_UpdateSession(m_Rec)
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

	function eCashSales_ComputeTotal(RowLocation)
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
			eCashSales_UpdateSession(mRec);
		}
	function eCashSales_ComputeTotal_(RowLocation)
		{
				var mDb = parseFloat(eval('document.frmFinancial.hidDebit'+RowLocation+'.value;').replace(/,/g,''));
				var mCr = parseFloat(eval('document.frmFinancial.hidCredit'+RowLocation+'.value;').replace(/,/g,''));
				eval('document.frmFinancial.mhidDebit'+RowLocation+'.value=\''+mDb+'\';');
				eval('document.frmFinancial.mhidCredit'+RowLocation+'.value=\''+mCr+'\';');
				
				eCashSales_ComputeTotal(1);
		}
	
	
	////////////////////////////////////////general journal///////////////////////////////////////////////////////
	
	function ePurchasesBook_SearchVoyageReference()
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
								}
						}
					var param="Start=9&VoyageReference="+mVoyageReference;	
					ajaxRequest.open("POST", "generaljournal_ajax.php", true);					
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param); 
				}	

		}
	function ePurchasesBook_SetSearchVoyageReference(value) 
		{
			document.getElementById('txtReferenceNo').value = value;
			document.getElementById('voyagereference').innerHTML = '';
		}	

	function eGeneralJournal_Action(mAction)
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
							ajaxRequest.open("POST","generaljournal_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);					
				}
			else if (mAction == 2 || mAction == 4)
				{
					var mControlNo = document.frmFinancial.hidControlNo.value;
					var mControlNo_ = document.frmFinancial.hidControlNo_.value;
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
							if (mAction==4) { mStatus=1; }

							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									eGeneralJournal_LoadAccount();		
								}
							}

							var param= "Start=2&ControlNo="+mControlNo+"&ControlNo_="+mControlNo_+"&Date1="+mDate1+"&ReferenceNo="+mReferenceNo+"&Amount="+mAmount+"&Particular="+escape(mParticular)+"&Rec="+mRec+"&Data="+mData+"&Status="+mStatus;
							ajaxRequest.open("POST","generaljournal_edit.php",true);
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

							var param= "Start=1&ControlNo=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status";
							ajaxRequest.open("POST","generaljournal_search.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);				
				}
		}
	function eGeneralJournal_EnterKey(i,event)
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
	function eGeneralJournal_EnterAccountID(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					eGeneralJournal_SearchAccount();
					return false;
				}
			return true;
		}
	function eGeneralJournal_EnterAccountID_(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					eGeneralJournal_AccountFocus();
					return false;
				}
			return true;
		}
	function eGeneralJournal_EnterSubsidiaryID(event)
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
	function eGeneralJournal_EnterSave(event)
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
					eGeneralJournal_SaveAccount();
					return false;
				}
			return true;
		}
	function eGeneralJournal_SearchAccount()
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
											eGeneralJournal_SearchSubsidiary();
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
	function eGeneralJournal_SearchAccount_()
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
											eGeneralJournal_SearchSubsidiary_();
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
	function eGeneralJournal_SearchSubsidiary()
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
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function eGeneralJournal_AccountFocus()
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
	function eGeneralJournal_SearchSubsidiary_()
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
	function eGeneralJournal_chkAll()
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
	function eGeneralJournal_DeleteAccount()
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
	function eGeneralJournal_SaveAccount() 
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
									eGeneralJournal_ComputeTotal(1);
								}
						}

					var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
					ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);		
				}
		}
	function eGeneralJournal_LoadAccount()
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
							if (mRec > 0) { eGeneralJournal_ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function eGeneralJournal_UpdateSession(m_Rec)
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

	function eGeneralJournal_ComputeTotal(RowLocation)
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
				
			eval('document.frmFinancial.txtTotalDebit.value=\''+mTotalDebit+'\';');
			eval('document.frmFinancial.txtTotalCredit.value=\''+mTotalCredit+'\';');

			document.frmFinancial.hidRec.value = mRec;
			document.frmFinancial.hidData.value = mData;
			eGeneralJournal_UpdateSession(mRec);
		}

		
		///////////////////////////////////////////////////////CHECK DISBURSEMENT///////////////////////////////////////////////////
	function eCheckDisbursement_SearchVoyageReference()
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
function eCheckDisbursement_SetSearchVoyageReference(value) 
		{
			document.getElementById('txtReferenceNo').value = value;
			document.getElementById('voyagereference').innerHTML = '';
		}

function eCheckDisbursement_SearchPaymasterID()
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
	function eCheckDisbursement_SetSearchPaymasterID(value) 
		{
			document.getElementById('txtPaymasterID').value = value;
			document.getElementById('PaymasterID').innerHTML = '';
		}			

	
	function eCheckDisbursement_Action(mAction)
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
									//ePurchasesBook_LoadAccount();		
								}
							}

							var param= "Start=1";
							ajaxRequest.open("POST","checkdisbursement_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param)					
				}
			else if (mAction == 2 || mAction == 5)
				{
					var mControlNo = document.frmFinancial.txtControlNo.value;
					var mControlNo_ = document.frmFinancial.hidControlNo.value;
					var mDate1 = document.frmFinancial.Date1.value;
					var mReferenceNo = document.frmFinancial.txtReferenceNo.value;
					var mPaymasterID = document.frmFinancial.txtPaymasterID.value;
					var mBankID = document.frmFinancial.cboBankID.options[document.frmFinancial.cboBankID.selectedIndex].value;
					var mCheckNo = document.frmFinancial.txtCheckNo.value;
					var mDate2 = document.frmFinancial.Date2.value;
					var mAmount = document.frmFinancial.txtAmount.value; //document.frmFinancial.txtTotalDebit.value;
					mAmount =parseFloat(eval('document.frmFinancial.txtAmount.value;').replace(/,/g,''));
					var mTotalCredit = document.frmFinancial.txtTotalCredit.value;			
					var mTotalDebit = document.frmFinancial.txtTotalDebit.value;			
					var mParticular = document.frmFinancial.txtParticular.value;
					var mData = '';//document.frmFinancial.hidData.value;
					var mRec = document.frmFinancial.hidRec.value;
					var mOk = '0';
					var mOk_ = '0';
					var mStatus ='0';
					

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
							if (mAction==5) { mStatus=1; }
							
							var ajaxRequest = getAjaxRequest();
							ajaxRequest.onreadystatechange = function()
							{
								if(ajaxRequest.readyState == 4)
								{

									var ajaxDisplay = document.getElementById('contents');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									eCheckDisbursement_LoadAccount();		
								}
							}
							var param= "Start=2&ControlNo="+mControlNo+"&ControlNo_="+mControlNo_+"&Date1="+mDate1+"&ReferenceNo="+mReferenceNo+"&PaymasterID="+mPaymasterID+"&BankID="+mBankID+"&CheckNo="+escape(mCheckNo)+"&Date2="+mDate2+"&Amount="+mAmount+"&Particular="+escape(mParticular)+"&Rec="+mRec+"&Data="+mData+"&Status="+mStatus;
							ajaxRequest.open("POST","checkdisbursement_edit.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param)							
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
									//ePurchasesBook_LoadAccount();		
								}
							}

							var param= "Start=1&ControlNo=&ControlDate=&ReferenceNo=&PaymasterID=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status=";
							ajaxRequest.open("POST","checkdisbursement_search.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param)					
				}
		}
	function eCheckDisbursement_EnterKey(i,event)
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
							document.frmFinancial.cboPaymasterID.select(); 
						}
					if (i==5) 
						{ 
							document.frmFinancial.cboBankID.focus(); 
							document.frmFinancial.cboBankID.select(); 
						}
					if (i==6) 
						{ 
							document.frmFinancial.txtCheckNo.focus(); 
							document.frmFinancial.txtCheckNo.select(); 
						}
					if (i==7) 
						{ 
							document.frmFinancial.cboMonth2.focus(); 
							document.frmFinancial.cboMonth2.select(); 						
						}
					if (i==8) 
						{ 
							document.frmFinancial.cboDay2.focus(); 
							document.frmFinancial.cboDay2.select(); 
						}
					if (i==9) 
						{ 
							document.frmFinancial.cboYear2.focus(); 
							document.frmFinancial.cboYear2.select(); 
						}
					if (i==10) 
						{ 
							document.frmFinancial.txtAmount.focus(); 
							document.frmFinancial.txtAmount.select(); 
						}
					if (i==11) 
						{ 
							document.frmFinancial.txtParticular.focus(); 
						}
					return false;
				}
			return true;
		}
	function eCheckDisbursement_EnterAccountID(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					eCheckDisbursement_SearchAccount();
					return false;
				}
			return true;
		}
	function eCheckDisbursement_EnterAccountID_(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					AccountFocus();
					return false;
				}
			return true;
		}
	function eCheckDisbursement_EnterSubsidiaryID(event)
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
	function eCheckDisbursement_EnterSave(event)
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
					eCheckDisbursement_SaveAccount();
					return false;
				}
			return true;
		}
	function eCheckDisbursement_SearchAccount()
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
											eCheckDisbursement_SearchSubsidiary();
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
	function eCheckDisbursement_SearchAccount_()
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
											eCheckDisbursement_SearchSubsidiary_();
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
	function eCheckDisbursement_SearchSubsidiary()
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
	function eCheckDisbursement_AccountFocus()
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

			var param= "Start=3&AccountID=" + mAccountID;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param); 
		}
	function eCheckDisbursement_SearchSubsidiary_()
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
	function eCheckDisbursement_chkAll()
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
	function eCheckDisbursement_DeleteAccount()
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
							if (mTotRec > 0) { eCheckDisbursement_ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mTotRec;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);	
		}
	function eCheckDisbursement_SaveAccount() 
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
									eCheckDisbursement_ComputeTotal(1);
								}
						}

					var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
					ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);		
				}
		}
	function eCheckDisbursement_LoadAccount()
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
							if (mRec > 0) { eCheckDisbursement_ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function eCheckDisbursement_UpdateSession(m_Rec)
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


	function eCheckDisbursement_ComputeTotal(RowLocation)
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
				
			eval('document.frmFinancial.txtTotalDebit.value=\''+mTotalDebit+'\';');
			eval('document.frmFinancial.txtTotalCredit.value=\''+mTotalCredit+'\';');

			document.frmFinancial.hidRec.value = mRec;
			document.frmFinancial.hidData.value = mData;
			eCheckDisbursement_UpdateSession(mRec);
		}
	function eCheckDisbursement_Module()
		{	
			var mModule = document.frmFinancial.cboModule.options[document.frmFinancial.cboModule.selectedIndex].value;
			
			if (mModule == '')
				{
				}
			else
				{
					window.close;
					window.open(mModule,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
				}
		}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	////////////////////////////////////////////cash receipts/////////////////////////////////////////
	function eCashReceipts_SearchVoyageReference()
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
	function eCashReceipts_SetSearchVoyageReference(value) 
		{
			document.getElementById('txtReferenceNo').value = value;
			document.getElementById('voyagereference').innerHTML = '';
		}	

	function eCashReceipts_Action(mAction)
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
									ePurchasesBook_LoadAccount();		
								}
							}

							var param= "Start=1";
							ajaxRequest.open("POST","cashreceipts_add.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param)
				}
			else if (mAction == 2 || mAction == 4)
				{
					var mControlNo = document.frmFinancial.hidControlNo.value;
					var mControlNo_ = document.frmFinancial.hidControlNo_.value;
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
							if (mAction==4) { mStatus=1; }

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

							var param= "Start=2&ControlNo="+mControlNo+"&ControlNo_="+mControlNo_+"&Date1="+mDate1+"&ReferenceNo="+escape(mReferenceNo)+"&Amount="+mAmount+"&Particular="+escape(mParticular)+"&Rec="+mRec+"&Data="+mData+"&Status="+mStatus;
							ajaxRequest.open("POST","cashreceipts_edit.php",true);
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

							var param= "Start=1&ControlNo=&mReferenceNo=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status=";
							ajaxRequest.open("POST","cashreceipts_search.php",true);
							ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							ajaxRequest.send(param);
												
				}
		}
	function eCashReceipts_EnterKey(i,event)
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
	function eCashReceipts_EnterAccountID(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					eCashReceipts_SearchAccount();
					return false;
				}
			return true;
		}
	function eCashReceipts_EnterAccountID_(event)
		{
			if (event.keyCode == 13)
				{
					//document.getElementById('LookItem').click();
					eCashReceipts_AccountFocus();
					return false;
				}
			return true;
		}
	function eCashReceipts_EnterSubsidiaryID(event)
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
	function eCashReceipts_EnterSave(event)
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
					//alert("insert recordsss"+event.keyCode);
					eCashReceipts_SaveAccount();
					return false;
				}
			return true;
		}
	function eCashReceipts_SearchAccount()
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
											eCashReceipts_SearchSubsidiary();
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
	function eCashReceipts_SearchAccount_()
		{
			var ajaxRequest = getAjaxRequest();

			var mAccountID = document.frmFinancial.cboAccountID.value;
			var mEmpty = '';
			//alert("searchaccount_"+mAccountID);
			var mSubsidiary = document.frmFinancial.cboSubsidiaryID;
			mSubsidiary.options.length = 0;
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var str = ajaxRequest.responseText.split("!");
							//alert(str);
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
											eCashReceipts_SearchSubsidiary_();
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
	function eCashReceipts_SearchSubsidiary()
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
	function eCashReceipts_AccountFocus()
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
	function eCashReceipts_SearchSubsidiary_()
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
	function eCashReceipts_chkAll()
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
	function eCashReceipts_DeleteAccount()
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
										  + parseFloat(eval('document.frmFinancial.mhidCredit'+i+'.value;').replace(/,/g,'')) + '*';	
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
							if (mTotRec > 0) { eCashReceipts_ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mTotRec;
			ajaxRequest.open("POST","cashReceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function eCashReceipts_SaveAccount() 
		{
			var ajaxRequest = getAjaxRequest();
			var mEmpty ='';
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mRec = document.frmFinancial.hidRec.value;
			var mData =  document.frmFinancial.hidData.value;
			//alert("saveaccount"+mAccountID);		
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

					//alert(mData);
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
									eCashReceipts_ComputeTotal(1);
								}
						}

					var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
					ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);	
				}
		}
	function eCashReceipts_LoadAccount()
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
							if (mRec > 0) { eCashReceipts_ComputeTotal(1); }
						}
				}
	
			var param= "Start=6&Data=" + mData + "&Rec=" + mRec;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);		
		}
	function eCashReceipts_UpdateSession(m_Rec)
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

	function eCashReceipts_ComputeTotal(RowLocation)
		{

			var mRec = 0;
			var mData = '';
			var i = 0;
			var mDebit = 0;
			var mCredit = 0;
			var mTotalDebit = 0;
			var mTotalCredit = 0;
			//alert("2nd computer total"+RowLocation);
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
			//alert(mData);	
			eval('document.frmFinancial.txtTotalDebit.value=\''+mTotalDebit+'\';');
			eval('document.frmFinancial.txtTotalCredit.value=\''+mTotalCredit+'\';');

			document.frmFinancial.hidRec.value = mRec;
			document.frmFinancial.hidData.value = mData;
			eCashReceipts_UpdateSession(mRec);
		}
	function eCashReceipts_ComputeTotal_(RowLocation)
		{
				var mDb = parseFloat(eval('document.frmFinancial.hidDebit'+RowLocation+'.value;').replace(/,/g,''));
				var mCr = parseFloat(eval('document.frmFinancial.hidCredit'+RowLocation+'.value;').replace(/,/g,''));
				eval('document.frmFinancial.mhidDebit'+RowLocation+'.value=\''+mDb+'\';');
				eval('document.frmFinancial.mhidCredit'+RowLocation+'.value=\''+mCr+'\';');
				
				eCashReceipts_ComputeTotal(1);
		}

	