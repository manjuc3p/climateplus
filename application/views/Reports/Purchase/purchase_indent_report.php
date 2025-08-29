<div class="page-body">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header table-card-header">
          <h5>Purchase Indent Report</h5>
        </div>
        <div class="card-block">
          <form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Reports/get_purchase_indent_report" id="question" method="post" name="question" >
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
            </div>

            <div class="form-group row">
              <label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">Status</label>
              <div class="col-sm-2">
                <select tabindex="4" name="status" id="status" class="form-control">
                  <option value="" >Please Select</option>
                  <option <?php if($status == '0') echo 'selected'; ?> value="0">Active</option>
                  <option <?php if($status == '1') echo 'selected'; ?> value="1">Inactive</option>
                </select>
              </div>

              <div class="col-sm-2">
                <table>
                  <tr>
                    <td>
                      <input tabindex="5" type="submit" id="view" name="go" value="Go" class="btn btn-sm btn-primary m-b-0" />
                    </form>
                  </td>
                  <td>&nbsp;</td>
                  <td>
                    <form target="_blank" action="<?php echo base_url().'index.php/'; ?>Reports/print_purchase_indent_report" id="ques1" method="post" name="ques1" >
                      <input type="hidden" name="from" value="<?php echo $from; ?>" />
                      <input type="hidden" name="to" value="<?php echo $to; ?>" />
                      <input type="hidden" name="status" value="<?php echo $status; ?>" />
                      <input type="hidden" name="created_by" value="<?php echo $created_by; ?>" />
                      <input tabindex="6" type="submit" id="print" value="Print" class="btn btn-warning btn-sm" />
                    </form></td>
                    <td>&nbsp;</td>
                    <td>
                      <form action="<?php echo base_url().'index.php/'; ?>Reports/export_purchase_indent_report" id="ques1" method="post" name="ques1" >
                        <input type="hidden" name="from" value="<?php echo $from; ?>" />
                        <input type="hidden" name="to" value="<?php echo $to; ?>" />
                        <input type="hidden" name="status" value="<?php echo $status; ?>" />
                        <input type="hidden" name="created_by" value="<?php echo $created_by; ?>" />
                        <input tabindex="7" type="submit" id="export" value="Export to excel" class="btn btn-warning btn-sm" />
                      </form>
                    </td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="dt-responsive table-responsive">
              <table id="basic-btn" class="table table-bordered nowrap">
                <thead>
                  <tr>
                    <th>Sr. No</th>
                    <th>Indent Code</th>
                    <th>Indent Date</th>
                    <th>Created By</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach($records as $row) :?>
                    <tr <?php if($row->status==1) { echo  "style='background-color:#ffeaec' title=Inactive"; } ?> >
                      <td><?php echo  $i; $i++;?></td>
                      <td><a target="_blank" href="<?php echo base_url().'index.php/Purchase/edit_purchase_indent/'.$row->indent_id.'/'.$row->rev_version.'/'.'0';?>" title="Purchase Indent Details" ><?php echo $row->indent_code; ?></a></td>
                      <td><?php echo date('d-M-Y', strtotime($row->indent_date));?></td>
                      <td><?php echo $row->created_by; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Sr. No</th>
                    <th>Indent Code</th>
                    <th>Indent Date</th>
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
