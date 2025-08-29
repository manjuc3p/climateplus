<div class="card-body">
	<form onsubmit="return check_total();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_invoice_data" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Select Approved Quotation <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4" role='group'>
				<select tabindex="1" class="form-select form-control-sm select2" id="qid" name="qid" required onchange="get_quotation_info()" >
				<option value="">Select</option>
				<?php foreach($records as $s) {?>
				  <option value="<?php echo $s->quote_id ?>"><?php echo $s->quotation_code.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Invoice Type <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<select tabindex="2" class="form-select form-control-sm" id="inv_type" name="inv_type" required onchange="get_inv_code()" >
				<option value="">Select</option>
				<option value="PI">Proforma Invoice</option>
				<option  value="TI">Tax Invoice</option>
			      </select>
    	     		 </div>
		</div>
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Invoice date <span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date ">			                  
		    			<input type="text" class="form-control form-control-sm " id="invdate" name="invdate" value="<?php echo date('d-m-Y')?>" required tabindex='3' readonly>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>

	     	    <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label"></label>
	     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">Invoice Code <span style="color: red;"> * </span></label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			      <input type="text" name="invcode" id="invcode" class="form-control form-control-sm"  tabindex='4' value="<?php echo $code; ?>">
		     </div>
		</div>
		
		
		<div id="item_list_id"> 
		<input type='hidden' name="ref_no" id="ref_no"  />	
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
						<input type='radio' name='bank' value='<?php echo $r->bid;?>' checked />
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
			      <select tabindex="2" class="form-select form-control-sm" id="stamp" name="stamp">
				<option value="">Select</option>
		    		<?php foreach($stamp_details as $r){?>
				<option <?php if($r->img_id==4) echo 'selected';?> value="<?php echo $r->img_id;?>" ><?php echo $r->stamp_name;?></option>
			        <?php } ?>
			      </select>
		       </div>
		</div>
		<div id='account_entry' style="display:none;">
		Sales Invoice Account Entry :
		<div class="form-group row">
		     <div class="col-md-6">
                            	<table class="table table-bordered table-hover" id="inv_dr_table">
                                <thead>
                                    <tr>
                               		    <th title="Item">Debit Customer (Dr)</th> 
				    	    <th title="Item">Debit Amount (AED)</th>  
				    	    <!--<th width='10%'><a id="inv_dr_add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a></th>-->

                                    </tr>
                                 </thead>
                                    <tbody id="inv_dr_body">
				     <tr id='inv_dr_addr0'>
					<td>
						<select class="form-select form-control-sm select3 select2Width" id="inv_debtor0" name="inv_debtor[]" >
						<option value="">Select</option>
						<?php foreach($sundry_accounts1 as $row) { ?>
			       	    		<option value="<?php echo $row->account_id; ?>"><?php echo $row->account_name; ?></option>
						<?php } ?>
					      </select>
					   </td>   
					      <td><input type="number" step='0.01' name="inv_dr_amount[]" id="inv_dr_amount0" class="form-control form-control-sm debit_sum" min=0>
					</td>
					<!--<td><a id='delete_row1' title="Delete" onclick='remove_row_inv_dr(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>-->
					</tr>
					<tr id='inv_dr_addr1'></tr>
                                </tbody>
                             </table>
                     </div>
                          <div class="col-md-6">
                            	<table class="table table-bordered table-hover" id="inv_cr_table">
                                <thead>
                                    <tr>
                               		    <th title="Item">Credit Account (Cr)</th> 
				    	    <th title="Item">Credit Amount (AED)</th>  
				    	    <th width='10%'><a id="inv_cr_add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a></th>

                                    </tr>
                                 </thead>
                                    <tbody id="inv_cr_body">
				     <tr id='inv_cr_addr0'>
					<td>
						<select class="form-select form-control-sm select3 "  id="inv_creditor0" name="inv_creditor[]">
						<option value="">Select</option>
					<?php foreach($sundry_accounts2 as $row) { ?>
		       	    		<option <?php if($row->account_id==694) echo 'selected'; ?>  value="<?php echo $row->account_id; ?>"><?php echo $row->account_name; ?></option>
					<?php } ?>
					      </select>
					      <!--<label id='set_balanceinv_cr0'>Balance</label>-->
					   </td>   
					      <td><input type="number" step='0.01' name="inv_cr_amount[]" id="inv_cr_amount0" class="form-control form-control-sm credit_sum"  min=0 >
					</td>
					<td><a id='delete_row1' title="Delete" onclick='remove_row_inv_cr(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='inv_cr_addr1'>
					<td>
						<select class="form-select form-control-sm select3" id="inv_creditor1" name="inv_creditor[]">
						<option value="">Select</option>
					<?php foreach($sundry_accounts3 as $row) { ?>
		       	    		<option <?php if($row->account_id==833) echo 'selected'; ?>  value="<?php echo $row->account_id; ?>"><?php echo $row->account_name; ?></option>
					<?php } ?>
					      </select>
					      <!--<label id='set_balanceinv_cr0'>Balance</label>-->
					   </td>   
					      <td><input type="number" step='0.01' name="inv_cr_amount[]" id="inv_cr_amount1" class="form-control form-control-sm credit_sum" min=0 >
					</td>
					<td><a id='delete_row1' title="Delete" onclick='remove_row_inv_cr(1)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='inv_cr_addr2'>
					<td>
						<select class="form-select form-control-sm select3" id="inv_creditor2" name="inv_creditor[]">
						<option value="">Select</option>
					<?php foreach($sundry_accounts3 as $row) { ?>
		       	    		<option <?php if($row->account_id==237) echo 'selected'; ?> value="<?php echo $row->account_id; ?>"><?php echo $row->account_name; ?></option>
					<?php } ?>
					      </select>
					      <!--<label id='set_balanceinv_cr0'>Balance</label>-->
					   </td>   
					      <td><input type="number" step='0.01' name="inv_cr_amount[]" id="inv_cr_amount2" class="form-control form-control-sm credit_sum1" min=0 >
					</td>
					<td><a id='delete_row1' title="Delete" onclick='remove_row_inv_cr(2)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					
					<tr id='inv_cr_addr2'>
					<td>
						<select class="form-select form-control-sm select3" id="inv_creditor3" name="inv_creditor[]">
						<option value="">Select</option>
					<?php foreach($sundry_accounts3 as $row) { ?>
		       	    		<option value="<?php echo $row->account_id; ?>"><?php echo $row->account_name; ?></option>
					<?php } ?>
					      </select>
					      <!--<label id='set_balanceinv_cr0'>Balance</label>-->
					   </td>   
					      <td><input type="number" step='0.01' name="inv_cr_amount[]" id="inv_cr_amount3" class="form-control form-control-sm credit_sum" min=0 value='0'>
					</td>
					<td><a id='delete_row1' title="Delete" onclick='remove_row_inv_cr(3)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
                                </tbody>
                             </table>
                          </div>
                 </div>  
                 <!---onchange="get_account_balance(0,'receipt_dr','debtor')"-->
                <!--- Sales Invoice Receipt Entry:
		<div class="form-group row">
		     <div class="col-md-6">
                            	<table class="table table-bordered table-hover" id="receipt_dr_table">
                                <thead>
                                    <tr>
                               		    <th title="Item">Debit Account (Dr)</th> 
				    	    <th title="Item">Debit Amount</th>  
				    	    <th width='10%'><a id="receipt_dr_add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a></th>

                                    </tr>
                                 </thead>
                                    <tbody id="receipt_dr_body">
				     <tr id='receipt_dr_addr0'>
					<td>
						<select class="form-select form-control-sm select2" id="receipt_debtor0" name="receipt_debtor[]"  requird>
						<option value="">Select</option>
						<?php foreach($sundry_accounts2 as $row) { ?>
			       	    		<option value="<?php echo $row->account_id; ?>"><?php echo $row->account_name; ?></option>
						<?php } ?>
					      </select>
					      <label id='set_balancereceipt_dr0'>Balance</label>
					   </td>   
					      <td><input type="number" step='0.01' name="receipt_dr_amount[]" id="receipt_dr_amount0" class="form-control form-control-sm debit_sum" requird min=0 >
					</td>
					<td><a id='delete_row1' title="Delete" onclick='remove_row_receipt_dr(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='receipt_dr_addr1'></tr>
                                </tbody>
                             </table>
                     </div>
                          <div class="col-md-6">
                            	<table class="table table-bordered table-hover" id="receipt_cr_table">
                                <thead>
                                    <tr>
                               		    <th title="Item">Credit Customer (Cr)</th> 
				    	    <th title="Item">Credit Amount</th>  
				    	    <th width='10%'><a id="receipt_cr_add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a></th>

                                    </tr>
                                 </thead>
                                    <tbody id="receipt_cr_body">
				     <tr id='receipt_cr_addr0'>
					<td>
						<select class="form-select form-control-sm select2" id="receipt_creditor0" name="receipt_creditor[]" requird>
						<option value="">Select</option>
					<?php foreach($sundry_accounts1 as $row) { ?>
		       	    		<option value="<?php echo $row->account_id; ?>"><?php echo $row->account_name; ?></option>
					<?php } ?>
					      </select>
					   </td>   
					      <td><input type="number" step='0.01' name="receipt_cr_amount[]" id="receipt_cr_amount0" class="form-control form-control-sm credit_sum" requird min=0 >
					</td>
					<td><a id='delete_row1' title="Delete" onclick='remove_row_receipt_cr(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='receipt_cr_addr1'></tr>
                                </tbody>
                             </table>
                          </div>
                 </div>-->   
                 
                 </div>  <!-- account entry end--------->   
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
			<button type="submit"  tabindex="6"  id="add" class="btn btn-primary m-b-0">Generate Invoice</button>
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
	$("#inv_dr_add_row").click(function()
	{
	alert(i);
	     $('#inv_dr_addr'+i).html("<td><select class='form-select form-control-sm select2' id='inv_debtor"+i+"' name='receipt_debtor[]'  requird><option value=''>Select</option><?php foreach($sundry_accounts2 as $row) { ?><option value='<?php echo $row->account_id; ?>'><?php echo $row->account_name; ?></option><?php } ?></select></td><td></td><td></td>");
	    $('#inv_dr_body tr:last').after('<tr id="inv_dr_addr'+(i+1)+'"></tr>');
	      i++; 	     	
	     $('.select2').select2({ width: "220px" });
	});
	 
	
});  

