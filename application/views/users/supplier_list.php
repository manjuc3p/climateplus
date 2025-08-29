<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
                <thead>
                <tr class="headings">                	  
	                  <th>Sr.No.</th>
	                  <th>Supplier Code</th>
	                  <th>Supplier Name</th>
	                  <th>Type</th>
	                  <th>Website</th>
	                  <th>Email</th>	                  
	                  <th>Mobile</th>	   
	                  <th>Contact Person</th>	                  
	                  <th>Action</th>	                 
                </tr>
                </thead>
                <tbody>
                <?php $counter = 1;
	 			foreach($records as $row):?>
			   	<tr>
		   			<td><?php echo  $counter; ?></td>
		   			<td><?php echo  $row->supplier_code; ?></td>
		   			<td><?php echo  $row->supplier_name; ?></td>
		   			<td><?php echo  $row->supplier_type; ?></td>
		   			<td><?php echo  $row->website; ?></td>
		   			<td><?php echo  $row->email_id; ?></td>
		   			<td><?php echo  $row->contact_no; ?></td>
		   			<td><?php echo  $row->contact_person; ?></td>
		   			<td>
						<a href="<?php echo base_url().'index.php/Users/edit_supplier/'.$row->supplier_id;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
						<a href="javascript:confirmcancel(<?php echo $row->supplier_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
						</td>
		   		</tr>
			   	 <?php $counter++;
				  endforeach;?>
		               
                </tbody>
              </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table End -->
        
        
        
<script>

function confirmcancel(id)
{   
	var r= confirm("Are you sure you want to Delete Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Ajax/delete_record",
     		type: "POST",
     		data: {table_name:'supplier_master', where_key:'supplier_id', where_val:id} ,
     		success: function(msg) {
     			if(msg==1) 
     			{     	
			         alert("Record deleted"); 				
        			 window.location.href="<?php echo $_SERVER['PHP_SELF']?>";   		                    		  
			}
		        else {
			      	alert("Can't Delete record. Data already exist!!!");
		       }
		    },
		});
      		return true;
      	}
        else
        	return false;
	    	
}
</script>
