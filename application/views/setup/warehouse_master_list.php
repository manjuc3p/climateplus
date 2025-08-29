<div class="card-body">
	<div class="dt-responsive table-responsive">
		<table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                            <tr>
				<th>Warehouse Name</th>
				<th>Incharge</th>
				<th>Address</th>
				<th>Contact</th>
				<th>Action</th>
			    </tr>
			</thead>

			<tbody>
				<?php foreach($records as $row) :?>
					<tr>
						<td><?php echo $row->warehouse_name;?></td>
						<td><?php echo $row->user_name;?></td>
						<td><?php echo $row->address.'&nbsp;'.$row->city.'&nbsp;'.$row->state.'&nbsp;'.$row->pincode; ?></td>
						<td><?php echo $row->contact_no;?></td>
						<td>
							<a href="<?php echo base_url().'index.php/Sales/edit_warehouse/'.$row->warehouse_id;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
							<a href="javascript:confirmcancel(<?php echo $row->warehouse_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
						</td>
					</tr>
				<?php endforeach; ?>
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
     		data: {table_name:'warehouse_master', where_key:'warehouse_id', where_val:id} ,
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
