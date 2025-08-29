
<html>
	<head>
		<title>
			ESR
		</title>
	</head>
	<body style="font-family:Arial;">
		 <center>
		<img src="<?php echo base_url().'public/header_img/cp_headr.png'?>" alt='logo.png' width='100%'>
		</center>	
	<main>
		<div style='width:100%;height:35px;text-align:center;background-color:#0394fc;font-size:30px;color:#ffffff'><?php echo $report_title; ?></div>
		<table cellpadding=5 width=100%>
					<tr>
						<td width='50%'>
							<table>
								<tr>
									<td>Customer</td><td><b>:<?php echo $job['customer'];?></b></td>
								</tr>
								<tr>
									<td>Location</td><td><b>:<?php echo $job['job_location'];?></b></td>
								</tr>
								<tr>
									<td>Contact</td><td><b>:<?php echo $job['contact'];?></b></td>
								</tr>	
								<tr>
									<td>Time</td><td><b>:<?php echo date("g:i A", strtotime($job['job_start_time'])).'-'.date("g:i A", strtotime($job['job_end_time']));?></b></td>
								</tr>					
							</table>
						</td>
						
						<td width='50%'>
						<table>
								<tr>
									<td>Date</td><td><b>:<?php echo $job['new_job_date']??$job['job_date'];?></b></td>
								</tr>
								<tr>
									<td>Invoice No</td><td><b>:<?php //echo $cust_addr1;?></b></td>
								</tr>
								<tr>
									<td>Engineer</td><td><b>:<?php echo $job['staff'];?></b></td>
								</tr>	
								<tr>
								<td>Service Team</td><td><b>:<?php //echo $cust_trn;?></b></td>
								</tr>					
							</table>
						</td>
					</tr>
		</table>
		<table cellpadding=5 width='100%' border=1 style='font-size: 15px;border-collapse: collapse;'>
					<tr>
                        <td width='30%'>JOB DESCRIPTION</td>
                        <td width='70%'><?= $job['job_desc'] ?><BR></td>
                    </tr>
					<tr>
							<td width='30%'>CHECKLIST</td>
							<td width='70%'><?php if(in_array(1, $selected_options)) echo '&#10004;'.'Leakages'.'<br>'; ?>
											<?php if(in_array(2, $selected_options)) echo  'Is water pump working'.'<br>'?>
											<?php if(in_array(3, $selected_options)) echo  'Remote Control Batteries'.'<br>'?>
											<?php if(in_array(4, $selected_options)) echo  'Scratches'.'<br>'?>
											<?php if(in_array(5, $selected_options)) echo  'Are wheels properly tightened'.'<br>'?>
											<?php if(in_array(6, $selected_options)) echo  'Bad Smell'.'<br>'?>
											<?php if(in_array(7, $selected_options)) echo  'Are all buttons working'.'<br>'?>
											<?php foreach($new_options as $new){?>
												<?php echo $new->checklist_option.'<br>'; ?>
											<?php } ?>
							</td>
							
					</tr>
					
					<tr>
                    <td width='30%'>WORK CARRIED OUT</td><td width='70%'><?php echo $job['work_done']; ?></td>
                    </tr>
                    
					<?php if($job['job_photo'] !=''){ ?>
					<tr>
						<td width='30%'>WORK CARRIED OUT</td>
						<td width='70%'>
						<img src="<?= base_url().'public/uploded_documents/job_photos/' . $job['job_photo']; ?>" height='40%' width='40%' alt="Sample Image">
						</td>
					</tr>
					<?php }?>
					<tr>
                    <td width='30%'>PARTS</td>
                    <td width='70%'><?php echo $job['parts']; ?></td>    
                    </tr>
					<tr>
                        <td>Customer's name:</td>
                        <td></td>
                    </tr>
					<tr>
                        <td>Customer's E-Sign:</td>
                        <td><img src="<?php echo base_url($job['customer_sign']);?>" height='50px' width='50px' ></td>
                    </tr>
					<tr>
                        <td>Customer's mobile:</td>
                        <td></td>
                    </tr>	
					
            </table>
			
		</main>
	
	</body>
</html>








