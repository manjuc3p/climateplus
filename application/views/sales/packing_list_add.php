<div class="card-body">
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/add_packing_list_data" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label">Select Quotations <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-6">
				<select tabindex="1" class="form-select form-control-sm select2" id="quot_id" name="quot_id" required onchange='get_info()' >
				<option value="">Select</option>
				<?php foreach($records as $s) {?>
				 <option value="<?php echo $s->quote_id ?>"><?php echo $s->quotation_code.' '.$s->cust_name;?></option>
				<?php } ?>
			      </select>
    	     		 </div>
		</div>
		<div class="form-group row" >
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
				</tr>
			</table>
			</div>
		   </div>
		</div>
		
		<div class="form-group row">	    
			    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Inspection date<span style="color: red;"> * </span>:</label>
			    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
					<div class="input-group date datepicker1">			                  
			    			<input type="text" class="form-control form-control-sm datepicker1" id='Inspectiondate' name='Inspectiondate' value="<?php echo date('d-m-Y')?>" required tabindex='2'>
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				      	</div>
			     </div>
			    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">LIST OF PANELS FOR INSPECTION<span style="color: red;"> * </span> </label>
			    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			      <input type="text" name="PANELS" id="PANELS"  class="form-control" value=""  required/>
			    </div>
		 </div>	
		<div class="form-group row">
		<table class='table' width='100%' border='1'>
		<thead>
		<tr>
			<td>SI.NO.</td>
			<td>SEQUENCE</td>
			<td>FINISHED</td>
			<td>REMARK</td>
		</tr>
		</thead>
		<tr style='background-color:green;'>
			<td>I</td>
			<td>VISUAL INSPECTION</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>1</td>
			<td>Dimension of the enclosures - 1000H x 800W x 250D</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>2</td>
			<td>Enclosure Color RAL 7032</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>3</td>
			<td>Ingress protection (IP65)</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>4</td>
			<td>Size of cables as per the approved wiring drawing</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>5</td>
			<td>Availability of earth strip</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>6</td>
			<td>Clearance & Creep age distance</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>7</td>
			<td>Visual inspection of Firmness of connections</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>8</td>
			<td>Visual inspection of Door Locks, & Hinges</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>9</td>
			<td>Visual inspection of Name plates, Component labels</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>10</td>
			<td>Protection of internal cables & wires</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>11</td>
			<td>Earthing of doors </td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>12</td>
			<td>Sizing, Marking & identification of terminals</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>13</td>
			<td>Gland plate details - check Top/Bottom entry</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>14</td>
			<td>Color coding, identification & marking of cables,</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>15</td>
			<td>Reachability and accessibility if terminals & connections</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>16</td>
			<td>Rating, Breaking capacity as per the specification, major components</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>17</td>
			<td>Make of Major components as per BOM</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>18</td>
			<td>Identification of component</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr>
			<td>19</td>
			<td>Bill of Material as per approved drawing</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ></textarea></td>
		</tr>
		<tr style='background-color:green;'>
			<td>II</td>
			<td>ELECTRICAL FUNCTION TEST</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>1</td>
			<td>Function Test of Main Incomer 3P, Isolator</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>2</td>
			<td>Function Test of Three Pole, 20A, 10kA MCBs </td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>3</td>
			<td>Function Test of Single Pole, 20A, 10kA MCBs </td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>4</td>
			<td>Function Test of Four Pole, 40A, 30mA ELCBs</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>5</td>
			<td>Function Test of 14 pin Plug in relays With Base</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>6</td>
			<td>Function Test of 24 Hours Timer</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>7</td>
			<td>Function Test of Three pole 9A, contactor</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>8</td>
			<td>Function Test of Overload relay</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>9</td>
			<td>Function Test of Control Transformer</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>10</td>
			<td>Function Test of Selector switches</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>11</td>
			<td>Function Test of Indication lamps</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>12</td>
			<td>Manual operations of components.</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>13</td>
			<td>Drawing, Manual & Documentation.</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		<tr>
			<td>14</td>
			<td>Protection of Live Parts.</td>
			<td>
				<select name="test_result1[]" class="form-control rating" required>
				    <option value="1">Finished</option>
				    <option value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark1[]' ></textarea></td>
		</tr>
		</table>

		</div>
		<div class="form-group row">
			    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Remark </label>
			    <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
			      <textarea type="text" name="remark" id="remark" cols=30 rows=4 tabindex='4' class="form-control" placeholder="" >This is to certify that the above panels as per the above detailed references has been inspected at #CUSTOMERNAME, and accepted for delivery, subject to compliance of observations / punch list attached herewith.</textarea>
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
			<button type="submit"  tabindex="6"  id="add" class="btn btn-primary m-b-0">Generate FAT</button>
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
			
			//document.getElementById("qdate").innerHTML=msg.quotation_date;
			 
			var url1= 'index.php/Sales/edit_quotation/'+msg.quot_id+'/'+msg.revision+'/0';
			
			var x = '<u><a target="blank" href="<?php echo base_url()?>' + url1 + '">'+msg.quotation_code+'</a>  <br>'+msg.quotation_date+'</u>';
			document.getElementById("qcode").innerHTML=x;
		     }
		});
 } 
</script>
