<div class="card-body">
          <form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Admin/update_currency_details" id="addform" autocomplete="off" >
            <?php  foreach($records as $row) :?>
              <div class="form-group row">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Country <span style="color: red;"> * </span></label>
                <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                  <input tabindex="1" type="text" name="country" id="country" class="form-control form-control-sm" placeholder="" value="<?php echo $row->country; ?>" required>
                </div>
                <div class='col-sm-1 col-md-1'></div>
              </div>

              <div class="form-group row">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Currency <span style="color: red;"> * </span></label>
                <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                  <input tabindex="2" type="text" name="currency" id="currency" class="form-control form-control-sm" value="<?php echo $row->currency; ?>" placeholder="Eg.India Rupee" required>
                </div>
                <div class='col-sm-1 col-md-1'></div>
              </div>

              <div class="form-group row">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Currency Abbreviation <span style="color: red;"> * </span></label>
                <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                  <input tabindex="3" type="text" name="currabrev" id="currabrev" class="form-control form-control-sm" value="<?php echo $row->currabrev; ?>" placeholder="Eg. INR"  required>
                </div>
                <div class='col-sm-1 col-md-1'></div>
              </div>

              <div class="form-group row">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Rate <span style="color: red;"> * </span></label>
                <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                  <input tabindex="4" type="number" step="0.01" name="rate" id="rate" class="form-control form-control-sm" value="<?php  echo sprintf("%0.6f",$row->rate); ?>" required>
                </div>
                <div class='col-sm-1 col-md-1'></div>
              </div>

              <div class="form-group row">
                <label class="col-xs-12 col-sm-9 col-md-2 col-lg-2 col-form-label">Status</label>
                <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                  <select tabindex="5" name="status" id="status" class="form-control select2" required>
                    <option <?php if($row->status==0) echo 'selected' ?> value="0">Active</option>
                    <option <?php if($row->status==1) echo 'selected' ?> value="1">InAtcive</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Inactive Date</label>
                <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
                  <div class='input-group date' id='datetimepicker1'>
                    <input tabindex="6" type="text" id='inactive_date' name='inactive_date' class="form-control date_today" value="<?php echo date('d-M-Y'); ?>" >
                    <div class="input-group-prepend">
                      <span class="input-group-text ">
                        <span class="btn btn-primary m-b-0 icofont icofont-ui-calendar"></span>
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Remark</label>
                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-5">
                  <textarea tabindex="7" name="remark" id="remark" class="form-control" rows="3" cols="2" placeholder="Enter remark"><?php echo $row->remark; ?></textarea>
                </div>
              </div>
              <input type="hidden" id="id"  name="id" value="<?php echo $row->id;?>" >
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
         
