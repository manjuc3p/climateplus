<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
                                        <thead>
                                            <tr>
							<th>Sr.no</th>
							<th>Customer</th>
							<th>SAT Date</th>
							<th>Quotaion</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
					<?php $i=1; foreach($records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td><?php echo $row->cust_code.' '.$row->cust_name;?></td>
							<td><?php echo date('d-M-Y',strtotime($row->inspection_date));?></td>
							<td><?php echo $row->quotation_code;?></td>
							<td>
							<a target='_blank' href="<?php echo base_url().'index.php/Sales/print_SAT_certificate/'.$row->sat_id;?>" title="print quotation">Print</a>
							<br>
							<a href="<?php echo base_url().'index.php/Sales/edit_SAT_data/'.$row->sat_id;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
							<a href="javascript:confirmcancel(<?php echo $row->sat_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
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
     		url: "<?php echo base_url()?>index.php/Sales/delete_pl_record",
     		type: "POST",
     		data: {pl_id:id} ,
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
