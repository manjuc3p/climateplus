<div class="card-body">
        
        
          <form class="form-horizontal" action="<?php echo base_url().'index.php/'; ?>Reports/jobs_report" id="main" method="post" name="question" >
            <div class="form-group row">
              <label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">From <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
                  <input tabindex="1" type="date" class="form-control form-control-sm" id="from_date" name="from_date" value="<?php echo $from_date; ?>" onchange="$('#main').submit()">
               </div>
              
               <label class="col-xs-6 col-sm-1 col-md-1 col-lg-1 col-form-label">To <span style="color: red;"> * </span></label>
              <div class="col-xs-12 col-sm-9 col-md-2 col-lg-2">
                  <input tabindex="1" type="date" class="form-control form-control-sm" id="to_date" name="to_date" value="<?php echo $to_date; ?>"  onchange="$('#main').submit()">
               </div>

                <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-form-label">Status</label>
              <div class="col-sm-2">
                <select name="status" tabindex="3" id="status" class="form-control form-control-sm" onchange="$('#main').submit()">
						          <option value=''>All jobs</option>
                        <option value='1' <?php if($status == 1) echo 'selected'; ?>>Completed</option>
                        <option value='2' <?php if($status == 2) echo 'selected'; ?>>Pending</option>
	    		      </select>
              </div>

              <input type='hidden' name='print_opt' id='print_opt' value=0 />
            </div>
            </form>

           
            
            <div class="dt-responsive table-responsive">
              <table id="basic-btn" class="">
                <thead>
                  <tr>
                    <th style='width:2%'>Sr. No</th>
                    <th style='width:5%'>Date</th>
                    <?php if ($status == 2){ ?>
                    <?php }  else{ ?>
                    <th style='width:23%'>Job Title</th>
                    <?php } ?>
                    <th style='width:10%'>Job Type</th>
                    <th style='width:10%'>Customer</th>
                    <th style='width:10%'>Driver</th>
                    

                  </tr>
                </thead>
                <?php if(isset($jobs)){ ?>       
                <tbody>
                  <?php $i=1; foreach($jobs as $job) :?>
                    <tr>
                        <td><?php echo $i;$i++; ?></td>
                        <td><?php echo date('d-M-Y',strtotime($job->new_job_date??$job->job_date));?></td>
                        <td><?php echo $job->job_title; ?></td>
                        <td><?php echo $job->job_type; ?></td>                     
                        <td><?php echo $job->customer ?></td>
                        <td><?php echo $job->user_name??'Not Assigned'; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <?php } ?>   
               
              </table>
            </div>
            <div class="form-group row">
            <div class="col-sm-4"></div>
              <div class="col-sm-4">
              <button onclick='print_report()' class='btn btn-primary'>Print</button>
              </div>
            </div>
            
          
        
      </div>
      
  <script>
    function print_report(){
      $('#print_opt').val(1);
      $('#main').submit();

    }
  </script>