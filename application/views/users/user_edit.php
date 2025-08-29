<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Users/update_user_data" id="addform" autocomplete="off"   enctype="multipart/form-data">
		<?php  foreach($records as $row) :?>
			<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">User Name <span style="color: red;"> * </span></label>
				<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5">
					<input tabindex="1" type="text" name="first_name" id="first_name" class="form-control bg-soft-gray" placeholder="First name & last Name" required value="<?php echo $row->user_name;?>" >
				</div>
			</div>

			<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Email Id <span style="color: red;"> * </span><br /><span style="color: red;">(This will be your LOGIN ID) </span></label>
			<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			<input tabindex="26" type="text" name="company_email" id="company_email" class="form-control bg-soft-gray" placeholder="" required value="<?php echo $row->email_id;?>" readonly>
			<label id="user_exits" style="color: red;"></label>
			</div>

			<div class='col-sm-1 col-md-1'></div>

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Password <span style="color: red;"> * </span></label>
			<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			<input tabindex="27" type="password" name="password" value="<?php echo $row->password;?>" id="password" class="form-control bg-soft-gray" readonly>
			</div>
			<div class='col-sm-1 col-md-1'></div>
			</div>
			<div class="form-group row">
			  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Mobile No </label>
			  <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			    <input tabindex="13" type="text" name="mobile1" id="mobile1" class="form-control"  value="<?php echo $row->contact_no;?>" >
			  </div>
			  <div class='col-sm-1 col-md-1'></div>
			 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Department<span style="color: red;"> * </span></label>
			    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			      <select tabindex="19" class="form-control" id="department" name="department" required>
				<option value="">Select</option>
				<?php foreach($dept_list as $s) {?>
				  <option <?php if($s->dept_id==$row->department) echo 'selected';?> value="<?php echo $s->dept_id; ?>"><?php echo $s->dept_name;?></option>
				<?php } ?>
			      </select>
			       
			      </div>
			</div>
			

			<div class="form-group row">
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Gender </label>
		         <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		        	<select tabindex="6" class="form-select form-control-sm " id="gender" name="gender">
					<option value="">Select</option>
					<option <?php if($row->gender=='Male') echo 'selected';?> value="Male">Male</option>
					<option <?php if($row->gender=='Female') echo 'selected';?> value="Female">Female</option>
			      </select>
		         </div>
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bith Date</label>
		           <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date datepicker1">			                  
		    			<input type="text" class="form-control form-control-sm datepicker1" id="bdate" name="bdate" value="<?php echo date('d-m-Y',strtotime($row->bdate)?? '')?>" required tabindex=7 >
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      </div>
			</div>
		</div>

		<div class="form-group row">
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address</label>
		         <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		        	<textarea id="address" name="address" class="form-control form-control-sm "  tabindex=8><?php echo $row->address;?></textarea>
		         </div>
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">City</label>
		         <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		        	<input type="text" name="city" id="city" class="form-control form-control-sm "  value="<?php echo $row->city;?>" tabindex=9>
		         </div>
		</div>
		<div class="form-group row">
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">State</label>
		         <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		         <input type="text" name="state" id="state" class="form-control form-control-sm " value="<?php echo $row->state;?>" tabindex=10>
		         </div>
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Country</label>
		         <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		         <input type="text" name="country" id="country" class="form-control form-control-sm " value="<?php echo $row->country;?>" tabindex=11>		        
		         </div>
		</div>
		

			
			<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
				<input type="hidden"  name="id" value="<?php echo $row->user_id;?>" >
				<button tabindex="46" type="submit" id="edit" class="btn btn-primary m-b-0">Submit</button>
			</div>
			</div>
			<?php endforeach; ?>
	</form>
                     

        </div>
    </div>
</div>
</div>
</div>
</div>

<script>

function show_password() {
	var x = document.getElementById("password");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}
</script>
