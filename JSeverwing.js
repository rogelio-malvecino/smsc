String.prototype.trim = function() {return this.replace(/^\s+|\s+$/, '');};
/*return ajax*/
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

/* FUNCTION DELETE RECORD*/
function deleteRecord(recordId,phpPage){
     if(confirm('Do you want to delete this record?')){
                var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
						{
                                                        if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;


						}
				}
                        var param= "delgo="+recordId;
			ajaxRequest.open("POST",phpPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        ajaxRequest.send(param);




							 $(".del"+recordId).fadeOut('slow', function() {$(this).remove();});

						}
							return false;


}
/*END FUNCTION DELETE FUNCTION*/

/*fot textbox autocompletion*/
function autoComplete(id,page){
$(id).autocomplete(page, {
   width: 300
        });
}
/*end function autocompletion*/

function sortTable()
{
      
///* make table sortable*/
	oTable = $('#example').dataTable({
							"bJQueryUI": true,
							"sPaginationType": "full_numbers",
							"bRetrieve":true
						});

	/*end of sort table*/
	
	
	/*for making fancy box*/
	$(".addProduct").fancybox({
            'opacity'		: true,
			'overlayShow'	: true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			'hideOnOverlayClick':false,
      		'hideOnContentClick':false

			
				 
		 });
	/*end of making fancy box*/
            $(".makeFancy").fancybox({
                'opacity': true,
			'overlayShow'	: false,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			'hideOnOverlayClick':false,
                        'hideOnContentClick':false
                     
			
            });
	
	
	$(".editProduct").fancybox({
            'opacity'		: true,
			'overlayShow'	: true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			'hideOnOverlayClick':false,
      		'hideOnContentClick':false

         });

$(".showDetail").click(function()
				{
				$(".detail").show();						
				});
}

/* show or hide the column on the dataTable*/
function fnShowHide( iCol )
{
	/* Get the DataTables object again - this is not a recreation, just a get of the object */
	var oTable = $('#example').dataTable();
	
	var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
	oTable.fnSetColumnVis( iCol, bVis ? false : true );
}
/*display the  result of you're function*/

function ChangeSubTitle(mSubMenu)
		{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}
			var param= "SubMenu="+mSubMenu;
			ajaxRequest.open("POST","menulocation.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);
		}
     
/*call you're page */

function CallAjaxPage(mypage)
		{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
                                                         $(".makeFancy").fancybox({
                'opacity': true,
			'overlayShow'	: false,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			'hideOnOverlayClick':false,
                        'hideOnContentClick':false


            });
                                                        
							
						}
				}

			var param= "";
			ajaxRequest.open("POST",mypage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
							
							
		}

		
function loadContent(){
   var a=$("#selSalesmanCode option:selected").val();
   $.get('salesmanSearch.php?id='+a, function(data){
   $('.salesManName').html(data);
});
}
/* open page within the page */
function timeAndDate(){
                                                    var currentTime = new Date()
                                                    var month = currentTime.getMonth() + 1
                                                    var day = currentTime.getDate()
                                                    var year = currentTime.getFullYear()
                                                    var hour= currentTime.getHours()
                                                    var min=currentTime.getMinutes()
                                                    var ampm="";
                                                    if (min < 10){
                                                    min = "0" + min
                                                    }
                                                    if (month < 10){
                                                    month = "0" + month
                                                    }
                                                    if (hour < 10){
                                                    hour = "0" + hour
                                                    }
                                                 
                                                    if(hour > 11){
                                                        ampm="PM";
                                                    }
                                                    else{
                                                        ampm="AM";
                                                    }
                                            
                                                      $("#f_date1").val(month + "-" + day + "-" + year + " " + hour + ":" + min + " " +ampm);
                                                      $("#f_date2").val(month + "-" + day + "-" + year + " " + hour + ":" + min + " " +ampm);
                                             
}
function openPage(subPage)
		{

                        var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
                                                        Calendar.setup({
                                                        inputField : 'f_date2',
                                                        trigger    : 'f_btn2',
                                                        onSelect   : function() {this.hide()},
                                                        showTime   : 12,
                                                        dateFormat : "%m-%d-%Y %I:%M %p"
                                                      });
                                                    timeAndDate()
                                                   
                                                  
                                                         Calendar.setup({
                                                        inputField : 'f_date1',
                                                        trigger    : 'f_btn1',
                                                        onSelect   : function() {this.hide()},
                                                        showTime   : 12,
                                                        dateFormat : "%m-%d-%Y %I:%M %p"
                                                      });
                                                      try_()
                                                      $("#txtCode").focus();

                                                       loadContent()
                                                       uomValue()
                                                       /*autoSearch*/
                                                       $("#txtItemCode").autocomplete('salesInvoiceAutoSearch.php', {
                                                         width: 200
                                                         });
                                                }
				}

			var param= "";
			ajaxRequest.open("POST",subPage,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        ajaxRequest.send(param);


		}
/*end function *





/* employee*/

function employee_search()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}
			var param= "";
			ajaxRequest.open("POST","employee_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
}
/* show upload picture then hide table for employee*/
function showPic()
{
	$("#pic").slideDown();
	$("#employeesearch").hide();
	$(".close").show();
}
/* hide upload picture then show table for employee*/
function hidePic()
{
	$("#pic").hide();
	$("#employeesearch").toggle();
	$(".close").hide();
}

function employee_()
{
		
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "";
			ajaxRequest.open("POST","employee_.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);

}


function employee_delete(mEmpNumber)
{

			mEmpNumber = mEmpNumber.toString();
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							employee_search();
						}
				}

			var param= "EmpNumber=" + escape(mEmpNumber);
			ajaxRequest.open("POST","employee_delete.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param); 

}
function checkVal()
{
	var e=$("#EmpHeightid").val()+ "'" + $("#EmpInch").val();
	alert(e);
}

