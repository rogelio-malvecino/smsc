/* ========================================================================= */
/* trims leading/trailing spaces from a string                               */
/* ========================================================================= */
function getAjaxRequest()
	{
		var ajaxRequest; 
				
		try
			{
				return ajaxRequest = new XMLHttpRequest();
			} 
		catch (e)
			{
				try
					{
						return ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} 
				catch (e) 
					{
						try
							{
								return ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
							} 
						catch (e)
							{
								alert("Your browser broke!");
								return false;
							}
					}
			}
	}

String.prototype.trim = function() {
	return this.replace(/^\s+/,"").replace(/\s+$/,"");
}

function gf_IsNumeric(strString)
   //  check for valid numeric strings	
   {
   var strValidChars = "0123456789.,";
   var strChar;
   var blnResult = true;
   
   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
	  
   return blnResult;
   }

  // -->


/* ========================================================================= */
/*  Remove comma from numeric string       									 */
/* ========================================================================= */
function gf_RemoveComma(strNum) {
	var arrNum = strNum.split(',');

	return arrNum.join('');
}

/* ========================================================================= */
/*  Insert comma from numeric string       									 */
/* ========================================================================= */
function gf_InsertComma(number) {
	number = '' + number;
	if (number.length > 3) {
		var mod = number.length % 3;
		var output = (mod > 0 ? (number.substring(0,mod)) : '');
		for (i=0 ; i < Math.floor(number.length / 3); i++) {
			if ((mod == 0) && (i == 0))
				output += number.substring(mod+ 3 * i, mod + 3 * i + 3);
			else
				output+= ',' + number.substring(mod + 3 * i, mod + 3 * i + 3);
		}
		return (output);
	}
	else return number;
}


/* ========================================================================= */
/*  Format number to currency       									     */
/* ========================================================================= */
function gf_FormatCurrency(num) {
	num = num.toString().replace(/\$|\,/g,'');

	if(isNaN(num))
		num = "0";

	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();

	if (cents<10)
		cents = "0" + cents;

	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+num.substring(num.length-(4*i+3));

	return (((sign)?'':'-') + num + '.' + cents);
}

/* ========================================================================= */
/* Checks if the date is valid or not (format must be MM/DD/YYYY only)       */
/* ========================================================================= */
function gf_IsDate(fieldname,dispname)		{
	var yy,mm,dd;
	var present_date = new Date();
	var yy_old = ""+eval(present_date.getFullYear());
	yy = yy_old.substring(2,4);
	mm = present_date.getMonth() + 1;
	dd = present_date.getDate();
	var str=new String("1234567890/");
	var doj = eval("document.forms[0]."+ fieldname + ".value");
	if(doj=="")
	{
		alert("Please select " + dispname + "   field.");
		eval("document.forms[0]."+fieldname+".focus();");
		return false;
	}
	for(var i=0;i<doj.length;i++)
	{
		if(str.indexOf((doj.charAt(i)))<0)
		{
			eval("alert(\"The " + dispname + " field is accept only date format of month / date / year. \")");
			eval("document.forms[0]." + fieldname + ".focus();");
			return false;
		}
	}		
	var mm1,yy1,dd1;
	var splitstr = doj.split("/")
	mm1= splitstr[0];
	dd1= splitstr[1];
	yy1= splitstr[2];
	len = doj.length;
	//if (len == 6 || len == 7 || len == 8 )
	if (len > 5 && len < 11)
	{
		if(mm1.length != 1 )
		{
			if(mm1.length != 2)
			{
				alert("Please enter correct month.");
				eval("document.forms[0]." + fieldname + ".focus();");
				return false;				
			}	
		}	
		if(dd1.length != 1)
		{
			if(dd1.length != 2)
				{
					alert("Please enter correct date.");
					eval("document.forms[0]." + fieldname + ".focus();");
					return false;				
				}	
		}
		if(yy1.length != 2 && yy1.length != 4)
		{
			alert("Please enter correct year.");
			eval("document.forms[0]." + fieldname + ".focus();");
			return false;
		} 
	}
	else
	{
		alert("Please Enter Correct Format.")
		eval("document.forms[0]." + fieldname + ".focus();");
		return false;						
	}	
	return true;
}

/* =========================================================================
  Given a date as a string
   =========================================================================  */
