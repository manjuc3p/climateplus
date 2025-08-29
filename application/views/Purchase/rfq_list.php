<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
                                        <thead>
                                            <tr>
							<th>Sr.no</th>
							<th>RFQ Code</th>
							<th>Date</th>
							<th>Supplier</th>
							<th>Source</th>
							<th>Client Ref</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
					<?php $i=1; foreach($records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td>
								<a href="<?php echo base_url().'index.php/Sales/edit_enquiry/'.$row->rfq_id.'/1';?>" title="details">
								<?php echo $row->rfq_code;?>
								</a>
							</td>
							<td><?php echo date('d-M-Y',strtotime($row->rfq_date));?></td>
							<td>
								<a title="View customer details" target='blank' href="<?php echo base_url().'index.php/Users/edit_supplier/'.$row->supplier_id;?>" >
								<?php echo $row->supplier_name;?>
								</a>
							</td>
							
							<td>
								<a href="<?php echo base_url().'index.php/Sales/edit_enquiry/'.$row->indent_id.'/1';?>" title="details">
								<?php echo $row->enquiry_code;?>
								</a>
							</td>
							<td><?php echo $row->client_ref;?></td>
							<td>
							<a target='_blank' href="<?php echo base_url().'index.php/Purchase/print_rfq/'.$row->rfq_id.'/1/'.$row->rev_version;?>" title="PDF" class="btn btn-sm btn-primary m-b-0">Print/PDF</a>
							<a href="<?php echo base_url().'index.php/Purchase/export_excel_rfq/'.$row->rfq_id.'/1/'.$row->rev_version;?>" title="Excel" class="btn btn-sm btn-primary m-b-0">Excel</a>
							<a href="javascript:confirmcancel(<?php echo $row->rfq_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
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

function confirmcancel(rid)
{   
	var r= confirm("Are you sure you want to Delete Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Purchase/delete_rfq",
     		type: "POST",
     		data: {rid:rid} ,
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
