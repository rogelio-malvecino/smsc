/*
	This is the JavaScript file for the AJAX Suggest Tutorial

	You may use this code in your own projects as long as this 
	copyright is left	in place.  All code is provided AS-IS.
	This code is distributed in the hope that it will be useful,
 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	
	For the rest of the code visit http://www.DynamicAJAX.com
	
	Copyright 2006 Ryan Smith / 345 Technical / 345 Group.	

*/
//Gets the browser specific XmlHttpRequest Object

function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your Browser Sucks!\nIt's about time to upgrade don't you think?");
	}
}

//Our XmlHttpRequest object to get the auto suggest
var searchReq = getXmlHttpRequestObject();

//Called from keyup on the search textbox.
//Starts the AJAX request.
function searchSuggestLastName(module, field) {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('txtLastName').value);
		searchReq.open("GET", 'hint.php?module='+ module +'&field='+ field + '&search=' + str, true);
		searchReq.onreadystatechange = handleSearchSuggestLastName; 
		searchReq.send(null);
	}		
}

//Called when the AJAX response is returned.
function handleSearchSuggestLastName() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_lastname')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearchLastName(this.innerHTML);" ';
			suggest += 'class="suggest_link">' + str[i] + '</div>';
			ss.innerHTML += suggest;
		}
	}
}





//Mouse over function
function suggestOver(div_value) {
	div_value.className = 'suggest_link_over';
}
//Mouse out function
function suggestOut(div_value) {
	div_value.className = 'suggest_link';
}
//Click function
function setSearchLastName(value) {
	document.getElementById('txtLastName').value = value;
	document.getElementById('search_lastname').innerHTML = '';
}






function searchSuggestFirstName(module, field) {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('txtFirstName').value);
		searchReq.open("GET", 'hint.php?module='+ module +'&field='+ field + '&search=' + str, true);
		searchReq.onreadystatechange = handleSearchSuggestFirstName; 
		searchReq.send(null);
	}		
}

//Called when the AJAX response is returned.
function handleSearchSuggestFirstName() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_firstname')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearchFirstName(this.innerHTML);" ';
			suggest += 'class="suggest_link">' + str[i] + '</div>';
			ss.innerHTML += suggest;
		}
	}
}

//Click function
function setSearchFirstName(value) {
	document.getElementById('txtFirstName').value = value;
	document.getElementById('search_firstname').innerHTML = '';
}








function searchSuggestMiddleName(module, field) {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('txtMiddleName').value);
		searchReq.open("GET", 'hint.php?module='+ module +'&field='+ field + '&search=' + str, true);
		searchReq.onreadystatechange = handleSearchSuggestMiddleName; 
		searchReq.send(null);
	}		
}

//Called when the AJAX response is returned.
function handleSearchSuggestMiddleName() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_middlename')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearchMiddleName(this.innerHTML);" ';
			suggest += 'class="suggest_link">' + str[i] + '</div>';
			ss.innerHTML += suggest;
		}
	}
}

//Click function
function setSearchMiddleName(value) {
	document.getElementById('txtMiddleName').value = value;
	document.getElementById('search_middlename').innerHTML = '';
}















function searchSearchEmployeeID(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtEmployeeID').value);
				searchReq.open("GET", 'validate.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchSuggestEmployeeID; 
				searchReq.send(null);
		}		
	}


function handleSearchSuggestEmployeeID() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_employeeid')
				ss.innerHTML = '';
				ss.innerHTML = searchReq.responseText;
			}
	}








function searchSearchGroupAccountNo(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtGroupID').value);
				searchReq.open("GET", 'validate.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchSuggestGroupAccountNo; 
				searchReq.send(null);
		}		
	}


function handleSearchSuggestGroupAccountNo() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_groupaccountno')
				ss.innerHTML = '';
				ss.innerHTML = searchReq.responseText;
			}
	}
	
	
	
	





function searchSearchAccountNo(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtAccountID').value);
				searchReq.open("GET", 'validate.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchSuggestAccountNo; 
				searchReq.send(null);
		}		
	}


function handleSearchSuggestAccountNo() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_accountno')
				ss.innerHTML = '';
				ss.innerHTML = searchReq.responseText;
			}
	}
	
	
	
	
	
	










function searchSearchPaymasterName(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtPaymasterName').value);
				searchReq.open("GET", 'validate.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchPaymasterName; 
				searchReq.send(null);
		}		
	}


function handleSearchPaymasterName() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_paymastername')
				ss.innerHTML = '';
				ss.innerHTML = searchReq.responseText;
			}
	}














function searchSearchStatementNo(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtStatementNo').value);
				searchReq.open("GET", 'validate.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchStatementNo; 
				searchReq.send(null);
		}		
	}


function handleSearchStatementNo() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_statementno')
				ss.innerHTML = '';
				ss.innerHTML = searchReq.responseText;
			}
	}













	
	
	














function searchSuggestAccountDesc(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtAccountDesc').value);
				searchReq.open("GET", 'hint.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchSuggestAccountDesc; 
				searchReq.send(null);
			}		
	}

