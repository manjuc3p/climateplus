<div class="card-body">

	<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Operations/send_mail" autocomplete="off" enctype="multipart/form-data">
        <div class="form-group row">
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">To: </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-6">
              <input tabindex="1" type="text" name="email_to" id="email_to" class="form-control form-control-sm" value='<?php echo $job_det['customer_email']; ?>' required/>
	  		</div>
        </div>
        <div class="form-group row">
		    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Subject: </label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-6">
              <input tabindex="1" type="text" name="email_subject" id="email_subject" class="form-control form-control-sm" value='<?php echo $job_det['job_title']; ?>' required/>
	  		</div>
        </div>

        <div class="form-group row">
            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label">Message</label>
	  		<div class="col-xs-12 col-sm-9 col-md-4 col-lg-6">
              <textarea name="email_message" tabindex="3" id="email_message" rows=5 cols=100 class="form-control form-control-sm" required>Dear Sir/Madam,
				Please find the attached documents. Let us know if you have any questions or require further assistance.

				
			  </textarea>
	  		</div>
			<input type='hidden' name='staff_name' value='<?php $job_det['staff']; ?>' />
			<input type='hidden' name='staff_dept' value='<?php $job_det['dept_name']; ?>' />
        </div>
		

		<div class="form-group row">

                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-form-label"> Files </label>
				<div class="col-xs-12 col-sm-9 col-md-4 col-lg-4">
                <table class="table table-bordered table-hover" id='tab_logic'>
					<thead>
						<tr><td>Sl</td><td>File</td><td> <a id="add_row" title="Add" class="btn btn-sm bg-blue"><span class="fa fa-plus"></span></a></td></tr>
					</thead>
                    <tbody id="file_table">
						
                        					
                        <tr id='addr0'>
						    <td>1</td>
                            <td>                               
                                <input id="mail_file0" name="mail_file[]" type="file" required>                                
                            </td>
                            <td>                               
                                
                            </td>
                        </tr>
						<tr id='addr1'></tr>
                    </tbody>
                </table>
				<input type='hidden' name='dltd_files' id='dltd_files' />
				</div>

				
	  		
		</div>
                          
        
        

        
        <div class="form-group row">
            
        </div>
        
		
		<div class="form-group row">
			
		    <label class="col-sm-4"></label>
            <div class="col-sm-8">
                <input type='hidden' name='job_id' value='<?php echo $job_id; ?>' />
            <button type='submit'  tabindex="11"  class="btn btn-primary m-b-0" >Send Mail</button>
            </div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function() {
        var k = $("#file_table tr").length;
		var i = 1;
        $("#add_row").click(function() {
            $('#addr' + i).html("<td>" + (k) + "</td><td><input class='form-control' id='mail_file"+i+"' name='mail_file[]' type='file'></td><td> <a onclick='delete_row("+i+")' title='Delete' class='btn btn-sm bg-blue'><span class='fa fa-trash'></span></a></td>");
            $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
            i++;
        });

        

    });

	function delete_job_file(row){
		var conf = confirm("Are you sure to delete?");
		if(conf){
			var file_id = $('#file_id'+row).val();

			var dltd = $('#dltd_files').val();
			if(dltd == ''){
				dltd = file_id;
			}
			else{
				dltd = dltd +','+file_id;
			}
			$('#dltd_files').val(dltd);	
			remove_row(row,1);
		}
			
		
	}

	function remove_row(row,conf){
		if(conf == 0){
			conf = confirm("Are you sure to delete?");
		}
		if(conf){
			$('#addr'+row).remove();
		}
		
	}
</script>


