<div class="page-body">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<div class="card">
<div class="card-header">
<h5>RFQ Details</h5>
<label style='padding-left:1000px; '><a href='#' onclick="call_help();"><u><span class='fa fa-help'></span>help</u></a></label>
</div>
<div class="card-block">
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/update_purchase_rfq_records" id="addform" autocomplete="off" enctype="multipart/form-data" >
<?php foreach($records1 as $row) {  ?>
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">RFQ Code<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	      <input type="text" name="code" id="code" class="form-control" value="<?php echo $row->rfq_code; ?>" readonly>
	      </div>
	    <label class="col-xs-12 col-sm-2 col-md-1 col-lg-1 col-form-label">RFQ Date<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		<div class='input-group date' id='datetimepicker1'>
		<input type="text" name="date" id="date" class="form-control date_today" value="<?php echo date('d-m-Y',strtotime($row->rfq_date)); ?>" readonly>
		<div class="input-group-prepend">
			<span class="input-group-text ">
				<span class="btn btn-primary m-b-0 icofont icofont-ui-calendar"></span>
			</span>
		</div>	      
	      </div>	      
	</div>	    
	     <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Expected Delivey Date<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		<div class='input-group date' id='datetimepicker1'>
		<input type="text" name="req_delivery_date" id="req_delivery_date" class="form-control date_today" value="<?php echo date('d-m-Y',strtotime($row->req_delivery_date)); ?>" readonly>
		<div class="input-group-prepend">
			<span class="input-group-text ">
				<span class="btn btn-primary m-b-0 icofont icofont-ui-calendar"></span>
			</span>
		</div>	      
	      </div>
	       
	      </div>	    
	      
	</div>
	<div class="form-group row">	    
	     <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Supplier<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	      <select name="supplier_id" id="supplier_id" class="form-control select2" required readonly>
	      <option value="">Please select name</option>
	      <?php foreach($supplier_records as $g) { ?>
		   <option <?php if($row->supplier_id==$g->supplier_id) echo 'selected'; ?> value="<?php echo $g->supplier_id;?>" ><?php echo $g->supplier_code.' '.$g->supplier_name; ?> </option>
	      <?php } ?>
	      </select>
	      </div>	
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Terms & Conditions</label>
	    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	    	<textarea name="remark" id="remark" class="form-control" rows="3" cols="2" readonly><?php echo $row->remark; ?></textarea>
	    </div>  	    
	</div>
	
	<div class="form-group row">
	    <div class="col-md-12">
		<div class="dt-responsive table-responsive">
		<!--<table class="table table-bordered table-hover" id="scr-vtr-dynamic">-->
		<table class="table table-bordered table-hover" id="My_table">
			   <thead>
				 <tr>
				<th></th>
				<th colspan=3>GLASS DIMENSIONS</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			    </tr>
			    <tr>
	                    	<th title="Item">Item</th>
			            <th title="">WIDTH <br>(m)</th>
			            <th title="">Height <br>(m)</th>
			            <th title=" ">Quantity</th>
	                    	    <th title="Unit Of Measurement">Unit of<br>measure</th>
			            <th title=" ">Total AREA(m<sup>2</sup>) /<br> Length/ Qty </th>
	                    	    <th title="file">Upload File</th>
	                            <th title="Comments">Internal Comments</th>	                    
	                    	    <th><!--<a id="add_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a>--></th>
				</tr>
			    </thead>					
			    <tbody id="item_list_id">
				<?php $i=1; foreach($records2 as $tr) { ?>
				<tr  id="addr<?php echo $tr->rfq_trans_id.'3' ?>">	
					<td>
					   <?php foreach($item_records as $g) { ?>			
						     <?php if($tr->item_id==$g->item_master_id){ ?> 
							<label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-form-label">
								<a href="#" onclick="call_me1(<?php echo $tr->rfq_trans_id.'3' ?>)"> <?php echo $g->item_code.' '.$g->item_name;?>  </a>
							</label>
					      <?php $icode=$g->item_code; } } ?>
					    <input type='hidden' name='item_id[]' id="item_id<?php echo $tr->rfq_trans_id.'3' ?>" value="<?php echo $tr->item_id; ?>"/>				
					<textarea class="form-control" name="desc[]" rows="3" cols="2" readonly><?php echo $tr->item_desc;?></textarea>
					
					</td>								
					<td><input type="number" min=1 class="form-control"  style="width: 90px;" id="width<?php echo $tr->rfq_trans_id.'3' ?>" name="width[]" placeholder="Width" step="0.00" value='<?php if($tr->width > 0) echo $tr->width; ?>' onblur='calculate_area("<?php echo $tr->rfq_trans_id.'3' ?>")' readonly></td>
					<td>
						<input type="number" min=1 class="form-control"  style="width: 90px;" id="height<?php echo $tr->rfq_trans_id.'3' ?>" name="height[]" placeholder="height" step="0.01" value='<?php if($tr->height >0) echo $tr->height;?>' onblur='calculate_area("<?php echo $tr->rfq_trans_id.'3' ?>")' readonly>
					</td>
					<td>
						<input type="number" min=1 class="form-control"  style="width: 90px;" id="quantity<?php echo $tr->rfq_trans_id.'3' ?>" name="quantity[]" placeholder="Qty" onblur='calculate_area("<?php echo $tr->rfq_trans_id.'3' ?>")' step="0.01"  required value='<?php echo $tr->quantity ?>' >
					</td>
					<td>
					   <?php foreach($unit_records as $g) { ?>			
						     <?php if($tr->unit_id==$g->unit_id){ ?> 
							<label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-form-label">
								 <?php echo $g->unit_abbr;?>
							</label>
					      <?php } } ?>					     
						<input type='hidden' name='unit_id[]' value="<?php echo $tr->unit_id; ?>"/>
					</td>
					<td>
						<input type="number" min=1 class="form-control"  style="width: 90px;" id="area<?php echo $tr->rfq_trans_id.'3' ?>" name="area[]" step="0.01" readonly value='<?php  if($tr->area > 0) echo $tr->area; ?>'><label id='selling_unit0'><?php echo $tr->selling_unit;?></label><input type="hidden" id="main_area<?php echo $tr->rfq_trans_id.'3' ?>" value='<?php  if($tr->area > 0) echo $tr->area/$tr->quantity; ?>'>
					</td>
					
					<td style="width:10%!important">
						<!--<input type="file" class="form-control" id="indent_upload0" name="indent_upload[]" >
						<br>-->
						<?php if($tr->file_upload_path!='') {?>
						<a href="<?php echo base_url().$tr->file_upload_path;?>" download><?php echo $tr->file_name;?></a>
						<?php } else echo 'file not available';?>
						
						<input type="hidden" name="pi_file_name[]" value="<?php echo $tr->file_name;?>" >
						<input type="hidden" name="pi_file_path[]" value="<?php echo $tr->file_upload_path;?>" >
					</td>
					<td>
						<textarea class="form-control" id="comment" name="comment[]" rows="3" cols="3" ><?php echo $tr->comment; ?></textarea>
					</td>
					<td>
					
					<input type='hidden' name='rfq_trans_id[]' value="<?php echo $tr->rfq_trans_id; ?>"/>
					 <a id='delete_row' title="Delete" onclick='remove_row("<?php echo $tr->rfq_trans_id.'3' ?>")' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
					</td>	
				</tr>
			<?php  $i++; } ?>
			   </tbody>
			
		</table>	
    </div>    
    </div>    
 </div>
 

<div class="form-group row">
<label class="col-sm-2"></label>
<div class="col-sm-10">
<input type="hidden"  id="revision_version" name="revision_version" value="<?php echo $row->rev_version+1;?>"  >
<input type="hidden"  id="rfq_id" name="rfq_id"  value='<?php echo $row->rfq_id;?>'>
<?php if($edit_flag!=0){?>
<button type="submit" id='add' class="btn btn-primary m-b-0">Update</button>
<?php } ?>
</div>
</div>
<?php } ?>
</form>

