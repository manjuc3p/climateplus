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
	$catalyst_ref_no=$row->catalyst_ref_no;
	$quotation_date=date('d-M-Y',strtotime($row->invoice_date));
	$inv_type=$row->inv_type;
	$quotation_code=$row->invoice_code;
	$customer_id=$row->customer_id;
	$customer_name=$row->cust_name;
	$cp_name=$row->cp_name;
	$cp_mobile=$row->cp_mobile;
	$cp_email=$row->cp_email;
	$sub_total=$row->sub_total;
	$vat_percent=$row->vat_percent;
	$vat_amt=$row->vat_amt;
	$discount_percent=$row->discount_percent;
	$discount=$row->discount_amt;
	$grand_total=$row->grand_total;
	//$delivery_date=$row->delivery_date;
	$payment_term1=$row->payment_term;
	$payment_term2=$row->delivery_term;
	$payment_term3=$row->remark;
	$po_number=$row->po_number;
	$billing_addr=$row->billing_addr;
	$billing_city=$row->billing_city;
	$billing_state=$row->billing_state;
	$billing_pincode=$row->billing_pincode;
	$billing_country= $row->billing_country;
	
	$shipping_addr= $row->shipping_addr;
	$shipping_city= $row->shipping_city;
	$shipping_pincode= $row->shipping_pincode;
	$shipping_country= $row->shipping_country;
	$trn_no = $row->trn_no;
	$remark=$row->remark;
	$client_ref='';
	//$validity=$row->validity;
	//$certificate_details=$row->certificate_details;
	$manufacture=$row->manufacture;	
	$origin=$row->origin;	
	$hs_code=$row->hs_code;	
	
	$sales_person=$row->user_name;
	$sales_person_mob=$row->contact_no;
	
	$company_bank_name= $row->bank_name;
	$company_bank_account= $row->bank_account;
	$company_bank_branch= $row->bank_branch;
	$bank_iban= $row->bank_iban;
	$bank_swift= $row->bank_swift;
	$currabrev=$row->currabrev;
	$currency_rate=$row->currency_rate;
}

//$logo1=base_url().'public/logo/Logo-fzc.jpg';
$print_header=base_url().'public/logo/Header.jpg';?>