function employee_save()
{

			var mEmpNumber = eval('document.frmEmployee.EmpNumbername.value;');
			var mEmpFirstName = eval('document.frmEmployee.EmpFirstNamename.value;');
			var mEmpMiddleName = eval('document.frmEmployee.EmpMiddleNamename.value;');
			var mEmpLastName = eval('document.frmEmployee.EmpLastNamename.value;');
			var mEmpEmail = eval('document.frmEmployee.EmpEmailname.value;');
			var mEmpCPNumber = eval('document.frmEmployee.EmpCPNumbername.value;');
			var mEmpMONumber = eval('document.frmEmployee.EmpMobileNumbername.value;');
			var mEmpGender = eval('document.frmEmployee.EmpGendername.value;');
			var mEmpStatus = eval('document.frmEmployee.EmpStatusname.value;');
			var mEmpReligion = eval('document.frmEmployee.EmpReligionname.value;');
			var mEmpMonth = eval('document.frmEmployee.EmpMonthname.value;');
			var mEmpDay = eval('document.frmEmployee.EmpDayname.value;');
			var mEmpYear = eval('document.frmEmployee.EmpYearname.value;');
			var mEmpHeight = $("#EmpHeightid").val()+ "'" + $("#EmpInch").val();
			var mEmpWeight = eval('document.frmEmployee.EmpWeightname.value;');
			var mEmpHomeAddress = eval('document.frmEmployee.EmpHomeAddressname.value;');
			var mEmpCollege = eval('document.frmEmployee.EmpCollegename.value;');
			var mEmpYrlvlc = eval('document.frmEmployee.EmpSYCollegename.value;');
			var mEmpHighSchool = eval('document.frmEmployee.EmpHighSchoolname.value;');
			var mEmpYrlvlh = eval('document.frmEmployee.EmpSYHighname.value;');
			var mEmpElementary = eval('document.frmEmployee.EmpElementaryname.value;');
			var mEmpYrlvle = eval('document.frmEmployee.EmpSYElemname.value;');
			
			
		
			
			
			var ajaxRequest = getAjaxRequest();
			
			
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber="+mEmpNumber+"&EmpFirstName="+mEmpFirstName+"&EmpMiddleName="+mEmpMiddleName+"&EmpLastName="+mEmpLastName+"&EmpEmail="+mEmpEmail+"&EmpCPNumber="+mEmpCPNumber+"&EmpMONumber="+mEmpMONumber+"&EmpGender="+mEmpGender+"&EmpStatus="+mEmpStatus+"&EmpReligion="+mEmpReligion+"&EmpMonth="+mEmpMonth+"&EmpDay="+mEmpDay+"&EmpYear="+mEmpYear+"&EmpHeight="+mEmpHeight+"&EmpWeight="+mEmpWeight+"&EmpHomeAddress="+mEmpHomeAddress+"&EmpCollege="+mEmpCollege+"&EmpYrlvlc="+mEmpYrlvlc+"&EmpHighSchool="+mEmpHighSchool+"&EmpYrlvlh="+mEmpYrlvlh+"&EmpElementary="+mEmpElementary+"&EmpYrlvle="+mEmpYrlvle;
			
			ajaxRequest.open("POST","employee_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);


}
function employee_check()
{

	try{
			var mEmpNumber = eval('document.frmEmployee.EmpNumbername.value;');
			var mEmpFirstName = eval('document.frmEmployee.EmpFirstNamename.value;');
			var mEmpMiddleName = eval('document.frmEmployee.EmpMiddleNamename.value;');
			var mEmpLastName = eval('document.frmEmployee.EmpLastNamename.value;');
			var mEmpEmail = eval('document.frmEmployee.EmpEmailname.value;');
			var mEmpCPNumber = eval('document.frmEmployee.EmpCPNumbername.value;');
			var mEmpMONumber = eval('document.frmEmployee.EmpMobileNumbername.value;');
			var mEmpGender = eval('document.frmEmployee.EmpGendername.value;');
			var mEmpStatus = eval('document.frmEmployee.EmpStatusname.value;');
			var mEmpReligion = eval('document.frmEmployee.EmpReligionname.value;');
			var mEmpMonth = eval('document.frmEmployee.EmpMonthname.value;');
			var mEmpDay = eval('document.frmEmployee.EmpDayname.value;');
			var mEmpYear = eval('document.frmEmployee.EmpYearname.value;');
			var mEmpHeight = $("#EmpHeightid").val()+ "'" + $("#EmpInch").val();
			var mEmpWeight = eval('document.frmEmployee.EmpWeightname.value;');
			var mEmpHomeAddress = eval('document.frmEmployee.EmpHomeAddressname.value;');
			var mEmpCollege = eval('document.frmEmployee.EmpCollegename.value;');
			var mEmpYrlvlc = eval('document.frmEmployee.EmpSYCollegename.value;');
			var mEmpHighSchool = eval('document.frmEmployee.EmpHighSchoolname.value;');
			var mEmpYrlvlh = eval('document.frmEmployee.EmpSYHighname.value;');
			var mEmpElementary = eval('document.frmEmployee.EmpElementaryname.value;');
			var mEmpYrlvle = eval('document.frmEmployee.EmpSYElemname.value;');
			
			

			
			
			
			if ( mEmpNumber == "" || mEmpFirstName == "" || mEmpMiddleName =="" || mEmpLastName =="" || mEmpEmail =="" || mEmpCPNumber == "" || mEmpMONumber == "" || mEmpGender == "" || mEmpStatus == "" || mEmpReligion == "" || mEmpMonth == "" || mEmpDay == "" || mEmpYear == "" || mEmpHeight == "" || mEmpWeight == "" || mEmpHomeAddress == "" || mEmpCollege == "" || mEmpYrlvlc == "" || mEmpHighSchool == "" || mEmpYrlvlh == "" || mEmpElementary == "" || mEmpYrlvle == "")
			{
				alert("Invalid Data Entry");
				return false;
			}
			{
				employee_save();
				$("#fancybox-wrap, #fancybox-overlay").fadeOut();	
			}

	}
	catch (exception)
	{
	alert(exception);
	}
}
function employee_save()
{
	
	var mEmpNumber = eval('document.frmEmployee.EmpNumbername.value;');
			var mEmpFirstName = eval('document.frmEmployee.EmpFirstNamename.value;');
			var mEmpMiddleName = eval('document.frmEmployee.EmpMiddleNamename.value;');
			var mEmpLastName = eval('document.frmEmployee.EmpLastNamename.value;');
			var mEmpEmail = eval('document.frmEmployee.EmpEmailname.value;');
			var mEmpCPNumber = eval('document.frmEmployee.EmpCPNumbername.value;');
			var mEmpMONumber = eval('document.frmEmployee.EmpMobileNumbername.value;');
			var mEmpGender = eval('document.frmEmployee.EmpGendername.value;');
			var mEmpStatus = eval('document.frmEmployee.EmpStatusname.value;');
			var mEmpReligion = eval('document.frmEmployee.EmpReligionname.value;');
			var mEmpMonth = eval('document.frmEmployee.EmpMonthname.value;');
			var mEmpDay = eval('document.frmEmployee.EmpDayname.value;');
			var mEmpYear = eval('document.frmEmployee.EmpYearname.value;');
			var mEmpHeight = $("#EmpHeightid").val()+ "'" + $("#EmpInch").val();
			var mEmpWeight = eval('document.frmEmployee.EmpWeightname.value;');
			var mEmpHomeAddress = eval('document.frmEmployee.EmpHomeAddressname.value;');
			var mEmpCollege = eval('document.frmEmployee.EmpCollegename.value;');
			var mEmpYrlvlc = eval('document.frmEmployee.EmpSYCollegename.value;');
			var mEmpHighSchool = eval('document.frmEmployee.EmpHighSchoolname.value;');
			var mEmpYrlvlh = eval('document.frmEmployee.EmpSYHighname.value;');
			var mEmpElementary = eval('document.frmEmployee.EmpElementaryname.value;');
			var mEmpYrlvle = eval('document.frmEmployee.EmpSYElemname.value;');
			
			
		
			
			
			var ajaxRequest = getAjaxRequest();
			
			
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber="+mEmpNumber+"&EmpFirstName="+mEmpFirstName+"&EmpMiddleName="+mEmpMiddleName+"&EmpLastName="+mEmpLastName+"&EmpEmail="+mEmpEmail+"&EmpCPNumber="+mEmpCPNumber+"&EmpMONumber="+mEmpMONumber+"&EmpGender="+mEmpGender+"&EmpStatus="+mEmpStatus+"&EmpReligion="+mEmpReligion+"&EmpMonth="+mEmpMonth+"&EmpDay="+mEmpDay+"&EmpYear="+mEmpYear+"&EmpHeight="+mEmpHeight+"&EmpWeight="+mEmpWeight+"&EmpHomeAddress="+mEmpHomeAddress+"&EmpCollege="+mEmpCollege+"&EmpYrlvlc="+mEmpYrlvlc+"&EmpHighSchool="+mEmpHighSchool+"&EmpYrlvlh="+mEmpYrlvlh+"&EmpElementary="+mEmpElementary+"&EmpYrlvle="+mEmpYrlvle;
			
			ajaxRequest.open("POST","employee_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);
				
				$.ajax
			({
			 url:"employee_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","employee_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	
}

function employee_updaterecord()
{

			var mEmpNumber = eval('document.frmEmployee.EmpNumbername.value;');
			var mEmpFirstName = eval('document.frmEmployee.EmpFirstNamename.value;');
			var mEmpMiddleName = eval('document.frmEmployee.EmpMiddleNamename.value;');
			var mEmpLastName = eval('document.frmEmployee.EmpLastNamename.value;');
			var mEmpEmail = eval('document.frmEmployee.EmpEmailname.value;');
			var mEmpCPNumber = eval('document.frmEmployee.EmpCPNumbername.value;');
			var mEmpMONumber = eval('document.frmEmployee.EmpMobileNumbername.value;');
			var mEmpGender = eval('document.frmEmployee.EmpGendername.value;');
			var mEmpStatus = eval('document.frmEmployee.EmpStatusname.value;');
			var mEmpReligion = eval('document.frmEmployee.EmpReligionname.value;');
			var mEmpMonth = eval('document.frmEmployee.EmpMonthname.value;');
			var mEmpDay = eval('document.frmEmployee.EmpDayname.value;');
			var mEmpYear = eval('document.frmEmployee.EmpYearname.value;');
	
			var mEmpWeight = eval('document.frmEmployee.EmpWeightname.value;');
			var mEmpHomeAddress = eval('document.frmEmployee.EmpHomeAddressname.value;');
			var mEmpCollege = eval('document.frmEmployee.EmpCollegename.value;');
			var mEmpYrlvlc = eval('document.frmEmployee.EmpSYCollegename.value;');
			var mEmpHighSchool = eval('document.frmEmployee.EmpHighSchoolname.value;');
			var mEmpYrlvlh = eval('document.frmEmployee.EmpSYHighname.value;');
			var mEmpElementary = eval('document.frmEmployee.EmpElementaryname.value;');
			var mEmpYrlvle = eval('document.frmEmployee.EmpSYElemname.value;');
			
			
		
			
			
			var ajaxRequest = getAjaxRequest();
			
			
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber="+mEmpNumber+"&EmpFirstName="+mEmpFirstName+"&EmpMiddleName="+mEmpMiddleName+"&EmpLastName="+mEmpLastName+"&EmpEmail="+mEmpEmail+"&EmpCPNumber="+mEmpCPNumber+"&EmpMONumber="+mEmpMONumber+"&EmpGender="+mEmpGender+"&EmpStatus="+mEmpStatus+"&EmpReligion="+mEmpReligion+"&EmpMonth="+mEmpMonth+"&EmpDay="+mEmpDay+"&EmpYear="+mEmpYear+"&EmpHeight="+mEmpHeight+"&EmpWeight="+mEmpWeight+"&EmpHomeAddress="+mEmpHomeAddress+"&EmpCollege="+mEmpCollege+"&EmpYrlvlc="+mEmpYrlvlc+"&EmpHighSchool="+mEmpHighSchool+"&EmpYrlvlh="+mEmpYrlvlh+"&EmpElementary="+mEmpElementary+"&EmpYrlvle="+mEmpYrlvle;
			
			ajaxRequest.open("POST","employee_update.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);


}


function employee_update()
{

			var mEmpNumber = eval('document.frmEmployee.EmpNumbername.value;');
			var mEmpFirstName = eval('document.frmEmployee.EmpFirstNamename.value;');
			var mEmpMiddleName = eval('document.frmEmployee.EmpMiddleNamename.value;');
			var mEmpLastName = eval('document.frmEmployee.EmpLastNamename.value;');
			var mEmpEmail = eval('document.frmEmployee.EmpEmailname.value;');
			var mEmpCPNumber = eval('document.frmEmployee.EmpCPNumbername.value;');
			var mEmpMONumber = eval('document.frmEmployee.EmpMobileNumbername.value;');
			var mEmpGender = eval('document.frmEmployee.EmpGendername.value;');
			var mEmpStatus = eval('document.frmEmployee.EmpStatusname.value;');
			var mEmpReligion = eval('document.frmEmployee.EmpReligionname.value;');
			var mEmpMonth = eval('document.frmEmployee.EmpMonthname.value;');
			var mEmpDay = eval('document.frmEmployee.EmpDayname.value;');
			var mEmpYear = eval('document.frmEmployee.EmpYearname.value;');
                        var mEmpHeight=$("#EmpHeightid").val();
			var mEmpWeight = eval('document.frmEmployee.EmpWeightname.value;');
			var mEmpHomeAddress = eval('document.frmEmployee.EmpHomeAddressname.value;');
			var mEmpCollege = eval('document.frmEmployee.EmpCollegename.value;');
			var mEmpYrlvlc = eval('document.frmEmployee.EmpSYCollegename.value;');
			var mEmpHighSchool = eval('document.frmEmployee.EmpHighSchoolname.value;');
			var mEmpYrlvlh = eval('document.frmEmployee.EmpSYHighname.value;');
			var mEmpElementary = eval('document.frmEmployee.EmpElementaryname.value;');
			var mEmpYrlvle = eval('document.frmEmployee.EmpSYElemname.value;');
			
			

			
			
			
			if ( mEmpNumber == "" || mEmpFirstName == "" || mEmpMiddleName =="" || mEmpLastName =="" || mEmpEmail =="" || mEmpCPNumber == "" || mEmpMONumber == "" || mEmpGender == "" || mEmpStatus == "" || mEmpReligion == "" || mEmpReligion == "" || mEmpMonth == "" || mEmpDay == "" || mEmpYear == "" || mEmpHeight == "" || mEmpWeight == "" || mEmpHomeAddress == "" || mEmpCollege == "" || mEmpYrlvlc == "" || mEmpHighSchool == "" || mEmpYrlvlh == "" || mEmpElementary == "" || mEmpYrlvle == "")
			{
				alert("Invalid Data Entry");
				return false;
			}
			{


			var ajaxRequest = getAjaxRequest();



			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber="+mEmpNumber+"&EmpFirstName="+mEmpFirstName+"&EmpMiddleName="+mEmpMiddleName+"&EmpLastName="+mEmpLastName+"&EmpEmail="+mEmpEmail+"&EmpCPNumber="+mEmpCPNumber+"&EmpMONumber="+mEmpMONumber+"&EmpGender="+mEmpGender+"&EmpStatus="+mEmpStatus+"&EmpReligion="+mEmpReligion+"&EmpMonth="+mEmpMonth+"&EmpDay="+mEmpDay+"&EmpYear="+mEmpYear+"&EmpHeight="+mEmpHeight+"&EmpWeight="+mEmpWeight+"&EmpHomeAddress="+mEmpHomeAddress+"&EmpCollege="+mEmpCollege+"&EmpYrlvlc="+mEmpYrlvlc+"&EmpHighSchool="+mEmpHighSchool+"&EmpYrlvlh="+mEmpYrlvlh+"&EmpElementary="+mEmpElementary+"&EmpYrlvle="+mEmpYrlvle;

			ajaxRequest.open("POST","employee_update.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);
                        $.ajax
			({
			 url:"employee_ajax.php",
			 success:function(response)
			 {
				var ajaxRequest = getAjaxRequest();
				ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('Table');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortTable()

						}
				}




			var param= "";
			ajaxRequest.open("POST","employee_ajax.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    	ajaxRequest.send(param);


			 }


			 });
				$("#fancybox-wrap, #fancybox-overlay").fadeOut();	
			}


}

















function employee_edit(mEmpNumber)
{
			mEmpNumber = mEmpNumber.toString();

			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber=" + escape(mEmpNumber);
			ajaxRequest.open("POST","employee_edit.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			
	     		ajaxRequest.send(param); 


}

function employee_()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "";
			ajaxRequest.open("POST","employee_.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 

}
function employee_print()
{
}

/* upload employee photo*/
function uploadPhoto()
{
	var uploadPhoto=eval(document.getElementById('uploadFile').value);
	alert(uploadPhoto);
	
	var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}
				alert('asdf');

			var param= "uploadPhoto=" + uploadPhoto;
			ajaxRequest.open("POST","employeesave_upload.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param); 
}




/*User  script*/
function user_search()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
							
						}
				}

			var param= "";
			ajaxRequest.open("POST","user_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);

}
function user_()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "";
			ajaxRequest.open("POST","user_.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 

}
function user_save()
{
			var mEmpNumber = eval('document.frmUser.EmpNumberid.value;');
			var mEmpUserName = eval('document.frmUser.EmpUserNamename.value;');
			var mEmpPassword = eval('document.frmUser.EmpPasswordname.value;');
			var mEmpPassword_ = eval('document.frmUser.EmpPasswordname_.value;');
			mEmpNumber = mEmpNumber.trim();
			mEmpUserName = mEmpUserName.trim();
			mEmpPassword = mEmpPassword.trim();
			mEmpPassword = mEmpPassword_.trim();

			if (mEmpPassword==mEmpPassword_)
			{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}
			var param= "EmpNumber=" + mEmpNumber + "&EmpUserName=" + mEmpUserName + "&EmpPassword= " + mEmpPassword;
			ajaxRequest.open("POST","user_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			$.ajax
			({
			 url:"user_search.php",
			 success:function(response)
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
			var param= "";
			ajaxRequest.open("POST","user_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });

			}
			else
			{
				alert("Password Does not Match");
			}

}

function user_update()
{
			var mEmpNumber = eval('document.frmUser.EmpNumberid.value;');
			var mEmpUserName = eval('document.frmUser.EmpUserNamename.value;');
			var mEmpPassword = eval('document.frmUser.EmpPasswordname.value;');
			var mEmpPassword_ = eval('document.frmUser.EmpPasswordname_.value;');
			mEmpNumber = mEmpNumber.trim();
			mEmpUserName = mEmpUserName.trim();
			mEmpPassword = mEmpPassword.trim();
			mEmpPassword = mEmpPassword_.trim();

			if (mEmpPassword==mEmpPassword_)
			{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}
			var param= "EmpNumber=" + mEmpNumber + "&EmpUserName=" + mEmpUserName + "&EmpPassword= " + mEmpPassword;
			ajaxRequest.open("POST","user_update.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);
			}
			else
			{
				alert("Password Does not Match");
			}

}
/* this function verify if new password and password confirm are match*/

function user_check()
{
			var mEmpNumber = eval('document.frmUser.EmpNumberid.value;');
			var mEmpUserName = eval('document.frmUser.EmpUserNamename.value;');
			var mEmpPassword = eval('document.frmUser.EmpPasswordname.value;');
			var mEmpPassword_ = eval('document.frmUser.EmpPasswordname_.value;');

			if ( mEmpNumber == "" || mEmpUserName == "" || mEmpPassword =="" || mEmpPassword_ =="")
			{
				alert("Invalid Data Entry");
				return false;
			}

			if (mEmpPassword!=mEmpPassword_)
			{
				alert("Password did'nt Match");
				return;
				
			}
			{
				$("#fancybox-wrap, #fancybox-overlay").fadeOut();
				user_update();
						 
			}


}


function usercreate_check()
{
			var mEmpNumber = eval('document.frmUser.EmpNumberid.value;');
			var mEmpUserName = eval('document.frmUser.EmpUserNamename.value;');
			var mEmpPassword = eval('document.frmUser.EmpPasswordname.value;');
			var mEmpPassword_ = eval('document.frmUser.EmpPasswordname_.value;');

			if ( mEmpNumber == "" || mEmpUserName == "" || mEmpPassword =="" || mEmpPassword_ =="")
			{
				alert("Invalid Data Entry");
				return false;
			}
				if (mEmpPassword!=mEmpPassword_)
			{
				alert("Password did'nt Match");
				return;
				
			}
			{
				$("#fancybox-wrap, #fancybox-overlay").fadeOut();
				user_save();
						 
			}


}


function user_edit(mEmpNumber)
{

			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber=" + mEmpNumber;
			ajaxRequest.open("POST","user_edit.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 


}
function user_delete(mEmpNumber)
{

			mEmpNumber = mEmpNumber.toString();
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							user_search();
						}
				}

			var param= "EmpNumber=" + escape(mEmpNumber);
			ajaxRequest.open("POST","user_delete.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 


}
function user_print()
{
}





/*User Main Module Access  script*/
function usermainmodule_search()
{

			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}

			var param= "";
			ajaxRequest.open("POST","usermainmodule_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 

}
function usermainmodule_(mEmpNumber)
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber="+mEmpNumber;
			ajaxRequest.open("POST","usermainmodule_.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 

}
function usersubmodule_create(mEmpNumber)
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber="+ mEmpNumber;
			ajaxRequest.open("POST","usersubmodule_create.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 

}
function usercommand_create(mEmpNumber)
{

			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber="+ mEmpNumber;
			ajaxRequest.open("POST","usercommand_create.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 

}



function usermainmodule_save()
{
	
	var mEmpNumber = eval('document.frmUserMainModule.EmpNumberid.value;');
	var mMenuCode = eval('document.frmUserMainModule.MenuCodeid.value;');
	
	var mMenuCodeSplit = mMenuCode.split("|");
	var mMenuCodeS='';
	var mMenuCodeSelect='';
	var mMenuCode2='';
	var mValues ="";

try
{
	for(i = 0; i < mMenuCodeSplit.length; i++)
	{
		mMenuCodeSelect = eval('document.getElementById("frmUserMainModule").'+ mMenuCodeSplit[i].toString() +'.checked;');
		mMenuCodeSelect = mMenuCodeSelect.toString();
		mMenuCodeS =mMenuCodeSplit[i].toString();
				if (mMenuCodeSelect =='true')
				{
					mValues =mValues+'("'+mEmpNumber+'","'+mMenuCodeS+'"),';
				}
	}
			mValues = mValues.substring(0,mValues.length -1);
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber=" + mEmpNumber + "&Values=" + mValues;
			ajaxRequest.open("POST","usermainmodule_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);

}
catch (error)
{
mValues = mValues.substring(0,mValues.length -1);
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}
			var param= "EmpNumber=" + mEmpNumber + "&MenuCode=" + mMenuCode2 + "& Values=" + mValues;
			ajaxRequest.open("POST","usermainmodule_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);



}

}


function usermainmodule_check()
{
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();
		usermainmodule_save();


}

function usermainmodule_print()
{
	
	
}



























/*User Sub Module Access  script*/
function usersubmodule_search()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}

			var param= "";
			ajaxRequest.open("POST","usersubmodule_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
}
function usersubmodule_(mEmpNumber)
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber="+ mEmpNumber;
			ajaxRequest.open("POST","usersubmodule_.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 

}


function usersubmodule_save()
{
	var mEmpNumber = eval('document.frmUserSubMenu.EmpNumberid.value;');
	var mSubMenu = eval('document.frmUserSubMenu.SubMenuid.value;');
	var mSubMenuSplit = mSubMenu.split("|");
	var mSubMenuS='';
	var mSubMenuSelect='';
	var mSubMenu2='';
	var mValues ="";

try
{

	k=0;
	for(i = 1; i < mSubMenuSplit.length; i++)
	{
		mSubMenuSelect = eval('document.getElementById("frmUserSubMenu").'+ mSubMenuSplit[i].toString() +'.checked;');
		mSubMenuSelect = mSubMenuSelect.toString();
		mSubMenuS =mSubMenuSplit[i].toString();
				if (mSubMenuSelect =='true')
				{
					mMenuSelect = mSubMenuSplit[k].toString();
					mValues =mValues+'("'+mEmpNumber+'","'+mMenuSelect+'","'+mSubMenuS+'"),';
				}
		i=i+1;
		k=k+2;
	}
	mValues = mValues.substring(0,mValues.length -1);

			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber=" + mEmpNumber +  "&Values=" + escape(mValues);
			ajaxRequest.open("POST","usersubmodule_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);

}
catch (error)
{
	alert(error);
	mValues = mValues.substring(0,mValues.length -1);
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber=" + mEmpNumber +  "& Values=" + escape(mValues);
			ajaxRequest.open("POST","usermainmodule_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);

}

}

function usersubmodule_check()
{
	usersubmodule_save()
	$("#fancybox-wrap, #fancybox-overlay").fadeOut();		
}
function usersubmodule_print()
{
}



/*User Command Access  script*/
function usercommand_search()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}

			var param= "";
			ajaxRequest.open("POST","usercommand_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
}

function usercommand_(mEmpNumber)
{

			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber="+ mEmpNumber;
			ajaxRequest.open("POST","usercommand_.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 

}


function usercommand_save()
{
	var mEmpNumber = eval('document.frmUserCommand.EmpNumberid.value;');
	var mCmdName = eval('document.frmUserCommand.CmdName.value;');
	var mCmdName_ = eval('document.frmUserCommand.CmdName_.value;');
	var mCmdNameSplit = mCmdName.split("|");
	var mCmdNameSplit_ = mCmdName_.split("|");
	var mCmdNameS='';
	var mCmdNameSelect='';
	var mCmdName2='';
	var mValues ="";
	var mValues_ ="";
	var mValues__ ="";
	var mSingleQuote ="'";
	var mName ="";
	var mName_ ="";
	var mGCmdNameSplit ="";
	

try
{
	for(i = 0; i < mCmdNameSplit_.length; i++)
	{
		mGCmdNameSplit = mCmdNameSplit_[i].split("*");
		for(j = 0; j < mGCmdNameSplit.length; j++)
		{
			mName = mName+mGCmdNameSplit[j].toString();
			

		}
			if (mName!="")
			{
			mCmdNameSelect = eval('document.getElementById("frmUserCommand").'+mName+'.checked;');
			
			mName="";
			 mCmdNameSelect = mCmdNameSelect.toString();
			
				if (mCmdNameSelect == 'true')
				{	
					
					mGCmdNameSplit_ = mCmdNameSplit_[i].split("*");
					mValues_="";
					for(n = 0; n < mGCmdNameSplit_.length; n++)
					{
						if (mGCmdNameSplit_[n].toString() !="")
						{
						mValues_=mValues_+'"'+mGCmdNameSplit_[n].toString()+'",';
						}
					}
						mValues_ = mValues_.substring(0,mValues_.length -1);
						mValues__ =mValues__+'("'+mEmpNumber+'",'+mValues_+'),';
				}
			wmCmdNameSelect ="";
			
			}
			
	}
		
	mValues__ = mValues__.substring(0,mValues__.length -1);
		
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}
			var param= "EmpNumber=" + mEmpNumber +  "&Values=" + mValues__;
			ajaxRequest.open("POST","usercommand_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);

}

catch (error)
{
	alert("ERROR" + error);
	mValues = mValues.substring(0,mValues.length -1);
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "EmpNumber=" + mEmpNumber +  "& Values=" + mValues;
			ajaxRequest.open("POST","usercommand_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);

}

}
function usercommand_check()
{
	
	usercommand_save()
	$("#fancybox-wrap, #fancybox-overlay").fadeOut();		
}
function usercommand_print()
{
}




function group_check()
{
	try{
			var itemnumber = eval('document.frmGroup.itemnumbername.value;');
			var itemname = eval('document.frmGroup.itemnamename.value;');
			var groupname = eval('document.frmGroup.groupnamename.value;');
			var uomone = eval('document.frmGroup.uomonename.value;');
			var uomtwo = eval('document.frmGroup.uomtwoname.value;');
			var uomtre = eval('document.frmGroup.uomtrename.value;');
			var uomfour = eval('document.frmGroup.uomfourname.value;');
			var uomfive = eval('document.frmGroup.uomfivename.value;');
			
			
			var uomsix = eval('document.frmGroup.uomsixname.value;');
			var uomqone = eval('document.frmGroup.uomqone.value;');
			var uomqtwo = eval('document.frmGroup.uomqtwo.value;');
			var uomqtre = eval('document.frmGroup.uomqtre.value;');
			var uomqfour = eval('document.frmGroup.uomqfour.value;');
			var uomqfive = eval('document.frmGroup.uomqfive.value;');
			
			
			var uomqsix = eval('document.frmGroup.uomqsix.value;');
			
			
			
			var pricetenONE = eval('document.frmGroup.pricetenone.value;');
			var pricetenTWO = eval('document.frmGroup.pricetentwo.value;');
			var pricetenTRE = eval('document.frmGroup.pricetentre.value;');
			var pricetenFOUR = eval('document.frmGroup.pricetenfour.value;');
			var pricetenFIVE = eval('document.frmGroup.pricetenfive.value;');
			var pricetenSIX = eval('document.frmGroup.pricetensix.value;');
			var descriptionONE = eval('document.frmGroup.descriptionone.value;');
			var descriptionTWO = eval('document.frmGroup.descriptiontwo.value;');
			var descriptionTRE = eval('document.frmGroup.descriptiontre.value;');
			var descriptionFOUR = eval('document.frmGroup.descriptionfour.value;');
			var descriptionFIVE = eval('document.frmGroup.descriptionfive.value;');
			var descriptionSIX = eval('document.frmGroup.descriptionsix.value;');
			var priceONE = eval('document.frmGroup.priceone.value;');
			var priceTWO = eval('document.frmGroup.pricetwo.value;');
			var priceTRE = eval('document.frmGroup.pricetre.value;');
			var priceFOUR = eval('document.frmGroup.pricefour.value;');
			var priceFIVE = eval('document.frmGroup.pricefive.value;');
			var priceSIX = eval('document.frmGroup.pricesix.value;');
																						
			
			
			
			
			
			if ( itemnumber == "" || itemname == "" || groupname =="" || uomone =="" || uomtwo =="" || uomtre =="" || uomfour =="" || uomfive =="" || uomsix =="" || uomqone == "" || uomqtwo == "" || uomqtre == "" || uomqfour == "" || uomqfive == "" || uomqsix == "" || pricetenONE == "" || pricetenTWO == "" || pricetenTRE == "" || pricetenFOUR == "" || pricetenFIVE == "" || pricetenSIX == "" || descriptionONE == "" || descriptionTWO == "" || descriptionTRE == "" || descriptionFOUR == "" || descriptionFIVE == "" || descriptionSIX == "" || priceONE == "" || priceTWO == "" || priceTRE == "" || priceFOUR == "" || priceFIVE == "" || priceSIX == "")
			{
				alert("Invalid Data Entry");
				return false;
			}
			{
				group_save();
			}

	}
	catch (exception)
	{
	alert(exception);
	}
}









function group_save()
{


			var itemnumber = eval('document.frmGroup.itemnumbername.value;');
			var itemname = eval('document.frmGroup.itemnamename.value;');
			var groupname = eval('document.frmGroup.groupnamename.value;');
			var uomone = eval('document.frmGroup.uomonename.value;');
			var uomtwo = eval('document.frmGroup.uomtwoname.value;');
			var uomtre = eval('document.frmGroup.uomtrename.value;');
			var uomfour = eval('document.frmGroup.uomfourname.value;');
			var uomfive = eval('document.frmGroup.uomfivename.value;');
			var uomsix = eval('document.frmGroup.uomsixname.value;');
			
			var uomqone = eval('document.frmGroup.uomqone.value;');
			var uomqtwo = eval('document.frmGroup.uomqtwo.value;');
			var uomqtre = eval('document.frmGroup.uomqtre.value;');
			var uomqfour = eval('document.frmGroup.uomqfour.value;');
			var uomqfive = eval('document.frmGroup.uomqfive.value;');
			
			
			
			var uomqsix = eval('document.frmGroup.uomqsix.value;');
			

			var pricetenONE = eval('document.frmGroup.pricetenone.value;');
			var pricetenTWO = eval('document.frmGroup.pricetentwo.value;');
			var pricetenTRE = eval('document.frmGroup.pricetentre.value;');
			var pricetenFOUR = eval('document.frmGroup.pricetenfour.value;');
			var pricetenFIVE = eval('document.frmGroup.pricetenfive.value;');
			var pricetenSIX = eval('document.frmGroup.pricetensix.value;');
			var descriptionONE = eval('document.frmGroup.descriptionone.value;');
			var descriptionTWO = eval('document.frmGroup.descriptiontwo.value;');
			var descriptionTRE = eval('document.frmGroup.descriptiontre.value;');
			var descriptionFOUR = eval('document.frmGroup.descriptionfour.value;');
			var descriptionFIVE = eval('document.frmGroup.descriptionfive.value;');
			var descriptionSIX = eval('document.frmGroup.descriptionsix.value;');
			var priceONE = eval('document.frmGroup.priceone.value;');
			var priceTWO = eval('document.frmGroup.pricetwo.value;');
			var priceTRE = eval('document.frmGroup.pricetre.value;');
			var priceFOUR = eval('document.frmGroup.pricefour.value;');
			var priceFIVE = eval('document.frmGroup.pricefive.value;');
			var priceSIX = eval('document.frmGroup.pricesix.value;');
			
			
			
			
			
			
			
			
			
			
			var ajaxRequest = getAjaxRequest();
			
			
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "Itemnumber="+itemnumber+"&Itemname="+itemname+"&Groupname="+groupname+"&Uomone="+uomone+"&Uomtwo="+uomtwo+"&Uomtre="+uomtre+"&Uomfour="+uomfour+"&Uomfive="+uomfive+"&Uomsix="+uomsix+"&UomQone="+uomqone+"&UomQtwo="+uomqtwo+"&UomQtre="+uomqtre+"&UomQfour="+uomqfour+"&UomQfive="+uomqfive+"&UomQsix="+uomqsix+"&pricetenone="+pricetenONE+"&pricetentwo="+pricetenTWO+"&pricetentre="+pricetenTRE+"&pricetenfour="+pricetenFOUR+"&pricetenfive="+pricetenFIVE+"&pricetensix="+pricetenSIX+"&descriptionone="+descriptionONE+"&descriptiontwo="+descriptionTWO+"&descriptiontre="+descriptionTRE+"&descriptionfour="+descriptionFOUR+"&descriptionfive="+descriptionFIVE+"&descriptionsix="+descriptionSIX+"&priceone="+priceONE+"&pricetwo="+priceTWO+"&pricetre="+priceTRE+"&pricefour="+priceFOUR+"&pricefive="+priceFIVE+"&pricesix="+priceSIX;
			
			ajaxRequest.open("POST","group_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
}














function group_()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}

			var param= "";
			ajaxRequest.open("POST","product_group_.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);

}










function item_group_check()
{

	try{
			var groupnumname = eval('document.fRmGroupItem.group_number_name.value;');
			var groupname = eval('document.fRmGroupItem.group_name_name.value;');

			
			
			
			if (groupnumname == "" || groupname == "")
			{
				alert("Invalid Data Entry");
				return false;
			}
			{
				item_group_save();
			}

	}
	catch (exception)
	{
	alert(exception);
	}
}



function item_group_save()
{
			var groupnumname = eval('document.fRmGroupItem.group_number_name.value;');
			var groupname = eval('document.fRmGroupItem.group_name_name.value;');
	
			
			
			var ajaxRequest = getAjaxRequest();
			
			
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "ItemGroupNumber="+groupnumname+"&ItemGroupName="+groupname;
			
			ajaxRequest.open("POST","process.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);


}





function Group_Number_delete(GroupDelete)
{			
			GroupDelete = GroupDelete.toString();
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							Group_search();
						}
				}
			var param= "GroupNumber=" + escape(GroupDelete);
			ajaxRequest.open("POST","Group_Delete.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
}


function Group_search()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}
			var param= "";
			ajaxRequest.open("POST","itemgroup_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
}


function Group_Number_Edit(GroupEdit)
{
			GroupEdit = GroupEdit.toString();

			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "GroupNumber=" + escape(GroupEdit);
			ajaxRequest.open("POST","group_edit.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			
	     		ajaxRequest.send(param);


}


function Product_Group_Update()
{

	try{
			var GroupNumber = eval('document.fRmGroupItem.group_number_name.value;');
			var GroupName = eval('document.fRmGroupItem.group_name_name.value;');

			
			
			
			if ( GroupNumber == "" || GroupName == "")
			{
				alert("Invalid Data Entry");
				return false;
			}
			{
				employee_updaterecord();
			}

	}
	catch (exception)
	{
	alert(exception);
	}
}
function Product_Group_Update()
{

			var GroupNumber = eval('document.fRmGroupItem.group_number_name.value;');
			var GroupName = eval('document.fRmGroupItem.group_name_name.value;');
			
		
			
			
			var ajaxRequest = getAjaxRequest();
			
			
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "GroupNumber="+GroupNumber+"&GroupName="+GroupName;
			
			ajaxRequest.open("POST","product_group_update.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);


}
   
function ajax_groupto(){

	var hr = new XMLHttpRequest();

	var url = "processto.php";
	var groupname = document.getElementById("group_name_id").value;
	var submitid = document.getElementById("submitid").value;
	
	
	
	
	

	var vars = "GroupName="+groupname+"&SubmitId="+submitid;
	hr.open("POST", url, true);
	
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	hr.onreadystatechange = function(){
	
	if(hr.readyState == 4 && hr.status == 200){
		var return_data = hr.responseText;
		document.getElementById("status").innerHTML = return_data;
	
	}
	
	}
hr.send(vars);
document.getElementById("status").innerHTML;
}


function Grouping_save()
{

			var Groupname = eval('document.frmGroups.group_name_name.value;');
			
			var ajaxRequest = getAjaxRequest();
			
			
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							Grouping_search();
						}
				}

			var param= "GroupName="+Groupname;
			
			ajaxRequest.open("POST","insert_group.php",true);
			
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);


}





function Grouping_search()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}
			var param= "";
			ajaxRequest.open("POST","product_group_.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
}


function Grouping_check()
{

	try{
			var Groupname = eval('document.frmGroups.group_name_name.value;');
			
			
			if (Groupname == "")
			{
				alert("Invalid Data Entry");
				return false;
			}
			{
				Grouping_save();
			}

	}
	catch (exception)
	{
	alert(exception);
	}
}






function GoTo_Search()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}
			var param= "";
			ajaxRequest.open("POST","employee_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
}




function GoTo_GroupSearch()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}
			var param= "";
			ajaxRequest.open("POST","itemgroup_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
}





function Group_Delete_to(GroupDelete)
{			
			GroupDelete = GroupDelete.toString();
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							Groupelete();
						}
				}
			var param= "GroupNumber=" + escape(GroupDelete);
			ajaxRequest.open("POST","Group_Delete.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
}
function Groupelete()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}
			var param= "";
			ajaxRequest.open("POST","product_group_.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
}





function Group_Edit_Number(GroupEditNum)
{
			GroupEditNum = GroupEditNum.toString();

			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}

			var param= "groupeditnum=" + escape(GroupEditNum);
			ajaxRequest.open("POST","Group_Edit_Name.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			
	     		ajaxRequest.send(param); 
}

function Grouping_Update_check()
{

	try{
			var Group_Edit_Name = eval('document.frmGroupsEdit.group_edit_name.value;');
			var Group_Edit_id = eval('document.frmGroupsEdit.group_editid_name.value;');

			

			
			
			
			if ( Group_Edit_Name == "")
			{
				alert("Invalid Data Entry");
				return false;
			}
			{
				Group_Update_process();
			}

	}
	catch (exception)
	{
	alert(exception);
	}
}







function Group_Update_process()
{
			var Group_Edit_Name = eval('document.frmGroupsEdit.group_edit_name.value;');
			var Group_Edit_id = eval('document.frmGroupsEdit.group_editid_name.value;');

			
		
			
			
			var ajaxRequest = getAjaxRequest();
			
			
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							linkGroupEditName();
						}
				}

			var param= "Group_Edit_Name="+Group_Edit_Name+"&Group_Edit_id="+Group_Edit_id;
			
			ajaxRequest.open("POST","product_group_update.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param);


}


function linkGroupEditName()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							sortables_init()
						}
				}
			var param= "";
			ajaxRequest.open("POST","Group_Edit_Name.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
}





/*MAIN MENU SCRIPT*/
function mainmenu_search()
{
	var mMenuCode = eval('document.frmmainmenu.menucodename.value;');
	var mMenuName = eval('document.frmmainmenu.menunamename.value;');
			
	var ajaxRequest = getAjaxRequest();
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "MenuCode="+mMenuCode+"&MenuName="+mMenuName;
			ajaxRequest.open("POST","menu_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     		ajaxRequest.send(param);

			
}
function mainmenu_(mMenuCode,mMenuName,mOperationMode)
{
		//alert(mMenuCode + "--" + mMenuName + "--" +mOperationMode);
		var ajaxRequest = getAjaxRequest();
			
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}

			var param= "MenuCode="+mMenuCode+"&MenuName="+mMenuName+"&OperationMode="+mOperationMode;
			ajaxRequest.open("POST","menu_.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     		ajaxRequest.send(param);
}
function mainmenu_delcheckbox()
{
	var mRec = document.frmmainmenu.hidTotRecname.value;
	for (i = 1; i <= mRec; i++) 
				{
							if (eval('document.frmmainmenu.delcheckboxname.checked;'))
								{
									document.getElementById("select"+i+"id").checked=true;
								}
							else
								{
									document.getElementById("select"+i+"id").checked=false;
								}
				}
}
function mainmenu_delete()
{
	
	if (confirm("Do you want to delete the selected records?"))
	{
	
	var mRec = document.frmmainmenu.hidTotRecname.value;
	var mValue ="('";
	for (i = 1; i <= mRec; i++) 
		{
			if (eval('document.frmmainmenu.select'+i+'name.checked;'))
				{
					mValue = mValue + eval('document.frmmainmenu.MenuCode'+i+'name.value;') + "'," + "'";
				}
			}
		
			mValue = mValue.substring(0,mValue.length -2) + ")";
			document.write(mValue);
			
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('contents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
				}
			var param= "Values="+mValue;
			ajaxRequest.open("POST","menu_delete.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajaxRequest.send(param);			
	}
	else
	{
		//alert("cancel delete");
	}
}
function mainmenu_insertrow()
{

		//prevent insert duplicate records
		//loop to find a match records
		var table = document.getElementById('anyid');
        var rowCount = table.rows.length;
		
		var mMenuCode = document.getElementById('MenuCodeid').value;
	    var mMenuName = document.getElementById('MenuNameid').value;  
		for(var i=2; i<rowCount; i++) {
                var row = table.rows[i];
                var vMenuCode = row.cells[3].childNodes[0].textContent;
                if(mMenuCode == vMenuCode) {
					alert(mMenuCode + " Already Exist!");
					return;
				}
			}	
		if(mMenuCode == "")
		{
			alert("Invalid Entry!");
			return;
		}
		if(mMenuName == "")
		{
			alert("Invalid Entry!");
			return;
		}
		
		

		var table = document.getElementById('anyid');
		var rowCount = table.rows.length;
		var row = table.insertRow(rowCount);
		
		var cell0 = row.insertCell(0);
        cell0.innerHTML = rowCount + 1 - 2;
		
		var cell1 = row.insertCell(1);
        var element1 = document.Element("input");
        element1.type = "checkbox";
        cell1.appendChild(element1);
		
		var cell2 = row.insertCell(2);
        var element2 = document.Element("input");
        element2.type = "hidden";
		element2.value ="Help Hidden";
        cell2.appendChild(element2);
		
		var cell3 = row.insertCell(3);
        cell3.innerHTML = document.getElementById('MenuCodeid').value;
												
		var cell4 = row.insertCell(4);
		cell4.innerHTML = document.getElementById('MenuNameid').value;
		
		var cell5 = row.insertCell(5);
        cell5.innerHTML = rowCount + 1 - 2;
		
		//clear the entry box
		document.getElementById('MenuCodeid').value="";
		document.getElementById('MenuNameid').value="";


}
function mainmenu_updaterow()
{
	try
	{
			var mMenuCode = document.getElementById('MenuCodeid').value;
	        var table = document.getElementById('anyid');
            var rowCount = table.rows.length;
 
            for(var i=2; i<rowCount; i++) {
                var row = table.rows[i];
                var vMenuCode = row.cells[3].childNodes[0].textContent;
                if(mMenuCode == vMenuCode) {
					row.cells[4].childNodes[0].textContent = document.getElementById('MenuNameid').value;
					
				}
			}
		document.getElementById('Insertid').value="Insert Records";		
		document.getElementById('Insertid').onclick = function(){mainmenu_insertrow()};
		
		//clear the entry box
		document.getElementById('MenuCodeid').value="";
		document.getElementById('MenuNameid').value="";

	}catch(e){
		alert(e.message);
	}
	

}


function mainmenu_deleterow()
{
           try {
            var table = document.getElementById('anyid');
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[1].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
 
            }
            }catch(e) {
                alert(e.message);
            }
}



function mainmenu_save(mEmployeeID)
{
try{
	var table = document.getElementById('anyid');
	var mValues ="";
	var tRecords = 0;
	for (var i = 2, row; row = table.rows[i]; i++) 
	{
		var MenuCode = row.cells[3].childNodes[0].textContent;
		var MenuName = row.cells[4].childNodes[0].textContent;
		var MenuOrder = row.cells[5].childNodes[0].textContent;
		tRecords = tRecords + 1;
		mValues =mValues + MenuCode + "!" + MenuName + "!" + MenuOrder + "!" + mEmployeeID + "!*";
	}
	var ajaxRequest = getAjaxRequest();
	ajaxRequest.onreadystatechange = function()
		{
			if(ajaxRequest.readyState == 4)
				{
					var ajaxDisplay = document.getElementById('menulocationcontents');
					ajaxDisplay.innerHTML = ajaxRequest.responseText;
				}
		}
		var param= "Values=" + escape(mValues) + "&Records=" + tRecords;
		ajaxRequest.open("POST","menu_saving.php",true);
		ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     	ajaxRequest.send(param);
}
catch(e)
{
	alert(e.message);
}
		
}

function saveProduct()
{
	
			
		var category=$("#cat").val();
		var user=$("#user").val();
		var action="add";
		
		
		
		if(category=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		
		if(isNaN(category)==false)
		{
			
			alert('INVALID ENTRY');
	
			return;
			
		}
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "category="+category+"&user="+user+"&action="+action;
			ajaxRequest.open("POST","saveProduct.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"productCategory.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","productCategory.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	 		
	 
	}
function updateProduct()
{
	var catUpdate=$("#cat").val();
	var action="update";
	var id=$("#result").val();
	
	if(catUpdate=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		
		if(isNaN(catUpdate)==false)
		{
			
			alert('INVALID ENTRY');
	
			return;
			
		}
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
		var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "catUpdate="+catUpdate+"&id="+id+"&action="+action;
			ajaxRequest.open("POST","saveProduct.php?id="+id,true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"productCategory.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","productCategory.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	 		
	 	
}

//--------------------------SET TEXT BOX TO PROPER CASE ------------------------//
function upper(value)
{
	
	document.getElementById(value).value=document.getElementById('priceName').value.toUpperCase();
	
}
//------------------------------SAVE PRICE-------------------------------------//
function savePrice()
{
	
			
		var code=$("#priceCode").val();
		var price=$("#priceName").val();
		var user=$("#user").val();
		var action="add";
		
		if(code.length>=3)
		{
			alert('Price Control code must have at least two character');
			return;
		}
		
		if(code=="" || price=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		
		if(isNaN(code)==true)
		{
			
			alert('INVALID ENTRY');
	
			return;
			
		}
		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&price=" + price + "&user=" + user + "&action=" + action;
			ajaxRequest.open("POST","price_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"price_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","price_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	 		
	 
	}
	
function updatePrice()

{
		
		var code=$("#priceCode").val();
		
		var price=$("#priceName").val();
		var user=$("#user").val();
		var action="update";
		
		if(code=="" || price=="")	
		
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		
		if(isNaN(code)==true)
		{
			
			alert('INVALID ENTRY');
	
			return;
			
		}
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&price=" + price + "&user=" + user + "&action=" + action;
			ajaxRequest.open("POST","price_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"price_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","price_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });

}
function saveMarketing()
{
		var code=$("#marketCode").val();
		var name=$("#marketName").val();
		var user=$("#user").val();
		var action="add";
		
		if(code=="" || name=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		
		
		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&name=" + name + "&user=" + user + "&action=" + action;
			ajaxRequest.open("POST","marketing_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"marketing_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","marketing_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
}
function updateMarketing()
{
		var code=$("#marketCode").val();
		var name=$("#marketName").val();
		var user=$("#user").val();
		var id=$("#result").val();
		var action="update";
		
		if(code == "" || name =="")	
		
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		
	
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&name=" + name + "&user=" + user + "&action=" + action +"&id=" + id;
			ajaxRequest.open("POST","marketing_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"price_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","marketing_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });

	
	
	
}
function uomSave()
{
	
		
		var code=$("#uomCode").val();
		var name=$("#uomName").val();
		var user=$("#user").val();
		var action="add";
		
		if(code=="" || name=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		

		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&name=" + name + "&user=" + user + "&action=" + action;
			ajaxRequest.open("POST","uom_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"uom_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","uom_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	
}

function uomUpdate()
{
		
		var code=$("#uomCode").val();
		
		var name=$("#uomName").val();
		var user=$("#user").val();
		var action="update";
	
		if(code=="" || name=="")	
		
		{
			alert("INVALID ENTRY");
			return;
		}
		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&name=" + name + "&user=" + user + "&action=" + action;
			ajaxRequest.open("POST","uom_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"uom_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","uom_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
}
function upper(text)
{

	document.getElementById(text).value=document.getElementById(text).value.toUpperCase();
	
		
}
function proper(text)
{

	document.getElementById(text).value=document.getElementById(text).value.toProperCase();
	
		
}
function upper1()
{
	document.getElementById('priceName').value=document.getElementById('priceName').value.toUpperCase();
	
}

//------FOR TEXTBOX VALIDATION---//
function oncheckchar(value){
		
	var validString = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ .";
	var checkval = value;
	var allval = true;
	
	
	for (i = 0;  i < checkval.length;  i++)
	{
		
		ch = checkval.charAt(i);
			for (j = 0;  j < validString.length;  j++)
					if (ch == validString.charAt(j))
					break;
							if (j == validString.length)
							{
							allval = false;
							break;
							}
		}

	if (!allval)
	{
	alert("Please Avoid using Numeric Characters.");
	checkval.value="";
	return false;
	}
	
}

function onchecknum(numeric){
		
	var validString = "0123456789";
	var checkval = numeric;
	var allval = true;
	
	
	for (i = 0;  i < checkval.length;  i++)
	{
		
		ch = checkval.charAt(i);
			for (j = 0;  j < validString.length;  j++)
					if (ch == validString.charAt(j))
					break;
							if (j == validString.length)
							{
							allval = false;
							break;
							}
		}

	if (!allval)
	{
	alert("Only Numeric Format are allowed");
	myforminfo.contact.focus();
	return false;
	}
	
}
//-------//


function supplierSave()
{
		var sCode=$("#Code").val();
		var sName=$("#sName").val();
		var user=$("#user").val();
		var sAdd=$("#sAdd").val();
		var sPhone=$("#sPhone").val();
		var sContact=$("#sContact").val();
		var sMobile=$("#sMobile").val();
		var sEmail=$("#sEmail").val();
		var sFax=$("#sFax").val();
		var action="add";
		
		/*check if it is a number*/
		
		if(sCode=="" || snName=="" || sAdd=="" || sPhone=="")
		{
			alert("INVALID ENTRY");
			return;
		}
		
		
					
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				
			var param= "sCode=" + sCode + "&sName=" + sName +"&sAdd=" + sAdd + "&sContact=" + sContact + "&sMobile=" + sMobile + "&sEmail=" + sEmail + "&sFax=" + sFax +  "&user=" + user + "&action=" + action + "&sPhone=" + sPhone;
			ajaxRequest.open("POST","supplier_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"supplier_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","supplier_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });

}
function supplierUpdate()
{		
		var sCode=$("#Code").val();
		var sName=$("#sName").val();
		var user=$("#user").val();
		var sAdd=$("#sAdd").val();
		var sPhone=$("#sPhone").val();
		var sContact=$("#sContact").val();
		var sMobile=$("#sMobile").val();
		var sEmail=$("#sEmail").val();
		var sFax=$("#sFax").val();
		var action="update";
		
		/*check if it is a number*/
		
		
		
		
					
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				
			var param= "sCode=" + sCode + "&sName=" + sName +"&sAdd=" + sAdd + "&sContact=" + sContact + "&sMobile=" + sMobile + "&sEmail=" + sEmail + "&sFax=" + sFax +  "&user=" + user + "&action=" + action + "&sPhone=" + sPhone;
			ajaxRequest.open("POST","supplier_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"supplier_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","supplier_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
}

function saveSalesman()
{
	var mGroup=$("#mGroup option:selected").val();
	var code=$("#salesmanCode").val();
	var name=$("#salesmanName").val();
	var user=$("#user").val();
	var action="add";
	
	if(code=="" || name=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		
		
		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&name=" + name + "&user=" + user + "&action=" + action +"&mGroup=" + mGroup;
			ajaxRequest.open("POST","salesman_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"salesman_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","salesman_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	
	
	
	
	
}


function updateSalesman()
{
	var mGroup=$("#mGroup option:selected").val();
	var code=$("#salesmanCode").val();
	var name=$("#salesmanName").val();
	var user=$("#user").val();
	var action="update";
	
	if(code=="" || name=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		
		
		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&name=" + name + "&user=" + user + "&action=" + action +"&mGroup=" + mGroup;
			ajaxRequest.open("POST","salesman_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"salesman_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","salesman_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	
	
}

function regionSave()
{
	
		
		var code=$("#regionCode").val();
		var name=$("#regionName").val();
		var user=$("#user").val();
		var action="add";
		
		if(code=="" || name=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		

		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&name=" + name + "&user=" + user + "&action=" + action;
			ajaxRequest.open("POST","region_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"region_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","region_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	
}

function regionUpdate()
{
	
		
		var code=$("#regionCode").val();
		var name=$("#regionName").val();
		var user=$("#user").val();
		var action="update";
		
		if(code=="" || name=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		

		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&name=" + name + "&user=" + user + "&action=" + action;
			ajaxRequest.open("POST","region_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"region_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","region_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	
}

//save menu
function saveMenu()
{
	var code=$("#menuCode").val();
		var name=$("#menuName").val();
		var user=$("#user").val();
		var action="add";
		
		if(code=="" || name=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		

		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();	
		
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&name=" + name + "&user=" + user + "&action=" + action;
			ajaxRequest.open("POST","menu_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			   url:"menu_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","menu_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
}
/*-update menu*/
function updateMenu()
{
		var code=$("#menuCode").val();
		var name=$("#menuName").val();
		var user=$("#user").val();
		var action="update";
		
		if(code=="" || name=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		

		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();	
		
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "code=" + code + "&name=" + name + "&user=" + user + "&action=" + action;
			ajaxRequest.open("POST","menu_saving.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			   url:"menu_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","menu_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
}
/*  add new sub menu*/

function saveSubMenu()
{
		var mMenu=$("#mMenu option:selected").val();
		var code=$("#submenuCode").val();
		var name=$("#submenuName").val();
		var page=$("#submenuPage").val();
		var user=$("#user").val();
		var action="add";
		alert(code+name+page);
		if(code=="" || name=="")	
		{
			alert("INVALID ENTRY");
			return;
		}
		
		/*check if it is a number*/
		

		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();	
		
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "mMenu=" + mMenu +"&code=" + code + "&name=" + name + "&page=" + page + "&action=" + action;
			ajaxRequest.open("POST","submenu_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			   url:"submenu_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","submenu_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
}

/*number only*/
 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode

		 if ((charCode > 47 && charCode < 59) || charCode == 46 || charCode == 8 ) {
        return true;
    }
    else {
        return false;
    }
		 
	  }
	  
/*letter only*/
function Alpha(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 127 || charCode == 8 || charCode == 32) {
        return true;
    }
    else {
        return false;
    }
}

/*validate email*/
 function Validate() {
      var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);
      var emailAddress = document.getElementById("EmpEmailid").value;
      var valid = emailRegex.test(emailAddress);
      if (!valid) {
        $("#valid").fadeIn();
        return false;
      } else
	  	$("#valid").fadeOut();
        return true;
    }

function showToolTip()

{
	$("#tooltip").fadeIn();
	a=$("#close").val();
	alert(a);
}

function closeToolTip()

{
	$("#tooltip").slideUp();

}
/* show discount*/
function show()
{
	$("#me").fadeIn();
	$("#me1").fadeIn();
	$(".cmdDiscount").fadeOut();
	
}
/* save outlet*/
function outlet_save()
{
var outletCode=$("#outletCode").val();
var outletName=$("#outletName").val();
var outletAddress=$("#outletAddress").val();
var outletVat=$("#outletVat").val();
var outletTin=$("#outletTin").val();
var outletContactPerson=$("#outletContactPerson").val();
var outletContactNumber=$("#outletContactNumber").val();
var outletInvoice=$("#outletInvoiceType").val();
var outletRegion=$("#regionCode option:selected").val();
var outletPrice=$("#priceCode option:selected").val();
var outletSalesman=$("#salesmanCode option:selected").val();
var discountName=$("#discountName").val();
var discountAmount=$("#discountAmount").val();
var action="add";
var user=$("#user").val();

		
if(outletCode=="" || outletName=="" || outletAddress=="" || outletVat=="" || outletVat=="" || outletTin=="" || outletContactPerson=="" || outletContactNumber=="" || outletInvoice=="")
{
	alert("INVALID ENTRY");
	return false;
}
	action="save";
	$("#fancybox-wrap, #fancybox-overlay").fadeOut();	
		
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "outletCode=" + outletCode 
			+"&outletName=" + outletName 
			+ "&outletAddress=" + outletAddress 
			+"&outletVat=" + outletVat 
			+ "&outletTin=" + outletTin  
			+ "&outletContactPerson=" + outletContactPerson 
			+ "&outletContactNumber=" + outletContactNumber 
		    + "&outletInvoice=" + outletInvoice 
			+ "&outletRegion=" + outletRegion 
			+"&outletPrice=" + outletPrice 
			+"&outletSalesman=" + outletSalesman 
			+ "&user=" + user
			+ "&action=" + action
			;
			ajaxRequest.open("POST","outlet_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			$("#fancybox-wrap, #fancybox-overlay").fadeOut();	
	
			$.ajax
			({
			   url:"outlet_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","outlet_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });

}

/*update outlet*/
function outlet_update()
{
var outletCode=$("#outletCode").val();
var outletName=$("#outletName").val();
var outletAddress=$("#outletAddress").val();
var outletVat=$("#outletVat").val();
var outletTin=$("#outletTin").val();
var outletContactPerson=$("#outletContactPerson").val();
var outletContactNumber=$("#outletContactNumber").val();
var outletInvoice=$("#outletInvoiceType").val();
var outletRegion=$("#regionCode option:selected").val();
var outletPrice=$("#priceCode option:selected").val();
var outletSalesman=$("#salesmanCode option:selected").val();
var discountName=$("#discountName").val();
var discountAmount=$("#discountAmount").val();
var action="";
var user=$("#user").val();

		
if(outletCode=="" || outletName=="" || outletAddress=="" || outletVat=="" || outletVat=="" || outletTin=="" || outletContactPerson=="" || outletContactNumber=="" || outletInvoice=="")
{
	alert("INVALID ENTRY");
	return false;
}
	action="update";
	$("#fancybox-wrap, #fancybox-overlay").fadeOut();	
		
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "outletCode=" + outletCode 
			+"&outletName=" + outletName 
			+ "&outletAddress=" + outletAddress 
			+"&outletVat=" + outletVat 
			+ "&outletTin=" + outletTin  
			+ "&outletContactPerson=" + outletContactPerson 
			+ "&outletContactNumber=" + outletContactNumber 
		    + "&outletInvoice=" + outletInvoice 
			+ "&outletRegion=" + outletRegion 
			+"&outletPrice=" + outletPrice 
			+"&outletSalesman=" + outletSalesman 
			+ "&user=" + user
			+ "&action=" + action
			;
			ajaxRequest.open("POST","outlet_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	
			$("#fancybox-wrap, #fancybox-overlay").fadeOut();	
	
			$.ajax
			({
			   url:"outlet_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","outlet_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });

}


/*save outletDiscount*/
function saveoutletDiscount()
{
        var discountCode=$("#outletCode").val();
	var discountName=$("#discountName").val();
	var discountAmount=$("#discountPercent").val();
	var user=$("#user").val();
	var action="add";

		
		if(discountCode=="" || discountAmount=="")
		{
			alert("INVALID ENTRY");
			return;
		}
				 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "discountCode=" + discountCode + "&discountName=" + discountName + "&discountAmount=" + discountAmount + "&user=" + user +"&action=" + action;
			ajaxRequest.open("POST","outletdiscount_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        ajaxRequest.send(param);
			$.ajax
			
			({
			 url:"outletdiscount_detail.php?discountId="+discountCode,
			 success:function(data)
                         {
                             $.fancybox(data);
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","outlet_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			  
			 });
			
	
}

function deleteDiscount()
{
	
	var discountCode=$("#discountCode").val();
	$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "discountCode=" + discountCode;
			ajaxRequest.open("POST","outletdiscount_delete.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			$.ajax
			
			({
			 url:"outlet_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","outlet_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
        });

}
/*update outlet discount detail */
function updateoutletDiscount()
{
	var discountName=$("#discountUpdateName").val();
	var discountPercent=$("#discountUpdatePercent").val();
	var user=$("#user").val();
		
		
		
		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "discountName=" + discountName + "&discountPercent=" + discountPercent  + "&user=" + user ;
			ajaxRequest.open("POST","outletdiscount_update.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			$.ajax
			
			({
			 url:"outlet_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","outlet_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	
	
	
	
}
/* save product list */
function saveProductList()
{
	var productlistNumber=$("#productlistNumber").val();
	var productlistName=$("#productlistName").val();
	var productGroup=$("#productGroup option:selected").val();
	var user=$("#user").val();
	var action="add";
	if(productlistNumber=="" || productlistName=="")
	{
		alert("INVALID ENTRY")
		return;
	}
	
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "productListNumber=" + productlistNumber + "&productListName=" + productlistName + "&productGroup=" + productGroup + "&user=" + user + "&action=" + action;
			ajaxRequest.open("POST","itemlist_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			
			$.ajax
			({
			 url:"itemlist_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","itemlist_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	
}
/* save product list detail*/
function saveitemlistdetail()
{
	var productListNumber=$("#productListNumber").val();
	var productlistUom=$("#productlistUom option:selected").val();
	var productlistQuantity=$("#productlistQuantity").val();
	var user=$("#user").val();
	var action="add";
		
		if(productlistQuantity=="")
		{
			alert("INVALID ENTRY");
			return;
		}
		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "productlistUom=" + productlistUom + "&productlistQuantity=" + productlistQuantity + "&productListNumber=" + productListNumber  + "&user=" + user +"&action=" + action;
			ajaxRequest.open("POST","itemlistdetail_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			$.ajax
			({
			 url:"itemlist_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","itemlist_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	
}
/* update product list detail*/
function updateitemlistdetail()
{
	var productListNumber = $("#productListNumber").val();
	var productlistUomUpdate = $("#productlistUomUpdate option:selected").val();
	var productlistQuantityUpdate=$("#productListQuantityUpdate").val();
	var user=$("#user").val();
	var action="update";
		if(productlistQuantityUpdate=="")
		{
			alert("INVALID ENTRY");
			return;
		}
		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "productlistUomUpdate=" + productlistUomUpdate + "&productlistQuantityUpdate=" + productlistQuantityUpdate + "&productListNumber=" + productListNumber  + "&user=" + user +"&action=" + action;
			ajaxRequest.open("POST","itemlistdetail_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			$.ajax
			({
			 url:"itemlist_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","itemlist_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
	
}
/* save product list price */
function saveitemlistprice()
{
	var productListNumber=$("#productListNumber").val();
	var productPriceId=$("#productPriceId option:selected").val();
	var productListPrice=$("#productListPrice").val();
	var user=$("#user").val();
	var action="add";
		
		if(productListPrice=="")
		{
			alert("INVALID ENTRY");
			return;
		}
		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "productPriceId=" + productPriceId+ "&productListPrice=" + productListPrice + "&productListNumber=" + productListNumber  + "&user=" + user +"&action=" + action;
			ajaxRequest.open("POST","itemlistprice_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        ajaxRequest.send(param);
			$.ajax
			({
			 url:"itemlist_search.php",
			 success:function(response)
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
			var param= "";
			ajaxRequest.open("POST","itemlist_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
}
/* update item list price*/
function updateItemListPrice()
{
	var productListNumber=$("#productListNumber").val();
	var productPriceIdUpdate=$("#productPriceIdUpdate option:selected").val();
	var productListPriceUpdate=$("#productListPriceUpdate").val();
	var user=$("#user").val();
	var action="update";
		
		if(productListPriceUpdate=="")
		{
			alert("INVALID ENTRY");
			return;
		}
		
		
		$("#fancybox-wrap, #fancybox-overlay").fadeOut();		 
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							
												
						}
				}
				
				

			var param= "productPriceIdUpdate=" + productPriceIdUpdate + "&productListPriceUpdate=" + productListPriceUpdate + "&productListNumber=" + productListNumber  + "&user=" + user +"&action=" + action;
			ajaxRequest.open("POST","itemlistprice_save.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
			$.ajax
			({
			 url:"itemlist_search.php",
			 success:function(response)
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
				
			
			 
			 
			var param= "";
			ajaxRequest.open("POST","itemlist_search.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     	ajaxRequest.send(param);
	 		
			 
			 }
			
			  
			 });
}

function discountFormShow()
{
        $(".detailP").slideUp();
	$(".addDiscount").hide();
	$(".discountForm").slideDown();
}
function dockUp()
{
$(".dock").slideUp();
$(".panel").show();
}
function dockDown()
{
$(".panel").hide();
$(".dock").slideDown();
}

/*search content*/
function searchContent(page){
  var ajaxRequest = getAjaxRequest();
  ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('Table');
                                                         ajaxDisplay.innerHTML = ajaxRequest.responseText;
                                                        
                                                         sortTable()
         
                                                }
				}

			ajaxRequest.open("GET", page, true);
                        ajaxRequest.send(null);
}

/*end function search*/
function try_(){
  var code=$("#outletCode_ option:selected").val();
  $.getJSON('test.php?code='+code, function(data) {
			//alert(data); //uncomment this for debug
			//alert (data.item1+" "+data.item2+" "+data.item3); //further debug
                        $(".price").val(eval(data));

		});
}
/*check first if form has already po number*/
function checkSalesForm(){
  $("#txtCode").removeClass("validError");
  $("#txtPoNumber").removeClass("validError");
 if($("#txtCode").val()==""){
     alert("ENTER CONTROL NUMBER FIRST");
     $("#txtCode").focus();
     $("#txtCode").addClass("validError");
 }
 else if($("#txtPoNumber").val()==""){
     alert("ENTER P.O. NUMBER FIRST");
     $("#txtPoNumber").focus();
     $("#txtPoNumber").addClass("validError");
 }
}


function showKeyPressed(e) {
    if(e.keyCode==13){
        var table = document.getElementById('invoiceForm');
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	
        /*create checkbox*/
         $.getJSON('itemlist_pricesearch.php?itemNumber='+$("#txtItemCode").val(), function(data) {

                        if(data!="")
                            {
                                 
                                    /*insert checkbox*/
                                    var cell0 = row.insertCell(0);
                                    var chk=document.createElement("input");
                                    chk.type="checkbox";
                                    cell0.appendChild(chk);



                                    /*insert item description*/
                                    var cell1 = row.insertCell(1);
                                    
                                    cell1.innerHTML=data.itemName;


                                    /*insert item quantity*/
                                    var cell2 = row.insertCell(2);
                                    var txtQuantity=document.createElement("input");
                                    txtQuantity.setAttribute("value","1");
                                    txtQuantity.setAttribute("size","5");
                                    txtQuantity.setAttribute("onchange","javascript:changeQuantity();");
                                    txtQuantity.id=data.itemName.split(' ').join('');
                                    cell2.appendChild(txtQuantity);
                                    $('#'+data.itemName.split(' ').join('')).focus();

                                    /*insert uom*/

                                    var cell3 = row.insertCell(3);
                                    var selUOM=document.createElement("select");
                                    selUOM.id="a";
                                    cell3.appendChild(selUOM);
                                    $('#'+data.itemName.split(' ').join('')).focus();


                                    /*feed data into option*/
                                    $.getJSON('uom_json.php',function(data){
                                        var options = '';
                                        for (var i = 0; i < data.response.length; i++) {
                                             options += '<option>' + data.response[i] + '</option>';
                                                }
                                             $("select#a").html(options);
                                                /* copy the value of select */
                                             $("select#a").val($("#selUomCode").val());

                                    });
                                  


                                 
                                    /*insert price*/
                                    
                                    var cell4 = row.insertCell(4);
                                    cell4.innerHTML=data.itemPrice;


                                    /*insert total price*/

                                    var cell5=row.insertCell(5);

                                    cell5.innerHTML=data.itemPrice * $("#uomValue").val();
                                    

                                   
                            }
                            
                                    /*if data is null then set the textbox to item the clear*/
                            else if(data==""){
                                $("#txtItemCode").val('');
                                var txtItemCode=document.getElementById('txtItemCode');
                                txtItemCode.setAttribute("placeHolder","Item Doesn't Exist!")
                            }



		});

      

        /*end*/


        /*create input textbox*/
 
        /*end */

    }
}
function set_(event,txtBox){
    if(event.keyCode==13){
        $(txtBox).focus();
        $("#txtItemCode").val('');
    }
}

function setFocus(event,txtBox){
   if(event.keyCode==13){
    $(txtBox).focus();
}
}

function uomValue(){
     $.getJSON('uom_namesearch.php?name='+$("#selUomCode option:selected").val(), function(data) {
		$("#uomValue").val(eval(data));

		});

}
function changePassword(){
    $(".change_").hide();
    $(".change").fadeIn();
    $(".cmdChange").hide();
    $(".cmdSave").show();
    $("#oldPassword").focus();
    $("#myUsername").prop("disabled",false);

}
function updatePassword(){
    var myId=$("#myId").val();
    var username=$("#myUsername").val();
    var newPassword=$("#newPassword").val();
    $("#oldPassword").removeClass("validError");
    $("#newPassword").removeClass("validError");
     $("#verifyNewPassword").removeClass("validError");
        if($("#oldPassword").val()==""){
        alert("INVALID ENTRY");
        $("#oldPassword").addClass("validError");
        $("#oldPassword").focus();

        return false;
         }
    if($("#newPassword").val()==""){
        alert("INVALID ENTRY");
        $("#newPassword").addClass("validError");
        $("#newPassword").focus();
        return false;
    }

    

    if($("#myPassword").val()!=$("#oldPassword").val()){
        alert("Old Password didn't match!");
          $("#oldPassword").addClass("validError");
        $("#oldPassword").focus();
        return false;
    }
if($("#verifyNewPassword").val()==""){
    $("#verifyNewPassword").addClass("validError");
    $("#verifyNewPassword").focus();
}

if($("#newPassword").val()!=$("#verifyNewPassword").val()){
    alert("Verify you're Password");
    $("#newPassword").addClass("validError");
    $("#newPassword").focus();
    $("#verifyNewPassword").val('');
}


if($("#newPassword").val()==$("#verifyNewPassword").val()){
var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{

							var ajaxDisplay = document.getElementById('menulocationcontents');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;


						}
				}



			var param="myId="+myId+"&newPassword="+newPassword+"&newUsername="+username;
			ajaxRequest.open("POST","user_updatepassword.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        ajaxRequest.send(param);
                    }

}
function changeQuantity(){
    $
}
