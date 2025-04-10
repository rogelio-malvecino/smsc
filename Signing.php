<?php


session_start(); 
include ("datasource.php");

					$mResult = $mysqli->query("select * from empuser where  limit 1");
					if (mysqli_num_rows($mResult) > 0)
						{
							while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
							{
								
							}
						}		

?>