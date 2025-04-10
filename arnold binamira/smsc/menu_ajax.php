
<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();


/*main menu search module*/
$menuCode=$_GET['code'];
$menuName=$_GET['name'];
include ("datasource.php");
$mResult = $mysqli->query("SELECT * FROM mainmenu where MenuCode like '%$menuCode%' and MenuName like '%$menuName%'");
$display="
<form name='frmmainmenu'>";
$display.="
";

$display .="
<br /><br />

<table width='100%' id='example' class='display' cellpadding='0' cellspacing='0' >
		<thead>
		<tr class='title'>
		<th class='btitle'>#</th>
		<th>MENU CODE</th>
		<th>MENU NAME</th>
		<th>ORDER</th>
		<th width='10%'>ACTION</th>
		</tr>
		</thead>
		";
$sequence = 0;

	if (mysqli_num_rows($mResult) > 0)
		{

			while ($ado = $mResult->fetch_array(MYSQLI_BOTH))
				{
					$sequence = $sequence + 1;
					$mycheckboxid ="select".$sequence."id";
					$mycheckboxname="select".$sequence."name";
					$del='del'.$ado['MenuCode'];
					$id=$ado['MenuCode'];
					$display .="
							<tr class=$del>

							<td width='3%'>".$sequence."</td>


							<td>
								<a href='#' onClick='javascript:mainmenu_create(\"".$ado['MenuCode']."\",\"".$ado['MenuName']."\",\"editmode\");'>
										".$ado['MenuCode']."
								</a>
							</td>
							<td>
								".$ado['MenuName']."
							</td>
							<td>
								".$ado['MenuOrder']."
							</td>
							 <td>
                    <span style='padding-left:10px'><a href='menu_upate.php?id=$id' class='makeFancy'>
							<img src='icons/EDITS.ico' /></a>
					</span>
					<span style='padding-left:10px; cursor:pointer;' class='dlMenu' id=$id>
						<a href='#' title='DELETE'><img src='icons/DELETE.ico'/></a>
					</span>
                    </td>
						         </tr>";
				}
		}
	else
		{

		}
$display .="</table>
			<input type='hidden' name='hidTotRecname' id='hidTotRecid' value='".$sequence."'>
</form><div class='footerto'>
</div>";
echo $display;
?>
