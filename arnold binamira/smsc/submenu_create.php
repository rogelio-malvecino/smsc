<div class="createcontainer">
	<table class="rap">
		<thead><td colspan="2" align="center"><b>ADD NEW SUBMENU</b></td></thead>
		<?php 
		include('datasource.php');
		$query=$mysqli->query("CALL spmainmenuSelect");
		?>	
        <tr>
        	
            <td >
            	Menu code:
            
             <?php include('datasource.php');?>
       		</td>
            
            
       
        	<td>
        
        
            	<select id="mMenu">
            
            <?php $query=$mysqli->query("CALL spmainmenuSelect"); ?>
           <?php while ($ado = $query->fetch_array(MYSQLI_BOTH))
				{ ?>	   
		   <option>
            
            <?php echo $ado[0] ?>
            </option>
            <?php } ?>
            </select>  
            </td>		
         </tr>
		<tr style="text-align:right">
        	<td>
            	Code: 
            </td>
            <td>	
            	<input type="text" size="30" id="submenuCode" height="40" maxlength="30" onBlur="javascript:upper('marketCode')"/>
            </td>
        </tr>
		
		<tr style="text-align:right">
        	<td>
            	Name: 
            </td>
           	<td>
            	<input type="text" size="30" id="submenuName" height="40" onBlur="javascript:upper('marketName')"/>
            </td>
        </tr>
		<tr style="text-align:right">
        	<td>
            	Page: 
            </td>
            <td>
            	<input type="text" size="30" id="submenuPage" height="40" onBlur="javascript:upper('marketName')"/>
            </td>
       	</tr>
		<tr><td colspan="2" align="right"> <span id="buttoncreate" onClick="javascript:saveSubMenu()"><center>SAVE</center></span>
        </td></tr>
		</table>
</div>
