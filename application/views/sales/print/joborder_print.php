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
	$revision=$row->version;
	$project_start_date=date('d-M-Y',strtotime($row->project_start_date));
	$project_end_date=date('d-M-Y',strtotime($row->project_end_date));
	$quotation_date=date('d-M-Y',strtotime($row->quotation_date));
	$quotation_date=date('d-M-Y',strtotime($row->revision_date?? ''));
	$quotation_code=$row->quotation_code;
	$customer_id=$row->customer_id;
	$customer_name=$row->cust_name;
	$job_nature=$row->job_nature;
	
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
					<td align='right'><img src="<?php echo base_url().'public/logo/logo.jpg'?>" alt='logo.png' ></td>
				</tr>
				</thead>
			</table>
			</header>
			<main>
			<table border=0 width=100%>
				<tr>
					<td colspan='2' align='center' style="font-size:24px;"><b><u>JOB ORDER</b></u></td>
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
					<tr>
						<td width=150>
							Nature of Job:
						</td>
						<td >
							<b><?php echo $job_nature;?></b>
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
						 <th>Sr.No</th>
						<th>Description</th>
						<th>Quantity</th>
						
					</tr>
				</thead>
				<tbody>
					<?php foreach($records2 as $r1){?>
					<tr>			
						<td><?php echo $r1->prod_srno; ?></td>
						<td><?php echo $r1->prod_description;?></td>
						<td><?php echo $r1->prod_qty; ?></td>
					</tr>
				<?php }  ?>
					
				</tbody>
			</table>
			
			
			
			</main>
			 <footer>
			<!-- <table border=0 width=100% >
				<tr>
					<td align='center'><img src="<?php echo base_url().'public/logo/footer4.png'?>" alt='logo.png' ></td>
				</tr>
				
			</table> -->
			 </footer>
		</center>
	</body>
</html>








<style>
      .pagenum:before { content: counter(page); }
</style>



