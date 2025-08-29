<div class="card-body">
     <div class="new-user-info bg-soft-primary">
     <!-- form start -->
        <form action="<?php echo base_url().'index.php/'; ?>Login/change_password" class="form-horizontal"  method="post" id="pass-form" >
                    <div class="row">
	                    <div class="form-group">
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Old Password <span class="text-red">*</span>
	                        </label>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <input type="password" id="opass" name="opass" class="form-control col-md-7 col-xs-12" required tabindex=1>
	                        </div>
	                    </div>
	                    
	                    <div class="form-group">
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >New Password <span class="text-red">*</span>
	                        </label>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <input type="password" id="npass" name="npass" minlength="6" required class="form-control col-md-7 col-xs-12" tabindex=2>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Confirm Password <span class="text-red">*</span>
	                        </label>
	                        <div class="col-md-6 col-sm-6 col-xs-12">
	                            <input type="password" id="cpass" name="cpass" minlength="6"  data-parsley-equalto="#npass" class="form-control col-md-7 col-xs-12" required tabindex=3>
	                        </div>
	                    </div>                     
                   </div>
	               <!-- /.box-body -->
	               <div class="box-footer col-sm-offset-2">
		                <button type="submit" name="change_pass" id="change_pass" class="btn btn-xs btn-primary px-1 py-1" tabindex=4>Change Password</button>
		                <button type="reset" class="btn btn-xs btn-primary px-1 py-1">Reset</button>
	               </div>
		              <!-- /.box-footer -->
            </form>   
             </div>
          </div>
       </div>
    </div>
 </div>
</div>
</div>   


<script>
 
</script>
