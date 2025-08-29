<?php $this->load->helper('stock_helper.php');?>
<div class="card-body">
	<form  id="main1" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_delivery_challan" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Select Tax Invoice <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4" role='group'>
				<select tabindex="1" class="form-select form-control-sm select2" id="qid" name="qid" required onchange="this.form.submit()" >
				<option value="">Select</option>
				<?php foreach($records as $s) {?>
				  <option <?php if($s->invoice_id==$qid) echo 'selected'; ?> value="<?php echo $s->invoice_id; ?>"><?php echo $s->invoice_code.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
    	     		 </div>
		</div>
	</form>
	<form onsubmit="return check_selected_stock();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_dc_data" autocomplete="off" >	
		
		<?php
	foreach($records1 as $row) { ?>	
        
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">DC date <span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date ">			                  
		    			<input type="text" class="form-control form-control-sm " id="invdate" name="invdate" value="<?php echo date('d-m-Y')?>" required tabindex='3' readonly>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>

	     	    <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label"></label>
	     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">DC Code <span style="color: red;"> * </span></label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			      <input type="text" name="dc_code" id="dc_code" class="form-control form-control-sm" tabindex='4' value="<?php if($row->inv_type=='DI') echo str_replace('DI','D-DO',$row->invoice_code); else echo str_replace('TI','DO',$row->invoice_code); ?>">
		     </div>
		</div>
		
	<div class="form-group row" >
		<table class="table table-bordered table-hover" id="tab_logic">
		<thead>
		<tr>
	    	    	<th>Description</th>      
	    	    	<th>Quantity</th>     
	    	    	<th>
				<a id="add_row" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a>
			</th> 
		</tr>
		</thead>
	        <tbody id="mytbbody">
		<?php $i=5000; foreach($records2 as $r) { ?>
		<tr id="addr<?php echo $i;?>" style="background-color:#94C973!important; font-weight:bold">
			<td>
				<textarea rows='4' cols='40' name="desc[]" id="desc<?php echo $i;?>" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm" tabindex='5' required><?php echo $r->item_desc;?></textarea>
			</td>
			<td>	
				<input type="number" name="qty[]" id="qty<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" value="<?php echo $r->quantity;?>" onkeyup="calculate_total('<?php echo $i;?>')" tabindex='8'>
			</td>
			<td>
				<input type="hidden" name="total[]" id="total<?php echo $i;?>" value="<?php echo $r->total;?>" class="form-control bg-soft-gray form-control-sm subItemAmt" readonly required>
				<input type="text" name="item_remark[]" id="item_remark<?php echo $i;?>" tabindex='10' class="form-control form-control-sm" placeholder="remark" value="<?php echo $r->item_remark;?>">
				
				<input type="hidden"  name="mainqty[]" value="<?php echo $r->quantity;?>" >
				<input type="hidden"  name="product_id[]" value="<?php echo $r->product_id;?>" >
				<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
				<input type="hidden"  name="append_id[]" value="<?php echo $i;?>" >
				<br>
				<a id='delete_row' title="Delete" onclick='remove_row("<?php echo $i;?>")' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
			</td>
		</tr>
		
		<?php  $i++; } ?>
		<tr id='addr1'></tr>
		</tbody>
	</table>
	</div>
	
	<input type="hidden"  name="invoice_id" value="<?php echo $row->invoice_id;?>" >
	<input type="hidden"  name="warehouse_id" value="<?php echo $warehouse_id;?>" >
	<input type="hidden"  name="enq_id" value="<?php echo $row->enq_id;?>" >
	<input type="hidden"  name="quote_id" value="<?php echo $row->quote_id;?>" >
	<input type="hidden"  name="customer_id" value="<?php echo $row->customer_id;?>" >
	<input type="hidden"  name="stamp" value="<?php echo $row->stamp_id;?>" >
		
	<?php } ?>
	<h4>Stock Issued:</h4>
		
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
			<button type="submit"  tabindex="6"  id="add" class="btn btn-primary m-b-0">Generate DC</button>
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
	var i=1;
	/*function add_new_row(rowId)
	{
	     $('#stock_addr'+rowId+i).html("<td>"+(i+1)+"</td><td><select class='form-select form-control-sm select2' name='bill_entry"+rowId+"[]' id='bill_entry"+rowId+i+"' required ><option value=''>Select</option><?php  foreach($bill_entry as $s) {?><option value='<?php echo $s->stk_id; ?>'><?php echo 'stock Code: '.$s->model_code.' Bill: '.$s->bill_no.' Order Ref:'.$s->order_ref_no.' Box no:'.$s->box_no.' ('.$s->stock.')';?></option><?php } ?></select></td><td>Quantity<br><input type='number' name='qty"+rowId+"[]' id='qty"+rowId+i+"' tabindex='22' class='form-control form-control-sm' placeholder=''  required></td>>");
	    $('#mytbbody'+rowId+' tr:last').after('<tr id="stock_addr'+rowId+(i+1)+'"></tr>');
	      i++; 	     	
	     $('.select2').select2({ width: "520px" });
	}
        $("#delete_row").click(function(){
    		 if(i>1){
			 $("#stock_addr"+rowId+(i-1)).html('');
			 i--;
		 }
	 });
   */
function add_new_row(rowId)
{
	var model_code = document.getElementById("model_code"+rowId).value;	
	var warehouse_id = document.getElementById("warehouse_id").value;	
	var order_code = document.getElementById("order_code"+rowId).value;		
	var rowcount = document.getElementById("rowcount"+rowId).value;	
	var newcnt= 	parseInt(rowcount)+1;
	document.getElementById("rowcount"+rowId).value=newcnt;	
	
   	if(model_code!='')
   	{
	   	$.ajax({
	   	async:"false",
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_model_wise_stock_list",
		data: {model_code:model_code, rowId:rowId, warehouse_id:warehouse_id, order_code:order_code, newcnt:newcnt} ,
		success: function(msg){
			//document.getElementById('stock_addr'+rowId+rowcount).innerHTML=msg;
			$('#stock_addr'+rowId+rowcount).replaceWith(msg);
		     }
		});
	}
}
 function remove_row(append_id)
   {    	 
        $('#tr_row'+append_id).attr("id","tr_row"+append_id+"x");
        $('#tr_row'+append_id+"x").remove();
   }
function get_invoice_info()
{
	var qid = document.getElementById("qid").value;	
	var case_no = document.getElementById("case_no").value;	
   	if(qid!='')
   	{
	   	$.ajax({
	   	async:"false",
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_invoice_info",
		data: {qid:qid, case_no:case_no} ,
		success: function(msg){
			document.getElementById('item_list_id').innerHTML=msg;
		     }
		});
	}
}
 function remove_row(append_id)
   {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
       
   }
</script>
