<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
?>
<div id="productForm">
	<div id="buttonPos">
    	
		<a href="region_create.php" class="addProduct"><input type="button" value="CREATE"  id="buttonCreate" /></a>		
		</span>
 
    </div>
     
    <?php $query=$mysqli->query("CALL spregionSelect()"); ?>
    
    <!-- display record here-->
    
		 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">

        	<thead><tr class="title">
            	<th class="btitle" width="7%">#</th><th>REGION CODE</th><th>REGION NAME</th><th width="10%">ACTION</th>
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
                    <span style="padding-left:10px">
					
					<a href="region_update.php?id=<?php echo $row[0] ?>" class="editProduct"><img src="icons/EDITS.ico"/ title="EDIT REGION"></a></span>
					
					<span style="padding-left:10px; cursor:pointer;" class="delRegion" id="<?php echo $row[0] ?>" title="DELETE"><img src="icons/DELETE.ico"/>
					
					</span>                    </td>
                </tr>
            	<?php } ?>
            </tbody>
            
        </table>
    