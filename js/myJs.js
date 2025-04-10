// JavaScript Document
// ajax getrequest

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

function display()
{
			var ajaxRequest = getAjaxRequest();
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							var ajaxDisplay = document.getElementById('content');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
							var table = document.getElementById('example');
							var tableDnD = new TableDnD();
							tableDnD.init(table);
							
							
							oTable = $('#example').dataTable({
							"bJQueryUI": true,
							"sPaginationType": "full_numbers"
							});
							$(".delinfogo").click( function(){
							var delgo = $(this).attr("id");
							 
							
						
			
						if(confirm('Do you want to Remove this Record?')){
							$.ajax({
								   
							type: "POST",
							data: ({delgo: delgo}),
							url:"delRec.php",
							cache: false,
							success: function(response){
							 $(".del"+delgo).fadeOut('slow', function() { $(this).remove(); });
							}
							});
						}
							return false;
						}) 
						
						
						$(".TRY").fancybox({
							'opacity'		: true,
							'overlayShow'	: true,
							'transitionIn'	: 'elastic',
							'transitionOut'	: 'elastic'
						 });
						
				
						
						$(".edit").fancybox({
							'opacity'		: true,
							'overlayShow'	: true,
							'transitionIn'	: 'elastic',
							'transitionOut'	: 'elastic'
						 });
				

					
			
								}
						}
					var param= "";
			$.getScript("demo_ajax_script.js");
			ajaxRequest.open("POST","display.php",true);
			ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	     		ajaxRequest.send(param); 
}

function callMain()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("content").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","addRec.php",true);
xmlhttp.send();
}

function callDisplay()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("content").innerHTML=xmlhttp.responseText;
		alert('asd');
	}
  } 
xmlhttp.open("POST","display.php",true);
xmlhttp.send();
	
}
function callAdd()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("content").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","addRec.php",true);
xmlhttp.send();
	


}


//ADD RECORD
function saveRec()
{
	if (confirm("DO YOU WANT TO SAVE THIS RECORD?")== true)
	{
		var table=document.getElementById('anyid');
		var rowCount=table.rows.length;
		var row=table.insertRow(rowCount);
		var cell0=row.insertCell(0);
		cell0.innerHTML=rowCount;
		
		var cell1=row.insertCell(1);
		cell1.innerHTML=$("#username").val();
		
		var cell2=row.insertCell(2);
		cell2.innerHTML=$("#password").val();
	
		var cell3=row.insertCell(3);
		cell3.innerHTML=$("#fname").val();
		
		var cell4=row.insertCell(4);
		cell4.innerHTML=$("#lname").val();
	
	
		
	//clear entry box
	$("#username").val('');
	$("#password").val('');
	$("#fname").val('');
	$("#lname").val('');
	
	}
}
//check all checkbox
function checkAll()
{
	var table=document.getElementById('example');
	var rowCount=table.rows.length;
	var chk=document.getElementById('chk1');
	for(i=0;i<rowCount;i++)
	{
		document.getElementById('chk1'+i).checked=true;
	}
}
function save()
{
	if(confirm("DO YOU WANT TO SAVE THIS RECORD?")==true)
	{
		var username=$("#username").val();
		var password=$("#password").val();
		var fullname=$("#fullname").val();
		var position=$("#position").val();
		
		if(isNaN(username)==true)
		{
			alert('not a num')
			return;
		}
		
		if(username=="")
		{
			alert("INVALID ENTRY");
			return;
		}
		if(password=="")
		{
			alert("INVALID ENTRY");
			return;
		}
		if(fullname=="")
		{
			alert("INVALID ENTRY");
			return;
		}
		if(position=="")
		{
			alert("INVALID ENTRY");
			return;
		}
		$.ajax
		({
		 type:"POST",
		 data:({username:username,password:password,fullnaname:fullname,position:position}),
		 url:"insertRec.php",
		 success:function(response)
		 {
			 
			 
				$("#fancybox-wrap, #fancybox-overlay").fadeOut();	 
			 
		 }
								 		
		})
		
		 
   
	}
}
//update record
function updateRec()
{
	var id=$("#id").val();
	var username=$("#username").val();
	var password=$("#password").val();
	var fullname=$("#fullname").val();
	var position=$("#position").val();
	
	if(username=="")
	{
		alert('INVALID ENTRY');
		return;
	}
	if(password=="")
	{
		alert('INVALID ENTRY');
		return;
	}
	if(fullname=="")
	{
		alert('INVALID ENTRY');
		return;
	}
	if(position=="")
	{
		alert('INVALID ENTRY');
		return;
	}
	if(confirm('ARE YOU SURE DO YOU WANT TO UPDATE THIS RECORD?')==true)
		{
			$.ajax
			({
			 type:"POST",
			 data:({ID:id, username:username, password: password, fullname: fullname, position: position }),
			 url:"updateResult.php",
			 success:function(response)
			 {
				 $("#fancybox-wrap, #fancybox-overlay").fadeOut();
				 display()
			 }
			 
			 });			
			
		}
		
}
//
function saveOrder()
{
	//var x=document.getElementById('example').rows[1].cells;
	//alert(x[0].innerHTML);
	var table=document.getElementById('example');
	var rowCount=table.rows.length;
	
	//loop
	for( var i=1;i<rowCount;i++)
	{
		var x=document.getElementById('example').rows[i].cells;
		//get table cell value
	
		var cell1=(x[2].innerHTML);
		var cell2=(x[3].innerHTML);
		var cell3=(x[4].innerHTML);
		var cell4=(x[5].innerHTML);
		
		//save the value of the sorted table
	$.ajax
	({
	 
	 type:"POST",
	 data:({i:i, cell1:cell1, cell2:cell2, cell3:cell3, cell4:cell4}),
	 cache:"false",
	 url:"saveOrder.php",
	 success:function(response)
	 {
		 
		 
	 }
	 
	 
	 
	 });
	
	
	}
}