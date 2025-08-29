<div class="form-group row">	
<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Customer Name<span style="color: red;"> * </span></label>
<div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
<?php foreach($records1 as $r) {
	$cust_name= $r->cust_name;	
	echo '<input type="text" class="form-control" name="customer_id" id="customer_id" value="'.$cust_name.'">';	
	}?>
</div>
</div>


<div class="dt-responsive">
	
		<table class="table table-bordered table-hover" id="tab_logic">
			   <thead>
				<tr>
			            <th>Sr.No</th>
			            <th>Description</th>
			            <th>Quantity</th>       
						<th><a id="add_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
				</tr>
			    </thead>		 
			    <tbody id="mytbbody">
					
				<?php 
				if (!empty($records2)){
				$i=1; foreach($records2 as $s) {?>
				
				<tr id='addr0'>
					<td><input type="text" name="srn[]" id="srn<?php echo $i;?>" readonly class="form-control form-control-sm" placeholder="" value="<?php echo $i;?>"></td>
					<td><input type="text"  name="prod_desc[]" id="job_desc<?php echo $i;?>" class="form-control  form-control-sm" placeholder="Enter Job description Here" value="<?php echo $s->product_description;?>"></td> 
					<td><input type="number" name="prod_qty[]" id="job_qty<?php echo $i;?>"  class="form-control form-control-sm" value="<?php echo $s->quantity;?>"></td>
					<td>
						<a onclick='remove_row1(0)' title="Delete" class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a>
					</td>
				</tr>
			    <?php }$i++;} ?>

				
				<tr id='addr1'></tr>
			</tbody>
		</table>	
	        </div> 

	
	
	</script>