<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
                                        <thead>
                                            <tr>
							<th>Sr.no</th>
							<th>Quotation Code</th>
							<th>Revision</th>
							<th>Customer & Customer Ref</th>
							<th>Grand total</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
					<?php $i=1; foreach($records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td><?php echo $row->quotation_code;?>
							<br>
							<?php echo date('d-M-Y',strtotime($row->quotation_date));?>
							</td>
							<td>
							<?php  $ev=$row->revision;
							
								for($k=0; $k <= $ev; $k++)
								{?>
									<u><a target='_blank' href="<?php echo base_url().'index.php/Sales/print_quotation/'.$row->quote_id.'/'.$k.'/'.$row->enq_type;?>" title="View Revision" >Revision <?php echo $k; ?></a></u><br>
								<?php } 
							
							 ?>
							</td>
							<td>
								<a title="View customer details" target='blank' href="<?php echo base_url().'index.php/Users/edit_customer/'.$row->customer_id;?>" >
								<?php echo $row->cust_name;?>
								</a>
								<br>
								<?php echo $row->client_ref;?>
							</td>
							<td><?php echo $row->grand_total;?>
							
							</td>
							<td>
							<a href="<?php echo base_url().'index.php/Sales/edit_quotation/'.$row->quote_id.'/'.$row->revision.'/1';?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>							
							<a href="javascript:confirmcancel(<?php echo $row->quote_id;?>,<?php echo $row->enq_master_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
							<br>
							<a  href="<?php echo base_url().'index.php/Sales/excel_quotation/'.$row->quote_id.'/'.$row->revision.'/'.$row->enq_type;?>" title="Excel quotation">Excel</a>			
							 <a target='_blank' href="<?php echo base_url().'index.php/Sales/print_quotation/'.$row->quote_id.'/'.$row->revision.'/'.$row->enq_type.'/1';?>" title="print quotation">Print</a>
							 <br>
							 <a target='_blank' href="<?php echo base_url().'index.php/Sales/print_quotation/'.$row->quote_id.'/'.$row->revision.'/'.$row->enq_type.'/2'?>" title="print quotation">Print with disc</a>  
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

function confirmcancel(id,enq_master_id)
{   
	var r= confirm("Are you sure you want to Delete Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Ajax/delete_sales_quotation",
     		type: "POST",
     		data: { quoteID:id, enq_master_id:enq_master_id} ,
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
