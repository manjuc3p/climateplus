<?php $this->load->helper('stock_helper.php'); ?>
<style type="text/css">

.select2Width {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 320px !important;
  min-width: 320px !important;
}

</style>

<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_new_enquiry" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Enquiry Date <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date datepicker1">			                  
		    			<input type="text" class="form-control form-control-sm datepicker1" id="enq_date" name="enq_date" value="<?php echo date('d-m-Y')?>" required tabindex=1>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>
	  		
		</div>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Customer<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	    		<select tabindex="3" class="form-select form-control-sm select2" id="customer_id" name="customer_id" required  >
				<option value="">Select</option>	      		
				<?php foreach($cust_records as $s) {?>
				  <option value="<?php echo $s->customer_id ?>"><?php echo $s->cust_code.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
	  		</div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Enquiry Type <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	    			<select tabindex="4" class="form-select form-control-sm " id="enquiry_type" name="enquiry_type" required onchange="get_div_active();">
					<option value="">Select</option>
					
					<option value="1">Trading </option>
					<option value="2">Manufacturing </option>
					<option value="3">Machine Sales</option>
			      </select>
	  		</div>
		</div>
		<div id='cust_div' style="display:none;">
		<div class="form-group row" >	
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Customer Name<span style="color: red;"> * </span>:</label>
		    <div class="col-xs-12 col-sm-10 col-md-3 col-lg-3">
			     <input type='text' tabindex="5" class="form-control form-control-sm" id="customer_name" name="customer_name" placeholder="" />
		    </div> 	
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label"> Email</label>
		    <div class="col-xs-12 col-sm-10 col-md-3 col-lg-3">
			     <input type='text' tabindex="6" class="form-control form-control-sm" id="cust_email" name="cust_email"  placeholder="" />
		    </div> 	
		    <label class="col-xs-12 col-sm-3 col-md-1 col-lg-1 col-form-label"></label>
		    <div class="col-xs-12 col-sm-10 col-md-2 col-lg-2">
			     <input type='hidden' tabindex="7" class="form-control form-control-sm" id="cust_mobile" name="cust_mobile"  placeholder="" />
		    </div> 	
		</div>	
		</div>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Client Ref No  </label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" >			                  
	    			<input type="text" class="form-control form-control-sm" id="client_ref" name="client_ref"  tabindex=8>
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Remark/Comments </label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	    			<input type='text' tabindex="9" class="form-control form-control-sm" id="remark" name="remark" placeholder="" />	
	  		</div>
		</div>
		<div id='enq_form'>
		</div>
		
		
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Upload Document(PDF/PNG/JPEG) </label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	    			<input type='file' tabindex="501" class="form-control form-control-sm" id="other_file" name="other_file" placeholder="" />	
	  		</div>
		     	<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Sales Person:</label>
		    	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-3">
			      <select tabindex="1" class="form-select form-control-sm select2" id="user_id" name="user_id" required style='width:155px'>
				<option value="">Select</option>
				<?php foreach($user_records as $s) {?>
				  <option <?php if($this->session->userdata('user_id')==$s->user_id) echo 'selected'; ?> value="<?php echo $s->user_id ?>"><?php echo $s->user_name;?></option>
				<?php } ?>
			      </select>
		       </div>
		</div>  
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<button type="submit"  tabindex="502"  id="add" class="btn btn-primary m-b-0">Submit</button>
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
	$(document).on('click', '#add_row1', function() {		
		
		$('#addr'+i).html("<td><input type='text' name='srn[]' id='srn"+i+"' tabindex='10' class='form-control form-control-sm' value='"+(i+1)+"'></td><td><select tabindex='11' class='form-select form-control-sm select2' id='product_id"+i+"' name='product_id[]' onchange='get_trading_product_info("+i+")' style='width:400px;'><option value=''>Select </option><?php foreach($products1 as $s) {?><option value='<?php echo $s->product_id; ?>'><?php echo $s->product_description;?></option><?php } ?></select></td><td><input type='number' name='trading_qty[]' id='trading_qty"+i+"' tabindex='14' class='form-control form-control-sm' placeholder='' ></td><td><a id='delete_row' title='Delete' onclick='remove_row("+i+")' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytbbody tr:last').after('<tr id="addr'+(i+1)+'"></tr>');
	      i++; 	     	
	    $('.select2').select2();
	});

	$(document).on('click', '#add_row3', function() {		
		
		$('#addr'+i).html("<td><input type='text' name='srn[]' id='srn"+i+"' tabindex='10' class='form-control form-control-sm' value='"+(i+1)+"'></td><td><select tabindex='11' class='form-select form-control-sm select2' id='product_id"+i+"' name='product_id[]' onchange='get_trading_product_info("+i+")' style='width:400px;'><option value=''>Select </option><?php foreach($products3 as $s) {?><option value='<?php echo $s->product_id; ?>'><?php echo $s->product_description;?></option><?php } ?></select></td><td><input type='number' name='trading_qty[]' id='trading_qty"+i+"' tabindex='14' class='form-control form-control-sm' placeholder='' ></td><td><a id='delete_row' title='Delete' onclick='remove_row("+i+")' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytbbody tr:last').after('<tr id="addr'+(i+1)+'"></tr>');
	      i++; 	     	
	    $('.select2').select2();
	});

	$(document).on('click', '#add_row2', function() {		
		
		$('#addr'+i).html("<td><select tabindex='11' class='form-select form-control-sm select2' id='product_id"+i+"' name='product_id[]' onchange='get_trading_product_info("+i+")' style='width:400px;'><option value=''>Select </option><?php foreach($products2 as $s) {?><option value='<?php echo $s->product_id; ?>'><?php echo $s->product_id;?></option><?php } ?></select></td><td><input type='text' name='desc[]' id='desc"+i+"' tabindex='16' class='form-control form-control-sm' readonly='true'></td><td><input type='number' name='manf_length[]' id='manf_length"+i+"' tabindex='14' class='form-control form-control-sm' placeholder='' ></td><td><input type='number' name='manf_height[]' id='manf_height"+i+"' tabindex='15' class='form-control form-control-sm' placeholder='' ></td><td><input type='text' name='manf_color[]' id='manf_color"+i+"' tabindex='16' class='form-control form-control-sm' placeholder=''></td><td><input type='number' name='manf_qty[]' id='manf_qty"+i+"' tabindex='17' class='form-control form-control-sm' placeholder='' ></td><td><a id='delete_row' title='Delet' onclick='remove_row(0)' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytbbody tr:last').after('<tr id="addr'+(i+1)+'"></tr>');
	      i++; 	     	
	    $('.select2').select2();
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
   function remove_product_div(append_id)
   {    	 
        $('#product_div'+append_id).remove();
   }
   function remove_subrow(div_id,append_id)
   {    	
   	var x= div_id+'_ptr'+append_id;
        $('#'+x).remove();
   }
  function add_nxt_row(div_id, append_id)
  {
  	const myArray = div_id.split("d");
  	var one= myArray[0];
  	var two= myArray[1];
	var pcode= parseFloat($('#row_id_'+div_id).val());
  	var k = parseFloat(pcode+1);
  	var m = parseFloat(k+1);
  	var tmp =div_id+'_ptr'+k;
  	var tmp2 ='mybody_'+div_id;
  	var tmp3 =div_id+'_ptr'+m;
  	 $('#'+tmp).html("<td><textarea name='sub_details"+two+"[]' id='sub_details"+div_id+k+"' class='form-control form-control-sm' ></textarea></td><td><input type='hidden' name='qty"+two+"[]' id='qty"+div_id+k+"' tabindex='10' class='form-control form-control-sm' value='1'></td><td><a title='Delete' onclick=remove_subrow('"+div_id+"','"+k+"') class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	  $('#'+tmp).after("<tr id='"+tmp3+"'></tr>");
	  $('#row_id_'+div_id).val(k);
  }

  function get_div_active()
{
	var enq_type=$("#enquiry_type").val();
	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Ajax/get_enquiry_form",
        data: {enq_type:enq_type} ,
        success: function(msg){	       	
		document.getElementById('enq_form').innerHTML=msg;
		$('.select2').select2();
	     }
	});
	
}
function get_customer_info() 
 {
   	var customer_id = document.getElementById("customer_id").value;
	if(customer_id=='new')
	{		
		document.getElementById("cust_div").style.display = "block";
		document.getElementById("customer_name").required = true;
	}
	else
	{
		document.getElementById("customer_name").required = false;
		document.getElementById("cust_div").style.display = "none";
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
function get_trading_product_info(append_id)
{
	
	var product_id= document.getElementById("product_id"+append_id).value;
	var enq_type = document.getElementById("enquiry_type").value;

	if(product_id!='' && (enq_type == '1' || enq_type == '3') )
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
	else if(product_id!='' && enq_type == '2')
	{
		$.ajax
		({
			url: "<?php echo site_url('Product/ajax_get_manf_product_details'); ?>",
			type: 'POST',
			data: {product_id: product_id },
			dataType: "json",
			success: function(msg) {
					document.getElementById("desc"+append_id).value=msg.item_desc;
					document.getElementById("manf_length"+append_id).value=msg.length;
					document.getElementById("manf_height"+append_id).value=msg.height;
					document.getElementById("manf_color"+append_id).value=msg.colour;
					
			}
		});
	}
	else
	{
		document.getElementById("desc"+append_id).value='';
	}
}
 
function get_enquiry_info()
{
	var enq_id=$("#enq_id").val();
	var rev_version=1;	
	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Ajax/get_enquiry_items_for_enq",
        data: {enq_id:enq_id, rev_version:1} ,
        success: function(msg){	       	
		document.getElementById('mytbbody').innerHTML=msg;
	     }
	});
}



function populateProductOptions() {
	var enq_type=$("#enquiry_type").val();
  	var productDropdown = document.getElementById("prd_type");
  var selectedOption = mainDropdown.value;

  // Clear existing options
  secondaryDropdown.innerHTML = "";
  $.ajax
	({
		url: "<?php echo site_url('Ajax/ajax_get_subcategory'); ?>",
		type: 'POST',
		data: {cat:selectedOption},
		success: function(msg) {
			var options = JSON.parse(msg);
			$("#prd_type").append('<option value="">Select</option>');
			for (var obj of options) {
				$("#prd_type").append('<option value="' + obj.category_id + '">' + obj.category_name + '</option>');
			}
		// 	msg.forEach(function(obj) {
    	// console.log("Name: " + obj.category_id );
		// 	});
				
		}
	});
  
  }
</script>
