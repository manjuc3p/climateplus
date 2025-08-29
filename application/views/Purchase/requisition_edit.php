<?php $this->load->helper('stock_helper.php'); ?>


<div class="card-body">
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/update_requisition_records" id="addform" autocomplete="off" enctype="multipart/form-data" >
<?php foreach($records1 as $row) {  ?>
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Enquiry Date <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date">			                  
		    <input type="text" class="form-control form-control-sm" id="enq_date" name="enq_date" value="<?php echo date('d-m-Y',strtotime($row->req_date));?>" tabindex=1>
			      	</div>
    	     		 </div>      
	</div>		    
	      
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Code</label>
	    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	    	<input type="text" name="qcode" id="qcode" class="form-control" value="<?php echo $row->req_code; ?>" />
	    </div>  	    
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Remark</label>
	    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	    	<textarea name="remark" id="remark" class="form-control" rows="3" cols="2"><?php echo $row->remark; ?></textarea>
	    </div>  	    
	</div>
	
	<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_logic">
		  	<thead>
			    <tr>
			    	    <th>Items</th> 
			    	    <th>Quantity</th>      
			    	    <th>Remark</th>  
			    	    <th width='10%'>
					<?php if($edit_flag==1){?><a id="add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a><?php } ?></th>
				</tr>
			    </thead>		 
			    <tbody id="mytbbody">
			    <?php $i=50001; foreach($trans_records as $r) :?>
				<tr>
					<td>
						<select tabindex="11" class="form-select form-control-sm select2 select2Width" id="product_id<?php echo $i;?>" name="product_id[]" onchange="get_product_info_old(<?php echo $i;?>)" >
						<option value="">Select Code</option>
						<?php foreach($products as $s) {?>
						  <option <?php if($s->item_id==$r->product_id) echo 'selected';?> value="<?php echo $s->item_id;?>"><?php echo $s->item_code.' '.$s->item_name.' '.$s->part_code.' '.$s->make_model;?></option>
						<?php } ?>
					      </select>
						<textarea rows='4' cols='20' name="desc[]" id="desc<?php echo $i;?>" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm" tabindex='9' required><?php echo $r->product_desc;?></textarea>
					</td>
					<td>
						<input type="number" name="trading_qty[]" id="trading_qty0" tabindex='10' class="form-control form-control-sm" value="<?php echo $r->quantity;?>" required>
					</td>
					<td>
						<textarea name="item_remark[]" id="item_remark0" tabindex='16' class="form-control form-control-sm" placeholder="remark"><?php echo $r->item_remark;?></textarea>
						<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
					</td>
					<td>
					<a  href="javascript:confirmcancel(<?php echo $r->trans_id;?>)" title="Delete" class="btn btn-xs bg-orange"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
				<?php $i++; endforeach; ?>
				
				<tr id='addr1'></tr>
				</tbody>
			</table>
		     </div>
			 <div class="form-group row">
		     	<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Created By</label>
		    	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <select tabindex="1" class="form-select form-control-sm select2" id="user_id" name="user_id" required style='width:155px'>
				<option value="">Select</option>
				<?php foreach($user_records as $s) {?>
				  <option <?php if($row->person_id==$s->user_id) echo 'selected'; ?> value="<?php echo $s->user_id ?>"><?php echo $s->user_name;?></option>
				<?php } ?>
			      </select>
		       </div>
		</div>
<table>
<tr>
<td>
<div class="form-group row">
<label class="col-sm-2"></label>
<div class="col-sm-10">

<input type="hidden"  id="rfq_id" name="rfq_id"  value='<?php echo $row->req_id;?>'>
<?php if($edit_flag!=0){?>
<button type="submit" id='add' class="btn btn-primary m-b-0">Update</button>
<?php } ?>
</div>
</div>
<?php } ?>
</form>
</td>
<td>
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/approve_requisition_records" id="addform" autocomplete="off" enctype="multipart/form-data" >
<?php foreach($records1 as $row) {  ?>
	<div class="form-group row">
       		<label class="col-sm-2"></label>
		<div class="col-sm-10">

			<input type="hidden"  id="rfq_id" name="rfq_id"  value='<?php echo $row->req_id;?>'>
			<button type="submit" id='add' class="btn btn-primary m-b-0">Approve</button>

		</div>
	</div>
<?php } ?>
</form>
</td>
</tr>
</table>
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
	     $('#addr'+i).html("<td><select tabindex='11' class='form-select form-control-sm select2' id='product_id"+i+"' name='product_id[]' onchange='get_treding_product_info("+i+")' style='width:350px;'><option value=''>Select Code</option><?php foreach($products as $s) {?><option value='<?php echo $s->item_id; ?>'><?php echo $s->item_code.' '.$s->item_name.' '.$s->part_code.' '.$s->make_model;?></option><?php } ?></select><textarea rows='4' cols='20' name='desc[]' id='desc"+i+"' style='font-size:11px; font-weight:bold;'  class='form-control form-control-sm' tabindex='13' placeholder='Description'></textarea></td><td><input type='number' name='trading_qty[]' id='trading_qty"+i+"' tabindex='14' class='form-control form-control-sm' placeholder='' ></td><td><textarea name='item_remark[]' id='item_remark"+i+"' tabindex='16' class='form-control form-control-sm' placeholder='remark' ></textarea></td><td><a id='delete_row' title='Delete' onclick='remove_row("+i+")' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
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

 function call_me(append_id) 
 {
   	var item_id = document.getElementById("item_id"+append_id).value;
   	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Setup/ajax_get_item_details",
        data: {item_id:item_id} ,
        dataType: "json",
        success: function(msg){	       	       	
		document.getElementById("desc"+append_id).value=msg.description;
		document.getElementById("truei"+append_id).value=item_id;
		document.getElementById("unit_id"+append_id).value=msg.unit_id;	
		document.getElementById("width"+append_id).value=msg.width;
		document.getElementById("height"+append_id).value=msg.height;    
		document.getElementById("area"+append_id).value=msg.area;    
		document.getElementById("selling_unit"+append_id).innerHTML=msg.selling_unit_name; 	
		////  view model popup
		$('#indent-Modal').modal('show');
		document.getElementById('model_heading').innerHTML=msg.item_name;
	 	document.getElementById('pocode').innerHTML=msg.pocode;	
	 	document.getElementById('lastpo_price').innerHTML=msg.po_price;
	 	document.getElementById('lastpo_qty').innerHTML=msg.po_qty;
	 	document.getElementById('stock').innerHTML=msg.stock;
	     }
	});
 }     
 function call_me1(append_id) 
 {
   	var item_id = document.getElementById("item_id"+append_id).value;
   	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Setup/ajax_get_item_details",
        data: {item_id:item_id} ,
        dataType: "json",
        success: function(msg){	       	       	  	
		////  view model popup
		$('#indent-Modal').modal('show');
		document.getElementById('model_heading').innerHTML=msg.item_name;
	 	document.getElementById('pocode').innerHTML=msg.pocode;	
	 	document.getElementById('lastpo_price').innerHTML=msg.po_price;
	 	document.getElementById('lastpo_qty').innerHTML=msg.po_qty;
	 	document.getElementById('stock').innerHTML=msg.stock;
	     }
	});
 }  


function get_indent_item_list()
{
	var indent_id=$("#indent_id").val();
	var rev_version=$("#revision_version").val();	
	$.ajax({
        type: "POST",
        url:"<?php echo base_url()?>index.php/Ajax/get_indent_item_list",
        data: {indent_id:indent_id, rev_version:rev_version} ,
        success: function(msg){	       	
		document.getElementById('item_list_id').innerHTML=msg;
	     }
	});
}

  
</script>
