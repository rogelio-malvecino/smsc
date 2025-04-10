
<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
 $searchBy=$_GET['id'];
 if($searchBy=="userFirstName")
   {
	$q=$_GET['q'];
        $query=$mysqli->query("CALL spuserSearchFirstName('$q')");
	 while ($row = $query->fetch_array(MYSQLI_BOTH))
            {
            echo $row[0]."\n";
            }
   }

if($searchBy=="userLastName"){
    	$q=$_GET['q'];
        $query=$mysqli->query("CALL spuserSearchLastName('$q')");
	 while ($row = $query->fetch_array(MYSQLI_BOTH))
            {
            echo $row[0]."\n";
            }
}

?>
