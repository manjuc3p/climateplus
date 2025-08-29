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
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/update_enquiry_data" id="addform" autocomplete="off"   enctype="multipart/form-data">
		<?php  foreach($records as $row) :?>
			<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Enquiry Code <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" >	                  
	    			<input type="text" class="form-control form-control-sm bg-soft-gray" id="enq_date" name="enq_date" value="<?php echo $row->enquiry_code;?>" readonly tabindex=1>
    	     		 </div>
		</div>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Enquiry Date <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date">			                  
		    			<input type="text" class="form-control form-control-sm" id="enq_date" name="enq_date" value="<?php echo date('d-m-Y',strtotime($row->enq_date));?>" tabindex=1>
			      	</div>
    	     		 </div>
	  		
		</div>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Customer<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	    			<a title="View customer details" target='blank' href="<?php echo base_url().'index.php/Users/edit_customer/'.$row->cust_id;?>" ><?php echo $row->cust_code.' '.$row->cust_name;?></a>
	  		</div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Enquiry Type <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	    			<select tabindex="4" class="form-select form-control-sm " id="enquiry_type" name="enquiry_type" disabled>
					<option value="">Select</option>
					<option <?php if($row->enq_type=='1') echo 'selected';?> value="Trading">Trading</option>
				      <option <?php if($row->enq_type=='2') echo 'selected';?>  value="Manufacturing">Manufacturing</option>
					  <option <?php if($row->enq_type=='3') echo 'selected';?> value="Machine Sales">Machine Sales</option>
			      </select>
				 <input type='hidden' id="enq_type" name="enq_type" value='<?php echo $row->enq_type; ?>' /> 
	  		</div>
		</div>
		
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Client Ref </label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" >                  
		    			<input type="text" class="form-control form-control-sm" id="client_ref" name="client_ref" value="<?php echo $row->client_ref;?>"  tabindex=1>
    	     		 </div>
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Remark/Comments</label>
	  		<div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
	    			<input type='text' tabindex="7" class="form-control form-control-sm" id="remark" name="remark" value="<?php echo $row->remark;?>"/>	
	  		</div>
		</div>
		
		<div class="form-group row">
			<?php 
 			if($row->enq_type=='2'){?>
		<table class="table table-bordered table-hover" id="tab_logic">
		  	<thead>
			    <tr>
			    	   
			    	    <th>Items</th> 
						<th >Description</th> 
						<th >Length(MM)</th> 
                        <th >Height(MM)</th> 
                        <th >Colour</th>
			    	    <th >Quantity</th>      
			    	    <th >
					<?php if($edit_flag==1){?><a id="add_row_manf" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a><?php } ?></th>
				</tr>
			    </thead>		 
			    <tbody id="mytbbodyf">
			    <?php $i=1; foreach($trans_records as $r) :?>
				<tr id='addrf0'>
				    <td>
						<select tabindex="11" class="form-select form-control-sm select2 select2Width" id="product_id<?php echo $i;?>" name="product_id[]" onchange="get_trading_product_info(<?php echo $i;?>)" >
						<option value="">Select Code</option>
						<?php foreach($products as $s) {?>
						  <option <?php if($s->product_id==$r->product_id) echo 'selected';?> value="<?php echo $s->product_id;?>"><?php echo $s->product_id;?></option>
						<?php } ?>
					      </select>
						
					</td>	
				
					<td>
					<?php foreach($products as $s) { if($s->product_id==$r->product_id) {?>
					<input type="text" name="desc[]" id="desc0" tabindex='16' class="form-control form-control-sm" placeholder="" readonly="true" value="<?php  echo $s->product_description;?>" >
					<?php }}?>
				    </td>
					
					
					<td>
						<input type="number" name="manf_length[]" id="manf_length0" tabindex='10' class="form-control form-control-sm" value="<?php echo $r->manf_length;?>" required>
						<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
					</td>
					<td>
						<input type="number" name="manf_height[]" id="manf_height0" tabindex='10' class="form-control form-control-sm" value="<?php echo $r->manf_height;?>" required>
						<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
					</td>
					<td>
						<input type="text" name="manf_color[]" id="manf_color0" tabindex='10' class="form-control form-control-sm" value="<?php echo $r->manf_color;?>" required>
						<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
					</td>
					<td>
						<input type="number" name="manf_qty[]" id="trading_qty0" tabindex='10' class="form-control form-control-sm" value="<?php echo $r->quantity;?>" required>
						<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
					</td>
					
					<td>
					<?php if($edit_flag==1){ ?><a id='delete_row_manf' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a><?php }?></td>
				</tr>
				<?php $i++; endforeach; ?>
				
				<tr id='addrf1'></tr>
				</tbody>
			</table>
			<?php }
			else{
			?>
		  	<table class="table table-bordered table-hover" id="tab_logic">
		  	<thead>
			    <tr>
			    	   
			    	    <th  width='60%' title="Item">Items</th> 
			    	    <th  width='20%'title="Item">Quantity</th>      
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
						  <option <?php if($s->product_id==$r->product_id) echo 'selected';?> value="<?php echo $s->product_id;?>"><?php echo $s->product_description;?></option>
						<?php } ?>
					      </select>
						
					</td>
					<td>
						<input type="number" name="trading_qty[]" id="trading_qty0" tabindex='10' class="form-control form-control-sm" value="<?php echo $r->quantity;?>" required>
						<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
					</td>
					
					<td>
					<?php if($edit_flag==1){ ?><a  href="javascript:confirmcancel(<?php echo $r->trans_id;?>)" title="Delete" class="btn btn-xs bg-orange"><span class="fa fa-trash"></span></a><?php }?></td>
				</tr>
				<?php $i++; endforeach; ?>
				
				<tr id='addr1'></tr>
				</tbody>
			</table>
			<?php }?>
		     </div>
		     
		    
		     <div class="form-group row">
	  		
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-3 col-form-label">Other Document(PDF/PNG/JPEG) </label>
	  		<div class="col-xs-12 col-sm-9 col-md-2 col-lg-3">
	    			<input type='file' tabindex="501" class="form-control form-control-sm" id="other_file" name="other_file" placeholder="" />	
    				<?php if($row->other_file!='')
				{?>
				<a download href="<?php echo base_url().'public/uploded_documents/'.$row->other_file;?>"><?php echo $row->other_file;?></a>
				<?php }?>
	  		</div>
		     	<label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Sales Person:</label>
		    	<div class="col-xs-12 col-sm-9 col-md-2 col-lg-3">
			      <select tabindex="1" class="form-select form-control-sm select2" id="user_id" name="user_id" required style='width:155px'>
				<option value="">Select</option>
				<?php foreach($user_records as $s) {?>
				  <option <?php if($row->sales_person==$s->user_id) echo 'selected'; ?> value="<?php echo $s->user_id ?>"><?php echo $s->user_name;?></option>
				<?php } ?>
			      </select>
		       </div>
		</div>
		
		
		<div class="form-group row">
		   <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Notes:</label>
		    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	   		 <textarea style='font-size:12px' cols='50' rows='3' name="terms" id="terms"  tabindex=20 class="form-control form-control-sm" ><?php foreach($terms_rec as $t){if($t->tid==3) echo $t->notes;}?></textarea>		     
		    </div>
		  	
		</div>
		</div>
		     <div class="form-group row">
		        <table width=100%>
		        <tr>
				<?php if($edit_flag==1){?>
		        	<td width='300px' align='center'>
		        		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">
					<input type='checkbox' name="create_revision" id="create_revision" value='1' />Create New Revision
					</label>
		        	</td>
		        	<td>
				<input type="hidden"  name="id" value="<?php echo $row->enquiry_id;?>" >
				<input type="hidden"  name="revision" value="<?php echo $row->revision;?>" >
				
				<button tabindex="46" type="submit" id="edit" class="btn btn-primary m-b-0">Update Enquiry</button>
				</form>
		        	</td>
				<?php } ?>
		        	<td>
				<form onsubmit="return add_supllier_id()" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/convert_enquiry_to_RFQ">
				<input type="hidden"  name="selected_tr" id="selected_tr"  >
				<input type="hidden"  name="id" value="<?php echo $row->enquiry_id;?>" >
				<input type="hidden"  name="enquiry_code" value="<?php echo $row->enquiry_code;?>" >
				<input type="hidden"  name="clien_ref" value="<?php echo $row->client_ref;?>" >
				<input type="hidden"  name="supp_id" id="supp_id" value="<?php echo $row->client_ref;?>" >
				<input type="hidden"  name="pterm" id="pterm" value="<?php echo $row->client_ref;?>" >
				<input type="hidden"  name="dterm" id="dterm" value="<?php echo $row->client_ref;?>" >
				<input type="hidden"  name="remark" id="remark" value="<?php echo $row->client_ref;?>" >
				<input type="hidden"  name="sales_person" id="sales_person" value="<?php echo $row->sales_person;?>" >
				<input type="hidden"  name="revision" value="<?php echo $row->revision;?>" >
				<input type="hidden"  name="rfq_type" value="excel" >
				
				<!-- <button tabindex="46" type="submit" disabled id="convert_excel" class="btn btn-primary m-b-0">Create RFQ to Vendor</button> -->
		        	</td>
		        	
		        	<td width='400px'></td>
				</form>
			  </tr>
		        </table>
			</div>
		<?php endforeach; ?>
                     

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
	    $('#addr'+i).html("<td><select tabindex='11' class='form-select form-control-sm select2' id='product_id"+i+"' name='product_id[]' onchange='get_trading_product_info("+i+")' style='width:400px;'><option value=''>Select </option><?php foreach($products as $s) {?><option value='<?php echo $s->product_id; ?>'><?php echo $s->product_description;?></option><?php } ?></select></td><td><input type='number' name='trading_qty[]' id='trading_qty"+i+"' tabindex='14' class='form-control form-control-sm' placeholder='' ></td><td><a id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytbbody tr:last').after('<tr id="addr'+(i+1)+'"></tr>');
	      i++; 	     	
	     $('.select2').select2();
	});
        $("#delete_row").click(function(){
    		 if(i>1){
			 $("#addr"+(i-1)).html('');
			 i--;
		 }
	 });

	//  manufacturing
	var k=1;
	$("#add_row_manf").click(function()
	{
        $('#addrf' + k).html("<td><select tabindex='11' class='form-select form-control-sm select2' id='product_id" + k + "' name='product_id[]' onchange='get_trading_product_info(" + k + ")' ><?php foreach($products as $s) {?><option value='<?php echo $s->product_id; ?>'><?php echo $s->product_id;?></option><?php } ?></select></td><td><input type='text' name='desc[]' id='desc" + k + "' tabindex='16' class='form-control form-control-sm' readonly=\"true\"></td><td><input type='number' name='manf_length[]' id='manf_length" + k + "' tabindex='14' class='form-control form-control-sm' placeholder='' ></td><td><input type='number' name='manf_height[]' id='manf_height" + k + "' tabindex='15' class='form-control form-control-sm' placeholder='' ></td><td><input type='text' name='manf_color[]' id='manf_color" + k + "' tabindex='16' class='form-control form-control-sm' placeholder=''></td><td><input type='number' name='manf_qty[]' id='manf_qty" + k + "' tabindex='17' class='form-control form-control-sm' placeholder='' ></td><td><a id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
		$('#mytbbodyf tr:last').after('<tr id="addrf'+(k+1)+'"></tr>');
	      k++; 	     	
	     $('.select2').select2();
	});
        $("#delete_row_manf").click(function(){
    		 if(k>1){
			 $("#addrf"+(k-1)).html('');
			 k--;
		 }
	 });
	 
	 /*  Project  */
	 var j=1;
	$("#add_row1").click(function()
	{
	     $('#product_div'+j).html("<table class='table table-bordered table-hover' id='pdetails"+j+"'><thead><tr style='background-color:#94C973!important; font-weight:bold'><th>"+(j+1)+"</th><th><input type='text' name='main_heading"+j+"' id='main_heading' class='form-control form-control-sm' placeholder='Add Main Heading' ></th><th>Qty:<input type='text' name='main_qty"+j+"' id='main_qty' class='form-control form-control-sm' placeholder='Quantity' value='1'></th><th width='10%'><input type='hidden' id='row_id_d"+j+"' value='0'/><input type='hidden' name='product_div_value[]'  value='"+j+"'/><a id='add_sub_row"+j+"' onclick=add_nxt_row('d"+j+"',0) title='Add' class='btn btn-sm bg-orange' ><span class='fa fa-plus'></span></a><a id='delete_row' title='Delete' onclick='remove_product_div("+j+")' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></th></tr></thead><tr><td colspan='4'><table id='tsub_details"+j+"' width='100%' style='background-color:#cccccc!important;'><tr><td>Sub Heading</td><td>Action</td></tr><tbody id='mybody_d"+j+"'><tr id='d0_ptr0' ><td><textarea name='sub_details"+j+"[]' id='sub_detailsd"+j+"0' class='form-control form-control-sm'></textarea><input type='hidden' name='qty"+j+"[]' id='qtyd00' tabindex='10' class='form-control form-control-sm' value='1'></td><td><a title='Delete' onclick=remove_subrow('d"+j+"',0) class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td></tr><tr id='d"+j+"_ptr1'></tr></tbody></table></td></tr></table>");
	     $('#product_div'+j).after("<div id='product_div"+(j+1)+"'></div>");
	       j++; 
	     $('.select2').select2({ width: "350px" });
	});
   });   
   function remove_row(append_id)
   {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
   }
   function remove_product_div(append_id)
   {    	 
        $('#product_div'+append_id).remove();
   }
   function remove_subrow(div_id,append_id)
   {    	
   	var x= div_id+'_ptr'+append_id;
        $('#'+x).remove();
   }
  function add_nxt_row(div_id, append_id)
  {
  	const myArray = div_id.split("d");
  	var one= myArray[0];
  	var two= myArray[1];
	var pcode= parseFloat($('#row_id_'+div_id).val());
  	var k = parseFloat(pcode);
  	var m = parseFloat(k+1);
  	var tmp =div_id+'_ptr'+k;
  	var tmp2 ='mybody_'+div_id;
  	var tmp3 =div_id+'_ptr'+m;
  
  	 $('#'+tmp).html("<td><textarea name='sub_details"+two+"[]' id='sub_details"+div_id+k+"' class='form-control form-control-sm' ></textarea><input type='hidden' name='qty"+two+"[]' id='qty"+div_id+k+"' tabindex='10' class='form-control form-control-sm' value='1'></td><td><a title='Delete' onclick=remove_subrow('"+div_id+"','"+k+"') class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	  $('#'+tmp).after("<tr id='"+tmp3+"'></tr>");
	  $('#row_id_'+div_id).val(m);
  }
   
function get_product_info_old(append_id)
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
				document.getElementById("desc_old"+append_id).value=msg.product_description;
		}
	});
	}
}

