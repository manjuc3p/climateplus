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
	$enquiry_code=$row->po_code;
	$revision=$row->revision;
	$quotation_date=date('d-M-Y',strtotime($row->po_date));
	$revision_date=date('d-M-Y',strtotime($row->revision_date));
	$quotation_code=$row->po_code;
	$customer_id=$row->supplier_id;
	$customer_name=$row->supplier_name;
	
	$sub_total=$row->sub_total;
	$vat_percent=$row->vat_percent;
	$vat_amt=$row->vat_amt;
	$discount_percent=$row->discount_percent;
	$discount=$row->discount;
	$grand_total=$row->grand_total;
	
	$payment_term1=$row->payment_term1;
	$payment_term2=$row->delivery_term;
	$payment_term3=$row->shipping_term;
	$payment_term4=$row->certificate_term;
		
	$billing_addr=$row->billing_address;
	$billing_city=$row->billing_city;
	$billing_state=$row->billing_state;
	$billing_pincode=$row->billing_po_box;
	$billing_country= $row->billing_country;	
	$shipping_addr= $row->shipping_address;
	$shipping_city= $row->shipping_city;
	$shipping_pincode= $row->shipping_po_box;
	$shipping_country= $row->shipping_country;	
	$remark=$row->remark;
	$client_ref=$row->supplier_ref;
	
	$cp_name=$row->cp_name;
	$cp_mobile=$row->cp_mobile;
	$cp_email=$row-> email_id;
	$sales_person=$row->user_name;
	
	$sales_person_mob=$row->contact_no;
	$currabrev=$row->currabrev;
	$currency_rate=$row->currency_rate;
	$stamp_image=$row->stamp_image;
}
if($revision>0)
{
$revtext= 'Rev -'.$revision;
$quotation_date =$revision_date;
}
else $revtext="";

$logo1=base_url().'public/logo/Logo-fzc.jpg';
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
			Purchase Order
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
					<td>&nbsp;</td>
				</tr>
				</thead>
			</table>
			</header>
			<main>
			<table border=0 width=100%>
				<tr>
					<td colspan='2' align='center' style="font-size:23px;"><b><u>PURCHASE ORDER</b></u></td>
				</tr>
				<tr height='100px'></tr>
				<tr>
					<td  valign="top" align='left'>
					<table width=100% border=0 style="font-family:Arial; font-size: 14px; line-height: 1.2">
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
						<table width=80% border=0 style="font-family:Arial; font-size: 14px; line-height: 1.2">
							<tr>
								<td width=20>
									
								</td>
								<td >
									<b>Purchase No</b>
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
									<b>TRN</b>
								</td>
								<td>
									<b>:</b>
								</td>
								<td>
									<?php echo $company_TRN;?>
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
						<td>PRICE(AED)</td>
						<td>TOTAL(AED)</td>
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
						<td align="center"><?php echo ($r->price); ?></td>
						<td align="center"><?php echo ($r->total); ?></td>
					</tr>
					<?php    $i++; } ?>
					<tr height="40px">
						<td colspan="4" align="right"><b>TOTAL (AED)</b></td>
						<td align="center">
							<?php echo $sub_total; ?>
						</td>
					</tr>
					<?php if($discount>0){ ?>
					<tr height="40px">
						<td colspan="4" align="right"><b>DISCOUNT <?php echo ($discount_percent); ?>%</b></td>
						<td align="center">
							<?php echo $discount; ?>
						</td>
					</tr>
					<?php } ?>
					<tr height="40px">
						<td colspan="4" align="right"><b>VAT <?php echo intval($vat_percent); ?>%</b></td>
						<td align="center">
							<?php echo $vat_amt; ?>
						</td>
					</tr>
					<tr height="40px">
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
			
			<table border='0' width='90%' cellpadding='0' cellspacing=0>
				<thead>
				
					<tr style="font-family:Arial; font-size: 18px; font-weight: bold; text-align: center; border-right: 1px solid;">
						
						<td width='60%' align='left' colspan='3'>Terms and Conditions</td>
					</tr>
					<tr height="40px" style="font-family:Arial; font-size: 11px; font-weight: bold; text-align: center; border-right: 1px solid;">
						
						<td width='60%' align='left'>Payment Terms: <?php echo $payment_term1; ?></td>
						<td align='center'><b>For  Bangalore Elect  Switchgear Assembly LLC</b> </td>
						<td></td>
					</tr>
					<tr height="40px" style="font-family:Arial; font-size: 11px; font-weight: bold; text-align: center; border-right: 1px solid;">
						<td width='60%' align='left'>Delivery Terms: <?php echo $payment_term2; ?></td>
						<td align='right'>
							<?php 
			      				//$binary = base64_decode(str_replace(" ", "+", $stamp_image));
							?>
							<!--<img style="width: 100px; height:100px; margin:auto; display: block;" src="<?php if($binary!='') echo 'data:' .';base64,' . base64_encode($binary); ?>">
						--></td>
						<td></td>
					</tr>
					<tr height="40px" style="font-family:Arial; font-size: 11px; font-weight: bold; text-align: center; border-right: 1px solid;">
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



