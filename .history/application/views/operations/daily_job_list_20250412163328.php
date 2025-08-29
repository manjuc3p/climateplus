<style>
  table {
    border-collapse: collapse;
    width: 100%;
    table-layout:fixed;
  }

  th, td {
    border: 1px solid #333;
    padding: 8px;
    /* Allow text to wrap */
    white-space: normal;
    word-wrap: break-word;
  }

  /* Optional: Set column widths to force wrapping */
  td {
    width: 200px;
  }
</style>
<div class="card-body">
<?php $dept = $this->session->userdata('dept'); ?>
          <form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Operations/daily_job_list" id="form1" method="post">
            <div class="form-group row">
              <label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">Date <span style="color: red;"> * </span></label>
                <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
               
                  <input tabindex="1" type="date" class="form-control date_today" id="job_date" name="job_date" value="<?php echo $job_date ?? '' ;?>" required autocomplete="off">
                  
                </div>
                <input type='hidden' name='print_opt' id='print_opt' value=0 />
            
           
                <div class="col-sm-2">
                        <input tabindex="6" type="submit" id="view" name="go" value="Go" class="btn btn-sm btn-primary m-b-0" />
                </div>
            </div>
            </form>
            <?php if (!empty($grouped_jobs)) : ?>
            <?php foreach ($grouped_jobs as $type => $jobs): ?>
            <h3><?php echo htmlspecialchars($type); ?></h3>
            <table class="table table-striped table-bordered nowrap">
                <thead>
                  <tr>
                    <th style='width:20%'>Company</th>
                    <th style='width:10%'>Time</th>
                    <th style='width:10%'>Contact</th>
                    <th style='width:25%'>Job </th>
                    <th style='width:15%'>Payment</th>
                    <th style='width:10%'>Sales</th>
                    <th style='width:5%'>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1;foreach ($jobs as $job): ?>
                        <tr>
                            
                            <td>
                              <?php echo $job['customer']; ?><br>
                              <a href='<?php echo $job['location_link']; ?>' target='#blank'><?php echo $job['job_location']; ?></a>
                            </td>
                            <td><?php echo $job['job_time']??'Not Assigned'; ?></td>
                            <td><?php echo htmlspecialchars($job['contact']); ?></td>
                            <td><?php echo htmlspecialchars($job['job_title']); ?></td>
                            <td><?php echo $job['term']; ?></td>
                            <td><?php echo $job['sales']; ?></td>

                            <td>
                              <?php $dept = trim($dept);if($dept=='Admin'||$dept=='Accounts'||$dept=='Operations'||$dept=='Office Admin'||$dept=='Sales'){ ?>
                              <a href='<?php echo base_url().'index.php/Operations/edit_job_details/'.$job['job_id'];?>'>Edit</a><br>
                              <?php } ?>
                              <?php if($job['staff_assign'] == $this->session->userdata('user_id')||$dept=='Admin'){ ?>
                              <a href="<?php echo base_url().'index.php/Operations/view_job_details/'.$job['job_id'];?>" title="View details">View</a><br>
                              <?php } ?>
                              <?php if($dept=='Admin'||$dept=='Operations'||$dept=='Office Admin'){ ?>
                              <a href='javascript:cancel_job(<?php echo $job['job_id']; ?>)'>Cancel</a>
                              <?php } ?>
                            </td>
                           
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No jobs found.</p>
    <?php endif; ?>
        
        <?php if(!empty($grouped_jobs)){?>
        <div class="form-group row">
          <form action="<?php echo base_url().'index.php/'; ?>Operations/daily_job_list" id="form2" target='_blank' method="post">
              <label class="col-sm-4"></label>
              <div class="col-sm-8">
                <button type='submit' class='btn btn-primary'>Print</button>
                <input type='hidden' name='print_opt' id='print_opt' value=1 />
                <input type='hidden' name='job_date' id='job_date2' value='<?php echo $job_date ?? '' ;?>' />
              </div>
          </form>
        </div>
        <?php } else{?>
          <div class="form-group row">
          <label class="col-sm-4"></label>
          <div class="col-sm-8">
                <h4>No records</h4>
              </div>
          </div>
          <?php } ?>
        
</div>

<script>

  function print_view(){
    $('#print_opt').val(1);
    $('#form1').attr('target', '_blank');
    $('#form1').submit();
  }

  function cancel_job(job){
    var conf = confirm("Are you sure to cancel this job?");
    if(conf){
      $.ajax({
     		url: "<?php echo base_url()?>index.php/Operations/cancel_job",
     		type: "POST",
     		data: {job_id:job} ,
     		success: function(msg) {
          
     			if(msg) 
     			{     	
			         alert("Job Cancelled"); 				
        			 window.location.href=window.location.pathname;  		                    		  
				  }
		      else{
			      	alert("Something went wrong");
		      }
		    },
		});
    }
  }
</script>
       
