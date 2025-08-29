<div class="card-body">
					<div class="dt-responsive table-responsive">
						<table id="datatable" class="table table-striped" data-toggle="data-table">
							<thead>
								<tr>
									<th>Sr.No</th>
									<th>VAT %</th>
									<th>Applicable From</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody>
								<?php $i=1; foreach($records as $row) :?>
									<tr>
										<td><?php echo $i; $i++;?></td>
										<td><?php echo $row->vat_percent; ?></td>
										<td><?php echo date('d-M-Y',strtotime($row->applicable_date));?></td>
										<td>
											<a href="<?php echo base_url().'index.php/Admin/edit_tax/'.$row->vat_id;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
											<a href="javascript:confirmcancel(<?php echo $row->vat_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
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
     		data: {table_name:'vat_master', where_key:'vat_id', where_val:id} ,
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
