<div class="page-body">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header table-card-header">
          <h5>Supplier Transaction Report</h5>
        </div>
        <div class="card-block">
          <form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Reports/get_supplier_transaction" id="question" method="post" name="question" >
            <div class="form-group row">
              <label class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier Type <span style="color: red;"> * </span></label>
              <div class="col-sm-2">
                <select tabindex="1" name="supplier_type" id="supplier_type" class="form-control" required >
                  <option value="">Please select </option>
                  <option <?php if($supplier_type=='Local') echo 'selected'; ?> value="Local" >Local</option>
                  <option <?php if($supplier_type=='Overseas') echo 'selected'; ?> value="Overseas" >Overseas</option>
                </select>
              </div>

              <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Supplier</label>
              <div class="col-sm-3">
                <select tabindex="2" name="supplier_id" id="supplier_id" class="form-control select2" >
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
                      <input tabindex="8" type="submit" id="view" name="go" value="Go" class="btn btn-sm btn-primary m-b-0" />
                    </form>
                  </td>
                  <td>&nbsp;</td>
                  <td>
                    <form target="_blank" action="<?php echo base_url().'index.php/'; ?>Reports/print_supplier_transaction" id="ques1" method="post" name="ques1" >
                      <input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>" />
                      <input type="hidden" name="supplier_type" value="<?php echo $supplier_type; ?>" />
                      <input tabindex="4" type="submit" id="print" value="Print" class="btn btn-warning btn-sm" />
                    </form></td>
                    <td>&nbsp;</td>
                    <td>
                      <form action="<?php echo base_url().'index.php/'; ?>Reports/export_supplier_transaction" id="ques1" method="post" name="ques1" >
                        <input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>" />
                        <input type="hidden" name="supplier_type" value="<?php echo $supplier_type; ?>" />
                        <input tabindex="5" type="submit" id="export" value="Export to excel" class="btn btn-warning btn-sm" />
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
                    <th>Supplier Name</th>
                    <th>Supplier Type</th>
                    <th>Quotation Code</th>
                    <th>Quotation Date</th>
                    <th>RFQ Code</th>
                    <th>RFQ Date</th>
                    <th>PO Code</th>
                    <th>PO Date</th>
                    <th>GRN Code</th>
                    <th>GRN Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach($records as $row) :?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row->supplier_code.' '.$row->supplier_name; ?></td>
                      <td><?php echo $row->supplier_type;?></td>
                      <td><?php echo $row->quotation_code;?></td>
                      <td><?php echo date('d-m-Y',strtotime($row->quotation_date)); ?></td>
                      <td><?php echo $row->rfq_code;?></td>
                      <td><?php echo date('d-m-Y',strtotime($row->rfq_date)); ?></td>
                      <td><?php echo $row->po_code;?></td>
                      <td><?php echo date('d-m-Y',strtotime($row->po_date)); ?></td>
                      <td><?php echo $row->grn_code;?></td>
                      <td><?php echo date('d-m-Y',strtotime($row->grn_date)); ?></td>
                    </tr>
                    <?php $i++; endforeach; ?>
                  </tbody>
                  <tfoot>
                    <th>Sr. No</th>
                    <th>Supplier Name</th>
                    <th>Supplier Type</th>
                    <th>Quotation Code</th>
                    <th>Quotation Date</th>
                    <th>RFQ Code</th>
                    <th>RFQ Date</th>
                    <th>PO Code</th>
                    <th>PO Date</th>
                    <th>GRN Code</th>
                    <th>GRN Date</th>
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
