<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
                                        <thead>
                                            <tr>
							<th>Sr.no</th>
							<th>Enq Code</th>
							<th>Date</th>
							<th>Customer</th>
							<th>Client Ref</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
					<?php $i=1; foreach($records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td>
								<a href="<?php echo base_url().'index.php/Sales/edit_enquiry/'.$row->enquiry_id.'/1';?>" title="details">
								<?php echo $row->enquiry_code;?><br>
								<?php if ($row->enq_type=='1') echo 'Trading'; else if($row->enq_type=='2') echo 'Manufacturing'; else if ($row->enq_type=='3') echo 'Machine Sales';?>
								</a>
							</td>
							<td>
								<?php echo date('d-M-Y',strtotime($row->enq_date));?><br>
								<?php  $ev=$row->revision;
								if($row->revision>0)
								{
									for($k=0; $k <= $ev; $k++)
									{?>
										<u><a target='_blank' href="<?php echo base_url().'index.php/Sales/edit_enquiry/'.$row->enquiry_id.'/0'.'/'.$k;?>"  title="View Revision" >Revision <?php echo $k; ?></a></u><br>
									<?php } 
								}
								 ?>
							</td>
							<td>
								<a title="View customer details" target='blank' href="<?php echo base_url().'index.php/Users/edit_customer/'.$row->cust_id;?>" >
								<?php echo $row->cust_name;?>
								</a>
							</td>
							<td><?php echo $row->client_ref;?></td>
							<td>
							<a href="<?php echo base_url().'index.php/Sales/edit_enquiry/'.$row->enquiry_id.'/1'.'/'.$row->revision;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
							<a href="javascript:confirmcancel(<?php echo $row->enquiry_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
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

function confirmcancel(enquiry_id)
{   
	var r= confirm("Are you sure you want to Delete Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Sales/delete_enquiry",
     		type: "POST",
     		data: {enquiry_id:enquiry_id} ,
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
