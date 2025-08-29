<div class="card-body">
	<?php foreach($records1 as $row) { ?>
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/update_dc_data" autocomplete="off" enctype="multipart/form-data">
		      
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">DC date <span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date datepicker1">			                  
		    			<input type="text" class="form-control form-control-sm bg-soft-gray" id="invdate" name="invdate" value="<?php echo date('d-m-Y',strtotime($row->dc_date))?>" required tabindex='3' readonly>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>

	     	    <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label"></label>
	     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">DC Code <span style="color: red;"> * </span></label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			      <input type="text" name="dc_code" id="dc_code" class="form-control form-control-sm  bg-soft-gray" tabindex='4' value="<?php echo $row->dc_code; ?>" readonly>
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
			<td><input type="text"  name="srn[]" id="srn<?php echo $i;?>" class="form-control bg-soft-gray form-control-sm" required value="<?php echo $r->srn;?>" readonly><br>
			Stock Code
				<textarea rows='2' cols='25' style="font-size:13px;" name="model_code[]" id="model_code<?php echo $i;?>" class="form-control form-control-sm" ><?php echo $r->size.$r->order_code;?></textarea>
			</td>
			<td><input type="text"  name="order_code[]" id="order_code<?php echo $i;?>" class="form-control bg-soft-gray form-control-sm" required value="<?php echo $r->order_code;?>" readonly>
			<br><textarea rows='7' cols='30' name="desc[]" id="desc<?php echo $i;?>"  class="form-control form-control-sm bg-soft-gray" readonly required><?php echo $r->item_desc;?></textarea></td>
			<td width='100px'><input type="number" name="qty[]" id="qty<?php echo $i;?>"  class="form-control form-control-sm bg-soft-gray" value="<?php echo $r->quantity;?>" readonly>
			<td width='100px'><input type="number" name="delivered_qty[]" id="delivered_qty<?php echo $i;?>"   class="form-control form-control-sm  bg-soft-gray" value="<?php echo $r->quantity;?>" readonly>			
			<td>
				<a id='delete_row' title="Delete" onclick='remove_row12(<?php echo $i;?>)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
			</td>			
			<input type="hidden"  name="size[]" value="<?php echo $r->size;?>" >			
			<input type="hidden"  name="trans_id[]" value="<?php echo $r->tr_id;?>" >	
			<input type="hidden"  name="type[]" value="<?php echo $r->delivery_status;?>" >
			<input type="hidden"  name="append_trans_id[]"  value="<?php echo $i;?>" >
			<input type="hidden"  name="rowcount"  id="rowcount<?php echo $i;?>"  value="0" >
		</tr>
		
		<?php  $i++;  
		}?>
	</table>
	</div>
	
	<input type="hidden"  name="invoice_id" value="<?php echo $row->invoice_id;?>" >
	<input type="hidden"  name="enq_id" value="<?php echo $row->enq_id;?>" >
	<input type="hidden"  name="quote_id" value="<?php echo $row->quote_id;?>" >
	<input type="hidden"  name="customer_id" value="<?php echo $row->customer_id;?>" >
	<input type="hidden"  name="dc_id" value="<?php echo $row->dc_id;?>" >
	
<?php  
}?>
		
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
			<button type="submit"  tabindex="6"  id="add" class="btn btn-primary m-b-0">Update DC</button>
			</div>
		</div>
	    </form>
	    <h4>Stock Issued details:</h4>
	    <div class="card-body">
		<div class="dt-responsive table-responsive">
			<table id="datatable" class="table table-striped">
                                        <thead>
                                            <tr>
							<th>Sr.no</th>
							<th>Stock Code</th>
							<th>Bill No</th>
							<th>Order Ref</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
					<?php $i=1; foreach($issue_records as $row) :?>
						<tr>
							<td><?php echo $i;$i++;?></td>
							<td><?php //echo $row->model_code;?></td>
							<td><?php //echo $row->bill_no;?></td>
							<td><?php //echo $row->order_ref_no;?></td>
							<td><a href="javascript:confirmcancel(<?php echo $row->dc_id;?>,'0')" title="Delete" class='delete' id='delete'><?php echo $this->session->userdata('delete_icon');?></a></td>
						</tr>
					<?php endforeach; ?>
					</tbody>

				</table>
                  </div>
            </div>
                            
        </div>
    </div>
</div>
</div>
</div>
</div>

<script>
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
   
 function remove_row12(append_id)
   {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
   }
   
function confirmcancel(do_id,model_code)
{   
	var r= confirm("Are you sure you want to Delete issued Stock?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Sales/delete_issued_stock",
     		type: "POST",
     		data: {do_id:do_id, model_code:model_code} ,
     		success: function(msg) {
     			if(msg==1) 
     			{     	
			         alert("Record deleted"); 				
        			 window.location.href="<?php echo $_SERVER['PHP_SELF']?>";   		                    		  
			}
		        else {
			      	alert("Can't Delete record. Data already exist!!!");
		       }
		    },
		});
      		return true;
      	}
        else
        	return false;
	    	
}
</script>
