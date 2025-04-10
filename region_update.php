<?php
include('datasource.php');
$id=$_GET['id'];
$query=$mysqli->query("CALL spregionQuery1('$id')");
$row=$query->fetch_array(MYSQLI_BOTH);
?>


<div class="createcontainer">
		<table class="rap">
		<thead>
                 <td colspan="2" align="center">
                    <b>UPDATE REGION</b>
                 </td>
        </thead>
		<input type="hidden" value="<?php echo $id ?>" id="result" />
		<tr>
                <td>
                	Code: 
                </td>
                <td>		
                	<input type="text" size="30" id="regionCode" value="<?php echo $row[0] ?>" onBlur="javascript:upper('regionCode')" maxlength="10" />
                </td>
        </tr>
		
		<tr>
                    <td>
                        Name: 
                    </td>
                    <td> 
                        <input type="text" size="30" id="regionName" value="<?php echo $row[1] ?>" onBlur="javascript:upper('regionName')" />
                    </td>
       </tr>
		
		<tr>
                <td colspan="2" align="right"><span id="buttoncreate" onClick="javascript:regionUpdate()"><center>UPDATE</center></span>
                
                </td>
        </tr>
		</table>
        </div>
