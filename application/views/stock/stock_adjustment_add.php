<style type="text/css">

.select2Width {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 220px !important;
  min-width: 220px !important;
}

</style>

<div class="card-body">
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/stock_adjustment_details" id="addform" autocomplete="off" enctype="multipart/form-data" onSubmit="formsubmit();">
	<div class="form-group row">	
              <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Warehouse <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-2 col-md-4 col-lg-4">	     
	         <select name="warehouse_id" id="warehouse_id" class="form-control select2" required tabindex='1' >
		      <option value="">Select warehouse</option>
		      <?php foreach($store_records as $g) { ?>
			   <option selected value="<?php echo $g->warehouse_id;?>"><?php echo $g->warehouse_name.' '.$g->city.' '.$g->person_incharge; ?></option>
		      <?php } ?>
	      	  </select>
	      </div>  	
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Stock Date<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	      <input type="text" name="date" id="date" class="form-control" tabindex='2'  value="<?php echo date('d-M-Y'); ?>" required >
	      </div>	
	</div>
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Remark</label>
	    <div class="col-xs-12 col-sm-10 col-md-4 col-lg-4">
	    	<textarea name="remark" id="remark" class="form-control" rows="1" cols="2" placeholder="enter remark" tabindex='3' ></textarea>
	    </div>   	    
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Stock Type<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-10 col-md-4 col-lg-4">
	    	<select tabindex="11" class="form-select form-control-sm select2" id="inward_type" name="inward_type" required tabindex='4' >
			<option value="">Select</option>
			<option value="Opening">Opening Stock</option>
			<option value="IN">Stock Inward</option>
			<option value="OUT">Stock Outward</option>
	        </select>
	    </div>   	    
	</div>
	
	
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Order code</label>
	    <div class="col-xs-12 col-sm-10 col-md-3 col-lg-3">
	    	<select tabindex="5" class="form-select form-control-sm select2 select2Width" id="product_id0" name="product_id" onchange="get_product_info(0)" >
			<option value="">Select Code</option>
			<?php foreach($products as $s) {
			$size= str_replace('"', ' Inch' ,$s->size);?>
			  <option value="<?php echo $s->product_id; ?>"><?php echo $s->pcode.' '.$size;?></option>
			<?php } ?>
		      </select>
		      
		      <input type="text" name="order_code" id="order_code0" tabindex='6' class="form-control form-control-sm select2Width" placeholder="Enter Customized Code" readonly onkeyup="get_product_description(0);">
			
		       <input type="hidden" name="pcode" id="pcode0" class="form-control form-control-sm" placeholder="" >
			<textarea rows='7' cols='26' name="desc" id="desc0" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm" tabindex='7' placeholder="Description"></textarea>
	    </div>   	    
	    <label class="col-xs-12 col-sm-2 col-md-1 col-lg-1 col-form-label">Size</label>
	    <div class="col-xs-12 col-sm-10 col-md-2 col-lg-2">
	    	<input type="text" name="size" id="size" tabindex='8' class="form-control form-control-sm" placeholder="size" onkeyup="get_stock_code()">
	    </div>   		    
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Stock Code<br><br> Min Stock</label>
	    <div class="col-xs-12 col-sm-10 col-md-2 col-lg-2">
	    	<input type="text" name="stock_code" id="stock_code" tabindex='9' class="form-control form-control-sm" placeholder="stock_code" >		<br>
	    	<input type="text" name="min_stock_qty" id="min_stock_qty" tabindex='10' class="form-control form-control-sm" placeholder="Min stock qty" required>
	    </div>   	    
	</div>
	

	<div class="form-group row">
	    <div class="col-md-12">
		<div class="dt-responsive table-responsive">
		<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
				<tr>
				    	<th title="Item">Sr </th> 
					<th title="Item">Bill of entry</th>      
					<th title="Item">Order ref no</th>      
					<th title="Item">Box no</th>  
					<th title="Item">Quantity/ Price</th>   
					<th title="Item">Remark /Location <br>
				 	<a id="add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a>
				       </th>   
				</tr>
			    </thead>		
			   		
			    <tbody id="mytbbody">
				<tr id='addr0'>
	                                <td>
	                                	1
	                                	<br>
						<a id='delete_row' title="Delete" onclick='remove_row("<?php echo $i;?>")' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
					</td>
	                                <td>
					      <input type="text" name="bill_entry[]" id="bill_entry0" tabindex='12' class="form-control form-control-sm select2Width" placeholder="Enter Bill of entry"><br>
					      Year<br>
					      <input type="text" name="year[]" id="year0" tabindex='13' class="form-control form-control-sm select2Width" placeholder="Enter year" value="<?php echo date('Y');?>">
					</td>
					<td>
						<input type="text" name="ref_no[]" id="ref_no0" tabindex='15' class="form-control form-control-sm" placeholder="Order ref no" >
						
					</td>
					<td>
						<input type="text" name="box_no[]" id="box_no0" tabindex='15' class="form-control form-control-sm" placeholder="Box no" >
						
					</td>
					<td>Quantity<br><input type="number" name="qty[]" id="qty0" tabindex='14' class="form-control form-control-sm" placeholder=""  required><br>
					Price <input type="number" step='0.01' name="price[]" id="price0" tabindex='14' class="form-control form-control-sm" placeholder=""  ></td>
					
					<td>
						<textarea name="item_remark[]" id="item_remark0" tabindex='16' class="form-control form-control-sm" placeholder="remark" ></textarea>
						<br>
						Storage Location
						<textarea rows='5' cols='30'  name="storage_location[]" id="valve_serial_no" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm" placeholder="Enter Rack shell bin details"></textarea></td>
		                 </tr>
				<tr id='addr1'></tr>
			    </tbody>
		</table>	
	    </div>    	
	    </div>    
	 </div>
 
	 <div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
			<button type="submit" id='add' class="btn btn-primary m-b-0">Submit</button>
			<button type="reset"  id='reset' class="btn btn-primary m-b-0">Reset</button>
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
	     $('#addr'+i).html("<td>"+(i+1)+"</td><td> <input type='text' name='bill_entry[]' id='bill_entry"+i+"' class='form-control form-control-sm select2Width' placeholder='Enter Bill of entry'><br> Year<br><input type='text' name='year[]' id='year"+i+"' tabindex='13' class='form-control form-control-sm select2Width' placeholder='Enter year' value='<?php echo date('Y');?>'></td><td><input type='text' name='ref_no[]' id='ref_no"+i+"' tabindex='15' class='form-control form-control-sm' placeholder='Order ref no' ></td><td><input type='text' name='box_no[]' id='box_no"+i+"' tabindex='15' class='form-control form-control-sm' placeholder='Box no' ></td><td>Quantity<br><input type='number' name='qty[]' id='qty"+i+"' tabindex='22' class='form-control form-control-sm' placeholder=''  required><br>Price<br><input type='number' name='price[]' id='price"+i+"' tabindex='22' class='form-control form-control-sm' step='0.01'></td>><td><textarea name='item_remark[]' id='item_remark"+i+"' placeholder='remark' tabindex='24' class='form-control form-control-sm' ></textarea><br>Storage Location<br><textarea rows='5' cols='30'  name='storage_location[]' id='storage_location"+i+"' style='font-size:11px; font-weight:bold;' class='form-control form-control-sm' placeholder='Enter Rack shell bin details'></textarea></td>");
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
		}
	});
	}
	else
	{
		document.getElementById("order_code"+append_id).value='';
		document.getElementById("pcode"+append_id).value='';
		document.getElementById("desc"+append_id).value='';
	}
}

function get_stock_code()
{
	var order_code= document.getElementById("order_code0").value;
	var size= document.getElementById("size").value;
	var x= size+order_code;
	document.getElementById("stock_code").value=x;
	
	var warehouse_id= document.getElementById("warehouse_id").value;
	$.ajax
	({
		url: "<?php echo site_url('Ajax/ajax_get_min_stock_qty'); ?>",
		type: 'POST',
		data: {stock_code: x },
		success: function(msg) {
				document.getElementById("min_stock_qty").value=msg;
		}
	});
}
</script>