function gf_GetDateParam( datestr, whatparam ) {
     var dati;
     dati = new Date( datestr );          // make datestr into a Date instance
	 
	if (whatparam == 1)
    	return( 1 + dati.getDay() );          	// get the day of the week
	if (whatparam == 2)							// get the day in number
		return( dati.getDate() );
	if (whatparam == 3)							// get the month in number
		return( 1 + dati.getMonth() );
	if (whatparam == 4)							// get the year
		return( 1 + dati.getYear() );
	
}

/* =========================================================================
  Check if user selected from Combo Box
   =========================================================================  */
function gf_isSelect(fieldname,dispName)
{
	var str=eval("document.forms[0]." + fieldname + ".selectedIndex;");
	if(str==0)
	{
		eval("alert(\"Please select " + dispName + " field.\")");
		eval("document.forms[0]." + fieldname + ".focus();");
		return false;
	}
		return true;
}	  

/* =========================================================================
  Check for Blank Entry
   =========================================================================  */
function gf_isCharEmpty(fieldname,dispName) 
{
	var str1 = eval("document.forms[0]." + fieldname + ".value;");
	if (str1 == "")  
	{
		eval("alert(\"Please enter " + dispName + " field.\")");
		eval("document.forms[0]." + fieldname + ".focus();");
		return false;
	}
	return true;
}


/* =========================================================================
  Left Trim function
   =========================================================================  */
function gf_ltrim(mStr) 
{
	var count=0;
	var i = 0;
	var space = " ";
	var newline="\n";
	var cr = "\r";
	var tab = "\t";
	var sret;
	
	while (
		(mStr.charAt(i) == space) |
		(mStr.charAt(i) == newline) |
		(mStr.charAt(i) == cr) |
		(mStr.charAt(i) == tab)) {
			count++;
			i++
	}
	if (count > 0)
		sret = mStr.substring(count, mStr.length);
		
	return(sret);
}


/* =========================================================================
  Right Trim function
   =========================================================================  */
function gf_rtrim(mStr) 
{
	var count=0;
	var i = mStr.length - 1;
	var space = " ";
	var newline="\n";
	var cr = "\r";
	var tab = "\t";
	var sret;
	
	while (
		(mStr.charAt(i) == space) |
		(mStr.charAt(i) == newline) |
		(mStr.charAt(i) == cr) |
		(mStr.charAt(i) == tab)) {
			count++;
			i--
	}
	if (count > 0)
		sret = mStr.substring(count, mStr.length - count);
		
	return(sret);
}


/* =========================================================================
  Validate if entry is a Number and check if allows zero value or not
   =========================================================================  */
function gf_isNumber(fieldname,dispName,allowZero) 
{
	var empty = true
	var str1 = eval("document.forms[0]." + fieldname + ".value;");
	if (str1 == "")  
	{
		eval("alert(\"The " + dispName + " field is empty. Please enter FIELD.\")");
		eval("document.forms[0]." + fieldname + ".focus();");
		return false;
	}
	else
	{	
		for (var i=0;i < str1.length;i++)
		{
			if (str1.substring(i,i+1) != " ")
			{								
				empty = false;
			}
		}
		if (empty==true)
		{
			eval("alert(\"The " + dispName + " field is empty.Please re-enter.\")");	
			eval("document.forms[0]." + fieldname + ".focus();");
			return false;
		}
	}			
	if (isNaN(gf_RemoveComma(str1)) )
	{
		eval("alert(\"The " +  dispName + " field  has invalid characters. Please enter numbers only.\");");
		eval("document.forms[0]." + fieldname + ".focus();");
		return false;
	}    
	if (allowZero=="Y")
	{
		
		if (str1 < 0)
			{
				eval("alert(\"The " + dispName + " field is Zero or Negative. Please enter FIELD.\")");
				eval("document.forms[0]." + fieldname + ".focus();");
				return false;
			}
	}
	if (allowZero=="N")
	{
		
		if (str1 <= 0)
			{
				eval("alert(\"The " + dispName + " field is Zero or Negative. Please enter FIELD.\")");
				eval("document.forms[0]." + fieldname + ".focus();");
				return false;
			}
	}
								
	return true;
}

/* =========================================================================
  Check if value given is a Currency amount
   =========================================================================  */

function gf_isCurrency(fieldname,dispName) 
{
	var str1 = eval("document.forms[0]." + fieldname + ".value;");
	//alow only these characters
	str=new String("0123456789.,");
	if (str1 == "")  
	{
		eval("alert(\"The " + dispName + " field is empty.Please re-enter.\")");
		eval("document.forms[0]." + fieldname + ".focus();");
		return false;
	}

	for(i=0;i<str1.length;i++)
	if(str.indexOf((str1.charAt(i)))<0)
	{
		eval("alert(\"The " + dispName + " field is accept (0-9) and dot(.)\")");
		eval("document.forms[0]." + fieldname + ".focus();");
		return false;
	}			
		return true;
}


