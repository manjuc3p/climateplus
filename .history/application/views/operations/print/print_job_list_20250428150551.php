<!-- <?php
$date = DateTime::createFromFormat('Y-m-d', $job_date);

// Format the date as 'day-month date, year'
$formattedDate = $date->format('l-F j, Y'); 
?> -->
<html>
	<head>
		<title>
			DAILY JOB LIST
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
                    <td bgcolor="#0394fc" align="center" height='22px'><b><font color="#ffffff" face="Arial" style="font-size:30px;"> DAILY JOB LIST</font></b></td>
                    <td bgcolor="#0394fc" align="center" height='22px'><b><font color="#ffffff" face="Arial" style="font-size:30px;"><?php echo $formattedDate;?></font></b></td>
                    
                </tr>
                <tr>
                    
                    
                </tr>
			</table>
      <?php if (!empty($grouped_jobs)) : ?>
            <?php foreach ($grouped_jobs as $type => $jobs): ?>
            <h3><?php echo htmlspecialchars($type); ?></h3>
            <table cellpadding=10 border=1 width='100%' style='font-size: 15px; border-collapse: collapse;'>
                <thead>
                  <tr>
                    <th>Company</th>
                    <th>Time</th>
                    <th>Contact</th>
                    <th>Job</th>
                    <th>Payment</th>
                    <th>Sales</th>
                    
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1;foreach ($jobs as $job): ?>
                        <tr>
                            
                            <td>
                              <?php echo $job['customer']; ?><br>
                              <?php echo $job['job_location']; ?>
                            </td>
                            <td><?php echo htmlspecialchars($job['job_time']); ?></td>
                            <td><?php echo htmlspecialchars($job['contact']); ?></td>
                            <td><?php echo htmlspecialchars($job['job_title']); ?></td>
                            <td><?php echo $job['term']; ?></td>
                            <td><?php echo htmlspecialchars($job['sales']); ?></td>

                            
                           
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
        <?php endif; ?>
		</center>
	</main>
	
	</body>
</html>
<script>
window.onload = function() {
    window.print(); // Opens the print dialog
};
</script>





