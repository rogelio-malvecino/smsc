<?php

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Sortable table example</title>
	<link rel="stylesheet" type="text/css" href="sortable.css"/>
	<script type="text/javascript" src="sortable.js"></script>
</head>

<body>
<table>

<table align='center'>
<tr>
<td>
<input type='button' name='cmdcreatename' id='cmdcreateid' value='CREATE' onClick='javascript:employee_create()'/>
</td>
<td>
<input type='button' name='cmdsearchname' id='cmdsearchid' value='SEARCH' onClick='javascript:employee_search()'/>
</td>
<tr>
</table>

</td>
</tr>
</table>

<div id ="divtable">
<table class="sortable" id="anyid" cellpadding="0" cellspacing="0">
<tr>
	<th>Numbers and Digits</th>
	<th>Alphabet</th>
	<th>Dates</th>
	<th>Currency</th>
	<th class="unsortable">Unsortablesss</th>
</tr>
<tr>
	<td>1</td>
	<td>Z</td>
	<td>01-01-2006</td>
	<td>&euro; 5.00</td>
	<td>Unsortable</td>
</tr>
<tr>
	<td>2</td>
	<td>y</td>
	<td>04-13-2005</td>
	<td>&euro; 6.70</td>
	<td>Unsortable</td>
</tr>
<tr>
	<td>3</td>
	<td>X</td>
	<td>08-17-2006</td>
	<td>&euro; 6.50</td>
	<td>Unsortable</td>
</tr>
<tr>
	<td>4</td>
	<td>w</td>
	<td>01-01-2005</td>
	<td>&euro; 4.20</td>
	<td>Unsortable</td>
</tr>
<tr>
	<td>5</td>
	<td>V</td>
	<td>05-12-2006</td>
	<td>&euro; 7.15</td>
	<td>Unsortable</td>
</tr>
<tr class="sortbottom">
	<td>15</td>
	<td></td>
	<td></td>
	<td>&euro; 29.55</td>
	<td></td>
</tr>
</table>
</div>		
</table>
</body>
</html>
