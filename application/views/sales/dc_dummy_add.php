<div class="card-body">
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_dummy_dc_data" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">DC date <span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date datepicker1">			                  
		    			<input type="text" class="form-control form-control-sm datepicker1" id="invdate" name="invdate" value="<?php echo date('d-m-Y')?>" required tabindex='3'>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>

	     	    <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label"></label>
	     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">DC Code <span style="color: red;"> * </span></label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			      <input type="text" name="dc_code" id="dc_code" class="form-control form-control-sm" tabindex='4' value="<?php echo $code; ?>">
		     </div>
		</div>
		
	<?php foreach($records1 as $row) { ?>	
	<div class="form-group row ">
	     	    <label class="col-xs-12 col-sm-1 col-md-3 col-lg-2 col-form-label">Case Required<span style="color: red;"> * </span></label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-2">
			      <input type="number" name="case_no" id="case_no" class="form-control form-control-sm bg-soft-gray" tabindex='5' value="<?php echo $row->total_case; ?>" onkeyup="get_do_with_case()" readonly>
		     </div>
	     	    <label class="col-xs-12 col-sm-1 col-md-3 col-lg-2 col-form-label">Packing Type<span style="color: red;"> * </span></label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-2">
			      <select tabindex="1" class="form-select form-control-sm select2" id="ptype" name="ptype" required >
				<option value="">Select</option>
				<?php foreach($packing_list as $s) {?>
				  <option <?php if($row->packing_id==$s->sno) echo 'selected'; ?> value="<?php echo $s->sno; ?>"><?php echo $s->ptype;?></option>
				<?php } ?>
			      </select>
		     </div>
	     	    <label class="col-xs-12 col-sm-1 col-md-3 col-lg-2 col-form-label">Volume Unit<span style="color: red;"> * </span></label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-2">
			      <select tabindex="1" class="form-select form-control-sm select2" id="unit" name="unit" required >
				<option value="">Select</option>
				<option <?php if($row->volume_unit=='CM') echo 'selected'; ?> value="CM">CM</option>
				<option <?php if($row->volume_unit=='CBM') echo 'selected'; ?> value="CBM">CBM</option>
			      </select>
		     </div>
		</div>
	
	<div class="form-group row" >
	<table class="table table-bordered table-hover" id="tab_logic">
		<thead>
		<tr>
		    <th title="Item">Srn</th>   
		    <th title="Item">Order code</th>   
		    <th title="Item">Ordered Quantity</th>     
		    <th title="Item">Packed Quantity</th> 
		    <th title="Item">Delete</th>  
		</tr>
		</thead>
		<?php $i=5000; foreach($records2 as $r) { ?>
		<tr id="addr<?php echo $i;?>">
			<td><input type="text"  name="srn[]" id="srn<?php echo $i;?>" class="form-control bg-soft-gray form-control-sm" required value="<?php echo $r->srn;?>" readonly>
			<td><input type="text"  name="order_code[]" id="order_code<?php echo $i;?>" class="form-control bg-soft-gray form-control-sm" required value="<?php echo $r->order_code;?>" readonly>
			<br><textarea rows='7' cols='30' name="desc[]" id="desc<?php echo $i;?>"  class="form-control form-control-sm bg-soft-gray" readonly required><?php echo $r->item_desc;?></textarea></td>
			<td width='100px'><input type="number" name="qty[]" id="qty<?php echo $i;?>"  class="form-control form-control-sm bg-soft-gray" value="<?php echo $r->quantity;?>" readonly>
			<td width='100px'><input type="number" name="delivered_qty[]" id="delivered_qty<?php echo $i;?>"   class="form-control form-control-sm" value="<?php echo $r->quantity;?>" >			
			<td>
				<a id='delete_row' title="Delete" onclick='remove_row(<?php echo $tr->case_no.$i;?>)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
			</td>			
			<input type="hidden"  name="size[]" value="<?php echo $r->size;?>" >			
			<input type="hidden"  name="trans_id[]" value="<?php echo $r->tr_id;?>" >	
			<input type="hidden"  name="type[]" value="<?php echo $r->delivery_status;?>" >
		</tr>
		<?php  $i++;  
		}?>
	</table>
	</div>
	
	<input type="hidden"  name="invoice_id" value="<?php echo $row->invoice_id;?>" >
	<input type="hidden"  name="enq_id" value="<?php echo $row->enq_id;?>" >
	<input type="hidden"  name="quote_id" value="<?php echo $row->quote_id;?>" >
	<input type="hidden"  name="customer_id" value="<?php echo $row->customer_id;?>" >
	
	<?php foreach($records3 as $tr) { ?>	
	<h6>Details For Case <?php echo $tr->case_no ?></h6>
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Net Wt(Kgs)</label>
	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2" >         
		<input type="text" class="form-control form-control-sm " id="netwt" name="netwt[]" value="<?php echo $tr->net_wt;?>" >
 	    </div>
     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">Gross Wt (Kgs)</label>
    	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		      <input type="text" name="gramwt[]" id="gramwt" class="form-control form-control-sm" value="<?php echo $tr->gross_wt;?>" >
	     </div>
     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">Volume(cm)</label>
    	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
		      <input type="text" name="volume[]" id="volume" class="form-control form-control-sm"  value="<?php echo $tr->volume;?>" > 
		      
			<input type="hidden"  name="case[]" value="<?php echo $tr->case_no;?>" >
	     </div>
	</div>	
	
	<div class="form-group row">
	    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Diamentions</label>
	    <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4" >         
		<input type="text" class="form-control form-control-sm " id="diamentions" name="diamentions[]" value="<?php echo $tr->diamention;?>">
	</div>
<?php } 
}?>
		
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
			<button type="submit"  tabindex="6"  id="add" class="btn btn-primary m-b-0">Generate Dummy DC</button>
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
 function remove_row(append_id)
   {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
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

function get_inv_code()
{
	var type = document.getElementById("inv_type").value;
	$.ajax({
		type: "POST",
		url:"<?php echo base_url()?>index.php/Sales/get_invoice_code",
		data: {type:type} ,
		success: function(msg){	  
			document.getElementById("invcode").value=msg;
		     }
	});
}
</script>
