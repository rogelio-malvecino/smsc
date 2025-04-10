<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
 $searchBy=$_GET['id'];

 if($searchBy=="submenuCode")
   {
	$q=$_GET['q'];
        $query=$mysqli->query("SELECT * from submenu where SubMenu like '%$q%'");
	 while ($row = $query->fetch_array(MYSQLI_BOTH))
            {
            echo $row[1]."\n";
            }
   }

if($searchBy=="submenuName"){
    	$q=$_GET['q'];
        $query=$mysqli->query("SELECT * from submenu where SubMenuName like '%$q%'");
	 while ($row = $query->fetch_array(MYSQLI_BOTH))
            {
            echo $row[2]."\n";
            }
   }

?>