function handleSearchSuggestAccountDesc() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_accountdesc')
				ss.innerHTML = '';
				var str = searchReq.responseText.split("\n");

				for(i=0; i < str.length - 1; i++) 
					{
						var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
						suggest += 'onmouseout="javascript:suggestOut(this);" ';
						suggest += 'onclick="javascript:setSearchAccountDesc(this.innerHTML);" ';
						suggest += 'class="suggest_link">' + str[i] + '</div>';
						ss.innerHTML += suggest;
					}
			}
	}
 
function setSearchAccountDesc(value) 
	{
		document.getElementById('txtAccountDesc').value = value;
		document.getElementById('search_accountdesc').innerHTML = '';
	}





















function searchSuggestSubsidiaryDesc(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtSubsidiaryDesc').value);
				searchReq.open("GET", 'hint.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchSuggestSubsidiaryDesc; 
				searchReq.send(null);
			}		
	}

function handleSearchSuggestSubsidiaryDesc() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_subsidiarydesc')
				ss.innerHTML = '';
				var str = searchReq.responseText.split("\n");

				for(i=0; i < str.length - 1; i++) 
					{
						var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
						suggest += 'onmouseout="javascript:suggestOut(this);" ';
						suggest += 'onclick="javascript:setSearchSubsidiaryDesc(this.innerHTML);" ';
						suggest += 'class="suggest_link">' + str[i] + '</div>';
						ss.innerHTML += suggest;
					}
			}
	}
 
function setSearchSubsidiaryDesc(value) 
	{
		document.getElementById('txtSubsidiaryDesc').value = value;
		document.getElementById('search_subsidiarydesc').innerHTML = '';
	}
	
	
	










function searchSuggestPaymasterName(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtPaymasterName').value);
				searchReq.open("GET", 'hint.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchSuggestPaymasterName; 
				searchReq.send(null);
			}		
	}

function handleSearchSuggestPaymasterName() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_paymastername')
				ss.innerHTML = '';
				var str = searchReq.responseText.split("\n");

				for(i=0; i < str.length - 1; i++) 
					{
						var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
						suggest += 'onmouseout="javascript:suggestOut(this);" ';
						suggest += 'onclick="javascript:setSearchPaymasterName(this.innerHTML);" ';
						suggest += 'class="suggest_link">' + str[i] + '</div>';
						ss.innerHTML += suggest;
					}
			}
	}
 
function setSearchPaymasterName(value) 
	{
		document.getElementById('txtPaymasterName').value = value;
		document.getElementById('search_paymastername').innerHTML = '';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
function searchSearchControlNo(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtControlNo').value);
				searchReq.open("GET", 'validate.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchSuggestControlNo; 
				searchReq.send(null);
		}		
	}


function handleSearchSuggestControlNo() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_controlno')
				ss.innerHTML = '';
				ss.innerHTML = searchReq.responseText;
			}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
function searchSearchCheckNo(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtCheckNo').value);
				searchReq.open("GET", 'validate.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchSuggestCheckNo; 
				searchReq.send(null);
		}		
	}


function handleSearchSuggestCheckNo() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_checkno')
				ss.innerHTML = '';
				ss.innerHTML = searchReq.responseText;
			}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
function searchSuggestProcedureName(module, field) {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('txtName').value);
		searchReq.open("GET", 'hint.php?module='+ module +'&field='+ field + '&search=' + str, true);
		searchReq.onreadystatechange = handleSearchSuggestProcedureName; 
		searchReq.send(null);
	}		
}

//Called when the AJAX response is returned.
function handleSearchSuggestProcedureName() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_procedurename')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearchProcedureName(this.innerHTML);" ';
			suggest += 'class="suggest_link">' + str[i] + '</div>';
			ss.innerHTML += suggest;
		}
	}
}

//Click function
function setSearchProcedureName(value) {
	document.getElementById('txtName').value = value;
	document.getElementById('search_procedurename').innerHTML = '';
}















function searchSearchSOANo(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtControlNo').value);
				searchReq.open("GET", 'validate.php?module='+ module +'&field='+ field + '&search=' + str, true);
				searchReq.onreadystatechange = handleSearchSuggestSOANo; 
				searchReq.send(null);
		}		
	}


function handleSearchSuggestSOANo() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('search_controlno')
				ss.innerHTML = '';
				ss.innerHTML = searchReq.responseText;
			}
	}
	








function searchShowAmountWords(module, field) 
	{
		if (searchReq.readyState == 4 || searchReq.readyState == 0) 
			{
				var str = escape(document.getElementById('txtTotalPaid').value);
				searchReq.open("GET", gf_ConvertWord(gf_RemoveComma(str)), true);
				searchReq.onreadystatechange = handleShowAmountWords; 
				searchReq.send(null);
		}		
	}


function handleShowAmountWords() 
	{
		if (searchReq.readyState == 4) 
			{
				var ss = document.getElementById('show_amountwords')
				ss.innerHTML = '';
				ss.innerHTML = searchReq.responseText;
			}
	}
	