/* =========================================================================
  Form 10 Character Date
   =========================================================================  */
function gf_FormDate() 
{
	var today = new Date();
	var newDate = '';
	
	newDate = gf_attachZero(today.getMonth()+1) + '/' + gf_attachZero(today.getDate()) + '/' + gf_attachZero(today.getYear())
	return newDate;	
}

function gf_attachZero(mNum)
{
	var mNewNum = mNum;
	
	if (mNum < 9) {
		mNewNum = '0'+mNum
	}
	return mNewNum;
}


/* =========================================================================
  This field will not accept double or single quotes
   =========================================================================  */
function gf_BlockQuotes(mKeyCode) {

	if (mKeyCode==34 || mKeyCode==39) {
		return false;
	}
	return true;
	
}



/* =========================================================================
  This field will not accept characters other than numbers, comma and dot
   =========================================================================  */
function gf_ValidCurrency(event) {
	var e = event;
	var keycode;

	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;

	if (keycode >= 44 && keycode <= 57 && keycode != 47 || keycode == 0 || keycode == 8) 
		{
			return true;
		}
	return false;
	
}


function gf_Save(event) {
	
	var e = event;
	var keycode;

	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	
	if (keycode == 113) 
		{
			ShowItem();
		}
	if (keycode == 118) 
		{
			Action(1);
		}
	if (keycode == 119) 
		{
			Action(2);
		}
	if (keycode == 120) 
		{
			Action(5);
		}
	if (keycode == 123) 
		{
			DeleteItem();
		}
}


/* =========================================================================
  This field only accepts alphabet characters
   =========================================================================  */
