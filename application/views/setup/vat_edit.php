<div class="card-body">
          <form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Admin/update_tax_details" id="addform" autocomplete="off" >
            <?php  foreach($records as $row) :?>
              <div class="form-group row">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">VAT % <span style="color: red;"> * </span></label>
                <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                  <input tabindex="2" type="text" name="vat_percent" id="vat_percent" class="form-control" placeholder="" value="<?php echo $row->vat_percent; ?>" required>
                </div>
                <div class='col-sm-1 col-md-1'></div>
              </div>

              <div class="form-group row">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Applicable date <span style="color: red;"> * </span></label>
                <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		        <div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id="applicable_date" name="applicable_date" value="<?php if($row->applicable_date=='' || $row->applicable_date=='0000-00-00' || $row->applicable_date=='1970-01-01') { echo ''; } else { echo date('d-m-Y', strtotime($row->applicable_date)); } ?>" required >
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		      </div>
                </div>
              </div>
              <input type="hidden"  name="vat_id" value="<?php echo $row->vat_id;?>" >
            <?php endforeach; ?>

            <div class="form-group row">
              <label class="col-sm-2"></label>
              <div class="col-sm-10">
                <button type="submit" id="edit" class="btn btn-primary m-b-0">Submit</button>
              </div>
            </div>
          </form>

        </div>
    </div>
</div>
</div>
</div>
</div>
         
