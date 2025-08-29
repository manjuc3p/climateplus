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
	$invoice_code=$row->inv_code;
	$customer_name=$row->cust_name;
	$invoice_date=date('d-M-Y',strtotime($row->inv_date));	
	$trn_no=$row->trn_no;
}

?>


<html>
	<head>
		<title>
			Warranty Certificate
		</title>
        <style>
            .signature-box {
            width: 200px;
            height: 100px;
            border: 1px solid black;
            margin-top: 20px;
            }
            </style>
	</head>
	<body topmargin=0 style="margin-left: 5px; margin-top:5px; font-family:Arial;">
			<table cellpadding=0 border=0 width=95%>
			<tr>
				<td height=0 align="right" style='font-size:10px;'>Page 1 of 1</td>
			</tr>
			</table>
	<header>
		<center>
		<img src="<?php echo base_url().'public/logo/Header.jpg'?>" alt='logo.png' width='1024px'>
		</center>
	</header>
	<main>
		<center>
			<table cellpadding=10 border=0 width=95%>
			<tr>
				<td bgcolor="#ff0000" align="center" height='22px'>
					<b><font color="#ffffff" face="Arial" style="font-size:30px;">WARRANTY CERTIFICATE</font></b>
				</td>
			</tr>
            <tr><td><span>Dear Valued Customer,</span></td></tr>
            <tr><td><span>The Warranty for the AC Units Supplied to <?php echo $customer_name; ?></span></td></tr>
            <tr><td><span>As per the details given in the table.</span></td></tr>
			</table>
			<table cellpadding=10 border=0 width=95%>
			<tr>
				<td bgcolor="#fafafa" style="font-family:Arial; font-size: 16px" width='70%'>
					Customer Name:<b><?php echo $customer_name;?></b><br>
					TRN :<b><?php echo $trn_no;?></b>
				</td>
				<td>
					Invoice Code: <b><?php echo $invoice_code;?></b><br>
					Invoice Date: <b><?php echo $invoice_date;?></b><br>
				</td>
			</tr>
			</table>
			
			<table cellpadding=10 border=1 width=95% style="min-height:500px; text-align:top;">
				<thead>
				<tr>
					<th>Sl.No</th>
					<th>Description</th>
					<th>Quantity</th>
				</tr>
				</thead>
				<tbody>
					<?php $tc=count($records2); $i=1; 
					foreach($records2 as $tr) :?>
					<tr>
						<td><?php echo $i; $i++;?></td>
						<td><?php echo $tr->prod_desc;?></td>
						<td><?php echo $tr->qty;?></td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>
            
            <?php $tc=count($records2); $i=1; 
            if ($tc >1){?>
            <h6>The warranty will be provided as follows</h6>
            <table cellpadding=10 width=95% >
				<thead>
				<tr>
					<th width="5%" align="left">Sl.No</th>
					<th width="75%" align="left">Terms</th>
					
				</tr>
				</thead>
				<tbody>
					
					foreach($records3 as $tr2) :?>
					<tr>
						<td><?php echo $i; $i++;?></td>
						<td><?php echo $tr2->terms;?></td>
					</tr>
					
				</tbody>
			</table>
            <?php }?>
            <table align="left" style="margin-left:5%">
                <tr><td>Yours Faithfully</td></tr>
                <tr><td><b>For CATALYST AC UNITS FIX CONT</b></td></tr>
                <tr><td>Authorized Signatory</td></tr>
                <tr><td><div class="signature-box"></div></td></tr>
                <tr><td>Note : This letter is not valid unless signed by the signatory.</tr></tr>

            </table>
		</center>
	</main>
	<footer>  
		<img src="<?php echo base_url().'public/logo/Footer.jpg'?>" alt='Footer.jpg' width='100%'>
	</footer>
	</body>
</html>


<style>
      .pagenum:before { content: counter(page); }
</style>



