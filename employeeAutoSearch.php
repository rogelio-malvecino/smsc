<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
 $searchBy=$_GET['id'];

 if($searchBy=="employeeCode")
   {
	$q=$_GET['q'];
        $query=$mysqli->query("Select EmpNumber from employeeinformation where EmpNumber like '%$q%' and Status='1'");
	 while ($row = $query->fetch_array(MYSQLI_BOTH))
            {
            echo $row[0]."\n";
            }
   }

if($searchBy=="employeeFirstName"){
    	$q=$_GET['q'];
      $query=$mysqli->query("Select EmpFirstName from employeeinformation where EmpFirstName like '%$q%' and Status='1'");
	 while ($row = $query->fetch_array(MYSQLI_BOTH))
            {
            echo $row[0]."\n";
            }
}

?>
<head>
<link href="../global/mystyle.css" rel="stylesheet" type="text/css" >
</head>
<body>
</body>