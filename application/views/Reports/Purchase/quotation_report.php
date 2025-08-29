<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header table-card-header">
					<h5>Quotation Report</h5>
				</div>
				<div class="card-block">
					<form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Reports/get_quotation_report" id="question" method="post" name="question" >
						<div class="form-group row">
							<label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">From <span style="color: red;"> * </span></label>
							<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
								<div class='input-group date' id='datetimepicker1'>
									<input tabindex="1" type="text" class="form-control date_today" id="from" name="from" value="<?php echo $from; ?>" required autocomplete="off">
									<div class="input-group-prepend">
										<span class="input-group-text ">
											<span class="btn btn-primary m-b-0 icofont icofont-ui-calendar"></span>
										</span>
									</div>
								</div>
							</div>

							<label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">To <span style="color: red;"> * </span></label>
							<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
								<div class='input-group date' id='datetimepicker1'>
									<input tabindex="2" type="text" class="form-control date_today" id="to" name="to" value="<?php echo $to; ?>" required autocomplete="off">
									<div class="input-group-prepend">
										<span class="input-group-text ">
											<span class="btn btn-primary m-b-0 icofont icofont-ui-calendar"></span>
										</span>
									</div>
								</div>
							</div>

							<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Quotations</label>
							<div class="col-sm-3">
								<select tabindex="3" name="quotation_id" id="quotation_id" class="form-control select2">
									<option value="">Please Select</option>
									<?php foreach($purchasae_quotation_records as $row) { ?>
										<option <?php if($quotation_id==$row->quotation_id) echo 'selected'; ?> value="<?php echo $row->quotation_id;?>"><?php echo $row->quotation_code.' / '.date('d-m-Y', strtotime($row->quotation_date));?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier Type <span style="color: red;"> * </span></label>
							<div class="col-sm-2">
								<select tabindex="4" name="supplier_type" id="supplier_type" class="form-control" >
									<option value="">Please select </option>
									<option <?php if($supplier_type=='Local') echo 'selected'; ?> value="Local" >Local</option>
									<option <?php if($supplier_type=='Overseas') echo 'selected'; ?> value="Overseas" >Overseas</option>
								</select>
							</div>

							<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Supplier</label>
							<div class="col-sm-3">
								<select tabindex="5" name="supplier_id" id="supplier_id" class="form-control select2" >
									<option value="">Please select</option>
									<?php foreach($supplier_records as $g) { ?>
										<option <?php if($supplier_id==$g->supplier_id) echo 'selected'; ?>  value="<?php echo $g->supplier_id;?>" title="<?php echo $g->email1.' '.$g->email2.' '.$g->email3.' '.$g->email4;?>"><?php echo $g->supplier_code.' '.$g->supplier_name; ?> </option>
									<?php } ?>
								</select>
							</div>

							<div class="col-sm-2">
								<table>
									<tr>
										<td>
											<input tabindex="6" type="submit" id="view" name="go" value="Go" class="btn btn-sm btn-primary m-b-0" />
										</form>
									</td>
									<td>&nbsp;</td>
									<td>
										<form target="_blank" action="<?php echo base_url().'index.php/'; ?>Reports/print_quotation_report" id="ques1" method="post" name="ques1" >
											<input type="hidden" name="from" value="<?php echo $from; ?>" />
											<input type="hidden" name="to" value="<?php echo $to; ?>" />
											<input type="hidden" name="quotation_id" value="<?php echo $quotation_id; ?>" />
											<input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>" />
											<input type="hidden" name="supplier_type" value="<?php echo $supplier_type; ?>" />
											<input tabindex="7" type="submit" id="print" value="Print" class="btn btn-warning btn-sm" />
										</form></td>
										<td>&nbsp;</td>
										<td>
											<form action="<?php echo base_url().'index.php/'; ?>Reports/export_quotation_report" id="ques1" method="post" name="ques1" >
												<input type="hidden" name="from" value="<?php echo $from; ?>" />
												<input type="hidden" name="to" value="<?php echo $to; ?>" />
												<input type="hidden" name="quotation_id" value="<?php echo $quotation_id; ?>" />
												<input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>" />
												<input type="hidden" name="supplier_type" value="<?php echo $supplier_type; ?>" />
												<input tabindex="8" type="submit" id="export" value="Export to excel" class="btn btn-warning btn-sm" />
											</form>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<div class="dt-responsive table-responsive">
							<table id="basic-btn" class="table table-striped table-bordered nowrap">
								<thead>
									<tr>
										<th>Sr. No</th>
										<th>Quotation No</th>
										<th>Quotation Date</th>
										<th>Supplier</th>
										<th>Supplier Quote Code</th>
										<th>Delivery Date</th>
										<th>Revision</th>
										<th>Created By</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; foreach($records as $row) :?>
										<tr>
											<td><?php echo  $i; $i++;?></td>
											<td><?php echo $row->quotation_code; ?></td>
											<td><?php echo date('d-M-Y',strtotime($row->quotation_date)); ?></td>
											<td><?php echo $row->supplier_name; ?></td>
											<td><?php echo $row->supplier_Qcode; ?></td>
											<td><?php echo date('d-M-Y',strtotime($row->delivery_date)); ?></td>
											<td>
												<?php  $ev=$row->rev_version;
												for($k=1; $k <= $ev; $k++)
												{?>
													<u><a href="<?php echo base_url().'index.php/Purchase/edit_purchase_quotation/'.$row->quotation_id.'/'.$k.'/0';?>" title="View Revision" >Revision <?php echo $k; ?></a></u><br>
												<?php }
												?>
											</td>
											<td><?php echo $row->rfq_created_by; ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
								<tfoot>
									<tr>
										<th>Sr. No</th>
										<th>Quotation No</th>
										<th>Quotation Date</th>
										<th>Supplier</th>
										<th>Supplier Quote Code</th>
										<th>Delivery Date</th>
										<th>Revision</th>
										<th>Created By</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- End Page Body -->
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

<script type="text/javascript">
$(function()
{
	$('#supplier_type').change(function() {
		var age = {
			supplier_type:$('#supplier_type').val()
		};

		$.ajax({
			url: "<?php echo site_url('Reports/get_supplier_on_change_supplier_type'); ?>",
			type: 'POST',
			data: age,
			success: function(msg) {
				$("#supplier_id").html(msg);
			}
		});
	});
});
</script>