function gf_AlphaQuotes(mKeyCode) {

	if ((mKeyCode >= 65 && mKeyCode <= 90 ) || (mKeyCode >= 97 && mKeyCode <= 122 )) {
		return true;
	}
	return false;
	
}
/* =========================================================================
 Converts Numeric In Words
   =========================================================================  */
		var n = "";
		var decpt = "00";
		var strl= '';
		function gf_ConvertWord(input) {
			//alert(input);
			//var str1 = eval("document.forms[0]." + fieldname + ".value;");
			toString(input);
			var xNum = input.split('.');
			
			//alert('0 = ' + xNum[0])
			//alert('1 = ' + xNum[1])			
			//if (input.length == 0) {
			//	alert ('Please Enter A Number.');
				//document.frmCashier.txtWord.value = "";
			//	return '';
			//}
			//else {
				//alert(input.indexOf('.'))
				if (input.indexOf('.') < 0) {decpt = '00'} else {decpt = xNum[1]}
				return convert(xNum[0], decpt);
				//return input;
			//}
			
		}

		function d1(x) { // single digit terms
			switch(x) {
				case '0': n= ""; break;
				case '1': n= " One "; break;
				case '2': n= " Two "; break;
				case '3': n= " Three "; break;
				case '4': n= " Four "; break;
				case '5': n= " Five "; break;
				case '6': n= " Six "; break;
				case '7': n= " Seven "; break;
				case '8': n= " Eight "; break;
				case '9': n= " Nine "; break;
				default: n = "Not a Number";
			}
			return n;
		}

		function d2(x) { // 10x digit terms
			switch(x) {
				case '0': n= ""; break;
				case '1': n= ""; break;
				case '2': n= " Twenty "; break;
				case '3': n= " Thirty "; break;
				case '4': n= " Forty "; break;
				case '5': n= " Fifty "; break;
				case '6': n= " Sixty "; break;
				case '7': n= " Seventy "; break;
				case '8': n= " Eighty "; break;
				case '9': n= " Ninety "; break;
				default: n = "Not a Number";
			}
			return n;
		}

		function d3(x) { // teen digit terms
			switch(x) {
				case '0': n= " Ten "; break;
				case '1': n= " Eleven "; break;
				case '2': n= " Twelve "; break;
				case '3': n= " Thirteen "; break;
				case '4': n= " Fourteen "; break;
				case '5': n= " Fifteen "; break;
				case '6': n= " Sixteen "; break;
				case '7': n= " Seventeen "; break;
				case '8': n= " Eighteen "; break;
				case '9': n= " Nineteen "; break;
				default: n=  "Not a Number";
			}
			return n;
		}

		function convert(input, input2) {
			var inputlength = input.length;
			var x = 0;
			var teen1 = "";
			var teen2 = "";
			var teen3 = "";
			var numName = "";
			var invalidNum = "";
			var a1 = ""; // for insertion of million, thousand, hundred 
			var a2 = "";
			var a3 = "";
			var a4 = "";
			var a5 = "";
			digit = new Array(inputlength); // stores output
			for (i = 0; i < inputlength; i++)  {
			// puts digits into array
			digit[inputlength - i] = input.charAt(i)};
			store = new Array(9); // store output
			for (i = 0; i < inputlength; i++) {
			x= inputlength - i;
			switch (x) { // assign text to each digit
			case x=9: d1(digit[x]); store[x] = n; break;
			case x=8: if (digit[x] == "1") {teen3 = "yes"}
					  else {teen3 = ""}; d2(digit[x]); store[x] = n; break;
			case x=7: if (teen3 == "yes") {teen3 = ""; d3(digit[x])}
					  else {d1(digit[x])}; store[x] = n; break;
			case x=6: d1(digit[x]); store[x] = n; break;
			case x=5: if (digit[x] == "1") {teen2 = "yes"}
					  else {teen2 = ""}; d2(digit[x]); store[x] = n; break;
			case x=4: if (teen2 == "yes") {teen2 = ""; d3(digit[x])}    
					  else {d1(digit[x])}; store[x] = n; break;
			case x=3: d1(digit[x]); store[x] = n; break;
			case x=2: if (digit[x] == "1") {teen1 = "yes"}
					  else {teen1 = ""}; d2(digit[x]); store[x] = n; break;
			case x=1: if (teen1 == "yes") {teen1 = "";d3(digit[x])}     
					  else {d1(digit[x])}; store[x] = n; break;
			}
			if (store[x] == "Not a Number"){invalidNum = "yes"};
			switch (inputlength){
			case 1:   store[2] = ""; 
			case 2:   store[3] = ""; 
			case 3:   store[4] = ""; 
			case 4:   store[5] = "";
			case 5:   store[6] = "";
			case 6:   store[7] = "";
			case 7:   store[8] = "";
			case 8:   store[9] = "";
			}
			if (store[9] != "") { a1 =" Hundred "} else {a1 = ""};
			if ((store[9] != "")||(store[8] != "")||(store[7] != ""))
			{ a2 =" Million "} else {a2 = ""};
			if (store[6] != "") { a3 =" Hundred "} else {a3 = ""};
			if ((store[6] != "")||(store[5] != "")||(store[4] != ""))
			{ a4 =" Thousand "} else {a4 = ""};
			if (store[3] != "") { a5 =" Hundred "} else {a5 = ""};
			}
			// add up text, cancel if invalid input found
			if (invalidNum == "yes"){numName = "Invalid Input"}
			else {
			numName =  store[9] + a1 + store[8] + store[7] 
			+ a2 + store[6] + a3 + store[5] + store[4] 
			+ a4 + store[3] + a5 + store[2] + store[1];
			}
			store[1] = ""; store[2] = ""; store[3] = ""; 
			store[4] = ""; store[5] = ""; store[6] = "";
			store[7] = ""; store[8] = ""; store[9] = "";
			if (numName == ""){numName = "Zero"};
			strl = numName + 'Pesos and ' + input2 + '/100';
			//eval("document.forms[0]." + fieldname + ".value;") = strl;
			//alert(numName);
			//return true;
			return strl;
		}
		
		
function GetXmlHttpObject()
	{
  		var xmlHttp=null;
  		
		try
    		{
    			// Firefox, Opera 8.0+, Safari
    			xmlHttp=new XMLHttpRequest();
    		}
  		catch (e)
    
			{
    			// Internet Explorer
    		
		try
      		{
      			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      		}
    	catch (e)
      		
			{
      			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      		}
    
	
			}
  		return xmlHttp;
	}




function stateChanged() 
	{ 
		if (xmlHttp.readyState==4)
			{ 
				document.getElementById("txtHint").innerHTML=xmlHttp.responseText;
			}
	}
	
	
function gf_ValidBenefits(mKeyCode) {

	if (mKeyCode >= 44 && mKeyCode <= 57 && mKeyCode != 46 && mKeyCode != 47) {
		return true;
	}
	return false;
	
}
function SuggestOver(div_value) 
	{
		div_value.className = 'suggest_link_over';
	}

function SuggestOut(div_value) 
	{
		div_value.className = 'suggest_link';
	}



