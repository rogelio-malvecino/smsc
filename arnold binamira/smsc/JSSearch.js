///////////////////////MASTER ACCOUNTS/////////////////////////////////////////////

	function ControlAccount_Search()
		{
			var mAccountID = document.frmFinancial.txtAccountID.value;
			var mAccountDesc = document.frmFinancial.txtAccountDesc.value;
			var mGroupID = document.frmFinancial.cboGroupID.options[document.frmFinancial.cboGroupID.selectedIndex].value;
			
			var ajaxRequest = getAjaxRequest();
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			ajaxRequest.open("GET", "controlaccount_ajax.php?Start=2&AccountID="+mAccountID+
														 		   "&AccountDesc="+mAccountDesc+
														 	       "&GroupID="+mGroupID
							,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes', true);
			
			ajaxRequest.send(null); 
		}
	function ControlAccount_chkAll()
		{
			var mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.hidTotRec'+i+'.value;')=='0')
						{
							if (eval('document.frmFinancial.chkControl.checked;'))
								{
									document.getElementById("chkSelect"+i).checked=true;
								}
							else
								{
									document.getElementById("chkSelect"+i).checked=false;
								}
						}	
				}
		}
	function ControlAccount_Delete()
		{	
			if (confirm('Select [OK] to Delete Selected Record! Otherwise Select [CANCEL].'))
				{
					var mDesc = 'Deleted Record(s)\n\n';
					var j = 0;
					var mData = '';
					var mRec = document.frmFinancial.hidRec.value;

					for (i = 1; i <= mRec; i++) 
						{
							if (eval('document.frmFinancial.chkSelect'+i+'.checked;'))
								{
									mData = mData + eval('document.frmFinancial.hidID'+i+'.value;') + '!'
												  + eval('document.frmFinancial.hidName'+i+'.value;') + '!*';		
									mDesc = mDesc + 'Account: ' 
												  + eval('document.frmFinancial.hidID'+i+'.value;') 
												  + ' - '
												  + 'Name: ' 
												  + eval('document.frmFinancial.hidName'+i+'.value;')
												  + '\n';
									j = j + 1;
								}
						}
						
					var ajaxRequest = getAjaxRequest();
			
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									//alert(mDesc);
								}
						}
					
					var mAccountID = document.frmFinancial.txtAccountID.value;
					var mAccountDesc = document.frmFinancial.txtAccountDesc.value;
					var mGroupID = document.frmFinancial.cboGroupID.options[document.frmFinancial.cboGroupID.selectedIndex].value;
					
					ajaxRequest.open("GET", "controlaccount_ajax.php?Start=1&AccountID="+mAccountID+
														 		     	   "&AccountDesc="+mAccountDesc+
														 	         	   "&GroupID="+mGroupID+
																	 	   "&Data="+mData+
																	 	   "&Rec=" + j, true);
					ajaxRequest.send(null); 
				}
		}
	function ControlAccount_SearchControlName()
		{
			var mAccountDesc = document.frmFinancial.txtAccountDesc.value;

			if (mAccountDesc!='')
				{
					var ajaxRequest = getAjaxRequest();
					
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('controlname');
									ajaxDisplay.innerHTML = ajaxRequest.responseText.split("\n");;
								}
						}
					
					
					var mAccountID = document.frmFinancial.txtAccountID.value;
					var mGroupID = document.frmFinancial.cboGroupID.options[document.frmFinancial.cboGroupID.selectedIndex].value;
					
					ajaxRequest.open("GET", "controlaccount_ajax.php?Start=4&AccountID="+mAccountID+
														 		     	   "&AccountDesc="+mAccountDesc+
														 	         	   "&GroupID="+mGroupID, true);
					ajaxRequest.send(null); 
				}
		}
	function ControlAccount_SetSearchControlName(value) 
		{
			document.getElementById('txtAccountDesc').value = value;
			document.getElementById('controlname').innerHTML = '';
		}
	function ControlAccount_PrintSummary(mUserID, mAccountID, mAccountDesc, mGroupID)
		{	
			//alert("printing charts of account");
			window.open('controlaccountsummary_print.php?UserID='+mUserID+'&AccountID='+mAccountID+
																   	      '&AccountDesc='+mAccountDesc+
																   	      '&GroupID='+mGroupID
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function ControlAccount_Action(mAction)
		{
		try{
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
					//alert("opening pages");
					var param= "Start=1";
					ajaxRequest.open("POST","controlaccount_add.php",true);
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param);
			
				}
			else if(mAction == 2)
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
		catch(e)
			{
			alert(e.message);
			}
		}	
		
	function ControlAccount_CallAjaxPage(myPage,myStart,myID)
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

			var param= "Start="+myStart+"&ID="+myID;
			ajaxRequest.open("POST",myPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
		}
			
///////////////////////////////////SUB ACCOUNTS//////////////////////////////////////////
	function SubsidiaryAccount_Search()
		{
			var mAccountID = document.frmFinancial.cboAccountID.options[document.frmFinancial.cboAccountID.selectedIndex].value;
			var mSubsidiaryID = document.frmFinancial.txtSubsidiaryID.value;
			var mSubsidiaryDesc = document.frmFinancial.txtSubsidiaryDesc.value;
			
			var ajaxRequest = getAjaxRequest();
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			ajaxRequest.open("GET", "subsidiaryaccount_ajax.php?Start=2&AccountID="+mAccountID+
														 		      "&SubsidiaryID="+mSubsidiaryID+
														 	          "&SubsidiaryDesc="+mSubsidiaryDesc
							,'_self', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes', true);
			
			ajaxRequest.send(null); 
		}
	function SubsidiaryAccount_chkAll()
		{
			var mRec = document.frmFinancial.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmFinancial.hidTotRec'+i+'.value;')=='0')
						{
							if (eval('document.frmFinancial.chkControl.checked;'))
								{
									document.getElementById("chkSelect"+i).checked=true;
								}
							else
								{
									document.getElementById("chkSelect"+i).checked=false;
								}
						}
				}
		}
	function SubsidiaryAccount_Delete()
		{	
			if (confirm('Select [OK] to Delete Selected Record! Otherwise Select [CANCEL].'))
				{
					var mDesc = 'Deleted Record(s)\n\n';
					var j = 0;
					var mData = '';
					var mRec = document.frmFinancial.hidRec.value;

					for (i = 1; i <= mRec; i++) 
						{
							if (eval('document.frmFinancial.chkSelect'+i+'.checked;'))
								{
									mData = mData + eval('document.frmFinancial.hidID'+i+'.value;') + '!'
												  + eval('document.frmFinancial.hidName'+i+'.value;') + '!*';		
									mDesc = mDesc + 'Subsidiary ID: ' 
												  + eval('document.frmFinancial.hidID'+i+'.value;') 
												  + ' - '
												  + 'Name: ' 
												  + eval('document.frmFinancial.hidName'+i+'.value;')
												  + '\n';
									j = j + 1;
								}
						}
						
					var ajaxRequest = getAjaxRequest();
			
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									//alert(mDesc);
								}
						}
					
					var mAccountID = document.frmFinancial.cboAccountID.options[document.frmFinancial.cboAccountID.selectedIndex].value;
					var mSubsidiaryID = document.frmFinancial.txtSubsidiaryID.value;
					var mSubsidiaryDesc = document.frmFinancial.txtSubsidiaryDesc.value;
					
					ajaxRequest.open("GET", "subsidiaryaccount_ajax.php?Start=1&AccountID="+mAccountID+
														 		     	      "&SubsidiaryID="+mSubsidiaryID+
														 	         	      "&SubsidiaryDesc="+mSubsidiaryDesc+
																	 	      "&Data="+mData+
																	 	      "&Rec=" + j, true);
					ajaxRequest.send(null); 
				}
		}
	function SubsidiaryAccount_SearchSubsidiaryName()
		{
			var mSubsidiaryDesc = document.frmFinancial.txtSubsidiaryDesc.value;

			if (mSubsidiaryDesc!='')
				{
					var ajaxRequest = getAjaxRequest();
					
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('subsidiaryname');
									ajaxDisplay.innerHTML = ajaxRequest.responseText.split("\n");;
								}
						}
					
					
					var mAccountID = document.frmFinancial.cboAccountID.options[document.frmFinancial.cboAccountID.selectedIndex].value;
					var mSubsidiaryID = document.frmFinancial.txtSubsidiaryID.value;

					ajaxRequest.open("GET", "subsidiaryaccount_ajax.php?Start=4&AccountID="+mAccountID+
														 		     	      "&SubsidiaryID="+mSubsidiaryID+
														 	         	      "&SubsidiaryDesc="+mSubsidiaryDesc, true);
					ajaxRequest.send(null); 
				}
		}
	function SubsidiaryAccount_SetSearchSubsidiaryName(value) 
		{
			document.getElementById('txtSubidiaryDesc').value = value;
			document.getElementById('subsidiaryname').innerHTML = '';
		}
	function SubsidiaryAccount_PrintSummary(mUserID, mCenterID, mAccountID, mSubsidiaryID, mSubsidiaryDesc)
		{	
			window.open('subsidiaryaccountsummary_print.php?UserID='+mUserID+'&CenterID='+mCenterID+
																             '&AccountID='+mAccountID+
																   	         '&SubsidiaryID='+mSubsidiaryID+
																   	         '&SubsidiaryDesc='+mSubsidiaryDesc
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function SubsidiaryAccount_Action(mAction)
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

		function SubsidiaryAccount_CallAjaxPage(myPage,myStart,myID)
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

			var param= "Start="+myStart+"&ID="+myID;
			ajaxRequest.open("POST",myPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
		}
		
/////////////////////////////////////////trial balance////////////////////////////////////////////
	function TrialBalance_Search()
		{
			var ajaxRequest = getAjaxRequest();
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}
			
			var mAccountID = document.frmLedger.cboAccountID.options[document.frmLedger.cboAccountID.selectedIndex].value;
			var mDate1 = document.frmLedger.Date1.value;
			var mDate2 = document.frmLedger.Date2.value;
			var mMonth1 = mDate1.substr(5,2); 
			var mDay1 =  mDate1.substr(8,2);
			var mYear1 = mDate1.substr(0,4);
			var mMonth2 = mDate2.substr(5,2);
			var mDay2 = mDate2.substr(8,2);
			var mYear2 = mDate2.substr(0,4);
			var mJournal = document.frmLedger.cboJournal.value;
			var mSubsidiary = '';
			var mStatus = document.frmLedger.cboStatus.options[document.frmLedger.cboStatus.selectedIndex].value;
			
			if (mSubsidiary==true) { mSubsidiary = 1; } else { mSubsidiary = 0; }
						 
			ajaxRequest.open("GET", "trialbalance_ajax.php?Start=1&ControlNo="+mAccountID+
													       	     "&Journal="+mJournal+
													   			 "&Month1="+mMonth1+
													             "&Day1="+mDay1+
													             "&Year1="+mYear1+
													             "&Month2="+mMonth2+
													             "&Day2="+mDay2+
													             "&Year2="+mYear2+
													             "&Subsidiary="+mSubsidiary+
														     "&Status="+mStatus, true);
			ajaxRequest.send(null); 
		}
	function TrialBalance_Print(mUserID, mControlNo, mJournal, mMonth1, mDay1, mYear1, mMonth2, mDay2, mYear2, mSubsidiary, mStatus)
		{	
		
		var mStatus = document.frmLedger.cboStatus.options[document.frmLedger.cboStatus.selectedIndex].value;

		window.open('trialbalance_print.php?UserID='+mUserID+
											  '&ControlNo='+mControlNo+
											  '&Journal='+mJournal+
											  '&Month1='+mMonth1+
											  '&Day1='+mDay1+
											  '&Year1='+mYear1+
											  '&Month2='+mMonth2+
											  '&Day2='+mDay2+
											  '&Year2='+mYear2+
											  '&Subsidiary='+mSubsidiary+
											  '&Status='+mStatus					    
						,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}

function TrialBalance_CallAjaxPage(mPage,mStart,mControlAccount,mSubsidiaryID,mStatus,mJournal,mMonth1,mDay1,mYear1,mMonth2,mDay2,mYear2)
		{
			
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortTable();
							GeneralLedger_Search(mControlAccount);		
							
						}
				}

			var param= "Start="+mStart+"&ControlAccount="+mControlAccount+"&SubsidiaryID="+mSubsidiaryID+"&Status="+mStatus+"&Journal="+mJournal+"&Month1="+mMonth1+"&Day1="+mDay1+"&Year1="+mYear1+"&Month2="+mMonth2+"&Day2="+mDay2+"&Year2="+mYear2+"&SubsidiaryNo=";
			ajaxRequest.open("POST",mPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
		}
		


//////////////////////////////////general ledger//////////////////////////////////////////


	function GeneralLedger_Search(mAccountID)
		{
		
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}
			
			var mAccountID = document.frmLedger.cboAccountID.options[document.frmLedger.cboAccountID.selectedIndex].value;
			var mSubsidiaryID = document.frmLedger.cboSubsidiaryID.options[document.frmLedger.cboSubsidiaryID.selectedIndex].value;
			var mDate1 = document.frmLedger.Date1.value;
			var mDate2 = document.frmLedger.Date2.value;
			var mMonth1 = mDate1.substr(5,2); 
			var mDay1 =  mDate1.substr(8,2);
			var mYear1 = mDate1.substr(0,4);
			var mMonth2 = mDate2.substr(5,2);
			var mDay2 = mDate2.substr(8,2);
			var mYear2 = mDate2.substr(0,4);

			var mJournal = document.frmLedger.cboJournal.value;
			var mStatus = document.frmLedger.cboStatus.options[document.frmLedger.cboStatus.selectedIndex].value;

			ajaxRequest.open("GET", "generalledger_ajax.php?Start=2&ControlNo="+mAccountID+
													    	      "&SubsidiaryNo="+mSubsidiaryID+
															      "&Journal="+mJournal+
															      "&Month1="+mMonth1+
															      "&Day1="+mDay1+
																  "&Year1="+mYear1+
																  "&Month2="+mMonth2+
																  "&Day2="+mDay2+
																  "&Year2="+mYear2+
																"&Status="+mStatus, true);
			ajaxRequest.send(null); 
		}
	function GeneralLedger_LoadSubsidiary()
		{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var mAccountID = document.frmLedger.cboAccountID.options[document.frmLedger.cboAccountID.selectedIndex].value;
			var mDate1 = document.frmLedger.Date1.value;
			var mDate2 = document.frmLedger.Date2.value;
			var mMonth1 = mDate1.substr(5,2); 
			var mDay1 =  mDate1.substr(8,2);
			var mYear1 = mDate1.substr(0,4);
			var mMonth2 = mDate2.substr(5,2);
			var mDay2 = mDate2.substr(8,2);
			var mYear2 = mDate2.substr(0,4);
			var mJournal = document.frmLedger.cboJournal.value;
			var mStatus = document.frmLedger.cboStatus.options[document.frmLedger.cboStatus.selectedIndex].value;
			
			TrialBalance_CallAjaxPage('generalledger_search.php','1',mAccountID,mSubsidiaryID,mStatus,mJournal,mMonth1,mDay1,mYear1,mMonth2,mDay2,mYear2);                                                                   	

		}
	function GeneralLedger_Print(mUserID, mControlNo, mSubsidiaryNo, mJournal, mMonth1, mDay1, mYear1, mMonth2, mDay2, mYear2, mStartDate, mEndDate,mStatus)
		{
			var mStatus = document.frmLedger.cboStatus.options[document.frmLedger.cboStatus.selectedIndex].value;
			window.open('generalledger_print_.php?UserID='+mUserID+
											   '&ControlNo='+mControlNo+
											   '&SubsidiaryNo='+mSubsidiaryNo+
											   '&Journal='+mJournal+
											   '&Month1='+mMonth1+
											   '&Day1='+mDay1+
											   '&Year1='+mYear1+
											   '&Month2='+mMonth2+
											   '&Day2='+mDay2+
											   '&Year2='+mYear2+
											   '&StartDate='+mStartDate+
											   '&EndDate='+mEndDate+
											   '&Status='+mStatus				
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}


		
/////////////////////////////////////////purchase books//////////////////////////////////////////

	function PurchasesBook_Search()
		{
			var ajaxRequest = getAjaxRequest();
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortTable();
						}
				}
			
			var mControlNo = document.frmJournal.txtControlNo.value;
			var mReferenceNo = eval('document.frmJournal.txtReferenceNo.value;')			
			var mStartDate = eval('document.frmJournal.Date1.value;');
			var mEndDate = eval('document.frmJournal.Date2.value;');
			var mStatus = eval('document.frmJournal.cboStatus.value;'); 									   						 
			
			var param= "Start=2&ControlNo=" + mControlNo + "&ReferenceNo=" + mReferenceNo + "&StartDate=" + mStartDate + "&EndDate=" + mEndDate + "&Status=" + mStatus;
			ajaxRequest.open("POST","purchases_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function PurchasesBook_chkAll()
		{
			var mRec = document.frmJournal.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmJournal.hidStatus'+i+'.value;')=='0')
						{
							if (eval('document.frmJournal.chkControl.checked;'))
								{
									document.getElementById("chkSelect"+i).checked=true;
								}
							else
								{
									document.getElementById("chkSelect"+i).checked=false;
								}
						}
				}
		}
	function PurchasesBook_Delete()
		{	
			if (confirm('Select [OK] to Delete Selected Record! Otherwise Select [CANCEL].'))
				{
					var mDesc = 'Deleted Record(s)\n\n';
					var j = 0;
					var mData = '';
					var mRec = document.frmJournal.hidRec.value;

					for (i = 1; i <= mRec; i++) 
						{
							if (eval('document.frmJournal.chkSelect'+i+'.checked;'))
								{
									mData = mData + eval('document.frmJournal.hidID'+i+'.value;') + '!'
												  + eval('document.frmJournal.hidParticular'+i+'.value;') + '!*';		
									mDesc = mDesc + 'RR#: ' 
												  + eval('document.frmJournal.hidID'+i+'.value;') 
												  + ' - '
												  + 'Particular: ' 
												  + eval('document.frmJournal.hidParticular'+i+'.value;')
												  + '\n';
									j = j + 1;
								}
						}

					var ajaxRequest = getAjaxRequest();
			
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									sortTable();
									//alert(mDesc);
								}
						}
					
					var mControlNo = document.frmJournal.txtControlNo.value;
					var mReferenceNo = eval('document.frmJournal.txtReferenceNo.value;')			
					var mStartDate = eval('document.frmJournal.Date1.value;');
					var mEndDate = eval('document.frmJournal.Date2.value;');
					var mStatus = eval('document.frmJournal.cboStatus.value;'); 		

					var param= "Start=1&ControlNo=" + mControlNo + "&ReferenceNo=" + mReferenceNo + "&StartDate=" + mStartDate + "&EndDate=" + mEndDate + "&Status=" + mStatus + "&Data=" + mData + "&Rec=" + j;
					ajaxRequest.open("POST","purchases_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);
				}
		}
	function PurchasesBook_PrintVoucher(mControlNo, mAmount)
		{	
			window.open('purchasesvoucher_print.php?ControlNo='+mControlNo+
												  '&Amount='+mAmount+
												  '&AmountWords='+gf_ConvertWord(gf_RemoveComma(mAmount))
						,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function PurchasesBook_PrintSummary(mUserID, mCenterID, mControlNo, mReferenceNo, mStartDate, mEndDate, mStatus, mTitle)
		{
			window.open('purchasessummary_print.php?UserID='+mUserID+'&CenterID='+mCenterID+
												 '&ControlNo='+mControlNo+
												 '&ReferenceNo='+mReferenceNo+
												 '&StartDate='+mStartDate+
												 '&EndDate='+mEndDate+
												 '&Status='+mStatus+
												 '&Title='+mTitle
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function PurchasesBook_PrintDetail(mUserID, mCenterID, mControlNo, mReferenceNo, mStartDate, mEndDate, mStatus, mTitle)
		{						  
			window.open('purchasesdetail_print.php?UserID='+mUserID+'&CenterID='+mCenterID+
											     '&ControlNo='+mControlNo+
											     '&ReferenceNo='+mReferenceNo+
											     '&StartDate='+mStartDate+
											     '&EndDate='+mEndDate+
											     '&Status='+mStatus+
											     '&Title='+mTitle
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function PurchasesBook_Action(mAction)
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

					var param= "";
					ajaxRequest.open("POST","purchases_search.php",true);
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param);
					
				}
		}	
	function PurchasesBook_CallAjaxPage(myPage,myStart,myID)
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

			var param= "Start="+myStart+"&ID="+myID;
			ajaxRequest.open("POST",myPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
		}	
		
		
//////////////////////////////////////cash sales///////////////////////////////////////////////

	function CashSales_handleErr(msg,url,l)
		{
			return true;
		}
	function CashSales_Search()
		{
			var ajaxRequest = getAjaxRequest();
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortTable();
						}
				}
			
			var mControlNo = document.frmJournal.txtControlNo.value;
			var mReferenceNo = eval('document.frmJournal.txtReferenceNo.value;')			
			var mStartDate =eval('document.frmJournal.Date1.value;');
			var mEndDate =eval('document.frmJournal.Date2.value;');
			
			var mStatus = eval('document.frmJournal.cboStatus.value;'); 									   						 
			
			var param= "Start=2&ControlNo=" + mControlNo + "&ReferenceNo=" + mReferenceNo + "&StartDate=" + mStartDate + "&EndDate=" + mEndDate + "&Status=" + mStatus;
			ajaxRequest.open("POST","cashsales_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function CashSales_chkAll()
		{
			var mRec = document.frmJournal.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmJournal.hidStatus'+i+'.value;')=='0')
						{
							if (eval('document.frmJournal.chkControl.checked;'))
								{
									document.getElementById("chkSelect"+i).checked=true;
								}
							else
								{
									document.getElementById("chkSelect"+i).checked=false;
								}
						}
				}
		}
	function CashSales_Delete()
		{	
			if (confirm('Select [OK] to Delete Selected Record! Otherwise Select [CANCEL].'))
				{
					var mDesc = 'Deleted Record(s)\n\n';
					var j = 0;
					var mData = '';
					var mRec = document.frmJournal.hidRec.value;

					for (i = 1; i <= mRec; i++) 
						{
							if (eval('document.frmJournal.chkSelect'+i+'.checked;'))
								{
									mData = mData + eval('document.frmJournal.hidID'+i+'.value;') + '!'
												  + eval('document.frmJournal.hidParticular'+i+'.value;') + '!*';		
									mDesc = mDesc + 'CS#: ' 
												  + eval('document.frmJournal.hidID'+i+'.value;') 
												  + ' - '
												  + 'Particular: ' 
												  + eval('document.frmJournal.hidParticular'+i+'.value;')
												  + '\n';
									j = j + 1;
								}
						}
						
					var ajaxRequest = getAjaxRequest();
			
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
								}
						}
					
					var mControlNo = document.frmJournal.txtControlNo.value;
					var mReferenceNo = eval('document.frmJournal.txtReferenceNo.value;')			
					var mStartDate = eval('document.frmJournal.Date1.value;');
					var mEndDate = eval('document.frmJournal.Date2.value;');	
					
					var mStatus = eval('document.frmJournal.cboStatus.value;'); 		
					var param= "Start=1&ControlNo=" + mControlNo + "&ReferenceNo=" + mReferenceNo + "&StartDate=" + mStartDate + "&EndDate=" + mEndDate + "&Status=" + mStatus + "&Data=" + mData + "&Rec=" + j;
					ajaxRequest.open("POST","cashsales_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);
				}
		}
	function CashSales_PrintVoucher(mControlNo, mAmount)
		{	
			window.open('cashsalesvoucher_print.php?ControlNo='+mControlNo+
												  '&Amount='+mAmount+
												  '&AmountWords='+gf_ConvertWord(gf_RemoveComma(mAmount))
						,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function CashSales_PrintSummary(mUserID, mCenterID, mControlNo, mReferenceNo, mStartDate, mEndDate, mStatus, mTitle)
		{
			window.open('cashsalessummary_print.php?UserID='+mUserID+'&CenterID='+mCenterID+
												  '&ControlNo='+mControlNo+
												  '&ReferenceNo='+mReferenceNo+
												  '&StartDate='+mStartDate+
												  '&EndDate='+mEndDate+
												  '&Status='+mStatus+
												  '&Title='+mTitle
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function CashSales_PrintDetail(mUserID, mCenterID, mControlNo, mReferenceNo, mStartDate, mEndDate, mStatus, mTitle)
		{						  
			window.open('cashsalesdetail_print.php?UserID='+mUserID+'&CenterID='+mCenterID+
											     '&ControlNo='+mControlNo+
											     '&ReferenceNo='+mReferenceNo+
											     '&StartDate='+mStartDate+
											     '&EndDate='+mEndDate+
											     '&Status='+mStatus+
											     '&Title='+mTitle
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function CashSales_Action(mAction)
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
					ajaxRequest.open("POST","CashSales_add.php",true);
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param);	
				}
			else if (mAction == 2)
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

					var param= "ControlNo=&ReferenceNo=&PaymasterID=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status=";
					ajaxRequest.open("POST","cashsales_search.php",true);
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param);					
				}
		}	
	function CashSales_CallAjaxPage(myPage,myStart,myID)
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

			var param= "Start="+myStart+"&ID="+myID;
			ajaxRequest.open("POST",myPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
		}		
		
		
//////////////////////////////////////////////general journal//////////////////////////////////////////////


	function GeneralJournal_Search()
		{
			var ajaxRequest = getAjaxRequest();
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortTable();
							//alert(ajaxRequest.responseText);
						}
				}
			
			var mControlNo = document.frmJournal.txtControlNo.value;
			var mStartDate = eval('document.frmJournal.Date1.value;');
			var mEndDate = eval('document.frmJournal.Date2.value;');	
			
			var mStatus = eval('document.frmJournal.cboStatus.value;'); 									   						 
			var param= "Start=2&ControlNo=" + mControlNo + "&StartDate=" + mStartDate + "&EndDate=" + mEndDate + "&Status=" + mStatus;
			ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function GeneralJournal_chkAll()
		{
			var mRec = document.frmJournal.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmJournal.hidStatus'+i+'.value;')=='0')
						{
							if (eval('document.frmJournal.chkControl.checked;'))
								{
									document.getElementById("chkSelect"+i).checked=true;
								}
							else
								{
									document.getElementById("chkSelect"+i).checked=false;
								}
						}
				}
		}
	function GeneralJournal_Delete()
		{	
			if (confirm('Select [OK] to Delete Selected Record! Otherwise Select [CANCEL].'))
				{
					var mDesc = 'Deleted Record(s)\n\n';
					var j = 0;
					var mData = '';
					var mRec = document.frmJournal.hidRec.value;

					for (i = 1; i <= mRec; i++) 
						{
							if (eval('document.frmJournal.chkSelect'+i+'.checked;'))
								{
									mData = mData + eval('document.frmJournal.hidID'+i+'.value;') + '!'
												  + eval('document.frmJournal.hidParticular'+i+'.value;') + '!*';		
									mDesc = mDesc + 'Journal#: ' 
												  + eval('document.frmJournal.hidID'+i+'.value;') 
												  + ' - '
												  + 'Particular: ' 
												  + eval('document.frmJournal.hidParticular'+i+'.value;')
												  + '\n';
									j = j + 1;
								}
						}
						
					var ajaxRequest = getAjaxRequest();
			
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									alert(mDesc);
								}
						}
					
					var mControlNo = document.frmJournal.txtControlNo.value;
					var mStartDate = eval('document.frmJournal.Date1.value;');
					var mEndDate = eval('document.frmJournal.Date2.value;');
					var mStatus = eval('document.frmJournal.cboStatus.value;'); 		
					//alert(mStartDate);
					var param= "Start=1&ControlNo=" + mControlNo + "&StartDate=" + mStartDate + "&EndDate=" + mEndDate + "&Status=" + mStatus + "&Data=" + mData + "&Rec=" + j;
					ajaxRequest.open("POST","generaljournal_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);
						
				}
		}
	function GeneralJournal_PrintVoucher(mControlNo, mAmount,mDate)
		{	
			window.open('generaljournalvoucher_print.php?ControlNo='+mControlNo+
												    '&Amount='+mAmount+
													'&mDate='+mDate
						,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function GeneralJournal_PrintSummary()
		{
			var mControlNo = document.frmJournal.txtControlNo.value;
			
			var mStartDate = eval('document.frmJournal.cboYear1.value;') + '-' +
							 (parseFloat(eval('document.frmJournal.cboMonth1.value;'))-1) + '-' +
							 eval('document.frmJournal.cboDay1.value;');
								 
			var mEndDate = eval('document.frmJournal.cboYear2.value;') + '-' +
						   (parseFloat(eval('document.frmJournal.cboMonth2.value;'))-1) + '-' +
						   eval('document.frmJournal.cboDay2.value;');

			var mStatus = eval('document.frmJournal.cboStatus.value;'); 

			window.open('generaljournalsummary_print.php?ControlNo='+mControlNo+
																		'&StartDate='+mStartDate+
																		'&EndDate='+mEndDate+
																		'&Status='+mStatus
																		
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');

		}
	function GeneralJournal_PrintDetail(mUserID, mCenterID, mControlNo, mReferenceNo, mStartDate, mEndDate, mStatus, mTitle)
		{						  
			window.open('generaljournaldetail_print.php?UserID='+mUserID+'&CenterID='+mCenterID+
																	   '&ControlNo='+mControlNo+
																	   '&ReferenceNo='+mReferenceNo+
																	   '&StartDate='+mStartDate+
																	   '&EndDate='+mEndDate+
																	   '&Status='+mStatus+
																	   '&Title='+mTitle
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function GeneralJournal_Action(mAction)
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
			else if (mAction == 2)
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

					var param= "ControlNo=&ReferenceNo=&PaymasterID=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status=";
					ajaxRequest.open("POST","generaljournal_search.php",true);
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param);		
				}
		}	
	function GeneralJournal_CallAjaxPage(myPage,myStart,myID)
		{
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

			var param= "Start="+myStart+"&ID="+myID;
			ajaxRequest.open("POST",myPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
		}

/////////////////////////////////////////////////check disbursement/////////////////////////////////////////////////
	function CheckDisbursement_Search()
		{
			document.frmJournal.cmdSearch.disabled = true;
			
			var ajaxRequest = getAjaxRequest();
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortTable();
							document.frmJournal.cmdSearch.disabled = false;
						}
				}
			
			var mControlNo = document.frmJournal.txtControlNo.value;
			var mReferenceNo = eval('document.frmJournal.txtReferenceNo.value;')			
			var mPaymasterID = eval('document.frmJournal.cboPaymasterID.value;');
			var mStartDate = eval('document.frmJournal.Date1.value;');
			var mEndDate = eval('document.frmJournal.Date2.value;');	
			var mStatus = eval('document.frmJournal.cboStatus.value;'); 									   						 
			var param= "Start=2&ControlNo=" + mControlNo + "&ReferenceNo=" + mReferenceNo + "&PaymasterID=" + mPaymasterID + "&StartDate=" + mStartDate + "&EndDate=" + mEndDate + "&Status=" + mStatus;
			ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function CheckDisbursement_chkAll()
		{
			var mRec = document.frmJournal.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmJournal.hidStatus'+i+'.value;')=='2')
						{
						}
					else
						{
							if (eval('document.frmJournal.chkControl.checked;'))
								{
									document.getElementById("chkSelect"+i).checked=true;
								}
							else
								{
									document.getElementById("chkSelect"+i).checked=false;
								}
						}
				}
		}
	function CheckDisbursement_Delete()
		{	
			
			if (confirm('Select [OK] to Delete Selected Record! Otherwise Select [CANCEL].'))
				{
					var mDesc = 'Delete Record(s)\n\n';
					var j = 0;
					var mData = '';
					var mRec = document.frmJournal.hidRec.value;

					for (i = 1; i <= mRec; i++) 
						{
							if (eval('document.frmJournal.chkSelect'+i+'.checked;'))
								{
									mData = mData + eval('document.frmJournal.hidID'+i+'.value;') + '!*';
									mDesc = mDesc + '';
									j = j + 1;
								}
						}
						
					var ajaxRequest = getAjaxRequest();
			
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									alert(mDesc);
								}
						}
					
					var mControlNo = document.frmJournal.txtControlNo.value;
					var mReferenceNo = eval('document.frmJournal.txtReferenceNo.value;')			
					var mPaymasterID = eval('document.frmJournal.cboPaymasterID.value;');
		
					var mStartDate = eval('document.frmJournal.Date1.value;');
					var mEndDate = eval('document.frmJournal.Date2.value;');	

					var mStatus = eval('document.frmJournal.cboStatus.value;'); 		
					var param= "Start=1&ControlNo=" + mControlNo + "&ReferenceNo=" + mReferenceNo + "&PaymasterID=" + mPaymasterID + "&StartDate=" + mStartDate + "&EndDate=" + mEndDate + "&Status=" + mStatus + "&Data=" + mData + "&Rec=" + j;
					ajaxRequest.open("POST","checkdisbursement_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);
				}
		}
	function CheckDisbursement_Cleared()
		{	
			if (confirm('Select [OK] to Cleared Selected Record! Otherwise Select [CANCEL].'))
				{
					var mDesc = 'Cleared Record(s)\n\n';
					var j = 0;
					var mData = '';
					var mRec = document.frmJournal.hidRec.value;

					for (i = 1; i <= mRec; i++) 
						{
							if (eval('document.frmJournal.chkSelect_'+i+'.checked;'))
								{
									mData = mData + eval('document.frmJournal.hidID'+i+'.value;') + '!'
												  + eval('document.frmJournal.hidParticular'+i+'.value;') + '!*';
												  
									mDesc = mDesc + 'Voucher#: ' 
												  + eval('document.frmJournal.hidID'+i+'.value;') 
												  + ' - '
												  + 'Particular: ' 
												  + eval('document.frmJournal.hidParticular'+i+'.value;')
												  + '\n';
									j = j + 1;
								}
						}
						
					var ajaxRequest = getAjaxRequest();
			
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									alert(mDesc);
								}
						}
					
					var mControlNo = document.frmJournal.txtControlNo.value;
					var mReferenceNo = eval('document.frmJournal.txtReferenceNo.value;')			
					var mPaymasterID = eval('document.frmJournal.cboPaymasterID.value;');
		
					var mStartDate = eval('document.frmJournal.cboYear1.value;') + '-' +
									 (parseFloat(eval('document.frmJournal.cboMonth1.value;'))-1) + '-' +
									 eval('document.frmJournal.cboDay1.value;');
										 
					var mEndDate = eval('document.frmJournal.cboYear2.value;') + '-' +
								   (parseFloat(eval('document.frmJournal.cboMonth2.value;'))-1) + '-' +
								   eval('document.frmJournal.cboDay2.value;');
					
					var mStatus = eval('document.frmJournal.cboStatus.value;'); 		

					ajaxRequest.open("GET", "checkdisbursement_ajax.php?Start=7&ControlNo=" + mControlNo + 
																			  "&ReferenceNo=" + mReferenceNo + 
																			  "&PaymasterID=" + mPaymasterID +
																			  "&StartDate=" + mStartDate + 
																			  "&EndDate="+ mEndDate +
																			  "&Status="+ mStatus +  
																			  "&Data=" + mData + 
																			  "&Rec=" + j, true);
					ajaxRequest.send(null); 
				}
		}
	function CheckDisbursement_PrintVoucher(mControlNo, mAmount)
		{	
			//alert("print voucher");
			window.open('checkdisbursementvoucher_print.php?ControlNo='+mControlNo+
														  '&Amount='+mAmount
						,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function CheckDisbursement_PrintCheck(mControlNo, mAmount)
		{
			//alert(mControlNo);
			window.open('checkdisbursementcheck_print.php?ControlNo='+mControlNo+
														'&Amount='+mAmount
						,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function CheckDisbursement_PrintCheckDisbursementSummary()
		{
			var mControlNo = document.frmJournal.txtControlNo.value;
			var mReferenceNo = eval('document.frmJournal.txtReferenceNo.value;')			
			var mPaymasterID = eval('document.frmJournal.cboPaymasterID.value;');

			var mStartDate = eval('document.frmJournal.cboYear1.value;') + '-' +
							 (parseFloat(eval('document.frmJournal.cboMonth1.value;'))-1) + '-' +
							 eval('document.frmJournal.cboDay1.value;');
								 
			var mEndDate = eval('document.frmJournal.cboYear2.value;') + '-' +
						   (parseFloat(eval('document.frmJournal.cboMonth2.value;'))-1) + '-' +
						   eval('document.frmJournal.cboDay2.value;');

			var mStatus = eval('document.frmJournal.cboStatus.value;'); 
			window.open('checkdisbursementsummary_print.php?ControlNo='+mControlNo+'&ReferenceNo='+mReferenceNo+'&PaymasterID='+mPaymasterID+
														  '&StartDate='+mStartDate+'&EndDate='+mEndDate+
														  '&Status='+mStatus
						,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
									   						 
			
		}
	function CheckDisbursement_PrintCheckRegister(mUserID, mCenterID, mControlNo, mReferenceNo, mPaymasterID, mStartDate, mEndDate, mStatus, mTitle)
		{				
		}
	function CheckDisbursement_PrintCashDisbursement(mUserID, mCenterID, mControlNo, mReferenceNo, mPaymasterID, mStartDate, mEndDate, mStatus, mTitle)
		{						  
		}
	function CheckDisbursement_Action(mAction)
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
			else if (mAction == 5)
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
		
	function CheckDisbursement_CallAjaxPage(myPage,myStart,myID)
		{
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

			var param= "Start="+myStart+"&ID="+myID;
			ajaxRequest.open("POST",myPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
		}





//////////////////////////////////////cash receipts///////////////////////////////////////////////

	function CashReceipts_handleErr(msg,url,l)
		{
			return true;
		}
	function CashReceipts_Search()
		{
			var ajaxRequest = getAjaxRequest();
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortTable();
						}
				}
			
			var mControlNo = document.frmJournal.txtControlNo.value;
			var mReferenceNo = eval('document.frmJournal.txtReferenceNo.value;')			
			var mStartDate =eval('document.frmJournal.Date1.value;');
			var mEndDate =eval('document.frmJournal.Date2.value;');
			
			var mStatus = eval('document.frmJournal.cboStatus.value;'); 									   						 
			
			var param= "Start=2&ControlNo=" + mControlNo + "&ReferenceNo=" + mReferenceNo + "&StartDate=" + mStartDate + "&EndDate=" + mEndDate + "&Status=" + mStatus;
			ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        		ajaxRequest.send(param);
		}
	function CashReceipts_chkAll()
		{
			var mRec = document.frmJournal.hidRec.value;

			for (i = 1; i <= mRec; i++) 
				{
					if (eval('document.frmJournal.hidStatus'+i+'.value;')=='0')
						{
							if (eval('document.frmJournal.chkControl.checked;'))
								{
									document.getElementById("chkSelect"+i).checked=true;
								}
							else
								{
									document.getElementById("chkSelect"+i).checked=false;
								}
						}
				}
		}
	function CashReceipts_Delete()
		{	
			if (confirm('Select [OK] to Delete Selected Record! Otherwise Select [CANCEL].'))
				{
					var mDesc = 'Deleted Record(s)\n\n';
					var j = 0;
					var mData = '';
					var mRec = document.frmJournal.hidRec.value;

					for (i = 1; i <= mRec; i++) 
						{
							if (eval('document.frmJournal.chkSelect'+i+'.checked;'))
								{
									mData = mData + eval('document.frmJournal.hidID'+i+'.value;') + '!'
												  + eval('document.frmJournal.hidParticular'+i+'.value;') + '!*';		
									mDesc = mDesc + 'CS#: ' 
												  + eval('document.frmJournal.hidID'+i+'.value;') 
												  + ' - '
												  + 'Particular: ' 
												  + eval('document.frmJournal.hidParticular'+i+'.value;')
												  + '\n';
									j = j + 1;
								}
						}
						
					var ajaxRequest = getAjaxRequest();
			
					ajaxRequest.onreadystatechange = function()
						{
							if(ajaxRequest.readyState == 4)
								{
									var ajaxDisplay = document.getElementById('Table');
									ajaxDisplay.innerHTML = ajaxRequest.responseText;
									//alert(mDesc);
								}
						}
					
					var mControlNo = document.frmJournal.txtControlNo.value;
					var mReferenceNo = eval('document.frmJournal.txtReferenceNo.value;')			
					var mStartDate = eval('document.frmJournal.Date1.value;');
					var mEndDate = eval('document.frmJournal.Date2.value;');	
					
					var mStatus = eval('document.frmJournal.cboStatus.value;'); 		

					var param= "Start=1&ControlNo=" + mControlNo + "&ReferenceNo=" + mReferenceNo + "&StartDate=" + mStartDate + "&EndDate=" + mEndDate + "&Status=" + mStatus + "&Data=" + mData + "&Rec=" + j;
					ajaxRequest.open("POST","cashreceipts_ajax.php",true);
	       				ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        				ajaxRequest.send(param);
				}
		}
	function CashReceipts_PrintVoucher(mControlNo, mAmount)
		{	
			window.open('cashreceiptsvoucher_print.php?ControlNo='+mControlNo+
												  '&Amount='+mAmount+
												  '&AmountWords='+gf_ConvertWord(gf_RemoveComma(mAmount))
						,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function CashReceipts_PrintSummary(mUserID, mCenterID, mControlNo, mReferenceNo, mStartDate, mEndDate, mStatus, mTitle)
		{
			window.open('cashreceiptssummary_print.php?UserID='+mUserID+'&CenterID='+mCenterID+
												  '&ControlNo='+mControlNo+
												  '&ReferenceNo='+mReferenceNo+
												  '&StartDate='+mStartDate+
												  '&EndDate='+mEndDate+
												  '&Status='+mStatus+
												  '&Title='+mTitle
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function CashReceipts_PrintDetail(mUserID, mCenterID, mControlNo, mReferenceNo, mStartDate, mEndDate, mStatus, mTitle)
		{						  
			window.open('cashreceiptsdetail_print.php?UserID='+mUserID+'&CenterID='+mCenterID+
											     '&ControlNo='+mControlNo+
											     '&ReferenceNo='+mReferenceNo+
											     '&StartDate='+mStartDate+
											     '&EndDate='+mEndDate+
											     '&Status='+mStatus+
											     '&Title='+mTitle
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	function CashReceipts_Action(mAction)
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
					ajaxRequest.open("POST","CashReceipts_add.php",true);
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param);	
				}
			else if (mAction == 2)
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

					var param= "ControlNo=&ReferenceNo=&PaymasterID=&Month1=&Day1=&Year1=&Month2=&Day2=&Year2=&Status=";
					ajaxRequest.open("POST","cashreceipts_search.php",true);
					ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					ajaxRequest.send(param);					
				}
		}	
	function CashReceipts_CallAjaxPage(myPage,myStart,myID)
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

			var param= "Start="+myStart+"&ID="+myID;
			ajaxRequest.open("POST",myPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
		}		
	


////////////////////////////////////////GENERAL LEDGER SEARCH 2 ///////////////////////////////////////////////

	function GeneralLedger2_Search(mControlAccount,mSubsidiaryID)
		{
			var ajaxRequest = getAjaxRequest();
	
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}
			var mAccountID = document.frmLedger.cboAccountID.options[document.frmLedger.cboAccountID.selectedIndex].value;
			var mSubsidiaryID = document.frmLedger.cboSubsidiaryID.options[document.frmLedger.cboSubsidiaryID.selectedIndex].value;
			var mDate1 = document.frmLedger.Date1.value;
			var mDate2 = document.frmLedger.Date2.value;
			var mMonth1 = mDate1.substr(5,2); 
			var mDay1 =  mDate1.substr(8,2);
			var mYear1 = mDate1.substr(0,4);
			var mMonth2 = mDate2.substr(5,2);
			var mDay2 = mDate2.substr(8,2);
			var mYear2 = mDate2.substr(0,4);
			var mStatus = document.frmLedger.cboStatus.options[document.frmLedger.cboStatus.selectedIndex].value;
			var mJournal = document.frmLedger.cboJournal.value;

			ajaxRequest.open("GET", "generalledger_ajax_.php?Start=2&ControlNo="+mAccountID+
													    	      "&SubsidiaryID="+mSubsidiaryID+
															      "&Journal="+mJournal+
															      "&Month1="+mMonth1+
															      "&Day1="+mDay1+
																  "&Year1="+mYear1+
																  "&Month2="+mMonth2+
																  "&Day2="+mDay2+
																  "&Year2="+mYear2+
																  "&Status="+mStatus, true);
			ajaxRequest.send(null);
			
		}
	function GeneralLedger2_LoadSubsidiary()
		{
			var mAccountID = document.frmLedger.cboAccountID.options[document.frmLedger.cboAccountID.selectedIndex].value;
			var mDate1 = document.frmLedger.Date1.value;
			var mDate2 = document.frmLedger.Date2.value;
			var mMonth1 = mDate1.substr(5,2); 
			var mDay1 =  mDate1.substr(8,2);
			var mYear1 = mDate1.substr(0,4);
			var mMonth2 = mDate2.substr(5,2);
			var mDay2 = mDate2.substr(8,2);
			var mYear2 = mDate2.substr(0,4);
			var mJournal = document.frmLedger.cboJournal.value;
		
		}
	function GeneralLedger2_Print(mUserID, mControlNo, mSubsidiaryNo, mJournal, mMonth1, mDay1, mYear1, mMonth2, mDay2, mYear2, mStartDate, mEndDate, mStatus)
		{
			var mStatus = document.frmLedger.cboStatus.options[document.frmLedger.cboStatus.selectedIndex].value;
			window.open('generalledger_print.php?UserID='+mUserID+
											   '&ControlNo='+mControlNo+
											   '&SubsidiaryNo='+mSubsidiaryNo+
											   '&Journal='+mJournal+
											   '&Month1='+mMonth1+
											   '&Day1='+mDay1+
											   '&Year1='+mYear1+
											   '&Month2='+mMonth2+
											   '&Day2='+mDay2+
											   '&Year2='+mYear2+
											   '&StartDate='+mStartDate+
											   '&EndDate='+mEndDate+
											   '&Status='+mStatus	
					    ,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
		}
	
	function GeneralLedger2_CallAjaxPage(mPage,mStart,mControlAccount,mStatus,mJournal,mMonth1,mDay1,mYear1,mMonth2,mDay2,mYear2,mSubsidiaryID)
	{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortTable();
							GeneralLedger2_Search(mControlAccount,mSubsidiaryID);
							
						}
				}

			var param= "Start="+mStart+"&ControlAccount="+mControlAccount+"&SubsidiaryID="+mSubsidiaryID+"&Status="+mStatus+"&Journal="+mJournal+"&Month1="+mMonth1+"&Day1="+mDay1+"&Year1="+mYear1+"&Month2="+mMonth2+"&Day2="+mDay2+"&Year2="+mYear2+"&SubsidiaryNo=";
			ajaxRequest.open("POST",mPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
		}	
	
	function PerBook_CallAjaxPage(mPage,mStart,mControlNo,mControlAccount,mSubsidiaryID,mStatus,mJournal,mMonth1,mDay1,mYear1,mMonth2,mDay2,mYear2)
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

			var param= "Start="+mStart+"&ControlNo="+mControlNo+"&ControlAccount="+mControlAccount+"&SubsidiaryID="+mSubsidiaryID+"&Status="+mStatus+"&Journal="+mJournal+"&Month1="+mMonth1+"&Day1="+mDay1+"&Year1="+mYear1+"&Month2="+mMonth2+"&Day2="+mDay2+"&Year2="+mYear2+"&SubsidiaryNo=";
			ajaxRequest.open("POST",mPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
		}	
		
		
		
		
		
		
		
		
		
		
		
		
	///////////////////////////////////////////balance sheet////////////////////////////////////////////////////////////////////
	function BalanceSheet_Print(mUserID)
		{
			var mMonth1 = document.frmFinancial.cboMonth1.options[document.frmFinancial.cboMonth1.selectedIndex].value;
			var mYear1 = document.frmFinancial.cboYear1.options[document.frmFinancial.cboYear1.selectedIndex].value;
			var mStart = '0';
			var mStatus = document.frmFinancial.cboStatus.options[document.frmFinancial.cboStatus.selectedIndex].value;

			if (mStart=='0')
				{ 
					window.close();
					window.open('balancesheet_print.php?UserID='+mUserID+		
													  '&Month1='+mMonth1+
												      '&Year1='+mYear1+
													'&Status='+mStatus
								,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
				}
		}
		
	////////////////////////////////////////////INCOME STATEMENT/////////////////////////////////////////////
	function IncomeStatement_Print(mUserID)
		{
			var mMonth1 = document.frmFinancial.cboMonth1.options[document.frmFinancial.cboMonth1.selectedIndex].value;
			var mYear1 = document.frmFinancial.cboYear1.options[document.frmFinancial.cboYear1.selectedIndex].value;
			var mStart = '0';
			var mStatus = document.frmFinancial.cboStatus.options[document.frmFinancial.cboStatus.selectedIndex].value; 	
			if (mStart=='0')
				{
					window.close();
					window.open('incomestatement_print.php?UserID='+mUserID+			
														 '&Month1='+mMonth1+
														 '&Year1='+mYear1+
														 '&Status='+mStatus	
								,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
				}
		}	
		
	//////////////////////////////////////////////CASH FLOW/////////////////////////////////////////////////////
	function CashFlow_Print(mUserID)
		{
			//alert("cash flow");
			var mMonth1 = document.frmFinancial.cboMonth1.options[document.frmFinancial.cboMonth1.selectedIndex].value;
			var mYear1 = document.frmFinancial.cboYear1.options[document.frmFinancial.cboYear1.selectedIndex].value;
			var mStart = '0';
			var mStatus = document.frmFinancial.cboStatus.options[document.frmFinancial.cboStatus.selectedIndex].value;

			if (mStart=='0')
				{ 
					window.close();
					window.open('cashflow_print.php?UserID='+mUserID+		
													  '&Month1='+mMonth1+
												      '&Year1='+mYear1+
													'&Status='+mStatus
								,'_new', 'target=_self,toolbar=yes,scrollbars=yes,resizable=yes');
				}
		}
	
		