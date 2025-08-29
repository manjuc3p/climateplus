<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
                                        <thead>
                                            <tr>
							<th>Sr.no</th>
							<th>Code</th>
							<th>Date</th>
							<th>Customer</th>
							<th>Invoice</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
					<?php $i=1; foreach($records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td><?php echo $row->dc_code;?></td>
							<td><?php echo date('d-M-Y',strtotime($row->dc_date));?></td>
							<td><?php echo $row->cust_name;?></td>
							<td><?php echo $row->invoice_code.'<br>'.date('d-M-Y',strtotime($row->invoice_date));?></td>
							<td>
							<a target='_blank' href="<?php echo base_url().'index.php/Sales/print_dc/'.$row->dc_id;?>" title="print quotation">Print</a>
							<br>
							<!--<a href="<?php echo base_url().'index.php/Sales/dummy_dc/'.$row->dc_id;?>" title="dummy invoice">Make Dummy</a>-->
							<a href="<?php echo base_url().'index.php/Sales/edit_delivery_challan/'.$row->dc_id;?>" title="Edit DO"><?php echo $this->session->userdata('edit_icon');?></a>
							
							<a href="javascript:confirmcancel(<?php echo $row->dc_id;?>,<?php echo $row->invoice_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
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

function confirmcancel(id,invoice_id)
{   
	var r= confirm("Are you sure you want to Delete Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Sales/delete_dc_record",
     		type: "POST",
     		data: {do_id:id,invoice_id:invoice_id} ,
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
