<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
			    <tr>
			    	    <th width='10%'>Sr</th> 
			    	    <th width='60%'>Select Items</th> 
			    	    <th width='20%'>Quantity</th>
			    	    <th width='10%'><a id=<?php if($enq_type =='1') echo "add_row1";else if($enq_type =='3') echo "add_row3";?> title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a></th>
				</tr>
			    </thead>		 
			    
			    <tbody id="mytbbody">
				<tr id='addr0'>
					<td><input type="text" name="srn[]" id="srn0" tabindex='10' class="form-control form-control-sm" value="1" readonly>
					</td>
					<td>
						<select tabindex="11" class="form-select form-control-sm select2" id="product_id0" name="product_id[]" style="width:400px;">
						<option value="">Select</option>
						<?php foreach($products as $s) {?>
						  <option value="<?php echo $s->product_id; ?>"><?php echo $s->product_description;?></option>
						<?php } ?>
					      </select>
						
					</td>
					<td><input type="number" name="trading_qty[]" id="trading_qty0" tabindex='14' class="form-control form-control-sm" placeholder="" ></td>
					
					
					<td><a id='delete_row' title="Delete" onclick='remove_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
				</tr>
				<tr id='addr1'></tr>
			</tbody>
		</table>