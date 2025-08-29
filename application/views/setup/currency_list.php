<div class="card-body">
	<div class="dt-responsive table-responsive">
		<table id="datatable" class="table table-striped" data-toggle="data-table">
			<thead>
				<tr>
					<th>Sr.No</th>
					<th>Country Name</th>
					<th>Currency</th>
					<th>Rate</th>
					<th>Action</th>
				</tr>
			</thead>

			<tbody>
				<?php $i=1; foreach($records as $row) :?>
					<tr>
						<td><?php echo $i; $i++;?></td>
						<td><?php echo $row->country; ?></td>
						<td><?php echo $row->currency; ?></td>	
						<td><?php echo $row->rate; ?></td>										
						<td>
							<a href="<?php echo base_url().'index.php/Admin/edit_currency/'.$row->id;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
							<a href="javascript:confirmcancel(<?php echo $row->id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
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
     		data: {table_name:'currency_master', where_key:'id', where_val:id} ,
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
		    error: function (error) {
			   alert("Can't Delete record. Data already exist!!!");
			}
		});
      		return true;
      	}
        else
        	return false;
	    	
}
</script>