function remove_row_inv_dr(append_id)
{    	 
$('#inv_dr_addr'+append_id).attr("id","inv_dr_addr"+append_id+"x");
$('#inv_dr_addr'+append_id+"x").remove();
}
function remove_row_inv_cr(append_id)
{    	 
$('#inv_cr_addr'+append_id).attr("id","inv_cr_addr"+append_id+"x");
$('#inv_cr_addr'+append_id+"x").remove();
}


function remove_row(append_id)
   {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
        calculate_grand_total();
   }
function get_quotation_info()
{
	var qid = document.getElementById("qid").value;	
   	if(qid!='')
   	{
	   	$.ajax({
	   	async:"false",
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_quotation_info",
		data: {qid:qid} ,
		success: function(msg){
			document.getElementById('item_list_id').innerHTML=msg;
			get_inv_code();
			
				$.ajax({
			   	async:"false",
				type: "POST",
				url:"<?php echo base_url()?>index.php/Ajax/ajax_get_cust_accountId_from_quote",
				data: {qid:qid} ,
				success: function(accid){
					document.getElementById('inv_debtor0').value=accid;
					
					var grand_total= document.getElementById("grand_total").value;
					var sub_total= document.getElementById("sub_total").value;
					var discount_amt= document.getElementById("discount_amt").value;
					var vat_amt= document.getElementById("vat_amt").value;
					var crate = document.getElementById('crate').value;
					var x= (grand_total*crate).toFixed(2);	
					document.getElementById("inv_dr_amount0").value=x; 
					document.getElementById("inv_cr_amount0").value=(sub_total*crate).toFixed(2); 
					document.getElementById("inv_cr_amount2").value=(discount_amt*crate).toFixed(2); 
					document.getElementById("inv_cr_amount1").value=(vat_amt*crate).toFixed(2); 
				     }
				});
		     }
		});
	}
}

