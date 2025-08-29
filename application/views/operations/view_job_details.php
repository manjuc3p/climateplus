<div class="card-body">
	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Operations/add_job_completion" autocomplete="off" enctype="multipart/form-data">
		
        <div class="form-group row">
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Date </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
              <input tabindex="1" type="date" name="job_date" id="job_date" class="form-control form-control-sm" value='<?php echo $job['new_job_date']??$job['job_date'] ?>' readonly />
	  		</div>

            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Type </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
                <select name="job_type" tabindex="3" id="job_type" class="form-control form-control-sm" required disabled>
                <?php foreach($job_types as $j):?>
					<option value='<?php echo $j->id;?>' <?php if($job['job_type']==$j->id) echo 'selected'; ?> ><?php echo $j->job_type;?></option>
				<?php endforeach ?>
						
	    		</select>
	  		</div>
        </div>
        <div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Title </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">		
              <p><?php echo $job['job_title']; ?> </p>	  
			</div>
							
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Time</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
            <p><?php echo $job['job_time']; ?> </p>	  
				
			</div>
            
		</div>
		<div class="form-group row">
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Company</label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
              <?php echo $job['customer']; ?>
                
	  		</div>

            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Contact</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<?php echo $job['contact']; ?>
			</div>
		</div>	

		<div class="form-group row">
	  		<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Description </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">		
              <textarea name="job_desc" id="job_desc" rows='5' cols='40' class="form-control form-control-sm" tabindex="4" readonly><?php echo $job['job_desc']; ?></textarea>	  
			  
	  		</div>

            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Location</label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">		              
			  <p><a href='<?php echo $job['location_link']; ?>' target='#blank' title='click here for location link'><?php echo $job['job_location']; ?></a></p>              
	  		</div>
		</div>

        <div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">PO Number: </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">	
                <?php echo $job['po_number']; ?>	
	  		</div>
			  <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Invoice Number: </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">	
                <?php echo $job['invoice_number']; ?>	
	  		</div>
		</div>

		<div class="form-group row">
				<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Sales </label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
                <select name="sales" tabindex="3" id="sales" class="form-control form-control-sm select2" disabled>
						<option value=''>Select</option>
	    				<?php foreach($sales_team as $s):?>
						<option value='<?php echo $s->user_id;?>' <?php if($s->user_id == $job['sales']) echo 'selected'; ?>><?php echo $s->user_name;?></option>
						<?php endforeach ?>
	    		</select>
				</div>

                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Assigned to:</label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<select name="staff" tabindex="3" id="staff" class="form-control form-control-sm select2" disabled>>
						<option value=''>Select</option>
	    				<?php foreach($drivers as $s):?>
						<option value='<?php echo $s->user_id;?>' <?php if($s->user_id == $job['staff_assign']) echo 'selected'; ?>><?php echo $s->user_name;?></option>
						<?php endforeach ?>
	    		</select>
				</div>
		</div>

		<div class="form-group row">

                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label"> Files </label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
                <?php if(!empty($job_files)){ ?>
                <table class="table table-bordered table-hover" >
					<thead>
						<tr><td>Sl</td><td>File</td><td></td></tr>
					</thead>
                    <tbody>
                        <?php $i=51; foreach($job_files as $file){ ?>
                        <tr id='<?php echo 'addr'.$i ; ?>'>
                            <td><?php echo $i-50; ?></td>
                            <td>                               
                                <?php echo $file->document_path; ?>                             
                            </td>
                            <td>                               
                            <a download href="<?php echo base_url('public/uploded_documents/job_files/'.$file->document_path);?>" title="Download" class="btn btn-sm bg-blue"><span class="fa fa-download"></span></a>
                            </td>
                        </tr>
                        <?php $i++; }?>
                        
                    </tbody>
                </table>
                <?php } else{
                    echo "No files Uploaded";
                }?>
				</div>

				
	  		
		</div>

        <div class="form-group row">
            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Payment terms</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
				<p><?php echo $job['term']; ?></p>
			</div>   
            
            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Payment Status</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
				<p><?php echo $job['payment_status']; ?></p>
			</div>
            
           
        </div>

       
        <div id='completion_details' style='display:none'>
        <div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job Start time </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
            <input tabindex="1" type="time" name="job_start_time" id="job_start_time" class="form-control form-control-sm " readonly/>
			</div>
            
            <!-- <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Job End time </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="time" name="job_end_time" id="job_end_time" class="form-control form-control-sm " />
			</div> -->
			
		</div>
        <hr>
        <div class="form-group row">
            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Checklist</label>
            <div class="col-xs-12 col-sm-9 col-md-4 col-lg-6">
                <table width=100%>
                    <tr>
                        <td><input type='checkbox' name='checklist_options[]' value=1 /></td><td>Leakages:</td>
                        <td><input type='checkbox' name='checklist_options[]' value=2 /></td><td>Is water pump working:</td>
                        <td><input type='checkbox' name='checklist_options[]' value=3 /></td><td>Remote Control Batteries:</td>
                    </tr>
                    <tr>
                        <td><input type='checkbox' name='checklist_options[]' value=4 /></td><td>Scratches:</td>
                        <td><input type='checkbox' name='checklist_options[]' value=5 /></td><td>Are wheels properly tightened:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><input type='checkbox' name='checklist_options[]' value=6 /></td><td>Bad Smell:</td>
                        <td><input type='checkbox'  name='checklist_options[]' value=7 /></td><td>Are all buttons working:</td>
                        <td></td>
                    </tr>
                </table>
            </div>
        
           
        </div>

        <div class="form-group row">
		<label class="col-xs-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Other Checks Done:</label>
            <div class="col-sm-6">
                <table  id="tab_logic" width='100%'>
					
                    <tbody>
                        <tr id='addr0'>
                            
                            <td>                               
                                <input style='width:100%' id="new_chklist_option0" name="new_chklist_option[]" class='form-control' type="text">                                
                            </td>
                            <td>                               
                            <a id="add_row" title="Add" class="btn btn-sm bg-blue"><span class="fa fa-plus"></span></a>
                            </td>
                        </tr>
                        <tr id='addr1'></tr>
                    </tbody>
                </table>
            </div>
				
		</div>
        <hr>
        
        <div class="form-group row">
            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Work Carried Out</label>
            <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">		
                <textarea name="work_done" id="work_done" rows='5' cols='40' class="form-control form-control-sm" tabindex="4"></textarea>	  
            </div>

            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Upload Photo(.jpeg,.png) </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<input tabindex="1" type="file" name="job_photo" id="job_photo" class="form-control form-control-sm " accept=".jpeg, .jpg, .png"/>
			</div>
        </div>

        <div class="form-group row">
            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Parts</label>
            <div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">		
                <textarea name="parts" id="parts" rows='5' cols='40' class="form-control form-control-sm" tabindex="4"></textarea>	  
                
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Payment collected</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
                <select name="payment_collection" tabindex="3" id="payment_collection" class="form-control form-control-sm" onchange='check_payment(this.value)'>
						<option value=''>Select</option>
	    				<option value='1' >Cash collected</option>
						<option value='2' >Cheque Collected</option>
                        <option value='4' >Paid by Card</option>
						<option value='3' >Not Collected</option>
	    	    </select>
			</div>   
            
            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Amount</label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">			  
                <input tabindex="1" type="number" step='any' name="amt_collected" id="amt_collected" class="form-control form-control-sm " disabled />
			</div>
            
           
        </div>
		<div class="form-group row">
			<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Customer Signature </label>
			<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
				<canvas id="signature-pad" style="background-color: lightgray;"></canvas>
				<input type="hidden" name="signature-data" id="signature-data">
				<div class="button-group">
					<button type="button" id="clear">Clear</button>
					<button type="button" id="save">Done</button>
				</div>
			</div>
            
           
			
		</div>

        <div class="form-group row">
			<input type='hidden' name='job_id' value='<?php echo $job['job_id']; ?>' />
		    <label class="col-sm-2"></label>
            <div class="col-sm-10">
            <button type='submit' id='complete_btn' tabindex="11"  class="btn btn-primary m-b-0" disabled>Complete Job</button>
            <a href='<?php echo base_url().'index.php/'; ?>Operations/daily_job_list'  class="btn btn-primary m-b-0" >Back to Job list</a>
            </div>
		</div>
        </div>
		<div id='start_job' class="form-group row">
		    <label class="col-sm-2"></label>
            <div class="col-sm-10">
            <a tabindex="11" onclick='start_job()'  class="btn btn-primary m-b-0" class="btn btn-primary m-b-0">Start Job</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href='<?php echo base_url().'index.php/'; ?>Operations/daily_job_list'  class="btn btn-primary m-b-0" >Back to Job list</a>
            </div>
		</div>
		
        </div>
	</form>
