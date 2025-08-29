<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Users/update_supplier_data" id="addform" autocomplete="off"   enctype="multipart/form-data">
		<?php  foreach($records as $row) :?>
			<div class="form-group row">
			<label class="col-sm-2 control-label">Supplier Code:<span style="color: red;"> * </span></label>
			<div class="col-sm-2">		  				
				<input id="cust_code" name="cust_code" type="text" class="form-control col-sm-2 form-control-sm" readonly value="<?php echo $row->supplier_code;?>"/>
			</div>
			<label class="col-sm-3 control-label">Supplier/Company Name:<span style="color: red;"> * </span></label>
			<div class="col-sm-5">		  				
				<input id="cust_name" name="cust_name" type="text" class="form-control col-sm-2 form-control-sm" placeholder="Customer Name" tabindex="1" required value="<?php echo $row->supplier_name;?>" readonly/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier type:<span style="color: red;"> * </span></label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<select tabindex="2" class="form-select form-control-sm " id="stype" name="stype" required>
					<option value="">Select</option>
					<option <?php if($row->supplier_type=='Local') echo 'selected';?> value="Local">Local</option>
					<option <?php if($row->supplier_type=='overseas') echo 'selected';?> value="overseas">overseas</option>
			      </select>
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Company website </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="website" name="website" class="form-control col-sm-2 form-control-sm" tabindex="3" required  value="<?php echo $row->website;?>">
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Email Id:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="email" id="email" name="email"  class="form-control col-sm-2 form-control-sm"  placeholder=""  tabindex="4" value="<?php echo $row->email_id;?>" readonly>
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Contact No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="contact_no" name="contact_no" class="form-control col-sm-2 form-control-sm" tabindex="5"  value="<?php echo $row->contact_no;?>" >
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Contact Person Name:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="cp_name" name="cp_name"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="6" value="<?php echo $row->contact_person;?>">
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Contact Person mobile no:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="cp_mobile" name="cp_mobile" class="form-control col-sm-2 form-control-sm" tabindex="7" value="<?php echo $row->contact_person_number;?>">
			</div>
	       </div>
	       <div class="form-group row">		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">TRN No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="trn_no" name="trn_no" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->trn_no;?>" tabindex="4" >
			</div>
	       </div>
	       <h6>Billing Address</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address:</label>
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<input type="text" id="billing_addr1" name="billing_addr1"  class="form-control col-sm-2 form-control-sm"  placeholder="write billing address" tabindex="8" value="<?php echo $row->billing_address;?>">
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">City:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_city" name="billing_city" type="text" class="form-control col-sm-2 form-control-sm" tabindex="9" value="<?php echo $row->billing_city;?>"/>
			</div>
			<label class="col-sm-2 control-label">State:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_state" name="billing_state" type="text" class="form-control col-sm-2 form-control-sm" tabindex="10" value="<?php echo $row->billing_state;?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">PO Box:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input  id="billing_po" name="billing_po" type="text" tabindex="11" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->billing_po_box;?>"/>
			</div>
			<label class="col-sm-2 control-label">Country:</label>
			 <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_country" name="billing_country" type="text" tabindex="12" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->billing_country;?>"/>
			</div>
		</div>    		
		<h6>Shipping Address <input type='checkbox' id='copy_address' value='1'  onclick='copy_billing_address()' />Same As Billing</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address:</label>
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<input type="text" id="shipping_addr1" name="shipping_addr1"  tabindex="13" class="form-control col-sm-2 form-control-sm"  placeholder="write shipping address" value="<?php echo $row->shipping_address;?>">
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">City:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_city" name="shipping_city" tabindex="14" type="text" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->shipping_city;?>"/>
			</div>
			<label class="col-sm-2 control-label">State:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_state" name="shipping_state" tabindex="15" type="text" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->shipping_state;?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">PO Box:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_po" name="shipping_po" tabindex="16" type="text" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->shipping_po_box;?>"/>
			</div>
			<label class="col-sm-2 control-label">Country:</label>
			 <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_country" name="shipping_country" tabindex="17" type="text" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->shipping_country;?>"/>
			</div>
		</div>	
			
	       <h6>Bank Details</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank Name:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="bname" name="bname"  class="form-control col-sm-2 form-control-sm"  value="<?php echo $row->bank_name;?>" tabindex="18" >
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Account No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="acc_no" name="acc_no" class="form-control col-sm-2 form-control-sm" tabindex="19" value="<?php echo $row->bank_account;?>">
			</div>
	       </div>
	       
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank Barnch:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="branch" name="branch"  class="form-control col-sm-2 form-control-sm"  value="<?php echo $row->bank_IBAN;?>" tabindex="20" >
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank IBAN No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="iban" name="iban" class="form-control col-sm-2 form-control-sm" tabindex="21" value="<?php echo $row->bank_IBAN;?>">
			</div>
	       </div>
	       
	       
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank SWIFT:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="swift" name="swift"  class="form-control col-sm-2 form-control-sm"  value="<?php echo $row->bank_swift;?>" tabindex="22" >
			</div>
	       </div>
	       
	       <h6>Intermidiate Bank Details</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank Name:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="int_bname" name="int_bname"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="23" value="<?php echo $row->intermidiate_Bname;?>">
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Account No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="int_acc_no" name="int_acc_no" class="form-control col-sm-2 form-control-sm" tabindex="24" value="<?php echo $row->intermidiate_Bacc;?>">
			</div>
	       </div>
	       
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank Barnch:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="int_branch" name="int_branch"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="25" value="<?php echo $row->intermidiate_Bbranch;?>">
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank IBAN No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="int_iban" name="int_iban" class="form-control col-sm-2 form-control-sm" tabindex="26" value="<?php echo $row->intermidiate_IBAN;?>">
			</div>
	       </div>	       
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Bank SWIFT:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="int_swift" name="int_swift"  class="form-control col-sm-2 form-control-sm"  placeholder="" tabindex="27" value="<?php echo $row->intermidiate_swift;?>">
			</div>
	       </div>
	       
	       
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
			<input type="hidden"  name="id" value="<?php echo $row->supplier_id;?>" >
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
</script>