<!---- indent stock & costing modal start --->
<div class="modal fade" id="indent-Modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background-color: #bbbbbb;">
<label style="background-color: #bbbbbb;">Stock Details For </label><h5 id='model_heading'></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Purchase/approve_purchase_indent">
	<div class="modal-body" style="border: 2px">		
			<div class="form-group row"  style="background-color: #cacaca;">
			    <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-form-label">Last Purchase </label>
			</div>		
			<div class="form-group row">
			    <label class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-form-label">PO No: </label>
			    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			    	<label id='pocode'></label>
			    </div>   		    
			</div>		
			<div class="form-group row">
			    <label class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-form-label">Price:</label>
			    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			    	<label id='lastpo_price'></label>
			    </div>   	    
			    <label class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-form-label">Qty:</label>
			    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
			    	<label id='lastpo_qty'></label>
			    </div>   	    
			</div>		
			
			<div class="form-group row">			      	    
			    <label class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-form-label">Stock Qty:</label>
			    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			    	<label id='stock'></label>
			    </div>   	    
			</div>	
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
	</div>
</form>
</div>
</div>
</div>

<!---- Help modal start --->
<div class="modal fade" id="help-Modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header" style="background-color: #bbbbbb;">
<label style="background-color: #bbbbbb;">RFQ Details </label>
<br>
<h5 id='model_heading'></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
	<p>Fields marked with red * are mandatory</p>
</div>
</div>
</div>
<!---- modal end ------>
</div>
</div>



</div>
</div>
</div>

</div>
</div>


</div>
</div>
</div>
</div>
</div>
</div>

