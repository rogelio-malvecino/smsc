<?php
//A function that build the 12 Months of a year
function month(){
	
	$month = array("January","February","March","April","May","June","July","August","September","October","November","December",);
	foreach($month as $key => $value){
		echo "<option value='$value'>$value</option>";	
	}
	
	return $month;
}

//a Loooping Statement for 31 days a month
function days(){
	
	for($i=1;$i<=31;$i++){
	if($i <10){
			echo "<option value='0$i'>0$i</option>";	
		}else{
			echo "<option value='$i'>$i</option>";	
		}
	}
}

//Looping Statement for years
function year(){
	
	for($i=2020;$i>=1950;$i--){
		echo "<option value='$i'>$i</option>";	
	}
}

?>