<div class="card-body">
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/add_purchase_order_records" autocomplete="off" enctype="multipart/form-data">
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
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Supplier<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<select name="supplier_id" id="supplier_id" class="form-control select2" required tabindex='2'>
				      <option value="">Please select name</option>
				      <?php foreach($supplier_records as $g) { ?>
					   <option value="<?php echo $g->supplier_id;?>" ><?php echo $g->supplier_code.' '.$g->supplier_name; ?> </option>
				      <?php } ?>
			      </select>
    	     		 </div>
		</div>
		
		
		<div id="item_list_id"> 
		</div>
		
		<div class="form-group row">
		     	<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Select Terms:</label>
		    	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <select  class="form-select form-control-sm select2" id="term_id" name="term_id" required onchange="get_term_info()" >
				<option value="">Select</option>
				<?php foreach($terms_rec as $s) {?>
				  <option value="<?php echo $s->tid ?>"><?php echo $s->term_name;?></option>
				<?php } ?>
			      </select>
		       </div>
		     	<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Approved By:</label>
		    	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <select tabindex="1" class="form-select form-control-sm select2" id="user_id" name="user_id" required >
				<option value="">Select</option>
				<?php foreach($user_records as $s) {?>
				  <option <?php if($this->session->userdata('user_id')==$s->user_id) echo 'selected'; ?> value="<?php echo $s->user_id ?>"><?php echo $s->user_name;?></option>
				<?php } ?>
			      </select>
		       </div>
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Select Stamp<span style="color: red;"> * </span></label>
		    	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		    	<?php foreach($stamp_details as $r){?>
			      <select tabindex="2" class="form-select form-control-sm" id="stamp" name="stamp" required>
				<option value="">Select</option>
				<option value="<?php echo $r->img_id;?>"><?php echo $r->stamp_name;?></option>
			      </select>
			      <?php } ?>
		       </div>	
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Payment Term:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px'  cols='50' rows='3' name="term1" id="term1"  tabindex=3 class="form-control form-control-sm" ></textarea>		     
		    </div>
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Delivery Terms:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px' cols='50' rows='3' name="term2" id="term2"  tabindex=4 class="form-control form-control-sm" ></textarea>		     
		    </div>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Notes/Shipping Terms:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px' cols='50' rows='3' name="terms" id="terms"  tabindex=20 class="form-control form-control-sm" ></textarea>		     
		    </div>
		</div>
		
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
				<input type="hidden"  name="po_type" value="from quotation">
				<input type="hidden"  name="certificate_details" value="">
			<button type="submit"  tabindex="6"  id="add" class="btn btn-primary m-b-0">Generate PO</button>
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
	     $('#addr'+i).html("<td><input type='text' name='srn[]' id='srn"+i+"' tabindex='18' class='form-control form-control-sm' placeholder='' ><br>Valve Serial No<input type='text' name='valve_serial_no[]' id='valve_serial_no"+i+"' class='form-control form-control-sm' tabindex='9'></td><td><select tabindex='19' class='form-select form-control-sm select2 select2Width' id='product_id"+i+"' name='product_id[]' onchange='get_product_info("+i+")' ><option value=''>Select Code</option><?php foreach($products as $s) {$size= str_replace('"', ' Inch' ,$s->size);?> <option value='<?php echo $s->product_id; ?>'><?php echo $s->pcode.' '.$size;?></option><?php } ?></select><input type='text'  name='order_code[]' id='order_code"+i+"' tabindex='20' class='form-control form-control-sm select2Width' placeholder='Enter Customized Code Here'  onkeyup='get_product_description("+i+");'><input type='hidden' name='pcode[]' id='pcode"+i+"' class='form-control form-control-sm'><textarea rows='6' cols='26' name='desc[]' id='desc"+i+"' class='form-control form-control-sm select2Width' style='font-size:11px; font-weight:bold;' tabindex='21'></textarea></td><td>Size<input type='text' name='size[]' id='size"+i+"' tabindex='15' class='form-control form-control-sm' placeholder='' value=''><br>Quantity<input type='number' name='qty[]' id='qty"+i+"'  class='form-control form-control-sm' value='0' ></td><td><input type='number' step='0.01' name='price[]' id='price"+i+"' class='form-control form-control-sm'  onchange='calculate_total("+i+")' value=0 tabindex='9' required><br><br><br>Total<input type='number' name='total[]' id='total"+i+"' value=0  class='form-control bg-soft-gray form-control-sm subItemAmt' readonly required><br><br></td><td><textarea name='item_remark[]' id='item_remark"+i+"' placeholder='remark' tabindex='24' class='form-control form-control-sm' ></textarea><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
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
function get_quotation_info()
{
	var qid = document.getElementById("qid").value;	
   	if(qid!='')
   	{
	   	$.ajax({
	   	async:"false",
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_quotation_for_po",
		data: {qid:qid} ,
		success: function(msg){
			document.getElementById('item_list_id').innerHTML=msg;
		     }
		});
	}
}

function get_inv_code()
{
	var type = document.getElementById("inv_type").value;
	$.ajax({
		type: "POST",
		url:"<?php echo base_url()?>index.php/Sales/get_invoice_code",
		data: {type:type} ,
		success: function(msg){	  
			document.getElementById("invcode").value=msg;
		     }
	});
}
function get_petrostar_code()
{
	var type = document.getElementById("ref_prefix").value;
	$.ajax({
		type: "POST",
		url:"<?php echo base_url()?>index.php/Sales/get_petrostar_code",
		data: {type:type} ,
		success: function(msg){	  
			document.getElementById("ref_no").value=msg;
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
	
	//var crate= document.getElementById('crate').value;
	var crate=1;
	var grand_total = parseFloat(grand_total*crate);
	document.getElementById("grand_total").value= parseFloat(grand_total).toFixed(2);
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
	//calculate_grand_total();
}

function get_term_info()
{
	var term_id= document.getElementById("term_id").value;
	if(term_id!='')
	{
		$.ajax
		({
			url: "<?php echo site_url('Ajax/ajax_get_term_details'); ?>",
			type: 'POST',
			data: {term_id: term_id },
			dataType: "json",
			success: function(msg) {
					document.getElementById("term1").value=msg.payment_term;
					document.getElementById("term2").value=msg.delivery_term;
					document.getElementById("terms").value=msg.notes;
					//document.getElementById("certificate_details").value=msg.certificate;
					//document.getElementById("manufacture").value=msg.manufacture;
					//document.getElementById("origin").value=msg.origin;
			}
		});
	}
	else
	{
		document.getElementById("term1").value='';
		document.getElementById("term2").value='';
		document.getElementById("terms").value='';
		//document.getElementById("certificate_details").value='';
		//document.getElementById("manufacture").value='';
		//document.getElementById("origin").value='';
	}
}

function check_vat_option()
{
	var checkBox = document.getElementById("vatbox");
	var vat_percent="<?php echo $vat_percent?>";
	// If the checkbox is checked, display the output text
	if (checkBox.checked == true){
		$("#vat_percent").val(vat_percent);	
		calculate_grand_total();
	 	
	} else {
	 
		$("#vat_percent").val(0);
	 	document.getElementById("vat_amt").value=0.00;	
		calculate_grand_total();
	}
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
</script>
