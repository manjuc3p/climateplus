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
	$enquiry_code=$row->catalyst_ref;
	$revision=$row->revision;
	$quotation_date=date('d-M-Y',strtotime($row->approval_date));
	$revision_date=date('d-M-Y',strtotime($row->revision_date?? ''));
	$quotation_code=$row->quotation_code;
 	$ack_code='ACK-'.$enquiry_code;
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
	$payment_term3=nl2br($row->note_terms);	
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
	$client_ref=$row->po_number;
	$validity=$row->validity;
	$certificate_details=$row->certificate_details;	
	$manufacture=$row->manufacture;	
	$origin=$row->origin;	
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
	if($other1_amt>0) $mis_cnt=1;
	if($other2_amt>0) $mis_cnt=2;
	if($other3_amt>0) $mis_cnt=3;
}
if($revision>0)
{
$revtext= 'Rev -'.$revision;
$quotation_date =$revision_date;
}
else
{ $revtext="";
 }

$ack_revision='';  $delivery_date_con=''; $start_date_con=''; $ack_condition='';
foreach($records3 as $row) {
	$ack_revision=$row->ack_revision;
	$delivery_date=date('d-M-Y',strtotime($row->delivery_date));
	$start_date=date('d-M-Y',strtotime($row->start_date));
	
	if($ack_revision!='')
	$ack_revision=$ack_revision;
	
	if($row->delivery_date!='1970-01-01')
		$delivery_date_con="Delivery Date: &nbsp;&nbsp;&nbsp;".$delivery_date;
	
	if($row->start_date!='1970-01-01')
		$start_date_con="Start Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$start_date;
	
	$ack_condition=$start_date_con.'<br>'.$delivery_date_con;
}
 
$logo1=base_url().'public/logo/Logo-fzc.jpg';
$print_header="";?>


