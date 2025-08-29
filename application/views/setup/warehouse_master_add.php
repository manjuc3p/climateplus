<div class="card-body">
		<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Admin/add_warehouse_details" id="addform" autocomplete="off" >
			<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Warehouse Name <span style="color: red;"> * </span></label>
				<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
					<input type="text" name="warehouse_name" id="warehouse_name" class="form-control" placeholder="" required>
				</div>
				<div class='col-sm-1 col-md-1'></div>

				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address <span style="color: red;"> * </span></label>
				<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
					<input type="text" name="address" id="address" class="form-control" placeholder="" required>
				</div>
				<div class='col-sm-1 col-md-1'></div>
			</div>

			<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">City / Emirates <span style="color: red;"> * </span></label>
				<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
					<input type="text" name="city" id="city" class="form-control" placeholder="" required >
				</div>
				<div class='col-sm-1 col-md-1'></div>

				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Pincode / P.O Box<span style="color: red;"> * </span></label>
				<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
					<input type="text" name="pincode" id="pincode" class="form-control" placeholder="" required >
				</div>
				<div class='col-sm-1 col-md-1'></div>
			</div>

			<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Contact no</label>
				<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
					<input type="text" name="contact_no" id="contact_no" class="form-control" placeholder="" >
				</div>
				<div class='col-sm-1 col-md-1'></div>
				<label for="serial_no" class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Incharge</label>
				<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
					<select name="person_incharge" id="person_incharge" class="form-control select2" >
						<option value="">Please select Incharge Person</option>
						<?php foreach($emp_records as $r) {
							echo "<option value=".$r->user_id.">".$r->user_name."";
						} ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2"></label>
				<div class="col-sm-10">
					<button type="submit" id="add" class="btn btn-primary m-b-0">Submit</button>
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

$(function(){
	$(".js-example-basic-multiple").select2();
	$(".js-example-placeholder-multiple").select2({placeholder:"Select parameters"});
});


function checkPincode(id_name) {
	var id = document.getElementById(id_name).value;
	var numbers = /(^\d{6}$)/;

	if(id.match(numbers)) {
		return true;
	}
	else {
		alert('Please Enter Valid Pincode');
		document.getElementById(id_name).value = '';
		return false;

	}
}

function call_help()
{
  $('#help-Modal').modal('show');
}
</script>
