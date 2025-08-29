<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Product/update_sub_category" id="addform" autocomplete="off"   enctype="multipart/form-data">
		<?php  foreach($records as $row) :?>
			<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Category Name <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5">
	    			<input tabindex="1" type="text" name="attr_name" id="attr_name" class="form-control form-control-sm" required value="<?php echo $row->category_name;?>">
		    		<label id="user_exits1" style="color: red;"></label>
	  		</div>
		</div>
		
		<div class="form-group row">
			<label class="col-sm-2"></label>
			<div class="col-sm-10">
				<input type="hidden"  name="id" value="<?php echo $row->category_id;?>" >
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
	     $('#addr'+i).html("<td><input type='text' name='prefix[]' id='prefix' tabindex='18' class='form-control form-control-sm ' placeholder=''  ></td><td><input type='text' name='sub_atr_name[]' id='sub_atr_name' tabindex='19' class='form-control form-control-sm ' placeholder=''  ></td><td><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
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
     		data: {table_name:'attribute_transaction', where_key:'trans_id', where_val:id} ,
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
</script>
