<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Product/update_product_data" id="addform" autocomplete="off"   enctype="multipart/form-data">
		<?php  foreach($records as $row) :?>
		
			<div class="form-group row">
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Product Category <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
	    			<input type='text' class='form-control form-control-sm' value='<?php if($row->prd_category==1) echo 'Trading'; else if($row->prd_category == 2) echo'Manufacturing';else echo 'Machine Sales'?>' />
					
	  		</div>
		</div>

		<div class="form-group row">
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Product Subcategory<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
	    			<select name="prd_type" tabindex="3" id="prd_type" class="form-control form-control-sm select2" required >
					<option value=''>Select</option>	    				
						<?php foreach($subcat as $subc) : ?>
							<option value='<?php echo $subc['category_id'];?>' <?php if($row->prd_subcat==$subc['category_id']) echo 'selected';?>><?php echo $subc['category_name'];?></option>
						<?php endforeach ?>
	    			</select>
	  		</div>
		</div>

		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Product Description <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  
			  <textarea name="desc" id="desc" rows='5' cols='40' class="form-control form-control-sm" tabindex="4" required><?php echo $row->product_description;?></textarea>
	  		</div>
		</div>
		
		<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Item Code </label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="pcode" id="pcode" class="form-control form-control-sm "  value='<?php echo $row->product_code;?>'/>
				</div>
		</div>


		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Size:</label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  <span>Length:</span><input type='number' step='0.01' tabindex="8" name="length" id="length" class="form-control form-control-sm " value="<?php echo $row->length; ?>" placeholder='0' />
					<br />
					<span>Height:</span><input type='number' step='0.01' tabindex="8" name="height" id="height" class="form-control form-control-sm " value="<?php echo $row->height; ?>" placeholder='0' />
	  		</div>
		</div>

		<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Colour </label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="colour" id="colour" class="form-control form-control-sm " value='<?php echo $row->colour_code; ?>' />
				</div>
		</div>

		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Unit Price:</label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
	    			<input type='number' step='0.01' tabindex="8" name="price" id="price" class="form-control form-control-sm " required value='<?php echo $row->unit_price; ?>' />
	  		</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
				<input type="hidden"  name="id" value="<?php echo $row->product_id;?>" >
				<button tabindex="46" type="submit" id="edit" class="btn btn-primary m-b-0">Update</button>
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

<script>
// function check_item_duplicate()
// {
	
// 	var iname= $('#iname').val();
	
// 	$.ajax
// 	({
// 		url: "<?php echo site_url('Ajax/check_duplicate_item_exist'); ?>",
// 		type: 'POST',
// 		data: {iname:'iname', cat_id:'cat_id'},
// 		success: function(msg) {
// 			if(msg!=0)
// 			{
// 				$("#user_exits").html("Code already exits");
// 				$('#iname').val('');
// 				return false;
// 			}
// 			else
// 			{
// 				return true;
// 			}
// 		}
// 	});
// }

</script>
