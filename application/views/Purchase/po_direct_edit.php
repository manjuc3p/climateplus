<div class="card-body">

<?php foreach($records1 as $row) { ?>	
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/update_purchase_order_records" id="addform" autocomplete="off" enctype="multipart/form-data" >
	<div class="form-group row">
	      <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">PO Date<span style="color: red;"> * </span></label>
	      <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3">
	      <input type="text" name="date" id="date" class="form-control date_today bg-soft-gray" value="<?php echo date('d-m-Y',strtotime($row->po_date)); ?>" required readonly >
	      </div> 
	      <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">PO Code<span style="color: red;"> * </span></label>
	      <div class="col-xs-12 col-sm-2 col-md-32 col-lg-3">
	      <input type="text" name="code" id="code" class="form-control" value="<?php echo $row->po_code; ?>" readonly>
	      </div> 
	</div>
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier Name<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3">
	      <select name="supplier_id" id="supplier_id" class="form-control" disabled required>
	      <option value="">Please select name</option>
	      <?php foreach($supplier_records as $g) { ?>
		   <option <?php if($row->supplier_id== $g->supplier_id) echo 'selected';?> value="<?php echo $g->supplier_id;?>"><?php echo $g->supplier_code.' '.$g->supplier_name; ?> </option>
	      <?php } ?>
	      </select>
	      </div> 
     	      <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">Supplier Ref No</label>
    	      <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		      <input type="text" name="ref_no" id="ref_no" class="form-control form-control-sm"  tabindex='4' value="<?php echo $row->supplier_ref;?>">
	      </div>
	</div>
		
	<div class="form-group row">
     	        <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">Revision NO :<?php echo $row->revision; ?></label>
	    	 <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Revision date</label>
     		 <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
			<div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id="rev_date" name="rev_date" value="<?php echo date('d-m-Y',strtotime($row->revision_date)); ?>" required tabindex='2'>
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		      	</div>
	         </div>
	</div>
	<div class="form-group row">
		<table class="table table-bordered table-hover" id="tab_logic">
			<thead>
			<tr>
				<th title="Item">Item Details</th>      
				<th title="Item">Quantity</th>  
				<th title="Item">Price</th>   
				<th title="Item">
					Remark
					 <a id="add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a>
				</th>  
			</tr>
			</thead>
			<tbody id="mytbbody">
			<?php $i=5000; foreach($records2 as $r) { ?>
			<tr id="addr<?php echo $i;?>">
				<td>
					<select tabindex="11" class="form-select form-control-sm select2 select2Width" id="product_id<?php echo $i;?>" name="product_id[]" onchange="get_treding_product_info(<?php echo $i;?>)" required>
						<option value="">Select Item</option>
						<?php foreach($products as $s) {?>
						  <option <?php if($s->item_id==$r->product_id) echo 'selected';?> value="<?php echo $s->item_id;?>"><?php echo $s->item_code.' '.$s->item_name.' '.$s->part_code.' '.$s->make_model;?></option>
						<?php } ?>
					      </select>
					<br><textarea rows='3' cols='30'  name="desc[]" id="desc<?php echo $i;?>" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm" tabindex='5' ><?php echo $r->item_desc;?></textarea>
				</td>
				<td>
					<input type="number" name="trading_qty[]" id="trading_qty<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" value="<?php echo $r->quantity;?>" onkeyup="calculate_total('<?php echo $i;?>')" tabindex='8'>
				</td>
				<td>
					<input type="number" step='0.01' name="price[]" id="price<?php echo $i;?>" class="form-control form-control-sm"  onkeyup="calculate_total('<?php echo $i;?>')" value="<?php echo $r->price;?>" tabindex='9' required>
					Total
					<input type="number" name="total[]" id="total<?php echo $i;?>" value="<?php echo $r->total;?>" class="form-control bg-soft-gray form-control-sm subItemAmt" readonly required>
				</td>
				<td>
					<input type="text" name="item_remark[]" id="item_remark<?php echo $i;?>" tabindex='10' class="form-control form-control-sm" placeholder="remark" value="<?php echo $r->item_remark;?>">
					
					
					<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
					
					<a id='delete_row' title="Delete" onclick='remove_row("<?php echo $i;?>")' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
				</td>
			</tr>
			<?php  $i++; } ?>
			<tr id='addr1'></tr>
			</tbody>
		</table>    
 	</div> 	
	
	<hr>  
	<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-1 col-lg-1 col-form-label">SubTot</label>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		     	 <input type="text" id='sub_total' name='sub_total' readonly class="form-control form-control-sm bg-soft-gray" value="<?php echo $row->sub_total;?>" >
		    </div>

	     	     <label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 col-form-label">Dis.%:</label>
	    	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <input type="number" name="discount" id="discount" class="form-control form-control-sm"  onkeyup="calculate_grand_total()" value="<?php echo $row->discount_percent;?>" tabindex=11>
		      </div>
	    	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <input type="number" name="discount_amt" id="discount_amt" class="form-control form-control-sm bg-soft-gray"  onkeyup="calculate_grand_total()" readonly value="<?php echo $row->discount;?>" tabindex=12>
		     </div>
		    <label class="col-xs-12 col-sm-2 col-md-2  col-lg-2 col-form-label">Total before VAT</label>
		    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		       <input type="text" id='total_before_vat' name='total_before_vat' readonly class="form-control form-control-sm bg-soft-gray" value="<?php echo $row->sub_total-$row->discount;?>" >
		      </div>
		</div>
		<hr class='bg-primary'></hr>
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">VAT (<?php echo $row->vat_percent?>%) 
	    <input type='checkbox' id='vatbox' value='1' checked onclick='check_vat_option()' /></label>
		    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		      <input type="text" id='vat_amt' name='vat_amt' class="form-control form-control-sm bg-soft-gray" readonly value="<?php echo $row->vat_amt;?>" readonly>
	     		  <input type="hidden" id='vat_percent' name='vat_percent'  value="<?php echo $row->vat_percent;?>" >
	     		  <input type="hidden" id='vat_percent1' name='vat_percent1' value="<?php echo $row->vat_percent;?>" >
		      </div>
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label"> Currency Rate <span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		    	<select tabindex="13" class="form-select form-control-sm select2" id="currency_id" name="currency_id" onchange="get_currency_conversion()" style='width:175px'>
				<option value="">Select</option>
				<?php foreach($currency_list as $s) {?>
				  <option value="<?php echo $s->id.'@'.$s->rate.'@'.$s->currabrev; ?>"><?php echo $s->country.' '.$s->currabrev;?></option>
				<?php } ?>
		      </select>
	      		<input type="hidden" id='cid' name='cid' value="<?php echo $row->currency_id;?>">
	      		<input type="hidden" id='crate' name='crate' class="form-control form-control-sm bg-soft-gray" readonly value="<?php echo $row->currency_rate;?>">
		      </div>
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Grand Total <span id='currabrev'></span><span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
		      <input type="text" id='grand_total' name='grand_total' readonly class="form-control form-control-sm bg-soft-gray"  value="<?php echo $row->grand_total;?>" required>
		      </div>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Payment Term:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px'  cols='50' rows='3' name="term1" id="term1"  tabindex=3 class="form-control form-control-sm" ><?php echo $row->payment_term1;?></textarea>		     
		    </div>
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Delivery Terms:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px' cols='50' rows='3' name="term2" id="term2"  tabindex=4 class="form-control form-control-sm" ><?php echo $row->delivery_term;?></textarea>		     
		    </div>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Notes/Shipping Terms:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px' cols='50' rows='3' name="terms" id="terms"  tabindex=20 class="form-control form-control-sm" ><?php echo $row->shipping_term;?></textarea>		     
		    </div>
		</div>
		<div class="form-group row">
		     	<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Approved By:</label>
		    	<div class="col-xs-12 col-sm-9 col-md-3 col-lg-32">
			      <select tabindex="1" class="form-select form-control-sm select2" id="user_id" name="user_id" required >
				<option value="">Select</option>
				<?php foreach($user_records as $s) {?>
				  <option <?php if($row->approved_person==$s->user_id) echo 'selected'; ?> value="<?php echo $s->user_id ?>"><?php echo $s->user_name;?></option>
				<?php } ?>
			      </select>
		       </div>
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Select Stamp<span style="color: red;"> * </span></label>
		    	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <select tabindex="2" class="form-select form-control-sm" id="stamp" name="stamp" required>
				<option value="">Select</option>
		    		<?php foreach($stamp_details as $r){?>
				<option <?php if($r->img_id==$row->stamp_id) echo 'selected';?> value="<?php echo $r->img_id;?>"><?php echo $r->stamp_name;?></option>
			      <?php } ?>
			      </select>
		       </div>	
		</div>
		
		<div class="form-group row">
		<label class="col-sm-1"></label>
		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">
		<input type="hidden"  name="po_id" value="<?php echo $row->po_id;?>" >
		<input type="hidden"  name="revision" value="<?php echo $row->revision;?>" >
			<input type='checkbox' name="create_revision" id="create_revision" value='1' />Create New Revision
		</label>
		<?php if($edit_flag==1){?>
		<div class="col-sm-8">
		<button type="submit"  tabindex="31"  id="add" class="btn btn-primary m-b-0">Update PO</button>
			<button type="reset"  id='reset' class="btn btn-primary m-b-0">Reset</button>
			<button class="btn btn-primary m-b-0" onclick="goBack()">Back</button>
		</div>
		<?php } ?>
		</div>
<?php } ?>
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
	     $('#addr'+i).html("<td><select tabindex='11' class='form-select form-control-sm select2' id='product_id"+i+"' name='product_id[]' onchange='get_treding_product_info("+i+")' style='width:350px;' required><option value=''>Select Code</option><?php foreach($products as $s) {?><option value='<?php echo $s->item_id; ?>'><?php echo $s->item_code.' '.$s->item_name.' '.$s->part_code.' '.$s->make_model;?></option><?php } ?></select><textarea rows='4' cols='20' name='desc[]' id='desc"+i+"' style='font-size:11px; font-weight:bold;'  class='form-control form-control-sm' tabindex='13' placeholder='Description'></textarea></td><td><input type='number' name='trading_qty[]' id='trading_qty"+i+"' tabindex='14' class='form-control form-control-sm' placeholder='' onchange='calculate_total("+i+")'></td><td><input type='number' name='price[]' id='price"+i+"' tabindex='14' class='form-control form-control-sm' placeholder='' onchange='calculate_total("+i+")' ><br><input type='number' name='total[]' id='total"+i+"' tabindex='14' class='form-control form-control-sm subItemAmt' placeholder='' ></td><td><textarea name='item_remark[]' id='item_remark"+i+"' tabindex='16' class='form-control form-control-sm' placeholder='remark' ></textarea><a id='delete_row' title='Delete' onclick='remove_row("+i+")' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
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
	var quantity = parseFloat(document.getElementById("trading_qty"+append_id).value);
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
   	
	//var miscellaneous_amt1= parseFloat(document.getElementById("miscellaneous_amt1").value);
	//var miscellaneous_amt2= parseFloat(document.getElementById("miscellaneous_amt2").value);
	//var miscellaneous_amt3=0;
   	//var grand_total = parseFloat(calVatAmt+total_before_vat+miscellaneous_amt1+miscellaneous_amt2+miscellaneous_amt3);
	grand_total = parseFloat(calVatAmt+total_before_vat);
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

function get_treding_product_info(append_id)
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
