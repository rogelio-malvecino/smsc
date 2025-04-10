<?php 
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
require("connection.php");

$empnumber = $_SESSION['S_UserID'];


$code = $_POST['code'];
$submit = $_POST['submit'];

if($submit){
$update = "update tbl_themes set Code='$code' where EmpNumber='$empnumber'";
$updateQ = mysql_query($update);

header("location:mainmenu.php");

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">


input{
border:0;
background-color:#FFFFFF;
font-size:16px;
color:#999999;
font-family:Arial, Helvetica, sans-serif;}
input:hover{
text-decoration:underline;}



</style>
</head>

<body>
<center>
<form action="mainthemes.php" method="post">

<table>
<tr><td><img src="images2/ddsa.png" height="500" width="700"/></td></tr>
<tr>
<td align="center">
<input type="hidden" value="		
		.dmx {
    font: 11px tahoma;
	float:left;
}

.dmx .item1,.dmx .item1-active{


	text-align:center;
	color:#FFFFFF;
	border:1px solid #FFFFFF;
    text-decoration: none;
	padding:10px;
	border-radius:5px;
	height:40px;
	line-height:40px;
    white-space: nowrap;
    position: relative;

}


.dmx .item2,
.dmx .item2:hover,
.dmx .item2-active,
.dmx .item2-active:hover{
padding:7px;
    font: 10px tahoma;
    font-weight: bold;
	text-decoration:none;
    display: block;
    white-space: nowrap;
    position: relative;
    z-index: 500;
	color:#003300;
}

.dmx .item2:hover{
background-color:#003300;
color:#FFFFFF;
}


.dmx .item2:hover,
.dmx .item2-active,
.dmx .item2-active:hover {

}
.dmx .arrow,
.dmx .arrow:hover {
    padding: 3px 16px 4px 8px;
}
.dmx .item2 img,
.dmx .item2-active img{
    position: absolute;
    top: 4px;
    right: 1px;
    border: 0;
}
.dmx .section{
background-color:#FFFFFF;
width:180px;
    position: absolute;
    visibility: hidden;
    z-index: -1;
	box-shadow:1px 1px 1px #006600;
}
div.content
{
background-color:#FFFFFF;
float:left;
width:773px;
padding-bottom:20px;


}

div.contents_{
font-size:18px;}


/*heading*/
div.heading
{
padding-top:25px;
padding-bottom:25px;
padding-right:50px;
padding-left:50px;

background: #ECF1EF;
margin:0px;
  font: 20px arial;
    color: #000000;
    font-weight: bold;
    position: relative;
    display: block;
    white-space: nowrap;
}

div.loguser
{
padding-top:12.5px;
padding-bottom:12.5px;
padding-right:25px;
padding-left:25px;
/*padding:5px;*/
background: #ECF1EF;
margin:0px;
  font: 10px arial;
    color: #000000;
    font-weight: bold;
    position: relative;
     display: block;
    white-space: nowrap;
}



div.borderheading
{

border:1px solid black;
position: relative;
display: block;
    white-space: nowrap;
}
div.bordercontents
{

border:3px solid black;
position: relative;
display: block;
    white-space: nowrap;
	height:300px;
}




/*Title*/
Tit1 {
text-align:center;
text-transform:uppercase;	
}
body{
background-image:url(images2/body3.jpg);
margin:0;
padding:0;
}


div.bordermenu
{
font-family:Arial, Helvetica, sans-serif;
line-height:60px;
text-indent:15px;
color:#000000;
text-transform:capitalize;
text-align:left;
}
div.outercontent{

}
div.container{
background-color:#FFFFFF;
border:1px groove #A7C942;
height:720px;
width:1150px;
}
div.header{
background-image:url(images2/nablink.jpg);
background-size:100% 100%;
height:150px;
width:100%;
line-height:150px;}

#leftp{
margin:0;
padding:0;
text-indent:20px;
color:#FFFFFF;
float:left;
text-shadow:1px 1px 1px #FFFFFF;
font-family:arial;
font-size:2.6em;
}




@keyframes myfirst
{
0%   {background:red; left:0px; top:0px;}
25%  {background:yellow; left:200px; top:0px;}
50%  {background:blue; left:200px; top:200px;}
75%  {background:green; left:0px; top:200px;}
100% {background:red; left:0px; top:0px;}
}

