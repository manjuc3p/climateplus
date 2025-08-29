<div class="card-body">
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/update_jobcard_data" id="addform" autocomplete="off" enctype="multipart/form-data" >
<?php  
foreach($records1 as $row) :?>

	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job card Date <span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	      <input type="text" id='card_date' name='card_date' class="form-control" value="<?php echo date('d-M-Y',strtotime($row->card_date)); ?>" readonly="TRUE" required>
	      </div>
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job card Code <span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	      <input type="text" id='jcode' name='jcode' class="form-control" value="<?php echo $row->jcode; ?>" readonly="TRUE" required>
	      </div>
		  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Quotation ID <span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	      <input type="text" id='quot_id' name='quot_id' class="form-control" value="<?php echo $row->quot_master_id; ?>" readonly="TRUE" required>
	      </div>
		  <input type="hidden" name="jcard_id" id="jcard_id" value="<?php echo $row->jcard_id; ?>"/>
		  <input type="hidden" id='customer_id' name='customer_id' class="form-control" >
	</div>
	
	
	<div class="form-group row">
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project Name:</label>
	    <div class="col-xs-12 col-sm-10 col-md-6 col-lg-2">
		     <input type="text" class="form-control" name="project_name" id="project_name" required />
	    </div> 	 
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project Start Date<span style="color: red;"> * </span>:</label>
	    <div class="col-xs-12 col-sm-10 col-md-2 col-lg-2">
		      <input type="text" id='start_date' name='start_date' class="form-control date_today" value="<?php echo date('d-M-Y',strtotime($row->job_start_date)); ?>" readonly>
	    </div>
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project End Date<span style="color: red;"> * </span>:</label>
	    <div class="col-xs-12 col-sm-10 col-md-2 col-lg-2">
		     <input type="text" id='end_date' name='end_date' class="form-control date_today" value="<?php echo date('d-M-Y',strtotime($row->job_end_date)); ?>" readonly>
	    </div>
		
	</div>
	
	<div class="form-group row">
	   
	<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project Status :</label>
	    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
	     	<select name="pstatus" id="pstatus" class="form-control" required >
			    <option <?php if($row->status=='Not Started') echo 'selected';?> value="Not Started">Not Started</option>
			    <option <?php if($row->status=='Pending') echo 'selected';?> value="Pending">Pending</option>
			    <option <?php if($row->status=='In Progres') echo 'selected';?> value="In Progres">In Progress</option>
			    <option <?php if($row->status=='Ready for FA') echo 'selected';?> value="Ready for FA">Ready for FAT</option>
		    </select>
	      </div>
		  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Nature of Job</label>
	    <div class="col-xs-12 col-sm-2 col-md-6 col-lg-3">
		    <select name="job_nature" id="pstatus" class="form-control" tabindex='3'>
			   
			    <option <?php if($row->status=='HVAC') echo 'selected';?> value="HVAC">HVAC</option>
			    <option <?php if($row->status=='MEP') echo 'selected';?> value="MEP">MEP</option>
			    <option <?php if($row->status=='Grills & Diffusers') echo 'selected';?> value="Grills & Diffusers">Grills & Diffusers</option>
			    <option <?php if($row->status=='Flexible Duct/Duct Connectors') echo 'selected';?> value="Flexible Duct/Duct Connectors">Flexible Duct/Duct Connectors</option>
				<option <?php if($row->status=='Others') echo 'selected';?> value="Others">Others</option>
		    </select>
		</div>
	</div>

	<h4>Details</h4>
	<div class="form-group row" >
		<table class="table table-bordered table-hover" id="tab_logic">
		<thead>
		<tr>
		<tr>
			<th>Sr.No</th>
			<th>Description</th>
			<th>Quantity</th>       
			<th><a id="add_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
		</tr>
		</thead>
	        <tbody id="mytbbody">
			<?php if (!empty($records2)){
				$i=1; foreach($records2 as $s) {?>
				
				<tr id='addr0'>
					<td><input type="text" name="srn[]" id="srn<?php echo $i;?>" readonly class="form-control form-control-sm" placeholder="" value="<?php echo $i;?>"></td>
					<td><input type="text"  name="prod_desc[]" id="job_desc<?php echo $i;?>" class="form-control  form-control-sm" placeholder="Enter Job description Here" value="<?php echo $s->prod_description;?>"></td> 
					<td><input type="number" name="prod_qty[]" id="job_qty<?php echo $i;?>"  class="form-control form-control-sm" value="<?php echo $s->prod_qty;?>"></td>
					<td>
						<a onclick='remove_row1(0)' title="Delete" class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
			    <?php }$i++;} ?>

				
				<tr id='addr1'></tr>
		</tbody>
	</table>
	</div>
	
<input type="hidden"  name="jcard_id" value="<?php echo $row->jcard_id;?>" >



<div class="form-group row">
<label class="col-sm-2"></label>
<div class="col-sm-10">
	<button type="submit" id='edit' class="btn btn-primary m-b-0">Update</button>
	<button type="reset"  id='reset' class="btn btn-primary m-b-0">Reset</button>
	<button class="btn btn-primary m-b-0" onclick="goBack()">Back</button>
</div>
</div>	
<?php endforeach; ?>
</form>

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
   
function remove_row(append_id)
  {
	//$("#MY_addr"+append_id).html('');
	//getElementById("addr"+append_id).id = "addr"+append_id+'x';
	//jQuery(this).prev("li").attr("id","newId");.
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
	calculate_grand_total();
  }
 function call_help()
 {
    $('#indent-Modal').modal('show');
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

</script>
