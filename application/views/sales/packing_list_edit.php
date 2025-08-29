<div class="card-body">
	<?php foreach($records1 as $row) { ?>
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Sales/update_packing_list_data" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-3 col-lg-3 col-form-label"> Quotations & Customer <span style="color: red;"> * </span></label>
	  		<label class="col-xs-12 col-sm-2 col-md-7 col-lg-7 col-form-label">
				<?php echo $row->quotation_code.' '.$row->cust_name;?>
    	     		 </label>
		</div>
		
		
		<div class="form-group row">	    
			    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Inspection date<span style="color: red;"> * </span>:</label>
			    <div class="col-xs-12 col-sm-9 col-md-3 col-lg-3" role='group'>
					<div class="input-group date datepicker1">			                  
			    			<input type="text" class="form-control form-control-sm datepicker1" id='Inspectiondate' name='Inspectiondate' value="<?php echo date('d-m-Y',strtotime($row->inspection_date))?>" required tabindex='2'>
						<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				      	</div>
			     </div>
			    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">LIST OF PANELS FOR INSPECTION<span style="color: red;"> * </span> </label>
			    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
			      <input type="text" name="PANELS" id="PANELS"  class="form-control" value="<?php echo $row->no_of_panels;?>"  required/>
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
		<?php $count=count($records2);
		$i=1;
		foreach($records2 as $tr) {
		if($i=='1'){ ?>
		<tr>
			<td>1</td>
			<td>Dimension of the enclosures - 1000H x 800W x 250D</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='2'){ ?>
		<tr>
			<td>2</td>
			<td>Enclosure Color RAL 7032</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='3'){ ?>
		<tr>
			<td>3</td>
			<td>Ingress protection (IP65)</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='4'){ ?>
		<tr>
			<td>4</td>
			<td>Size of cables as per the approved wiring drawing</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='5'){ ?>
		<tr>
			<td>5</td>
			<td>Availability of earth strip</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='6'){ ?>
		<tr>
			<td>6</td>
			<td>Clearance & Creep age distance</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='7'){ ?>
		<tr>
			<td>7</td>
			<td>Visual inspection of Firmness of connections</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='8'){ ?>
		<tr>
			<td>8</td>
			<td>Visual inspection of Door Locks, & Hinges</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='9'){ ?>
		<tr>
			<td>9</td>
			<td>Visual inspection of Name plates, Component labels</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='10'){ ?>
		<tr>
			<td>10</td>
			<td>Protection of internal cables & wires</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='11'){ ?>
		<tr>
			<td>11</td>
			<td>Earthing of doors </td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='12'){ ?>
		<tr>
			<td>12</td>
			<td>Sizing, Marking & identification of terminals</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='13'){ ?>
		<tr>
			<td>13</td>
			<td>Gland plate details - check Top/Bottom entry</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='14'){ ?>
		<tr>
			<td>14</td>
			<td>Color coding, identification & marking of cables,</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='15'){ ?>
		<tr>
			<td>15</td>
			<td>Reachability and accessibility if terminals & connections</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='16'){ ?>
		<tr>
			<td>16</td>
			<td>Rating, Breaking capacity as per the specification, major components</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='17'){ ?>
		<tr>
			<td>17</td>
			<td>Make of Major components as per BOM</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='18'){ ?>
		<tr>
			<td>18</td>
			<td>Identification of component</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='19'){ ?>
		<tr>
			<td>19</td>
			<td>Bill of Material as per approved drawing</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='20'){ ?>
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
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='21'){ ?>
		<tr>
			<td>2</td>
			<td>Function Test of Three Pole, 20A, 10kA MCBs </td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='22'){ ?>
		<tr>
			<td>3</td>
			<td>Function Test of Single Pole, 20A, 10kA MCBs </td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='23'){ ?>
		<tr>
			<td>4</td>
			<td>Function Test of Four Pole, 40A, 30mA ELCBs</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='24'){ ?>
		<tr>
			<td>5</td>
			<td>Function Test of 14 pin Plug in relays With Base</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='25'){ ?>
		<tr>
			<td>6</td>
			<td>Function Test of 24 Hours Timer</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='26'){ ?>
		<tr>
			<td>7</td>
			<td>Function Test of Three pole 9A, contactor</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='27'){ ?>
		<tr>
			<td>8</td>
			<td>Function Test of Overload relay</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='28'){ ?>
		<tr>
			<td>9</td>
			<td>Function Test of Control Transformer</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='29'){ ?>
		<tr>
			<td>10</td>
			<td>Function Test of Selector switches</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='30'){ ?>
		<tr>
			<td>11</td>
			<td>Function Test of Indication lamps</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='31'){ ?>
		<tr>
			<td>12</td>
			<td>Manual operations of components.</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='32'){ ?>
		<tr>
			<td>13</td>
			<td>Drawing, Manual & Documentation.</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } 
		if($i=='33'){ ?>
		<tr>
			<td>14</td>
			<td>Protection of Live Parts.</td>
			<td>
				<select name="test_result[]" class="form-control rating" required>
				    <option <?php if($tr->finished_status=='1') echo 'selected';?> value="1">Finished</option>
				    <option <?php if($tr->finished_status=='2') echo 'selected';?> value="2">Not Finished</option>
				</select>
			</td>
			<td><textarea name='testremark[]' ><?php echo $tr->finished_remark;?></textarea></td>
		</tr>
		<?php } $i++; } ?>
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
				<option <?php if($r->img_id==$row->stamp_id) echo 'selected';?> value="<?php echo $r->img_id;?>" ><?php echo $r->stamp_name;?></option>
			        <?php } ?>
			      </select>
		       	</div>
		 </div>	
		 
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
			<input type="hidden" id='customer_id' name='customer_id' class="form-control" value='<?php echo $row->customer_id;?>'>
			<input type="hidden" id='fat_id' name='fat_id' value='<?php echo $row->fat_id;?>' class="form-control" >
			<button type="submit"  tabindex="6"  id="add" class="btn btn-primary m-b-0">Generate FAT</button>
			</div>
		</div>
	    </form>

	   <?php } ?>
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
