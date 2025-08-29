<?php
header("Content-type: application/octet-stream");
header("Content-Disposition:attachment;filename=quotation.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
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


foreach($records1 as $row) {
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
	$payment_term=nl2br($row->payment_term);
	$del_term=nl2br($row->delivery_term);
		
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
	$cust_trn = $row->trn_no;
	$bank_iban= $row->bank_iban;
	$bank_swift= $row->bank_swift;	
	$sales_person=$row->user_name;
	$sales_person_mob=$row->contact_no;
	$currabrev=$row->currabrev;
	$currency_rate=$row->currency_rate;
}
if($revision>0)
{
$revtext= 'Rev -'.$revision;
}
else
{ $revtext="";
 }
 
 
?>


<html>
	<head>
		<title>
			Quotation
		</title>
	</head>
	<body topmargin=0 style="margin-left: 5px; margin-top:5px; font-family:Arial;">
		<center>
			<header>
			
			<table border=0 width='75%'>
				
				<tr>
					<td height='50px'>
					<img src="<?php echo base_url().'public/logo/Header.jpg'?>" alt='logo.png' width='90%'></td>					
				</tr>
				
			</table>
			</header>
			<main>
			<br/><br/><br/><br/>
				<br>
				<br>
			<table border='1' width='100%'>
				<tr>
					<td bgcolor="#4cb5f1" align="center" colspan='10'>
						<b><font color="#ffffff" face="Arial" style="font-size:30px;">QUOTATION</font></b>
					</td>
				</tr>
				<tr>
					<td width='25%'>To:</td><td  width='25%' colspan='2'><?php echo $customer_name;?></td><td  width='25%'>Quotation No:</td><td  width='25%' colspan='6' align='left'><?php echo $quotation_code;?></td>
				</tr>
				<tr>
					<td width='25%'>Attn:</td><td  width='25%' colspan='2'><?php echo $cp_name;?></td><td  width='25%'>Quotation Date:</td><td  width='25%' colspan='6' align='left'><?php echo $quotation_date;?></td>
				</tr>
				<tr>
					<td width='25%'>TRN:</td><td  width='25%' colspan='2'><?php echo $cust_trn;?></td><td  width='25%'>Your Ref:</td><td  width='25%' colspan='6' align='left'><?php echo $client_ref;?></td>
				</tr>
			</table>
				<br/>
				<table border='1' width='100%' style='font-size: 12px; border-collapse: collapse;'>
						<thead>
							<th>#</th>
							<th>Code</th>
							<th>Description</th>
							<th>Colour Code</th>
							<th>Size(Width/Length x Height)</th>
							<th>Qty</th>
							<th>Rate</th>
							<th>Discount</th>
							<th>Net Rate</th>
							<th>Total</th>
						</thead>
						<tbody>
						<?php 
						$tc=count($records2); 
						$i=1;
						foreach($records2 as $tr) :
						$net_rate = 0;
						?>
						<tr>
							<td><?php echo $i;$i++; ?></td>
							<td><?php echo $tr->product_code; ?></td>
							<td><?php echo $tr->product_description; ?></td>
							<td><?php echo $tr->colour_code; ?></td>
							<td><?php echo $tr->length.'mm X '.$tr->height.'mm'; ?></td>
							<td><?php echo $tr->quantity; ?></td>
							<td><?php echo $net_rate=$tr->unit_price; ?></td>
							<td><?php if($tr->dis_per > 0){$net_rate=$net_rate-($net_rate*($tr->dis_per/100));echo $tr->dis_per.'%';}  else if($tr->dis_val > 0){ $net_rate=$net_rate-$tr->dis_val;echo $tr->dis_val;}else{ echo 0;} ?></td>
							<td><?php echo $net_rate; ?></td>
							<td><?php echo $tr->total; ?></td>
						</tr>
						<?php 
						endforeach;
						?>
						</tbody>
					</table>
				
			</main> 
			 <footer ">
			<table border=0 >
				<tr>
					<td><img  src="<?php echo base_url().'public/logo/Footer.jpg'?>" alt='logo.png' width='100%'></td>
				</tr>
				
			</table>
			 </footer>
		</center>
	</body>
</html>

<style>
      .pagenum:before { content: counter(page); }
</style>











