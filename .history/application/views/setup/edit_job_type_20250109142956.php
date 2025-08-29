<div class="card-body">
		<form id="main" method="post" action="<?php echo base_url().'index.php/'; ?>Setup/update_job_type" autocomplete="off">
		
			<div class="form-group row">
			<label class="col-sm-2 col-form-label">Job Type</label>
			<div class="col-sm-4">
			<input type="text" class="form-control" name="uname" id="uname" pattern="[A-Za-z]+" value="<?php echo $job_type['job_type']; ?>" placeholder="enter unit name" readonly>
			</div>
			</div>

			

				
			<div class="form-group row">
					<label class="col-sm-2"></label>
					<div class="col-sm-4">
                    <input type="hidden" if="uid" name="uid" value="<?php echo $job_type['id'] ?>>">		
						<button type="submit" id="edit" class="btn btn-primary m-b-0">Update</button>
						
					</div>
			</div>

			
		</form>
       
</div>
         