</div>

<script>

$(document).ready(function() {
        var i = 1;
        $("#add_row").click(function() {
            $('#addr' + i).html("<td><input class='form-control' id='new_chklist_option"+i+"' name='new_chklist_option[]' type='text'></td><td> <a onclick='delete_row("+i+")' title='Delete' class='btn btn-sm bg-blue'><span class='fa fa-trash'></span></a></td>");
            $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
            i++;
        });

        

});

	
        
        function delete_row(row){
		
		if (row > 0) {
                $("#addr" + row).remove();
                
        }
	}

    function check_payment(payment){
        if(payment == '1'||payment == '2'){
            $('#amt_collected').val('');
            $('#amt_collected').prop('disabled',false);
        }
        else{
            $('#amt_collected').val('');
            $('#amt_collected').prop('disabled',true);
        }
    }

    function start_job(){
    $('#completion_details').show();
    const canvas = document.getElementById('signature-pad');
        const ctx = canvas.getContext('2d');
        const clearButton = document.getElementById('clear');
        const saveButton = document.getElementById('save');
        const signatureDataInput = document.getElementById('signature-data');
        
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;

        let drawing = false;

        // Function to get the position of the cursor or touch
        const getPosition = (event) => {
            const rect = canvas.getBoundingClientRect();
            if (event.touches) {
                return {
                    x: event.touches[0].clientX - rect.left,
                    y: event.touches[0].clientY - rect.top,
                };
            }
            return {
                x: event.clientX - rect.left,
                y: event.clientY - rect.top,
            };
        };

        const startDrawing = (event) => {
            drawing = true;
            const pos = getPosition(event);
            ctx.beginPath();
            ctx.moveTo(pos.x, pos.y);
        };

        const draw = (event) => {
            if (!drawing) return;
            event.preventDefault(); // Prevent scrolling when drawing
            const pos = getPosition(event);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
        };

        const stopDrawing = () => {
            drawing = false;
            ctx.closePath();
        };

        // Mouse Events
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseleave', stopDrawing);

        // Touch Events
        canvas.addEventListener('touchstart', startDrawing);
        canvas.addEventListener('touchmove', draw);
        canvas.addEventListener('touchend', stopDrawing);
        canvas.addEventListener('touchcancel', stopDrawing);

        clearButton.addEventListener('click', () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });

        saveButton.addEventListener('click', () => {
            const dataURL = canvas.toDataURL('image/png');
            signatureDataInput.value = dataURL;
            alert('Signature saved! You can now submit the form.');
            $("#complete_btn").removeAttr("disabled");
        });

    const now = new Date();
    let hours = now.getHours().toString().padStart(2, '0'); // Ensure two-digit format
    let minutes = now.getMinutes().toString().padStart(2, '0'); 


    const currentTime = `${hours}:${minutes}`;
    document.getElementById("job_start_time").value = currentTime;
    $('#start_job').hide();
    }
    </script>