// function get_trading_product_info_old(append_id)
// {
// 	var product_id= document.getElementById("product_id"+append_id).value;
// 	if(product_id!='')
// 	{
// 	$.ajax
// 	({
// 		url: "<?php echo site_url('Product/ajax_get_product_details'); ?>",
// 		type: 'POST',
// 		data: {product_id: product_id },
// 		dataType: "json",
// 		success: function(msg) {
// 				document.getElementById("desc"+append_id).value=msg.item_desc;
// 		}
// 	});
// 	}
// 	else
// 	{
// 		document.getElementById("desc"+append_id).value='';
// 	}
// }

function get_trading_product_info(append_id)
{
	
	var product_id= document.getElementById("product_id"+append_id).value;
	var enq_type = document.getElementById("enq_type").value;

	if(product_id!='' && (enq_type == '1' || enq_type == '3') )
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
	else if(product_id!='' && enq_type == '2')
	{
		$.ajax
		({
			url: "<?php echo site_url('Product/ajax_get_manf_product_details'); ?>",
			type: 'POST',
			data: {product_id: product_id },
			dataType: "json",
			success: function(msg) {
					document.getElementById("desc"+append_id).value=msg.item_desc;
					document.getElementById("manf_length"+append_id).value=msg.length;
					document.getElementById("manf_height"+append_id).value=msg.height;
					document.getElementById("manf_color"+append_id).value=msg.colour;
					
			}
		});
	}
	else
	{
		document.getElementById("desc"+append_id).value='';
	}
}
function confirmcancel(id)
{   
	var r= confirm("Are you sure you want to Delete Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Ajax/delete_record",
     		type: "POST",
     		data: {table_name:'enquiry_transaction', where_key:'trans_id', where_val:id} ,
     		success: function(msg) {
     			if(msg==1) 
     			{     	
			         alert("Record deleted"); 				
        			 window.location.href="<?php echo $_SERVER['PHP_SELF']?>";   		                    		  
			}
		        else {
			      	alert("Can't Delete record. Data already used!!!");
		       }
		    },
		});
      		return true;
      	}
        else
        	return false;
	    	
}

