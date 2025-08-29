<div class="card-body">
	<form action="<?php echo base_url().'index.php/'; ?>Users/add_new_customer" id="question" method="post" name="question" >		 	 			
 		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Customer/Company Name:<span style="color: red;"> * </span></label>
			<div class="col-sm-6">		  				
				<input id="cust_name" name="cust_name" type="text" class="form-control col-sm-2 form-control-sm" placeholder="Customer Name" tabindex="1" required/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Company Email:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="email" id="email" name="email"  class="form-control col-sm-2 form-control-sm"  placeholder=""  tabindex="2" >
			</div>
		
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Company Contact No:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input type="text" id="contact_no" name="contact_no" class="form-control col-sm-2 form-control-sm" tabindex="3">
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
				<input type="text" id="billing_addr1" name="billing_addr1"  class="form-control col-sm-2 form-control-sm"  placeholder="write billing address" tabindex="6" >
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">City:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_city" name="billing_city" type="text" class="form-control col-sm-2 form-control-sm" tabindex="8" />
			</div>
			<label class="col-sm-2 control-label">State:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_state" name="billing_state" type="text" class="form-control col-sm-2 form-control-sm" tabindex="9" />
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">PO Box:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input  id="billing_po" name="billing_po" type="text" tabindex="10" class="form-control col-sm-2 form-control-sm"/>
			</div>
			<label class="col-sm-2 control-label">Country:</label>
			 <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_country" name="billing_country" type="text" tabindex="11" class="form-control col-sm-2 form-control-sm"/>
			</div>
		</div>    		
		<h6>Shipping Address <input type='checkbox' id='copy_address' value='1'  onclick='copy_billing_address()' />Same As Billing</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address:</label>
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<input type="text" id="shipping_addr1" name="shipping_addr1"  tabindex="12" class="form-control col-sm-2 form-control-sm"  placeholder="write shipping address" >
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
		
		<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_logic">
					   <thead>
					    <tr>
					    	    <th title="Item">Contact Person</th>
					    	    <th title="Item">Mobile Number</th>    
					    	    <th title="Item">Email Id</th>    
					    	    <th><a id="add_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
						</tr>
					    </thead>		 
					    <tbody id="mytbbody">
						<tr id='addr0'>
							<td><input type="text"  name="cp_name[]" id="cp_name" tabindex='2' class="form-control" placeholder=""  required></td>
							<td><input type="text" name="cp_mobile[]" id="cp_mobile" tabindex='3' class="form-control" placeholder="" ></td>
							<td><input type="text" name="cp_email[]" id="cp_email" tabindex='3' class="form-control" placeholder="" ></td>
							<td><a id='delete_row' title="Delete" onclick='remove_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
						</tr>
						<tr id='addr1'></tr>
					</tbody>
				</table>
		</div>
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<button type="submit"  tabindex="18"  id="add" class="btn btn-primary m-b-0">Submit</button>
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
$(document).ready(function(){
	var i=1;
	$("#add_row").click(function()
	{
	     $('#addr'+i).html("<td><input type='text'  name='cp_name[]' id='cp_name' tabindex='2' class='form-control' placeholder=''  required></td><td><input type='text' name='cp_mobile[]' id='cp_mobile' tabindex='3' class='form-control' placeholder='' ></td><td><input type='text' name='cp_email[]' id='cp_email' tabindex='3' class='form-control' placeholder='' ></td><td><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytbbody tr:last').after('<tr id="addr'+(i+1)+'"></tr>');
	      i++; 	     	
	});
        $("#delete_row").click(function(){
    		 if(i>1){
			 $("#addr"+(i-1)).html('');
			 i--;
		 }
	 });
   });   
   function remove_row(append_id)
   {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
   }

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

