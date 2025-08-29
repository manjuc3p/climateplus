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
			    	<th title="Item">Sr / Valve No </th> 
				<th title="Item">Order code</th>      
				<th title="Item">Size/Quantity</th>  
				<th title="Item">Price</th>   
				<th title="Item">Remark</th>   
		    	        <th width='10%'>
		    	        <a id="add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a></th>
			</tr>
			</thead>
			<tbody id="mytbbody">
			<?php $i=5000; foreach($records2 as $r) { ?>
			<tr id="addr<?php echo $i;?>">
				<td>						
					<input type="text" name="srn[]" id="srn<?php echo $i;?>" tabindex='3' class="form-control form-control-sm" placeholder="" value="<?php echo $r->srn;?>"><br>
					Valve SR No
					<input type="text" name="valve_serial_no[]" id="valve_srn<?php echo $i;?>" class="form-control form-control-sm" tabindex='7'  value="<?php echo $r->valve_srn;?>">
				</td>
				<td>
					<input type="text"  name="order_code[]" id="order_code<?php echo $i;?>" class="form-control  form-control-sm" placeholder="Enter Order Code Here"  tabindex='4' value="<?php echo $r->order_code;?>">
					<br><textarea rows='7' cols='30'  name="desc[]" id="desc<?php echo $i;?>" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm" tabindex='5' required><?php echo $r->item_desc;?></textarea>
				</td>
				<td>	Size
					<input type="text" name="size[]" id="size<?php echo $i;?>" tabindex='6' class="form-control form-control-sm" placeholder="" value="<?php echo $r->size;?>"><br>
					Quantity
					<input type="number" name="qty[]" id="qty<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" value="<?php echo $r->quantity;?>" onkeyup="calculate_total('<?php echo $i;?>')" tabindex='8'>
					Allocate qty
					<input type="number" name="allocate[]" id="allocate<?php echo $i;?>"  class="form-control form-control-sm" value="<?php echo $r->allocation;?>" >
				</td>
				<td>
					<input type="number" step='0.01' name="price[]" id="price<?php echo $i;?>" class="form-control form-control-sm"  onkeyup="calculate_total('<?php echo $i;?>')" value="<?php echo $r->price;?>" tabindex='9' required><br><br>
				<br>
					Total
					<input type="number" name="total[]" id="total<?php echo $i;?>" value="<?php echo $r->total;?>" class="form-control bg-soft-gray form-control-sm subItemAmt" readonly required><br><br>
				</td>
				<td>
					<input type="text" name="item_remark[]" id="item_remark<?php echo $i;?>" tabindex='10' class="form-control form-control-sm" placeholder="remark" value="<?php echo $r->item_remark;?>">
					
					
					<input type="hidden"  name="product_id[]" value="<?php echo $r->product_id;?>" >
					<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
				</td>
				<td>
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
		    	<?php foreach($stamp_details as $r){?>
			      <select tabindex="2" class="form-select form-control-sm" id="stamp" name="stamp" required>
				<option value="">Select</option>
				<option <?php if($r->img_id==$row->stamp_id) echo 'selected';?> value="<?php echo $r->img_id;?>"><?php echo $r->stamp_name;?></option>
			      </select>
			      <?php } ?>
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
				<input type="hidden"  name="ptype" value="<?php echo $ptype;?>">
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
	     $('#addr'+i).html("<td><input type='text' name='srn_nw[]' id='srn"+i+"' tabindex='18' class='form-control form-control-sm' placeholder='' ><br>Valve SR No<input type='text' name='valve_serial_no_nw[]' id='valve_serial_no"+i+"' class='form-control form-control-sm' tabindex='7'></td><td><select tabindex='19' class='form-select form-control-sm select2 select2Width' id='product_id"+i+"' name='product_id_nw[]' onchange='get_product_info("+i+")' ><option value=''>Select Code</option><?php foreach($products as $s) {$size= str_replace('"', ' Inch' ,$s->size);?> <option value='<?php echo $s->product_id; ?>'><?php echo $s->pcode.' '.$size;?></option><?php } ?></select><input type='text'  name='order_code_nw[]' id='order_code"+i+"' tabindex='20' class='form-control form-control-sm select2Width' placeholder='Enter Customized Code Here'  onkeyup='get_product_description("+i+");'><input type='hidden' name='pcode_nw[]' id='pcode"+i+"' class='form-control form-control-sm'><textarea rows='6' cols='26' name='desc_nw[]' id='desc"+i+"' class='form-control form-control-sm select2Width' style='font-size:11px; font-weight:bold;' tabindex='21'></textarea></td><td>Size<input type='text' name='size_nw[]' id='size"+i+"' tabindex='15' class='form-control form-control-sm' placeholder='' value=''><br>Quantity<input type='number' name='qty_nw[]' id='qty"+i+"'  class='form-control form-control-sm' value='0' >Allocate qty<input type='number' name='allocate[]' id='allocate"+i+"'  class='form-control form-control-sm' value='0' ></td><td><input type='number' step='0.01' name='price_nw[]' id='price"+i+"' class='form-control form-control-sm'  onchange='calculate_total("+i+")' value=0 tabindex='9' required><br><br><br>Total<input type='number' name='total_nw[]' id='total"+i+"' value=0  class='form-control bg-soft-gray form-control-sm subItemAmt' readonly required><br><br></td><td><textarea name='item_remark_nw[]' id='item_remark"+i+"' placeholder='remark' tabindex='24' class='form-control form-control-sm' ></textarea><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
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
function check_vat_option()
{
	var checkBox = document.getElementById("vatbox");	
	var vat_percent=document.getElementById("vat_percent1").value;
	
	// If the checkbox is checked, display the output text
	if (checkBox.checked == true){
		$("#vat_percent").val(vat_percent);
		var total_before_vat = document.getElementById("total_before_vat").value;
		var subtot=parseFloat(total_before_vat*(vat_percent/100)).toFixed(2);
		var x= parseFloat(total_before_vat)+parseFloat(subtot);
	 	document.getElementById("vat_amt").value=subtot;
	 	document.getElementById("grand_total").value=parseFloat(x).toFixed(2);
	 	
	} else {
	 
		$("#vat_percent").val(0);
	 	document.getElementById("vat_amt").value=0.00;
		var total_before_vat = document.getElementById("total_before_vat").value;
	 	document.getElementById("grand_total").value=total_before_vat;
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
function get_product_description(append_id)
{
	var pcode= $('#order_code'+append_id).val();
	var newStr = pcode.replaceAll(',','');
	//$('#pcode'+append_id).val(newStr);
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
   	var grand_total = parseFloat(calVatAmt+total_before_vat);
	
	//var crate= document.getElementById('crate').value;
	var crate=1;
	var grand_total = parseFloat(grand_total*crate);
	document.getElementById("grand_total").value= parseFloat(grand_total).toFixed(2);
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
