<?php $i=1; foreach($records2 as $r) { ?>
	<tr id="addr<?php echo $i;?>">
    
		<td>
			<input type="text" name="srn[]" id="srn<?php echo $i;?>" class="form-control form-control-sm bg-soft-gray" readonly value="<?php echo $i;?>">
		</td>
        	
        <td>
			<input type="text" name="prod_desc[]" id="prod_desc<?php echo $i;?>" class="form-control form-control-sm bg-soft-gray" readonly value="<?php echo $r->item_desc;?>">
		</td>
        <td><input type="text" name="quantity[]" id="quantity<?php echo $i;?>" class="form-control form-control-sm bg-soft-gray" readonly value="<?php echo $r->quantity;?>">
		</td>
		<td><button class="btn" onclick="deleteRow(this)"><span class="fa fa-trash"></span></button></td>
		
	</tr>
<?php  $i++; } ?>

