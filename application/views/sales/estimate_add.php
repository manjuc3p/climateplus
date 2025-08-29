<div class="card-body">
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_estimation_data" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Select Enquiry <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-6 col-lg-4" role='group'>
				<select tabindex="1" class="form-select form-control-sm select2" id="enq_id" name="enq_id" required onchange="get_enquiry_info()" >
				<option value="">Select</option>
				<?php foreach($enq_records as $s) {?>
				  <option value="<?php echo $s->enquiry_id ?>"><?php echo $s->enquiry_code.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
    	     		 </div>
    	     		
		</div>
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Quotation date</label>
		    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date datepicker1">			                  
		    			<input type="text" class="form-control form-control-sm datepicker1" id="qdate" name="qdate" value="<?php echo date('d-m-Y')?>" required tabindex='2'>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
     		     </div>

	     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">Estimate Code:</label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			      <input type="text" name="qcode" id="qcode" class="form-control form-control-sm bg-soft-gray"  tabindex='3' value="<?php echo $code; ?>">
		     </div>
		</div>
		<div class="form-group row" >
	    	<div class="col-md-12">
			<div class="dt-responsive">
			<table class='bg-soft-success' width='100%' cellspacing="0" colspacing="0" border='1' style="font-size:12px;font-weight:bold;">
				<tr>
					<th  style="background-color:#cccccc!important;">Enquiry Code</th>
					<th  style="background-color:#cccccc!important;">Enquiry Date</th>
					<th  style="background-color:#cccccc!important;">Customer</th>
					<th  style="background-color:#cccccc!important;">Client Ref</th>
				</tr>
				<tr>
					<th><label id='enq_code'></label></th>
					<th><input type="text" id='enq_date' class="form-control text-black" value="" readonly="TRUE"></th>					
					<th  id='cust_name'> </th>
					<th ><input type="text" id='client_ref' name='client_ref' class="form-control text-black"></th>
				</tr>
				
				<input type="hidden" id='customer_id' name='customer_id' class="form-control" value="" readonly="TRUE">
				<input type="hidden" id='enquiry_code' name='enquiry_code' > 
				<input type="hidden" id='enquiry_revision' name='enquiry_revision' > 
			</table>
			</div>
	   	</div>
		</div>
		<!-- <a id="add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a>
		<a id="add_row1" title="Add" class="btn btn-sm bg-orange" >Add Main Heading<span class="fa fa-plus"></span></a> -->
		<div id="item_list_id">
		</div>
		
		<div id='product_div1'>
	
		</div>
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-1 col-lg-1 col-form-label">SubTot</label>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		     	 <input type="text" id='sub_total' name='sub_total' readonly class="form-control form-control-sm" value="0" tabindex=12>
		    </div>

	     	    <label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 col-form-label">Margin %:</label>
	    	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <input type="number" name="margin" id="margin" class="form-control form-control-sm"  onkeyup="calculate_grand_total()" value=0 tabindex=13>
		      </div>
	    	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <input type="number" step="0.01" name="margin_amt" id="margin_amt" class="form-control form-control-sm"  onkeyup="calculate_grand_total()" value='0' tabindex=13>
		     </div>
		    <label class="col-xs-12 col-sm-2 col-md-2  col-lg-2 col-form-label">Total before VAT</label>
		    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		       <input type="text" id='total_before_vat' name='total_before_vat' readonly class="form-control form-control-sm" value="0" >
		      </div>
		</div>
		<hr class='bg-primary'></hr>
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">VAT (<?php echo $vat_percent?>%) 
		    <input type='checkbox' id='vatbox' value='1' checked onclick='check_vat_option()' /></label>
		    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		      <input type="text" id='vat_amt' name='vat_amt' class="form-control form-control-sm" readonly="TRUE" value="0" readonly>
		      <input type="hidden" id='vat_percent' name='vat_percent' class="form-control" value="<?php echo $vat_percent;?>" >
	            </div>
		   
		</div>
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Currency<span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		      		<select tabindex="14" class="form-select form-control-sm select2" id="currency_id" name="currency_id" required onchange="get_currency_conversion()" style='width:160px'>
					<option value="">Select</option>
					<?php foreach($currency_list as $s) {?>
					  <option value="<?php echo $s->id.'@'.$s->rate.'@'.$s->currabrev; ?>"><?php echo $s->country.' '.$s->currabrev;?></option>
					<?php } ?>
			      </select>
		      		<input type="hidden" id='cid' name='cid' >
		      		<input type="hidden" id='crate' name='crate' value='0'>
		      </div>
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Grand Total <span id='currabrev'></span><span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		      <input type="text" id='grand_total' name='grand_total' readonly class="form-control form-control-sm"  value="0" required>
		      </div>
		</div>
		
		<hr>
		<div class="form-group row">
		     	<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Validity:</label>
		    	<div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
		    		<input type="text" list="validity"  name="validity" value="15 days from quotation date" style='width:720px;'/>
				
		       </div>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Payment Term:</label>
		    <div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
		    		<input type="text" list="term1"  name="term1" value="100% Advance" style='width:720px;'/>
				          
		    </div>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Delivery Terms:</label>
		    <div class="col-xs-12 col-sm-9 col-md-8 col-lg-8">
		    		<input type="text" list="term2"  name="term2" value="To Site" style='width:720px;'/>
				   
		    </div>
		</div>
		
		<div class="col-sm-10">
		<button type="submit"  tabindex="22"  id="add" class="btn btn-primary m-b-0">Create Estimate</button>
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
	$(document).on('click', '#add_row', function() {
        
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
   function remove_product_div(append_id)
   {    	 
        $('#product_div'+append_id).remove();
        calculate_grand_total();
   }
   function remove_subrow(div_id,append_id)
   {    	
   	var x= div_id+'_ptr'+append_id;
        $('#'+x).remove();
        calculate_grand_total();
   }
  function add_nxt_row(div_id, append_id)
  {
  	const myArray = div_id.split("d");
  	var one= myArray[0];
  	var two= myArray[1];
	var pcode= parseFloat($('#row_id_'+div_id).val());
  	var k = parseFloat(pcode);
  	var m = parseFloat(k+1);
  	var tmp =div_id+'_ptr'+k;
  	var tmp2 ='mybody_'+div_id;
  	var tmp3 =div_id+'_ptr'+m;
  
  	 $('#'+tmp).html("<td><textarea name='sub_details"+two+"[]' id='sub_details"+div_id+k+"' class='form-control form-control-sm' ></textarea><input type='hidden' name='qty"+two+"[]' id='qty"+div_id+k+"' tabindex='10' class='form-control form-control-sm' value='1'></td><td  align='center'><a title='Delete' onclick=remove_subrow('"+div_id+"','"+k+"') class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	  $('#'+tmp).after("<tr id='"+tmp3+"'></tr>");
	  $('#row_id_'+div_id).val(m);
  }
function get_enquiry_info() 
 {
   	var enq_id = document.getElementById("enq_id").value;	
   	if(enq_id!='')
   	{
	   	$.ajax({
	   	async:"false",
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_enquiry_info",
		data: {enq_id:enq_id} ,
		dataType: "json",
		success: function(msg){
			var url1= 'index.php/Sales/edit_enquiry/'+msg.enq_id+'/1';
			var x = '<u><a target="blank" href="<?php echo base_url()?>' + url1 + '">'+msg.enquiry_code+'</a></u>';
			document.getElementById("enq_code").innerHTML=x;
			document.getElementById("enquiry_code").value=msg.enquiry_code;
			document.getElementById("enq_date").value=msg.enquiry_date;
			document.getElementById("customer_id").value=msg.customer_id;
			document.getElementById("cust_name").innerHTML=msg.cust_code+' '+msg.cust_name;
			document.getElementById("client_ref").value=msg.client_ref;
			document.getElementById("enquiry_revision").value=msg.revision;
			
			get_enquiry_items_list();
		     }
		});
	}
	else
	{
		document.getElementById("enq_code").innerHTML='';
		document.getElementById("enq_date").value='';
		document.getElementById("customer_id").value='';
		document.getElementById("cust_name").value='';
		document.getElementById("delivery_date").value='';
			
		document.getElementById('item_list_id').innerHTML='';
	}
 } 
 
function get_enquiry_items_list()
{
	var enq_id=$("#enq_id").val();
	var customer_id=$("#customer_id").val();
	var rev_version=$("#enquiry_revision").val();	
	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Ajax/get_enquiry_items_for_estimate",
        data: {enq_id:enq_id, rev_version:rev_version} ,
        success: function(msg){	       	
		document.getElementById('item_list_id').innerHTML=msg;
		calculate_grand_total();
	     }
	});
	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Ajax/get_customer_address",
        data: {customer_id:customer_id} ,
        success: function(msg){	       	
		document.getElementById('cust_address').innerHTML=msg;
	     }
	});
}


