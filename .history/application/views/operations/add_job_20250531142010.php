<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Operations/add_new_job" autocomplete="off" enctype="multipart/form-data">
		
        <div class="form-group row">
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Date <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
              <input tabindex="1" type="date" name="job_date" id="job_date" class="form-control form-control-sm" value='<?php echo date('Y-m-d') ?>' />
	  		</div>

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Type <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
	    			<select name="job_type" tabindex="3" id="job_type" class="form-control form-control-sm" required >
						<option value=''>Select</option>
	    				<?php
						foreach($job_types as $j):?>
						<option value='<?php echo $j->id;?>' ><?php echo $j->job_type;?></option>
						<?php
						endforeach
						?>
						
	    			</select>
	  		</div>
        </div>
		<div class="form-group row">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Title <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
			  <input type='text' name="job_title" id="job_title" class="form-control form-control-sm" tabindex="4" required />
	  		</div>

            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Time</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="text" name="job_time" id="job_time" class="form-control form-control-sm " />
			</div>

			
		</div>
		<div class="form-group row">
            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Company<span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  <input tabindex="1" type="text" name="customer" id="customer" class="form-control form-control-sm " />
               
	  		</div>

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Contact Number</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="number" type="text" name="contact" id="contact" class="form-control form-control-sm " />
			</div>
		</div>	

		<div class="form-group row">
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Customer Email</label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
			  <input tabindex="1" type="email" name="cust_email" id="cust_email" class="form-control form-control-sm" value='' />
	  		</div>

            
		</div>	
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Location <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
			  <input tabindex="1" type="text" name="location" id="location" class="form-control form-control-sm " required/>
	  		</div>
			  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Location link: </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
			  <input tabindex="1" type="text" name="location_link" id="location_link" class="form-control form-control-sm " />
	  		</div>
		</div>

		<div class="form-group row">

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Description </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
			  <textarea name="job_desc" id="job_desc" rows='5' cols='40' class="form-control form-control-sm" tabindex="4"></textarea>
	  		</div>
			
		</div>

		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">PO Number: <span style="color: red;"> * </span></label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
			  <input tabindex="1" type="text" name="po_number" id="po_number" class="form-control form-control-sm "/>
	  		</div>
			  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Invoice Number: </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
			  <input tabindex="1" type="text" name="invoice_number" id="invoice_number" class="form-control form-control-sm " />
	  		</div>
		</div>


		<div class="form-group row">  

			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Payment terms</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
                <!-- <textarea name="payment_term" tabindex="3" id="payment_term" class="form-control form-control-sm"  > -->
				<select name="payment_term" tabindex="3" id="payment_term" class="form-control form-control-sm select2">
						<option value=''>Select</option>
	    				<?php foreach($payment_terms as $term):?>
						<option value='<?php echo $term->id;?>' ><?php echo $term->term;?></option>
						<?php endforeach ?>
	    		</select>
						
						
	    		</textarea>
			</div>  
			
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Sales </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<select name="sales" tabindex="3" id="sales" class="form-control form-control-sm select2">
						<option value=''>Select</option>
	    				<?php
						foreach($sales_team as $s):?>
						<option value='<?php echo $s->user_id;?>'><?php echo $s->user_name;?></option>
						<?php
						endforeach
						?>
	    		</select>
			</div>
		</div>

		<div class="form-group row">
            
		</div>

		<div class="form-group row">
		<label class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-form-label">Upload("jpeg","jpg","png","doc","pdf"):</label>
            <div class="col-sm-6">
                <table class="table table-bordered table-hover" id="tab_logic">
					<thead>
						<tr><td>Sl</td><td>File</td><td> <a id="add_row" title="Add" class="btn btn-sm bg-blue"><span class="fa fa-plus"></span></a></td></tr>
					</thead>
                    <tbody>
                        <tr id='addr0'>
                            <td>1</td>
                            <td>                               
                                <input id="job_file0" name="job_file[]" type="file">                                
                            </td>
                            <td>                               
                                
                            </td>
                        </tr>
                        <tr id='addr1'></tr>
                    </tbody>
                </table>
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

<script>
	$(document).ready(function() {
        var i = 1;
        $("#add_row").click(function() {
            $('#addr' + i).html("<td>" + (i + 1) + "</td><td><input class='form-control' id='job_file"+i+"' name='job_file[]' type='file'></td><td> <a onclick='delete_row("+i+")' title='Delete' class='btn btn-sm bg-blue'><span class='fa fa-trash'></span></a></td>");
            $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
            i++;
        });

        

    });

	function delete_row(row){
		
		if (row > 0) {
                $("#addr" + row).remove();
                
        }
	}
//   function updateContact(){
//     var selectBox = document.getElementById("customer");
// 	var selectedOption = selectBox.options[selectBox.selectedIndex];
		
// 	var contact = selectedOption.getAttribute("data-contact");
//     document.getElementById("contact").value = contact;
//   }
   


</script>
