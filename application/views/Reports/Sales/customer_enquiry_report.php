<div class="page-body">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header table-card-header">
          <h5>Customer Enquiry Report</h5>
        </div>
        <div class="card-block">
          <form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Reports/get_customer_enquiry_report" id="question" method="post" name="question" >
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

              <label class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-form-label">Enquiry From</label>
              <div class="col-sm-2">
                <select name="enq_from" id="enq_from" class="form-control select2" tabindex="3" >
                  <option value="">Please select</option>
                  <option <?php if($enq_from == 'Email') echo 'selected'; ?> value="Email">Email</option>
                  <option <?php if($enq_from == 'Meeting') echo 'selected'; ?> value="Meeting">Meeting</option>
                  <option <?php if($enq_from == 'Marketing') echo 'selected'; ?> value="Marketing">Marketing</option>
                  <option <?php if($enq_from == 'Social Media') echo 'selected'; ?> value="Social Media">Social Media</option>
                  <option <?php if($enq_from == 'Phone Call') echo 'selected'; ?> value="Phone Call">Phone Call</option>
                  <option <?php if($enq_from == 'website') echo 'selected'; ?> value="website">Website</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Customer</label>
              <div class="col-sm-2">
                <select name="customer_id" id="customer_id" class="form-control select2" tabindex="4">
                  <option value="">Please select</option>
                  <?php foreach($customer_list as $g) {?>
                    <option <?php if($customer_id==$g->customer_id) echo 'selected'; ?> value="<?php echo $g->customer_id ?>"><?php echo $g->customer_name;?> </option>
                  <?php } ?>
                </select>
              </div>

              <label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">Status</label>
              <div class="col-sm-2">
                <select tabindex="5" name="status" id="status" class="form-control">
                  <option value="" >Please Select</option>
                  <option <?php if($status == '0') echo 'selected'; ?> value="0">Active</option>
                  <option <?php if($status == '1') echo 'selected'; ?> value="1">Inactive</option>
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
                    <form target="_blank" action="<?php echo base_url().'index.php/'; ?>Reports/print_customer_enquiry_report" id="ques1" method="post" name="ques1" >
                      <input type="hidden" name="from" value="<?php echo $from; ?>" />
                      <input type="hidden" name="to" value="<?php echo $to; ?>" />
                      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
                      <input type="hidden" name="enq_from" value="<?php echo $enq_from; ?>" />
                      <input type="submit" id="print" value="Print" class="btn btn-warning btn-sm" tabindex="7" />
                    </form></td>
                    <td>&nbsp;</td>
                    <td>
                      <form action="<?php echo base_url().'index.php/'; ?>Reports/export_customer_enquiry_report" id="ques1" method="post" name="ques1" >
                        <input type="hidden" name="from" value="<?php echo $from; ?>" />
                        <input type="hidden" name="to" value="<?php echo $to; ?>" />
                        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
                        <input type="hidden" name="enq_from" value="<?php echo $enq_from; ?>" />
                        <input type="submit" id="export" value="Export to excel" class="btn btn-warning btn-sm" tabindex="8"/>
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
              			<th>Enquiry Code</th>
              			<th>Enquiry Date</th>
              			<th>Customer Name</th>
              			<th>Project Name</th>
              			<th>Enquiry From</th>
              			<th>Revision</th>
              			<th>Created By</th>
                  </tr>
                </thead>

                <tbody>
                <?php $i=1; foreach($records as $row) :?>
                <tr>
                  <td><?php echo  $i; $i++;?></td>
                  <td><a target='_blank' href="<?php echo base_url().'index.php//Sales/edit_enquiry/'.$row->enquiry_id.'/'.$row->rev_version;?>"><?php echo $row->enquiry_code; ?></a></td>
                  <td><?php echo date('d-M-Y',strtotime($row->enquiry_date)); ?></td>
                  <td>
                    <a target='blank' title="customer details" href="<?php echo base_url().'index.php/Setup/edit_customer/'.$row->customer_id ?>">
                      <b><?php echo $row->customer_name; ?></b>
                    </a>
                  </td>
                  <td><?php echo $row->project_name; ?></td>
                  <td><?php echo $row->enquiry_from; ?></td>
                  <td>
                    <a target="_blank" title="view revision details" href="<?php echo base_url().'index.php/Purchase/view_enquiry_versions/'.$row->enquiry_id.'/'.$row->rev_version;?>">
                    <?php echo 'R '.$row->rev_version; ?>
                    </a>
                  </td>
                  <td><?php echo $row->created_name; ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>

                <tfoot>
                  <tr>
                    <th>Sr. No</th>
              			<th>Enquiry Code</th>
              			<th>Enquiry Date</th>
              			<th>Customer Name</th>
              			<th>Project Name</th>
              			<th>Enquiry From</th>
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
