<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
 $searchBy=$_GET['id'];

 if($searchBy=="menuCode")
   {
	$q=$_GET['q'];
        $query=$mysqli->query("CALL spmainmenuSearchCode('$q')");
	 while ($row = $query->fetch_array(MYSQLI_BOTH))
            {
            echo $row[0]."\n";
            }
   }

if($searchBy=="menuName"){
    	$q=$_GET['q'];
        $query=$mysqli->query("CALL spmainmenuSearchName('$q')");
	 while ($row = $query->fetch_array(MYSQLI_BOTH))
            {
            echo $row[1]."\n";
            }
}

?>