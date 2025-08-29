<html>
	<head>
		<title>
		JOBS REPORT
		</title>
	</head>
	<body topmargin=0 style="margin-left: 5px; margin-top:5px; font-family:Arial;">
  <center>
		<img src="<?php echo base_url().'public/header_img/cp_headr.png'?>" alt='logo.png' width='1024px'>
		</center>	
	<main>
		<center>
			<table cellpadding=10 border=0 width=100%>
                <tr>
                    <td bgcolor="#0394fc" align="center" height='22px'><b><font color="#ffffff" face="Arial" style="font-size:30px;"> JOBS REPORT(<?php echo 'from '.date('d-M-Y',strtotime($from_date)).' to '.date('d-M-Y',strtotime($to_date)); ?>)</font></b></td>
                    
                    
                </tr>
                <tr>
                    
                    
                </tr>
			</table>
            <table cellpadding=10 border=1 width='100%' style='font-size: 12px; border-collapse: collapse;'>
                <thead>
                  <tr>
                  <th style='width:5%'>Sr. No</th>
                    <th style='width:5%'>Date</th>
                    <th style='width:20%'>Job Title</th>
                    <th style='width:10%'>Job Type</th>
                    <th style='width:10%'>Customer</th>
                    <th style='width:10%'>Driver</th>
                    
                  </tr>
                </thead>
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
            </table>
            </center>
	</main>
	
	</body>
</html>
<script>
window.onload = function() {
    window.print(); // Opens the print dialog
};
</script>