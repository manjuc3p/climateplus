<?php $this->load->helper('stock_helper.php');?>
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
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/get_item_wise_stock_allocation" id="addform" autocomplete="off" enctype="multipart/form-data">
	<div class="form-group row">
		
              <label class="col-xs-12 col-sm-2 col-md-1 col-lg-1 col-form-label">Warehouse <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-2 col-md-3 col-lg-3">	     
	         <select name="warehouse_id" id="warehouse_id" class="form-control select2" required >
		      <option value="">Select warehouse</option>
		      <?php foreach($store_records as $g) { ?>
			   <option <?php if($g->warehouse_id==$warehouse_id) echo 'selected';?>  value="<?php echo $g->warehouse_id;?>"><?php echo $g->warehouse_name.' '.$g->city.' '.$g->person_incharge; ?></option>
		      <?php } ?>
	      	  </select>
	      </div>  	
	      
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Stock code</label>
	    <div class="col-xs-12 col-sm-10 col-md-4 col-lg-4">
	    	<select tabindex="5" class="form-select form-control-sm select2 select2Width" id="product_id0" name="product_id" onchange="get_product_info(0)" >
			<option value="">Select Code</option>
			<?php foreach($products as $s) {
			$size= str_replace('"', ' Inch' ,$s->size);?>
			  <option <?php if($s->model_code==$item_id) echo 'selected';?> value="<?php echo $s->model_code; ?>"><?php echo $s->model_code;?></option>
			<?php } ?>
	        </select>
	      </div>
	      <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">	     
	      	<input tabindex="7" type="submit" id="go" value="Show" class="btn btn-warning btn-sm" />
      	      </div>
      </div>
</form>

	<div class="dt-responsive table-responsive">
		<table id="datatable" class="table" >	
		<thead>
		<tr>
			<th>Srn</th>
			<th>Stock Code</th>
			<th>Bill No /Order ref </th>
			<th>Box no/Year</th>
			<th>Stock / <br>Allocated Qty</th>
			<th>Allocate</th>
			<th>Select Job Reference No</th>
		</tr>
		</thead>
		<tbody>
		<?php $i=1; foreach($records as $row) :?>
		<tr>
			<form  method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/add_stock_allocation_details">
			<td><?php echo  $i; $i++;?></td>
			<td><?php echo $row->model_code; ?></td>
			<td>
				<?php echo $row->bill_no.'<br>'.$row->order_ref_no; ?></td>
			<td><?php echo $row->box_no.' <br> ('.$row->year.')'; ?></td>
			<td><?php echo $row->qty.' / '.$row->allocation; ?></td>
			<td><input type='number' style='width:70px;' name="allocation" value='0' /></td>
			<td>
				<select tabindex="1" class="form-select form-control-sm select2" id="qid" name="qid" required>
				<option value="">Select</option>
				<?php foreach($quote_records as $s) {?>
				  <option value="<?php echo $s->quote_id ?>"><?php echo $s->catalyst_ref.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
			      <br>
				<input type='hidden' name="warehouse_id" value='<?php echo $warehouse_id; ?>' />
				<input type='hidden' name="product_id" value='<?php echo $item_id; ?>' />
				<input type='hidden' name="model_code" value='<?php echo $row->model_code; ?>' />
				<input type='hidden' name="bill_no" value='<?php echo $row->bill_no; ?>' />
				<input type='hidden' name="order_ref_no" value='<?php echo $row->order_ref_no; ?>' />
				<input type='hidden' name="box_no" value='<?php echo $row->box_no; ?>' />
				<input type='hidden' name="stock_id" value='<?php echo $row->stock_id; ?>' />
				<button type="submit" <?php if($row->qty==$row->allocation) echo 'disabled'; ?> class="btn btn-sm btn-primary m-b-0">Allocate</button>
			</td>
		</form>
		</tr>
		<?php $res1 = get_allocation_details($row->model_code,$row->bill_no,$row->order_ref_no,$row->box_no);
		foreach($res1 as $k) { ?>
		<tr class="bg-soft-primary">
			<td colspan='3'><?php echo 'Job Ref No: '. $k->catalyst_ref ;?></td>
			<td colspan='3'> Allocated Qty: 
			<input type='number' style='width:100px;' name="allocation_qty" value='<?php echo $k->quantity; ?>' readonly />
			</td>
			<td colspan='2'></td>
		</tr>
		<?php } endforeach; ?>
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
