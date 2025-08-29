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
	$quotation_date=date('d-M-Y',strtotime($row->grn_date));
	$quotation_code=$row->grn_code;
	$customer_id=$row->supplier_id;
	$customer_name=$row->supplier_name;
	
	$sub_total=$row->sub_total;
	$vat_percent=$row->vat_percent;
	$vat_amt=$row->vat_amt;
	$discount_percent=$row->discount_percent;
	$discount=$row->discount;
	$grand_total=$row->grand_total;
		
	$billing_addr=$row->billing_address;
	$billing_city=$row->billing_city;
	$billing_state=$row->billing_state;
	$billing_pincode=$row->billing_po_box;
	$billing_country= $row->billing_country;	
	$remark=$row->remark;
	$client_ref=$row->invoice_no;
	$cp_name=$row->contact_person;
	 $cp_mobile=$row->contact_person_number;
	 $cp_email=$row->email_id;
	 $delivery_details=$row->delivery_details;
	$sales_person=$row->user_name;
	$sales_person_mob=$row->contact_no;
	$currabrev=$row->currabrev;
	$currency_rate=$row->currency_rate;
	$stamp_image=$row->stamp_image;
}


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
			GRN  
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
					<td colspan='2' align='center' style="font-size:23px;"><b><u>GOODS RECEIVED NOTE</b></u></td>
			</tr>
			<tr height='100px'></tr>
			<tr>
				<td bgcolor="#ffffff" width="50%" align="center" valign="top"> 
					<table cellpadding=10 border=0 width=95%>
						
						<tr>
							<td bgcolor="#fafafa" style="font-family:Arial; font-size: 16px">
								Goods Received From:<br><br>
								<b><?php echo $customer_name;?></b><br>
								<?php echo $billing_addr;?><br>
								<?php echo $billing_city.' '.$billing_pincode.' '.$billing_country;?><br>
								Contact person: <?php echo $cp_name;?><br>
								Tel: <?php echo $cp_mobile;?><br>
								Email: <?php echo $cp_email;?><br>
							</td>
						</tr>
						
					</table>

				</td>
				<td bgcolor="#ffffff" width="50%" valign="top" align="left"> 
					<table cellpadding=2 border=0 width=100%>
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
											<b>Supplier Invoice</b>
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
											<b>Our ref</b>
										</td>
										<td>
											<b>:</b>
										</td>
										<td>
											<?php echo $quotation_code;?>	
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
			<tr style="font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border: 1px solid">
				<th>Srn</th>
				<th>Item Name</th>
				<th>Qty</th>
				<th>Unit Price</tdth>
				<th>Total Amount</th>
			</tr>
			<tr>
				<td colspan=5>
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
				$limit =12;
				//if($k>2) { $i=2; $limit =9;} 
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
					<td colspan=5>
						<hr size=1>
					</td>
				</tr>
				<tr style='font-family:Arial; font-size: 17px; font-weight: bold; text-align: center; border: 1px solid'>
					
					<th>Srn</th>
					<th>Item Name</th>
					<th>Qty</th>
					<th>Unit Price</tdth>
					<th>Total Amount</th>
				</tr>
				<tr>
					<td colspan=5>
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
					<td colspan=3 align="left">
						<b>Amount in words : 
						<?php if($grand_total>0) echo $currabrev.' '.convert_number_to_words($grand_total);?></b>
					</td>
					<td align="center" style="font-family:Arial; font-size: 13px;">
						<b>Sub total</b>
					</td>
					<td align="right" style="font-family:Arial; font-size: 13px;">
						<?php echo $currabrev;?> <b><?php echo $sub_total;?></b>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 12px;">
					<td align="left" colspan=3 rowspan=3>					
						
						<?php 
			      				//$binary = base64_decode(str_replace(" ", "+", $stamp_image));
							?>
							<!--<img style="width: 100px; height:100px; margin:auto; display: block;" src="<?php if($binary!='') echo 'data:' .';base64,' . base64_encode($binary); ?>">
						-->
					</td>
					<td align="center" style="font-family:Arial; font-size: 13px;">
						<b>Discount @<?php echo $discount_percent;?>% </b>
						
					</td>
					<td align="right" style="font-family:Arial; font-size: 13px;">
						<?php echo $currabrev;?> <b><?php echo $discount;?></b>
					</td>
				</tr>
				<tr style="font-family:Arial; font-size: 12px;">
					<td align="center" style="font-family:Arial; font-size: 13px;">
						<b>VAT @<?php echo $vat_percent;?>%</b>
					</td>
					<td align="right" style="font-family:Arial; font-size: 13px;">
						<?php echo $currabrev;?> <b><?php echo $vat_amt;?></b>
					</td>
				</tr>
				<tr height=40px style="font-family:Arial; font-size: 13px;">
					<td align="left" colspan=3 >
						<b><font color="">Grand Total </font></b>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<b><font color="ffffff"><?php echo $currabrev;?> <?php echo $grand_total;?></font></b>
					</td>
				</tr>
				
				<tr style="font-family:Arial; font-size: 13px;" >
					<td align="left" colspan=5>
						<b>Delivery Details :</b><?php echo $delivery_details;?>
					</td>
				</tr>
				
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



