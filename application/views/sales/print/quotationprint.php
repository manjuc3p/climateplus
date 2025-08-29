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
	$enquiry_code=$row->enquiry_code;
	$enquiry_date=date('d-M-Y',strtotime($row->enq_date));
	$revision=$row->revision;
	$quotation_date=date('d-M-Y',strtotime($row->quotation_date));
	$quotation_date=date('d-M-Y',strtotime($row->revision_date?? ''));
	$quotation_code=$row->quotation_code;
	$customer_id=$row->customer_id;
	$customer_name=$row->cust_name;
	$cp_name=$row->cp_name;
	$cp_mobile=$row->cp_mobile;
	$cp_email=$row->cp_email;
	$sub_total=$row->sub_total;
	$vat_percent=$row->vat_percent;
	$vat_amt=$row->vat_amt;
	$discount_percent=$row->discount_percent;
	$discount=$row->discount;
	$grand_total=$row->grand_total;
	//$delivery_date=date('d-M-Y',strtotime($row->delivery_date));
	$payment_term1=nl2br($row->payment_term1);
	$payment_term2=nl2br($row->delivery_term);
	$payment_term3='';	
	$billing_addr=$row->billing_addr;
	$billing_city=$row->billing_city;
	$billing_state=$row->billing_state;
	$billing_pincode=$row->billing_pincode;
	$billing_country= $row->billing_country;	
	$shipping_addr= $row->shipping_addr;
	$shipping_city= $row->shipping_city;
	$shipping_pincode= $row->shipping_pincode;
	$shipping_country= $row->shipping_country;	
	$remark=$row->remark;
	$client_ref=$row->client_ref;
	$validity=$row->validity;
	$company_bank_name= $row->bank_name;
	$company_bank_account= $row->bank_account;
	$company_bank_branch= $row->bank_branch;
	$bank_iban= $row->bank_iban;
	$bank_swift= $row->bank_swift;	
	$sales_person=$row->user_name;
	$sales_person_mob=$row->contact_no;
	$currabrev=$row->currabrev;
	$currency_rate=$row->currency_rate;
	$other1=$row->other1;
	$other1_amt=$row->other1_amt;
	$other2=$row->other2;
	$other2_amt=$row->other2_amt;
	$other3=$row->other3;
	$other3_amt=$row->other3_amt;
	$hs_code=$row->hs_code;	
	if($other1_amt>0) $mis_cnt=1;
	if($other2_amt>0) $mis_cnt=2;
	if($other3_amt>0) $mis_cnt=3;
}
if($revision>0)
{
$revtext= 'Rev -'.$revision;
//$quotation_date =$revision_date;
}
else
{ $revtext="";
 }
 
 
$logo1=base_url().'public/logo/logo.jpg';
$print_header="";?>

