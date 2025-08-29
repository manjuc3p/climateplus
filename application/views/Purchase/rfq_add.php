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
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/add_direct_rfq_records" autocomplete="off" enctype="multipart/form-data">
	<div class="form-group row">
		    <label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Select Multi Requisition</label>
		    <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
		      	 <select name="req_id[]" id="req_id" class="form-control select2" multiple  onchange="get_req_item_list()">
		      <option value="">Please select name</option>
		      <?php foreach($indent_list as $g) { ?>
			   <option value="<?php echo $g->req_id;?>" ><?php echo $g->req_code.' '.$g->req_date; ?> </option>
		      <?php } ?>
		      </select>
		    </div>
	</div>
	<div class="form-group row">
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">RFQ Code<span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		      	<input type="text" name="code" id="code" class="form-control" value="<?php echo $Code; ?>" required>
		    </div>
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">RFQ Date <span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
			<div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id="rfq_date" name="rfq_date" value="<?php echo date('d-m-Y')?>" required tabindex=1>
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		      	</div>
		   </div>
	</div>
	<div class="form-group row">	    
	     <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Supplier<span style="color: red;"> * </span></label>
    	     <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
		      <select name="supplier_id" id="supplier_id" class="form-control select2" required >
		      <option value="">Please select name</option>
		      <?php foreach($supplier_records as $g) { ?>
			   <option value="<?php echo $g->supplier_id;?>" ><?php echo $g->supplier_code.' '.$g->supplier_name; ?> </option>
		      <?php } ?>
		      </select>
	      </div> 
	</div>
	<div class="form-group row"  id='item_list_id'>
	</div>
	<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
			        <tr>
			    	    <th>Items</th> 
			    	    <th>Quantity</th>      
			    	    <th>Remark</th>  
			    	    <th width='10%'>
						<a id="add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a></th>
				</tr>
			    </thead>		 
			    <tr></tr>
			    <tbody id="mytbbody">
				<tr id='addr1'></tr>
			   </tbody>
		</table>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Payment Terms:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px' cols='50' rows='3' name="pterms" id="pterms"  tabindex=20 class="form-control form-control-sm" ></textarea>		     
		    </div>
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Delivery Terms:</label>
	    	    <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			     <textarea style='font-size:12px' cols='50' rows='3' name="dterms" id="dterms"  tabindex=20 class="form-control form-control-sm" ></textarea>		     
		       </div>
	       </div>

		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Notes/Remark:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px' cols='50' rows='3' name="terms" id="terms"  tabindex=20 class="form-control form-control-sm" ></textarea>		     
		    </div>
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Created By Person:</label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			      <select tabindex="1" class="form-select form-control-sm select2" id="user_id" name="user_id" required style='width:195px'>
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
		<button type="submit"  tabindex="502"  id="add" class="btn btn-primary m-b-0">Create RFQ</button>
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
	     $('#addr'+i).html("<td><select tabindex='11' class='form-select form-control-sm select2' id='product_id"+i+"' name='product_id[]' onchange='get_treding_product_info("+i+")' style='width:350px;'><option value=''>Select Code</option><?php foreach($products as $s) {?><option value='<?php echo $s->item_id; ?>'><?php echo $s->item_code.' '.$s->item_name.' '.$s->part_code.' '.$s->make_model;?></option><?php } ?></select><textarea rows='2' cols='20' name='desc[]' id='desc"+i+"' style='font-size:11px; font-weight:bold;'  class='form-control form-control-sm' tabindex='13' placeholder='Description'></textarea></td><td><input type='number' name='trading_qty[]' id='trading_qty"+i+"' tabindex='14' class='form-control form-control-sm' placeholder='' ></td><td><textarea rows='2'  name='item_remark[]' id='item_remark"+i+"' tabindex='16' class='form-control form-control-sm' placeholder='remark' ></textarea></td><td><a id='delete_row' title='Delete' onclick='remove_row("+i+")' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
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
function get_req_item_list()
{

	//var req_id= document.getElementById("req_id").value;
	//alert(req_id);
	var selectedValues = [];    
    	$("#req_id :selected").each(function(){
        	selectedValues.push($(this).val()); 
    	});
    	//alert(selectedValues);
    
	get_list(selectedValues);
	
	
}
function get_list(selectedValues)
{
	$.ajax
	({
        	type: "POST",
                url:"<?php echo base_url()?>index.php/Ajax/ajax_get_requisition_items",
		data: {req_id: selectedValues },
		
		success: function(msg) {
				document.getElementById('item_list_id').innerHTML='';
				document.getElementById('item_list_id').innerHTML=msg;
		}
	});
}
</script>
