<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
                                        <thead>
                                            <tr>
							<th>Sr.no</th>
							<th>Name</th>
							<th>Email</th>
							<th>Contact No</th>
							<th>Department</th>
							<th>Address</th>
							<th>Country</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
					<?php $i=1; foreach($records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td><?php echo $row->user_name;?></td>
							<td><?php echo $row->email_id;?></td>
							<td><?php echo $row->contact_no;?></td>
							<td><?php echo $row->dept_name;?></td>
							<td width='20%'><?php echo $row->address;?></td>
							<td><?php echo $row->country;?></td>
							<td>
							<a href="<?php echo base_url().'index.php/Users/edit_user/'.$row->user_id;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
							<a href="javascript:confirmcancel(<?php echo $row->user_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
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
     		data: {table_name:'users', where_key:'user_id', where_val:id} ,
     		success: function(msg) {
     			if(msg==1) 
     			{     	
			         alert("Record deleted"); 				
        			 window.location.href=window.location.pathname;   		                    		  
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
