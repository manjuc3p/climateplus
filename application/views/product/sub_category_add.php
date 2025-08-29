<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Product/add_sub_category_data" id="addform" autocomplete="off"   enctype="multipart/form-data">
			<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Main Category <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5">
	    			<select name="cat_id" id="cat_id" class="form-control form-control-sm select2" required>
	    				<option value=''>Select</option>
	    				<?php foreach($cat_records as $r){?>
	    				<option value="<?php echo $r->category_id;?>"><?php echo $r->category_name;?></option>
	    				<?php } ?>
	    			</select>
	  		</div>
		</div>
		
		<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_logic">
					   <thead>
					    <tr>
					    	    
					    	    <th title="Item">Sub Category Name</th>    
					    	    <th><a id="add_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
						</tr>
					    </thead>		 
					    <tbody id="mytbbody">
						<tr id='addr1'></tr>
					</tbody>
				</table>
		</div>
			<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
				<button tabindex="46" type="submit" id="edit" class="btn btn-primary m-b-0">Update</button>
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



   function check_duplicate_subcategory(inputname, append_id, column_name)
{
	var input_id= $('#'+inputname+append_id).val();
	
	$.ajax
	({
		url: "<?php echo site_url('Ajax/check_duplicate_exist'); ?>",
		type: 'POST',
		data: {table_name:'category_master', column_name:column_name, post_id: input_id },
		success: function(msg) {
			if(msg!=0)
			{
				alert(column_name+" already exits");
				$('#'+inputname+append_id).val('');
			}
		}
	});
}
   function check_duplicate_subcat_name(append_id)
{
	var input_id= $('#sub_atr_name'+append_id).val();
	
	$.ajax
	({
		url: "<?php echo site_url('Ajax/check_duplicate_exist'); ?>",
		type: 'POST',
		data: {table_name:'category_master', column_name:'category_name', post_id: input_id },
		success: function(msg) {
			if(msg!=0)
			{
				alert("category name already exits");
				$("#sub_atr_name"+append_id).val('');
			}
		}
	});
}

</script>
