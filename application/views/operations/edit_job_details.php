<div class="card-body">
	<?php $dept = $this->session->userdata('dept'); ?>

	<form id="main" method="post" action="<?php echo base_url() . 'index.php/'; ?>Operations/update_job" autocomplete="off" enctype="multipart/form-data">

		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Date </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="date" name="job_date" id="job_date" class="form-control form-control-sm" value='<?php echo $job['new_job_date'] ?? $job['job_date'] ?>' />
			</div>

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Type </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<select name="job_type" tabindex="3" id="job_type" class="form-control form-control-sm" required>
					<option value=''>Select</option>
					<?php
					foreach ($job_types as $j): ?>
						<option value='<?php echo $j->id; ?>' <?php if ($job['job_type'] == $j->id) echo 'selected'; ?>><?php echo $j->job_type; ?></option>
					<?php
					endforeach
					?>

				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Title </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input type='text' name="job_title" id="job_title" class="form-control form-control-sm" tabindex="4" value='<?php echo $job['job_title']; ?>' required />
			</div>

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Time</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="job_time" id="job_time" class="form-control form-control-sm " value='<?php echo $job['job_time']; ?>' />
			</div>

		</div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Company</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="customer" id="customer" class="form-control form-control-sm" value='<?php echo $job['customer']; ?>' />
			</div>

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Contact Number:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="contact" id="contact" class="form-control form-control-sm" value='<?php echo $job['contact']; ?>' />
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Customer Email</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="cust_email" id="cust_email" class="form-control form-control-sm" value='<?php echo $job['customer_email']; ?>' />
			</div>


		</div>

		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Location</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="location" id="location" class="form-control form-control-sm" value='<?php echo $job['job_location']; ?>' required />
			</div>

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Location link</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="location_link" id="location_link" class="form-control form-control-sm" value='<?php echo $job['location_link']; ?>' />
			</div>

		</div>

		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Description </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<textarea name="job_desc" id="job_desc" rows='5' cols='40' class="form-control form-control-sm" tabindex="4" required><?php echo $job['job_desc'] ? $job['job_desc'] : $job['job_title'];  ?></textarea>
			</div>
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Additional Notesh:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<textarea name="addnotes" id="addnotes" class="form-control form-control-sm" rows="5"><?php echo $job['additional_notes'] ?? ''; ?></textarea>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">PO Number: </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="po_number" id="po_number" class="form-control form-control-sm " value='<?php echo $job['po_number']; ?>' />
			</div>
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Invoice Number: </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="invoice_number" id="invoice_number" class="form-control form-control-sm" value='<?php echo $job['invoice_number']; ?>' />
			</div>
		</div>

		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Sales </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<select name="sales" tabindex="3" id="sales" class="form-control form-control-sm select2">
					<option value=''>Select</option>
					<?php foreach ($sales_team as $s): ?>
						<option value='<?php echo $s->user_id; ?>' <?php if ($s->user_id == $job['sales']) echo 'selected'; ?>><?php echo $s->user_name; ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<?php if (trim($dept) == 'Operations' || trim($dept) == 'Admin') { ?>
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Assigned to:</label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
					<select name="staff" tabindex="3" id="staff" class="form-control form-control-sm select2">
						<option value=''>Select</option>
						<?php foreach ($drivers as $d): ?>
							<option value='<?php echo $d->user_id; ?>' <?php if ($d->user_id == $job['staff_assign']) echo 'selected'; ?>><?php echo $d->user_name; ?></option>
						<?php endforeach ?>
					</select>
				</div>
			<?php } ?>

		</div>

		<div class="form-group row">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Payment terms</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<select name="payment_term" tabindex="3" id="payment_term" class="form-control form-control-sm select2">
					<option value=''>Select</option>
					<?php foreach ($payment_terms as $term): ?>
						<option value='<?php echo $term->id; ?>' <?php if ($term->id == $job['payment']) echo 'selected'; ?>><?php echo $term->term; ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<?php if (trim($dept) == 'Accounts' || trim($dept) == 'Admin') { ?>
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Payment status</label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
					<select name="payment_status" tabindex="3" id="payment_status" class="form-control form-control-sm">
						<option value=''>Select</option>
						<option value='Not Paid' <?php if ($job['payment_status'] == 'Not Paid') echo 'selected'; ?>>Not Paid</option>
						<option value='Partial Paid' <?php if ($job['payment_status'] == 'Partial Paid') echo 'selected'; ?>>Partial Paid</option>
						<option value='Paid' <?php if ($job['payment_status'] == 'Not Paid') echo 'selected'; ?>>Paid</option>
						<option value='Under Warranty' <?php if ($job['payment_status'] == 'Under Warranty') echo 'selected'; ?>>Under Warranty</option>
					</select>
				</div>
			<?php } ?>

		</div>

		<div class="form-group row">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label"> Files </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<table class="table table-bordered table-hover" id='tab_logic'>
					<thead>
						<tr>
							<td>Sl</td>
							<td>File</td>
							<td> <a id="add_row" title="Add" class="btn btn-sm bg-blue"><span class="fa fa-plus"></span></a></td>
						</tr>
					</thead>
					<tbody id="file_table">

						<?php $i = 51;
						$k = 1;
						foreach ($job_files as $file) { ?>
							<tr id='<?php echo 'addr' . $i; ?>'>
								<td><?php echo $k;
									$k++; ?></td>
								<td>
									<?php echo $file->document_path; ?>
								</td>
								<td>
									<a download href="<?php echo base_url('public/uploded_documents/job_files/' . $file->document_path); ?>" title="Download" class="btn btn-sm bg-blue"><span class="fa fa-download"></span></a>
									<a download onclick="delete_job_file(<?php echo $i; ?>)" title="Delete" class="btn btn-sm bg-blue"><span class="fa fa-trash"></span></a>
									<input type='hidden' name='<?php echo 'file_id' . $i; ?>' id='<?php echo 'file_id' . $i; ?>' value='<?php echo $file->id; ?>' />
								</td>
							</tr>
						<?php $i++;
						} ?>
						<tr id='addr0'>
							<td><?php echo $k; ?></td>
							<td>
								<input id="job_file0" name="job_file[]" type="file">
							</td>
							<td>

							</td>
						</tr>
						<tr id='addr1'></tr>
					</tbody>
				</table>
				<input type='hidden' name='dltd_files' id='dltd_files' />
			</div>






		</div>




		<?php if (trim($dept) == 'Operations' || trim($dept) == 'Admin') { ?>
			<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Extended/Postponed to:</label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
					<input tabindex="1" type="date" name="new_job_date" id="new_job_date" class="form-control form-control-sm" value='<?php echo $job['new_job_date'] ?>' />
				</div>

				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Comments:</label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
					<textarea name="comments" id="comments" class="form-control form-control-sm"><?php echo $job['comments'] ?></textarea>
				</div>

			</div>

		<?php } ?>
		<?php if (trim($dept) == 'Accounts' || trim($dept) == 'Admin') { ?>
			<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Documents Submitted</label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
					<select name="document_status" tabindex="3" id="document_status" class="form-control form-control-sm">
						<option value=''>Select</option>
						<option value='Yes' <?php if ($job['document_status'] == 'Yes') echo 'selected'; ?>>Yes</option>
						<option value='No' <?php if ($job['document_status'] == 'No') echo 'selected'; ?>>No</option>
					</select>
				</div>

				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Comments:</label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
					<textarea name="doccomments" id="doccomments" class="form-control form-control-sm"><?php echo $job['document_comment'] ?? ''; ?></textarea>
				</div>
			</div>
		<?php } ?>
		<div class="form-group row">
			<input type='hidden' name='job_id' value='<?php echo $job['job_id']; ?>' />
			<input type='hidden' name='dept' value='<?php echo trim($dept); ?>' />
			<label class="col-sm-4"></label>
			<div class="col-sm-8">
				<button type='submit' tabindex="11" class="btn btn-primary m-b-0">Update</button>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function() {
		var k = $("#file_table tr").length;
		var i = 1;
		$("#add_row").click(function() {
			$('#addr' + i).html("<td>" + (k) + "</td><td><input class='form-control' id='job_file" + i + "' name='job_file[]' type='file'></td><td> <a onclick='delete_row(" + i + ")' title='Delete' class='btn btn-sm bg-blue'><span class='fa fa-trash'></span></a></td>");
			$('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
			i++;
		});



	});

	function delete_job_file(row) {
		var conf = confirm("Are you sure to delete?");
		if (conf) {
			var file_id = $('#file_id' + row).val();

			var dltd = $('#dltd_files').val();
			if (dltd == '') {
				dltd = file_id;
			} else {
				dltd = dltd + ',' + file_id;
			}
			$('#dltd_files').val(dltd);
			remove_row(row, 1);
		}


	}

	function remove_row(row, conf) {
		if (conf == 0) {
			conf = confirm("Are you sure to delete?");
		}
		if (conf) {
			$('#addr' + row).remove();
		}

	}
</script>