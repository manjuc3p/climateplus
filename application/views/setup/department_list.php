<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
                        	<thead>
                                            <tr>
							<th>Department Name</th>
							<th>Status</th>
							<th>Remark</th>
							<th>Action</th>
						</tr>
				</thead>

				<tbody>
					<?php foreach($records as $row) :?>
						<tr>
							<td><?php echo $row->dept_name;?></td>
							<td><?php if($row->status==0) { echo 'Active'; } else { echo 'inactive'; }?></td>
							<td><?php echo $row->remark;?></td>
							<td>
							<a href="<?php echo base_url().'index.php/Admin/edit_department/'.$row->dept_id;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
							<a href="javascript:confirmcancel(<?php echo $row->dept_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
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

<script>

function confirmcancel(id)
{   
	var r= confirm("Are you sure you want to Delete Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Ajax/delete_record",
     		type: "POST",
     		data: {table_name:'department_master', where_key:'dept_id', where_val:id} ,
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
