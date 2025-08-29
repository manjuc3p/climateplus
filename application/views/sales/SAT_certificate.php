<div class="card-body">
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_SAT_data" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Select DO <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-6">
				<select tabindex="1" class="form-select form-control-sm select2" id="dc_id" name="dc_id" required  >
				<option value="">Select</option>
				<?php foreach($records as $s) {?>
				 <option value="<?php echo $s->dc_id ?>"><?php echo $s->dc_code.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
    	     		 </div>
		</div>
		
		
		<div class="form-group row">	    
			    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Site Acceptance date<span style="color: red;"> * </span>:</label>
			    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
					<div class="input-group date datepicker1">			                  
			    			<input type="text" class="form-control form-control-sm datepicker1" id='Inspectiondate' name='Inspectiondate' value="<?php echo date('d-m-Y')?>" required tabindex='2'>
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				      	</div>
			     </div>
			    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Validation Approval <span style="color: red;"> * </span> </label>
			    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			    <select tabindex="3" class="form-select form-control-sm select2" id="validation_app" name="validation_app" required  >
				<option value="">Select</option>
				<option value="1">APPROVED</option>
				<option value="2">REJECTED</option>
			      </select>
			      
			    </div>
		 </div>	
		 <h5>LIST OF EQUIPMENT FOR TEST</h5>
		<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_logic">
			 <thead>
				    <tr>
				    	    <th>Details</th>
				    	    <th width='30px'><a id="add_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
					</tr>
				    </thead>		 
				    <tbody id="mytbbody">
					<tr id='addr0' style='font-size: 13px;'>
						<td><input type="text" name="bname[]" id="bname" tabindex='3' class="form-control" placeholder="EQUIPMENT FOR TEST"  ></td>
					
						<td width='30px'><a id='delete_row' tabindex='3' title="Delete" onclick='remove_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='addr1'  style='font-size: 13px;'></tr>
					</tbody>
				</table>
		</div>
		
		<h5>LIST OF REFERENCE DOCUMENTATION</h5>
		<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_stamp">
				   <thead>
				    <tr>
				    	    <th>Details</th>
				    	    <th width='30px'><a id="add_new_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
					</tr>
				    </thead>		 
				    <tbody id="mystamp">
					<tr id='new_addr0' style='font-size: 13px;'>
						<td><input type="text" name="image_name[]" id="image_name" tabindex='4' class="form-control" placeholder="REFERENCE DOCUMENTATION"  required></td>
						
						<td width='30px'><a id='delete_row1' tabindex='4' title="Delete" onclick='remove_stamp_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='new_addr1'  style='font-size: 13px;'></tr>
					</tbody>
				</table>
		</div>
		
		<h5>TESTS TO BE PERFORMED</h5>
		</h6>Tests to be performed may be adjusted as applicable</h6>
		<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_stamp">
				   <thead>
				    <tr>
				    	    <th>Details</th>
				    	    <th>Status/Result</th>
				    	    <th>Remark</th>
				    	    <th width='30px'><a id="add_test_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
					</tr>
				    </thead>		 
				    <tbody id="mytest">
					<tr id='new_addr0' style='font-size: 13px;'>
						<td><input type="text" name="test_name[]" id="test_name0" tabindex='5' class="form-control"  required></td>
						<td>
							<select name="test_result[]" class="form-select form-control-sm" required>
							    <option value="1">Passed</option>
							    <option value="2">Not Passed</option>
							    <option value="3">NA</option>
							    <option value="4">Approved</option>
							</select>
						</td>
						<td>
							<textarea  name="test_remark[]" id="test_remark0" tabindex='5' class="form-control"></textarea>
						</td>
						
						<td width='30px'><a id='delete_row1' title="Delete" tabindex='5' onclick='remove_test_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='test_addr1'  style='font-size: 13px;'></tr>
					</tbody>
				</table>
		</div>
		<h5>PLC Test of Digital Inputs</h5>
		</h6>The digital inputs from external objects is activated by either manually activate an external object whose activation causes a feedback signal to a digital input </h6>
		<div class="form-group row">
		  	<table class="table table-bordered table-hover  bg-soft-primary" id="tab_stamp">
				   <thead>
				    <tr>
				    	    <th>Physical address</th>
				    	    <th>Real/Set Value</th>
				    	    <th>Measured Value</th>
				    	    <th>Description</th>
				    	    <th>Approval</th>
				    	    <th width='30px'><a id="add_din_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
					</tr>
				    </thead>		 
				    <tbody id="mydin">
					<tr id='din_addr0' style='font-size: 13px;'>
						<td><input type="text" name="addr_name1[]" id="addr_name10" tabindex='6' class="form-control"  ></td>
						<td><input type="text" name="realval1[]" id="realval10" tabindex='6' class="form-control"  ></td>
						<td><input type="text" name="measuredval1[]" id="measuredval10" tabindex='6' class="form-control"  ></td>
						
						<td>
							<textarea  name="plc_remark1[]" id="plc_remark10" tabindex='6' class="form-control"></textarea>
						</td>
						<td>
							<select name="plc_result1[]" class="form-select form-control-sm" tabindex='6'>
							    <option value="Approved">Approved</option>
							    <option value="Not Approved">Not Approved</option>
							    <option value="NA">NA</option>
							</select>
						</td>
						
						<td width='30px'><a id='delete_row1' title="Delete" tabindex='6' onclick='remove_din_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='din_addr1'  style='font-size: 13px;'></tr>
					</tbody>
				</table>
		</div>
		
		
		<h5>PLC Test of Digital Outputs</h5>
		</h6>By forcing the digital outputs via the programming tool, the corresponding external objects that are connected to the digital output are activated.</h6>
		<div class="form-group row">
		  	<table class="table table-bordered table-hover bg-soft-primary" id="tab_stamp">
				   <thead>
				    <tr>
				    	    <th>Physical address</th>
				    	    <th>Real/Set Value</th>
				    	    <th>Measured Value</th>
				    	    <th>Description</th>
				    	    <th>Approval</th>
				    	    <th width='30px'><a id="add_dout_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
					</tr>
				    </thead>		 
				    <tbody id="mydout">
					<tr id='dout_addr0' style='font-size: 13px;'>
						<td><input type="text" name="addr_name2[]" id="addr_name20" tabindex='7' class="form-control"  ></td>
						<td><input type="text" name="realval2[]" id="realval20" tabindex='7' class="form-control"  ></td>
						<td><input type="text" name="measuredval2[]" id="measuredval20" tabindex='7' class="form-control"  ></td>
						
						<td>
							<textarea  name="plc_remark2[]" id="plc_remark20" tabindex='7' class="form-control"></textarea>
						</td>
						<td>
							<select name="plc_result2[]" class="form-select form-control-sm" tabindex='7'>
							    <option value="Approved">Approved</option>
							    <option value="Not Approved">Not Approved</option>
							    <option value="NA">NA</option>
							</select>
						</td>
						
						<td width='30px'><a id='delete_row1' title="Delete" tabindex='7' onclick='remove_dout_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='dout_addr1'  style='font-size: 13px;'></tr>
					</tbody>
				</table>
		</div>
		
		
		<h5>PLC Test of Analog inputs</h5>
		</h6>The analog input signals from external objects shall be verified that they are properly connected according to the documentation for manufacturing.</h6>
		<div class="form-group row">
		  	<table class="table table-bordered table-hover bg-soft-success" id="tab_stamp">
				   <thead>
				    <tr>
				    	    <th>Physical address</th>
				    	    <th>Real/Set Value</th>
				    	    <th>Measured Value</th>
				    	    <th>Description</th>
				    	    <th>Approval</th>
				    	    <th width='30px'><a id="add_ain_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
					</tr>
				    </thead>		 
				    <tbody id="myain">
					<tr id='ain_addr0' style='font-size: 13px;'>
						<td><input type="text" name="addr_name3[]" id="addr_name30" tabindex='8' class="form-control"  ></td>
						<td><input type="text" name="realval3[]" id="realval30" tabindex='8' class="form-control"  ></td>
						<td><input type="text" name="measuredval3[]" id="measuredval30" tabindex='8' class="form-control"  ></td>
						
						<td>
							<textarea  name="plc_remark3[]" id="plc_remark30" tabindex='8' class="form-control"></textarea>
						</td>
						<td>
							<select name="plc_result3[]" class="form-select form-control-sm" tabindex='8'>
							    <option value="Approved">Approved</option>
							    <option value="Not Approved">Not Approved</option>
							    <option value="NA">NA</option>
							</select>
						</td>
						
						<td width='30px'><a id='delete_row1' title="Delete" tabindex='8' onclick='remove_ain_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='ain_addr1'  style='font-size: 13px;'></tr>
					</tbody>
				</table>
		</div>
		
		<h5>PLC Test of analog Outputs</h5>
		</h6>The analog outputs to external objects shall be verified that they are properly connected according to the documentation for manufacturing. </h6>
		<div class="form-group row">
		  	<table class="table table-bordered table-hover bg-soft-success" id="tab_stamp">
				   <thead>
				    <tr>
				    	    <th>Physical address</th>
				    	    <th>Real/Set Value</th>
				    	    <th>Measured Value</th>
				    	    <th>Description</th>
				    	    <th>Approval</th>
				    	    <th width='30px'><a id="add_aout_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
					</tr>
				    </thead>		 
				    <tbody id="myaout">
					<tr id='aout_addr0' style='font-size: 13px;'>
						<td><input type="text" name="addr_name4[]" id="addr_name40" tabindex='9' class="form-control"  ></td>
						<td><input type="text" name="realval4[]" id="realval40" tabindex='9' class="form-control"  ></td>
						<td><input type="text" name="measuredval4[]" id="measuredval40" tabindex='92' class="form-control"  ></td>
						
						<td>
							<textarea  name="plc_remark14[]" id="plc_remark40" tabindex='9' class="form-control"></textarea>
						</td>
						<td>
							<select name="plc_result4[]" class="form-select form-control-sm" tabindex='9'>
							    <option value="Approved">Approved</option>
							    <option value="Not Approved">Not Approved</option>
							    <option value="NA">NA</option>
							</select>
						</td>
						
						<td width='30px'><a id='delete_row1' title="Delete" tabindex='9' onclick='remove_aout_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='aout_addr1'  style='font-size: 13px;'></tr>
					</tbody>
				</table>
		</div>
		
		<div class="form-group row">
			    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Remark </label>
			    <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
			      <textarea type="text" name="remark" id="remark" cols=30 rows=4 tabindex='14' class="form-control" placeholder="" ></textarea>
			    </div>
			    <label class="col-xs-12 col-sm-3 col-md-2 col-lg-2 col-form-label">Select Stamp</label>
	    		    <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
			      <select tabindex="2" class="form-select form-control-sm" id="stamp" name="stamp">
				<option value="">Select</option>
		    		<?php foreach($stamp_details as $r){?>
				<option <?php if($r->img_id==4) echo 'selected';?> value="<?php echo $r->img_id;?>" ><?php echo $r->stamp_name;?></option>
			        <?php } ?>
			      </select>
	       		    </div>
		 </div>	
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
			<input type="hidden" id='revision' name='revision' class="form-control" >
			<input type="hidden" id='customer_id' name='customer_id' class="form-control" >
			<input type="hidden" id='enquiry_id' name='enquiry_id' class="form-control" >
			<button type="submit"  tabindex="15"  id="add" class="btn btn-primary m-b-0">Generate SAT</button>
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
	     $('#addr'+i).html("<td><input type='text' name='bname[]' id='bname' tabindex='3' class='form-control' placeholder='EQUIPMENT FOR TEST'  ></td><td><a onclick='remove_row("+i+");' id='delete_row' title='Delete' tabindex='3' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytbbody tr:last').after('<tr  style="font-size: 13px;" id="addr'+(i+1)+'"></tr>');
	      i++; 	     	
	});
	
	 var j=1;
	$("#add_new_row").click(function()
	{
	     $('#new_addr'+j).html("<td><input type='text' name='image_name[]' id='image_name"+j+"' tabindex='4'  class='form-control' placeholder='REFERENCE DOCUMENTATION' ></td><td><a onclick='remove_stamp_row("+j+");'  tabindex='4' id='delete_row1' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mystamp tr:last').after('<tr style="font-size: 13px;" id="new_addr'+(j+1)+'"></tr>');
	      j++; 	     	
	});
	
	var k=1;
	$("#add_test_row").click(function()
	{
	     $('#test_addr'+k).html("<td><input type='text' name='test_name[]'  tabindex='5' id='test_name"+k+"' class='form-control'  ></td><td><select name='test_result[]'' id='test_result"+k+"' tabindex='5' class='form-select form-control-sm' ><option value='1'>Passed</option><option value='2'>Not Passed</option><option value='3'>NA</option><option value='4'>Approved</option></select></td><td><textarea  name='test_remark[]' id='test_remark"+k+"' tabindex='5'' class='form-control'></textarea></td><td><a onclick='remove_test_row("+k+");' id='delete_row1' title='Delete' tabindex='5' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytest tr:last').after('<tr style="font-size: 13px;" id="test_addr'+(k+1)+'"></tr>');
	      k++; 	 
	       $('.select2').select2();    	
	});
	
	
	/// plc digital input //
	var p=1;
	$("#add_din_row").click(function()
	{
	     $('#din_addr'+p).html("<td><input type='text' name='addr_name1[]' id='addr_name1"+p+"' tabindex='6' class='form-control'  ></td><td><input type='text' name='realval1[]' id='realval1"+p+"' tabindex='6' class='form-control'  ></td><td><input type='text' name='measuredval1[]' id='measuredval1"+p+"' tabindex='6' class='form-control'  ></td><td><textarea  name='plc_remark1[]' id='plc_remark1"+p+"' tabindex='6' class='form-control'></textarea></td><td><select tabindex='6' name='plc_result1[]' class='form-select form-control-sm'><option value='Approved'>Approved</option><option value='Not Approved'>Not Approved</option><option value='NA'>NA</option></select></td><td><a onclick='remove_din_row("+p+");' id='delete_row1' tabindex='6' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mydin tr:last').after('<tr style="font-size: 13px;" id="din_addr'+(p+1)+'"></tr>');
	      p++; 	 
	       $('.select2').select2();    	
	});
	
	/// plc digital output //
	var q=1;
	$("#add_dout_row").click(function()
	{
	     $('#dout_addr'+q).html("<td><input type='text' name='addr_name2[]' id='addr_name2"+q+"' tabindex='7' class='form-control'  ></td><td><input type='text' name='realval2[]' id='realval2"+q+"' tabindex='7' class='form-control'  ></td><td><input type='text' name='measuredval2[]' id='measuredval2"+q+"' tabindex='7' class='form-control'  ></td><td><textarea  name='plc_remark2[]' id='plc_remark2"+q+"' tabindex='7' class='form-control'></textarea></td><td><select tabindex='7' name='plc_result2[]' class='form-select form-control-sm'><option value='Approved'>Approved</option><option value='Not Approved'>Not Approved</option><option value='NA'>NA</option></select></td><td><a onclick='remove_dout_row("+q+");' id='delete_row1' tabindex='7' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mydout tr:last').after('<tr style="font-size: 13px;" id="dout_addr'+(q+1)+'"></tr>');
	      q++; 	 
	       $('.select2').select2();    	
	});
	
	/// plc analog input //
	var r=1;
	$("#add_ain_row").click(function()
	{
	     $('#ain_addr'+r).html("<td><input type='text' name='addr_name3[]' id='addr_name3"+r+"' tabindex='8' class='form-control'  ></td><td><input type='text' name='realval3[]' id='realval3"+r+"' tabindex='8' class='form-control'  ></td><td><input type='text' name='measuredval3[]' id='measuredval3"+r+"' tabindex='8' class='form-control'  ></td><td><textarea  name='plc_remark3[]' id='plc_remark3"+r+"' tabindex='8' class='form-control'></textarea></td><td><select name='plc_result3[]' tabindex='8' class='form-select form-control-sm'><option value='Approved'>Approved</option><option value='Not Approved'>Not Approved</option><option value='NA'>NA</option></select></td><td><a onclick='remove_ain_row("+r+");' id='delete_row1' title='Delete' tabindex='8' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#myain tr:last').after('<tr style="font-size: 13px;" id="ain_addr'+(r+1)+'"></tr>');
	      r++; 	 
	       $('.select2').select2();    	
	});
	
	/// plc analog output //
	var s=1;
	$("#add_aout_row").click(function()
	{
	     $('#aout_addr'+s).html("<td><input type='text' name='addr_name4[]' id='addr_name4"+s+"' tabindex='9' class='form-control'  ></td><td><input type='text' name='realval4[]' id='realval4"+s+"' tabindex='9' class='form-control'  ></td><td><input type='text' name='measuredval4[]' id='measuredval4"+s+"' tabindex='9' class='form-control'  ></td><td><textarea  name='plc_remark4[]' id='plc_remark4"+s+"' tabindex='9' class='form-control'></textarea></td><td><select name='plc_result4[]' tabindex='9' class='form-select form-control-sm'><option value='Approved'>Approved</option><option value='Not Approved'>Not Approved</option><option value='NA'>NA</option></select></td><td><a onclick='remove_test_row("+s+");' id='delete_row1' title='Delete' tabindex='9' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#myaout tr:last').after('<tr style="font-size: 13px;" id="aout_addr'+(s+1)+'"></tr>');
	      s++; 	 
	       $('.select2').select2();    	
	});
	
	
   });   
   function remove_row(append_id)
   {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");

        $('#addr'+append_id+"x").remove();
   }  
   function remove_stamp_row(append_id)
   {    	 
        $('#new_addr'+append_id).attr("id","new_addr"+append_id+"x");

        $('#new_addr'+append_id+"x").remove();
   }
   function remove_test_row(append_id)
   {    	 
        $('#test_addr'+append_id).attr("id","test_addr"+append_id+"x");

        $('#test_addr'+append_id+"x").remove();
   }
   //plc
   
   function remove_din_row(append_id)
   {    	 
        $('#din_addr'+append_id).attr("id","din_addr"+append_id+"x");

        $('#din_addr'+append_id+"x").remove();
   }
   
   function remove_dout_row(append_id)
   {    	 
        $('#dout_addr'+append_id).attr("id","dout_addr"+append_id+"x");

        $('#dout_addr'+append_id+"x").remove();
   }
   
   function remove_ain_row(append_id)
   {    	 
        $('#ain_addr'+append_id).attr("id","ain_addr"+append_id+"x");

        $('#ain_addr'+append_id+"x").remove();
   }
   
   function remove_aout_row(append_id)
   {    	 
        $('#aout_addr'+append_id).attr("id","aout_addr"+append_id+"x");

        $('#aout_addr'+append_id+"x").remove();
   }
</script>