@-moz-keyframes myfirst /* Firefox */
{
0%   {color:red; left:0px; top:0px;}
25%  {color:yellow; left:400px; top:500px;}
50%  {color:blue; left:700px; top:400px;}
75%  {color:green; left:0px; top:100px;}
100% {color:red; left:0px; top:0px;-moz-transform:rotate(720deg);}
}

@-webkit-keyframes myfirst /* Safari and Chrome */
{
0%   {color:red; left:0px; top:0px;}
25%  {color:yellow; left:400px; top:500px;}
50%  {color:blue; left:700px; top:400px;}
75%  {color:green; left:0px; top:100px;}
100% {color:red; left:0px; top:0px;-moz-transform:rotate(720deg);}
}




#rightp{
font-size:9px;
float:right;
color:#FFFFFF;
margin-right:10px;
font-family:arial;}


div.navlink{
background-image:url(images2/nablink.jpg);
background-size:100% 100%;
height:50px;
width:100%;}




div.footer{
width:1150px;
height:40px;
background-color:#003300;
line-height:40px;
color:#FFFFFF;
font-family:Arial,Helvetica, sans-serif;
text-align:center;
font-size:10px;
text-indent:80px;}

div.contentheader{
color:#000000;
height:60px;
width:100%;
}

a.themes{
text-decoration:none;
color:#FFFFFF;
font-size:9px;
}
a.themes:hover{
text-decoration:underline;}
div.contentright{
border-left:4px dotted #006600;
height:517px;
width:370px;
float:right;
}




* html .dmx td { position: relative; } /* ie 5.0 fix */



/*______________________________________________________________________________*/



.sortable{
font-family:Arial, Helvetica, sans-serif;
width:100%;
border-collapse:collapse;}

.sortable td, .sortable th{

font-size:1em;
border:1px solid #98bf21;
padding:3px 7px 2px 7px;

}

.sortable th{
font-size:.9em;
text-align:left;
padding-top:8px;
padding-bottom:7px;
background-color:#A7C942;
color:#ffffff;
}
.sortable th a{
text-decoration:none;
color:#ffffff;
font-size:9px;}


.unsortable{
color:#FFFFFF;
-moz-border-radius-topright:10px;
}

.left{-moz-border-radius-topleft:10px;}



table.sortable td {
font-size:12px;
font-family:Arial, Helvetica, sans-serif;
color:#999999;
		border-width:0px;
		text-align:left;
		text-indent:10px;
}
table.sortable td a{
text-decoration:none;
color:#999999;
}
table.sortable tr.odd td {
color:#999999;
background-color:#EAF2D3;
}

table.sortable tr.odd td a:hover{

text-decoration:underline;}

table.sortable tr.even td {
}


table.sortable tr.even td a:hover{
color:#999999;
text-decoration:underline;
}



table.sortable tr.sortbottom td {
	border-top: 1px solid #444;
	background-color: #ccc;
	font-weight: bold;
}


.sortableto{
}
.sortableto tr td{
font-family:Arial, Helvetica, sans-serif;
color:#000000;
font-size:12px;}
.sortableto tr td input{
padding:3px;
border:0;
border:1px solid #CCCCCC;
color:#666666;
border-radius:5px;}

.sortableto tr td input.send{
background-color:#006600;
padding:5px;
color:#FFFFFF;
border-radius:10px;
border:0;}
div.footerto{

background-color:#A7C942;
height:20px;
line-height:20px;
text-align:left;
}

div.footerto input.footer{
background-color:#A7C942;
border:0;
color:#FFFFFF;}
div.footerto input.footer:hover{
text-decoration:underline;}

.sortabletree{
margin-left:40px;
}
.sortabletree tr td{
color:#FFFFFF;}
.sortabletree tr td input{
padding:5px;
color:#666666;
border-radius:5px;}
.sortabletree tr td input.send{
background-color:#666666;
padding:10px;
color:#FFFFFF;
border-radius:10px;
border:0;}


.sample tr td{
font-family:Arial, Helvetica, sans-serif;
color:#999999;
text-transform:capitalize;
width:300px;
margin:0;
}
.sample{
border:1px groove #666666;
border-radius:10px;
padding:10px;}
.sample tr th{
background-color:#333333;
color:#FFFFFF;
font-size:16px;
border-radius:10px;}

" name="code">


<input type="submit" name="submit" value="make your profile themes">
</td></tr>
</form>

</table>

</center>
</body>
</html>