<html>
	<head>
		<title>
			Order Acknowledgement
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
									<b><font color="#ffffff" face="Arial" style="font-size:40;"> Order Acknowledgement</font><br><font color="#ffffff" face="Arial" style="font-size:20;"><?php echo $ack_code.' '.$ack_revision;?></font></b>
								</td>
							</tr>
							<tr>
								<td bgcolor="#fafafa" style="font-family:Arial; font-size: 16px">
									Ack to:<br><br>
									<b><?php echo $customer_name;?></b><br>
									<?php echo $billing_addr;?><br>
									<?php echo $billing_city.' '.$billing_pincode.' '.$billing_country;?><br>
									Contact person: <?php echo $cp_name;?><br>
									Tel: <?php echo $cp_mobile;?><br>
									Email: <?php echo $cp_email;?><br>
								</td>
							</tr>
							
							<tr>
								<td style="font-family:Arial; font-size: 14px">
									<?php echo $ack_condition;?>
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
								<td valign="top" align="right"  style="font-family:Arial; font-size: 15px; line-height: 1.6 ">
									<?php echo $company_telephone;?><br> 
									<?php echo $company_email_id;?><br>
									<?php echo $company_website;?><br>
									PO. box <?php echo $company_pincode;?>, <?php echo $company_address.', '.$company_city.', '.$company_country;?><br>
									TRN : <?php echo $company_TRN;?><br>
								</td>
							</tr>
							<tr>
								<td valign="top" align="right">
									<table width=80% border=0 style="font-family:Arial; font-size: 14px; line-height: 1.2">
										<tr>
											<td width=40>
												
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
											<td width=40>
												
											</td>
											<td >
												<b>Client PO NO</b>
											</td>
											<td>
												<b>:</b>
											</td>
											<td>
												<?php echo $client_ref;?>
											</td>
										</tr>
										<tr>
											<td width=40>
												
											</td>
											<td >
												<b>Petrostar Ref No</b>
											</td>
											<td>
												<b>:</b>
											</td>
											<td>
												<?php echo $enquiry_code;?>	
											</td>
										</tr>
										
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<h4>We confirm acceptance of the purchase order no <?php echo $client_ref;?> as per the detials mentioned below</h4>
			
			<table border=0 width=95% cellpadding=0 cellspacing=10>
				<tr>
					<td colspan=8>
						<hr size=1>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border: 1px solid">
					<th>Srn</th>
					<th>Model Code</th>
					<th align=center>Description</th>
					<th>Size</th>
					<th>Qty</th>
					<th>Delivery</th>
					<th>Unit Price</tdth>
					<th>Total Amount</th>
				</tr>
				<tr>
					<td colspan=8>
						<hr size=1>
					</td>
				</tr>
				
				<?php $tc=count($records2); $k=2; $i=1; $totQ=0;$totP=0;$totA=0; foreach($records2 as $tr) :?>
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
						<?php echo $tr->delivery;?>
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
				//if($k>2) { $i=2; $limit =9;} 
				if ($i>1 && $i%$limit==0 && $i!=$tc)
				{
				echo "</table><p style='page-break-before: always;'>&nbsp;</p>";
				echo  "<table width='100%' border=0 cellspacing='0' colspacing='0' topmargin=0 style='margin-left: 5px; margin-top:-20px; font-family:Arial;'>
					<tr>
						<td bgcolor='#ff0000' align='center' height=70>
							<b><font color='#ffffff' face='Arial' style='font-size:20;'>Order Acknowledgement<br> $ack_code.' '.$ack_revision</font></b>
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
					<td colspan=8>
						<hr size=1>
					</td>
				</tr>
				<tr style='font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border: 1px solid'>
					
					<th>Srn</th>
					<th>Order Code</th>
					<th align=left>Description</th>
					<th>Size</th>
					<th>Qty</th>
					<th>Delivery</th>
					<th>Unit Price</tdth>
					<th>Total Amount</th>
				</tr>
				<tr>
					<td colspan=8>
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
					<td colspan=2 bgcolor="#cccccc">
					</td>
					<td bgcolor="#cccccc" align="center">
						<b><?php echo $totQ;?></b>
					</td>
					<td bgcolor="#cccccc" align="center">
						<b></b>
					</td>
					<td bgcolor="#cccccc" align="center">
						<b><?php //echo sprintf("%0.2f",$totP);?></b>
					</td>
					<td bgcolor="#cccccc" align="right">
						<b><?php echo sprintf("%0.2f",$totA);?></b>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 12px;">
					<td colspan=6 align="left">
						<table width='100%' style="font-family:Arial; font-size: 12px;">
							<tr>
								<td>
									<b>Amount in words : 
									<?php if($grand_total>0) 
									echo $currabrev.' '.convert_number_to_words($grand_total);?></b>
								</td>
							</tr>
							<tr>
								<td>
									<b>Equivalent Amount In AED <?php echo $grand_total*$currency_rate;?> </b>
								</td>
							</tr>
							<tr>
								<td>
									<b>Bank Details: </b><br>
									 Benificary name : <?php echo $company_name;?><br>
									<?php echo $company_bank_name;?>
									<b>A/c No : <?php echo $company_bank_account;?></b><br>
									<?php echo $company_bank_branch;?><br>
									IBAN : <?php echo $bank_iban;?><br>
									SWIFT : <?php echo $bank_swift;?><br>
								</td>
							</tr>
							<?php if($other1_amt>0){?>
							<tr>
								<td align="center"></td>
							</tr>
							<?php } if($other2_amt>0){?>
							<tr>
								<td align="center"></td>
							</tr>
							<?php } if($other3_amt>0){?>
							<tr>
								<td align="center"></td>
							</tr>
							<?php } ?>
							<tr>
								<td align="center"></td>
							</tr>
						</table>
					</td>
					<td colspan=2 style="font-family:Arial; font-size: 13px;">
						<table width='100%' style="font-family:Arial; font-size: 13px;">
							<tr>
								<td align="center">
									<b>Sub total</b>
								</td>
								<td align="right">
									<?php echo $currabrev;?> <b><?php echo $sub_total;?></b>
								</td>
							</tr>
							<tr>
								<td align="center">
									<b>Discount @<?php echo $discount_percent;?>%</b>
								</td>
								<td align="right">
									<?php echo $currabrev;?> <b><?php echo $discount;?></b>
								</td>
							</tr>
							<tr>
								<td align="center">
									<b>VAT @<?php echo $vat_percent;?>%</b>
								</td>
								<td align="right">
									<?php echo $currabrev;?> <b><?php echo $vat_amt;?></b>
								</td>
							</tr>
							<?php if($other1_amt>0){?>
							<tr>
								<td align="center">
									<b><?php echo $other1;?></b>
								</td>
								<td align="right">
									<b><?php echo $currabrev;?> <?php echo $other1_amt;?></b>
								</td>
							</tr>
							<?php } if($other2_amt>0){?>
							<tr>
								<td align="center">
									<b><?php echo $other2;?></b>
								</td>
								<td align="right">
									<b><?php echo $currabrev;?> <?php echo $other2_amt;?></b>
								</td>
							</tr>
							<?php } if($other3_amt>0){?>
							<tr>
								<td align="center">
									<b><?php echo $other3;?></b>
								</td>
								<td align="right">
									<b><?php echo $currabrev;?> <?php echo $other3_amt;?></b>
								</td>
							</tr>
							<?php } ?>
							<tr height=40px bgcolor="ff0000">
								<td align="center">
									<b><font color="ffffff">Total incl. VAT </font></b>
								</td>
								<td align="center" >
									<b><font color="ffffff"><?php echo $currabrev;?> <?php echo $grand_total;?></font></b>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				
				<tr style="font-family:Arial; font-size: 13px;" >
					<td align="left" colspan=5>
						<b>Notes :</b><br><?php echo $payment_term3;?>
					</td>
					<td align="left" colspan=3 >
						<b>Manufacture :</b><?php echo $manufacture;?>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 13px;">
					<td align="left" colspan=5>
						<b>Certificates :</b><?php echo $certificate_details;?>
					</td>
					<td align="left" colspan=3 >
						<?php if($origin!='') echo "<b>Origin :</b>  $origin";?>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 13px;">
					<td align="left" colspan=6>
						<b>Payment Terms :</b><?php echo $payment_term1;?>
					</td>
					<td align=left colspan=2 rowspan=2>
						<b><?php echo $sales_person;?><br>
						Sales Manager<br>
						Mob- <?php echo $sales_person_mob;?></b>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 13px;">
					<td align="left" colspan=6>
						<b>Delivery Terms :</b><?php echo $payment_term2;?>
					</td>
				</tr>
				
			</table>
		</center>
	</body>
</html>


<style>
      .pagenum:before { content: counter(page); }
</style>



