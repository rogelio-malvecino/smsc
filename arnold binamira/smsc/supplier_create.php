<div class="createcontainer">
    
    	<table class="rap">
        	<thead><td colspan="2" align="center"><b>ADD NEW SUPPLIER</b></td></thead>
		
        	<tr>
            	<td>
               		  Code:  	
            	</td>
                <td>
                	<input type="text" id='Code' onblur="javascript:upper('Code')"/>
                </td>
            </tr>
            <tr>
            	<td>
               		  Name:  	
            	</td>
                <td>
                	<input type="text" id='sName' onkeydown="return oncheckchar(this.value);" onblur="javascript:upper('sName')"/>
                </td>
            </tr>
            <tr>
            	<td>
               		  Address:  	
            	</td>
                <td>
                	<input type="text" id='sAdd' onblur="javascript:upper('sAdd')"/>
                </td>
            </tr>
              <tr>
            	<td>
               		  Contact #:  	
            	</td>
                <td>
                	<input type="text" id='sContact' onkeydown="return onchecknum(this.value);" />
                </td>
            </tr>
              <tr>
            	<td>
               		  Phone #:   	
            	</td>
                <td>
                	<input type="text" id='sPhone' onkeydown="return onchecknum(this.value);" />
                </td>
            </tr>
              <tr>
            	<td>
               		  Mobile #:  	
            	</td>
                <td>
                	<input type="text" id='sMobile' onkeydown="return onchecknum(this.value);" />
                </td>
            </tr>
              <tr>
            	<td>
               		  Email Add:  	
            	</td>
                <td>
                	<input type="text" id='sEmail'/>
                </td>
            </tr>
              <tr>
            	<td>
               		 Fax #:  	
            	</td>
                <td>
                	<input type="text" id='sFax' onkeydown="return oncheckchar(this.value);" />
                </td>
            </tr>
			<tr>
                
		<tr>
        <td colspan="2" align="right"><span><a href="#" onclick="javascript:supplierSave()" id="buttoncreate"><center>SAVE</center></a></span>
        </td>
        </tr>
            
		
        </table>
    
    </div>



