<div class="card-body">
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_packing_list_data" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Select DO <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4" role='group'>
				<select tabindex="1" class="form-select form-control-sm select2" id="do_id" name="do_id" required onchange="get_delivery_order_info()" >
				<option value="">Select</option>
				<?php foreach($records as $s) {?>
				  <option value="<?php echo $s->dc_id; ?>"><?php echo $s->dc_code.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
    	     		 </div>
		</div>
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">PL date <span style="color: red;"> * </span></label>
		    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
				<div class="input-group date ">			                  
		    			<input type="text" class="form-control form-control-sm " id="invdate" name="invdate" value="<?php echo date('d-m-Y')?>" required tabindex='3' readonly>
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			      	</div>
    	     		 </div>

	     	    <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label"></label>
	     	    <label class="col-xs-12 col-sm-1 col-md-2 col-lg-2 col-form-label">PL Code <span style="color: red;"> * </span></label>
	    	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3">
			      <input type="text" name="pl_code" id="pl_code" class="form-control form-control-sm "  tabindex='4' value="<?php echo $code; ?>">
		     </div>
		</div>
		
		
		
		<div id="item_list_id"> 
		</div>
		
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
			<button type="submit"  tabindex="6"  id="add" class="btn btn-primary m-b-0">Generate PL</button>
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
function get_delivery_order_info()
{
	var do_id = document.getElementById("do_id").value;	
   	if(do_id!='')
   	{
	   	$.ajax({
	   	async:"false",
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_dc_info",
		data: {do_id:do_id} ,
		success: function(msg){
			document.getElementById('item_list_id').innerHTML=msg;
		     }
		});
	}
}
function get_do_with_case()
{
	var do_id = document.getElementById("do_id").value;	
	var case_no = document.getElementById("case_no").value;	
   	if(do_id!='')
   	{
	   	$.ajax({
	   	async:"false",
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_dc_info2",
		data: {do_id:do_id, case_no:case_no} ,
		success: function(msg){
			document.getElementById('item_list_id').innerHTML=msg;
		     }
		});
	}
}
</script>
