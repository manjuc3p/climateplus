<div class="card-body">
        <form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Admin/add_terms_details" id="addform" autocomplete="off" enctype="multipart/form-data" >            
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Select Term Name <span style="color: red;"> * </span></label>
			<div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
			  	<select required name="term" id="term" class="form-control form-control-sm select2">
					<option value="">Select User Name</option>
					<option value="D">Delivery Terms</option>
					<option value="O">Offer Validity</option>
					<option value="P">Payment Terms</option>
				</select>
			</div>
		</div>
          
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Payment Terms </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  	<textarea name="details1" id="details1" rows='5' placeholder="Enter details of Payment terms" class="form-control"></textarea>
			</div>
		</div>               
              
		<div class="login-btn-inner">                                                        
                <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="login-horizental">
                                    <button class="btn btn-primary m-b-0" type="submit">Submit</button>
                                </div>
                            </div>
                	    </div>
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
	     $('#addr'+i).html("<td><input type='text' name='bname[]' id='bname' tabindex='2' class='form-control' placeholder=''  required></td><td><input type='text' name='bacc[]' id='bacc' tabindex='3' class='form-control' placeholder='' ></td><td><input type='text' name='bbranch[]' id='bbranch' tabindex='3' class='form-control' placeholder='' ></td><td><input type='text' name='biban[]' id='biban' tabindex='3' class='form-control' placeholder='' ></td><td><input type='text' name='bswift[]' id='bswift' tabindex='3' class='form-control' placeholder='' ></td><td><a onclick='remove_row("+i+");' id='delete_row' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
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
   </script>
   
   <script>
function confirmcancel(id)
{   
	var r= confirm("Are you sure you want to Delete Record?");
	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Ajax/delete_record",
     		type: "POST",
     		data: {table_name:'company_bank_details', where_key:'bid', where_val:id} ,
     		success: function(msg) {
     			if(msg==1) 
     			{     	
			         alert("Record deleted"); 				
        			 window.location.href="<?php echo $_SERVER['PHP_SELF']?>";   		                    		  
			}
		        else {
			      	alert("Can't Delete record. Data already used!!!");
		       }
		    },
		});
      		return true;
      	}
        else
        	return false;
	    	
}
</script>
