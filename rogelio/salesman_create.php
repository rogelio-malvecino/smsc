
<div class="createcontainer">
		<table class="rap">
		<thead><td colspan="2" align="center"><b>ADD NEW SALESMAN</b></td></thead>
		
		<tr>
        	<td style="text-align:right">Code: </td>
            <td>
            	 <input type="text" size="30" id="salesmanCode" height="40" onBlur="javascript:upper('salesmanCode')"/>
            </td>
        </tr>
		
		<tr>
        	<td style="text-align:right">Name: </td>
            <td> 
            	<input type="text" size="30" id="salesmanName" height="40" onBlur="javascript:upper('salesmanName')"/> 
            
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
        
		<tr>
        <td colspan="2" align="right"><span id="buttoncreate" onClick="javascript:saveSalesman()"><center>SAVE</center></span>
        </td>
        
        </tr>
		</table>
</div>
		

    

 
    