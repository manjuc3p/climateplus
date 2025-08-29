<style type="text/css">

.select2Width {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 240px !important;
  min-width: 240px !important;
}

</style>

<div class="card-body">
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/add_min_stock_details" id="addform" autocomplete="off" enctype="multipart/form-data">
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Stock code</label>
	    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-6">
	    	<select tabindex="5" class="form-select form-control-sm select2 select2Width" id="stock_code" name="stock_code" onchange="get_stock_code()" >
			<option value="">Select Code</option>
			<?php foreach($products as $s) {
			$size= str_replace('"', ' Inch' ,$s->size);?>
			  <option value="<?php echo $s->model_code; ?>"><?php echo $s->model_code;?></option>
			<?php } ?>
		      </select>
	      </div>  	
        </div>
       
        
	<div class="form-group row">    
	    <label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Min Stock</label>
	    <div class="col-xs-12 col-sm-10 col-md-3 col-lg-3">
	    	
	    	<input type="text" name="min_stock_qty" id="min_stock_qty" tabindex='10' class="form-control form-control-sm" placeholder="Min stock qty" >
	    </div>       
	</div>

	
 
	 <div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
			<button type="submit" id='add' class="btn btn-primary m-b-0">Update</button>
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
function get_stock_code()
{
	//var order_code= document.getElementById("order_code0").value;
	//var size= document.getElementById("size").value;
	//var x= size+order_code;
	var x= document.getElementById("stock_code").value;
	
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
