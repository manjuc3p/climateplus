<div class="card-body">
	<form action="<?php echo base_url().'index.php/'; ?>Users/add_new_supplier" id="question" method="post" name="question" >		 	 			
 		<div class="form-group row">
			<label class="col-sm-3 control-label">Supplier/Company Name:<span style="color: red;"> * </span></label>
			<div class="col-sm-6">		  				
				<input id="cust_name" name="cust_name" type="text" class="form-control col-sm-2 form-control-sm" placeholder="Supplier Name" tabindex="1" required/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier type:<span style="color: red;"> * </span></label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<select tabindex="2" class="form-select form-control-sm " id="stype" name="stype" required>
					<option value="">Select</option>
					<option value="Local">Local</option>
					<option value="overseas">overseas</option>
			      </select>
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Company website </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="website" name="website" class="form-control col-sm-2 form-control-sm" tabindex="3">
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Email Id:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="email" id="email" name="email"  class="form-control col-sm-2 form-control-sm"  placeholder=""  tabindex="4" >
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Contact No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="contact_no" name="contact_no" class="form-control col-sm-2 form-control-sm" tabindex="5">
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Contact Person Name:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="cp_name" name="cp_name"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="6" >
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Contact Person mobile no:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="cp_mobile" name="cp_mobile" class="form-control col-sm-2 form-control-sm" tabindex="7">
			</div>
	       </div>
		
	       <div class="form-group row">		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">TRN No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="trn_no" name="trn_no" class="form-control col-sm-2 form-control-sm" tabindex="4" >
			</div>
	       </div>
	       <h6>Billing Address</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address:</label>
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<input type="text" id="billing_addr1" name="billing_addr1"  class="form-control col-sm-2 form-control-sm"  placeholder="write billing address" tabindex="8" >
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">City:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_city" name="billing_city" type="text" class="form-control col-sm-2 form-control-sm" tabindex="9" />
			</div>
			<label class="col-sm-2 control-label">State:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_state" name="billing_state" type="text" class="form-control col-sm-2 form-control-sm" tabindex="10" />
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">PO Box:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input  id="billing_po" name="billing_po" type="text" tabindex="11" class="form-control col-sm-2 form-control-sm"/>
			</div>
			<label class="col-sm-2 control-label">Country:</label>
			 <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_country" name="billing_country" type="text" tabindex="12" class="form-control col-sm-2 form-control-sm"/>
			</div>
		</div>    		
		<h6>Shipping Address <input type='checkbox' id='copy_address' value='1'  onclick='copy_billing_address()' />Same As Billing</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address:</label>
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<input type="text" id="shipping_addr1" name="shipping_addr1"  tabindex="13" class="form-control col-sm-2 form-control-sm"  placeholder="write shipping address" >
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">City:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_city" name="shipping_city" tabindex="14" type="text" class="form-control col-sm-2 form-control-sm"/>
			</div>
			<label class="col-sm-2 control-label">State:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_state" name="shipping_state" tabindex="15" type="text" class="form-control col-sm-2 form-control-sm"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">PO Box:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_po" name="shipping_po" tabindex="16" type="text" class="form-control col-sm-2 form-control-sm"/>
			</div>
			<label class="col-sm-2 control-label">Country:</label>
			 <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_country" name="shipping_country" tabindex="17" type="text" class="form-control col-sm-2 form-control-sm"/>
			</div>
		</div>		
		
	       <h6>Bank Details</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank Name:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="bname" name="bname"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="18" >
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Account No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="acc_no" name="acc_no" class="form-control col-sm-2 form-control-sm" tabindex="19" >
			</div>
	       </div>
	       
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank Barnch:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="branch" name="branch"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="20" >
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank IBAN No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="iban" name="iban" class="form-control col-sm-2 form-control-sm" tabindex="21" >
			</div>
	       </div>	       
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank SWIFT:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="swift" name="swift"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="22" >
			</div>
	       </div>
	       
	        <h6>Intermidiate Bank Details</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank Name:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="int_bname" name="int_bname"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="23" >
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Account No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="int_acc_no" name="int_acc_no" class="form-control col-sm-2 form-control-sm" tabindex="24" >
			</div>
	       </div>
	       
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank Barnch:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="int_branch" name="int_branch"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="25" >
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank IBAN No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="int_iban" name="int_iban" class="form-control col-sm-2 form-control-sm" tabindex="26" >
			</div>
	       </div>	       
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank SWIFT:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="int_swift" name="int_swift"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="27" >
			</div>
	       </div>
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<button type="submit"  tabindex="28"  id="add" class="btn btn-primary m-b-0">Submit</button>
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
function copy_billing_address()
{
	var checkBox = document.getElementById("copy_address");
	// If the checkbox is checked, display the output text
	if (checkBox.checked == true){
		var billing_addr1 = document.getElementById("billing_addr1").value;
		var billing_city = document.getElementById("billing_city").value;
		var billing_state = document.getElementById("billing_state").value;
		var billing_po = document.getElementById("billing_po").value;
		var billing_country = document.getElementById("billing_country").value;
		
	 	document.getElementById("shipping_addr1").value=billing_addr1;
	 	document.getElementById("shipping_city").value=billing_city;
	 	document.getElementById("shipping_state").value=billing_state;
	 	document.getElementById("shipping_po").value=billing_po;
	 	document.getElementById("shipping_country").value=billing_country;
	 	
	} else {
	 
	 	document.getElementById("shipping_addr1").value='';
	 	document.getElementById("shipping_city").value='';
	 	document.getElementById("shipping_state").value='';
	 	document.getElementById("shipping_po").value='';
	 	document.getElementById("shipping_country").value='';
	}
}
</script>

