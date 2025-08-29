<div class="card-body">
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_job_card_records" id="addform" autocomplete="off" enctype="multipart/form-data" onSubmit="formsubmit();">
	<div class="form-group row">		 
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Quotation<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-9 col-md-6 col-lg-4">
		    <select name="quot_id" id="quot_id" class="form-control select2" required onchange='get_quotation_info()' tabindex='1'>
			    <option value="">Please select name</option>
			    <?php foreach($records as $s) {?>
				<option value="<?php echo $s->quote_id ?>"><?php echo $s->quotation_code.' '.$s->cust_name;?></option>
			    <?php } ?>
		    </select>
		</div>
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job card date<span style="color: red;"> * </span>:</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
			<div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id='carddate' name='carddate' value="<?php echo date('d-m-Y')?>" required tabindex='3'>
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		      	</div>
	     </div>
		
	</div><div class="form-group row">	
	 	<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project Name:</label>
	    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-2">
		     <input type="text" name="project_name" id="project_name" required />
	    </div> 	 
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project Status<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-2 col-md-6 col-lg-2">
		    <select name="pstatus" id="pstatus" class="form-control" required tabindex='2'>
			    <option value="">Select</option>
			    <option value="Not Started">Not Started</option>
			    <option value="Pending">Pending</option>
			    <option value="In Progres">In Progress</option>
			    <option value="Ready for FA">Ready for FAT</option>
		    </select>
		</div>
		 
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Nature of Job</label>
	    <div class="col-xs-12 col-sm-2 col-md-6 col-lg-2">
		    <select name="job_nature" id="pstatus" class="form-control" tabindex='3'>
			    <option value="">Select</option>
			    <option value="HVAC">HVAC</option>
			    <option value="MEP">MEP</option>
			    <option value="Grills & Diffusers">Grills & Diffusers</option>
			    <option value="Flexible Duct/Duct Connectors">Flexible Duct/Duct Connectors</option>
				<option value="Others">Others</option>
		    </select>
		</div>
	</div>
	

	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job card Code<span style="color: red;"> * </span>:</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-2">
		      <input type="text" id='code' name='code' class="form-control date_today" value="<?php echo $code; ?>" required readonly>
	    </div> 	    
	    
		    
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project Start Date:</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-2" role='group'>
			<div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id='start_date' name='start_date' value="<?php echo date('d-m-Y')?>" required tabindex='4'>
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		      	</div>
	     </div>
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project End Date:</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-2" role='group'>
			<div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id='end_date' name='end_date' value="" required tabindex='5'>
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		      	</div>
	     </div>    
	</div>
	
	<div class="form-group row">	    
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Remark (If any):</label>
	    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-6">
		     <textarea name='note' id='note' class='form-control' rows='2'></textarea>
	    </div> 
	</div>

	<h4>Details</h4>
	<div class="form-group row" id="item_list_id">
	   	 
	    </div>

	  
	  
	  
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
			<input type="hidden" id='revision' name='revision' class="form-control" >
			
			<input type="hidden" id='jpack_id' name='jpack_id' class="form-control" >
			<input type="hidden" id='enquiry_id' name='enquiry_id' class="form-control" >

			<button type="submit" tabindex='14' class="btn btn-primary m-b-0">Submit</button>
			<button type="reset"  tabindex='15' id='reset' class="btn btn-primary m-b-0">Reset</button>
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
		     $('#addr'+i).html("<td><input type='text' name='srn[]' id='srn"+i+"' tabindex='18' class='form-control form-control-sm' placeholder='' ></td><td><input type='text'  name='prod_desc[]' id='prod_desc"+i+"' class='form-control  form-control-sm'></td><td><input type='number' name='prod_qty[]' id='prod_qty"+i+"'  class='form-control form-control-sm'></td><td><a onclick='remove_row1(0)' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");		    
		    	$('#mytbbody tr:first').after('<tr id="addr'+(i+1)+'"></tr>');
			i++; 
			
		});
		$("#delete_row").click(function(){
	    		 if(i>1){
				 $("#addr"+(i-1)).html('');
				 i--;
			 }
		 });
   });

   
function remove_row1(append_id)
  {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
  }
  
  function get_quotation_info()
{
	var qid = document.getElementById("quot_id").value;	
   	if(qid!='')
   	{
	   	$.ajax({
	   	async:"false",
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_quotation_for_joborder",
		data: {qid:qid} ,
		success: function(msg){
			document.getElementById('item_list_id').innerHTML=msg;
			}
		});
		    
	}
}

function calcualate_total_duration(append_id)
{
	var time1 = $("#stime"+append_id).val().split(':'), time2 = $("#etime"+append_id).val().split(':');
                    var hours1 = parseInt(time1[0], 10),
                    hours2 = parseInt(time2[0], 10),
                    
                    mins1 = parseInt(time1[1], 10),
                    mins2 = parseInt(time2[1], 10);
		    var showhour;
                    var hours = hours2 - hours1, mins = 0;
                    if (hours < 0) hours = 24 + hours;
                    if (mins2 >= mins1) {
                        mins = mins2 - mins1;
                    }
                    else {
                        mins = (mins2 + 60) - mins1;
                        hours--;
                    }
                    //mins = mins / 60; 
                    //hours += mins;
                    hours = hours.toFixed(0);
		    showhour = hours+':'+mins;
		$("#total_time"+append_id).val(showhour);
}
function calculate_total(field_name, append_id)
{
	var price = parseFloat(document.getElementById(field_name+"_price"+append_id).value);
	var quantity = parseFloat(document.getElementById(field_name+"_qty"+append_id).value);
	var total = price*quantity;
	document.getElementById(field_name+"_total"+append_id).value=parseFloat(total).toFixed(2);

	
}
</script>


