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
	$customer_name=$row->cust_name;
	$enquiry_date=date('d-M-Y',strtotime($row->enq_date));
	$client_ref=$row->client_ref;
	$trn_no=$row->trn_no;
	$vessel = $row->vessel_name;
}

 
?>


<html>
	<head>
		<title>
			Enquiry
		</title>
	</head>
	<body topmargin=0 style="margin-left: 5px; margin-top:5px; font-family:Arial;">
			<table cellpadding=0 border=0 width=95%>
			<tr>
				<td height=0 align="right" style='font-size:10px;'>Page 1 of 1</td>
			</tr>
			</table>
	<header>
		<center>
		<img src="<?php echo base_url().'public/logo/header.png'?>" alt='logo.png' width='1024px'>
		</center>
	</header>
	<main>
		<center>
			<table cellpadding=10 border=0 width=95%>
			<tr>
				<td bgcolor="#ff0000" align="center" height='22px'>
					<b><font color="#ffffff" face="Arial" style="font-size:30px;"> ENQUIRY</font></b>
				</td>
			</tr>
			</table>
			<table cellpadding=10 border=0 width=95%>
			<tr>
				<td bgcolor="#fafafa" style="font-family:Arial; font-size: 16px" width='70%'>
					Customer Name:<b><?php echo $customer_name;?></b><br>
					Vessel Name:<b><?php echo $vessel;?></b><br>
					TRN :<b><?php echo $trn_no;?></b>
				</td>
				<td>
					Enquiry Code: <b><?php echo $enquiry_code;?></b><br>
					Enquiry Date: <b><?php echo $enquiry_date;?></b><br>
					Client Ref: <b><?php echo $client_ref;?></b><br>
				</td>
			</tr>
			</table>
			
			<table cellpadding=10 border=1 width=95%>
				<thead>
				<tr>
					<th>SL NO</th>
					<th>ITEMS</th>
					<th>ITEM CODE</th>
					<th>PACKING</th>
					<th>UNIT</th>
					<th>QUANTITY</th>
				</tr>
				</thead>
				<tbody>
					<?php $tc=count($trans_records); $k=2; $i=1; $totQ=0;$totP=0;$totA=0; 
					foreach($trans_records as $tr) :?>
					<tr>
						<td><?php echo $i; $i++;?></td>
						<td><?php echo $tr->product_name;?></td>
						<td><?php echo $tr->product_code;?></td>
						<td><?php echo $tr->ptype;?></td>
						<td><?php echo $tr->unit_abbr;?></td>
						<td align='right'><?php echo $tr->quantity;?></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</center>
	</main>
	<footer>
		
	</footer>
	</body>
</html>


<style>
      .pagenum:before { content: counter(page); }
</style>



