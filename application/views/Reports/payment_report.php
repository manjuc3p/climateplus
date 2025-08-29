<div class="card-body">


  <form class="form-horizontal" action="<?php echo base_url() . 'index.php/'; ?>Reports/get_payment_report" id="main" method="post">
    <div class="form-group row">
      <label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">Date <span style="color: red;"> * </span></label>
      <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
        <input tabindex="1" type="date" class="form-control form-control-sm" id="job_date" name="job_date" value="<?php echo $job_date ?? ''; ?>" required autocomplete="off">
      </div>

      <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Driver</label>
      <div class="col-sm-3">
        <select tabindex="3" name="driver_id" id="driver_id" class="form-control form-control-sm" tabindex="3">
          <option value="">All</option>
          <?php foreach ($drivers as $d) { ?>
            <option value='<?php echo $d->user_id; ?>' <?php if ($d->user_id == $driver) echo 'selected'; ?>><?php echo $d->user_name; ?></option>
          <?php } ?>
        </select>
      </div>

      <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Payment</label>
      <div class="col-sm-2">
        <select name="payment_term" tabindex="3" id="payment_term" class="form-control form-control-sm select2">
          <option value=''>All</option>
          <?php foreach ($payment_terms as $term): ?>
            <option value='<?php echo $term->id; ?>' <?php if ($term->id == $payment) echo 'selected'; ?>><?php echo $term->term; ?></option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="col-sm-2">
        <table>
          <tr>
            <td>
              <input type='hidden' name='print_opt' id='print_opt' value=0 />
              <input tabindex="6" type="submit" id="view" name="go" value="Go" class="btn btn-sm btn-primary m-b-0" />
  </form>
  </td>
  <td>&nbsp;</td>
  <td>
  </td>
  <td>&nbsp;</td>
  <td>

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
        <th>Job Title</th>
        <th>Driver</th>
        <th>Customer</th>
        <th>Document Status</th>
        <th>Payment Status</th>
        <th>Payment Collection byDriver</th>
        <th>Amount</th>
      </tr>
    </thead>
    <?php if (isset($report)) { ?>
      <tbody>
        <?php $i = 1;
        foreach ($report as $row) : ?>
          <tr>
            <td><?php echo $i;
                $i++; ?></td>
            <td><?php echo $row->job_title; ?></td>
            <td><?php echo $row->user_name ?? 'Not Assigned'; ?></td>
            <td><?php echo $row->customer; ?></td>
            <td>
              <?php echo ($row->document_status == "Yes") ? 'Submitted' : 'Not Submitted'; ?>
            </td>
            <td><?php echo $row->payment_status ?? 'Not Updated'; ?></td>
            <td><?php if ($row->payment_collection == 1) echo 'Cash Collected';
                else if ($row->payment_collection == 2) echo 'Cheque Collected';
                else if ($row->payment_collection == 3) echo 'Not Collected';
                else if ($row->payment_collection == 4) echo 'Paid By Card';
                else echo 'Not updated'; ?></td>
            <td><?php if ($row->payment_collection == 1 || $row->payment_collection == 2) echo $row->amount_collected; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    <?php } ?>

  </table>
</div>

<div class="form-group row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
    <button onclick='print_report()' class='btn btn-primary'>Print</button>
  </div>
</div>



</div>

<script>
  function print_report() {
    $('#print_opt').val(1);
    $('#main').attr('target', '_blank');
    $('#main').submit();

  }
</script>