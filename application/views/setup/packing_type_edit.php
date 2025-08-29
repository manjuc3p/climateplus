<div class="card-body">
          <form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Admin/update_packing_type_details" id="addform" autocomplete="off" >
            <?php  foreach($records as $row) :?>
            <div class="form-group row">
              <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Packing Type <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
                <input type="text" name="ptype" id="ptype" class="form-control form-control-sm" tabindex='1' value="<?php echo $row->ptype; ?>" required>
              </div>
            </div>
	    
              
              <input type="hidden"  name="id" value="<?php echo $row->sno;?>" >
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
         