function get_inv_code()
{
	var type = document.getElementById("inv_type").value;
	var ref_no = '';	
	$('.select3').select2({ width: "220px" });
	$.ajax({
		type: "POST",
		url:"<?php echo base_url()?>index.php/Sales/get_invoice_code",
		data: {type:type, ref_no:ref_no} ,
		success: function(msg){	  
			document.getElementById("invcode").value=msg;
		     }
	});
	
	if(type=='TI')
		document.getElementById('account_entry').style.display='block';
	else
		document.getElementById('account_entry').style.display='none';
}
function get_job_code()
{
	var qid = document.getElementById("qid").value;

	$.ajax({
		type: "POST",
		url:"<?php echo base_url()?>index.php/Sales/get_invoice_code",
		data: {qid:qid} ,
		success: function(msg){	  
			document.getElementById("invcode").value=msg;
		     }
	});
	
	
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
		var discount= i_total*discount_per
	}
	var total_before_vat = i_total-discount;
	
	document.getElementById("discount_amt").value= parseFloat(discount).toFixed(2);
	document.getElementById("total_before_vat").value= parseFloat(total_before_vat).toFixed(2);


	var vat_percent= document.getElementById("vat_percent").value;
	var vat_per= parseFloat(vat_percent/100);
   	var calVatAmt = parseFloat(total_before_vat*vat_per);
	document.getElementById("vat_amt").value= parseFloat(calVatAmt).toFixed(2);
	document.getElementById("inv_cr_amount0").value= parseFloat(i_total).toFixed(2);
	document.getElementById("inv_cr_amount1").value= parseFloat(calVatAmt).toFixed(2);
	document.getElementById("inv_cr_amount2").value= parseFloat(discount).toFixed(2);
   	
	var miscellaneous_amt1= parseFloat(document.getElementById("miscellaneous_amt1").value);
	var miscellaneous_amt2= parseFloat(document.getElementById("miscellaneous_amt2").value);
   	var grand_total = parseFloat(calVatAmt+total_before_vat+miscellaneous_amt1+miscellaneous_amt2);
	
	//var crate= document.getElementById('crate').value;
	var crate=1;
	var grand_total = parseFloat(grand_total*crate);
	document.getElementById("grand_total").value= parseFloat(grand_total).toFixed(2);
	document.getElementById("inv_dr_amount0").value= parseFloat(grand_total*document.getElementById('crate').value).toFixed(2);
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
	
	var grand_total= document.getElementById("grand_total").value;
	var crate = document.getElementById('crate').value;
	var x= (grand_total*crate).toFixed(2);	
	document.getElementById("inv_dr_amount0").value=x; 
			
	//calculate_grand_total();
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

