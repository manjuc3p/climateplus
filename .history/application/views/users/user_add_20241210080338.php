<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Users/add_new_user" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Enter Name <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5">
	    			<input tabindex="1" type="text" name="first_name" id="first_name" class="form-control form-control-sm " placeholder="Enter Full name" required >
	  		</div>
		</div>
		<div class="form-group row">
		  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Mobile Number </label>
		  <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		    <input tabindex="2" type="text" name="mobile1" id="mobile1" class="form-control form-control-sm " placeholder=""  >
		  </div>
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Department<span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		      <select tabindex="3" class="form-select form-control-sm " id="department" name="department" required>
			<option value="">Select</option>
			<?php foreach($dept_list as $s) {?>
			  <option value="<?php echo $s->dept_id ?>"><?php echo $s->dept_name;?></option>
			<?php } ?>
		      </select>
		      </div>
		</div>
		<div class="form-group row">
		  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Email Id <span style="color: red;"> * </span><br /><span style="color: red; font-size:11px;">(This will be your Login Id) </span></label>
		  <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		    <input tabindex="4" type="email" name="company_email" id="company_email" autocomplete="off" class="form-control form-control-sm " placeholder="" required onblur="check_duplicate_exist();" >
		    <label id="user_exits" style="color: red;"></label>
		  </div>

		  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Password <span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		      <input tabindex="5" type="password" name="password" id="password" class="form-control form-control-sm " required>
		    </div>
		  </div>

		<div class="form-group row">
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Gender </label>
		         <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		        	<select tabindex="6" class="form-select form-control-sm " id="gender" name="gender">
					<option value="">Select</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
			      </select>
		         </div>
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bith Date</label>
		           <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date datepicker1">			                  
		    			<input type="text" class="form-control form-control-sm datepicker1" id="bdate" name="bdate" value="<?php echo date('d-m-Y')?>" required tabindex=7 >
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      </div>
			</div>
		</div>

		<div class="form-group row">
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address</label>
		         <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		        	<textarea id="address" name="address" class="form-control form-control-sm "  tabindex=8></textarea>
		         </div>
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">City</label>
		         <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		        	<input type="text" name="city" id="city" class="form-control form-control-sm "  tabindex=9>
		         </div>
		</div>
		<div class="form-group row">
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">State</label>
		         <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		         <input type="text" name="state" id="state" class="form-control form-control-sm "  tabindex=10>
		         </div>
		 	 <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Country</label>
		         <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		         <input type="text" name="country" id="country" class="form-control form-control-sm "  tabindex=11>		        
		         </div>
		</div>
		
		
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<button type="submit"  tabindex="12"  id="add" class="btn btn-primary m-b-0">Submit</button>
		</div>
		</div>
		</form>

        </div>
    </div>
</div>
</div>
</div>
</div>

<script>
function check_duplicate_exist()
{
	var dname= $('#company_email').val();
	$.ajax
	({
		url: "<?php echo site_url('Ajax/check_duplicate_exist'); ?>",
		type: 'POST',
		data: {table_name:'users', column_name:'email_id', post_id: dname },
		success: function(msg) {
			if(msg!=0)
			{
				$('#user_exits').html("Email Id already exits");
				$('#company_email').val('');
			}
			else
			{
				$('#user_exits').html("");
			}
		}
	});
}

function check_selected_age() 
{
        var bdate = document.getElementById("bdate").value;
        //alert("hi");
        $.ajax({
            url: "<?php echo site_url('Ajax/get_bday_age_calculation'); ?>",
            type: 'POST',
            data: {bdate:bdate},
            dataType:"json",
            success: function(res) {
                switch(res) {
                    case 0:
                        alert("Age must be 18 or above 18");
                        $("#bdate").val(" ");
                        return false;
                        break;
                    case 1:
                        //alert("hi0");
                        return true;
                        break;
                    case 2:
                        alert("Age must be 18 or above 18");
                        $("#bdate").val(" ");
                        return false;
                        break;
                    default:
                        return false;
                }
            }
        });
}
</script>
