<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Product/update_main_category" id="addform" autocomplete="off"   enctype="multipart/form-data">
		<?php  foreach($records as $row) :?>
			<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Category Name <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5">
	    			<input tabindex="1" type="text" name="cat_name" id="cat_name" class="form-control form-control-sm" required value="<?php echo $row->category_name;?>">
		    		<label id="user_exits1" style="color: red;"></label>
	  		</div>
		</div>
		
		<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_logic">
					   <thead>
					    <tr>
					    	    
					    	    <th width='80%'>Sub Category Name</th>    
					    	    <th width='80%'><a id="add_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
						</tr>
					    </thead>		 
					    <tbody id="mytbbody">
						<tr id='addr1'></tr>
						<?php  foreach($trans_records as $r) :?>
						<tr class='bg-soft-primary'>
							<td><input type="text" name="sub_atr_name_old[]" id="sub_atr_name_old<?php echo $r->category_id;?>" tabindex='3' class="form-control" placeholder="" value="<?php echo $r->category_name;?>" required onblur="check_duplicate_subcategory('sub_atr_name_old',<?php echo $r->category_id;?>,'category_name')"></td>
							<td>
							<input type="hidden"  name="trans_id[]" value="<?php echo $r->category_id;?>" >
							
							<a onclick='delete_attribute(<?php echo $r->category_id;?>)' title="Delete"><?php echo $this->session->userdata('delete_icon');?></a>
							</td>
						</tr>
						<?php endforeach; ?>
						<tr id='addr1'></tr>
					</tbody>
				</table>
		</div>
			<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
				<input type="hidden"  name='ctype' id='ctype' />
				<input type="hidden" id='main_id' name="id" value="<?php echo $row->category_id;?>" >
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


$(document).ready(function(){
	var i=1;
	$("#add_row").click(function()
	{
	     $('#addr'+i).html("<td><input type='text' name='sub_atr_name[]' id='sub_atr_name"+i+"' tabindex='19' class='form-control form-control-sm ' onchange='check_duplicate_subcat_name("+i+")' required /></td><td><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mytbbody tr:first').before('<tr id="addr'+(i+1)+'"></tr>');
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
   
   function delete_attribute(id)
   {
   	var r= confirm("Are you sure you want to Delete Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Ajax/delete_record",
     		type: "POST",
     		data: {table_name:'category_master', where_key:'category_id', where_val:id} ,
     		success: function(msg) {
     			if(msg==1) 
     			{     	
			         alert("Record deleted"); 				
        			 window.location.href="<?php echo $_SERVER['PHP_SELF']?>";   		                    		  
			}
		        else {
			      	alert("Can't Delete record. Data already exist!!!");
		       }
		    },
		});
      		return true;
      	}
        else
        	return false;
   }
   
   function check_duplicate_subcategory(inputname, append_id, column_name)
	{
	var input_id= $('#'+inputname+append_id).val();
	var main_cal = $('#main_id').val();
	$.ajax
	({
		url: "<?php echo site_url('Ajax/check_duplicate_subcat_exist'); ?>",
		type: 'POST',
		data: {table_name:'category_master', column_name:column_name, post_id: input_id,main_cat:main_cal  },
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
		var main_cal = $('#main_id').val();
		$.ajax
		({
			url: "<?php echo site_url('Ajax/check_duplicate_subcat_exist'); ?>",
			type: 'POST',
			data: {table_name:'category_master', column_name:'category_name', post_id: input_id,main_cat:main_cal },
			success: function(msg) {

				if(msg!=0)
		 		{
					alert("category name already exists");
					$("#sub_atr_name"+append_id).val('');
				}
			}
		});
	}

</script>
