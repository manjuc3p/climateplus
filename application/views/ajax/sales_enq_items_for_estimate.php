<?php $this->load->helper('stock_helper.php');

foreach($records as $res1)
{
   if($res1->enq_type=='1'||$res1->enq_type=='3')
   {?>
	<table class="table table-bordered table-hover" id="tab_logic">
		<thead>
		<tr>
		   
		    <th width='40%'>Description</th>      
		    <th width='20%'></th>  
			<th width='20%'>Margin</th>   
		    <th width='20%'>Total</th>   
		    <th></th>  
		</tr>
		</thead>	
 		<?php $i=5000; foreach($records2 as $r) { ?>
		<tr id="addr<?php echo $i;?>" style=" font-weight:bold">
			
			<td width='40%'>
				<select tabindex="11" class="form-select form-control-sm select2" name="product_id[]" id="product_id<?php echo $i; ?>" style="width:400px;" onchange='get_trading_product_info(<?php echo $i; ?>)'>
				<option value="">Select</option>
				<?php foreach($products as $s) {?>
			  	<option <?php if($s->product_id==$r->product_id) echo 'selected';?> value="<?php echo $s->product_id; ?>"><?php echo $s->product_description;?></option>
				<?php } ?>
		      	</select>
				
			</td>
			<td width='20%'>	
				<span>Qty:</span>
				<input type="number" name="qty[]" id="qty<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" value="<?php echo $r->quantity;?>" onchange="calculate_total('<?php echo $i;?>')">
			<br>
				<span>Price:</span>
				<input type="number" step='0.01' name="price[]" id="price<?php echo $i;?>" class="form-control form-control-sm"  onchange="calculate_total('<?php echo $i;?>')" value="<?php echo $r->unit_price;?>" tabindex='9' required><br>
			</td>
			<td width='20%'>	
				<input type="number" step='0.01' name="dis_per[]" id="dis_per<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" placeholder="0%" onchange="calculate_discount(event,'<?php echo $i;?>')">
			<br>
				<input type="number" step='0.01' name="dis_val[]" id="dis_val<?php echo $i;?>" class="form-control form-control-sm"  onchange="calculate_discount(event,'<?php echo $i;?>')" value=0 tabindex='9'><br>
			</td>
			<td width='20%'>
				<input type="number" name="total[]" id="total<?php echo $i;?>" value="<?php echo $r->unit_price*$r->quantity;?>"  class="form-control bg-soft-gray form-control-sm subItemAmt" readonly required><br>
				
			</td>
			<td>
				
				
				<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
				<input type="hidden"  name="append_id[]" value="<?php echo $i;?>" >
				<br>
				<a id='delete_row' title="Delete" onclick='remove_row("<?php echo $i;?>")' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
			</td>
		</tr>	
		<?php $i++; } ?>
	   	<tbody id="mytbbody"> 
			<tr id='addr1'></tr>
	        </tbody>	
		</table>
<?php }
else   //manufacturing
{?>
	<!--<a id="add_row1" title="Add" class="btn btn-sm bg-orange" >Add Main Heading<span class="fa fa-plus"></span></a>-->
	
	<?php $i=5000; 
	//echo '<pre>';print_r($records2);exit;
	
	foreach($records2 as $r) { ?>
	<div class="form-group row"  id='product_div<?php echo $i; ?>'>
	<table class="table table-bordered table-hover"  id="pdetails<?php echo $i; ?>">
    		<thead>
		<tr>
		   <!-- <th>Sr </th>  -->
		    <th width='30%'>Description</th>  
			<th>Length(MM)</th> 
			<th>Height(MM)</th> 
			<th>Colour</th>     
		    <th>Quantity</th>  
		    <th>Margin</th>     
		    <th>Total</th>   
		    <th></th>  
		</tr>
		</thead>
		<tr id="addr<?php echo $i;?>" style=" font-weight:bold">
		<td width='30%'>
				<select tabindex="11" class="form-select form-control-sm select2" name="desc[]" id="desc<?php echo $i; ?>" style="width:400px;" onchange='get_trading_product_info(<?php echo $i; ?>)' disabled>
				<option value="">Select</option>
				<?php foreach($products as $s) {?>
			  	<option <?php if($s->product_id==$r->product_id) echo 'selected';?> value="<?php echo $s->product_id; ?>"><?php echo $s->product_description;?></option>
				<?php } ?>
		      	</select>
				
				
			</td>
			<!-- <td>
				<br><textarea rows='4' cols='40'  name="desc[]" id="desc<?php //echo $i;?>" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm"  required><?php //echo $r->product_description;?></textarea>
			</td> -->
			<td>	
				<input type="number" name="manf_length[]" id="manf_length<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" value="<?php echo $r->manf_length;?>" >
			</td>
			<td>	
				<input type="number" name="manf_height[]" id="manf_height<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" value="<?php echo $r->manf_height;?>" >
			</td>
			<td>	
				<input type="text" name="manf_color[]" id="manf_color<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" value="<?php echo $r->manf_color;?>">
			</td>
			

			<td width='20%'>	
				<span>Qty:</span>
				<input type="number" name="qty[]" id="qty<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" value="<?php echo $r->quantity;?>" onchange="calculate_total('<?php echo $i;?>')">
			<br>
				<span>Price:</span>
				<input type="number" step='0.01' name="price[]" id="price<?php echo $i;?>" class="form-control form-control-sm"  onchange="calculate_total('<?php echo $i;?>')" value="<?php echo $r->unit_price;?>" tabindex='9' required><br>
			</td>
			<td width='20%'>	
				<input type="number" name="mar_per[]" id="mar_per<?php echo $i;?>"  class="form-control bg-soft-gray form-control-sm" placeholder="0%" onchange="calculate_margin(event,'<?php echo $i;?>')">
			<br>
				<input type="number" name="mar_val[]" id="mar_val<?php echo $i;?>" class="form-control form-control-sm"  onchange="calculate_margin(event,'<?php echo $i;?>')" value=0 tabindex='9'><br>
			</td>
			<td width='20%'>
				<input type="number" name="total[]" id="total<?php echo $i;?>" value="<?php echo $r->unit_price*$r->quantity;?>"  class="form-control bg-soft-gray form-control-sm subItemAmt" readonly required><br>
				
			</td>




			<td>
				<input type="hidden"  name="item_file_name[]" value="<?php //echo $r->file_name;?>" >
				<input type="hidden"  name="product_id[]" value="<?php echo $r->product_id;?>" >
				<input type="hidden"  name="trans_id[]" value="<?php echo $r->trans_id;?>" >
				<input type="hidden"  name="append_id[]" value="<?php echo $i;?>" >
				<br>
				<?php 
				$apendid=0; foreach($trans_records2 as $t) { if($t->trans_id1==$r->trans_id) $apendid++; }?>
				<input type="hidden" id="row_id_d<?php echo $i; ?>"  value='<?php echo $apendid; ?>' />
				<input type="hidden" name="product_div_value[]"  value="<?php echo $i; ?>" />
				<!-- <a onclick="add_nxt_row('<?php// echo "d".$i; ?>',<?php //echo $apendid; ?>)" title="Add" class="btn btn-sm bg-orange" ><span class="fa fa-plus"></span></a> -->
	    			<a  title="Delete" onclick="remove_product_div(<?php echo $i; ?>)" class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
    			</td>
		</tr>
		<?php $k=0; if($trans_records2){?>
		<tr>
			<td colspan='6'>
				<table width='100%'>
				<?php foreach($trans_records2 as $t) :
				if($t->trans_id1==$r->trans_id){?>
				<tr id="<?php echo 'd'.$i.'_ptr'.$k; ?>" >
					<td>
						<textarea rows='3' cols='10'  name="sub_details<?php echo $i;?>[]" id="sub_detailsd<?php echo $i.$k;?>" style="font-size:11px; font-weight:bold;" class="form-control form-control-sm"  required><?php echo $t->sub_details;?></textarea>
					</td>
					<td align='center'>
						<input type="hidden" name="qty<?php echo $i;?>[]" id="qty<?php echo $i.$k;?>" tabindex='10' class="form-control form-control-sm" value="<?php echo $t->qty;?>">
					<a title="Delete" onclick="remove_subrow('<?php echo "d".$i; ?>',<?php echo $k; ?>)" class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
				<?php  $k++;  } endforeach; ?>
		 		<tr id="<?php echo 'd'.$i.'_ptr'.$k; ?>" ></tr>
				</table>
			</td>
		</tr>
		<?php } 
		echo "</table></div>";
		$i++; } ?>
<?php }
}?>

