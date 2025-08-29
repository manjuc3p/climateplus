<div class="card-body">
	<div class="dt-responsive table-responsive">
		<table id="datatable" class="table table-striped" data-toggle="data-table">
				<thead>
					<tr>
					<th>Sr. No</th>
					<th>Job card Code</th>
					<th>Quotation</th>
					<th>Customer Name</th>
					<th>Project Name</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				 
				$i=1; foreach($records as $row) :?>
				<tr>
					
					<td><?php echo  $i; $i++;?></td>
					<td><a target='_blank' href="<?php echo base_url().'index.php/Sales/edit_job_card/'.$row->jcard_id.'/'.$row->revision.'/0';?>"><?php echo $row->jcode; ?></a><br>
						<?php echo date('d-M-Y',strtotime($row->card_date)); ?></td>
					<td>
						<a target='_blank' href="<?php echo base_url().'index.php/Sales/edit_quotation/'.$row->quot_master_id.'/'.$row->revision.'/0';?>"><?php echo $row->quotation_code; ?></a>
					<br>
						<?php echo date('d-M-Y',strtotime($row->quotation_date)); ?>
					</td>
					<td>
						<a target='blank' title="customer details" href="<?php echo base_url().'index.php/Setup/edit_customer/'.$row->customer_id ?>">
							<b><?php echo $row->cust_name; ?></b>
						</a>
					</td>
					<td><?php echo $row->project_name; ?></td>
					<td><?php  echo date('Y-m-d', strtotime($row->job_start_date));?></td>
					<td><?php echo date('d-M-Y',strtotime($row->job_end_date)); ?></td>
					
					<td>
					<?php if($row->status==0) $x=1; else $x=0;?>
						<a href="<?php echo base_url().'index.php/Sales/edit_job_card/'.$row->jcard_id.'/'.$x;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
						<a href="javascript:confirmcancel(<?php echo $row->jcard_id;?>)" title="Delete" disabled><?php echo $this->session->userdata('delete_icon');?></a>
						
						<a target='blank' href="<?php echo base_url().'index.php/Sales/print_job_card_records/'.$row->jcard_id;?>" title="Print Cut sheet details">Print</a>
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

</body>
</html>






<script>
function showmodal(indent_id,version,level)
{
	$('#indent-Modal').modal('show');
	document.getElementById('indent_id').value=indent_id;
	document.getElementById('version').value=version;
	document.getElementById('level_no').value=level;
         return true;
}

function confirmcancel(id)
{
	var r= confirm("Are you sure you want to delete record?");
	if(r == true)
        {
	
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Sales/delete_jobcard",
     		type: "POST",
     		data: {jcard_id:str(id)} ,
     		success: function(msg) {
     			if(msg==1) {
			       alert("Record Deleted");
				location.reload();
			}
		        else {
			      	alert("Something went wrong!!!");
		       }
		    },
		});
      		return true;
      	}
        else
        	return false;

}


function approve(id)
{
	var r= confirm("Are you sure you want to mark it as Order Completed?");
	if(r == true)
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Production/mark_job_card_order_complete",
     		type: "POST",
     		data: {jcard_id:id} ,
     		success: function(msg) {
     			if(msg==1) {
			       alert("Record Marked as Order Completed");
			       location.reload();
			}
		        else {
			      	alert("Something went wrong!!!");
		       }
		    },
		});
      		return true;

      	}
        else
        	return false;

}
</script>
