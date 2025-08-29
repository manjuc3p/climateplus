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

<style>
@media print {
    body {
        margin: 0;
        padding: 0;
    }

    header {
        position: fixed;
        width: 100%;
    }

    header {
        top: 0;
    }

    .ftr {
        bottom: 0;
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
	<body style="margin-left: 5px; margin-top:5px; font-family:Arial;">
		<center>
		<table border=0 width=100%>
				<thead>
				<tr>
					<td>
						<img src="<?php echo base_url()?>public/logo/Header.jpg" alt="Header Image" width='100%' ></td>
					
				</tr>
				</thead>
			</table> 
			<main>
			<br>
				<br>
			<table border='1' width='100%' style='border-collapse: collapse;font-family: Helvetica, sans-serif;'>
				<tr>
					<td bgcolor="#160D9F" align="center" colspan='4'>
						<b><font color="#ffffff" style="font-size:30px;">QUOTATION</font></b>
					</td>
				</tr>
			</table>
			<br>
			<table border='1' width='100%' cellpadding="2" style='border-collapse: collapse;font-family: Helvetica, sans-serif;'>
				<tr>
					<td width='25%' bgcolor='#BFC9CA'>To:</td><td  width='75%'><?php echo $customer_name;?></td>
				</tr>
				<tr>
					<td width='25%' bgcolor='#BFC9CA'>Attn:</td><td  width='75%'><?php echo $cp_name;?></td>
				</tr>
				<tr>
					<td width='25%' bgcolor='#BFC9CA'>TRN:</td><td  width='75%'><?php echo $cust_trn;?></td>
				</tr>
				<tr>
				<td  width='25%' bgcolor='#BFC9CA'>Quotation No:</td><td  width='75%'><?php echo $quotation_code;?></td>
				</tr>
				<tr>
				<td  width='25%' bgcolor='#BFC9CA'>Quotation Date:</td><td  width='75%'><?php echo $quotation_date;?></td>
				</tr>
				<tr>
				<td  width='25%' bgcolor='#BFC9CA'>Your Ref:</td><td  width='75%'><?php echo $client_ref;?></td>
				</tr>
				</table>
				<br/>
				<table border='1' width='100%' cellpadding="10" style='font-size: 12px; border-collapse: collapse;font-family: Arial, sans-serif;'>
						<thead>
							<th bgcolor='#BFC9CA'>#</th>
							<th bgcolor='#BFC9CA'>Product</th>
							<th bgcolor='#BFC9CA'>Description</th>	
							<th bgcolor='#BFC9CA'>Length</th>	
							<th bgcolor='#BFC9CA'>Height</th>	
							<th bgcolor='#BFC9CA'>Color</th>							
							<th bgcolor='#BFC9CA'>Qty</th>
							<th bgcolor='#BFC9CA'>Unit Price</th>
							<?php if($disc == 2) { ?> <th bgcolor='#BFC9CA'>Discount</th> <?php } ?>
							<th bgcolor='#BFC9CA'>Subtotal</th>
							<th bgcolor='#BFC9CA'>Tax Rate</th>
						</thead>
						<tbody>
						<?php 
						//echo '<pre>';print_r($records2);exit;
						$tc=count($records2); 
						$i=1;
						$tot=0;
						$tot_dis=0;
						foreach($records2 as $tr) :
						//$net_rate = 0;
						?>
						<tr>
							<td><?php echo $i;$i++; ?></td>
							<td><?php echo $tr->category_name; ?></td>
							<td><?php echo $tr->product_description; ?></td>
							<td><?php echo $tr->manf_length; ?></td>
							<td><?php echo $tr->manf_height; ?></td>
							<td><?php echo $tr->manf_color; ?></td>							
							<td><?php echo $tr->quantity; ?></td>
                            <td><?php echo $tr->unit_price; ?></td>
							<?php if($disc == 2) { ?>  <td><?php if($tr->dis_per > 0){$tot_dis+=(($tr->unit_price*($tr->dis_per/100))*$tr->quantity);echo $tr->dis_per.'%';}  else if($tr->dis_val > 0){ $tot_dis+=$tr->dis_val;echo $tr->dis_val;}else{ echo 0;} ?></td> <?php } ?>
							<td><?php $tot+=($tr->quantity * $tr->unit_price); echo $tr->quantity * $tr->unit_price; ?></td>
                            <td><?php echo $vat_percent.'%'; ?></td>
						</tr>
						<?php 
						endforeach;
						?>
						</tbody>
					</table>
					<?php if($tc < 10) {?>
						<br><br><br><br>
						<?php }?>
					
					<div <?php if($tc > 10) {echo 'style="page-break-before: always;"'; }?>>
						<table border='1'  width='100%' style='font-size: 12px; border-collapse: collapse;'>
							<tr>
								<td>Total Gross Amount :</td><td><b><?php echo $tot;?></b></td>
							</tr>
							<?php if($disc == 2) { ?>
							<tr>
								<td>Total Discount Amount :</td><td><b><?php echo $tot_dis+=$discount;?></b></td>
							</tr>
							<?php } ?>
							<tr>
								<td>Total taxable value :</td><td><b><?php echo $sub_total-$tot_dis;?></b></td>
							</tr>
							<tr>
								<td>VAT Amount Payable:</td><td><b><?php echo $vat_amt;?></b></td>
							</tr>
							<tr>
								<td>Total Amount Payable :</td><td><b><?php echo $grand_total;?></b></td>
							</tr>
						</table>
					</div>
					<br><br>
					<div>
						<table border='1'  width='100%' style='font-size: 12px; border-collapse: collapse;'>
							<tr>
								<td>Validity :</td><td><b><?php echo $validity;?></b></td>
							</tr>
							<tr>
								<td>Payment Terms :</td><td><b><?php echo $payment_term;?></b></td>
							</tr>
							<tr>
								<td>Delivery Terms :</td><td><b><?php echo $del_term;?></b></td>
							</tr>
						</table>
					</div>
					<br><br>
					<div>
						
						<table border=1 width='100%' style='font-size: 12px; border-collapse: collapse;'>
							<th colspan='2'><b>Bank Details:</b></th>
							<tr>
								<td width='25%'>Bank Name:</td><td><?php echo $company_bank_name; ?></td>
							</tr>
							<tr>
								<td width='25%'>Branch:</td><td><?php echo $company_bank_branch; ?></td>
							</tr>
							<tr>
								<td width='25%'>Acc No:</td><td><?php echo $company_bank_account; ?></td>
							</tr>
							<tr>
								<td width='25%'>IBAN No:</td><td><?php echo $bank_iban; ?></td>
							</tr>
							
						</table>
					</div>
			</main> 
			<!--<footer style="position: fixed;bottom: 0;left: 0;right: 0;text-align: center;z-index: 999;">
			 <table border=0 >
				<tr>
					<td>
						<img  src="data:image/png;base64,<?php echo base64_encode(file_get_contents('http://localhost/Catalyst/public/logo/Footer.jpg')); ?>" alt='logo.png' width='100%'>
					 </td> 
				</tr>
				
			</table> 
			</footer>-->
		</center>
	</body>
</html>

<style>
      .pagenum:before { content: counter(page); }
</style>



