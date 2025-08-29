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
	$project_location=$row->project_location;
	$enquiry_code=$row->enquiry_code;
	
	$inspection_date=date('d-M-Y',strtotime($row->inspection_date));
	$quotation_date=date('d-M-Y',strtotime($row->quotation_date));
	$quotation_date=date('d-M-Y',strtotime($row->revision_date?? ''));
	$quotation_code=$row->quotation_code;
	$customer_id=$row->customer_id;
	$customer_name=$row->cust_name;
	$cp_name=$row->cp_name;
	$cp_mobile=$row->cp_mobile;
	$cp_email=$row->cp_email;
	$po_number=$row->po_number;
	$no_of_panels=$row->validation_approve;
	
	
	$billing_addr=$row->billing_addr;
	$billing_city=$row->billing_city;
	$billing_state=$row->billing_state;
	$billing_pincode=$row->billing_pincode;
	$billing_country= $row->billing_country;	
	$shipping_addr= $row->shipping_addr;
	$shipping_city= $row->shipping_city;
	$shipping_pincode= $row->shipping_pincode;
	$shipping_country= $row->shipping_country;	
	$remark=$row->fatremark;
	$client_ref=$row->client_ref;
	$stamp_image=$row->stamp_image;
	
	
}

 
$logo1=base_url().'public/logo/Logo-bsg.jpg';
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
			SAT Certificate
		</title>
	</head>
	<body topmargin=0 style="margin-left: 5px; margin-top:5px; font-family:Arial;">
		<center>
			<header>
			<table border=0 width=100%>
				<thead>
				<tr>
					<td align='left'><img style='opacity: 0.5' src="<?php echo base_url().'public/logo/Logo-bsg.jpg'?>" alt='logo.png' ></td>
					<td align='right'><img src="<?php echo base_url().'public/logo/logo.png'?>" alt='logo.png' ></td>
				</tr>
				</thead>
			</table>
			</header>
			<br><br><br><br>
			<main>
			<table border=0 width=100%>
				<tr>
					<td colspan='2' align='center' style="font-size:30px;"><b><u>SITE ACCEPTANCE TEST (SAT)</b></u></td>
				</tr>
			</table>
			<br><br><br><br><br><br>
			<table width=90% border=0 style="font-family:Arial; font-size: 14px; line-height: 1.2">
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>
						MANUFACTURER :
					</th>
					<td>
						<b><?php echo $company_name;?></b>
					</td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>CLIENT :</th>
					<td ><?php echo $customer_name;?></td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>PROJECT :</th>
					<td ><?php echo $project_name;?></td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>JOB REFERENCE :</th>
					<td ><?php echo $quotation_code;?></td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'> DATE :</th>
					<td ><?php echo $inspection_date;?></td>
				</tr>
				<tr>
					<td width='80px'></td>
					<th width='250px' align='left'>PROJECT LOCATION  :</th>
					<td ><?php echo $project_location;?></td>
				</tr>
				<tr height='100'>
					<td width='80px'></td>
					<td   height='300px'><h3>VALIDATION APPROVAL</h3></td>
					<td><h3> <?php if($row->validation_approve=='1') echo 'APPROVED'; else echo 'REJECTED';?></h3></td>
				</tr>
				
				<tr valign='bottom'>
					<td width='80px' height='200px'><br><br><br><br></td>
					<td colspan='2'> By,</td>
				</tr>
				<tr>
					<td width='80px'><br><br><br><br></td>
					<td>
					<?php 
					if($stamp_image!='')
					{
      						$binary = base64_decode(str_replace(" ", "+", $stamp_image));
					?>
					<img style="width: 100px; height:100px; margin:auto; display: block;" src="<?php if($binary!='') echo 'data:' .';base64,' . base64_encode($binary); ?>">
					<?php } ?>
					</td>
				</tr>
			 </table>
			<br><br><br>
			<div style='page-break-before: always;'></div>
			<br><br><br><br><br><br><br><br><br><br><br><br><br>	

			<h4>LIST OF EQUIPMENT FOR TEST</h4>
			<table width=90% border=1 style="font-family:Arial; font-size: 14px; line-height: 1.2">
				<thead>
				<tr>
					<th>Sr.NO.</th>
					<th align='left'>LIST</th>
				</tr>
				</thead>
				<?php $i=1; foreach($records2 as $tr) {
				if($tr->test_type=='EQUIPMENT LIST'){ ?>
				<tr>
					<td width='10%'><?php echo $i; $i++;;?></td>
					<td><?php echo $tr->test_name;?></td>
				</tr>
				<?php } } ?>
			</table>
			<h4>LIST OF REFERENCE DOCUMENTATION</h4>
			<table width=90% border=1 style="font-family:Arial; font-size: 14px; line-height: 1.2">
				<thead>
				<tr>
					<th>Sr.NO.</th>
					<th align='left'>LIST</th>
				</tr>
				</thead>
				<?php $i=1; foreach($records2 as $tr) {
				if($tr->test_type=='REFERENCE DOCUMENTS'){ ?>
				<tr>
					<td width='10%'><?php echo $i; $i++;;?></td>
					<td><?php echo $tr->test_name;?></td>
				</tr>
				<?php } } ?>
			</table>
			<br><br><br>
			<div style='page-break-before: always;'></div>
			<br><br><br><br><br><br><br><br>

			<h5>TESTS TO BE PERFORMED</h5>
			</h6>Tests to be performed may be adjusted as applicable</h6>
			<table width=90% border=1 style="font-family:Arial; font-size: 14px; line-height: 1.2">
				<thead>
				<tr>
					<th>Sr.NO.</th>
					<th>Details</th>
					<th>Status/Result</th>
					<th>Remark</th>
				</tr>
				</thead>
				<?php $i=1; foreach($records2 as $tr) {
				if($tr->test_type=='TESTS TO BE PERFORME'){ ?>
				<tr>
					<td width='10%'><?php echo $i; $i++;;?></td>
					<td><?php echo $tr->test_name;?></td>
					<td>
						<?php
						if($tr->test_status=='1') echo 'Passed';
						if($tr->test_status=='2') echo 'Not Passed';
					        if($tr->test_status=='3') echo 'NA';
						if($tr->test_status=='4') echo 'Approved';
						?>
					</td>
					<td><?php echo $tr->test_remark;?></td>
				</tr>
				<?php } } ?>
			</table>
			<br><br><br>
			<div style='page-break-before: always;'></div>
			<br><br><br><br><br><br><br>

			<h5>PLC Test of Digital Inputs</h5>
			<h6>The digital inputs from external objects is activated by either manually activate an external object whose activation causes a feedback signal to a digital input </h6>
			<table width=90% border=1 style="font-family:Arial; font-size: 14px; line-height: 1.2">
				<thead>
				<tr>
					<th>Sr.NO.</th>
					<th>Physical address</th>
					<th>Real/Set Value</th>
					<th>Measured Value</th>
					<th>Description</th>
					<th>Approval</th>
				</tr>
				</thead>
				<?php $i=1; foreach($records2 as $tr) {
				if($tr->test_type=='Digital Inputs'){ ?>
				<tr>
					<td width='10%'><?php echo $i; $i++;;?></td>
					<td><?php echo $tr->test_phy_addr;?></td>
					<td><?php echo $tr->test_real_value;?></td>
					<td><?php echo $tr->test_measured_value;?></td>
					<td><?php echo $tr->test_remark;?></td>
					<td>
						<?php
						if($tr->test_status=='Approved') echo 'Approved';
						if($tr->test_status=='Not Approved') echo 'Not Approved';
					        if($tr->test_status=='NA') echo 'NA';
						?>
					</td>
				</tr>
				<?php } } ?>
			</table>
			<h5>PLC Test of Digital Outputs</h5>
			<h6>By forcing the digital outputs via the programming tool, the corresponding external objects that are connected to the digital output are activated.</h6>
			<table width=90% border=1 style="font-family:Arial; font-size: 14px; line-height: 1.2">
				<thead>
				<tr>
					<th>Sr.NO.</th>
					<th>Physical address</th>
					<th>Real/Set Value</th>
					<th>Measured Value</th>
					<th>Description</th>
					<th>Approval</th>
				</tr>
				</thead>
				<?php $i=1; foreach($records2 as $tr) {
				if($tr->test_type=='Digital Outputs'){ ?>
				<tr>
					<td width='10%'><?php echo $i; $i++;;?></td>
					<td><?php echo $tr->test_phy_addr;?></td>
					<td><?php echo $tr->test_real_value;?></td>
					<td><?php echo $tr->test_measured_value;?></td>
					<td><?php echo $tr->test_remark;?></td>
					<td>
						<?php
						if($tr->test_status=='Approved') echo 'Approved';
						if($tr->test_status=='Not Approved') echo 'Not Approved';
					        if($tr->test_status=='NA') echo 'NA';
						?>
					</td>
				</tr>
				<?php } } ?>
			</table>
			
			<br><br><br>
			<div style='page-break-before: always;'></div>
			<br><br><br><br><br><br><br><br><br><br>

			<h5>PLC Test of Analog inputs</h5>
			<h6>The analog input signals from external objects shall be verified that they are properly connected according to the documentation for manufacturing.</h6>
			<table width=90% border=1 style="font-family:Arial; font-size: 14px; line-height: 1.2">
				<thead>
				<tr>
					<th>Sr.NO.</th>
					<th>Physical address</th>
					<th>Real/Set Value</th>
					<th>Measured Value</th>
					<th>Description</th>
					<th>Approval</th>
				</tr>
				</thead>
				<?php $i=1; foreach($records2 as $tr) {
				if($tr->test_type=='Analog Inputs'){ ?>
				<tr>
					<td width='10%'><?php echo $i; $i++;;?></td>
					<td><?php echo $tr->test_phy_addr;?></td>
					<td><?php echo $tr->test_real_value;?></td>
					<td><?php echo $tr->test_measured_value;?></td>
					<td><?php echo $tr->test_remark;?></td>
					<td>
						<?php
						if($tr->test_status=='Approved') echo 'Approved';
						if($tr->test_status=='Not Approved') echo 'Not Approved';
					        if($tr->test_status=='NA') echo 'NA';
						?>
					</td>
				</tr>
				<?php } } ?>
			</table>
			<h5>PLC Test of analog Outputs</h5>
			<h6>The analog outputs to external objects shall be verified that they are properly connected according to the documentation for manufacturing. </h6>
			<table width=90% border=1 style="font-family:Arial; font-size: 14px; line-height: 1.2">
				<thead>
				<tr>
					<th>Sr.NO.</th>
					<th>Physical address</th>
					<th>Real/Set Value</th>
					<th>Measured Value</th>
					<th>Description</th>
					<th>Approval</th>
				</tr>
				</thead>
				<?php $i=1; foreach($records2 as $tr) {
				if($tr->test_type=='Analog Outputs'){ ?>
				<tr>
					<td width='10%'><?php echo $i; $i++;;?></td>
					<td><?php echo $tr->test_phy_addr;?></td>
					<td><?php echo $tr->test_real_value;?></td>
					<td><?php echo $tr->test_measured_value;?></td>
					<td><?php echo $tr->test_remark;?></td>
					<td>
						<?php
						if($tr->test_status=='Approved') echo 'Approved';
						if($tr->test_status=='Not Approved') echo 'Not Approved';
					        if($tr->test_status=='NA') echo 'NA';
						?>
					</td>
				</tr>
				<?php } } ?>
			</table>
			<br><br><br><br><br><br>
				<table border=0 width=100%>
				<tr valign='bottom'>
					<td width='200px'></td>
					<td align='left'>Tested By,</td>
				</tr>
				<tr>
					<td></td>
					
					<td align='left'>
					<?php 
					if($stamp_image!='')
					{
      						$binary = base64_decode(str_replace(" ", "+", $stamp_image));
					?>
					<img style="width: 100px; height:100px;" src="<?php if($binary!='') echo 'data:' .';base64,' . base64_encode($binary); ?>">
					<?php } ?>
					</td>
				</tr>
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



