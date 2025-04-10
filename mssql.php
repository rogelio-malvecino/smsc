<?php
echo "dddddSSSSSSSSSAAASSS";


if (function_exists('mssql_connect')){
echo "Okay, fn is there<br>------------------<br>";
} else {
echo "Hmmm .. fn is not even there<br>------------------<br>";
}

if(extension_loaded("mssql")) {
echo "MSSQL is Loaded<br>";
}
else {
echo "MSSQL not loaded<br>";
}

if(extension_loaded("msql")) {
echo "MSQL is Loaded<br>";
}
else {
echo "MSQL not loaded<br>";
}
echo '<br><br>';

$ext = get_loaded_extensions();
if(in_array('mssql', $ext))
echo 'u have mssql installed<br><br>';
else
echo 'u do NOT have mssql installed<br><br>';

phpinfo();




















$myServer = "compdev";
$myUser = "Prince JM";
$myPass = "Malvecino";
$myDB = "EE_Masterlist_2009";

//connection to the database
$dbhandle = mssql_connect($myServer, $myUser, $myPass)
  or die("Couldn't connect to SQL Server on $myServer");

//select a database to work with
$selected = mssql_select_db($myDB, $dbhandle)
  or die("Couldn't open database $myDB");

//declare the SQL statement that will query the database
$query = "SELECT item_number, item_description ";
$query .= "FROM items_list_header ";


//execute the SQL query and return records
$result = mssql_query($query);

$numRows = mssql_num_rows($result);
echo "<h1>" . $numRows . " Row" . ($numRows == 1 ? "" : "s") . " Returned </h1>";

//display the results
while($row = mssql_fetch_array($result))
{
  echo "<li>" . $row["item_number"] . $row["item_description"] . "</li>";
}
//close the connection
mssql_close($dbhandle);
?> 