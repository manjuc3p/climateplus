<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Product/add_new_product" autocomplete="off" enctype="multipart/form-data">
		
		
		<div class="form-group row">
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Product Category <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
	    			<select name="itype" tabindex="3" id="itype" class="form-control form-control-sm select2" onchange='updatesubCategory()' required >
						<option value=''>Select</option>
	    				<?php
						foreach($cat_records as $c):?>
						<option value='<?php echo $c->category_id;?>'><?php echo $c->category_name;?></option>
						<?php
						endforeach
						?>
	    			</select>
	  		</div>
		</div>	

		<div class="form-group row">
		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Product Subcategory<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
	    			<select name="prd_type" tabindex="3" id="prd_type" class="form-control form-control-sm select2" required >
					<option value=''>Select</option>	    				
					
	    			</select>
	  		</div>
		</div>


		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Product Description <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  
			  <textarea name="desc" id="desc" rows='5' cols='40' class="form-control form-control-sm" tabindex="4" required></textarea>
	  		</div>
		</div>

		<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Item Code </label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="pcode" id="pcode" class="form-control form-control-sm " />
				</div>
		</div>

		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Size:</label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
	    			<span>Length:</span><input type='number' step='0.01' tabindex="8" name="length" id="length" class="form-control form-control-sm " value=0 required/>
					<br />
					<span>Height:</span><input type='number' step='0.01' tabindex="8" name="height" id="height" class="form-control form-control-sm " value=0 required/>
	  		</div>
		</div>

		<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Colour </label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="colour" id="colour" class="form-control form-control-sm " />
				</div>
		</div>

		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Unit Price:<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
	    			<input type='number' step='0.01' tabindex="8" name="price" id="price" class="form-control form-control-sm " required placeholder='0.00' />
	  		</div>
		</div>
		
		
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<button type="submit"  tabindex="11"  id="add" class="btn btn-primary m-b-0" >Submit</button>
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
  
   
function check_item_duplicate(e)
{

	var itype= $('#itype').val();
	var desc= $('#desc').val();
	
	$.ajax
	({
		url: "<?php echo site_url('Ajax/check_duplicate_item_exist'); ?>",
		type: 'POST',
		data: {idesc:desc, itype:itype},
		success: function(msg) {
			if(msg!=0)
			{
				$("#user_exits").html("Code already exits");
				$('#iname').val('');
				return false;
			}
			else
			{
				document.getElementById("main").submit();
			}
		}
	});
}

function updatesubCategory(){

	var mainDropdown = document.getElementById("itype");
  var secondaryDropdown = document.getElementById("prd_type");
  var selectedOption = mainDropdown.value;

  // Clear existing options
  secondaryDropdown.innerHTML = "";
  $.ajax
	({
		url: "<?php echo site_url('Ajax/ajax_get_subcategory'); ?>",
		type: 'POST',
		data: {cat:selectedOption},
		success: function(msg) {
			var options = JSON.parse(msg);
			$("#prd_type").append('<option value="">Select</option>');
			for (var obj of options) {
				$("#prd_type").append('<option value="' + obj.category_id + '">' + obj.category_name + '</option>');
			}
		
				
		}
	});
  
}

</script>
