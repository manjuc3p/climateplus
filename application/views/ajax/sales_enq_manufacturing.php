<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
			    <tr>
			    	    <!-- <th width='10%'>Sr</th>  -->
			    	    <th width='20%'>Select Items</th> 
						<th width='20%'>Description</th> 
                        <th width='20%'>Length(MM)</th> 
                        <th width='20%'>Height(MM)</th> 
                        <th width='20%'>Colour</th> 
			    	    <th width='20%'>Quantity</th>
			    	    <th width='10%'><a id=<?php if($enq_type =='1') echo "add_row1";else if($enq_type =='3') echo "add_row3";else if($enq_type =='2') echo "add_row2";?> title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a></th>
				</tr>
			    </thead>		 
		 	    
			    <tbody id="mytbbody">
				<tr id='addr0'>

				<!-- <td><input type="text" name="srn[]" id="srn0" tabindex='10' class="form-control form-control-sm" value="1" readonly> -->
					</td>
					<td>
						<select tabindex="11" class="form-select form-control-sm select2" id="product_id0" name="product_id[]"  onchange='get_trading_product_info(0)' >
						<option value="">Select</option>
						<?php foreach($products as $s) {?>
						  <option value="<?php echo $s->product_id; ?>"><?php echo $s->product_id; ?></option>
						<?php } ?>
					      </select>
						
					</td>
					<td><input type="text" name="desc[]" id="desc0" tabindex='16' class="form-control form-control-sm" placeholder="" readonly="true"></td>
                    <td><input type="number" name="manf_length[]" id="manf_length0" tabindex='14' class="form-control form-control-sm" placeholder="" ></td>
					<td><input type="number" name="manf_height[]" id="manf_height0" tabindex='15' class="form-control form-control-sm" placeholder="" ></td>
					<td><input type="text" name="manf_color[]" id="manf_color0" tabindex='16' class="form-control form-control-sm" placeholder="" ></td>
					<td><input type="number" name="manf_qty[]" id="manf_qty0" tabindex='17' class="form-control form-control-sm" placeholder="" ></td>				
					<td><a id='delete_row' title="Delete" onclick='remove_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>

				</tr>
				<tr id='addr1'></tr>
			</tbody>
		</table>