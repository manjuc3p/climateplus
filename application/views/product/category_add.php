<div class="card-body">
	<form onsubmit="return check_selected_age();" id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Product/add_main_category_data" autocomplete="off" enctype="multipart/form-data">
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Type<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5">
	    			<select name='ctype' id='ctype' class="form-control form-control-sm " required>
	    				<option value=''>Select</value>
	    				<option value='Trading'>Trading</value>
	    				<option value="Automation">Automation Project (Control Panels)</value>	    				
	    			</select>
	  		</div>
		</div>
		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Category Name<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5">
	    			<input tabindex="2" type="text" name="cat_name" id="cat_name" class="form-control form-control-sm " placeholder="Enter Category Name" required  onblur="check_duplicate_exist('category_name')">
		    		<label id="user_exits2" style="color: red;"></label>
	  		</div>
		</div>
		<h5>Add Sub Category</h5>
		<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_logic">
					   <thead>
					    <tr>
					    	    <th title="Item">Prefix</th>
					    	    <th title="Item">Sub category Name</th>    
					    	    <th><a id="add_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
						</tr>
					    </thead>		 
					    <tbody id="mytbbody">
						<tr id='addr0'>
							<td><input type="text" maxlength='3' minlength='3' name="prefix[]" id="prefix0" tabindex='2' class="form-control" placeholder=""  onblur="check_duplicate_subcategory('profix',0,'category_code')" required></td>
							<td><input type="text" name="sub_atr_name[]" id="sub_atr_name0" tabindex='3' class="form-control" placeholder=""  required onblur="check_duplicate_subcategory('sub_atr_name',0,'category_name')"></td>
							<td><a id='delete_row' title="Delete" onclick='remove_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
						</tr>
						<tr id='addr1'></tr>
					</tbody>
				</table>
		</div>
		
		<div class="form-group row">
		<label class="col-sm-2"></label>
		<div class="col-sm-10">
		<button type="submit"  tabindex="12"  id="add" class="btn btn-primary m-b-0">Submit</button>
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
$(document).ready(function(){
	var i=1;
	$("#add_row").click(function()
	{
	     $('#addr'+i).html("<td><input type='text' name='prefix[]' id='prefix"+i+"' tabindex='18' class='form-control form-control-sm ' placeholder='' required onblur=check_duplicate_subcategory('prefix',"+i+",'category_code') ></td><td><input type='text' name='sub_atr_name[]' id='sub_atr_name"+i+"' tabindex='19' class='form-control form-control-sm' onblur=check_duplicate_subcategory('sub_atr_name', "+i+", 'category_name') required></td><td><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytbbody tr:last').after('<tr id="addr'+(i+1)+'"></tr>');
	      i++; 	     	
	});
        $("#delete_row").click(function(){
    		 if(i>1){
			 $("#addr"+(i-1)).html('');
			 i--;
		 }
	 });
   });   
   function remove_row(append_id)
   {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");
        $('#addr'+append_id+"x").remove();
   }
  
   
function check_duplicate_exist(category_name)
{
	var cat_name= $('#'+cat_name).val();
	
	$.ajax
	({
		url: "<?php echo site_url('Ajax/check_duplicate_exist'); ?>",
		type: 'POST',
		data: {table_name:'category_master', column_name:category_name, post_id: cat_name },
		success: function(msg) {
			if(msg!=0)
			{
				$("#user_exits"+append_id).html(category_name+" already exits");
				$('#'+cat_name).val('');
			}
			else
			{
				$("#user_exits"+append_id).html("");
			}
		}
	});
}
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
</script>
