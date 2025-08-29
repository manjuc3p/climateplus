<div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped" data-toggle="data-table">
                                        <thead>
                                            <tr>
						<th>Sr.no</th>
						<th>PO Code</th>
						<th>PO Date</th>
						<th>Supplier & Ref No</th>
						<th>Grand total</th>
						<th>Action</th>
					   </tr>
					</thead>

					<tbody>
					<?php $i=1; foreach($records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td>
								<?php echo $row->po_code;?><br>
								<?php  $ev=$row->revision;
								if($row->revision>0)
								{
									for($k=1; $k <= $ev; $k++)
									{?>
										<u><a target='_blank' href="<?php echo base_url().'index.php/Purchase/PO_print/'.$row->po_id.'/'.$k.'/0';?>" title="View Revision" >Revision <?php echo $k; ?></a></u><br>
									<?php } 
								}
							 ?>
							</td>
							<td>
							<?php echo date('d-M-Y',strtotime($row->po_date));?>
							</td>
							</td>
							<td>
								<a title="View supplier details" target='blank' href="<?php echo base_url().'index.php/Users/edit_supplier/'.$row->supplier_id;?>" >
								<?php echo $row->supplier_name;?>
								</a>
								<br>
								<?php echo $row->supplier_ref;?>
							</td>
							<td><?php echo $row->grand_total;?>
							
							</td>
							<td>
							
							<a target='_blank' href="<?php echo base_url().'index.php/Purchase/PO_print/'.$row->po_id.'/'.$row->revision;?>" title="print quotation">Print</a>
							<a href="<?php echo base_url().'index.php/Purchase/edit_PO_direct/'.$row->po_id.'/'.$row->revision.'/1';?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
							<a href="javascript:confirmcancel(<?php echo $row->po_id;?>)" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a>
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
     		url: "<?php echo base_url()?>index.php/Purchase/delete_po",
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
</script>
