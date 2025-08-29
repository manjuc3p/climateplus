<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
                                        <thead>
                                            <tr>
							<th>Srn</th>
							<th>Invoice</th>
							<th>Quotation</th>
							<th>Customer</th>
							<th>Grand total</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
					<?php $i=1; foreach($records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td>
								<?php echo $row->invoice_code;?><br>
								<?php echo date('d-M-Y',strtotime($row->invoice_date));?>
							</td>
							<td>
								<?php echo $row->quotation_code;?><br>
								<?php echo date('d-M-Y',strtotime($row->quotation_date));?>
							</td>
							<td><?php echo $row->cust_name;?></td>
							<td><?php echo $row->grand_total;?></td>
							<td>
							<a target='_blank' href="<?php echo base_url().'index.php/Sales/print_invoice/'.$row->invoice_id;?>" title="print Invoice">Print</a>
							<!-- <a href="<?php echo base_url().'index.php/Sales/edit_invoice/'.$row->invoice_id.'/1';?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
							
							<a href="javascript:confirmcancel(<?php echo $row->invoice_id;?>,<?php echo $row->quote_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a><br> -->
							<!--<a href="<?php echo base_url().'index.php/Sales/dummy_invoice/'.$row->invoice_id;?>" title="dummy invoice">Make Dummy</a><br>
							<a  href="<?php echo base_url().'index.php/Sales/excel_invoice/'.$row->invoice_id;?>" title="print quotation">Excel</a>-->
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

function confirmcancel(id,quote_id)
{   
	var r= confirm("Are you sure you want to Delete Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Sales/delete_invoice",
     		type: "POST",
     		data: {invoice_id:id, quote_id:quote_id} ,
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
