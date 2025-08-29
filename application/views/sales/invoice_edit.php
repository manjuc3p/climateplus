<?php $this->load->helper('stock_helper.php');?>
<div class="card-body">
<?php foreach($records1 as $row) { ?>	
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/update_invoice_data" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Invoice date</label>
		    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" role='group'>
				<div class="input-group date ">			                  
		    			<input type="text" class="form-control form-control-sm " id="qdate" name="qdate" value="<?php echo date('d-m-Y',strtotime($row->invoice_date))?>" required tabindex='1' readonly>
			      	</div>
    	     		 </div>

	     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">Invoice Code:</label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			      <input type="text" name="qcode" id="qcode" class="form-control form-control-sm bg-soft-gray"  readonly tabindex='2' value="<?php echo $row->invoice_code; ?>">
		     </div>
	     	    <label class="col-xs-12 col-sm-1 col-md-3 col-lg-3 col-form-label">Quotaion:<a target='_blank' href="<?php echo base_url().'index.php/Sales/print_quotation/'.$row->quote_id.'/'.$row->revision;?>" title="print quotation"><?php echo $row->quotation_code; ?></a></label>
		</div>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Change Customer<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	    			<select tabindex="3" class="form-select form-control-sm select2" id="customer_id" name="customer_id" onchange="get_customer_info()" >
				<option value="">Select</option>
	      			<option value="new">New Customer</option>
				<?php foreach($cust_records as $s) {?>
				  <option <?php if($s->customer_id==$row->delivery_to) echo 'selected'; ?> value="<?php echo $s->customer_id ?>"><?php echo $s->cust_code.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
	  		</div>
		</div>
		
	<div class="form-group row" >
		<table class="table table-bordered table-hover" id="tab_logic">
		<thead>
		<tr>
	    	    	<th>Description</th>      
	    	    	<th>Quantity</th>  
	    	    	<th>Unit Price</th>     
	    	    	<th>Total
				<a id="add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a>
			</th> 
		</tr>
		</thead>
	        <tbody id="mytbbody">
		<?php $i=5000; foreach($records2 as $r) { ?>
		<tr id="addr<?php echo $i;?>" style="background-color:#94C973!important; font-weight:bold">
			<td>
				<textarea rows='4' cols='40' name="desc[]" id="desc<?php echo $i;?>" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm" tabindex='5' required><?php echo $r->product_desc;?></textarea>
			</td>
			<td>	
				<input type="number" name="qty[]" id="qty<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" value="<?php echo $r->quantity;?>" onkeyup="calculate_total('<?php echo $i;?>')" tabindex='8'>
			</td>
			<td>
				<input type="number" step='0.01' name="price[]" id="price<?php echo $i;?>" class="form-control form-control-sm"  onkeyup="calculate_total('<?php echo $i;?>')" value="<?php echo $r->price;?>" tabindex='9' required>
				
			</td>
			<td>
				<input type="number" name="total[]" id="total<?php echo $i;?>" value="<?php echo $r->total;?>" class="form-control bg-soft-gray form-control-sm subItemAmt" readonly required>
				<input type="text" name="item_remark[]" id="item_remark<?php echo $i;?>" tabindex='10' class="form-control form-control-sm" placeholder="remark" value="<?php echo $r->item_remark;?>">
				
				<input type="hidden"  name="mainqty[]" value="<?php echo $r->quantity;?>" >
				<input type="hidden"  name="product_id[]" value="<?php echo $r->product_id;?>" >
				<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
				<input type="hidden"  name="append_id[]" value="<?php echo $i;?>" >
				<br>
				<a id='delete_row' title="Delete" onclick='remove_row("<?php echo $i;?>")' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
			</td>
		</tr>
		<?php $k=1; if($records3){?>
		<tr>
			<td colspan='4'>
				<table width='100%'>
				<tr>
					<td width='70%'>Sub Heading</td>
					<td width='30%'></td>
				</tr>
				<?php foreach($records3 as $t) :
				if($t->trans_id1==$r->trans_id){?>
				<tr>
					<td>
						<textarea rows='3' cols='10'  name="sub_details<?php echo $i;?>[]" id="sub_detailsd<?php echo $i.$k;?>" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm"  required><?php echo $t->sub_details;?></textarea>
					</td>
					<td><input type="hidden" name="qty<?php echo $i;?>[]" id="qty<?php echo $i.$k;?>" tabindex='10' class="form-control form-control-sm" value="<?php echo $t->qty;?>"></td>
				</tr>
				<?php } endforeach; ?>
				</table>
			</td>
		</tr>
		
		<?php $k++; }  $i++; } ?>
		<tr id='addr1'></tr>
		</tbody>
	</table>
	</div>
	<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-1 col-lg-1 col-form-label">SubTot</label>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		     	 <input type="text" id='sub_total' name='sub_total' readonly class="form-control form-control-sm bg-soft-gray" value="<?php echo $row->sub_total;?>" >
		    </div>

	     	     <label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 col-form-label">Dis.%:</label>
	    	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <input type="number" step='0.01'  name="discount" id="discount" class="form-control form-control-sm"  onkeyup="calculate_grand_total()" value="<?php echo $row->discount_percent;?>" tabindex=11>
		      </div>
	    	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <input type="number" step="0.01" name="discount_amt" id="discount_amt" class="form-control form-control-sm"  onkeyup="calculate_grand_total()" value="<?php echo $row->discount_amt;?>" tabindex=12>
		     </div>
		    <label class="col-xs-12 col-sm-2 col-md-2  col-lg-2 col-form-label">Total before VAT</label>
		    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		       <input type="text" id='total_before_vat' name='total_before_vat' readonly class="form-control form-control-sm bg-soft-gray" value="<?php echo $row->sub_total-$row->discount_amt;?>" >
		      </div>
		</div>
		<hr class='bg-primary'></hr>
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">VAT (<?php echo $vat_percent?>%) 
	    <input type='checkbox' id='vatbox' value='1' checked onclick='check_vat_option()' /></label>
		    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		      <input type="text" id='vat_amt' name='vat_amt' class="form-control form-control-sm bg-soft-gray" readonly value="<?php echo $row->vat_amt;?>" readonly>
	     		  <input type="hidden" id='vat_percent' name='vat_percent'  value="<?php echo $row->vat_percent;?>" >
	     		  <input type="hidden" id='vat_percent1' name='vat_percent1' value="<?php echo $vat_percent;?>" >
		      </div>
		      <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		       <input type="text" id='miscellaneous1' name='miscellaneous1' class="form-control form-control-sm"  value="<?php echo $row->other1;?>" >
		    </div>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		      <input type="number" step='0.01' id='miscellaneous_amt1' name='miscellaneous_amt1' class="form-control form-control-sm" value="<?php echo $row->other1_amt;?>" onkeyup="calculate_grand_total()">	      		
		    </div>
		   
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		      <input type="text" id='miscellaneous2' name='miscellaneous2' class="form-control form-control-sm" value="<?php echo $row->other2;?>" >
		    </div>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		      <input type="number" step='0.01' id='miscellaneous_amt2' name='miscellaneous_amt2' class="form-control form-control-sm" value="<?php echo $row->other2_amt;?>"  onkeyup="calculate_grand_total()">	      		
		    </div>
		</div>
		<div class="form-group row">
		     
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label"> Currency Rate <span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		    	<select tabindex="13" class="form-select form-control-sm select2" id="currency_id" name="currency_id" onchange="get_currency_conversion()" style='width:175px'>
				<option value="">Select</option>
				<?php foreach($currency_list as $s) {?>
				  <option <?php if($s->id==$row->currency_id) echo 'selected'; ?> value="<?php echo $s->id.'@'.$s->rate.'@'.$s->currabrev; ?>"><?php echo $s->country.' '.$s->currabrev;?></option>
				<?php } ?>
		      </select>
	      		<input type="hidden" id='cid' name='cid' value="<?php echo $row->currency_id;?>">
	      		<input type="text" id='crate' name='crate' class="form-control form-control-sm bg-soft-gray" readonly value="<?php echo $row->currency_rate;?>">
		      </div>
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Grand Total <span id='currabrev'></span><span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		      <input type="text" id='grand_total' name='grand_total' readonly class="form-control form-control-sm bg-soft-gray"  value="<?php echo $row->grand_total;?>" required>
		      </div>
		</div>
		<hr>
		
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Payment Term:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px'  cols='50' rows='3' name="term1" id="term1"  tabindex=14 class="form-control form-control-sm" ><?php echo $row->payment_term?></textarea>		     
		    </div>
		</div>
		
		
		<div id='cust_address'>
		<h6>Billing Address</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address:</label>
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<input type="text" id="billing_addr1" name="billing_addr1"  class="form-control col-sm-2 form-control-sm"  placeholder="write billing address" tabindex="18" value="<?php echo $row->billing_addr;?>">
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">City:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input  id="billing_city" name="billing_city" type="text" class="form-control col-sm-2 form-control-sm" tabindex="19" value="<?php echo $row->billing_city;?>"/>
			</div>
			<label class="col-sm-2 control-label">State:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_state" name="billing_state" type="text" class="form-control col-sm-2 form-control-sm" tabindex="20" value="<?php echo $row->billing_state;?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">PO Box:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input  id="billing_po" name="billing_po" type="text" tabindex="21" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->billing_pincode;?>"/>
			</div>
			<label class="col-sm-2 control-label">Country:</label>
			 <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="billing_country" name="billing_country" type="text" tabindex="22" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->billing_country;?>"/>
			</div>
		</div>    		
		<h6>Shipping Address</h6>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address:</label>
			<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
				<input type="text" id="shipping_addr1" name="shipping_addr1"  tabindex="23" class="form-control col-sm-2 form-control-sm"  placeholder="write shipping address" value="<?php echo $row->shipping_addr;?>">
			</div>
	       </div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">City:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_city" name="shipping_city" tabindex="24" type="text" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->shipping_city;?>"/>
			</div>
			<label class="col-sm-2 control-label">State:</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_state" name="shipping_state" tabindex="25" type="text" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->shipping_state;?>"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 control-label">PO Box:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_po" name="shipping_po" tabindex="26" type="text" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->shipping_pincode;?>"/>
			</div>
			<label class="col-sm-2 control-label">Country:</label>
			 <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			<input id="shipping_country" name="shipping_country" tabindex="27" type="text" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->shipping_country;?>"/>
			</div>
		</div>	
		
		<h6>Contact Person Details</h6>
		<div class="form-group row">
			<label class="col-sm-2 control-label">CP Name:</label>
		  	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			<input id="cp_name" name="cp_name" tabindex="28" type="text" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->cp_name;?>"/>
			</div>
			<label class="col-sm-2 control-label">CP Mobile:</label>
			 <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			<input  id="cp_mobile" name="cp_mobile" tabindex="29" type="text" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->cp_mobile;?>"/>
			</div>
			<label class="col-sm-2 control-label">CP Email:</label>
			 <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			<input id="cp_email" name="cp_email" tabindex="30" type="email" class="form-control col-sm-2 form-control-sm" value="<?php echo $row->cp_email;?>"/>
			</div>
		</div>	   
		</div>
		
		<h6>Company Bank Details</h6>
		<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_logic">
				   <thead>
				    <tr>
				    	     <th title="Item">Select</th>
				    	     <th title="Item">Bank Name</th>
				    	    <th title="Item">Bank Account</th>    
				    	    <th title="Item">Bank Branch</th>    
				    	    <th title="Item">Bank IBAN</th>    
				    	    <th title="Item">Bank SWIFT</th>   
					</tr>
				    </thead>		 
				    <tbody id="mytbbody">
					<?php foreach($bank_details as $r){?>
				    	<tr style='font-size: 13px;'>
						<td width='30px'>
						<input type='radio' name='bank' <?php if($row->bank_id==$r->bid) echo 'checked'; ?> value='<?php echo $r->bid;?>'  />
						<input type="hidden"  name="trans_id[]" value="<?php echo $r->bid;?>" >
						</td>
						<td><input type="text" name="bname_old[]" id="bname" tabindex='2' class="form-control" placeholder="" value="<?php echo $r->bank_name;?>" readonly></td>
						<td><input type="text" name="bacc_old[]" id="bacc" tabindex='3' class="form-control" placeholder="" value="<?php echo $r->bank_account;?>"readonly ></td>
						<td><input type="text" name="bbranch_old[]" id="bbranch" tabindex='3' class="form-control" placeholder="" value="<?php echo $r->bank_branch;?>" readonly></td>
						<td><input type="text" name="biban_old[]" id="biban" tabindex='3' class="form-control" placeholder="" value="<?php echo $r->bank_iban;?>" readonly></td>
						<td><input type="text" name="bswift_old[]" id="bswift" tabindex='3' class="form-control" placeholder="" value="<?php echo $r->bank_swift;?>" readonly></td>
					</tr>
	     				<?php } ?>
				</tbody>
			</table>
		</div>	
		<div class="form-group row">
		   	<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Client PO No</label>
		    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
	   		 <input type='text'  name="po_no" id="po_no"  tabindex='3' class="form-control form-control-sm" value="<?php echo $row->po_number;?>"  />		     
		    </div>
		   <label class="col-xs-12 col-sm-3 col-md-3 col-lg-2 col-form-label"> PO Date</label>
		   <div class="col-xs-12 col-sm-9 col-md-3 col-lg-2" role='group'>
		    <div class="input-group date datepicker1">			                  
		    	<input type="text" class="form-control form-control-sm datepicker1" id="po_date" name="po_date" value="<?php echo date('d-m-Y',strtotime($row->po_date??''))?>" required tabindex=1>
    		    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
	            </div>
    	     	    </div>	     
	         </div>	
		<div class="form-group row">
		     	<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Sales Person:</label>
		    	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <select tabindex="1" class="form-select form-control-sm select2" id="user_id" name="user_id" required style='width:170px'>
				<option value="">Select</option>
				<?php foreach($user_records as $s) {?>
				  <option <?php if($this->session->userdata('user_id')==$s->user_id) echo 'selected'; ?> value="<?php echo $s->user_id ?>"><?php echo $s->user_name;?></option>
				<?php } ?>
			      </select>
		       </div>
		       <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Select Stamp</label>
		    	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <select tabindex="2" class="form-select form-control-sm" id="stamp" name="stamp" >
				<option value="">Select</option>
		    		<?php foreach($stamp_details as $r){?>
				<option <?php if($r->img_id==$row->stamp_id) echo 'selected';?> value="<?php echo $r->img_id;?>"><?php echo $r->stamp_name;?></option>
			      <?php } ?>
			      </select>
		       </div>
		     	<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Job NO:</label>
		    	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <input type="text" name="hs_code" id="hs_code" class="form-control form-control-sm" value="<?php echo $row->hs_code;?>" >
		       </div>
		</div>
		
	         <div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Payment Mode:</label>
		    <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
	   		  <select tabindex="6" class="form-select form-control-sm" id="payment_mode" name="payment_mode" required>
				<option value="">Select</option>
				<option value="1" <?php if($row->payment_mode=='1') echo 'selected'; ?>>Cash</option>
				<option value="2" <?php if($row->payment_mode=='2') echo 'selected'; ?>>Cheque</option>
				<option value="3" <?php if($row->payment_mode=='3') echo 'selected'; ?>>Online</option>
				<option value="4" <?php if($row->payment_mode=='4') echo 'selected'; ?> >Credit</option>
			      </select>		     
		    </div>
    		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label" style='font-size:13px;'>Payment/Advance Received</label>
    		    <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
	      		<input type="text" id='received_percent' name='received_percent' placeholder='%' class="form-control"  onkeyup="calculate_percent();" value='<?php echo $row->received_percent; ?>'>
      		   </div>
    		  <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
	    		<?php  //$x= get_quotation_wise_invamt_received($row->quote_id);?>
	      		<input type="text" id='received_amt' name='received_amt' step="0.001" class="form-control"  onkeyup="calculate_advance();" value='<?php echo $row->paid_amt; ?>'>
      		    </div>
    		    <label class="col-xs-12 col-sm-2 col-md-1 col-lg-1 col-form-label" style='font-size:15px;'>Balance</label>
		   <div class="col-xs-12 col-sm-10 col-md-2 col-lg-2">
		      		<input type="text"   tabindex="8" name="balance" id="balance" class="form-control" readonly>
		      
    		   </div>
		</div>
		<div class="form-group row">
		<label class="col-sm-1"></label>
		<!--<input type="hidden"  name="enq_id" value="<?php echo $row->enq_master_id;?>" >
		<input type="hidden"  name="quote_id" value="<?php echo $row->quote_id;?>" >-->
		<input type="hidden"  name="inv_type" value="<?php echo $row->inv_type;?>" >
		<input type="hidden"  name="invoice_id" value="<?php echo $row->invoice_id;?>" >
		
		<?php if($edit_flag==1){?>
		<div class="col-sm-8">
		<button type="submit"  tabindex="31"  id="add" class="btn btn-primary m-b-0">Update Invoice</button>
			<button type="reset"  id='reset' class="btn btn-primary m-b-0">Reset</button>
			<button class="btn btn-primary m-b-0" onclick="goBack()">Back</button>
		</div>
		<?php } ?>
		</div>
		</form>

<?php } ?>
        </div>
    </div>
</div>
</div>
</div>
</div>


<script>
$(document).ready(function(){
calculate_grand_total()
	var i=1;
	$("#add_row").click(function()
	{
	     $('#addr'+i).html("<td><input type='text' name='srn_nw[]' id='srn"+i+"' tabindex='18' class='form-control form-control-sm' placeholder='' ></td><td><select tabindex='19' class='form-select form-control-sm select2 select2Width' id='product_id"+i+"' name='product_id_nw[]' onchange='get_product_info("+i+")' ><option value=''>Select Code</option><?php foreach($products as $s) {$size= str_replace('"', ' Inch' ,$s->size);?> <option value='<?php echo $s->product_id; ?>'><?php echo $s->pcode.' '.$size;?></option><?php } ?></select><input type='text'  name='order_code_nw[]' id='order_code"+i+"' tabindex='20' class='form-control form-control-sm select2Width' placeholder='Enter Customized Code Here'  onkeyup='get_product_description("+i+");'><input type='hidden' name='pcode_nw[]' id='pcode"+i+"' class='form-control form-control-sm'><textarea rows='6' cols='26' name='desc_nw[]' id='desc"+i+"' class='form-control form-control-sm select2Width' style='font-size:11px; font-weight:bold;' tabindex='21'></textarea></td><td>Size<input type='text' name='size_nw[]' id='size"+i+"' tabindex='15' class='form-control form-control-sm' placeholder='' value=''><br>Quantity<input type='number' name='qty_nw[]' id='qty"+i+"'  class='form-control form-control-sm' value='0' ></td><td><input type='number' step='0.01' name='price_nw[]' id='price"+i+"' class='form-control form-control-sm'  onchange='calculate_total("+i+")' value=0 tabindex='9' required><br><br><br>Total<input type='number' name='total_nw[]' id='total"+i+"' value=0  class='form-control bg-soft-gray form-control-sm subItemAmt' readonly required><br><br></td><td><textarea name='item_remark_nw[]' id='item_remark"+i+"' placeholder='remark' tabindex='24' class='form-control form-control-sm' ></textarea><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytbbody tr:last').after('<tr id="addr'+(i+1)+'"></tr>');
	      i++; 	     	
	     $('.select2').select2({ width: "220px" });
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
        calculate_grand_total();
   }
 


function calculate_total(append_id)
{
	var price = parseFloat(document.getElementById("price"+append_id).value);
	var quantity = parseFloat(document.getElementById("qty"+append_id).value);
	var total = price*quantity;
	document.getElementById("total"+append_id).value=parseFloat(total).toFixed(2);

	calculate_grand_total();
}
function calculate_grand_total()
{
	var i_value=0;i_total=0;
	$('.subItemAmt').each(function()
	{
		i_value=$(this).val();
		if(i_value=='')
			 i_value = 0;
		else
			i_total+=parseFloat(i_value);
	});
	if(isNaN(i_total)) var s_total = 0;

	document.getElementById("sub_total").value= parseFloat(i_total).toFixed(2);

	if(document.getElementById("discount").value==0)
		var discount=0;
	else
	{
		var discount_per = parseFloat(document.getElementById("discount").value/100);
		var discount= i_total*discount_per;
		document.getElementById("discount_amt").value= parseFloat(discount).toFixed(2);
	}
	var discount= document.getElementById("discount_amt").value;
	var total_before_vat = i_total-discount;
	document.getElementById("total_before_vat").value= parseFloat(total_before_vat).toFixed(2);


	var vat_percent= document.getElementById("vat_percent").value;
	var vat_per= parseFloat(vat_percent/100);
   	var calVatAmt = parseFloat(total_before_vat*vat_per);
	document.getElementById("vat_amt").value= parseFloat(calVatAmt).toFixed(2);
   	
	var miscellaneous_amt1= parseFloat(document.getElementById("miscellaneous_amt1").value);
	var miscellaneous_amt2= parseFloat(document.getElementById("miscellaneous_amt2").value);
	var miscellaneous_amt3= parseFloat(document.getElementById("miscellaneous_amt3").value);
   	var grand_total = parseFloat(calVatAmt+total_before_vat+miscellaneous_amt1+miscellaneous_amt2+miscellaneous_amt3);
	
	var crate= document.getElementById('crate').value;
	var grand_total = parseFloat(grand_total);
	document.getElementById("grand_total").value= parseFloat(grand_total).toFixed(2);
}

function check_vat_option()
{
	var checkBox = document.getElementById("vatbox");	
	var vat_percent=document.getElementById("vat_percent1").value;
	
	// If the checkbox is checked, display the output text
	if (checkBox.checked == true){
		$("#vat_percent").val(vat_percent);	
		calculate_grand_total();
		//var total_before_vat = document.getElementById("total_before_vat").value;
		//var subtot=parseFloat(total_before_vat*(vat_percent/100)).toFixed(2);
		//var x= parseFloat(total_before_vat)+parseFloat(subtot);
	 	//document.getElementById("vat_amt").value=subtot;
	 	//document.getElementById("grand_total").value=parseFloat(x).toFixed(2);
	 	
	} else {
	 
		$("#vat_percent").val(0);
	 	document.getElementById("vat_amt").value=0.00;	
		calculate_grand_total();
		//var total_before_vat = document.getElementById("total_before_vat").value;
	 	//document.getElementById("grand_total").value=total_before_vat;
	}
}
function get_currency_conversion()
{
	var str=$('#currency_id').val();
	var myarray = str.split("@");
	var cid=myarray[0];
	var crate=myarray[1];
	var currabrev=myarray[2];
	document.getElementById('cid').value=cid;
	document.getElementById('crate').value=crate;
	document.getElementById('currabrev').innerHTML=currabrev;
	calculate_grand_total();
}


function get_product_info(append_id)
{
	var product_id= document.getElementById("product_id"+append_id).value;
	if(product_id!='')
	{
	$.ajax
	({
		url: "<?php echo site_url('Product/ajax_get_product_details'); ?>",
		type: 'POST',
		data: {product_id: product_id },
		dataType: "json",
		success: function(msg) {
				document.getElementById("order_code"+append_id).value=msg.pcode;
				document.getElementById("pcode"+append_id).value=msg.pcode;
				document.getElementById("desc"+append_id).value=msg.product_description;
				document.getElementById("size"+append_id).value=msg.size;
		}
	});
	}
	else
	{
		document.getElementById("order_code"+append_id).value='';
		document.getElementById("pcode"+append_id).value='';
		document.getElementById("desc"+append_id).value='';
		document.getElementById("size"+append_id).value='';
	}
}


function get_product_description(append_id)
{
	var pcode= $('#order_code'+append_id).val();
	var newStr = pcode.replaceAll(',','');
	$('#pcode'+append_id).val(newStr);
	$.ajax
	({
		url: "<?php echo site_url('Product/get_product_description'); ?>",
		type: 'POST',
		data: {post_id: pcode },
		success: function(msg) {
			if(msg!=0)
			{
				//alert(msg);
				$('#desc'+append_id).val(msg);
				
			}
			else
			{
				alert('Match not found');
			}
		}
	});
}

function get_customer_info()
{
	var customer_id=$("#customer_id").val();
	
	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Ajax/get_customer_address",
        data: {customer_id:customer_id} ,
        success: function(msg){	       	
		document.getElementById('cust_address').innerHTML=msg;
	     }
	});
}

function confirmcancel(id)
{   
	var r= confirm("Are you sure you want to Delete this row?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Ajax/delete_record",
     		type: "POST",
     		data: {table_name:'invoice_transaction', where_key:'trans_id', where_val:id} ,
     		success: function(msg) {
     			if(msg==1) 
     			{     	
			         alert("Record deleted"); 				
        			 window.location.href="<?php echo $_SERVER['PHP_SELF']?>";   		                    		  
			}
		        else {
			      	alert("Can't Delete record. Data already exist!!!");
		       }
		    },
		});
      		return true;
      	}
        else
        	return false;
	    	
}
function calculate_percent()
 {
    	var grand_total = parseFloat(document.getElementById("grand_total").value);
	var advance_percent = document.getElementById("received_percent").value;	
	var adv_per= parseFloat(advance_percent/100);
	var x= parseFloat(grand_total*adv_per).toFixed(2);
	//alert(x);
	document.getElementById("received_amt").value=x;
	calculate_advance();
 }
 
 function calculate_advance()
 {
    	var grand_total = parseFloat(document.getElementById("grand_total").value);
	var received_amt = document.getElementById("received_amt").value;	
	var bal_amt= parseFloat(grand_total-received_amt);
	document.getElementById("balance").value=bal_amt;
 }
</script>



