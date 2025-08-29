<div class="page-body">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header table-card-header">
          <h5>GRN Report</h5>
        </div>
        <div class="card-block">
          <form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Reports/get_GRN_report" id="question" method="post" name="question" >
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

              <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Created By</label>
              <div class="col-sm-2">
                <select tabindex="3" name="created_by" id="created_by" class="form-control select2">
                  <option value="">Select User Name</option>
                  <?php foreach($user_list as $row) { ?>
                    <option <?php if($created_by==$row->employee_id) echo 'selected'; ?> value="<?php echo $row->employee_id;?>"><?php echo $row->first_name.' '.$row->last_name;?></option>
                  <?php } ?>
                </select>
              </div>

              <label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">Status</label>
              <div class="col-sm-2">
                <select tabindex="4" name="status" id="status" class="form-control">
                  <option value="" >Please Select</option>
                  <option <?php if($status == '0') echo 'selected'; ?> value="0">Active</option>
                  <option <?php if($status == '1') echo 'selected'; ?> value="1">Inactive</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier Type <span style="color: red;"> * </span></label>
              <div class="col-sm-2">
                <select tabindex="5" name="supplier_type" id="supplier_type" class="form-control"  >
                  <option value="">Please select </option>
                  <option <?php if($supplier_type=='Local') echo 'selected'; ?> value="Local" >Local</option>
                  <option <?php if($supplier_type=='Overseas') echo 'selected'; ?> value="Overseas" >Overseas</option>
                </select>
              </div>

              <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Supplier</label>
              <div class="col-sm-3">
								<select tabindex="6" name="supplier_id" id="supplier_id" class="form-control select2" >
					      <option value="">Please select</option>
					      <?php foreach($supplier_records as $g) { ?>
						   <option <?php if($supplier_id==$g->supplier_id) echo 'selected'; ?>  value="<?php echo $g->supplier_id;?>" title="<?php echo $g->email1.' '.$g->email2.' '.$g->email3.' '.$g->email4;?>"><?php echo $g->supplier_code.' '.$g->supplier_name; ?> </option>
					      <?php } ?>
					      </select>
              </div>
              </div>

            <div class="form-group row">
              <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">PO No.</label>
              <div class="col-sm-3">
								<select tabindex="7" name="po_id" id="po_id" class="form-control select2" >
					      <option value="">Please select</option>
					      <?php foreach($po_code_records as $g) { ?>
						   <option <?php if($po_id==$g->po_id) echo 'selected'; ?>  value="<?php echo $g->po_id;?>" ><?php echo $g->po_code.' / '.date('d-m-Y', strtotime($g->po_date)); ?> </option>
					      <?php } ?>
					      </select>
              </div>

              <div class="col-sm-2">
                <table>
                  <tr>
                    <td>
                      <input tabindex="8" type="submit" id="view" name="go" value="Go" class="btn btn-sm btn-primary m-b-0" />
                    </form>
                  </td>
                  <td>&nbsp;</td>
                  <td>
                    <form target="_blank" action="<?php echo base_url().'index.php/'; ?>Reports/print_GRN_report" id="ques1" method="post" name="ques1" >
                      <input type="hidden" name="from" value="<?php echo $from; ?>" />
                      <input type="hidden" name="to" value="<?php echo $to; ?>" />
                      <input type="hidden" name="status" value="<?php echo $status; ?>" />
                      <input type="hidden" name="created_by" value="<?php echo $created_by; ?>" />
                      <input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>" />
                      <input type="hidden" name="supplier_type" value="<?php echo $supplier_type; ?>" />
                      <input type="hidden" name="po_id" value="<?php echo $po_id; ?>" />
                      <input tabindex="9" type="submit" id="print" value="Print" class="btn btn-warning btn-sm" />
                    </form></td>
                    <td>&nbsp;</td>
                    <td>
                      <form action="<?php echo base_url().'index.php/'; ?>Reports/export_GRN_report" id="ques1" method="post" name="ques1" >
                        <input type="hidden" name="from" value="<?php echo $from; ?>" />
                        <input type="hidden" name="to" value="<?php echo $to; ?>" />
                        <input type="hidden" name="status" value="<?php echo $status; ?>" />
                        <input type="hidden" name="created_by" value="<?php echo $created_by; ?>" />
                        <input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>" />
                        <input type="hidden" name="supplier_type" value="<?php echo $supplier_type; ?>" />
                        <input type="hidden" name="po_id" value="<?php echo $po_id; ?>" />
                        <input tabindex="10" type="submit" id="export" value="Export to excel" class="btn btn-warning btn-sm" />
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
              			<th>GRN Code</th>
              			<th>GRN Date</th>
              			<th>Supplier Name</th>
              			<th>Supplier Invoice</th>
              			<th>Warehouse</th>
              			<th>Created By</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach($records as $row) :?>
                    <tr>
                      <td><?php echo  $i; $i++;?></td>
                			<td><a href="<?php echo base_url().'index.php/Purchase/edit_grn/'.$row->grn_id.'/'.$row->rev_version;?>"><?php echo $row->grn_code; ?></a></td>
                			<td><?php echo date('d-M-Y',strtotime($row->grn_date)); ?></td>
                			<td><?php echo $row->supplier_name; ?></td>
                			<td><?php echo $row->invoice_id.'<br>'.date('d-M-Y',strtotime($row->invoice_date)); ?></td>
                			<td><?php echo $row->warehouse_name; ?></td>
                			<td><?php echo $row->createdBy; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Sr. No</th>
              			<th>GRN Code</th>
              			<th>GRN Date</th>
              			<th>Supplier Name</th>
              			<th>Supplier Invoice</th>
              			<th>Warehouse</th>
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