function get_account_balance(append_id,type,crdr_type)
{
	if(type=='inv_dr' || type=='inv_cr')
		var x= 'inv_';
	else
		var x= 'receipt_';
		
	var account_id=document.getElementById(x+crdr_type+append_id).value;
	var today="<?php echo date('Y-m-d')?>";
	$.ajax
	({
		url: "<?php echo site_url('Accounts/get_account_balance'); ?>",
		type: 'POST',
		data: {account_id: account_id, today:today },
		success: function(msg) {
			if(msg)
			{
				//alert(msg);
				document.getElementById('set_balance'+type+append_id).innerHTML='Balance: '+msg;
				
			}
		}
	});
}
function check_total()
{
	var type = document.getElementById("inv_type").value;
	if(type=='TI')
	{
		
		document.getElementById("inv_debtor0").required = true;
		document.getElementById("inv_dr_amount0").required = true;
		
		var a1 = parseFloat(document.getElementById("inv_cr_amount0").value);
		var a2 = parseFloat(document.getElementById("inv_cr_amount1").value);
		var a3 = parseFloat(document.getElementById("inv_cr_amount2").value);
		var a4 =parseFloat(document.getElementById("inv_cr_amount3").value);
		var k_total= parseFloat(a1+a2+a4-a3).toFixed(2);
		
	 	var dr_total=$('#inv_dr_amount0').val();

		 if(parseFloat(k_total) != parseFloat(dr_total))
		{
		     alert("Both debit total and credit total must match");
		     return false;
		}
	}
	else
	{
		
		document.getElementById("inv_debtor0").required = false;
		document.getElementById("inv_dr_amount0").required = false;
		return true;
	}
}
function calculate_discount(event,append_id){
	var total=0;
	var new_tot=0;
	if(event.target.id == "dis_per"+append_id){
		var dis_per = event.target.value;
		if( !isNaN(dis_per) && dis_per > 0 ){
		document.getElementById("dis_val"+append_id).value = 0;
		var price = parseFloat(document.getElementById("price"+append_id).value);
		var quantity = parseFloat(document.getElementById("qty"+append_id).value);
		var total = price*quantity;
		 new_tot = total - ((dis_per/100)*total);
		 document.getElementById("total"+append_id).value=parseFloat(new_tot).toFixed(2);
		

	}
	else{
		calculate_total(append_id);
	}
	}
	else if(event.target.id == "dis_val"+append_id){
		var dis_val = event.target.value;
		if(!isNaN(dis_val) && dis_val != 0){
		document.getElementById("dis_per"+append_id).value = '';
		var price = parseFloat(document.getElementById("price"+append_id).value);
		var quantity = parseFloat(document.getElementById("qty"+append_id).value);
		var total = price*quantity;
		 new_tot = total - dis_val;
		 document.getElementById("total"+append_id).value=parseFloat(new_tot).toFixed(2);
		
	}
	else{
		calculate_total(append_id);
	}
	}
	
	calculate_grand_total();
	
}
</script>
