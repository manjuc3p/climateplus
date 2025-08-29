<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header table-card-header">
					<h5>Indent Report</h5>
				</div>
				<div class="card-block">
					<form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Reports/get_indent_report" id="question" method="post" name="question" >
						<div class="form-group row">
							<label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">From</label>
							<div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
								<input tabindex="1" type="text" class="form-control date_today" id="from" name="from" value="<?php echo $from; ?>" required autocomplete="off">
							</div>

							<label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">To</label>
							<div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
								<input tabindex="2" type="text" class="form-control date_today" id="to" name="to" value="<?php echo $to; ?>" required autocomplete="off">
							</div>

							<label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">Project</label>
							<div class="col-sm-2">
								<select tabindex="3" name="project" id="project" class="form-control  select2">
									<option value="">Please Select</option>
									<?php foreach($project_records as $r):?>
										<option <?php if($project==$r->project_id):?> selected <?php endif;?> value="<?php echo $r->project_id?>" ><?php echo $r->project_code.' '.$r->project_name;?></option>
									<?php endforeach;?>
								</select>
							</div>

							<input type="submit" id="view" name="quessubhmit" value="Go" class="btn btn-warning btn-sm" />
						</div>
					</form>

					<div class="dt-responsive table-responsive">
						<table id="basic-btn" class="table table-striped table-bordered nowrap">
							<thead>
								<tr>
									<th>Sr. No</th>
									<th>Indent Code</th>
									<th>Indent Date</th>
									<th>Project Name</th>
									<th>Created By</th>
									<!--<th>Action</th>-->
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach($records as $row) :?>
									<tr>
										<td><?php echo  $i; $i++;?></td>
										<td><a target='blank' href="<?php echo base_url().'index.php/Purchase/view_purchase_indent_details/'.$row->indent_id.'/'.$row->rev_version;?>"><?php echo $row->indent_code; ?></a></td>
										<td><?php echo date('d-M-Y', strtotime($row->indent_date));?></td>
										<td><?php echo $row->project_code.' '.$row->project_name; ?></td>

										<td><?php echo $row->created_by; ?></td>
										<!--<td>
										<a href="<?php echo base_url().'index.php/Purchase/edit_grn/'.$row->rfq_id.'/'.$row->rev_version;?>" title="Edit GRN" class="badge badge-success"><span class="fa fa-edit"></span></a>
									</td>-->
								</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Sr. No</th>
								<th>Indent Code</th>
								<th>Indent Date</th>
								<th>Project Name</th>
								<th>Created By</th>
								<!--<th>Action</th>-->
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
</div>
</div>
</div>
</div>
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
function showmodal(indent_id,version)
{
	$('#indent-Modal').modal('show');
	document.getElementById('indent_id').value=indent_id;
	document.getElementById('version').value=version;
	return true;
}
</script>