</body>
</html>
<script>

  $(document).ready(function(){
	var i=1;
	$("#add_row").click(function(){
		 	
	     $('#addr'+i).html("<td><select class='form-control input-sm col-sm-12  select2' style='width: 300px!important;' name='item_id[]' id='item_id"+i+"' onchange='call_me("+i+");' required><option value=''>Select Item</option><?php foreach($item_records as $c):?><option title='<?php echo $c->description.' '.$c->make;?>' value='<?php echo $c->item_master_id;?>'><?php echo $c->item_code.''.$c->item_name;?></option><?php endforeach;?></select><input type='hidden' name='truei[]' id='truei"+i+"' value=''><textarea  class='form-control' id='desc"+i+"' name='desc[]' rows='3' cols='3' readonly></textarea></td><td><input type='text' name='delivey_date"+i+"' id='delivey_date[]' class='form-control date_today' value='<?php echo date('d-m-Y'); ?>'></td><td><input type='number' min=1 class='form-control'  style='width: 90px;' id='width"+i+"' name='width[]' placeholder='Width' step='0.01'></td><td><input type='number' min=1 class='form-control'  style='width: 90px;' id='height"+i+"' name='height[]' placeholder='height' step='0.01'></td><td><input type='number' min=1 class='form-control'  style='width: 90px;' id='quantity"+i+"' name='quantity[]' placeholder='Qty' step='0.01' onblur='calculate_area("+i+")'></td><td><select class='form-control' id='unit_id"+i+"' name='unit_id[]'  required><option value=''>Select</option><?php foreach($unit_records as $c):?><option value='<?php echo $c->unit_id;?>'><?php echo $c->unit_abbr;?></option><?php endforeach;?></select></td><td><input type='number' min=1 class='form-control'  style='width: 90px;' id='area"+i+"' name='area[]' step='0.01' readonly></td><td><input type='file' id='indent_upload"+i+"' name='indent_upload[]' style='width: 200px;'></td><td><textarea  class='form-control' id='comment"+i+"' name='comment[]' placeholder='Comment' rows='3' cols='3'></textarea></td><td><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    // $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
	    $('#mytbbody tr:first').before('<tr id="addr'+(i+1)+'"></tr>');
	      i++; 
	     $('.select2').select2({ width: "100px" });		
			$('.date_today').datepicker({
				format: "dd-mm-yyyy",
				todayHighlight:"true",
				//endDate:"today",
				toggleActive:"true",
				autoclose:true,
			});    	
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

function confirmcancel(indent_trans_id,val,item_id)
{   
	if(val==1) 
		var status='Reject';
	else if(val==2) 
		var status='Create PO';
	else if(val==3) 
		var status='From Stock';

	//document.getElementById("not_approved").value=1;
	var req_qty=document.getElementById("req_qty"+item_id).value;
	var qty=document.getElementById("quantity"+item_id).value;
	var bqty= req_qty-qty;
	if(val==3)
		var r= confirm("Are you sure you want to "+bqty+" quantity "+status+" for this Item?");
	else
		var r= confirm("Are you sure you want to "+status+" of this Item?");

	if(r == true) 
        {
		if(val==1)
		{
		var cancel_reason = prompt("Please enter reason/comment:", "");
		}
		else
		{
			 if(val==2) var cancel_reason = "Create PO";
			 if(val==3) var cancel_reason = "From Stock";
		}
                if(cancel_reason!='')
		{
	      		$.ajax({
	     		url: "<?php echo base_url()?>index.php/Ajax/cancel_approved_indent_tr_record",
	     		type: "POST",
	     		data: {indent_trans_id:indent_trans_id,val:val,cancel_reason:cancel_reason,qty:qty} ,
	     		success: function(msg) {
     			if(msg==1) {
			       alert("Record "+status); 				
			       location.reload();			                    		  
			}
			else {
			      	alert("Something went wrong!!!");
		        }
		        },
		    });
      		    return true;
		}
		else
		{
			alert('Item not Updated');
			return false;
		}
      	}
        else
	   return false;	    	
}

function get_indent_details()
{
	var indent_id=$("#indent_id").val();	
	var rev_version='';
	$.ajax({
	async: false,
        type: "POST",
        url:"<?php echo base_url()?>index.php/Ajax/get_indent_revision_no",
        data: {indent_id:indent_id} ,
        success: function(msg){	   
		rev_version=msg;
		document.getElementById('revision_version').value=msg;
	     }
	});	
	get_indent_item_list();
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

function calculate_area(append_id)
{       
	var width = parseFloat(document.getElementById("width"+append_id).value);

	var height = parseFloat(document.getElementById("height"+append_id).value);
	var quantity = parseFloat(document.getElementById("quantity"+append_id).value);	
	var area = parseFloat(document.getElementById("main_area"+append_id).value);	
        var area= parseFloat(quantity*area).toFixed(2);
	document.getElementById("area"+append_id).value=parseFloat(area).toFixed(2);
}
 function call_help() 
 {
    $('#help-Modal').modal('show');
 }  
</script>
