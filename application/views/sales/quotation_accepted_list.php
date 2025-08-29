<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table" data-toggle="data-table">
                                        <thead>
                                            <tr>
							<th>Sno</th>
							<th>Quotation</th>
							<th>Revision</th>
							<th>Customer</th>
							<th>Client PO</th>
							<th>Approved By</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody style="font-size:12px; font-weight:700px;">
					<?php $i=1; foreach($records as $row) :?>
						<tr <?php if($row->status==1){ echo "class='bg-soft-danger'"; } else { if($row->approval==1) echo "class='bg-soft-success'"; else echo "class='bg-soft-danger'"; }?>>
							<td><?php echo $i;$i++;?></td>
							<td>
								<?php echo $row->quotation_code;?><br>
								<?php echo date('d-M-Y',strtotime($row->quotation_date));?><br>
								<?php if($row->status==1){ echo "<b>Order Cancelled</b>"; }?>
							</td>
							<td><?php echo 'R'.$row->revision;?></td>
							<td ><?php echo $row->cust_name;?></td>
							<td>
								<?php // echo $row->po_number;?><br>
								<a target='blank' href="<?php echo base_url().'index.php/Sales/view_quotation_files/'.$row->quote_id?>">View/Uploded Files</a>
							</td>
							<td><?php echo date('d-M-Y',strtotime($row->approval_date));?></td>
							
							<td>
							<?php if($row->approval==1 && $row->invoice_id==0) { ?>
							<a href="<?php echo base_url().'index.php/Sales/edit_quotation/'.$row->quote_id.'/'.$row->revision.'/1';?>" title="Edit" class="btn btn-sm btn-primary m-b-6">Unlock & Edit</a>
							<a href="javascript:confirmcancel(<?php echo $row->quote_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
							
							<?php } else if($row->approval==2) {?>
								<a href="<?php echo base_url().'index.php/Sales/edit_quotation/'.$row->quote_id.'/'.$row->revision.'/1';?>" title="Edit" class="btn btn-sm btn-primary m-b-3">Accept</a>
							<?php } ?><br>
							<a target='_blank' href="<?php echo base_url().'index.php/Sales/print_quotation/'.$row->quote_id.'/'.$row->revision.'/logo';?>" title="print quotation">Print With Logo</a><br>
							<a target='_blank' href="<?php echo base_url().'index.php/Sales/print_quotation/'.$row->quote_id.'/'.$row->revision;?>" title="print quotation">Print</a>
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
	var r= confirm("Are you sure you want to Cancel Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Ajax/cancel_record",
     		type: "POST",
     		data: {table1:'sales_quotation_master', column:'status', value:'1', key_name1:'quote_id', post_id1:id} ,
     		success: function(msg) {
     			if(msg==1) 
     			{     	
			         alert("Record Cancel"); 				
        			 window.location.href="<?php echo $_SERVER['PHP_SELF']?>";   		                    		  
			}
		        else {
			      	alert("Can't Cancel record. Data already exist!!!");
		       }
		    },
		});
      		return true;
      	}
        else
        	return false;
	    	
}
</script>
