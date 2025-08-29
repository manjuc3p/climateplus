<div class="card-body">
  	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Admin/add_currency_data" id="addform" autocomplete="off" >
            
            <div class="form-group row">
              <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Country <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                <input tabindex="1" type="text" name="country" id="country" class="form-control form-control-sm" placeholder="Eg. INDIA" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Currency <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                <input tabindex="2" type="text" name="currency" id="currency" class="form-control form-control-sm" placeholder="Eg. Rupee" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Currency Abbreviation <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                <input tabindex="3" type="text" name="currabrev" id="currabrev" class="form-control form-control-sm" placeholder="Eg. INR" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Rate <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                <input tabindex="4" type="number" step='0.01' name="rate" id="rate" class="form-control form-control-sm" placeholder="Eg. 1" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Remark</label>
              <div class="col-xs-12 col-sm-10 col-md-10 col-lg-5">
                <textarea tabindex="5" name="remark" id="remark" class="form-control form-control-sm" rows="3" cols="2" ></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2"></label>
              <div class="col-sm-10">
                <button tabindex="6" type="submit" id="add" class="btn btn-xs btn-primary  px-1 py-1">Submit</button>
              </div>
            </div>
          </form>

        </div>
    </div>
</div>
</div>
</div>
</div>
         
