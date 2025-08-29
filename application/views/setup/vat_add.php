<div class="card-body">
  	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Admin/add_tax_details" id="addform" autocomplete="off" >
            <div class="form-group row">
              <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">VAT % <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                <input tabindex="1" type="text" name="vat_percent" id="vat_percent" class="form-control form-control-sm" placeholder="" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Applicable From date <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
		        <div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id="applicable_date" name="applicable_date" value="<?php echo date('d-m-Y')?>" required tabindex=2>
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		      	</div>
    	      </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2"></label>
              <div class="col-sm-10">
                <button type="submit" id="add" class="btn btn-xs btn-primary  px-1 py-1">Submit</button>
              </div>
            </div>
          </form>

        </div>
    </div>
</div>
</div>
</div>
</div>
         