function p_check() {
	var checked= $('input[name="select_checkbox[]"]:checked').length;

	if (checked > 0) {
		document.getElementById("convert_excel").disabled=false;
		document.getElementById("rfq_div").style.display='block';
		$('#supplier_id').attr('required', true);   
	}
	else {
		document.getElementById("convert_excel").disabled=true;
		document.getElementById("rfq_div").style.display='none';
		$('#supplier_id').attr('required', false);   
	}
	
	var allVals = [];
	$(".case:checked").each(function() {
		allVals.push($(this).val());
	});
	document.getElementById("selected_tr").value=allVals;
}
// if all checkbox are selected, check the selectall checkbox and viceversa

$('#selectall').click(function(event) {
	var checked= $('input[name="select_checkbox[]"]:checked');

	if(this.checked) {
		// Iterate each checkbox
		$('.case:checkbox').each(function() {
			this.checked = true;
			document.getElementById("convert_excel").disabled=false;
			document.getElementById("rfq_div").style.display='block';
			$('#supplier_id').attr('required', true);   
		});
	}
	else {
		$('.case:checkbox').each(function() {
			this.checked = false;
			document.getElementById("convert_excel").disabled=true;
			document.getElementById("rfq_div").style.display='none';
			$('#supplier_id').attr('required', false);   
		});
	}

	$('.case').on('click',function(){
		if($('.case:checked').length == $('.case').length){
			$('#select_checkbox').prop('checked',true);
		}else{
			$('#select_checkbox').prop('checked',false);
		}
	});
	
	var allVals = [];
	$(".case:checked").each(function() {
		allVals.push($(this).val());
	});
	document.getElementById("selected_tr").value=allVals;
});

function add_supllier_id() {
	var sid= document.getElementById("supplier_id").value;
	var user_id= document.getElementById("user_id").value;
	document.getElementById("sales_person").value=user_id;
	if(sid=='')
	{
		alert('Please Select Supplier');
		return false;
	}
	else
	{
	//var pterm= document.getElementById("term1").value;
	//var dterm= document.getElementById("term2").value;
	var remark= document.getElementById("terms").value;
	 document.getElementById("supp_id").value=sid;
	// document.getElementById("pterm").value=pterm;
	// document.getElementById("dterm").value=dterm;
	 document.getElementById("remark").value=remark;
	 return true;
	 }
}
</script>
