<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
?>
<div class="createcontainer">
		<table class="rap" width="350">
		<thead><td colspan="2" align="center"><b>ADD NEW OUTLET</b></td></thead>
		
		<tr>
        	<td style="text-align:right">Outlet Code: </td>
            <td>
            	 <input type="text" size="30" id="outletCode" height="40" onBlur="javascript:upper('outletCode')" maxlength="30"/>
            </td>
        </tr>
		
		<tr>
        	<td style="text-align:right">Outlet Name: </td>
            <td> 
            	<input type="text" size="30" id="outletName" height="40" onBlur="javascript:upper('outletName')" maxlength="80"/> 
            
            </td>
        </tr>
          <tr>
        	<td style="text-align:right">Address: </td>
            <td> 
            	<input type="textarea" size="30" id="outletAddress" height="40" maxlength="150"/> 
            
            </td>
        </tr>
        <tr>
        	<td style="text-align:right">Vat Number: </td>
            <td> 
            	<input type="text" size="30" id="outletVat" height="40" onkeypress='return isNumberKey(event)' maxlength="15"/> 
            
            </td>
        </tr>
        <tr>
        	<td style="text-align:right">Tin Number: </td>
            <td> 
            	<input type="text" size="30" id="outletTin" height="40" maxlength="15" onkeypress='return isNumberKey(event)'/> 
            
            </td>
        </tr>
        <tr>
        	<td style="text-align:right">Contact Person: </td>
            <td> 
            	<input type="text" size="30" id="outletContactPerson" height="40" onBlur="javascript:upper('outletContact')" onkeypress='return Alpha(event)'/> 
            
            </td>
        </tr>
        <tr>
        	<td style="text-align:right">Contact Number: </td>
            <td> 
            	<input type="text" size="30" id="outletContactNumber" height="40" onkeypress='return isNumberKey(event)' maxlength="50"/> 
            
            </td>
        </tr>
        <tr>
        	<td style="text-align:right">Invoice Type: </td>
            <td> 
            	<input type="text" size="30" id="outletInvoiceType" height="40" onBlur="javascript:upper('outletInvoice')" maxlength="30"/> 
            
            </td>
        </tr>
       
        <tr>
			<td width="100%" style="text-align:right">
        	Region Code:
            </td>
        
        
        	<td>
            	<select id="regionCode">
            
            <?php $query=$mysqli->query("CALL spregionSelect"); ?>
           	<?php while ($ado = $query->fetch_array(MYSQLI_BOTH))
		   
				{ ?>	   
		   <option>
            
            <?php echo $ado[0] ?>
            </option>
            <?php } 
			$query->close();
			$mysqli->next_result();
			?>
            </select>   
            </td>
        </tr>
         <tr>
			<td width="100%" style="text-align:right">
        	Price Code:
            </td>
        
        
        	<td>
            	<select id="priceCode">
            
           <?php $query1=$mysqli->query("CALL sppriceSelect"); ?>
           <?php while ($ado2 = $query1->fetch_array(MYSQLI_BOTH))
		   
				{ ?>	   
		   <option>
            
            <?php echo $ado2[0] ?>
            </option>
            <?php }
			$query1->close();
			$mysqli->next_result();
			?>
            </select>   
            </td>
        </tr>
         <tr>
			<td width="100%">
        	Salesman Code:
            </td>
        
        
        	<td>
            	<select id="salesmanCode">
            
            <?php $query1=$mysqli->query("CALL spsalesmanSelect"); ?>
           <?php while ($ado1 = $query1->fetch_array(MYSQLI_BOTH))
				{ ?>	   
		   <option>
            
            <?php echo $ado1[0] ?>
            </option>
            <?php } ?>
            </select>   
            </td>
        </tr>
        
        
      
		</table>
        	 <span id="buttoncreate" onClick="javascript:outlet_save()" style="float:right;"><center>SAVE</center></span>
       	
</div>
		

    

 
    