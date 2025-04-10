<?php
session_start();
include ("Functioneverwing.php");
Is_Logged_In();
include('datasource.php');
$submenu=$_GET['code'];
$submenuname=$_GET['name'];
?>
    <?php $query=$mysqli->query("CALL spsubmenuSearchAjax('$submenu','$submenuname')"); ?>

    <!-- display record here-->

    <div style="margin:0 auto;margin-bottom:15px;">
		 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">

        	<thead><tr class="title">
            	<th class="btitle" width="7%">#</th><th width="30%">MENU CODE</th><th>SUBMENU CODE</th><th>SUBMENU NAME</th><th>PAGE</th><th width="10%">ACTION</th>
        		</tr>
            </thead>
            <!--loop the record-->
            <?php $i=1 ?>
		    <tbody>
            <?php while ($row = $query->fetch_array(MYSQLI_BOTH))

				{ ?>

            	<tr class="del<?php echo $row[1] ?>">


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
                    <span style="padding-left:10px"><a href="submenu_update.hp?id=<?php echo $row[1] ?>" class="editProduct"><img src="icons/EDITS.ico" /></a></span><span style="padding-left:10px; cursor:pointer;" class="dlSubMenu" id="<?php echo $row[1] ?>"><a href="#" title="DELETE"><img src="icons/DELETE.ico"/></a></span>
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

