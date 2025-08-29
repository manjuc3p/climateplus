<div class="card-body">
	<div class="dt-responsive table-responsive">
		<table id="datatable" class="table table-striped" data-toggle="data-table">
			<thead>
				<tr>
					<th>Sl no</th>
					<th>Job Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=1; foreach($job_types as $j) :?>
				<tr>
					<td><?php echo  $i;?></td>
					<td><?php echo  $j->job_type;?></td>
					<td>
						<a href="<?php echo base_url().'index.php/Setup/edit_job_type/'.$j->id;?>" title="Edit"><?php echo $this->session->userdata('edit_icon');?></a>
						
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
						
		  </table>
					</div>
				

        </div>
    </div>
</div>

    
<script>

</script>
