<?php
session_start(); 
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
$a="";
?>
<div id="productForm">
	<div id="buttonPos">
    	<a href="supplier_create.php" class="addProduct"><input type="button" value="CREATE"  id="buttonCreate" /> </a>
 
    </div>
     
    <?php $query=$mysqli->query("CALL spsupplierSelect()"); ?>
    
    <!-- display record here-->
    
    <div style="margin:0 auto;margin-bottom:15px;">
		 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">

        	<thead>
            	<tr class="title">
                            <th class="btitle" width="7%">#</th>
                            <th width="5%">CODE</th>
                            <th>NAME</th>
                            <th>ADDRESS</th>
                            <th>CONTACT PERSON</th>
                            <th>PHONE</th>
                            <th>MOBILE</th>
                            <th>EMAIL</th>
                            <th>FAX</th>
                            <th width="10%">ACTION</th>
                </tr>
            </thead>
            <!--loop the record-->
            <?php $i=1 ?>
		    <tbody>
            <?php while ($row = $query->fetch_array(MYSQLI_BOTH)) 
				 
				{ ?>
               
            	<tr class="del<?php echo $row[0] ?>">
                	
        			
                	<td>
                    	<?php echo $i  ?>                    
                    </td>
                    	<?php $i=$i+1 ?>
                    <td>
                    	<?php echo $row[0]?>
                    </td>
                    <td>
                    	<?php echo $row[1]?>
                    </td>
                     <td>
                    	<?php echo $row[2]?>
                    </td>
                     <td>
                    	<?php echo $row[3]?>
                    </td>
                     <td>
                    	<?php echo $row[4]?>
                    </td>
                     <td>
                    	<?php echo $row[5]?>
                    </td>
                     <td>
                    	<?php echo $row[6]?>
                    </td>
                     <td>
                    	<?php echo $row[7]?>
                    </td>
                 
                    <td>
                    <span style="padding-left:10px; display:<?php echo $a ?>"><a href="supplier_update.php?id=<?php echo $row[0] ?>" class="editProduct"><img src="icons/EDITS.ico" /></a></span><span style="padding-left:10px; cursor:pointer;" class="delSupplier" id="<?php echo $row[0] ?>"><a href="#" title="DELETE"><img src="icons/DELETE.ico"/></a></span>
                    </td>
                </tr>
            	<?php } ?>
            </tbody>
            
        </table>
    
    </div>
    
	<!--*******-->	
	<div style="width:400px;margin:0 auto;display:none; border:solid 2PX #060; padding:20PX;" id="saveForm">
    	<div style="margin:0 auto; width:160px; margin-bottom:30px;"><input type="button" value="SAVE" onclick="javascript:saveProduct()"/><input type="button" value="SEARCH" onclick="javascript:cancel()"/></div>
    	CATEGORY: <input type="text" size="40" id="category">
    </div>
