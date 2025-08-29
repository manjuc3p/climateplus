<div class="card-body">
<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_job_card_records" id="addform" autocomplete="off" enctype="multipart/form-data" onSubmit="formsubmit();">
	<div class="form-group row">		 
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Quotation<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
		    <select name="quot_id" id="quot_id" class="form-control select2" required onchange='get_info()' tabindex='1'>
			    <option value="">Please select name</option>
			    <?php foreach($records as $s) {?>
				<option value="<?php echo $s->quote_id ?>"><?php echo $s->quotation_code.' '.$s->cust_name;?></option>
			    <?php } ?>
		    </select>
		</div>
	</div><div class="form-group row">		 
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project Status<span style="color: red;"> * </span></label>
	    <div class="col-xs-12 col-sm-2 col-md-6 col-lg-4">
		    <select name="pstatus" id="pstatus" class="form-control" required tabindex='2'>
			    <option value="">Select</option>
			    <option value="Not Started">Not Started</option>
			    <option value="Pending">Pending</option>
			    <option value="In Progres">In Progress</option>
			    <option value="Ready for FA">Ready for FAT</option>
		    </select>
		</div>
		 
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Nature of Job</label>
	    <div class="col-xs-12 col-sm-2 col-md-6 col-lg-4">
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
	<!-- <div class="form-group row" >
	    <div class="col-md-12">
		<div class="dt-responsive">
		<table class='bg-c-green' width='100%' cellspacing="0" colspacing="0" border='1' >
			<tr>
				<th  style="background-color:#cccccc!important;">Customer</th>
				<th  style="background-color:#cccccc!important;">Project</th>
				<th  style="background-color:#cccccc!important;">Location</th>
				<th  style="background-color:#cccccc!important;">Quotation</th>
			</tr>
			<tr>
				<th  style="background-color:#cccccc!important;"><label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label" id="cust_name"> </label></th>
				<th  style="background-color:#cccccc!important;"><label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label" id="project_name"> </label></th>
				<th  style="background-color:#cccccc!important;"><label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label" id="location"> </label></th>
				<th  style="background-color:#cccccc!important;"><label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label" id="qcode"> </label></th>
				<th  style="background-color:#cccccc!important;"><label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label" id="enqcode"> </label></th>
			</tr>
		</table>
		</div>
	   </div>
	</div> -->

	<div class="form-group row">
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job card Code<span style="color: red;"> * </span>:</label>
	    <div class="col-xs-12 col-sm-10 col-md-2 col-lg-2">
		      <input type="text" id='code' name='code' class="form-control date_today" value="<?php echo $Code; ?>" required readonly>
	    </div> 	    
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job card date<span style="color: red;"> * </span>:</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
			<div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id='carddate' name='carddate' value="<?php echo date('d-m-Y')?>" required tabindex='3'>
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		      	</div>
	     </div>
	</div>
	
	<div class="form-group row">	    
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project Start Date:</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
			<div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id='start_date' name='start_date' value="<?php echo date('d-m-Y')?>" required tabindex='4'>
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		      	</div>
	     </div>
	    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Project End Date:</label>
	    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
			<div class="input-group date datepicker1">			                  
	    			<input type="text" class="form-control form-control-sm datepicker1" id='end_date' name='end_date' value="<?php echo date('d-m-Y')?>" required tabindex='5'>
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

	<h4>Work Details</h4>
	<div class="form-group row">
		<div class="dt-responsive">
		<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
				<tr>
			            <th>Employee/Labour</th>
			            <th>Select Work Date</th>
			            <th>Work Desc</th>
			            <th>Time</th>
			            <th>Total Time</th>
			            <th>Remark<a id="add_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
				</tr>
			    </thead>		 
			    <tbody id="mytbbody">
				<tr id='addr0'>
					<td width=300>						
					      <select name="employee_id[]" id="employee_id0" class="form-control select2" tabindex='6'>
					      <option value="">Please Employee</option>
					      <?php foreach($user_records as $g) {?>
						  <option value="<?php echo $g->user_id ?>"><?php echo $g->user_name;?> </option>
					      <?php } ?>
					      </select>
					</td>
					<td>
							<div class="input-group date datepicker1">			                  
					    			<input type="text" class="form-control form-control-sm datepicker1" id='emp_start_date0' name='emp_start_date[]' value="<?php echo date('d-m-Y')?>" tabindex='6'>
								<div class="input-group-addon"></div>
						      	</div>
     		     			</td> 
					<td>
						<textarea name='production_desc[]' id='production_desc0' class='form-control' tabindex='6' rows='3' cols='30'></textarea>
					</td>
					<td>
		       				<div class="col-xs-12 col-sm-9 col-md-12 col-lg-12">		                  
				    			<input type='time' id='stime0' name='stime[]' class="form-control form-control-sm" value='<?php echo date('H:i'); ?>' onblur='calcualate_total_duration(0)' tabindex='6'>
				    			<br>
				    			<input type="time" class="form-control form-control-sm" id="etime0" name="etime[]" value='<?php echo date('H:i'); ?>' onblur='calcualate_total_duration(0)' tabindex='6'>
			     		     </div>
		       			</td>  
					<td>
		       				<input type='text' id='total_time0' name='total_time[]' class='form-control'  readonly>
	       				</td>  
					
					<td>
						<textarea name='remark[]' id='remark0' class='form-control' rows='2' tabindex='6'></textarea>
						<a onclick='remove_row1(0)' title="Delete" class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
				<tr id='addr1'></tr>
			</tbody>
		</table>	
	        </div>    	 
	    </div>

	   <h4>Manpower</h4>
	   <div class="form-group row">
		<div class="dt-responsive">
		<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
				<tr>
			            <th>Employee/Labour</th>
			            <th>Select Work Date</th>
			            <th>No of emp</th>
			            <th>Per employee</th>
			            <th>Total Amount</th>
			            <th>Remark<a id="add_mrow" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
				</tr>
			    </thead>		 
			    <tbody id="man_tbbody">
				<tr id='maddr0'>
					<td width=300>						
					      <select name="memp_id[]" id="memp_id0" class="form-control select2" tabindex='7'>
					      <option value="">Please Employee</option>
					      <?php foreach($user_records as $g) {?>
						  <option value="<?php echo $g->user_id ?>"><?php echo $g->user_name;?> </option>
					      <?php } ?>
					      </select>
					</td>
					<td>
							<div class="input-group date datepicker1">			                  
					    			<input type="text" class="form-control form-control-sm datepicker1" id='emp_start_date0' name='emp_start_date[]' value="<?php echo date('d-m-Y')?>" tabindex='7'>
								<div class="input-group-addon"></div>
						      	</div>
						      	Designation
						      	<input type='text' name='desig[]' id='desig0' class='form-control' rows='2' tabindex='7'>
     		     			</td> 
					<td>
		       				<div class="col-xs-12 col-sm-9 col-md-12 col-lg-12">		                  
			    			<input type='number'  min=0 value=0 id='m_qty0' name='m_qty[]' class="form-control form-control-sm"  tabindex='7' onblur="calculate_total('m', 0)">
			     		     </div>
		       			</td>  
					<td>
		       				<div class="col-xs-12 col-sm-9 col-md-12 col-lg-12">		                  
			    			<input type='number' step='0.01' min=0 value=0 step='any' class="form-control form-control-sm" id="m_price0" name="m_price[]"  tabindex='7' onblur="calculate_total('m', 0)">
			     		      </div>
		       			</td>  
					<td>
		       				<input type='text' id='m_total0' name='m_total[]' class='form-control'  readonly tabindex='7'>
	       				</td>  
					
					<td>
						<textarea name='empremark[]' id='empremark0' class='form-control' rows='2' tabindex='7'></textarea>
						<a onclick='remove_row2(0)'  title="Delete" class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
				<tr id='maddr1'></tr>
			</tbody>
		</table>	
	        </div>    	 
	    </div>
	    
	    <h4>Transportation</h4>
	<div class="form-group row">
		<div class="dt-responsive">
		<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
				<tr>
			            <th>Transportation Date</th>
			            <th>Car</th>
			            <th>No of cars</th>
			            <th>Per Car Amt</th>
			            <th>Total Amount</th>
			            <th>Remark<a id="add_trow" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
				</tr>
			    </thead>		 
			    <tbody id="transport_body">
				<tr id='taddr0'>
					<td>
						<div class="input-group date datepicker1">			                  
				    			<input type="text" class="form-control form-control-sm datepicker1" id='t_date0' name='t_date[]' value="<?php echo date('d-m-Y')?>"  tabindex='8'>
							<div class="input-group-addon"></div>
					      	</div>
     		     			</td> 
					<td width=300>						
					      <input type='text' id='temp0' name='temp[]' class="form-control form-control-sm"  tabindex='8'>
					</td>
					<td>
						<input type='number' id='t_qty0' name='t_qty[]' class="form-control form-control-sm"  tabindex='8' value=0 onblur="calculate_total('t', 0)">
					</td>
					
					<td>
		       				<div class="col-xs-12 col-sm-9 col-md-12 col-lg-12">		                  
				    			<input type='number' step='0.01' id='t_price0' name='t_price[]' class="form-control form-control-sm" value=0 tabindex='8'  onblur="calculate_total('t', 0)">
			     		     </div>
		       			</td>    
					<td>
		       				<input type='text' id='t_total0' name='t_total0[]' class='form-control'  readonly>
	       				</td>  
					
					<td>
						<textarea name='tremark[]' id='tremark0' class='form-control' rows='2' tabindex='8'></textarea>
						<a onclick='remove_row3(0)'  title="Delete" class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
				<tr id='taddr1'></tr>
			</tbody>
		</table>	
	        </div>    	 
	    </div>
	    <h4>Parking Expences</h4>
	<div class="form-group row">
		<div class="dt-responsive">
		<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
				<tr>
			             <th>Parking Exp Date</th>
			            <th>Car</th>
			            <th>No of cars</th>
			            <th>Per Car Amt</th>
			            <th>Total Amount</th>
			            <th>Remark<a id="add_crow" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
				</tr>
			    </thead>		 
			    <tbody id="car_tbbody">
				<tr id='caddr0'>
					<td>
						<div class="input-group date datepicker1">			                  
				    			<input type="text" class="form-control form-control-sm datepicker1" id='c_date0' name='c_date[]' value="<?php echo date('d-m-Y')?>"  tabindex='9'>
							<div class="input-group-addon"></div>
					      	</div>
     		     			</td> 
					<td width=300>						
					      <input type='text' id='cemp0' name='cemp[]' class="form-control form-control-sm"  tabindex='9'>
					</td>
					<td>
						<input type='number' min=0 id='c_qty0' name='c_qty[]' class="form-control form-control-sm"  tabindex='9' onblur="calculate_total('c', 0)" value=0>
					</td>
					
					<td>
		       				<div class="col-xs-12 col-sm-9 col-md-12 col-lg-12">		                  
				    			<input type='number' step='0.01' min=0 id='c_price0' name='c_price[]' class="form-control form-control-sm"  tabindex='9' onblur="calculate_total('c', 0)" value=0>
			     		     </div>
		       			</td>    
					<td>
		       				<input type='text' id='c_total0' name='c_total[]' class='form-control'  readonly>
	       				</td>  
					
					<td>
						<textarea name='cremark[]' id='cremark0' class='form-control' rows='2' tabindex='9'></textarea>
						<a onclick='remove_row4(0)' title="Delete" class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
				<tr id='caddr1'></tr>
			</tbody>
		</table>	
	        </div>    	 
	    </div>
	    <h4>Gatepass Freezone</h4>
	<div class="form-group row">
		<div class="dt-responsive">
		<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
				<tr>
			            <th>Select Work Date</th>
			            <th>Employee/Labour</th>
			            <th>No of employee</th>
			            <th>Per employee</th>
			            <th>Total Amount</th>
			            <th>Remark
			            <a id="add_grow" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
				</tr>
			    </thead>		 
			    <tbody id="gate_tbbody">
				<tr id='gaddr0'>
					<td>
						<div class="input-group date datepicker1">			                  
				    			<input type="text" class="form-control form-control-sm datepicker1" id='g_date0' name='g_date[]' value="<?php echo date('d-m-Y')?>"  tabindex='10'>
							<div class="input-group-addon"></div>
					      	</div>
     		     			</td> 
					<td width=300>						
					      <input type='text' id='gemp0' name='gemp[]' class="form-control form-control-sm" tabindex='10'>
					</td>
					<td>
						<input type='number' tabindex='10' min=0  id='g_qty0' name='g_qty[]' class="form-control form-control-sm" onblur="calculate_total('g', 0)" value=0>
					</td>
					
					<td>
		       				<div class="col-xs-12 col-sm-9 col-md-12 col-lg-12">		                  
			    			<input type='number' value=0 step='0.01' min=0  id='g_price0' name='g_price[]' class="form-control form-control-sm" tabindex='10' onblur="calculate_total('g', 0)">
			     		     </div>
		       			</td>    
					<td>
		       				<input type='text' id='g_total0' name='g_total[]' class='form-control'  readonly>
	       				</td>  
					
					<td>
						<textarea name='gremark[]' id='gremark0' class='form-control' rows='2'tabindex='10'></textarea>
					
						<a onclick='remove_row5(0)' title="Delete" class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
				<tr id='gaddr1'></tr>
			</tbody>
		</table>	
	        </div>    	 
	    </div>
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
			<input type="hidden" id='revision' name='revision' class="form-control" >
			<input type="hidden" id='customer_id' name='customer_id' class="form-control" >
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
	     $('#addr'+i).html("<td><select name='employee_id[]' id='employee_id"+i+"' class='form-control select2'><option value=''>Please Employee</option><?php foreach($user_records as $g) {?><option value='<?php echo $g->user_id ?>'><?php echo $g->user_name;?> </option><?php } ?></select></td><td><input type='text' id='emp_start_date"+i+"' name='emp_start_date[]' class='form-control date_today' value='<?php echo date('d-M-Y'); ?>'></td><td><textarea name='production_desc[]' id='production_desc"+i+"' class='form-control' rows='3' cols='30'></textarea></td><td><input type='time' id='stime"+i+"' name='stime[]' class='form-control' value='<?php echo date('H:i'); ?>'><br><input type='time' id='etime"+i+"' name='etime[]' class='form-control' value='<?php echo date('H:i'); ?>' onblur='calcualate_total_duration("+i+")'></td><td><input type='text' id='total_time"+i+"' name='total_time[]' class='form-control' value='' readonly></td><td><textarea name='remark[]' id='remark"+i+"' class='form-control' rows='2'></textarea><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange'><span class='fa fa-trash'></span></a></td>");		    
	    	$('#mytbbody tr:first').after('<tr id="addr'+(i+1)+'"></tr>');
		i++; 
		$('.select2').select2();	
		$('.date_today').datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:"true",
			//endDate:"today",
			toggleActive:"true",
			autoclose:true,
		});
	});
	
	var j=1;
	$("#add_mrow").click(function()
	{			
	     $('#maddr'+j).html("<td width=300><select name='memp_id[]' id='memp_id"+j+"' class='form-control select2' tabindex='7'><option value=''>Please Employee</option><?php foreach($user_records as $g) {?><option value='<?php echo $g->user_id ?>'><?php echo $g->user_name;?> </option><?php } ?></select></td><td><div class='input-group date datepicker1'><input type='text' class='form-control form-control-sm datepicker1' id='m_date"+j+"' name='m_date[]' value='<?php echo date('d-m-Y')?>' tabindex='7'><div class='input-group-addon'></div></div>Designation<input type='text' name='desig[]' id='desig"+j+"' class='form-control' rows='2' tabindex='7'></td><td><input type='number' min=0 onblur=calculate_total('m',"+j+") value=0 id='m_qty"+j+"' name='m_qty[]' class='form-control form-control-sm' tabindex='7'></td> <td><input type='number' step='0.01' min=0  step='any' class='form-control form-control-sm' id='m_price"+j+"' name='m_price[]' onblur=calculate_total('m',"+j+") value=0 tabindex='7'></td> <td><input type='text' id='m_total"+j+"' name='m_total[]' class='form-control' readonly tabindex='7'></td> <td><textarea name='empremark[]' id='empremark"+j+"' class='form-control' rows='2' tabindex='7'></textarea><a onclick='remove_row2("+j+")'  title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");		    
	    	$('#man_tbbody tr:first').after('<tr id="maddr'+(j+1)+'"></tr>');
		j++; 	
		$('.date_today').datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:"true",
			//endDate:"today",
			toggleActive:"true",
			autoclose:true,
		});
		$('.select2').select2();
	});
	
	//// transport
	var k=1;
	$("#add_trow").click(function()
	{			
	     $('#taddr'+k).html("<td><div class='input-group date datepicker1'><input type='text' class='form-control form-control-sm datepicker1' id='t_date"+k+"' name='t_date[]' value='<?php echo date('d-m-Y')?>' tabindex='7'><div class='input-group-addon'></div></div></td><td width=300><input type='text' id='temp"+k+"' name='temp[]' class='form-control form-control-sm'  tabindex='8'></td><td><input type='number' value=0 min=0 onblur=calculate_total('t',"+k+") id='t_qty"+k+"' name='t_qty[]' class='form-control form-control-sm'  tabindex='7'></td> <td><input type='number' step='0.01' min=0  step='any' class='form-control form-control-sm' id='t_price"+k+"' name='t_price[]' onblur=calculate_total('t',"+k+") value=0 tabindex='7'></td> <td><input type='text' id='t_total"+k+"' name='t_total[]' class='form-control'  readonly tabindex='7'></td> <td><textarea name='tremark[]' id='tremark"+k+"' class='form-control' rows='2' tabindex='7'></textarea><a onclick='remove_row2("+k+")'  title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");		    
	    	$('#transport_tbbody tr:first').after('<tr id="taddr'+(k+1)+'"></tr>');
		k++; 	
		$('.date_today').datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:"true",
			//endDate:"today",
			toggleActive:"true",
			autoclose:true,
		});
	});
	//// parking car
	var c=1;
	$("#add_crow").click(function()
	{			
	     $('#caddr'+c).html("<td><div class='input-group date datepicker1'><input type='text' class='form-control form-control-sm datepicker1' id='c_date"+c+"' name='c_date[]' value='<?php echo date('d-m-Y')?>' tabindex='7'><div class='input-group-addon'></div></div></td><td width=300><input type='text' id='cemp"+c+"' name='cemp[]' class='form-control form-control-sm'  tabindex='8'></td><td><input type='number' value=0 min=0 onblur=calculate_total('c',"+c+") id='c_qty"+c+"' name='c_qty[]' class='form-control form-control-sm'  tabindex='7'></td> <td><input type='number' step='0.01' min=0  step='any' class='form-control form-control-sm' id='c_price"+c+"' name='c_price[]' onblur=calculate_total('c',"+c+") value=0 tabindex='7'></td> <td><input type='text' id='c_total"+c+"' name='c_total[]' class='form-control'  readonly tabindex='7'></td> <td><textarea name='cremark[]' id='cremark"+c+"' class='form-control' rows='2' tabindex='7'></textarea><a onclick='remove_row2("+c+")'  title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");		    
	    	$('#car_tbbody tr:first').after('<tr id="caddr'+(c+1)+'"></tr>');
		c++; 	
		$('.date_today').datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:"true",
			//endDate:"today",
			toggleActive:"true",
			autoclose:true,
		});
	});
	//// parking car
	var g=1;
	$("#add_grow").click(function()
	{			
	     $('#gaddr'+g).html("<td><div class='input-group date datepicker1'><input type='text' class='form-control form-control-sm datepicker1' id='g_date"+g+"' name='g_date[]' value='<?php echo date('d-m-Y')?>' tabindex='7'><div class='input-group-addon'></div></div></td><td width=300><input type='text' id='gemp"+g+"' name='gemp[]' class='form-control form-control-sm'  tabindex='8'></td><td><input type='number' value=0 min=0 onblur=calculate_total('g',"+g+") id='g_qty"+g+"' name='g_qty[]' class='form-control form-control-sm'  tabindex='7'></td> <td><input type='number' step='0.01' min=0  step='any' class='form-control form-control-sm' id='g_price"+g+"' name='g_price[]' onblur=calculate_total('g',"+g+") value=0 tabindex='7'></td> <td><input type='text' id='g_total"+g+"' name='g_total[]' class='form-control'  readonly tabindex='7'></td> <td><textarea name='cremark[]' id='cremark"+g+"' class='form-control' rows='2' tabindex='7'></textarea><a onclick='remove_row2("+g+")'  title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");		    
	    	$('#gate_tbbody tr:first').after('<tr id="gaddr'+(g+1)+'"></tr>');
		g++; 	
		$('.date_today').datepicker({
			format: "dd-mm-yyyy",
			todayHighlight:"true",
			//endDate:"today",
			toggleActive:"true",
			autoclose:true,
		});
	});
	
   });
   
