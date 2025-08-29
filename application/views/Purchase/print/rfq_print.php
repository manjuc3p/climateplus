<?php
foreach($comapny_records as $row) { 
	$company_name=$row->company_name;
	$company_address=$row->company_address;
	$company_city= $row->company_city;
	$company_country= $row->company_country;

	$company_pincode= $row->company_pincode;
	$company_country= $row->company_country;
	$company_email_id= $row->company_email_id;
	$company_telephone= $row->company_telephone;
	$company_website= $row->company_website;
	$company_TRN= $row->company_TRN;
}

foreach($records1 as $row) { 
	$quotation_date=date('d/m/Y',strtotime($row->rfq_date));
	$quotation_code=$row->rfq_code;
	$rev_version=$row->rev_version;
	$customer_id=$row->supplier_id;
	$customer_name=$row->supplier_name;
	$enquiry_code=$row->enquiry_code;
	$client_ref=$row->client_ref;
	$payment_term=$row->payment_term;
	$delivery_term=$row->delivery_term;
	$remark=$row->remark;
	
	$billing_addr=$row->billing_address;
	$billing_city=$row->billing_city;
	$billing_state=$row->billing_state;
	$billing_pincode=$row->billing_po_box;
	$billing_country= $row->billing_country;
	$billing_contact_person= $row->contact_person;
	$billing_email_id= $row->email_id;
	$billing_telephone= $row->contact_no;
	//$delivery_date= $row->req_delivery_date;
	//$remark=$row->remark;
	$cp_name= $row->contact_person;
	//$contact_person_number= $row->contact_person_number;
	$email_id= $row->email_id;
	$supplier_contact_no= $row->contact_no;
	if($supplier_contact_no=='')
		$supplier_contact_no=$contact_person_number;

	$sales_person=$row->user_name;
	$sales_person_mob=$row->contact_no;
}
if($rev_version>0)
{
$revtext= 'Rev -'.$rev_version;
//$quotation_date =$revision_date;
}
else
{ 
	$revtext="";
}
 
$logo1=base_url().'public/logo/Logo-fzc.jpg';
$print_header="";
?>

<html>
	<head>
		<title>
			RFQ
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
			<main>
			<table border=0 width=100%>
				<tr>
					<td colspan='2' align='center' style="font-size:23px;"><b><u> REQUEST FOR QUOTATION</b></u></td>
				</tr>
				<tr>
					<td  valign="top" align='left'>
					<table width=80% border=0 style="font-family:Arial; font-size: 14px; line-height: 1.2">
					<tr>
						<td width=40>
							M/s.
						</td>
						<td >
							<b><?php echo $customer_name;?></b>
						</td>
					</tr>
					<tr>
						<td width=40>
							
						</td>
						<td >
							<?php echo $billing_addr.' <br>'.$billing_city.' '.$billing_pincode.' '.$billing_country;?>
						</td>
					</tr>
					</table>
					</td>
					<td valign="top" align="right">
						<table width=100% border=0 style="font-family:Arial; font-size: 14px; line-height: 1.2">
							<tr>
								<td width=20>
									
								</td>
								<td >
									<b>RFQ No</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $quotation_code;?>
								</td>
							</tr>
							<tr>
								<td width=20>
									
								</td>
								<td >
									<b>Date</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $quotation_date;?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<br>
				<br>
				<tr>
					<td colspan='2' style="font-family:Arial; font-size: 17px; line-height: 1.2; padding-left:40px;"><b>Kind Attention: <?php echo $cp_name;?> <br><br><br></b>
				</td>
				</tr>
				
				
			</table>
			
			
			<table border='1' width='90%' cellpadding='0' cellspacing=0>
				<thead>
					</tr>
					<tr height="50px" style="font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border-right: 1px solid;">
						<td>SL.NO</td>
						<td>DESCRIPTION</td>
						<td>QTY</td>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; $qtytot=0; foreach($records2 as $r) { ?>
					<tr>
						<td align="center"><?php echo $i; ?></td>
						<td>    &nbsp;&nbsp;&nbsp;
							<b><u><?php echo $r->item_desc; ?></u></b><br><br>
							
						</td>
						<td align="center"><?php echo intval($r->quantity); $qtytot= $qtytot+$r->quantity;?></td>
					</tr>
					<?php    $i++; } ?>
					<tr>
						<td>Total</td>
						<td></td>
						<td align="center">
							<?php echo $qtytot; ?>
						</td>
					</tr>
				</tbody>
			</table>
			<br><br>	
			
			<table border='0' width='90%' cellpadding='0' cellspacing=0>
				<thead>
					<tr height="50px" style="font-family:Arial; font-size: 11px; font-weight: bold; text-align: center; border-right: 1px solid;">
						
						<td width='60%' align='left'>Payment Terms: <?php echo $payment_term; ?></td>
						<td align='center'><b>For  Bangalore Elect  Switchgear Assembly LLC</b> </td>
						<td></td>
					</tr>
					<tr height="50px" style="font-family:Arial; font-size: 11px; font-weight: bold; text-align: center; border-right: 1px solid;">
						<td width='60%' align='left'>Delivery Terms: <?php echo $delivery_term; ?></td>
						<td align='right'>
							<?php 
			      				//$binary = base64_decode(str_replace(" ", "+", $stamp_image));
							?>
							<!--<img style="width: 100px; height:100px; margin:auto; display: block;" src="<?php if($binary!='') echo 'data:' .';base64,' . base64_encode($binary); ?>">
						--></td>
						<td></td>
					</tr>
					<tr height="50px" style="font-family:Arial; font-size: 11px; font-weight: bold; text-align: center; border-right: 1px solid;">
						<td width='60%'></td>
						<td align='center'>Authorized Signatory</td>
						<td></td>
					</tr>
				</thead>
			</table>
			</main>
			 <footer>
			<table border=0 width=100% >
				<tr>
					<td align='center'><img  src="<?php echo base_url().'public/logo/footer4.png'?>" alt='logo.png' ></td>
				</tr>
				
			</table>
			 </footer>
		</center>
	</body>
</html>


<style>
      .pagenum:before { content: counter(page); }
    </style>