<style>
body{
    min-height: 1100px;
    display: flex;
    flex-direction: column;
}
footer{
    margin-top: auto;
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
			<?php if($logo_flag=='logo'){ ?>
			<table border=0 width=100%>
				<thead>
				<tr>
					<td align='left'><img style='opacity: 0.5' src="<?php echo base_url().'public/logo/logo192x192.png'?>" alt='logo.png' width='200px'></td>
					<td align='right'><img src="<?php echo base_url().'public/logo/logo.png'?>" alt='logo.png' width='200px'></td>
				</tr>
				</thead>
			</table>
			<?php } else echo "<div style='height:150px;'></div>"; ?>
			<table border=0 width=100%>
				<tr>
					<td colspan='2' align='center' style="font-size:24px;"><b><u>QUOTATION</b></u></td>
				</tr>
				<tr>
					<td  valign="top" align='left'>
					<table width=80% border=0 style="font-family:Arial; font-size: 17px; line-height: 1.2">
					<tr>
						<td width=40>
							
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
					<tr>
						<td width=40>
							
						</td>
						<td >
							Tel: <?php echo $cp_mobile;?><br>
							Email: <?php echo $cp_email;?><br>
						</td>
					</tr>
					</table>
					</td>
					<td valign="top" align="right">
						<table width=70% border=0 style="font-family:Arial; font-size: 17px; line-height: 1.2">
							<tr>
								<td width=70>
									
								</td>
								<td >
									<b>Ref No</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $quotation_code;?>
								</td>
							</tr>
							<tr>
								<td width=70>
									
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
							<tr>
								<td width=70>
									
								</td>
								<td >
									<b>Your ref</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $client_ref;?>	
								</td>
							</tr>
							<tr>
								<td width=70>
									
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
				<tr>
					<td colspan='2' style="font-family:Arial; font-size: 17px; line-height: 1.2; padding-left:40px;"><b>Kind Attention: <?php echo $cp_name;?> <br><br><br></b>
				</td>
				</tr>
				
				<tr style="font-family:Arial; font-size: 18px; line-height: 1.7;">
					<td colspan='2' style="padding-left:40px;">Dear Sir, <br><br></td>
				</tr>
				<tr style="font-family:Arial; font-size: 18px; line-height: 1.7; padding-left:80px;">
					<td colspan='2' style="padding-left:40px;">We thank you for your enquiry <?php if($project_name!='') echo 'for '.$project_name; ?> <br></td>
				</tr>
				<tr style="font-family:Arial; font-size: 18px; line-height: 1.7; padding-left:80px;">	
					<td colspan='2' style="padding-left:40px;">Further to the same we are pleased to submit our Competitive Offer as follows.</td>
				</tr>
				<tr style="font-family:Arial; font-size: 18px; line-height: 1.7; padding-left:80px;">	
					<td colspan='2' style="padding-left:40px;">We hope that our offer is as per your requirement. However, should you need any further</b>
					<br>
					assistance on this please do contact us.</td>
				</tr>
				<tr style="font-family:Arial; font-size: 18px; line-height: 1.7; padding-left:80px;">	
					<td colspan='2' style="padding-left:40px;">Assuring you of our best services and attention at all times.</td>
				</tr>
				<tr style="font-family:Arial; font-size: 18px; line-height: 1.7; padding-left:80px;">	
					<td colspan='2' height='300px'></td>
				</tr>
				<tr>	
					<td colspan='2' height='100px' style="padding-left:40px;"><b>Thanks & Regards</b></td>
				</tr>
				<tr>	
					<td colspan='2' style="padding-left:40px;"><b><?php echo $sales_person;?></b></td>
				</tr>
				<tr>	
					<td colspan='2' style="padding-left:40px;"><b>Manager</b></td>
				</tr>
			</table>
			
			<table border=0 width=100% style="padding-top:310px;">
				<tr>
					<td align='left'><img src="<?php echo base_url().'public/logo/footer1.png'?>" alt='logo.png' ></td>
					<td align='right'><img src="<?php echo base_url().'public/logo/footer2.png'?>" alt='logo.png' ></td>
				</tr>
				<tr>
					<td colspan='2' ><img width='1100px' height='17px' src="<?php echo base_url().'public/logo/footer3.png'?>" alt='logo.png' ></td>
				</tr>
				
			</table>
			
			<div style='page-break-before: always;'></div>
			<div style='height:150px;'><br><br><br></div>
			<table border=0 width=100%>
				<tr>
					<td colspan='2' align='center' style="font-size:24px;"><b><u>OFFER COMMERCIAL</b></u></td>
				</tr>
			</table>
			<table border='1' width='90%' cellpadding='0' cellspacing=0>
				<thead>
					</tr>
					<tr height="50px" style="font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border-right: 1px solid;">
						<td>SL.NO</td>
						<td>DESCRIPTION</td>
						<td>QTY</td>
						<td>UNIT PRICE</td>
						<td>TOTAL PRICE</td>
					</tr>
				</thead>
				<tbody>
					<tr height="40px">
						<td></td>
						<td><b><?php echo $project_name; ?></b></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php $i=1; foreach($records2 as $r) { ?>
					<tr>
						<td align="center"><?php echo $i; ?></td>
						<td>    &nbsp;&nbsp;&nbsp;
							<b><u><?php echo $r->product_desc; ?></u></b><br><br>
							<table width='100%'>
							<?php $k=1;foreach($records3 as $t) :
							if($t->trans_id1==$r->trans_id){?>
							<tr>
								<td width="10%"></td>
								<td width="70%" height="20px">
									<?php echo nl2br($t->sub_details);?><br>
								</td>
								<td><?php //if($t->qty>0) echo $t->qty;?></td>
							</tr>
							<?php $k++; 
							} endforeach; ?>
							</table>
						</td>
						<td align="center"><?php echo $r->quantity; ?></td>
						<td align="center"><?php echo $r->price; ?></td>
						<td align="center"><?php echo $r->total; ?></td>
					</tr>
					<?php    $i++; } ?>
					<tr>
						<td colspan="4" align="right"><b>TOTAL (AED)</b></td>
						<td align="center">
							<?php echo $sub_total; ?>
						</td>
					</tr>
					<tr>
						<td colspan="4" align="right"><b>VAT <?php echo $vat_percent; ?>%</b></td>
						<td align="center">
							<?php echo $vat_amt; ?>
						</td>
					</tr>
					<tr>
						<td colspan="4" align="right"><b>GRAND TOTAL (AED)</b></td>
						<td align="center">
							<?php echo $grand_total; ?>
						</td>
					</tr>
				</tbody>
			</table>
			<br><br>
			<b>Amount in words : 
			<?php if($grand_total>0) 
			echo $currabrev.' '.convert_number_to_words($grand_total);?></b>
			<br><br>
			
			<table border=0 width=100% style="padding-top:450px;">
				<tr>
					<td align='left'><img src="<?php echo base_url().'public/logo/footer1.png'?>" alt='logo.png' ></td>
					<td align='right'><img src="<?php echo base_url().'public/logo/footer2.png'?>" alt='logo.png' ></td>
				</tr>
				<tr>
					<td colspan='2' ><img width='1100px' height='17px' src="<?php echo base_url().'public/logo/footer3.png'?>" alt='logo.png' ></td>
				</tr>
				
			</table>
			<div style='page-break-before: always;'></div>
			
			<div style='height:200px;'><br><br><br></div>
			
			
			<table border='1' width='90%' cellpadding='0' cellspacing=0>
				<thead>
					<tr height="50px" style="font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border-right: 1px solid;">
						<td>OFFER VALIDITY: </td>
						<td><?php echo $validity; ?></td>
					</tr>
					<tr height="50px" style="font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border-right: 1px solid;">
						<td>PAYMENT TERMS</td>
						<td><?php echo $payment_term1; ?></td>
					</tr>
					<tr height="50px" style="font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border-right: 1px solid;">
						<td>DELIVERY</td>
						<td><?php echo $payment_term2; ?></td>
					</tr>
				</thead>
			</table>
			<table border=0 width=100% style="padding-top:750px;">
				<tr>
					<td align='left'><img src="<?php echo base_url().'public/logo/footer1.png'?>" alt='logo.png' ></td>
					<td align='right'><img src="<?php echo base_url().'public/logo/footer2.png'?>" alt='logo.png' ></td>
				</tr>
				<tr>
					<td colspan='2' ><img width='1100px' height='17px' src="<?php echo base_url().'public/logo/footer3.png'?>" alt='logo.png' ></td>
				</tr>
				
			</table>
		</center>
	</body>
</html>








<style>
      .pagenum:before { content: counter(page); }
</style>



