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
	$invoice_type=$row->inv_type;
	//$project_name=$row->project_name;
	$po_number=$row->po_number;
	$po_date=date('d-M-Y',strtotime($row->po_date?? ''));
	$quotation_date=date('d-M-Y',strtotime($row->invoice_date));
	$quotation_date=date('d-M-Y',strtotime($row->revision_date?? ''));
	$quotation_code=$row->invoice_code;
	$customer_id=$row->customer_id;
	$customer_name=$row->cust_name;
	$cp_name=$row->cp_name;
	$cp_mobile=$row->cp_mobile;
	$cp_email=$row->cp_email;
	$trn_no=$row->trn_no;
	$sub_total=$row->sub_total;
	$vat_percent=$row->vat_percent;
	$vat_amt=$row->vat_amt;
	$discount_percent=00;
	$discount=00;
	$grand_total=$row->grand_total;
	//$delivery_date=date('d-M-Y',strtotime($row->delivery_date));
	$payment_term1=$row->payment_term;
	$payment_term2='';
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
	$client_ref='';
	$validity='';
	$company_bank_name= $row->bank_name;
	$company_bank_account= $row->bank_account;
	$company_bank_branch= $row->bank_branch;
	$bank_iban= $row->bank_iban;
	$bank_swift= $row->bank_swift;	
	$sales_person=$row->user_name;
	$sales_person_mob=$row->contact_no;
	//$currabrev=$row->currabrev;
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
	$stamp_image = $row->stamp_image;
}
if($revision>0)
{
$revtext= 'Rev -'.$revision;
//$quotation_date =$revision_date;
}
else
{ $revtext="";
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
			INVOICE
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
					<td colspan='2' align='center' style="font-size:23px;"><b><u>DELIVERY ORDER</b></u></td>
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
					<tr>
						<td width=40>
							Tel.
						</td>
						<td >
							<?php echo $cp_mobile;?>
						</td>
					</tr>
					<?php if($cp_email!=''){ ?>
					<tr>
						<td width=40>
							Email
						</td>
						<td >
							<?php echo $cp_email;?>
						</td>
					</tr>
					<?php } ?>

					<tr>
						<td width=40>
							TRN
						</td>
						<td >
							<?php echo $trn_no;?>
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
									<b>Delivery No</b>
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
							<tr>
								<td width=20>
									
								</td>
								<td >
									<b>PO Number</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $po_number;?>	
								</td>
							</tr>
							<tr>
								<td width=20>
									
								</td>
								<td >
									<b>Dated</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $po_date;?>	
								</td>
							</tr>
							<tr>
								<td width=20>
									
								</td>
								<td >
									<b>Job no</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $hs_code;?>	
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
					<?php $i=1; foreach($records2 as $r) { ?>
					<tr>
						<td align="center"><?php echo $i; ?></td>
						<td>    &nbsp;&nbsp;&nbsp;
							<b><u><?php echo $r->item_desc; ?></u></b><br><br>
							
						</td>
						<td align="center"><?php echo $r->quantity; ?></td>
					</tr>
					<?php    $i++; } ?>
					
				</tbody>
			</table>
			<br><br>	
			
			<table border='0' width='90%' cellpadding='0' cellspacing=0>
				<thead>
					<tr height="50px" style="font-family:Arial; font-size: 11px; font-weight: bold; text-align: center; border-right: 1px solid;">
						
						<td width='60%'></td>
						<td align='center'><b>For  Bangalore Elect  Switchgear Assembly LLC</b> </td>
						<td></td>
					</tr>
					<tr>
						<td width='60%'></td>
						<td align='right'>
							<?php 
			      				$binary = base64_decode(str_replace(" ", "+", $stamp_image));
							?>
							<img style="width: 100px; height:100px; margin:auto; display: block;" src="<?php if($binary!='') echo 'data:' .';base64,' . base64_encode($binary); ?>">
						</td>
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



