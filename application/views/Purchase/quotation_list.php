<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
		<thead>
		<tr>
			<th>Sr. No</th>
			<th>Supplier Quote Code</th>
			<th>Quotation Date</th>
			<th>Supplier</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php $i=1; foreach($records as $row) :?>
		<tr>
			<td><?php echo  $i; $i++;?></td>				
			<td><?php echo $row->quote_code; ?></td>		
			<td><?php echo date('d-M-Y',strtotime($row->quote_date)); ?></td>			
			<td><?php echo $row->supplier_name; ?></td>
			
			<td>
				<?php if($row->approve==1 && $row->status==0) { 
					 echo "<span class='bg-soft-success'>Accepted</span>";
				}
				else if($row->status==1) { ?>
					 <span class='bg-warning'>Cancelled</span>
					<a href="<?php echo base_url().'index.php/Purchase/edit_purchase_quotation/'.$row->quote_id.'/1/0';?>" title='Edit Quotation'>Info</a>
				<?php }
				else{?>
					<a href="<?php echo base_url().'index.php/Purchase/edit_purchase_quotation/'.$row->quote_id.'/1/1';?>" title="Edit Quotation"><?php echo $this->session->userdata('edit_icon');?></a>
					<a href="javascript:confirmcancel(<?php echo $row->quote_id;?>)" title="Delete"><?php echo $this->session->userdata('delete_icon');?></a>
					<a href="javascript:approve_record(<?php echo $row->quote_id;?>)" class='bg-soft-primary' title="Accept Quotation">Accept</a>
				<?php } ?>
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
	     		url: "<?php echo base_url()?>index.php/Purchase/cancel_record",
	     		type: "POST",
	     		data: {table1:'purchase_quotation',column:'status',value:1,key_name1:'quote_id', post_id1:id} ,
	     		success: function(msg) {
	     			if(msg==1) {
				       alert("Record deleted"); 
					location.reload();			                    		  
				}
				else {
				      	alert("Can't Delete. Data exist !!!");
			       }
			    },
			});
			return true;
	}
	else
        	return false;
}

function approve_record(id)
{   
	var r= confirm("Are you sure you want to Accept Record?");
	if(r == true) 
        {
			$.ajax({
	     		url: "<?php echo base_url()?>index.php/Purchase/cancel_record",
	     		type: "POST",
	     		data: {table1:'purchase_quotation',column:'approve',value:1,key_name1:'quote_id', post_id1:id} ,
	     		success: function(msg) {
	     			if(msg==1) {
				       alert("Record Accepted"); 
					location.reload();			                    		  
				}
				else {
				      	alert("Can't Accepted. Something wrong !!!");
			       }
			    },
			});
			return true;
	}
	else
        	return false;
}
</script>