function calculate_total(append_id)
{
	var price = parseFloat(document.getElementById("price"+append_id).value);
	var quantity = parseFloat(document.getElementById("qty"+append_id).value);
	var total = price*quantity;
	document.getElementById("total"+append_id).value=parseFloat(total).toFixed(2);

	calculate_grand_total();
}

function calculate_margin(event,append_id){
	var total=0;
	var new_tot=0;
	if(event.target.id == "mar_per"+append_id){
		var mar_per = event.target.value;
		if( !isNaN(mar_per) && mar_per > 0 ){
		document.getElementById("mar_val"+append_id).value = 0;
		var price = parseFloat(document.getElementById("price"+append_id).value);
		var quantity = parseFloat(document.getElementById("qty"+append_id).value);
		var total = price*quantity;
		 new_tot = total + ((mar_per/100)*total);
		 document.getElementById("total"+append_id).value=parseFloat(new_tot).toFixed(2);
		

	}
	else{
		calculate_total(append_id);
	}
	}
	else if(event.target.id == "mar_val"+append_id){
		var mar_val = event.target.value;
		if(!isNaN(mar_val) && mar_val != 0){
		document.getElementById("mar_per"+append_id).value = '';
		var price = parseFloat(document.getElementById("price"+append_id).value);
		var quantity = parseFloat(document.getElementById("qty"+append_id).value);
		var total = price*quantity;
		 new_tot = parseFloat(total) + parseFloat(mar_val);
		 document.getElementById("total"+append_id).value=parseFloat(new_tot).toFixed(2);
		
	}
	else{
		calculate_total(append_id);
	}
	}
	
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

	 if(document.getElementById("margin").value==0)
	 	var margin=0;
	 else
	 {
	 	var margin_per = parseFloat(document.getElementById("margin").value/100);
	 	var margin= i_total*margin_per;
	 	document.getElementById("margin_amt").value= parseFloat(margin).toFixed(2);
	 }
	 var margin= document.getElementById("margin_amt").value;
	 var total_before_vat = parseFloat(i_total)+parseFloat(margin);
	
	document.getElementById("total_before_vat").value= parseFloat(total_before_vat).toFixed(2);


	var vat_percent= document.getElementById("vat_percent").value;
	var vat_per= parseFloat(vat_percent/100);
   	var calVatAmt = parseFloat(total_before_vat*vat_per);
	document.getElementById("vat_amt").value= parseFloat(calVatAmt).toFixed(2);
   	var grand_total = parseFloat(calVatAmt+total_before_vat);
	
	var crate=1;
	var grand_total = parseFloat(grand_total*crate);
	document.getElementById("grand_total").value= parseFloat(grand_total).toFixed(2);
}

function check_vat_option()
{
	var checkBox = document.getElementById("vatbox");
	var vat_percent="<?php echo $vat_percent?>";
	if (checkBox.checked == true){
		$("#vat_percent").val(vat_percent);		
		calculate_grand_total();
	 	
	} else {
	 
		$("#vat_percent").val(0);
	 	document.getElementById("vat_amt").value=0.00;
		calculate_grand_total();
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

function get_trading_product_info(append_id)
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
				document.getElementById("desc"+append_id).value=msg.item_desc;
		}
	});
	}
	else
	{
		document.getElementById("desc"+append_id).value='';
	}
}
</script>
