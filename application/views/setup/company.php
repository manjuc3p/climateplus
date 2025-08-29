<div class="card-body">
        <form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Admin/add_company_records" id="addform" autocomplete="off" enctype="multipart/form-data" >            
	     <?php foreach($company_details as $row){?>
		      <div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Name <span style="color: red;"> * </span></label>
			<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5">
			  <input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo $row->company_name; ?>" placeholder="" required>
			</div>
		      </div>

		      <div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Address <span style="color: red;"> * </span></label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  <input type="text" name="company_address" id="company_address" class="form-control" value="<?php echo $row->company_address; ?>" placeholder="" required>
			</div>
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">City <span style="color: red;"> * </span></label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-45">
			  <input type="text" name="company_city" id="company_city" class="form-control" value="<?php echo $row->company_city; ?>" placeholder="" required>
			</div>
		      </div>

		      <div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">PO. box <span style="color: red;"> * </span></label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  <input type="text" name="company_pincode" id="company_pincode" class="form-control" value="<?php echo $row->company_pincode; ?>" placeholder="" required>
			</div>
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Country <span style="color: red;"> * </span></label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  <input type="text" name="company_country" id="company_country" class="form-control" value="<?php echo $row->company_country; ?>" placeholder="" required>
			</div>
		      </div>

		      <div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Email</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  <input type="text" name="company_email_id" id="company_email_id" class="form-control" value="<?php echo $row->company_email_id; ?>" placeholder="" >
			</div>
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Telephone</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  <input type="text" name="company_telephone" id="company_telephone" class="form-control" value="<?php echo $row->company_telephone; ?>" placeholder="" >
			</div>
		      </div>

		      <div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">TRN No</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  <input type="text" name="company_trn" id="company_trn" class="form-control" value="<?php echo $row->company_TRN; ?>" placeholder="" >
			</div>
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Website</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  <input type="text" name="website" id="website" class="form-control" value="<?php echo $row->company_website; ?>" placeholder="" >
			</div>
			
		      </div>
		      <!--
		     <div class="form-group row">
			
			<label class="col-sm-2 control-label">Logo</label>
			<div class="col-sm-4">
			  <input type="file" name="logo" id="logo" class="form-control"  placeholder=""  >
			</div>
		      </div>-->
		     		     
		<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_logic">
				   <thead>
				    <tr>
				    	    <th title="Item">Bank Name</th>
				    	    <th title="Item">Bank Account</th>    
				    	    <th title="Item">Bank Branch</th>    
				    	    <th title="Item">Bank IBAN</th>    
				    	    <th title="Item">Bank SWIFT</th>    
				    	    <th width='30px'><a id="add_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
					</tr>
				    </thead>		 
				    <tbody id="mytbbody">
	     				<?php foreach($bank_details as $r){?>
				    	<tr style='font-size: 13px;'>
						<td><input type="text" name="bname_old[]" id="bname" tabindex='2' class="form-control" placeholder="" value="<?php echo $r->bank_name;?>" required></td>
						<td><input type="text" name="bacc_old[]" id="bacc" tabindex='3' class="form-control" placeholder="" value="<?php echo $r->bank_account;?>" ></td>
						<td><input type="text" name="bbranch_old[]" id="bbranch" tabindex='3' class="form-control" placeholder="" value="<?php echo $r->bank_branch;?>" ></td>
						<td><input type="text" name="biban_old[]" id="biban" tabindex='3' class="form-control" placeholder="" value="<?php echo $r->bank_iban;?>" ></td>
						<td><input type="text" name="bswift_old[]" id="bswift" tabindex='3' class="form-control" placeholder="" value="<?php echo $r->bank_swift;?>" ></td>
						<td width='30px'>
						<input type="hidden"  name="trans_id[]" value="<?php echo $r->bid;?>" >
						<a  href="javascript:confirmcancel(<?php echo $r->bid;?>)" title="Delete" class="btn btn-xs bg-orange"><span class="fa fa-trash"></span></a></td>
					</tr>
	     				<?php } ?>
					<tr id='addr0' style='font-size: 13px;'>
						<td><input type="text" name="bname[]" id="bname" tabindex='2' class="form-control" placeholder=""  ></td>
						<td><input type="text" name="bacc[]" id="bacc" tabindex='3' class="form-control" placeholder=""  ></td>
						<td><input type="text" name="bbranch[]" id="bbranch" tabindex='3' class="form-control" placeholder=""  ></td>
						<td><input type="text" name="biban[]" id="biban" tabindex='3' class="form-control" placeholder=""  ></td>
						<td><input type="text" name="bswift[]" id="bswift" tabindex='3' class="form-control" placeholder=""  ></td>
						<td width='30px'><a id='delete_row' title="Delete" onclick='remove_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='addr1'></tr>
					</tbody>
				</table>
		</div>
		
		<div class="form-group row">
		  	<table class="table table-bordered table-hover" id="tab_stamp">
				   <thead>
				    <tr>
				    	    <th title="Item">Name</th>
				    	    <th title="Item">Upload Stamp (max image size:100kb)</th> 
				    	    <th width='30px'><a id="add_new_row" title="Add" class="btn btn-xs bg-orange" ><span class="fa fa-plus"></span></a></th>
					</tr>
				    </thead>		 
				    <tbody id="mystamp">
	     				<?php foreach($stamp_details as $r){?>
				    	<tr style='font-size: 13px;'>
						<td><input type="text" name="image_name_old[]" class="form-control" value="<?php echo $r->stamp_name;?>" required></td>
						<td><?php 
			      				$binary = base64_decode(str_replace(" ", "+", $r->stamp_image));
							?>
						<img style="width: 100px; height:100px; margin:auto; display: block;" src="<?php if($binary!='') echo 'data:' .';base64,' . base64_encode($binary); ?>"></td>
						<td width='30px'>
						<input type="hidden"  name="img_id[]" value="<?php echo $r->img_id;?>" >
						<a  href="javascript:confirmcancel_image(<?php echo $r->img_id;?>)" title="Delete" class="btn btn-xs bg-orange"><span class="fa fa-trash"></span></a></td>

					</tr>
	     				<?php } ?>
					<tr id='new_addr0' style='font-size: 13px;'>
						<td><input type="text" name="image_name[]" id="image_name" tabindex='2' class="form-control" placeholder=""  required></td>
						<td><input type="file" name="stamp_image[]"  class="form-control" ></td>
						
						<td width='30px'><a id='delete_row1' title="Delete" onclick='remove_stamp_row(0)' class="btn btn-xs bg-orange remove1"><span class="fa fa-trash"></span></a></td>
					</tr>
					<tr id='new_addr1'></tr>
					</tbody>
				</table>
		</div>
		
  						<div class="login-btn-inner">                                                        
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                <div class="login-horizental">
      								   <input type="hidden" id="company_id" name="company_id" value="<?php echo $row->company_id;?>" />
                                                                    <button class="btn btn-primary m-b-0" type="submit">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                              </div>
                                              </div>
                                              <?php } //end foreach?>
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
	 
	 var j=1;
	$("#add_new_row").click(function()
	{
	     $('#new_addr'+j).html("<td><input type='text' name='image_name[]' id='image_name' class='form-control' required></td><td><input type='file' name='stamp_image[]' id='stamp_image' class='form-control' ></td><td><a onclick='remove_stamp_row("+j+");' id='delete_row1' title='Delete' class='btn btn-xs bg-orange remove1'><span class='fa fa-trash'></span></a></td>");
	    $('#mystamp tr:last').after('<tr id="new_addr'+(j+1)+'"></tr>');
	      j++; 	     	
	});
        $("#delete_row1").click(function(){

    		 if(i>1){
			 $("#new_addr"+(j-1)).html('');
			 j--;
		 }
	 });
   });   
   function remove_row(append_id)
   {    	 
        $('#addr'+append_id).attr("id","addr"+append_id+"x");

        $('#addr'+append_id+"x").remove();
   }  
   function remove_stamp_row(append_id)
   {    	 
        $('#new_addr'+append_id).attr("id","new_addr"+append_id+"x");

        $('#new_addr'+append_id+"x").remove();
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
function confirmcancel_image(id)
{   
	var r= confirm("Are you sure you want to Delete Record?");

	if(r == true) 
        {
      		$.ajax({
     		url: "<?php echo base_url()?>index.php/Ajax/delete_record",

     		type: "POST",
     		data: {table_name:'company_stamp_image', where_key:'img_id', where_val:id} ,
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
