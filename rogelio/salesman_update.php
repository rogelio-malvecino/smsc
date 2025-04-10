<?php
include('datasource.php');
$id=$_GET['id'];
$query=$mysqli->query("CALL spsalesmanQuery('$id')");
$row1=$query->fetch_array(MYSQLI_BOTH);
$query->close();
$mysqli->next_result();

?>
<div class="createcontainer">
		<table class="rap">
		<thead><td colspan="2" align="center"><b>UPDATE SALESMAN</b></td></thead>
		  <input type="hidden" value="<?php echo $id ?>" id="result" />
		<tr>
        	<td>Code: </td>
            <td>
            	<input type="text" size="30" id="salesmanCode" value="<?php echo $row1[0] ?>" onBlur="javascript:upper('salesmanCode')" onKeyDown="javascript:upper()"/>
            </td>
        </tr>
		
		<tr>
        	<td>Name: </td>
            <td> 
            	<input type="text" size="30" id="salesmanName" value="<?php echo $row1[1] ?>" onBlur="javascript:upper('salesmanName')" onKeyDown="javascript:upper1()"/>
            </td>
        </tr>
        <tr>
			<td width="100%">
            
            	  <?php include('datasource.php');?>
        	Marketing group:
            
            
            </td>
        
        
        	<td>
            	<select id="mGroup">
            
            <?php $query=$mysqli->query("CALL spmarketingSelect"); ?>
           <?php while ($ado = $query->fetch_array(MYSQLI_BOTH))
				{ ?>	   
		   <option>
            
            <?php echo $ado[0] ?>
            </option>
            <?php } ?>
            </select>   
            </td>
        </tr>
        
		<tr><td colspan="2" align="right"><span id="buttoncreate" onClick="javascript:updateSalesman()"><center>UPDATE</center></span>
        </td></tr>
		</table>
</div>
		