function remove_row1(append_id)
  {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
  }
  function remove_row2(append_id)
  {    	 
        $('#maddr'+append_id).attr("id","maddr"+append_id+"x");
        $('#maddr'+append_id+"x").remove();
  }
  function remove_row3(append_id)
  {    	 
        $('#taddr'+append_id).attr("id","taddr"+append_id+"x");
        $('#taddr'+append_id+"x").remove();
  }
  function remove_row4(append_id)
  {    	 
        $('#caddr'+append_id).attr("id","caddr"+append_id+"x");
        $('#caddr'+append_id+"x").remove();
  }
  function remove_row5(append_id)
  {    	 
        $('#gaddr'+append_id).attr("id","gaddr"+append_id+"x");
        $('#gaddr'+append_id+"x").remove();
  }
 function get_info() 
 {
   	var id = document.getElementById("quot_id").value;	
	   	$.ajax({
		type: "POST",
		url:"<?php echo base_url()?>index.php/Ajax/ajax_get_quotation",
		data: {post_id:id} ,
		dataType: "json",
		success: function(msg){	  
			document.getElementById("revision").value=msg.revision;
			document.getElementById("customer_id").value=msg.customer_id;
			document.getElementById("cust_name").innerHTML=msg.customer_name;
			document.getElementById("project_name").innerHTML=msg.project_name;
			document.getElementById("location").innerHTML=msg.location;
			document.getElementById("enquiry_id").innerHTML=msg.enq_master_id;
			var sd = msg.project_start_date;
			if(sd=='01-Jan-1970') sd='';
			var ed = msg.project_end_date;
			if(ed=='01-Jan-1970') ed='';
			document.getElementById("start_date").value=sd;
			document.getElementById("end_date").value=ed;
			//document.getElementById("qdate").innerHTML=msg.quotation_date;
			 
			var url1= 'index.php/Sales/edit_quotation/'+msg.quot_id+'/'+msg.revision+'/0';
			
			var x = '<u><a target="blank" href="<?php echo base_url()?>' + url1 + '">'+msg.quotation_code+'</a>  <br>'+msg.quotation_date+'</u>';
			document.getElementById("qcode").innerHTML=x;
		     }
		});
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


