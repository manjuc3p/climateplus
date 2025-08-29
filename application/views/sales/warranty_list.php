<div class="card-body">
					<div class="dt-responsive table-responsive">
						<table id="datatable" class="table table-striped" data-toggle="data-table">
							<thead>
								<tr>
									<th>Sr.No</th>
									<th>Warranty Code</th>
									<th>Invoice Code</th>
                                    <th>Customer Name</th>
                                    <th>Created on</th>
                                    <th></th>
								</tr>
							</thead>

							<tbody>
								<?php $i=1; foreach($records as $row) :?>
									<tr>
										<td><?php echo $i; $i++;?></td>
										<td><?php echo $row->warr_code; ?></td>		
                                        <td><?php echo $row->inv_code; ?></td>							
                                        <td><?php echo $row->cust_name; ?></td>	
                                        <td><?php echo $row->created_on; ?></td>	
										<td>
                                        <a href="<?php echo base_url().'index.php/Sales/print_warranty/'.$row->warr_id;?>" title="Print" class="print" id="print"><span class="fa fa-print"></span></a>&nbsp;&nbsp;&nbsp;
										<a href="javascript:confirmcancel(<?php echo $row->warr_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
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
     		url: "<?php echo base_url()?>index.php/Sales/delete_warranty",
     		type: "POST",
     		data: {warr_id:id} ,
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
