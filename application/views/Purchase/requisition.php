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
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/add_requisition_records" autocomplete="off" enctype="multipart/form-data">
	<div class="form-group row">
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Requisition Date <span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
			<div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id="rfq_date" name="rfq_date" value="<?php echo date('d-m-Y')?>" required tabindex=1>
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		      	</div>
		   </div>
	</div>
	
	<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
			    <tr>
			    	    <th>Sr</th> 
			    	    <th>Select Items</th> 
			    	    <th>Quantity</th>      
			    	    <th>Remark</th>  
			    	    <th width='10%'><a id="add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a></th>
				</tr>
			    </thead>		 
			    
			    <tbody id="mytbbody">
				<tr id='addr0'>
					<td><input type="text" name="srn[]" id="srn0" tabindex='10' class="form-control form-control-sm" value="1">
					</td>
					<td>
						<select tabindex="11" class="form-select form-control-sm select2" id="product_id0" name="product_id[]" onchange="get_treding_product_info(0)" style="width:350px;">
						<option value="">Select</option>
						<?php foreach($products as $s) {?>
						  <option value="<?php echo $s->item_id; ?>"><?php echo $s->item_code.' '.$s->item_name.' '.$s->part_code.' '.$s->make_model;?></option>
						<?php } ?>
					      </select>
						<textarea rows='4' cols='20' name="desc[]" id="desc0" style="font-size:11px; font-weight:bold;"  class="form-control form-control-sm" tabindex='13' placeholder="Description"></textarea>
					</td>
					<td><input type="number" name="trading_qty[]" id="trading_qty0" tabindex='14' class="form-control form-control-sm" placeholder="" ></td>
					
					<td><textarea name="item_remark[]" id="item_remark0" tabindex='16' class="form-control form-control-sm" placeholder="remark" ></textarea></td>
					<td><a id='delete_row' title="Delete" onclick='remove_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
				</tr>
				<tr id='addr1'></tr>
			</tbody>
		</table>
		</div>
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Notes/Remark:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px' cols='50' rows='3' name="terms" id="terms"  tabindex=20 class="form-control form-control-sm" ></textarea>		     
		    </div>
		    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Created By:</label>
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
	$("#add_row").click(function()
	{
	     $('#addr'+i).html("<td><input type='text' name='srn[]' id='srn"+i+"' tabindex='10' class='form-control form-control-sm' value='"+(i+1)+"'></td><td><select tabindex='11' class='form-select form-control-sm select2' id='product_id"+i+"' name='product_id[]' onchange='get_treding_product_info("+i+")' style='width:350px;'><option value=''>Select Code</option><?php foreach($products as $s) {?><option value='<?php echo $s->item_id; ?>'><?php echo $s->item_code.' '.$s->item_name.' '.$s->part_code.' '.$s->make_model;?></option><?php } ?></select><textarea rows='4' cols='20' name='desc[]' id='desc"+i+"' style='font-size:11px; font-weight:bold;'  class='form-control form-control-sm' tabindex='13' placeholder='Description'></textarea></td><td><input type='number' name='trading_qty[]' id='trading_qty"+i+"' tabindex='14' class='form-control form-control-sm' placeholder='' ></td><td><textarea name='item_remark[]' id='item_remark"+i+"' tabindex='16' class='form-control form-control-sm' placeholder='remark' ></textarea></td><td><a id='delete_row' title='Delete' onclick='remove_row("+i+")' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
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
</script>
