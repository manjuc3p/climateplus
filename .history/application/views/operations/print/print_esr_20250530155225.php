
<html>
	<head>
		<title>
			ESR
		</title>
	</head>
	<body style="font-family:Arial;">
	<main>
		<div style='width:100%;height:35px;text-align:center;background-color:#0394fc;font-size:30px;color:#ffffff'>ENGINEERING SERVICE REPORT</div>
		<table cellpadding=5 width=100%>
					<tr>
						<td width='50%'>
							<table>
								<tr>
									<td>Customer:</td><td><b><?php echo $job['customer'];?></b></td>
								</tr>
								<tr>
									<td>Location:</td><td><b><?php echo $job['job_location'];?></b></td>
								</tr>
								<tr>
									<td>Contact:</td><td><b><?php echo $job['contact'];?></b></td>
								</tr>	
								<tr>
									<td>Time:</td><td><b><?php echo date("g:i A", strtotime($job['job_start_time'])).'-'.date("g:i A", strtotime($job['job_end_time']));?></b></td>
								</tr>					
							</table>
						</td>
						
						<td width='50%'>
						<table>
								<tr>
									<td>Date:</td><td><b><?php echo $job['new_job_date']??$job['job_date'];?></b></td>
								</tr>
								<tr>
									<td>Invoice No:</td><td><b><?php //echo $cust_addr1;?></b></td>
								</tr>
								<tr>
									<td>Engineer:</td><td><b><?php echo $job['staff'];?></b></td>
								</tr>	
								<tr>
								<td>Service Team:</td><td><b><?php //echo $cust_trn;?></b></td>
								</tr>					
							</table>
						</td>
					</tr>
		</table>
		<table cellpadding=5 width='100%' style='font-size: 15px;border:1px solid #000;'>
            		
					
					<tr style='height:10%'>
                        <td width='30%'>JOB DESCRIPTION</td>
                        <td width='70%'><?= $job['job_desc'] ?><BR></td>
                    </tr>
					<tr>
							<td width='30%'>CHECKLIST</td>
							<td width='70%'><?= in_array(1, $selected_options) ? '✔' : '☐' ?>Leakages<br>
											<?= in_array(2, $selected_options) ? '✔' : '☐' ?>Is water pump working<br>
											<?= in_array(3, $selected_options) ? '✔' : '☐' ?>Remote Control Batteries<br>
											<?= in_array(4, $selected_options) ? '✔' : '☐' ?>Scratches<br>
											<?= in_array(5, $selected_options) ? '✔' : '☐' ?>Are wheels properly tightened<br>
											<?= in_array(6, $selected_options) ? '✔' : '☐' ?>Bad Smell<br>
											<?= in_array(7, $selected_options) ? '✔' : '☐' ?>Are all buttons working<br>

										</td>
							
					</tr>
					<tr>
                        
                        <td width='30%'>Others</td>
                        <td width='70%'>
							
							<?php foreach($new_options as $new){?>
							<?php echo '✔'.$new->checklist_option; ?><br>
							<?php } ?>
                    	</td>
                    </tr>
					<tr>
                    <td width='30%'>WORK CARRIED OUT</td>
                    <td width='70%'>
						<?php echo $job['work_done']; ?><br>
						<?php if($job['job_photo'] !=''){ ?>
						<img src="<?= base_url().'public/uploded_documents/job_photos/' . $job['job_photo']; ?>" height='40%' width='40%' alt="Sample Image">
						<?php }?>
						<br>	
					</td>
                    </tr>
					<tr>
                    <td width='30%'>PARTS</td>
                    <td width='70%'><?php echo $job['parts']; ?><br></td>    
                    </tr>
					<tr style='height:22px'>
                    <td  align="center" style='font-size:30px;font-color:#ffffff'>
                         <BR>
                    </td>
                	</tr>
					<tr>
                        <td>Customer's Sign:</td>
                        <td><img src="<?php echo base_url($job['customer_sign']);?>" height='50px' width='50px' ></td>
                    </tr>
						
					
            </table>
			
		</main>
	
	</body>
</html>








