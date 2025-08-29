<?php  $this->load->helper('menu_helper.php');
foreach($comapny_records as $row) {
	$company_name=$row->company_name;
	$company_address=$row->company_address;
	$company_city= $row->company_city;

	$company_pincode= $row->company_pincode;
	$company_country= $row->company_country;
	$company_email_id= $row->company_email_id;
	$company_telephone= $row->company_telephone;
	$company_website= $row->company_website;
	$company_TRN= $row->company_TRN;

}

$mis_cnt=0;
foreach($records1 as $row) {
	$project_name=$row->project_name;
	$enquiry_code=$row->jcode;
	$enquiry_date=date('d-M-Y',strtotime($row->card_date));
	$revision=$row->revision;
	$project_start_date=date('d-M-Y',strtotime($row->project_start_date));
	$project_end_date=date('d-M-Y',strtotime($row->project_end_date));
	$quotation_date=date('d-M-Y',strtotime($row->quotation_date));
	$quotation_date=date('d-M-Y',strtotime($row->revision_date?? ''));
	$quotation_code=$row->quotation_code;
	$customer_id=$row->customer_id;
	$customer_name=$row->cust_name;
	//$cp_name=$row->cp_name;
	//$cp_mobile=$row->cp_mobile;
	//$cp_email=$row->cp_email;
		
	/*$billing_addr=$row->billing_addr;
	$billing_city=$row->billing_city;
	$billing_state=$row->billing_state;
	$billing_pincode=$row->billing_pincode;
	$billing_country= $row->billing_country;	
	$shipping_addr= $row->shipping_addr;
	$shipping_city= $row->shipping_city;
	$shipping_pincode= $row->shipping_pincode;
	$shipping_country= $row->shipping_country;	
	$remark=$row->remark;
	$client_ref=$row->client_ref;*/
		
	//$sales_person=$row->user_name;
	//$sales_person_mob=$row->contact_no;
	
}

 
 
$logo1=base_url().'public/logo/logo.jpg';
$print_header="";?>

<style>
@media print {
    body {
        margin: 0;
        padding: 0;
    }

    header, footer {
        position: fixed;
        width: 100%;
    }

    header {
        top: 0;
    }

    footer {
        bottom: 0;
    }

    main {
       margin-top: 100px;
    }
    img {
       /* max-width: 150%;
        height: auto;*/
    }
}
</style>

<html>
	<head>
		<title>
			Quotation
		</title>
	</head>
	<body topmargin=0 style="margin-left: 5px; margin-top:5px; font-family:Arial;">
		<center>
			<header>
			<table border=0 width=100%>
				<thead>
				<tr>
					<td align='left'><img style='opacity: 0.5' src="<?php echo base_url().'public/logo/logo.jpg'?>" alt='logo.png' ></td>
					<td align='right'><img src="<?php echo base_url().'public/logo/logo.png'?>" alt='logo.png' ></td>
				</tr>
				</thead>
			</table>
			</header>
			<main>
			<table border=0 width=100%>
				<tr>
					<td colspan='2' align='center' style="font-size:24px;"><b><u>JOB CARD</b></u></td>
				</tr>
				<tr>
					<td  valign="top" align='left'>
					<table width=80% border=0 style="font-family:Arial; font-size: 17px; line-height: 1.2">
					<tr>
						<td width=150>
							Customer Name:
						</td>
						<td >
							<b><?php echo $customer_name;?></b>
						</td>
					</tr>
					<tr>
						<td width=150>
							Project Name:
						</td>
						<td >
							<b><?php echo $project_name;?></b>
						</td>
					</tr>

					<tr>
						<td width=150>
							Project Start Date:
						</td>
						<td >
							<b><?php echo $project_start_date;?></b>
						</td>
					</tr>

					<tr>
						<td width=150>
							Project End Date:
						</td>
						<td >
							<b><?php echo $project_end_date;?></b>
						</td>
					</tr>
					</table>
					</td>
					<td valign="top" align="right">
						<table width=100% border=0 style="font-family:Arial; font-size: 17px; line-height: 1.2">
							<tr>
								<td width=30>
									
								</td>
								<td >
									<b>Quotation No</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $quotation_code;?>
								</td>
							</tr>
							<tr>
								<td width=30>
									
								</td>
								<td >
									<b>Quotation Date</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $quotation_date;?>
								</td>
							</tr>
							<tr>
								<td width=30>
									
								</td>
								<td >
									<b>Job Card No</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $enquiry_code;?>	
								</td>
							</tr>
							<tr>
								<td width=30>
									
								</td>
								<td >
									<b>Dated</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $enquiry_date;?>	
								</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<br>
				<br>
			</table>	
			
			<table border=0 width=100%>
				<tr>
					<td colspan='2' align='center' style="font-size:24px;"><b><u>DETAILS</b></u></td>
				</tr>
			</table>
			
			<table border='1' width='100%' cellpadding='0' cellspacing=0>
				<thead>
					</tr>
					<tr height="50px" style="font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border-right: 1px solid;">
						 <th>Employee/Labour</th>
			            		<th>Work Date</th>
			            		<th>Work Desc</th>
			            		<th>Start Time</th>
			            		<th>End Time</th>
			           		 <th>Total Time</th>
			           		 <th>Remark</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($records2 as $r1){?>
					<tr style='background:gray;'>
					<td width=300>
					      <?php foreach($user_records  as $g) {
						 if($g->user_id==$r1->emp_id){ ?>
						 <?php echo $g->user_name;?>
					      <?php } } ?>
					</td>
					<td><?php echo date('d-M-Y',strtotime($r1->work_date)); ?></td>
					<td>
						<?php echo $r1->production_line_details;?>
					</td>
					<td>
		       				<?php echo date('H:i',strtotime($r1->stime)); ?>
					</td>
					<td>
						<?php echo date('H:i',strtotime($r1->etime)); ?>
					</td>
					<td>
						<?php echo $r1->total_time;?>
					</td>
					<td>
						<?php echo $r1->remark;?>
					</td>
				</tr>
				<?php }  ?>
					
				</tbody>
			</table>
			
			
			
			</main>
			 <footer>
			<table border=0 width=100% >
				<tr>
					<td align='center'><img src="<?php echo base_url().'public/logo/footer4.png'?>" alt='logo.png' ></td>
				</tr>
				
			</table>
			 </footer>
		</center>
	</body>
</html>








<style>
      .pagenum:before { content: counter(page); }
</style>



