<?php $dept = $this->session->userdata('dept'); ?>
<div class="card-body">
	<div class="dt-responsive table-responsive">
		<table id="datatable" class="table table-striped" data-toggle="data-table">
			<thead>
				<tr>
					<th style='width:3%'>Sr.no</th>
					<th style='width:20%'>Company</th>
					<th style='width:30%'>Job Title</th>
					<th style='width:12%'>Completed by</th>
					<th style='width:15%'>Collected Amt</th>
					<th style='width:10%'>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;
				foreach ($records as $row) : ?>
					<tr>
						<td style='width:3%'><?php echo $i;
												$i++; ?></td>

						<td style='width:20%'> <a href='<?php echo base_url() . 'index.php/Operations/edit_job_details/' . $row->job_id; ?>' style="color:blue"><?php echo $row->customer; ?></a>
							<br><?php echo date("d-M-Y", strtotime($row->new_job_date ?? $row->job_date)); ?>
						</td>

						<td style='width:30%'><?php echo $row->job_title; ?></td>
						<td style='width:12%'><?php echo $row->staff; ?></td>
						<td style='width:15%'>
							<?php echo $row->amount_collected; ?><br>
							<?php if ($row->collected_by_accounts == 0) { ?><a href="javascript:mark_as_paid(<?php echo $row->job_id; ?>)" title="Update">Update Collection </a><?php } else { ?>Payment received<?php } ?>
						</td>
						<td style='width:10%'>

							<?php if ($row->esr_file != '') { ?>
								<a target='_blank' href="<?php echo base_url($row->esr_file); ?>"><?php echo $row->report_abbr; ?></a><br>
							<?php } ?>
							<?php if ($row->customer_email != '') { ?>
								<a href="<?php echo base_url() . 'index.php/Operations/send_mail/' . $row->job_id; ?>" title="Email">Email</a>

							<?php } ?>

						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>





<script>
	function mark_as_paid(job_id) {

		var r = confirm("Are you sure to update the payment as received?");
		if (r == true) {
			$.ajax({
				url: "<?php echo base_url() ?>index.php/Operations/mark_as_received",
				type: "POST",
				data: {
					job_id: job_id
				},
				success: function(msg) {

					if (msg) {
						alert("Status updated");
						window.location.href = window.location.pathname;;
					} else {
						alert("Can't Update!!!");
					}
				},
			});
			return true;
		} else
			return false;

	}
</script>