<div class="page-body">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header table-card-header">
          <h5>Invoice Report</h5>
        </div>
        <div class="card-block">
          <form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Reports/get_sales_invoice_report" id="question" method="post" name="question" >
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

              <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Customer</label>
              <div class="col-sm-3">
                <select tabindex="3" name="customer_id" id="customer_id" class="form-control select2" tabindex="3">
                  <option value="">Please select</option>
                  <?php foreach($customer_list as $g) {?>
                    <option <?php if($customer_id==$g->customer_id) echo 'selected'; ?> value="<?php echo $g->customer_id ?>"><?php echo $g->customer_name;?> </option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">Status</label>
              <div class="col-sm-2">
                <select tabindex="4" name="status" id="status" class="form-control" >
                  <option value="" >Please Select</option>
                  <option <?php if($status == '0') echo 'selected'; ?> value="0">Active</option>
                  <option <?php if($status == '1') echo 'selected'; ?> value="1">Inactive</option>
                </select>
              </div>

              <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Quotations</label>
              <div class="col-sm-3">
                <select tabindex="5" name="quotation_id" id="quotation_id" class="form-control select2">
                  <option value="">Please Select</option>
                  <?php foreach($sale_quotation_records as $row) { ?>
                    <option <?php if($quotation_id==$row->quot_id) echo 'selected'; ?> value="<?php echo $row->quot_id;?>"><?php echo $row->quotation_code.' / '.date('d-m-Y', strtotime($row->quotation_date));?></option>
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
                    <form target="_blank" action="<?php echo base_url().'index.php/'; ?>Reports/print_sales_invoice_report" id="ques1" method="post" name="ques1" >
                      <input type="hidden" name="from" value="<?php echo $from; ?>" />
                      <input type="hidden" name="to" value="<?php echo $to; ?>" />
                      <input type="hidden" name="status" value="<?php echo $status; ?>" />
                      <input type="hidden" name="quotation_id" value="<?php echo $quotation_id; ?>" />
                      <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
                      <input type="submit" id="print" value="Print" class="btn btn-warning btn-sm" tabindex="7"/>
                    </form></td>
                    <td>&nbsp;</td>
                    <td>
                      <form action="<?php echo base_url().'index.php/'; ?>Reports/export_sales_invoice_report" id="ques1" method="post" name="ques1" >
                        <input type="hidden" name="from" value="<?php echo $from; ?>" />
                        <input type="hidden" name="to" value="<?php echo $to; ?>" />
                        <input type="hidden" name="status" value="<?php echo $status; ?>" />
                        <input type="hidden" name="quotation_id" value="<?php echo $quotation_id; ?>" />
                        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
                        <input type="submit" id="export" value="Export to excel" class="btn btn-warning btn-sm" tabindex="8" />
                      </form>
                    </td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="dt-responsive ">
              <table id="basic-btn" class="table  table-bordered nowrap">
                <thead>
                  <tr>
                    	<th>Sr. No</th>
			<th>Invoice Code</th>
			<th>Invoice Date</th>
			<th>Quotation</th>
			<th>Customer Name/ <br> Project Name</th>
			<th>Grand Amount</th>
			<th>Paid Amount</th>
                  </tr>
                </thead>

                <tbody>
                  <?php $i=1; foreach($records as $row) :?>
                    <tr <?php if($row->inv_status==1) { echo "style='background-color:pink' title='cancelled invoice'"; }?>>
			<td><?php echo  $i; $i++;?></td>
			<td><?php echo $row->invoice_code; ?>
			<br>
				<?php if($row->invoice_type=='A') {
				 echo "<p style='color:blue;'>Advance INV</p>"; }
				 else { echo "<p style='color:green;'>Final INV</p>"; }?>
			 </td>
			<td><?php echo date('d-M-Y',strtotime($row->invoice_date)); ?></td>
			<td><a target='_blank' href="<?php echo base_url().'index.php/Sales/edit_quotation/'.$row->quot_id.'/'.$row->revision;?>"><?php echo $row->quotation_code; ?></a><br>
			<?php echo date('d-M-Y',strtotime($row->quotation_date)); ?></td>
			<td>
				<a target='blank' title="customer details" href="<?php echo base_url().'index.php/Setup/edit_customer/'.$row->customer_id ?>">
					<b><?php echo $row->customer_name; ?></b> 
				</a>
			<br>			
			<?php echo $row->project_name; ?></td>
			<td><?php echo $row->grand_total; ?></td>
			<td><?php echo $row->received_amount; ?></td>
			
		</tr>
                    <?php endforeach; ?>
                  </tbody>

                  <tfoot>
                    <tr>
                      	<th>Sr. No</th>
			<th>Invoice Code</th>
			<th>Invoice Date</th>
			<th>Quotation</th>
			<th>Customer Name/ <br> Project Name</th>
			<th>Grand Amount</th>
			<th>Paid Amount</th>
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
