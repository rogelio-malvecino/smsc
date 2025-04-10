<?php
include('datasource.php');
$id=$_GET['id'];
$query=$mysqli->query("CALL spsupplierQuery('$id')");
$row=$query->fetch_array(MYSQLI_BOTH);
?>
<div class="createcontainer">
    
    	<table class="rap"> 
        	<thead><td colspan="2" align="center"><b>ADD NEW SUPPLIER</b></td></thead>
		
            <tr>
            	<td>
               		  Supplier code:  	
            	</td>
                <td>
                	<input type="text" id='Code'  value="<?php echo $row[0] ?>"/>
                </td>
            </tr>
            <tr>
            	<td>
               		  Supplier name:  	
            	</td>
                <td>
                	<input type="text" id='sName'  value="<?php echo $row[1] ?>"/>
                </td>
            </tr>
            <tr>
            	<td>
               		  Supplier address:  	
            	</td>
                <td>
                	<input type="text" id='sAdd'  value="<?php echo $row[2] ?>"/>
                </td>
            </tr>
              <tr>
            	<td>
               		  Contact Person:  	
            	</td>
                <td>
                	<input type="text" id='sContact'  value="<?php echo $row[3] ?>"/>
                </td>
            </tr>
              <tr>
            	<td>
               		  Supplier Phone:  	
            	</td>
                <td>
                	<input type="text" id='sPhone' value="<?php echo $row[4] ?>"/>
                </td>
            </tr>
              <tr>
            	<td>
               		  Supplier mobile:  	
            	</td>
                <td>
                	<input type="text" id='sMobile' value="<?php echo $row[5] ?>"/>
                </td>
            </tr>
              <tr>
            	<td>
               		  Supplier email:  	
            	</td>
                <td>
                	<input type="text" id='sEmail' value="<?php echo $row[6] ?>"/>
                </td>
            </tr>
              <tr>
            	<td>
               		  Supplier fax:  	
            	</td>
                <td>
                	<input type="text" id='sFax' value="<?php echo $row[7] ?>"/>
                </td>
            </tr>
            	<tr>
        <td colspan="2" align="right"><span><a href="#" onclick="javascript:supplierUpdate()" id="buttoncreate"><center>UPDATE</center></a></span>
 </span>
        </td>
        </tr>


        </table>
    
    </div>