<html>
	<head>
		<title>
			Invoice
		</title>
	</head>
	<body topmargin=0 style="margin-left: 5px; margin-top:5px; font-family:Arial;">
		<center>
			<table border=0 width=100%>
				<tr>
					<td bgcolor="#ffffff" width="50%" align="center" valign="top"> 
						<table cellpadding=10 border=0 width=95%>
							<tr>
								<td bgcolor="#ff0000" align="center" height=130>
									<b><font color="#ffffff" face="Arial" style="font-size:40;"> <?php if($inv_type=='PI') echo 'Proforma Invoice';  elseif($inv_type=='DI') echo 'Dummy Invoice'; else echo 'Tax Invoice';?></font><br><font color="#ffffff" face="Arial" style="font-size:20;"><?php echo $quotation_code;?></font></b>
								</td>
							</tr>
							<tr>
								<td bgcolor="#fafafa" style="font-family:Arial; font-size: 16px">
									Invoice to:<br><br>
									<b><?php echo $customer_name;?></b><br>
									<?php echo $billing_addr;?><br>
									<?php echo $billing_city.' '.$billing_pincode.' '.$billing_country;?><br>
									Contact person: <?php echo $cp_name;?><br>
									Tel: <?php echo $cp_mobile;?><br>
									Email: <?php echo $cp_email;?><br>
									TRN#: <?php echo $trn_no;?><br>
								</td>
							</tr>
							<tr>
								<td bgcolor="#ffffff" style="font-family:Arial; font-size: 15px">
									<b>H.S. Code: <?php echo $hs_code;?></b>
								</td>
							</tr>
							
						</table>

					</td>
					<td bgcolor="#ffffff" width="50%" valign="top" align="left"> 
						<table cellpadding=2 border=0 width=100%>							
							<tr>
								<td height=0 align="right" style='font-size:10px;'>Page 1 of 1</td>
							</tr>
							<tr>
								<td valign="top" align="right"><img src="<?php echo base_url().'public/logo/Logo-fzc.jpg'?>" alt='logo.png' width='200px'></td>
							</tr>
							<tr>
								<td valign="top" align="right"  style="font-family:Arial; font-size: 17px; line-height: 1.6 ">
									<?php echo $company_telephone;?><br> 
									<?php echo $company_email_id;?><br>
									<?php echo $company_website;?><br>
									PO. box <?php echo $company_pincode;?>, <?php echo $company_address.', '.$company_city.', '.$company_country;?><br>
									TRN : <?php echo $company_TRN;?><br>
								</td>
							</tr>
							<tr>
								<td valign="top" align="right">
									<table width=80% border=0 style="font-family:Arial; font-size: 15px; line-height: 1.2">
										<tr>
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
											<td >
												<b>Our ref</b>
											</td>
											<td>
												<b>:</b>
											</td>
											<td>
												<?php echo $catalyst_ref_no;?>	
											</td>
										</tr>
					
										<tr>
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
										
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table border=0 width=95% cellpadding=0 cellspacing=10>
				<tr>
					<td colspan=7>
						<hr size=1>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 16px; font-weight: bold; text-align: center; border: 1px solid">
					<td>Srn</td>
					<td>Model Number</td>
					<td align=center>Description</td>
					<td>Size</td>
					<td>Qty</td>
					<td>Unit Price</td>
					<td>Total <?php echo $currabrev;?></td>
				</tr>
				<tr>
					<td colspan=7>
						<hr size=1>
					</td>
				</tr>
				
				<?php $tc=count($records2);  $k=2; $i=1; $totQ=0;$totP=0;$totA=0; foreach($records2 as $tr) :?>
				<tr style="font-family:Tahoma; font-size: 13px;text-align: center;margin: 5px">
					<td style="border-bottom-color: #ececec; border-bottom-style: solid; border-bottom-width: 1px; border-left-color: #ececec; border-left-style: solid; border-left-width: 1px; margin: 5px ">
						<?php echo $tr->srn;?>
					</td>
					<td style="border-bottom-color: #ececec; border-bottom-style: solid; border-bottom-width: 1px; border-left-color: #ececec; border-left-style: solid; border-left-width: 1px;" align='center' valign='middle'>
						<?php echo $tr->order_code;?>
					</td>
					<td style="border-bottom-color: #ececec; border-bottom-style: solid; border-bottom-width: 1px; border-left-color: #ececec; border-left-style: solid; border-left-width: 1px;" align='left'>
						<?php echo $tr->item_desc;?>
					</td>
					<td style="border-bottom-color: #ececec; border-bottom-style: solid; border-bottom-width: 1px; border-left-color: #ececec; border-left-style: solid; border-left-width: 1px; border-right-color: #ececec; border-right-style: solid; border-right-width: 1px; ">
						<?php echo  $tr->size; if($tr->size>0) echo '"' ;?>
					</td>
					<td style="border-bottom-color: #ececec; border-bottom-style: solid; border-bottom-width: 1px; border-right-color: #ececec; border-right-style: solid; border-right-width: 1px; ">
						<?php echo $tr->quantity; $totQ=$totQ+$tr->quantity;?>
					</td>
					<td style="border-bottom-color: #ececec; border-bottom-style: solid; border-bottom-width: 1px; border-right-color: #ececec; border-right-style: solid; border-right-width: 1px; ">
						<?php echo $tr->price; $totP=$totP+$tr->price;?>
					</td>
					<td style="border-bottom-color: #ececec; border-bottom-style: solid; border-bottom-width: 1px; border-right-color: #ececec; border-right-style: solid; border-right-width: 1px; " align='right'>
						<?php echo $tr->total; $totA=$totA+$tr->total;?>
					</td>
				</tr>
				<?php
				$limit =11;
				//if($k>2) { $i=1; $limit =9;} 
				if ($i>1 && $i%$limit==0 && $i!=$tc)
				{
				echo "</table><p style='page-break-before: always;'>&nbsp;</p>";
				echo  "<table width='100%' border=0 cellspacing='0' colspacing='0' topmargin=0 style='margin-left: 5px; margin-top:-20px; font-family:Arial;'>
					<tr>
						<td bgcolor='#ff0000' align='center' height=70>
							<b><font color='#ffffff' face='Arial' style='font-size:20;'>Quotation<br> $quotation_code</font></b>
						</td>
						<td align='right' width='50%'>
						<p style='font-size:10px;'>Page 1 of $k</p>
						<img width='150px' style='background-color:white' src='$logo1' alt='logo.png'>
						</td>
					</tr>
				</table>";
				echo "				
				<table border=0 width=90% cellpadding=0 cellspacing=10>
				<tr>
					<td colspan=7>
						<hr size=1>
					</td>
				</tr>
				<tr style='font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border: 1px solid'>
					
					<td>Srn</td>
					<td>Order Code</td>
					<td align=left>Description</td>
					<td>Size</td>
					<td>Qty</td>
					<td>Unit Price</td>
					<td>Total $currabrev</td>
				</tr>
				<tr>
					<td colspan=7>
						<hr size=1>
					</td>
				</tr>";
				$k++;
				}
				$i++;
				 endforeach; ?>
				<tr style="font-family:Arial; font-size: 12px;">
					<td  colspan=2 bgcolor="#cccccc" align="center">
						<b>Total</b>
					</td>
					<td colspan=1 bgcolor="#cccccc">
					</td>
					<td bgcolor="#cccccc" align="center">
						
					</td>
					<td bgcolor="#cccccc" align="center">
						<b><?php echo $totQ;?></b>
					</td>
					<td bgcolor="#cccccc" align="center">
						<b><?php //echo sprintf("%0.2f",$totP);?></b>
					</td>
					<td bgcolor="#cccccc" align="right">
						<b><?php echo sprintf("%0.2f",$totA);?></b>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 12px;">
					<td colspan=5 align="left">
						<b>Amount in words : 
						<?php if($grand_total>0) echo convert_number_to_words($grand_total);?>	</b>
					</td>
					<td align="center" style="font-family:Arial; font-size: 13px;">
						<b>Sub total</b>
					</td>
					<td align="right" style="font-family:Arial; font-size: 13px;">
						<?php echo $currabrev;?> <b><?php echo $sub_total;?></b>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 12px;">
					<td align="left" colspan=5>					
						 <b>Equivalent Amount In AED <?php echo $grand_total*$currency_rate;?> </b>
					</td>
					<td align="center" style="font-family:Arial; font-size: 13px;">
						<b>Discount @<?php echo $discount_percent;?>% </b>
					</td>
					<td align="right" style="font-family:Arial; font-size: 13px;">
						<?php echo $currabrev;?> <b><?php echo $discount;?></b>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 12px;">
					<td colspan=4 rowspan=2>
					<b>Bank Details: </b><br>
					 Benificary name : <?php echo $company_name;?><br>
					<?php echo $company_bank_name;?>
					<b>A/c No : <?php echo $company_bank_account;?></b><br>
					<?php echo $company_bank_branch;?><br>
					IBAN : <?php echo $bank_iban;?><br>
					SWIFT : <?php echo $bank_swift;?><br>
					</td>
					<td align="center">
						
					</td>
					<td align="center" style="font-family:Arial; font-size: 13px;">
						<b>VAT @<?php echo $vat_percent;?>%</b>
					</td>
					<td align="right" style="font-family:Arial; font-size: 13px;">
						<?php echo $currabrev;?> <b><?php echo $vat_amt;?></b>
					</td>
				</tr>
				<tr height=40px style="font-family:Arial; font-size: 13px;">
					<td align="left" colspan=3  bgcolor="ff0000">
						<b><font color="ffffff">Total incl.VAT</font></b>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b><font color="ffffff"><?php echo $currabrev;?> <?php echo $grand_total;?></font></b>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 13px;" >
					<td align="left" colspan=5>
						<b>Manufacture :</b><?php echo $manufacture;?>
					</td>
					<td align="left" colspan=2 rowspan=2>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 13px;">
					<td align="left" colspan=5>
						<?php if($origin!='') echo "<b>Origin :</b>  $origin";?>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 13px;">
					<td align="left" colspan=5>
						<b>Payment Terms :</b><?php echo $payment_term1;?>
					</td>
					<td align=left colspan=2 rowspan=5>
						<br><br><br>
						<b><?php echo $sales_person;?><br>
						Sales Manager<br>
						Mob- <?php echo $sales_person_mob;?></b>
					</td>
				</tr>
				<?php if($inv_type=='PI') { ?>
				<tr style="font-family:Arial; font-size: 13px;">
					<td align="left" colspan=5>
						<b>Delivery Terms :</b><?php echo $payment_term2;?>
					</td>
				</tr>
				<?php } ?>
			</table>
		</center>
	</body>
</html>

