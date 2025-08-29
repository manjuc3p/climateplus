<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
		<thead>
		<tr>
			<th>Srn</th>
			<th>GRN Code</th>
			<th>PO Code</th>
			<th>Supplier Name</th>
			<th>Supplier Invoice</th>
			<th>Warehouse</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php $i=1; foreach($records as $row) :?>
		<tr>
			<td><?php echo  $i; $i++;?></td>
			<td>
				<a target="_blank" href="<?php echo base_url().'index.php/Purchase/edit_grn/'.$row->grn_id.'/'.$row->rev_version;?>"><?php echo $row->grn_code; ?></a><br>
				<?php echo date('d-M-Y',strtotime($row->grn_date)); ?>
			</td>
			<td>
				<a target="_blank" href="<?php echo base_url().'index.php/Purchase/edit_purchase_order/'.$row->po_id.'/'.$row->po_revision;?>"><?php echo $row->po_code; ?></a><br>
				<?php echo date('d-M-Y',strtotime($row->po_date)); ?>
			</td>
			<td><?php echo $row->supplier_name; ?></td>
			<td><?php echo $row->invoice_no.'<br>'.date('d-M-Y',strtotime($row->invoice_date)); ?></td>
			<td><?php echo $row->warehouse_name; ?></td>
			<td>
				
				<a target='_blank' href="<?php echo base_url().'index.php/Purchase/GRN_print/'.$row->grn_id;?>" title="print quotation">Print</a>
				<a href="<?php echo base_url().'index.php/Purchase/edit_grn/'.$row->grn_id;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
				<a href="javascript:confirmcancel(<?php echo $row->grn_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
				<!--<br>
				<a href="javascript:accept(<?php echo $row->grn_id;?>)" title="Accept for stock & Account" class='accept' id='accept'>Accept</a>-->
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
     		url: "<?php echo base_url()?>index.php/Purchase/delete_grn",
     		type: "POST",
     		data: { po_id:id } ,
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
function accept(id)
{   
	var r= confirm("Are you sure to Accept & create Account and Inventory?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Purchase/accept_grn",
     		type: "POST",
     		data: { po_id:id } ,
     		success: function(msg) {
     			if(msg==1) 
     			{     	
			         alert("Record Accepted"); 				
        			 window.location.href="<?php echo $_SERVER['PHP_SELF']?>";   		                    		  
			}
		        else {
			      	alert("Can't Accept record.");
		       }
		    },
		});
      		return true;
      	}
        else
        	return false;
	    	
}
</script>
