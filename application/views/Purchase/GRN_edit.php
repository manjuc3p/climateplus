<?php $this->load->helper('stock_helper.php');?>
<div class="card-body">
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Stock/update_grn_records" id="addform" autocomplete="off" enctype="multipart/form-data" >
<?php  foreach($records1 as $row) :?>
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">GRN Code</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	      <input type="text" name="code" id="code" class="form-control form-control-sm" value="<?php echo ($row->grn_code); ?>" readonly>
	      </div> 
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">GRN Date</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	      <input type="text" name="date" id="date" class="form-control date_today form-control-sm" value="<?php echo date('d-m-Y', strtotime($row->grn_date)); ?>" required>
	      </div> 
	</div>
	<div class="form-group row">	    
	     <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label"> Warehouse</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	      <select name="warehouse_id" id="warehouse_id" class="form-control select2" required >
	      <option value="">Select warehouse</option>
	      <?php foreach($store_records as $g) { ?>
		   <option <?php if($g->warehouse_id==$row->warehouse_id) echo 'selected' ?> value="<?php echo $g->warehouse_id;?>"><?php echo $g->warehouse_name.' '.$g->city.' '.$g->person_incharge; ?> </option>
	      <?php } ?>
	      </select>
	      </div>
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier Name<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3">
	      <select name="" id="" class="form-control" disabled required>
	      <option value="">Please select name</option>
	      <?php foreach($supplier_records as $g) { ?>
		   <option <?php if($row->supplier_id== $g->supplier_id) echo 'selected';?> value="<?php echo $g->supplier_id;?>"><?php echo $g->supplier_code.' '.$g->supplier_name; ?> </option>
	      <?php } ?>
	      </select>
	      <input type="hidden" name="supplier_id" id="supplier_id" class="form-control form-control-sm" value="<?php echo $row->supplier_id; ?>" readonly>	    
	   </div>    
	</div>
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier Invoice No</label>
	    <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3">
	      <input type="text" name="invoice_no" id="invoice_no" class="form-control form-control-sm" value="<?php echo $row->invoice_no; ?>" >
	      </div> 
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier Invoice Date</label>
	    <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3">
	      <input type="text" name="inv_date" id="inv_date" class="form-control  form-control-sm" value="<?php echo date('d-m-Y', strtotime($row->invoice_date)); ?>" >
	      </div> 
	</div>
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Deliverd By</label>
	    <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3">
	    	<textarea name="deliverd_by" id="deliverd_by" class="form-control form-control-sm" rows="3" cols="2"><?php echo $row->delivery_by; ?></textarea>
	      </div> 
	       <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">Delivery Comment/Details</label>
	       <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
	    	<textarea name="remark" id="remark" class="form-control form-control-sm" rows="3" cols="2"><?php echo $row->delivery_details; ?></textarea>
	       </div> 	
	</div>
	
	<div class="form-group row" >
	<table class="table table-bordered table-hover" id="tab_logic">
		<thead>
		<tr>
			<th title="Item">Item code</th>      
			<th title="Item">Req Quantity</th>  
			<th title="Item">Quantity/ Price</th>   
			<th title="Item">Remark /Location <br>
			 	<!--<a id="add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a>-->
		       </th>   
		</tr>
		</thead>
		
		<tbody id="mytrbody"> 
		<?php  $i=5000; foreach($records2 as $r) {
		$prev_qty=get_last_grn_quantity($row->po_id,$r->order_code,$r->size);?>
		<tr id="addr<?php echo $i;?>">
			
			<td>
				<select tabindex="11" class="form-select form-control-sm select2 select2Width" id="product_id<?php echo $i;?>" name="product_id[]" onchange="get_treding_product_info(<?php echo $i;?>)" required>
				<option value="">Select Item</option>
				<?php foreach($products as $s) {?>
				  <option <?php if($s->item_id==$r->product_id) echo 'selected';?> value="<?php echo $s->item_id;?>"><?php echo $s->item_code.' '.$s->item_name.' '.$s->part_code.' '.$s->make_model;?></option>
				<?php } ?>
			      </select>
				<br><textarea rows='7' cols='30'  name="desc[]" id="desc<?php echo $i;?>" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm" required><?php echo $r->item_desc;?></textarea>
			</td>
			<td>	
				Ordered Qty
				<input type="text" readonly class="form-control form-control-sm bg-soft-gray" name="ordered_qty[]"  value="<?php echo $r->quantity;?>"><br>
				Prev Rec Qty
				<input type="number" name="pre_qty[]" id="pre_qty<?php echo $i;?>"  class="form-control form-control-sm bg-soft-gray" value="<?php echo $prev_qty;?>" readonly >
			</td>
			<td>
				Received Qty
				<input type="number" name="qty[]" id="qty<?php echo $i;?>"  class="form-control form-control-sm" value="<?php echo $r->quantity;?>" onchange="calculate_total('<?php echo $i;?>')" ><br>
				Price
				<input type="number" step='0.01' name="price[]" id="price<?php echo $i;?>" class="form-control form-control-sm"  onchange="calculate_total('<?php echo $i;?>')" value="<?php echo $r->price;?>"  required><br>
				Total
				<input type="number" name="total[]" id="total<?php echo $i;?>" class="form-control bg-soft-gray form-control-sm subItemAmt" readonly required value="<?php echo $r->total;?>"><br>
				
			</td>
			<td>
				<input type="text" name="item_remark[]" id="item_remark<?php echo $i;?>"  class="form-control form-control-sm" placeholder="remark" value="<?php echo $r->item_remark;?>">
				<br>Storage Location
				<textarea rows='5' cols='30'  name="storage_location[]" id="valve_serial_no<?php echo $i;?>" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm" placeholder="Enter Rack shell bin details"></textarea>
				
				<input type="hidden"  name="product_id[]" value="<?php echo $r->product_id;?>" >
				<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
				<br>
				<a id='delete_row' title="Delete" onclick='remove_row("<?php echo $i;?>")' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
			</td>
		</tr>	
		<?php  $i++; } ?>
		
		</tbody>
		<tbody id="mytbbody"> 
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
				  <option <?php if($s->id==$row->currency_id) echo 'selected';?> value="<?php echo $s->id.'@'.$s->rate.'@'.$s->currabrev; ?>"><?php echo $s->country.' '.$s->currabrev;?></option>
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
		<hr>


		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
			<button type="submit" id='edit' class="btn btn-primary m-b-0">Update GRN</button>
			<button type="reset"  id='reset' class="btn btn-primary m-b-0">Reset</button>
			</div>
		</div>
	</form>
	<input type="hidden"  name="po_id" value="<?php echo $row->po_id;?>" >
	<input type="hidden"  name="supplier_id" value="<?php echo $row->supplier_id;?>" >
	<input type="hidden"  name="grn_id" value="<?php echo $row->grn_id;?>" >
	<input type="hidden"  name="revision_version" value="<?php echo $row->rev_version+1;?>" >
       
	<?php endforeach; ?>
        </div>
        
          <h4>Stock Inventory details:</h4>
	    <div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped">
                                        <thead>
                                            <tr>
							<th>Sr.no</th>
							<th>Stock Code</th>
							<th>Bill No</th>
							<th>Order Ref</th>
							<th>Box No</th>
							<th>Qty</th>
							<th>Price</th>
						</tr>
					</thead>

					<tbody>
					<?php $i=1; foreach($inventory_records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td><?php echo $row->model_code;?></td>
							<td><?php echo $row->bill_no;?></td>
							<td><?php echo $row->order_ref_no;?></td>
							<td><?php echo $row->box_no;?></td>
							<td><?php echo $row->stock;?></td>
							<td><?php echo $row->price;?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>

				</table>
                  </div>
            </div>
            
    </div>
    
  
            
</div>
</div>
</div>
</div>

<script>

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

</script>
