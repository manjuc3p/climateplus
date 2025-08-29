<html>
	<head>
		<title>
		PAYMENT REPORT
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
                    <td bgcolor="#0394fc" align="center" height='22px'><b><font color="#ffffff" face="Arial" style="font-size:30px;"> PAYMENT REPORT-<?php echo $job_date; ?></font></b></td>
                </tr>
                <tr>
                    
                    
                </tr>
			</table>
            <table cellpadding=10 border=1 width='100%' style='font-size: 12px; border-collapse: collapse;'>
                <thead>
                  <tr>
                    <th>Sr. No</th>
                    <th>Job Title</th>
                    <th>Driver</th>
                    <th>Payment Term</th>
                    <th>Payment Status</th>
                    <th>Payment Collection byDriver</th>
                    <th>Amount</th>
                    
                  </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach($report as $row) :?>
                    <tr>
                        <td><?php echo $i;$i++; ?></td>
                        <td><?php echo $row->job_title; ?></td>
                        <td><?php echo $row->user_name??'Not Assigned'; ?></td>                     
                        <td><?php echo $row->term??'Not Assigned'; ?></td>
                        <td><?php echo $row->payment_status??'Not Updated'; ?></td>
                        <td><?php if($row->payment_collection == 1) echo 'Cash Collected';else if($row->payment_collection == 2) echo 'Cheque Collected';else if($row->payment_collection == 3) echo 'Not Collected';else if($row->payment_collection == 4) echo 'Paid By Card';else echo 'Not updated';?></td>
                        <td><?php if($row->payment_collection == 1||$row->payment_collection == 2) echo $row->amount_collected;?></td>
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